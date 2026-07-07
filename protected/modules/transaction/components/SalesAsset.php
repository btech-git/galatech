<?php

class SalesAsset extends CComponent {

    public $header;
    public $details;

    public function __construct() {
        $this->header = new SalesAssetHeader();
        $this->details = array();
    }

    public function copyFromDb($id) {
        $this->header = SalesAssetHeader::model()->resetScope()->findByPk($id);
        $this->details = SalesAssetDetail::model()->resetScope()->findAllByAttributes(array('sales_asset_header_id' => $id));
    }

    public function removeProductAt($index) {
        array_splice($this->details, $index, 1);
    }

    public function validate() {
        $valid = $this->header->validate();

        if (count($this->details) > 0) {
            foreach ($this->details as $detail) {
                $fields = array('quantity', 'unit_price', 'asset_name');
                $valid = $detail->validate($fields) && $valid;
            }
        } else
            $valid = false;

        return $valid;
    }

    public function save($runValidation) {
        $valid = $this->header->save($runValidation);

        $journalTotal = $this->subTotal;

        $accountingJournalDebit = AccountingJournalHelper::make('debit', $this->header->number, 4, $journalTotal);
        $valid = $accountingJournalDebit->save() && $valid;
        $accountingJournalCredit = AccountingJournalHelper::make('credit', $this->header->number, 17, $journalTotal);
        $valid = $accountingJournalCredit->save() && $valid;

        foreach ($this->details as $detail) {
            $detail->sales_asset_header_id = $this->header->id;
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

    public function delete() {
        $valid = true;
        foreach ($this->details as $detail)
            $valid = $detail->delete() && $valid;

        $valid = $this->header->delete() && $valid;

        return $valid;
    }

    public function addItem() {
        $detail = new SalesAssetDetail;

        $this->details[] = $detail;
    }

    public function getSubTotal() {
        $total = 0.00;
        foreach ($this->details as $detail)
            $total += $detail->total;

        return $total;
    }
}
