<?php

class Expense extends CComponent {

    public $header;
    public $details;

    public function __construct() {
        $this->header = new ExpenseHeader();
        $this->details = array();
    }

    public function copyFromDb($id) {
        $this->header = ExpenseHeader::model()->resetScope()->findByPk($id);
        $this->details = ExpenseDetail::model()->resetScope()->findAllByAttributes(array('expense_header_id' => $id));
    }

    public function addAccount($id) {
        $account = Account::model()->findByPk($id);

        $exist = false;
        foreach ($this->details as $i => $detail) {
            if ($account->id === $detail->account_id) {
                $exist = true;
                break;
            }
        }

        if ($exist)
            $this->details[$i]->amount++;
        else {
            $detail = new ExpenseDetail();
            $detail->account_id = $account->id;
            $this->details[] = $detail;
        }
    }

    public function removeAccountAt($index) {
        array_splice($this->details, $index, 1);
    }

    public function validate() {
        $valid = $this->header->validate();

        if (count($this->details) > 0) {
            foreach ($this->details as $detail) {
                $fields = array('amount', 'memo');
                $valid = $detail->validate($fields) && $valid;
            }
        } else
            $valid = false;

        return $valid;
    }

    public function save($runValidation) {
        $valid = $this->header->save($runValidation);

        $taxConnection = TaxConnectionChecking::isCurrentConnectionPrimary() || (TaxConnectionChecking::isCurrentConnectionSecondary() && TaxConnectionChecking::nonTaxValid());
        if ($taxConnection) {
            $accountingJournalCredit = AccountingJournalHelper::make('credit', $this->header->number, $this->header->date, $this->header->account_id, $this->total);
            $valid = $accountingJournalCredit->save() && $valid;
        }

        foreach ($this->details as $detail) {
            $detail->expense_header_id = $this->header->id;
            $valid = $detail->save($runValidation) && $valid;

            if ($taxConnection) {
                $accountingJournalDebit = AccountingJournalHelper::make('debit', $this->header->number, $this->header->date, $detail->account_id, $detail->amount);
                $valid = $accountingJournalDebit->save() && $valid;
            }
        }

        return $valid;
    }

    public function update() {
        $valid = $this->header->update();

        foreach ($this->details as $detail)
            $valid = $detail->update() && $valid;

        return $valid;
    }

    public function getTotal() {
        $total = 0.00;
        foreach ($this->details as $detail)
            $total += $detail->amount;

        return $total;
    }
}
