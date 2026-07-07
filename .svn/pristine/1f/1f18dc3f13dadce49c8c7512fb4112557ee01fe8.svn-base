<?php

/**
 * This is the model class for table "tblgt_sales_payment_header_rev".
 *
 * The followings are the available columns in table 'tblgt_sales_payment_header_rev':
 * @property integer $id
 * @property string $number
 * @property string $date
 * @property string $note
 * @property integer $customer_id
 * @property integer $admin_id
 * @property integer $is_non_tax
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property SalesPaymentDetailRev[] $salesPaymentDetailRevs
 * @property SalesPaymentExtra[] $salesPaymentExtras
 * @property Customer $customer
 * @property Admin $admin
 */
class SalesPaymentHeaderRev extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SalesPaymentHeaderRev the static model class
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
		return 'tblgt_sales_payment_header_rev';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number, date, customer_id, admin_id', 'required'),
			array('customer_id, admin_id, is_non_tax, is_inactive', 'numerical', 'integerOnly'=>true),
			array('number', 'length', 'max'=>60),
			array('note', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, number, date, note, customer_id, admin_id, is_non_tax, is_inactive', 'safe', 'on'=>'search'),
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
			'salesPaymentDetailRevs' => array(self::HAS_MANY, 'SalesPaymentDetailRev', 'sales_payment_header_rev_id'),
			'salesPaymentExtras' => array(self::HAS_MANY, 'SalesPaymentExtra', 'sales_payment_header_rev_id'),
			'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
			'admin' => array(self::BELONGS_TO, 'Admin', 'admin_id'),
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
			'customer_id' => 'Customer',
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
		$criteria->compare('note',$this->note,true);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('admin_id',$this->admin_id);
		$criteria->compare('is_non_tax',$this->is_non_tax);
		$criteria->compare('is_inactive',$this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getTotalInvoice()
	{
		$total = 0.00;
		
		foreach ($this->salesPaymentDetailRevs as $detail)
			$total += $detail->receiptHeader->totalInvoice;
		
		return $total;
	}
	
	public function getAmountPaid()
	{
		$total = 0.00;

		foreach ($this->salesPaymentDetailRevs as $detail)
			$total += $detail->amount;
			
		return $total;
	}
	
	public function getTotalExtras()
	{
		$total = 0.00;
		
		foreach ($this->salesPaymentExtras as $detail)
			$total += $detail->amount;
		
		return $total;
	}
	
	public function getTotalPayment()
	{
		return $this->amountPaid + $this->totalExtras;
	}
}