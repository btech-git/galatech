<?php

class TaxFormRevised extends CComponent
{
	public $header;
	public $details;

	public function __construct()
	{
		$this->header = new TaxFormRevisedHeader();
		$this->details = array();
	}

	public function copyFromDb($id)
	{
		$this->header = TaxFormRevisedHeader::model()->resetScope()->findByPk($id);
		$this->details = TaxFormRevisedDetail::model()->resetScope()->findAllByAttributes(array('tax_form_revised_header_id' => $id));
	}

	public function addItemByTaxFormRevised($id)
	{
		$sql = 'SELECT delivery.tax, delivery.shipping_fee, delivery.discount_header, delivery.quantity, delivery.unit_price, delivery.discount_detail, delivery.product_id
                        FROM
                        (
                                (
                                        SELECT h.id, h.tax, h.shipping_fee, h.discount AS discount_header, d.quantity, d.unit_price, d.discount AS discount_detail, d.product_id
                                        FROM tblgt_delivery_header h
                                        INNER JOIN tblgt_delivery_detail d ON h.id = d.delivery_header_id
                                        WHERE h.is_inactive = 0 AND d.is_inactive = 0
                                ) delivery
                                LEFT OUTER JOIN
                                (
                                        SELECT delivery_header_id
                                        FROM tblgt_invoice_header
                                        WHERE is_inactive = 0
                                ) invoice
                                ON delivery.id = invoice.delivery_header_id
                                LEFT OUTER JOIN
                                (
                                        SELECT invoice_header_id
                                        FROM tblgt_invoice_header
                                        WHERE is_inactive = 0
                                ) tax_form
                                ON invoice.id = tax_form.invoice_header_id
                                LEFT OUTER JOIN
                                (
                                        SELECT tax_form_id
                                        FROM tblgt_tax_form_revised_header
                                        WHERE is_inactive = 0
                                ) tax_form_revised
                                ON tax_form.id = tax_form_revised.tax_form_id
                        )
                        WHERE taxForm.id = :tax_form_id AND NOT (taxFormRevised.tax_form_id IS NULL)
                        GROUP BY delivery.id, delivery.product_id';

		$resultSet = CActiveRecord::$db->createCommand($sql)->queryAll(true, array(':purchase_id' => $id));

		$this->details = array();

		foreach ($resultSet as $row)
		{
			$detail = new TaxFormRevisedDetail();

			$detail->name = $row['product_id'];
			$detail->price = $row['unit_price'];

			$this->details[] = $detail;
		}
	}

	public function removeProductAt($index)
	{
		array_splice($this->details, $index, 1);
	}

	public function validate()
	{
		$valid = $this->header->validate();

		if (count($this->details) > 0)
		{
			foreach ($this->details as $detail)
			{
//                                $fields = array('quantity', 'unit_price', 'product_id');
				$valid = $detail->validate($fields) && $valid;
			}
		}
		else
			$valid = false;

		return $valid;
	}

	public function save($runValidation)
	{
		$valid = $this->header->save($runValidation);

		foreach ($this->details as $detail)
		{
			$detail->receive_header_id = $this->header->id;
			$valid = $detail->save($runValidation) && $valid;

//                        $inventoryFound = Inventory::model()->findByAttributes(array('transaction_number'=>$this->header->number, 'product_id'=>$detail->product_id));
//                        if ($inventoryFound === null)
//                        {
//                                $inventory = new Inventory();
//                                $inventory->transaction_number = $this->header->number;
//                                $inventory->transaction_type = 1;
//                                $inventory->product_id = $detail->product_id;
//                                $inventory->admin_id = 1; //Yii::app()->user->id;
//                        }
//                        else
//                                $inventory = $inventoryFound;
//                        
//                        $inventory->date = $this->header->date;
//                        $inventory->quantity_in = $detail->quantity;
//                        
//                        $valid = $inventory->save() && $valid;
		}

//                $valid = $accountingJournalDebit->save() && $valid;
//                $valid = $accountingJournalCredit->save() && $valid;

		return $valid;
	}

	public function update()
	{
		$valid = $this->header->update();

		foreach ($this->details as $detail)
			$valid = $detail->update() && $valid;

		return $valid;
	}

	public function delete()
	{
		$valid = true;
		foreach ($this->details as $detail)
			$valid = $detail->delete() && $valid;

		$valid = $this->header->delete() && $valid;

		return $valid;
	}
}
