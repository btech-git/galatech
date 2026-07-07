<?php

/**
 * This is the model class for table "tblgt_supplier".
 *
 * The followings are the available columns in table 'tblgt_supplier':
 * @property integer $id
 * @property string $company
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $fax
 * @property string $email
 * @property string $website
 * @property string $note
 * @property integer $account_id
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property PurchaseChequeHeader[] $purchaseChequeHeaders
 * @property PurchaseHeader[] $purchaseHeaders
 * @property PurchasePaymentHeaderRev[] $purchasePaymentHeaderRevs
 * @property PurchaseReceiptHeader[] $purchaseReceiptHeaders
 * @property Account $account
 */
class Supplier extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Supplier the static model class
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
		return 'tblgt_supplier';
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
			array('account_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('company, name, phone, fax, email, website', 'length', 'max'=>60),
			array('address, note', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, company, name, address, phone, fax, email, website, note, account_id, is_inactive', 'safe', 'on'=>'search'),
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
			'purchaseChequeHeaders' => array(self::HAS_MANY, 'PurchaseChequeHeader', 'supplier_id'),
			'purchaseHeaders' => array(self::HAS_MANY, 'PurchaseHeader', 'supplier_id'),
			'purchasePaymentHeaderRevs' => array(self::HAS_MANY, 'PurchasePaymentHeaderRev', 'supplier_id'),
			'purchaseReceiptHeaders' => array(self::HAS_MANY, 'PurchaseReceiptHeader', 'supplier_id'),
			'account' => array(self::BELONGS_TO, 'Account', 'account_id'),
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
			'email' => 'Email',
			'website' => 'Website',
			'note' => 'Note',
			'account_id' => 'Account',
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('account_id',$this->account_id);
		$criteria->compare('is_inactive',$this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}