<?php

/**
 * This is the model class for table "tblgt_tax_form_revised_detail".
 *
 * The followings are the available columns in table 'tblgt_tax_form_revised_detail':
 * @property integer $id
 * @property string $name
 * @property string $price
 * @property integer $tax_form_revised_header_id
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property TaxFormRevisedHeader $taxFormRevisedHeader
 */
class TaxFormRevisedDetail extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return TaxFormRevisedDetail the static model class
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
		return 'tblgt_tax_form_revised_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, tax_form_revised_header_id', 'required'),
			array('tax_form_revised_header_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>60),
			array('price', 'length', 'max'=>18),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, price, tax_form_revised_header_id, is_inactive', 'safe', 'on'=>'search'),
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
			'taxFormRevisedHeader' => array(self::BELONGS_TO, 'TaxFormRevisedHeader', 'tax_form_revised_header_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'price' => 'Price',
			'tax_form_revised_header_id' => 'Tax Form Revised Header',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('tax_form_revised_header_id',$this->tax_form_revised_header_id);
		$criteria->compare('is_inactive',$this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}