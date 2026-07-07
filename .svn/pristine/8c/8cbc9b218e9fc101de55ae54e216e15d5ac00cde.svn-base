<?php

class SalesDownpaymentTransaction extends CComponent {

    public $header;

    public function __construct() {
        $this->header = new SalesDownpayment();
    }

    public function copyFromDb($id) {
        $this->header = SalesDownpayment::model()->resetScope()->findByPk($id);
    }

    public function validate() {
        $valid = $this->header->validate();

        return $valid;
    }

    public function save($runValidation) {
        $valid = $this->header->save($runValidation);

        if (TaxConnectionChecking::isCurrentConnectionPrimary() || (TaxConnectionChecking::isCurrentConnectionSecondary() && TaxConnectionChecking::nonTaxValid())) {
            $accountingJournalDebit = AccountingJournalHelper::make('debit', $this->header->number, $this->header->date, $this->header->account_id, $this->header->grandTotal);
            $valid = $accountingJournalDebit->save() && $valid;
            $accountingJournalCredit = AccountingJournalHelper::make('credit', $this->header->number, $this->header->date, 27, $this->header->amount);
            $valid = $accountingJournalCredit->save() && $valid;
            $accountingJournalCredit = AccountingJournalHelper::make('credit', $this->header->number, $this->header->date, 173, $this->header->calculatedTax);
            $valid = $accountingJournalCredit->save() && $valid;
        }

        $taxFormFound = TaxForm::model()->findByAttributes(array('sales_downpayment_id' => $this->header->id));
        if ($taxFormFound === null) {
            $taxForm = new TaxForm();
            $taxForm->sales_downpayment_id = $this->header->id;
            CodeNumber::setTaxNumber($taxForm, 1);
            $taxForm->admin_id = Yii::app()->user->id;
            $taxForm->save($runValidation);
        } else {
            $taxForm = $taxFormFound;
        }

        return $valid;
    }

    public function update() {
        $valid = $this->header->update();

        return $valid;
    }

    public function getCalculatedTax1() {
        return $this->amount * $this->tax / 100;
    }

    public function GrandTotal() {
        return $this->amount + $this->calculatedTax;
    }
}
