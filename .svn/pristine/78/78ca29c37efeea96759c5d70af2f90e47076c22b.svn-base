<?php

/**
 * This is the model class for table "tblgt_purchase_asset_header".
 *
 * The followings are the available columns in table 'tblgt_purchase_asset_header':
 * @property integer $id
 * @property string $number
 * @property string $date
 * @property string $supplier
 * @property string $note
 * @property integer $admin_id
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property PurchaseAssetDetail[] $purchaseAssetDetails
 * @property Admin $admin
 */
class PurchaseAssetHeader extends ActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @return PurchaseAssetHeader the static model class
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
		return 'tblgt_purchase_asset_header';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number, date, supplier, admin_id', 'required'),
			array('admin_id, is_inactive', 'numerical', 'integerOnly' => true),
			array('number, supplier', 'length', 'max' => 60),
			array('note', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, number, date, supplier, note, admin_id, is_inactive', 'safe', 'on' => 'search'),
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
			'purchaseAssetDetails' => array(self::HAS_MANY, 'PurchaseAssetDetail', 'purchase_asset_header_id'),
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
			'supplier' => 'Supplier',
			'note' => 'Note',
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

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('number', $this->number, true);
		$criteria->compare('date', $this->date, true);
		$criteria->compare('supplier', $this->supplier, true);
		$criteria->compare('note', $this->note, true);
		$criteria->compare('admin_id', $this->admin_id);
		$criteria->compare('is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
				'criteria' => $criteria,
			));
	}

	public function getSubTotal()
	{
		$total = 0.00;
		foreach ($this->purchaseAssetDetails as $detail)
			$total += $detail->total;

		return $total;
	}
}