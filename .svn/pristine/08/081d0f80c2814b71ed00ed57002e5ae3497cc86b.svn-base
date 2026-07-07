<?php

/**
 * This is the model class for table "tblgt_deposit_detail".
 *
 * The followings are the available columns in table 'tblgt_deposit_detail':
 * @property integer $id
 * @property string $amount
 * @property string $memo
 * @property integer $deposit_header_id
 * @property integer $account_id
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property DepositHeader $depositHeader
 * @property Account $account
 */
class DepositDetail extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return DepositDetail the static model class
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
		return 'tblgt_deposit_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('deposit_header_id, account_id', 'required'),
			array('deposit_header_id, account_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('amount', 'length', 'max'=>18),
			array('memo', 'length', 'max'=>60),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, amount, memo, deposit_header_id, account_id, is_inactive', 'safe', 'on'=>'search'),
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
			'depositHeader' => array(self::BELONGS_TO, 'DepositHeader', 'deposit_header_id'),
			'account' => array(self::BELONGS_TO, 'Account', 'account_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'amount' => 'Amount',
			'memo' => 'Memo',
			'deposit_header_id' => 'Deposit Header',
			'account_id' => 'Account',
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
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('memo',$this->memo,true);
		$criteria->compare('deposit_header_id',$this->deposit_header_id);
		$criteria->compare('account_id',$this->account_id);
		$criteria->compare('is_inactive',$this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
