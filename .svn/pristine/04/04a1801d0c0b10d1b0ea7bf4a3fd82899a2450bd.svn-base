<?php

class JournalVoucher extends CComponent {

    public $header;
    public $details;

    public function __construct() {
        $this->header = new JournalVoucherHeader();
        $this->details = array();
    }

    public function copyFromDb($id) {
        $this->header = JournalVoucherHeader::model()->resetScope()->findByPk($id);
        $this->details = JournalVoucherDetail::model()->resetScope()->findAllByAttributes(array('journal_voucher_header_id' => $id));
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
            $this->details[$i]->debit++;
        else {
            $detail = new JournalVoucherDetail();
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
                $fields = array('debit', 'credit', 'account_id');
                $valid = $detail->validate($fields) && $valid;
            }
        } else
            $valid = false;

        return $valid;
    }

    public function save($runValidation) {
        AccountingJournal::model()->deleteAllByAttributes(array('transaction_number' => $this->header->number));

        if ($this->header->isNewRecord)
            $this->header->number = CodeNumber::make($this->header, 'number', 'JV');

        $valid = $this->header->save($runValidation);

        foreach ($this->details as $detail) {
            $detail->journal_voucher_header_id = $this->header->id;
            $valid = $detail->save($runValidation) && $valid;

            if ($detail->is_inactive === 0) {
                if (TaxConnectionChecking::isCurrentConnectionPrimary() || (TaxConnectionChecking::isCurrentConnectionSecondary() && TaxConnectionChecking::nonTaxValid())) {
                    $accountingJournalDebit = AccountingJournalHelper::make(
                                    'debit',
                                    $this->header->number,
                                    $this->header->date,
                                    $detail->account_id,
                                    $detail->debit
                    );
                    $valid = $accountingJournalDebit->save() && $valid;

                    $accountingJournalCredit = AccountingJournalHelper::make(
                                    'credit',
                                    $this->header->number,
                                    $this->header->date,
                                    $detail->account_id,
                                    $detail->credit
                    );
                    $valid = $accountingJournalCredit->save() && $valid;
                }
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

    public function getTotalDebit() {
        $total = 0.00;
        foreach ($this->details as $detail)
            $total += $detail->debit;

        return $total;
    }

    public function getTotalCredit() {
        $total = 0.00;
        foreach ($this->details as $detail)
            $total += $detail->credit;

        return $total;
    }
}
