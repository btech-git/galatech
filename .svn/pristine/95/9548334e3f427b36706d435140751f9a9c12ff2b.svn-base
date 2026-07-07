<?php

class AccountingJournalHelper extends CComponent
{
	public static function make($type, $transactionNumber, $date, $accountId, $total)
	{
		$accountingJournalFound = AccountingJournal::model()->findByAttributes(array('transaction_number' => $transactionNumber, 'account_id' => $accountId));
		if ($accountingJournalFound === null)
		{
			$accountingJournal = new AccountingJournal();
			$accountingJournal->transaction_number = $transactionNumber;
			$accountingJournal->account_id = $accountId;
			$accountingJournal->date = date(DATE_ATOM);
			$accountingJournal->admin_id = Yii::app()->user->id;
		}
		else
			$accountingJournal = $accountingJournalFound;

		$accountingJournal->$type = $total;

		return $accountingJournal;
	}
}