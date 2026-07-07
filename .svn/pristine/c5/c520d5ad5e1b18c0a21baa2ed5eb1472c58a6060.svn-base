<?php

/**
 * This is the model class for table "tblgt_cheque".
 *
 * The followings are the available columns in table 'tblgt_cheque':
 * @property integer $id
 * @property string $number
 * @property string $receive_date
 * @property string $due_date
 * @property string $cheque_number
 * @property string $note
 * @property string $bank
 * @property string $amount
 * @property integer $receipt_header_id
 * @property integer $admin_id
 * @property integer $is_non_tax
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property Admin $admin
 * @property ReceiptHeader $receiptHeader
 */
class Cheque extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Cheque the static model class
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
		return 'tblgt_cheque';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number, receive_date, due_date, cheque_number, bank, receipt_header_id, admin_id', 'required'),
			array('receipt_header_id, admin_id, is_non_tax, is_inactive', 'numerical', 'integerOnly'=>true),
			array('number, cheque_number, bank', 'length', 'max'=>60),
			array('amount', 'length', 'max'=>18),
			array('note', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, number, receive_date, due_date, cheque_number, note, bank, amount, receipt_header_id, admin_id, is_non_tax, is_inactive', 'safe', 'on'=>'search'),
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
			'admin' => array(self::BELONGS_TO, 'Admin', 'admin_id'),
			'receiptHeader' => array(self::BELONGS_TO, 'ReceiptHeader', 'receipt_header_id'),
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
			'receive_date' => 'Receive Date',
			'due_date' => 'Due Date',
			'cheque_number' => 'Cheque Number',
			'note' => 'Note',
			'bank' => 'Bank',
			'amount' => 'Amount',
			'receipt_header_id' => 'Receipt Header',
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
		$criteria->compare('t.number',$this->number,true);
		$criteria->compare('receive_date',$this->receive_date,true);
		$criteria->compare('due_date',$this->due_date,true);
		$criteria->compare('cheque_number',$this->cheque_number,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('bank',$this->bank,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('receipt_header_id',$this->receipt_header_id);
		$criteria->compare('admin_id',$this->admin_id);
		$criteria->compare('is_non_tax',$this->is_non_tax);
		$criteria->compare('is_inactive',$this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}