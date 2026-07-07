<?php

/**
 * This is the model class for table "tblgt_purchase_payment_header_rev".
 *
 * The followings are the available columns in table 'tblgt_purchase_payment_header_rev':
 * @property integer $id
 * @property string $number
 * @property string $date
 * @property string $note
 * @property integer $supplier_id
 * @property integer $admin_id
 * @property integer $is_non_tax
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property PurchasePaymentDetailRev[] $purchasePaymentDetailRevs
 * @property PurchasePaymentExtra[] $purchasePaymentExtras
 * @property Supplier $supplier
 * @property Admin $admin
 */
class PurchasePaymentHeaderRev extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PurchasePaymentHeaderRev the static model class
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
		return 'tblgt_purchase_payment_header_rev';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number, date, supplier_id, admin_id', 'required'),
			array('supplier_id, admin_id, is_non_tax, is_inactive', 'numerical', 'integerOnly'=>true),
			array('number', 'length', 'max'=>60),
			array('note', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, number, date, note, supplier_id, admin_id, is_non_tax, is_inactive', 'safe', 'on'=>'search'),
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
			'purchasePaymentDetailRevs' => array(self::HAS_MANY, 'PurchasePaymentDetailRev', 'purchase_payment_header_rev_id'),
			'purchasePaymentExtras' => array(self::HAS_MANY, 'PurchasePaymentExtra', 'purchase_payment_header_rev_id'),
			'supplier' => array(self::BELONGS_TO, 'Supplier', 'supplier_id'),
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
			'supplier_id' => 'Supplier',
			'admin_id' => 'Admin',
			'is_non_tax' => 'Is Non Tax',
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
		$criteria->compare('number',$this->number,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('supplier_id',$this->supplier_id);
		$criteria->compare('admin_id',$this->admin_id);
		$criteria->compare('is_non_tax',$this->is_non_tax);
		$criteria->compare('is_inactive',$this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getTotalPurchase()
	{
		$total = 0.00;
		
		foreach ($this->purchasePaymentDetailRevs as $detail)
			$total += $detail->purchaseReceiptHeader->totalPurchase;
		
		return $total;
	}
	
	public function getTotalDetail()
	{
		$total = 0.00;
		
		foreach ($this->purchasePaymentDetailRevs as $detail)
			$total += $detail->amount;
		
		return $total;
	}
	public function getTotalExtras()
	{
		$total = 0.00;
		
		foreach ($this->purchasePaymentExtras as $detail)
			$total += $detail->amount;
		
		return $total;
	}
	
	public function getTotalPayment()
	{
		return $this->totalDetail + $this->totalExtras;
	}
}