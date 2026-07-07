<?php

/**
 * This is the model class for table "tblgt_receive_header".
 *
 * The followings are the available columns in table 'tblgt_receive_header':
 * @property integer $id
 * @property string $number
 * @property string $date
 * @property string $reference
 * @property string $note
 * @property integer $purchase_header_id
 * @property integer $warehouse_id
 * @property integer $admin_id
 * @property integer $is_non_tax
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property PurchaseReturnHeader[] $purchaseReturnHeaders
 * @property ReceiveDetail[] $receiveDetails
 * @property PurchaseHeader $purchaseHeader
 * @property Admin $admin
 * @property Warehouse $warehouse
 */
class ReceiveHeader extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ReceiveHeader the static model class
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
		return 'tblgt_receive_header';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number, date, purchase_header_id, warehouse_id, admin_id', 'required'),
			array('purchase_header_id, warehouse_id, admin_id, is_non_tax, is_inactive', 'numerical', 'integerOnly'=>true),
			array('number, reference', 'length', 'max'=>60),
			array('note', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, number, date, reference, note, purchase_header_id, warehouse_id, admin_id, is_non_tax, is_inactive', 'safe', 'on'=>'search'),
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
			'purchaseReturnHeaders' => array(self::HAS_MANY, 'PurchaseReturnHeader', 'receive_header_id'),
			'receiveDetails' => array(self::HAS_MANY, 'ReceiveDetail', 'receive_header_id'),
			'purchaseHeader' => array(self::BELONGS_TO, 'PurchaseHeader', 'purchase_header_id'),
			'admin' => array(self::BELONGS_TO, 'Admin', 'admin_id'),
			'warehouse' => array(self::BELONGS_TO, 'Warehouse', 'warehouse_id'),
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
			'reference' => 'Reference',
			'note' => 'Note',
			'purchase_header_id' => 'Purchase Header',
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
		$criteria->compare('t.number',$this->number,true);
		$criteria->compare('t.date',$this->date,true);
		$criteria->compare('reference',$this->reference,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('purchase_header_id',$this->purchase_header_id);
		$criteria->compare('warehouse_id',$this->warehouse_id);
		$criteria->compare('admin_id',$this->admin_id);
		$criteria->compare('t.is_non_tax',$this->is_non_tax);
		$criteria->compare('t.is_inactive',$this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
//	public function searchByPurchaseReturn()
//	{
//		$criteria = new CDbCriteria;
//
//		$criteria->condition = 'EXISTS (
//                        
//			SELECT receive.quantity - SUM(COALESCE(returned.quantity, 0)) AS quantity_received
//			FROM 
//			(
//				SELECT h.id, d.quantity, d.product_id
//				FROM tblgt_receive_header h 
//				INNER JOIN tblgt_receive_detail d ON h.id = d.receive_header_id
//				WHERE h.is_inactive = 0 AND d.is_inactive = 0
//			) receive
//			LEFT OUTER JOIN
//			(
//				SELECT h.receive_header_id, d.quantity, d.product_id
//				FROM tblgt_purchase_return_header h
//				INNER JOIN tblgt_purchase_return_detail d ON h.id = d.purchase_return_header_id
//				WHERE h.is_inactive = 0 AND d.is_inactive = 0
//			) returned
//			ON receive.id = returned.receive_header_id
//			AND receive.product_id = returned.product_id
//			WHERE t.id = receive.id
//			GROUP BY receive.id, receive.product_id
//			HAVING quantity_received > 0
//			)';
//
//		$criteria->compare('number', $this->number, true);
//		$criteria->compare('date', $this->date, true);
//		$criteria->compare('warehouse_id', $this->warehouse_id, true);
//
//		return new CActiveDataProvider(get_class($this), array(
//				'criteria' => $criteria,
//			));
//	}
        
        public function getSubTotalQuantity()
	{
		$total = 0.00;
		foreach ($this->receiveDetails as $detail)
			$total += $detail->quantity;

		return $total;
	}

	public function hasReference()
	{
		if (count($this->purchaseReturnHeaders) > 0)
			return true;

		return false;
	}
}