<?php

/**
 * This is the model class for table "tblgt_bank".
 *
 * The followings are the available columns in table 'tblgt_bank':
 * @property integer $id
 * @property string $number
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $branch
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property PurchaseChequeDetail[] $purchaseChequeDetails
 * @property SalesChequeDetail[] $salesChequeDetails
 */
class Bank extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Bank the static model class
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
		return 'tblgt_bank';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number, name, address, phone, branch', 'required'),
			array('is_inactive', 'numerical', 'integerOnly'=>true),
			array('number, name, phone, branch', 'length', 'max'=>60),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, number, name, address, phone, branch, is_inactive', 'safe', 'on'=>'search'),
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
			'purchaseChequeDetails' => array(self::HAS_MANY, 'PurchaseChequeDetail', 'bank_id'),
			'salesChequeDetails' => array(self::HAS_MANY, 'SalesChequeDetail', 'bank_id'),
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
			'name' => 'Name',
			'address' => 'Address',
			'phone' => 'Phone',
			'branch' => 'Branch',
			'is_inactive' => 'Status',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('branch',$this->branch,true);
		$criteria->compare('is_inactive',$this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}