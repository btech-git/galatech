<?php

/**
 * This is the model class for table "tblgt_tax_form_revised_header".
 *
 * The followings are the available columns in table 'tblgt_tax_form_revised_header':
 * @property integer $id
 * @property string $date
 * @property string $note
 * @property string $discount
 * @property string $downpayment
 * @property integer $tax_form_id
 * @property integer $admin_id
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property TaxFormRevisedDetail[] $taxFormRevisedDetails
 * @property TaxForm $taxForm
 * @property Admin $admin
 */
class TaxFormRevisedHeader extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return TaxFormRevisedHeader the static model class
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
		return 'tblgt_tax_form_revised_header';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date, tax_form_id, admin_id', 'required'),
			array('tax_form_id, admin_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('discount', 'length', 'max'=>10),
			array('downpayment', 'length', 'max'=>18),
			array('note', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, date, note, discount, downpayment, tax_form_id, admin_id, is_inactive', 'safe', 'on'=>'search'),
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
			'taxFormRevisedDetails' => array(self::HAS_MANY, 'TaxFormRevisedDetail', 'tax_form_revised_header_id'),
			'taxForm' => array(self::BELONGS_TO, 'TaxForm', 'tax_form_id'),
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
			'date' => 'Date',
			'note' => 'Note',
			'discount' => 'Discount',
			'downpayment' => 'Downpayment',
			'tax_form_id' => 'Tax Form',
			'admin_id' => 'Admin',
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
		$criteria->compare('date',$this->date,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('discount',$this->discount,true);
		$criteria->compare('downpayment',$this->downpayment,true);
		$criteria->compare('tax_form_id',$this->tax_form_id);
		$criteria->compare('admin_id',$this->admin_id);
		$criteria->compare('is_inactive',$this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}