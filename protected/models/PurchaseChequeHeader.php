<?php

/**
 * This is the model class for table "tblgt_purchase_cheque_header".
 *
 * The followings are the available columns in table 'tblgt_purchase_cheque_header':
 * @property integer $id
 * @property string $number
 * @property string $issue_date
 * @property string $due_date
 * @property integer $supplier_id
 * @property integer $admin_id
 * @property integer $is_non_tax
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property PurchaseChequeDetail[] $purchaseChequeDetails
 * @property Supplier $supplier
 * @property Admin $admin
 */
class PurchaseChequeHeader extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PurchaseChequeHeader the static model class
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
		return 'tblgt_purchase_cheque_header';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number, issue_date, due_date, supplier_id, admin_id', 'required'),
			array('supplier_id, admin_id, is_non_tax, is_inactive', 'numerical', 'integerOnly'=>true),
			array('number', 'length', 'max'=>60),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, number, issue_date, due_date, supplier_id, admin_id, is_non_tax, is_inactive', 'safe', 'on'=>'search'),
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
			'purchaseChequeDetails' => array(self::HAS_MANY, 'PurchaseChequeDetail', 'purchase_cheque_header_id'),
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
			'issue_date' => 'Issue Date',
			'due_date' => 'Due Date',
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
		$criteria->compare('issue_date',$this->issue_date,true);
		$criteria->compare('due_date',$this->due_date,true);
		$criteria->compare('supplier_id',$this->supplier_id);
		$criteria->compare('admin_id',$this->admin_id);
		$criteria->compare('is_non_tax',$this->is_non_tax);
		$criteria->compare('is_inactive',$this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getTotal()
	{
		$total = 0.00;
		foreach ($this->purchaseChequeDetails as $detail)
			$total += $detail->amount;

		return $total;
	}
	
	public function getTotalReceipt()
	{
		$total = 0.00;
		
		foreach ($this->purchaseChequeDetails as $detail)
			$total += $detail->purchaseReceiptHeader->totalPurchase;
		
		return $total;
	}
}