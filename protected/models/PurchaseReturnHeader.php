<?php

/**
 * This is the model class for table "tblgt_purchase_return_header".
 *
 * The followings are the available columns in table 'tblgt_purchase_return_header':
 * @property integer $id
 * @property string $number
 * @property string $date
 * @property integer $tax
 * @property string $shipping_fee
 * @property string $note
 * @property integer $purchase_invoice_id
 * @property integer $warehouse_id
 * @property integer $admin_id
 * @property integer $is_non_tax
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property PurchaseReturnDetail[] $purchaseReturnDetails
 * @property Admin $admin
 * @property PurchaseInvoice $purchaseInvoice
 * @property Warehouse $warehouse
 */
class PurchaseReturnHeader extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PurchaseReturnHeader the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tblgt_purchase_return_header';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number, date, purchase_invoice_id, admin_id', 'required'),
			array('tax, purchase_invoice_id, warehouse_id, admin_id, is_non_tax, is_inactive', 'numerical', 'integerOnly'=>true),
			array('number', 'length', 'max'=>60),
			array('shipping_fee', 'length', 'max'=>18),
			array('note', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, number, date, tax, shipping_fee, note, purchase_invoice_id, warehouse_id, admin_id, is_non_tax, is_inactive', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'purchaseReturnDetails' => array(self::HAS_MANY, 'PurchaseReturnDetail', 'purchase_return_header_id'),
			'admin' => array(self::BELONGS_TO, 'Admin', 'admin_id'),
			'purchaseInvoice' => array(self::BELONGS_TO, 'PurchaseInvoice', 'purchase_invoice_id'),
			'warehouse' => array(self::BELONGS_TO, 'Warehouse', 'warehouse_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'number' => 'Number',
			'date' => 'Date',
			'tax' => 'Tax',
			'shipping_fee' => 'Shipping Fee',
			'note' => 'Note',
			'purchase_invoice_id' => 'Purchase Invoice',
			'warehouse_id' => 'Warehouse',
			'admin_id' => 'Admin',
			'is_non_tax' => 'Is Non Tax',
			'is_inactive' => 'Is Inactive',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('number',$this->number,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('tax',$this->tax);
		$criteria->compare('shipping_fee',$this->shipping_fee,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('purchase_invoice_id',$this->purchase_invoice_id);
		$criteria->compare('warehouse_id',$this->warehouse_id);
		$criteria->compare('admin_id',$this->admin_id);
		$criteria->compare('is_non_tax',$this->is_non_tax);
		$criteria->compare('is_inactive',$this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getSubTotal()
	{
		$total = 0.00;

		foreach ($this->purchaseReturnDetails as $detail)
			$total += $detail->total;

		return $total;
	}
        
        public function getSubTotalQuantity()
	{
		$total = 0.00;
		foreach ($this->purchaseReturnDetails as $detail)
			$total += $detail->quantity;

		return $total;
	}
	
	public function getCalculatedTax()
	{
		return ($this->subTotal) * ($this->tax / 100);
	}
	
	public function getGrandTotal()
	{
		return $this->subTotal + $this->calculatedTax + $this->shipping_fee;
	}
}