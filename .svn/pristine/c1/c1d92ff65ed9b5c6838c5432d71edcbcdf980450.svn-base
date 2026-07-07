<?php

class SalesReturn extends CComponent {

    public $header;
    public $details;

    public function __construct() {
        $this->header = new SalesReturnHeader();
        $this->details = array();
    }

    public function copyFromDb($id) {
        $this->header = SalesReturnHeader::model()->resetScope()->findByPk($id);
        $this->details = SalesReturnDetail::model()->resetScope()->findAllByAttributes(array('sales_return_header_id' => $id));
    }

    public function addProductByInvoice($id) {
        $sql = 'SELECT delivery.product_id, delivery.unit_price AS unit_price
				FROM
				(
					SELECT h.id, d.quantity, d.unit_price, d.product_id
					FROM tblgt_delivery_header h
					INNER JOIN tblgt_delivery_detail d ON h.id = d.delivery_header_id
					WHERE h.is_inactive = 0 AND d.is_inactive = 0
				) delivery
				LEFT OUTER JOIN
				(
					SELECT h.delivery_header_id, h.id
					FROM tblgt_invoice_header h
					WHERE h.is_inactive = 0 
				) invoice
				ON delivery.id = invoice.delivery_header_id
				LEFT OUTER JOIN
				(
					SELECT h.invoice_header_id, d.quantity, d.product_id
					FROM tblgt_sales_return_header h
					INNER JOIN tblgt_sales_return_detail d ON h.id = d.sales_return_header_id
					WHERE h.is_inactive = 0 AND d.is_inactive = 0
				) returned
				ON invoice.id = returned.invoice_header_id
				AND delivery.product_id = returned.product_id
				INNER JOIN tblgt_product
				ON delivery.product_id = tblgt_product.id
				WHERE invoice.id = :invoice_id AND NOT (returned.product_id IS NOT NULL AND returned.invoice_header_id IS NULL)
				GROUP BY delivery.id, delivery.product_id';

        $resultSet = CActiveRecord::$db->createCommand($sql)->queryAll(true, array(':invoice_id' => $id));

        $this->details = array();

        foreach ($resultSet as $row) {
            $detail = new SalesReturnDetail();

            $detail->product_id = $row['product_id'];
            $detail->unit_price = $row['unit_price'];

            $this->details[] = $detail;
        }
    }

    public function removeProductAt($index) {
        array_splice($this->details, $index, 1);
    }

    public function validate() {
        $valid = $this->header->validate();

        if (count($this->details) > 0) {
            foreach ($this->details as $detail) {
                $fields = array('quantity', 'product_id');
                $valid = $detail->validate($fields) && $valid;
            }
        } else
            $valid = false;

        return $valid;
    }

    public function save($runValidation) {
        $valid = $this->header->save($runValidation);

        $accountingJournalDebit = AccountingJournalHelper::make('credit', $this->header->number, $this->header->date, $this->header->invoiceHeader->deliveryHeader->customer->account_id, $this->grandTotal);
        $valid = $accountingJournalDebit->save() && $valid;
        $accountingJournalCredit = AccountingJournalHelper::make('debit', $this->header->number, $this->header->date, 27, $this->subTotal);
        $valid = $accountingJournalCredit->save() && $valid;

        if ($this->calculatedTax > 0) {
            $journalTaxCredit = AccountingJournalHelper::make('debit', $this->header->number, $this->header->date, 173, $this->calculatedTax);
            $valid = $journalTaxCredit->save() && $valid;
        }

        if ($this->header->shipping_fee > 0) {
            $journalShippingCredit = AccountingJournalHelper::make('debit', $this->header->number, $this->header->date, 174, $this->header->shipping_fee);
            $valid = $journalShippingCredit->save() && $valid;
        }

        Inventory::model()->DeleteAllByAttributes(array('transaction_number' => $this->header->number));

        foreach ($this->details as $detail) {
            $detail->sales_return_header_id = $this->header->id;
            $valid = $detail->save($runValidation) && $valid;

            if ((int) $detail->is_inactive === 0) {
                $inventory = new Inventory();
                $inventory->transaction_number = $this->header->number;
                $inventory->transaction_type = 6;
                $inventory->transaction_subject = $this->header->invoiceHeader->deliveryHeader->customer->company;
                $inventory->product_id = $detail->product_id;
                $inventory->warehouse_id = $this->header->warehouse_id;
                $inventory->admin_id = $this->header->admin_id;
                $inventory->date = $this->header->date;
                $inventory->quantity_in = $detail->quantity;

                $valid = $inventory->save() && $valid;
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

    public function getSubTotal() {
        $total = 0.00;
        foreach ($this->details as $detail)
            $total += $detail->total;

        return $total;
    }

    public function getSubTotalQuantity() {
        $total = 0.00;
        foreach ($this->details as $detail)
            $total += $detail->quantity;

        return $total;
    }

    public function getCalculatedTax() {
        return ($this->subTotal) * ($this->header->tax / 100);
    }

    public function getGrandTotal() {
        return $this->subTotal + $this->calculatedTax + $this->header->shipping_fee;
    }
}
