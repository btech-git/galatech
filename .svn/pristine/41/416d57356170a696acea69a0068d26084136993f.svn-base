<?php

/**
 * This is the model class for table "tblgt_customer".
 *
 * The followings are the available columns in table 'tblgt_customer':
 * @property integer $id
 * @property string $company
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $fax
 * @property string $npwp
 * @property string $email
 * @property string $website
 * @property string $note
 * @property integer $account_id
 * @property integer $journal_downpayment_id
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property Account $account
 * @property Account $journalDownpayment
 * @property DeliveryHeader[] $deliveryHeaders
 * @property IndentHeader[] $indentHeaders
 * @property ReceiptHeader[] $receiptHeaders
 * @property SalesChequeHeader[] $salesChequeHeaders
 * @property SalesDownpayment[] $salesDownpayments
 * @property SalesPaymentHeaderRev[] $salesPaymentHeaderRevs
 */
class Customer extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Customer the static model class
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
		return 'tblgt_customer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company, name', 'required'),
			array('account_id, journal_downpayment_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('company, name, phone, fax, npwp, email, website', 'length', 'max'=>60),
			array('address, note', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, company, name, address, phone, fax, npwp, email, website, note, account_id, journal_downpayment_id, is_inactive', 'safe', 'on'=>'search'),
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
			'account' => array(self::BELONGS_TO, 'Account', 'account_id'),
			'journalDownpayment' => array(self::BELONGS_TO, 'Account', 'journal_downpayment_id'),
			'deliveryHeaders' => array(self::HAS_MANY, 'DeliveryHeader', 'customer_id'),
			'indentHeaders' => array(self::HAS_MANY, 'IndentHeader', 'customer_id'),
			'receiptHeaders' => array(self::HAS_MANY, 'ReceiptHeader', 'customer_id'),
			'salesChequeHeaders' => array(self::HAS_MANY, 'SalesChequeHeader', 'customer_id'),
			'salesDownpayments' => array(self::HAS_MANY, 'SalesDownpayment', 'customer_id'),
			'salesPaymentHeaderRevs' => array(self::HAS_MANY, 'SalesPaymentHeaderRev', 'customer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'company' => 'Company',
			'name' => 'Name',
			'address' => 'Address',
			'phone' => 'Phone',
			'fax' => 'Fax',
			'npwp' => 'Npwp',
			'email' => 'Email',
			'website' => 'Website',
			'note' => 'Note',
			'account_id' => 'Account',
			'journal_downpayment_id' => 'Journal Downpayment',
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
		$criteria->compare('company',$this->company,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('npwp',$this->npwp,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('account_id',$this->account_id);
		$criteria->compare('journal_downpayment_id',$this->journal_downpayment_id);
		$criteria->compare('is_inactive',$this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getTotalSales()
	{
		$totalSales= 0.00;
		
		foreach($this->deliveryHeaders as $deliveryHeader)
		{
			$totalSales += $deliveryHeader->grandTotal;
		}
		
		return $totalSales;
	}
        
	public function getNpwpText()
	{
		//return preg_replace("/[^A-Za-z0-9 ]/", '', $this->npwp);
                
		return preg_replace("/[^[:alnum:][:space:]]/u", '', $this->npwp);
                
               // return preg_replace('/\D/', '', $this->npwp);
	}
}