<?php

/**
 * This is the model class for table "tblgt_purchase_payment_header".
 *
 * The followings are the available columns in table 'tblgt_purchase_payment_header':
 * @property integer $id
 * @property string $number
 * @property string $date
 * @property string $note
 * @property integer $purchase_receipt_header_id
 * @property integer $admin_id
 * @property integer $is_non_tax
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property PurchasePaymentDetail[] $purchasePaymentDetails
 * @property Admin $admin
 * @property PurchaseReceiptHeader $purchaseReceiptHeader
 */
class PurchasePaymentHeader extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PurchasePaymentHeader the static model class
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
		return 'tblgt_purchase_payment_header';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number, date, purchase_receipt_header_id, admin_id', 'required'),
			array('purchase_receipt_header_id, admin_id, is_non_tax, is_inactive', 'numerical', 'integerOnly'=>true),
			array('number', 'length', 'max'=>60),
			array('note', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, number, date, note, purchase_receipt_header_id, admin_id, is_non_tax, is_inactive', 'safe', 'on'=>'search'),
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
			'purchasePaymentDetails' => array(self::HAS_MANY, 'PurchasePaymentDetail', 'purchase_payment_header_id'),
			'admin' => array(self::BELONGS_TO, 'Admin', 'admin_id'),
			'purchaseReceiptHeader' => array(self::BELONGS_TO, 'PurchaseReceiptHeader', 'purchase_receipt_header_id'),
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
			'note' => 'Note',
			'purchase_receipt_header_id' => 'Purchase Receipt Header',
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
		$criteria->compare('t.number',$this->number,true);
		$criteria->compare('t.date',$this->date,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('purchase_receipt_header_id',$this->purchase_receipt_header_id);
		$criteria->compare('admin_id',$this->admin_id);
		$criteria->compare('is_non_tax',$this->is_non_tax);
		$criteria->compare('is_inactive',$this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getTotalPurchase()
	{
		return $total = ($this->purchaseReceiptHeader === null) ? 0.00 : $this->purchaseReceiptHeader->totalPurchase;
	}
	
	public function getPayment()
	{
		$payment = 0.00;

		foreach ($this->purchasePaymentDetails as $detail)
//			$payment += $detail->amount;
				$payment += $detail->purchaseReceiptHeader->totalPurchase;

		return $payment;
	}

	public function getRemaining()
	{
		return $this->totalPurchase - $this->payment;
	}

	public function getAmountPaid()
	{
		$total = 0.00;

		foreach ($this->purchasePaymentDetails as $detail)
//			$total += $detail->amount;
			$total += $detail->purchaseReceiptHeader->totalPurchase;

		return $total;
	}
}