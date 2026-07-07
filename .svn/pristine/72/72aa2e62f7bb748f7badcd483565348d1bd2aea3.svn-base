<?php

/**
 * This is the model class for table "tblgt_delivery_header".
 *
 * The followings are the available columns in table 'tblgt_delivery_header':
 * @property integer $id
 * @property string $number
 * @property string $date
 * @property integer $tax
 * @property string $discount
 * @property string $shipping_fee
 * @property string $downpayment_amount
 * @property string $driver
 * @property string $plate_number
 * @property string $note
 * @property integer $tax_type
 * @property integer $customer_id
 * @property integer $warehouse_id
 * @property integer $sales_downpayment_id
 * @property integer $admin_id
 * @property integer $is_non_tax
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property DeliveryDetail[] $deliveryDetails
 * @property Customer $customer
 * @property Admin $admin
 * @property Warehouse $warehouse
 * @property SalesDownpayment $salesDownpayment
 * @property InvoiceHeader[] $invoiceHeaders
 */
class DeliveryHeader extends ActiveRecord {

    const TAX_TYPE_INCLUDE = 1;
    const TAX_TYPE_EXCLUDE = 2;
    const TAX_TYPE_INCLUDE_LITERAL = 'Include PPn';
    const TAX_TYPE_EXCLUDE_LITERAL = 'Exclude PPn';
    
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return DeliveryHeader the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tblgt_delivery_header';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('number, date, customer_id, warehouse_id, admin_id', 'required'),
            array('tax, customer_id, warehouse_id, sales_downpayment_id, admin_id, is_non_tax, is_inactive, tax_type', 'numerical', 'integerOnly' => true),
            array('number, driver, plate_number', 'length', 'max' => 60),
            array('discount', 'length', 'max' => 10),
            array('shipping_fee, downpayment_amount', 'length', 'max' => 18),
            array('number', 'unique'),
            array('note', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, number, date, tax, discount, shipping_fee, downpayment_amount, driver, plate_number, note, customer_id, warehouse_id, sales_downpayment_id, admin_id, is_non_tax, is_inactive', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'deliveryDetails' => array(self::HAS_MANY, 'DeliveryDetail', 'delivery_header_id'),
            'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
            'admin' => array(self::BELONGS_TO, 'Admin', 'admin_id'),
            'warehouse' => array(self::BELONGS_TO, 'Warehouse', 'warehouse_id'),
            'salesDownpayment' => array(self::BELONGS_TO, 'SalesDownpayment', 'sales_downpayment_id'),
            'invoiceHeaders' => array(self::HAS_MANY, 'InvoiceHeader', 'delivery_header_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'number' => 'Number',
            'date' => 'Date',
            'tax' => 'Tax',
            'discount' => 'Discount',
            'shipping_fee' => 'Shipping Fee',
            'downpayment_amount' => 'Downpayment Amount',
            'driver' => 'Driver',
            'plate_number' => 'Plate Number',
            'note' => 'Note',
            'customer_id' => 'Customer',
            'warehouse_id' => 'Warehouse',
            'sales_downpayment_id' => 'Sales Downpayment',
            'admin_id' => 'Admin',
            'is_non_tax' => 'Is Non Tax',
            'is_inactive' => 'Is Inactive',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('number', $this->number, true);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('tax', $this->tax);
        $criteria->compare('discount', $this->discount, true);
        $criteria->compare('shipping_fee', $this->shipping_fee, true);
        $criteria->compare('downpayment_amount', $this->downpayment_amount, true);
        $criteria->compare('driver', $this->driver, true);
        $criteria->compare('plate_number', $this->plate_number, true);
        $criteria->compare('note', $this->note, true);
        $criteria->compare('tax_type', $this->tax_type);
        $criteria->compare('customer_id', $this->customer_id);
        $criteria->compare('warehouse_id', $this->warehouse_id);
        $criteria->compare('sales_downpayment_id', $this->sales_downpayment_id);
        $criteria->compare('admin_id', $this->admin_id);
        $criteria->compare('is_non_tax', $this->is_non_tax);
        $criteria->compare('is_inactive', $this->is_inactive);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchByInvoice($nt) {
        $criteria = new CDbCriteria;

//		$nonTax = $nt ? 1 : 0;
        $criteria->condition = "t.id NOT IN ("
                . "SELECT delivery_header_id "
                . "FROM tblgt_invoice_header "
                . "WHERE is_inactive = 0"
        . ") AND t.is_non_tax = {$nt}";

        $criteria->compare('number', $this->number, true);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('customer_id', $this->customer_id);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }

    public function searchBySalesReturn() {
        $criteria = new CDbCriteria;

        $criteria->condition = 'EXISTS (
            SELECT delivery.quantity - COALESCE(returned.quantity, 0) AS quantity_sold
            FROM (
                SELECT h.id, d.quantity, d.product_id
                FROM tblgt_delivery_header h 
                INNER JOIN tblgt_delivery_detail d ON h.id = d.delivery_header_id
                WHERE h.is_inactive = 0 AND d.is_inactive = 0
            ) delivery
            LEFT OUTER JOIN
            (
                    SELECT rh.delivery_header_id, SUM(COALESCE(rd.quantity, 0)) AS quantity, rd.product_id
                    FROM tblgt_sales_return_header rh
                    INNER JOIN tblgt_sales_return_detail rd ON rh.id = rd.sales_return_header_id
                    WHERE rh.is_inactive = 0 AND rd.is_inactive = 0
                    GROUP BY rh.delivery_header_id, rd.product_id
            ) returned
            ON delivery.id = returned.delivery_header_id
            AND delivery.product_id = returned.product_id
            WHERE t.id = delivery.id
            HAVING quantity_sold > 0
        )';

        $criteria->compare('number', $this->number, true);
        $criteria->compare('date', $this->date, true);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }

    public function getSubTotal() {
        $total = 0.00;
        foreach ($this->deliveryDetails as $detail) {
            if ($detail->is_inactive == 0) {
                $total += $detail->getTotal();
            }
        }

        return $total;
    }

    public function getSubTotalQuantity() {
        $total = 0.00;
        foreach ($this->deliveryDetails as $detail) {
            $total += $detail->quantity;
        }

        return $total;
    }

    public function getCalculatedDiscount() {
        return $this->subTotal * $this->discount / 100;
    }

    public function getCalculatedTax() {
        return $this->totalBeforeTax * $this->tax / 100;
    }

    public function getGrandTotal() {
        return $this->totalBeforeTax + $this->calculatedTax + $this->shipping_fee;
    }

    public function getTotalBeforeTax() {
        return $this->subTotal - $this->calculatedDiscount - (($this->salesDownpayment === null) ? 0 : $this->downpayment_amount);
    }

    public function getSubTotalPayment() {
        $subTotal = $this->subTotal;

        foreach ($this->invoiceHeaders as $invoiceHeader) {
            foreach ($invoiceHeader->salesReturnHeaders as $salesReturnHeader) {
                foreach ($salesReturnHeader->salesReturnDetails as $detail) {
                    $subTotal -= $detail->total;
                }
            }
        }

        return $subTotal;
    }

    public function getCalculatedDiscountPayment() {
        return $this->subTotalPayment * $this->discount / 100;
    }

    public function getTotalBeforeTaxPayment() {
        return $this->subTotalPayment - $this->calculatedDiscountPayment - (($this->salesDownpayment === null) ? 0 : $this->downpayment_amount);
    }

    public function getCalculatedTaxPayment() {
        return $this->totalBeforeTaxPayment * $this->tax / 100;
    }

    public function getGrandTotalPayment() {
        return $this->totalBeforeTaxPayment + $this->calculatedTaxPayment + $this->shipping_fee;
    }

    public function getAveragePurchasePriceTotalSum() {
        $total = 0.00;
 
        foreach ($this->deliveryDetails as $detail) {
            $total += $detail->averagePurchasePriceTotal;
        }

        return $total;
    }

    public function getProfitLoss() {
        return $this->grandTotalPayment - $this->averagePurchasePriceTotalSum;
    }
}
