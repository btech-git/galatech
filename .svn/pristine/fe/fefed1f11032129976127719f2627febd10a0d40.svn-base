<?php

/**
 * This is the model class for table "tblgt_purchase_receipt_detail".
 *
 * The followings are the available columns in table 'tblgt_purchase_receipt_detail':
 * @property integer $id
 * @property string $memo
 * @property integer $purchase_receipt_header_id
 * @property integer $purchase_invoice_id
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property PurchaseReceiptHeader $purchaseReceiptHeader
 * @property PurchaseInvoice $purchaseInvoice
 */
class PurchaseReceiptDetail extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PurchaseReceiptDetail the static model class
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
		return 'tblgt_purchase_receipt_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('purchase_receipt_header_id, purchase_invoice_id', 'required'),
			array('purchase_receipt_header_id, purchase_invoice_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('memo', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, memo, purchase_receipt_header_id, purchase_invoice_id, is_inactive', 'safe', 'on'=>'search'),
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
			'purchaseReceiptHeader' => array(self::BELONGS_TO, 'PurchaseReceiptHeader', 'purchase_receipt_header_id'),
			'purchaseInvoice' => array(self::BELONGS_TO, 'PurchaseInvoice', 'purchase_invoice_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'memo' => 'Memo',
			'purchase_receipt_header_id' => 'Purchase Receipt Header',
			'purchase_invoice_id' => 'Purchase Invoice',
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
		$criteria->compare('memo',$this->memo,true);
		$criteria->compare('purchase_receipt_header_id',$this->purchase_receipt_header_id);
		$criteria->compare('purchase_invoice_id',$this->purchase_invoice_id);
		$criteria->compare('is_inactive',$this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
