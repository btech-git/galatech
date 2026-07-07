<?php

/**
 * This is the model class for table "tblgt_accounting_journal".
 *
 * The followings are the available columns in table 'tblgt_accounting_journal':
 * @property integer $id
 * @property string $transaction_number
 * @property string $date
 * @property integer $type
 * @property string $debit
 * @property string $credit
 * @property integer $account_id
 * @property integer $admin_id
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property Account $account
 * @property Admin $admin
 */
class AccountingJournal extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return AccountingJournal the static model class
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
		return 'tblgt_accounting_journal';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('transaction_number, date, admin_id', 'required'),
			array('type, account_id, admin_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('transaction_number', 'length', 'max'=>60),
			array('debit, credit', 'length', 'max'=>18),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, transaction_number, date, type, debit, credit, account_id, admin_id, is_inactive', 'safe', 'on'=>'search'),
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
			'account' => array(self::BELONGS_TO, 'Account', 'account_id'),
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
			'transaction_number' => 'Transaction Number',
			'date' => 'Date',
			'type' => 'Type',
			'debit' => 'Debit',
			'credit' => 'Credit',
			'account_id' => 'Account',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('transaction_number',$this->transaction_number,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('debit',$this->debit,true);
		$criteria->compare('credit',$this->credit,true);
		$criteria->compare('account_id',$this->account_id);
		$criteria->compare('admin_id',$this->admin_id);
		$criteria->compare('is_inactive',$this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getBalance()
	{
		return $this->debit - $this->credit;
	}
	
}