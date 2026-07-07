<?php

/**
 * This is the model class for table "tblgt_sales_cheque_header".
 *
 * The followings are the available columns in table 'tblgt_sales_cheque_header':
 * @property integer $id
 * @property string $number
 * @property string $receive_date
 * @property string $due_date
 * @property integer $customer_id
 * @property integer $admin_id
 * @property integer $is_non_tax
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property SalesChequeDetail[] $salesChequeDetails
 * @property Customer $customer
 * @property Admin $admin
 */
class SalesChequeHeader extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SalesChequeHeader the static model class
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
		return 'tblgt_sales_cheque_header';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number, receive_date, due_date, customer_id, admin_id', 'required'),
			array('customer_id, admin_id, is_non_tax, is_inactive', 'numerical', 'integerOnly'=>true),
			array('number', 'length', 'max'=>60),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, number, receive_date, due_date, customer_id, admin_id, is_non_tax, is_inactive', 'safe', 'on'=>'search'),
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
			'salesChequeDetails' => array(self::HAS_MANY, 'SalesChequeDetail', 'sales_cheque_header_id'),
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
			'receive_date' => 'Receive Date',
			'due_date' => 'Due Date',
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
		$criteria->compare('receive_date',$this->receive_date,true);
		$criteria->compare('due_date',$this->due_date,true);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('admin_id',$this->admin_id);
		$criteria->compare('is_non_tax',$this->is_non_tax);
		$criteria->compare('is_inactive',$this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getTotal()
	{
		$total = 0.00;
		foreach ($this->salesChequeDetails as $detail)
			$total += $detail->amount;

		return $total;
	}
	
	public function getTotalReceipt()
	{
		$total = 0.00;
		
		foreach ($this->salesChequeDetails as $detail)
			$total += $detail->receiptHeader->totalInvoice;
		
		return $total;
	}
}