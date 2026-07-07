<?php

/**
 * This is the model class for table "tblgt_purchase_header".
 *
 * The followings are the available columns in table 'tblgt_purchase_header':
 * @property integer $id
 * @property string $number
 * @property string $date
 * @property integer $total_quantity
 * @property integer $total_quantity_received
 * @property integer $total_quantity_received_remaining
 * @property integer $tax
 * @property string $discount
 * @property string $shipping_fee
 * @property string $note
 * @property integer $admin_id
 * @property integer $supplier_id
 * @property integer $tax_type
 * @property integer $is_non_tax
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property PurchaseDetail[] $purchaseDetails
 * @property Supplier $supplier
 * @property Admin $admin
 * @property PurchaseInvoice[] $purchaseInvoices
 * @property ReceiveHeader[] $receiveHeaders
 */
class PurchaseHeader extends ActiveRecord {

    const TAX_TYPE_INCLUDE = 1;
    const TAX_TYPE_EXCLUDE = 2;
    const TAX_TYPE_INCLUDE_LITERAL = 'Include PPn';
    const TAX_TYPE_EXCLUDE_LITERAL = 'Exclude PPn';
    
    /**
     * Returns the static model of the specified AR class.
     * @return PurchaseHeader the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tblgt_purchase_header';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('number, date, admin_id, supplier_id', 'required'),
            array('total_quantity, total_quantity_received, total_quantity_received_remaining, tax, admin_id, supplier_id, is_non_tax, tax_type, is_inactive', 'numerical', 'integerOnly' => true),
            array('number', 'length', 'max' => 60),
            array('discount', 'length', 'max' => 10),
            array('shipping_fee', 'length', 'max' => 18),
            array('supplier_id', 'exist', 'className' => 'Supplier', 'attributeName' => 'id'),
            array('note', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, number, date, total_quantity, total_quantity_received, total_quantity_received_remaining, tax, discount, shipping_fee, note, admin_id, supplier_id, tax_type, is_non_tax, is_inactive', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'purchaseDetails' => array(self::HAS_MANY, 'PurchaseDetail', 'purchase_header_id'),
            'supplier' => array(self::BELONGS_TO, 'Supplier', 'supplier_id'),
            'admin' => array(self::BELONGS_TO, 'Admin', 'admin_id'),
            'purchaseInvoices' => array(self::HAS_MANY, 'PurchaseInvoice', 'purchase_header_id'),
            'receiveHeaders' => array(self::HAS_MANY, 'ReceiveHeader', 'purchase_header_id'),
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
            'note' => 'Note',
            'admin_id' => 'Admin',
            'supplier_id' => 'Supplier',
            'tax_type' => 'Type',
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
        $criteria->compare('note', $this->note, true);
        $criteria->compare('admin_id', $this->admin_id);
        $criteria->compare('supplier_id', $this->supplier_id);
        $criteria->compare('tax_type', $this->tax_type);
        $criteria->compare('is_non_tax', $this->is_non_tax);
        $criteria->compare('is_inactive', $this->is_inactive);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchByItemReceived($isNonTax = null) {
        $criteria = new CDbCriteria;

//        $criteria->condition = "EXISTS (
//			SELECT p.quantity - SUM(COALESCE(r.quantity, 0)) AS quantity_purchased
//			FROM " . PurchaseDetail::model()->tableName() . " p
//			LEFT OUTER JOIN " . ReceiveDetail::model()->tableName() . " r
//			ON p.id = r.purchase_detail_id
//			WHERE t.id = p.purchase_header_id AND p.is_inactive = 0
//			GROUP BY p.id
//			HAVING quantity_purchased > 0
//		)";
        
        
        $criteria->addCondition('t.total_quantity_received_remaining > 0');

        if ($isNonTax !== null) {
            $criteria->addCondition('t.is_non_tax = :is_non_tax');
            $criteria->params[':is_non_tax'] = intval($isNonTax);
        }

        $criteria->compare('number', $this->number, true);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('supplier_id', $this->supplier_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchByPurchaseInvoice() {
        $criteria = new CDbCriteria;

        $criteria->condition = "t.id NOT IN (SELECT purchase_header_id FROM tblgt_purchase_invoice WHERE is_inactive = 0) AND t.date > '2023-12-31'";

        $criteria->compare('t.number', $this->number, true);
        $criteria->compare('t.date', $this->date, true);
        $criteria->compare('t.supplier_id', $this->supplier_id);
        $criteria->compare('t.is_inactive', 0);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }

    public function getSubTotal() {
        $total = 0.00;
        foreach ($this->purchaseDetails as $detail) {
            if ($detail->is_inactive == 0) {
                $total += $detail->getTotal();
            }
        }

        return $total;
    }

    public function getSubTotalQuantity() {
        $total = 0.00;
        foreach ($this->purchaseDetails as $detail) {
            $total += $detail->quantity;
        }

        return $total;
    }

    public function getCalculatedDiscount() {
        return $this->subTotal * $this->discount / 100;
    }

    public function getCalculatedTax() {
        return ($this->subTotal - $this->calculatedDiscount) * ($this->tax / 100);
    }

    public function getGrandTotal() {
        return $this->subTotal - $this->calculatedDiscount + $this->calculatedTax + $this->shipping_fee;
    }

    public function getTotalPayment() {
        $total = $this->grandTotal;

        foreach ($this->purchaseInvoices as $purchaseInvoice) {
            foreach ($purchaseInvoice->purchaseReturnHeaders as $purchaseReturnHeader) {
                foreach ($purchaseReturnHeader->purchaseReturnDetails as $detail) {
                    $total -= $detail->total;
                }
            }
        }

        return $total;
    }
    
    public function getTaxTypeLiteral() {
        return ($this->tax_type == self::TAX_TYPE_INCLUDE) ? self::TAX_TYPE_INCLUDE_LITERAL : self::TAX_TYPE_EXCLUDE_LITERAL;
    }
    
    public function getTotalQuantityReceived() {
        $total = 0;
        
        foreach ($this->purchaseDetails as $detail) {
            if ($detail->is_inactive == 0) {
                $total += $detail->quantity_received;
            }
        }
        
        return $total;
    }
}
