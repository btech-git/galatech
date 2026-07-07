<?php

/**
 * This is the model class for table "tblgt_sales_asset_detail".
 *
 * The followings are the available columns in table 'tblgt_sales_asset_detail':
 * @property integer $id
 * @property string $asset_name
 * @property integer $quantity
 * @property string $unit_price
 * @property integer $sales_asset_header_id
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property SalesAssetHeader $salesAssetHeader
 */
class SalesAssetDetail extends ActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @return SalesAssetDetail the static model class
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
		return 'tblgt_sales_asset_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('asset_name, sales_asset_header_id', 'required'),
			array('quantity, sales_asset_header_id, is_inactive', 'numerical', 'integerOnly' => true),
			array('asset_name', 'length', 'max' => 60),
			array('unit_price', 'length', 'max' => 18),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, asset_name, quantity, unit_price, sales_asset_header_id, is_inactive', 'safe', 'on' => 'search'),
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
			'salesAssetHeader' => array(self::BELONGS_TO, 'SalesAssetHeader', 'sales_asset_header_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'asset_name' => 'Asset Name',
			'quantity' => 'Quantity',
			'unit_price' => 'Unit Price',
			'sales_asset_header_id' => 'Sales Asset Header',
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
		$criteria->compare('asset_name', $this->asset_name, true);
		$criteria->compare('quantity', $this->quantity);
		$criteria->compare('unit_price', $this->unit_price, true);
		$criteria->compare('sales_asset_header_id', $this->sales_asset_header_id);
		$criteria->compare('is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
				'criteria' => $criteria,
			));
	}

	public function getTotal()
	{
		return $this->quantity * $this->unit_price;
	}
}