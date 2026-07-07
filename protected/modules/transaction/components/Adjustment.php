<?php

class Adjustment extends CComponent {

    public $header;
    public $details;

    public function __construct() {
        $this->header = new AdjustmentHeader();
        $this->details = array();
    }

    public function removeProductAt($index) {
        array_splice($this->details, $index, 1);
    }

    public function updateProducts() {
        foreach ($this->details as $detail)
            $detail->quantity_current = $detail->getCurrentStock($this->header->warehouse_id);
    }

    public function validate() {
        $valid = $this->header->validate();

        if (count($this->details) > 0) {
            foreach ($this->details as $detail) {
                $fields = array('quantity_current', 'quantity_adjustment', 'product_id');
                $valid = $detail->validate($fields) && $valid;
            }
        } else
            $valid = false;

        return $valid;
    }

    public function insert() {
        $valid = $this->header->insert();

        Inventory::model()->deleteAllByAttributes(array('transaction_number' => $this->header->number));

        foreach ($this->details as $detail) {
            $detail->adjustment_header_id = $this->header->id;
            $valid = $detail->insert() && $valid;

            if ((int) $detail->is_inactive === 0) {
                $inventory = new Inventory();
                $inventory->date = $this->header->date;
                $inventory->transaction_number = $this->header->number;
                $inventory->transaction_type = 3;
                $inventory->transaction_subject = $this->header->warehouse->name;
                $inventory->quantity_in = $detail->quantity_adjustment - $detail->quantity_current;
                $inventory->product_id = $detail->product_id;
                $inventory->warehouse_id = $this->header->warehouse_id;
                $inventory->admin_id = $this->header->admin_id;

                $valid = $inventory->insert() && $valid;
            }
        }

        return $valid;
    }

    public function addProduct($id) {
        $product = Product::model()->findByPk($id);

        if ($product !== null) {
            $exist = false;
            foreach ($this->details as $i => $detail) {
                if ($product->id === $detail->product_id) {
                    $exist = true;
                    break;
                }
            }

            if ($exist)
                $this->details[$i]->quantity++;
            else {
                $detail = new AdjustmentDetail();
                $detail->product_id = $product->id;
                $detail->quantity_current = $detail->getCurrentStock($this->header->warehouse_id);
                $this->details[] = $detail;
            }
        }
    }
}
