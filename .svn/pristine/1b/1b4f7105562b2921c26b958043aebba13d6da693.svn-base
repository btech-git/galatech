<?php

class SalesCheque extends CComponent {

    public $header;
    public $details;

    public function __construct() {
        $this->header = new SalesChequeHeader();
        $this->details = array();
    }

    public function copyFromDb($id) {
        $this->header = SalesChequeHeader::model()->resetScope()->findByPk($id);
        $this->details = SalesChequeDetail::model()->resetScope()->findAllByAttributes(array('sales_cheque_header_id' => $id));
    }

    public function addSalesReceipt($id) {
        $receiptHeader = ReceiptHeader::model()->findByPk($id);

        if ($receiptHeader !== null) {
            $exist = false;
            foreach ($this->details as $i => $detail) {
                if ($receiptHeader->id === $detail->receipt_header_id) {
                    $exist = true;
                    break;
                }
            }

            if ($receiptHeader->customer_id !== $this->header->customer_id)
                $exist = true;

            if (!$exist) {
                $detail = new SalesChequeDetail();
                $detail->receipt_header_id = $receiptHeader->id;
                $this->details[] = $detail;
            }
        }
    }

    public function resetDetail() {
        $this->details = array();
    }

    public function removeDetailAt($index) {
        array_splice($this->details, $index, 1);
    }

    public function validate() {
        $valid = $this->header->validate();

        if (count($this->details) > 0) {
            foreach ($this->details as $detail) {
                $fields = array('cheque_number', 'amount', 'account_id');
                $valid = $detail->validate($fields) && $valid;
            }
        } else
            $valid = false;

        return $valid;
    }

    public function save($runValidation) {
        $valid = $this->header->save($runValidation);

        foreach ($this->details as $detail) {
            $detail->sales_cheque_header_id = $this->header->id;
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

    public function getTotalReceipt() {
        $total = 0.00;

        foreach ($this->details as $detail)
            $total += $detail->receiptHeader->totalInvoice;

        return $total;
    }

    public function getTotal() {
        $total = 0.00;

        foreach ($this->details as $detail)
            $total += $detail->amount;

        return $total;
    }
}

?>
