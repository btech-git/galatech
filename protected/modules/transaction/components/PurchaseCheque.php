<?php

class PurchaseCheque extends CComponent {

    public $header;
    public $details;

    public function __construct() {
        $this->header = new PurchaseChequeHeader();
        $this->details = array();
    }

    public function copyFromDb($id) {
        $this->header = PurchaseChequeHeader::model()->resetScope()->findByPk($id);
        $this->details = PurchaseChequeDetail::model()->resetScope()->findAllByAttributes(array('purchase_cheque_header_id' => $id));
    }

    public function addPurchaseReceipt($id) {
        $purchaseReceipt = PurchaseReceiptHeader::model()->findByPk($id);

        if ($purchaseReceipt !== null) {
            $exist = false;
            foreach ($this->details as $i => $detail) {
                if ($purchaseReceipt->id === $detail->purchase_receipt_header_id) {
                    $exist = true;
                    break;
                }
            }

            if ($purchaseReceipt->supplier_id !== $this->header->supplier_id)
                $exist = true;

            if (!$exist) {
                $detail = new PurchaseChequeDetail();
                $detail->purchase_receipt_header_id = $purchaseReceipt->id;
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
                $fields = array('cheque_number', 'amount', 'bank_id');
                $valid = $detail->validate($fields) && $valid;
            }
        } else
            $valid = false;

        return $valid;
    }

    public function save($runValidation) {
        $valid = $this->header->save($runValidation);

        foreach ($this->details as $detail) {
            $detail->purchase_cheque_header_id = $this->header->id;
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
            $total += $detail->purchaseReceiptHeader->totalPurchase;

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
