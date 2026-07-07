<?php

class Indent extends CComponent {

    public $header;
    public $details;

    public function __construct() {
        $this->header = new IndentHeader();
        $this->details = array();
    }

    public function copyFromDb($id) {
        $this->header = IndentHeader::model()->resetScope()->findByPk($id);
        $this->details = IndentDetail::model()->resetScope()->findAllByAttributes(array('indent_header_id' => $id));
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
                $detail = new IndentDetail();
                $detail->product_id = $product->id;
                $this->details[] = $detail;
            }
        }
    }

    public function removeProductAt($index) {
        array_splice($this->details, $index, 1);
    }

    public function validate() {
        $valid = $this->header->validate();

        if (count($this->details) > 0) {
            foreach ($this->details as $detail) {
                $fields = array('quantity', 'unit_price', 'product_id');
                $valid = $detail->validate($fields) && $valid;
            }
        } else
            $valid = false;

        return $valid;
    }

    public function save($runValidation) {
        $valid = $this->header->save($runValidation);

        foreach ($this->details as $detail) {
            $detail->indent_header_id = $this->header->id;
            $valid = $detail->save($runValidation) && $valid;
        }

        return $valid;
    }

    public function update() {
        $valid = $this->header->update();

        foreach ($this->details as $detail)
            $valid = $detail->update() && $valid;

        return $valid;
    }

    public function getGrandTotal() {
        $total = 0.00;
        foreach ($this->details as $detail)
            $total += $detail->total;

        return $total;
    }

    public function getSubTotalQuantity() {
        $total = 0.00;
        foreach ($this->details as $detail)
            $total += $detail->quantity;

        return $total;
    }
}
