<?php

/**
 * This is the model class for table "tblgt_adjustment_detail".
 *
 * The followings are the available columns in table 'tblgt_adjustment_detail':
 * @property integer $id
 * @property integer $quantity_current
 * @property integer $quantity_adjustment
 * @property integer $adjustment_header_id
 * @property integer $product_id
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property AdjustmentHeader $adjustmentHeader
 * @property Product $product
 */
class AdjustmentDetail extends ActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @return AdjustmentDetail the static model class
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
		return 'tblgt_adjustment_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('adjustment_header_id, product_id', 'required'),
			array('quantity_current, quantity_adjustment, adjustment_header_id, product_id, is_inactive', 'numerical', 'integerOnly' => true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, quantity_current, quantity_adjustment, adjustment_header_id, product_id, is_inactive', 'safe', 'on' => 'search'),
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
			'adjustmentHeader' => array(self::BELONGS_TO, 'AdjustmentHeader', 'adjustment_header_id'),
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'quantity_current' => 'Quantity Current',
			'quantity_adjustment' => 'Quantity Adjustment',
			'adjustment_header_id' => 'Adjustment Header',
			'product_id' => 'Product',
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

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('quantity_current', $this->quantity_current);
		$criteria->compare('quantity_adjustment', $this->quantity_adjustment);
		$criteria->compare('adjustment_header_id', $this->adjustment_header_id);
		$criteria->compare('product_id', $this->product_id);
		$criteria->compare('is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
				'criteria' => $criteria,
			));
	}

	public function getCurrentStock($warehouseId = false)
	{
		$sql = SqlGenerator::localStock();

		$value = CActiveRecord::$db->createCommand($sql)->queryScalar(array(
			':product_id' => $this->product_id,
			':warehouse_id' => ($warehouseId !== false) ? $warehouseId : $this->adjustmentHeader->warehouse_id,
			));

		return ($value === false) ? 0 : $value;
	}
}
