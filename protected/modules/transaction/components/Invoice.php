<?php

class Invoice extends CComponent {

    public $header;

    public function __construct() {
        $this->header = new InvoiceHeader();
    }

    public function copyFromDb($id) {
        $this->header = InvoiceHeader::model()->resetScope()->findByPk($id);
    }

    public function validate() {
        $valid = $this->header->validate();

        return $valid;
    }

    public function save($runValidation) {
        $valid = $this->header->save($runValidation);

        $yearNow = date('y');

        $taxFormFound = TaxForm::model()->findByAttributes(array('invoice_header_id' => $this->header->id));
        if ($taxFormFound === null) {
            $taxForm = new TaxForm();
            $taxForm->invoice_header_id = $this->header->id;
            CodeNumber::setTaxNumber($taxForm, 2);
            $taxForm->admin_id = Yii::app()->user->id;
            $taxForm->save($runValidation);
        } else {
            $taxForm = $taxFormFound;
        }

        return $valid;
    }
}
