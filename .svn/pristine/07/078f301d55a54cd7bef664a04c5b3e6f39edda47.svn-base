<?php

/**
 * This is the model class for table "tblgt_tax_form".
 *
 * The followings are the available columns in table 'tblgt_tax_form':
 * @property integer $id
 * @property integer $cn_ordinal
 * @property string $cn_constant
 * @property integer $invoice_header_id
 * @property integer $sales_downpayment_id
 * @property integer $admin_id
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property InvoiceHeader $invoiceHeader
 * @property SalesDownpayment $salesDownpayment
 * @property Admin $admin
 * @property TaxFormRevisedHeader[] $taxFormRevisedHeaders
 */
class TaxForm extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TaxForm the static model class
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
		return 'tblgt_tax_form';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cn_constant, admin_id', 'required'),
			array('cn_ordinal, invoice_header_id, sales_downpayment_id, admin_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('cn_constant', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cn_ordinal, cn_constant, invoice_header_id, sales_downpayment_id, admin_id, is_inactive', 'safe', 'on'=>'search'),
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
			'invoiceHeader' => array(self::BELONGS_TO, 'InvoiceHeader', 'invoice_header_id'),
			'salesDownpayment' => array(self::BELONGS_TO, 'SalesDownpayment', 'sales_downpayment_id'),
			'admin' => array(self::BELONGS_TO, 'Admin', 'admin_id'),
			'taxFormRevisedHeaders' => array(self::HAS_MANY, 'TaxFormRevisedHeader', 'tax_form_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cn_ordinal' => 'Cn Ordinal',
			'cn_constant' => 'Cn Constant',
			'invoice_header_id' => 'Invoice Header',
			'sales_downpayment_id' => 'Sales Downpayment',
			'admin_id' => 'Admin',
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
		$criteria->compare('cn_ordinal',$this->cn_ordinal);
		$criteria->compare('cn_constant',$this->cn_constant,true);
		$criteria->compare('invoice_header_id',$this->invoice_header_id);
		$criteria->compare('sales_downpayment_id',$this->sales_downpayment_id);
		$criteria->compare('admin_id',$this->admin_id);
		$criteria->compare('is_inactive',$this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getTaxNumber()
	{
		return $this->cn_constant . $this->cn_ordinal;
	}
}