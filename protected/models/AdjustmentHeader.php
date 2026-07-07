<?php

/**
 * This is the model class for table "tblgt_adjustment_header".
 *
 * The followings are the available columns in table 'tblgt_adjustment_header':
 * @property integer $id
 * @property string $number
 * @property string $date
 * @property string $note
 * @property integer $warehouse_id
 * @property integer $admin_id
 * @property integer $is_non_tax
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property AdjustmentDetail[] $adjustmentDetails
 * @property Warehouse $warehouse
 * @property Admin $admin
 */
class AdjustmentHeader extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return AdjustmentHeader the static model class
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
		return 'tblgt_adjustment_header';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number, date, warehouse_id, admin_id', 'required'),
			array('warehouse_id, admin_id, is_non_tax, is_inactive', 'numerical', 'integerOnly'=>true),
			array('number', 'length', 'max'=>60),
			array('note', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, number, date, note, warehouse_id, admin_id, is_non_tax, is_inactive', 'safe', 'on'=>'search'),
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
			'adjustmentDetails' => array(self::HAS_MANY, 'AdjustmentDetail', 'adjustment_header_id'),
			'warehouse' => array(self::BELONGS_TO, 'Warehouse', 'warehouse_id'),
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
			'warehouse_id' => 'Warehouse',
			'admin_id' => 'Admin',
			'is_non_tax' => 'Is Non Tax',
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
		$criteria->compare('date',$this->date,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('warehouse_id',$this->warehouse_id);
		$criteria->compare('admin_id',$this->admin_id);
		$criteria->compare('is_non_tax',$this->is_non_tax);
		$criteria->compare('is_inactive',$this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
