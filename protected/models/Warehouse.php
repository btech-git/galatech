<?php

/**
 * This is the model class for table "tblgt_warehouse".
 *
 * The followings are the available columns in table 'tblgt_warehouse':
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property AdjustmentHeader[] $adjustmentHeaders
 * @property DeliveryHeader[] $deliveryHeaders
 * @property Inventory[] $inventories
 * @property PurchaseReturnHeader[] $purchaseReturnHeaders
 * @property ReceiveHeader[] $receiveHeaders
 * @property SalesReturnHeader[] $salesReturnHeaders
 * @property TransferHeader[] $transferHeaders
 * @property TransferHeader[] $transferHeaders1
 */
class Warehouse extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tblgt_warehouse';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, name', 'required'),
			array('is_inactive', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>20),
			array('name, phone', 'length', 'max'=>60),
			array('address', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, code, name, address, phone, is_inactive', 'safe', 'on'=>'search'),
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
			'adjustmentHeaders' => array(self::HAS_MANY, 'AdjustmentHeader', 'warehouse_id'),
			'deliveryHeaders' => array(self::HAS_MANY, 'DeliveryHeader', 'warehouse_id'),
			'inventories' => array(self::HAS_MANY, 'Inventory', 'warehouse_id'),
			'purchaseReturnHeaders' => array(self::HAS_MANY, 'PurchaseReturnHeader', 'warehouse_id'),
			'receiveHeaders' => array(self::HAS_MANY, 'ReceiveHeader', 'warehouse_id'),
			'salesReturnHeaders' => array(self::HAS_MANY, 'SalesReturnHeader', 'warehouse_id'),
			'transferHeaders' => array(self::HAS_MANY, 'TransferHeader', 'warehouse_id_from'),
			'transferHeaders1' => array(self::HAS_MANY, 'TransferHeader', 'warehouse_id_to'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'code' => 'Code',
			'name' => 'Name',
			'address' => 'Address',
			'phone' => 'Phone',
			'is_inactive' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('is_inactive',$this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Warehouse the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
