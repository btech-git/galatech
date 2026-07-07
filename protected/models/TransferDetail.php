<?php

/**
 * This is the model class for table "tblgt_transfer_detail".
 *
 * The followings are the available columns in table 'tblgt_transfer_detail':
 * @property integer $id
 * @property integer $quantity
 * @property integer $transfer_header_id
 * @property integer $product_id
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property TransferHeader $transferHeader
 * @property Product $product
 */
class TransferDetail extends ActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @return TransferDetail the static model class
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
		return 'tblgt_transfer_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('transfer_header_id, product_id', 'required'),
			array('quantity, transfer_header_id, product_id, is_inactive', 'numerical', 'integerOnly' => true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, quantity, transfer_header_id, product_id, is_inactive', 'safe', 'on' => 'search'),
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
			'transferHeader' => array(self::BELONGS_TO, 'TransferHeader', 'transfer_header_id'),
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
			'quantity' => 'Quantity',
			'transfer_header_id' => 'Transfer Header',
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
		$criteria->compare('quantity', $this->quantity);
		$criteria->compare('transfer_header_id', $this->transfer_header_id);
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
			':warehouse_id' => ($warehouseId !== false) ? $warehouseId : $this->transferHeader->warehouse_id,
			));

		return ($value === false) ? 0 : $value;
	}
}
