<?php

class PurchasePayment extends CComponent {

    public $header;
    public $details;
    public $extras;

    public function __construct() {
        $this->header = new PurchasePaymentHeaderRev();
        $this->details = array();
        $this->extras = array();
    }

    public function copyFromDb($id) {
        $this->header = PurchasePaymentHeaderRev::model()->resetScope()->findByPk($id);
        $this->details = PurchasePaymentDetailRev::model()->resetScope()->findAllByAttributes(array('purchase_payment_header_rev_id' => $id));
        $this->extras = PurchasePaymentExtra::model()->resetScope()->findAllByAttributes(array('purchase_payment_header_rev_id' => $id));
    }

    public function validate() {
        $valid = $this->header->validate();

        if (count($this->details) > 0) {
            foreach ($this->details as $detail) {
                $fields = array('purchase_receipt_header_id');
                $valid = $detail->validate($fields) && $valid;
            }

            foreach ($this->extras as $extra) {
                $fields = array('amount', 'account_id');
                $valid = $extra->validate($fields) && $valid;
            }
        } else
            $valid = false;

        return $valid;
    }

    public function save($runValidation) {
        $valid = $this->header->save($runValidation);

        $taxConnection = TaxConnectionChecking::isCurrentConnectionPrimary() || (TaxConnectionChecking::isCurrentConnectionSecondary() && TaxConnectionChecking::nonTaxValid());
        if ($taxConnection) {
            $accountingJournalDebit = AccountingJournalHelper::make(
                            'debit',
                            $this->header->number,
                            $this->header->date,
                            $this->header->supplier->account_id,
                            $this->totalPayment
            );
            $valid = $accountingJournalDebit->save() && $valid;
        }

        foreach ($this->details as $detail) {
            $detail->purchase_payment_header_rev_id = $this->header->id;
            $valid = $detail->save($runValidation) && $valid;

            if ($taxConnection) {
                $accountingJournalCredit = AccountingJournalHelper::make(
                                'credit',
                                $this->header->number,
                                $this->header->date,
                                $detail->account_id,
                                $detail->amount
                );
                $valid = $accountingJournalCredit->save() && $valid;
            }

            $purchaseReceiptHeader = PurchaseReceiptHeader::model()->findByPk($detail->purchase_receipt_header_id);
            $purchaseReceiptHeader->total_payment = $purchaseReceiptHeader->getPayment();
            $purchaseReceiptHeader->update(array('total_payment'));
        }

        foreach ($this->extras as $extra) {
            $extra->purchase_payment_header_rev_id = $this->header->id;
            $valid = $extra->save($runValidation) && $valid;

            if ($taxConnection) {
                $accountingJournalCredit = AccountingJournalHelper::make(
                                'credit',
                                $this->header->number,
                                $this->header->date,
                                $extra->account_id,
                                $extra->amount
                );
                $valid = $accountingJournalCredit->save() && $valid;
            }
        }

        return $valid;
    }

    public function update() {
        $valid = $this->header->update();

        foreach ($this->details as $detail) {
            $valid = $detail->update() && $valid;

            $purchaseReceiptHeader = PurchaseReceiptHeader::model()->findByPk($detail->purchase_receipt_header_id);
            $purchaseReceiptHeader->total_payment = $detail->amount;
            $purchaseReceiptHeader->update(array('total_payment'));
        }

        foreach ($this->extras as $extra)
            $valid = $extra->update() && $valid;

        return $valid;
    }

    public function addPurchaseReceiptHeader($id) {
        $purchaseReceiptHeader = PurchaseReceiptHeader::model()->findByPk($id);

        if ($purchaseReceiptHeader !== null) {
            $exist = false;
            foreach ($this->details as $i => $detail) {
                if ($purchaseReceiptHeader->id === $detail->purchase_receipt_header_id) {
                    $exist = true;
                    break;
                }
            }

            if ($purchaseReceiptHeader->supplier_id !== $this->header->supplier_id)
                $exist = true;

            if (!$exist) {
                $detail = new PurchasePaymentDetailRev();
                $detail->purchase_receipt_header_id = $purchaseReceiptHeader->id;
                $this->details[] = $detail;
            }
        }
    }

    public function addAccount($id) {
        $account = Account::model()->findByPk($id);

        if ($account !== null) {
            $exist = false;
            foreach ($this->extras as $i => $extra) {
                if ($account->id === $extra->account_id) {
                    $exist = true;
                    break;
                }
            }

            if ($exist)
                $this->extras[$i]->amount++;
            else {
                $extra = new PurchasePaymentExtra();
                $extra->account_id = $account->id;
                $this->extras[] = $extra;
            }
        }
    }

    public function resetDetail() {
        $this->details = array();
    }

    public function removePaymentAt($index) {
        array_splice($this->details, $index, 1);
    }

    public function removeExtraAt($index) {
        array_splice($this->extras, $index, 1);
    }

    public function getTotalReceipt() {
        $total = 0.00;

        foreach ($this->details as $detail)
            $total += $detail->purchaseReceiptHeader->totalPurchase;

        return $total;
    }

//	public function getTotalPurchase()
//	{
//		$total = 0.00;
//		
//		foreach ($this->details as $detail)
//			$total += ($detail->purchaseReceiptHeader === null) ? 0.00 : $detail->purchaseReceiptHeader->totalPurchase;
//
//		return $total;
//	}

    public function getPayment() {
        $total = 0.00;

        foreach ($this->details as $detail)
            $total += $detail->amount;

        return $total;
    }

    public function getTotalExtras() {
        $total = 0.00;
        foreach ($this->extras as $extras)
            $total += $extras->amount;

        return $total;
    }

    public function getTotalPayment() {
        return $this->payment + $this->totalExtras;
    }
}
