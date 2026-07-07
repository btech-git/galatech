<?php

/**
 * This is the model class for table "tblgt_purchase_payment_extra".
 *
 * The followings are the available columns in table 'tblgt_purchase_payment_extra':
 * @property integer $id
 * @property string $amount
 * @property string $memo
 * @property integer $purchase_payment_header_rev_id
 * @property integer $account_id
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property Account $account
 * @property PurchasePaymentHeaderRev $purchasePaymentHeaderRev
 */
class PurchasePaymentExtra extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PurchasePaymentExtra the static model class
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
		return 'tblgt_purchase_payment_extra';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('purchase_payment_header_rev_id, account_id', 'required'),
			array('purchase_payment_header_rev_id, account_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('amount', 'length', 'max'=>18),
			array('memo', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, amount, memo, purchase_payment_header_rev_id, account_id, is_inactive', 'safe', 'on'=>'search'),
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
			'purchasePaymentHeaderRev' => array(self::BELONGS_TO, 'PurchasePaymentHeaderRev', 'purchase_payment_header_rev_id'),
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
			'purchase_payment_header_rev_id' => 'Purchase Payment Header Rev',
			'account_id' => 'Account',
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
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('memo',$this->memo,true);
		$criteria->compare('purchase_payment_header_rev_id',$this->purchase_payment_header_rev_id);
		$criteria->compare('account_id',$this->account_id);
		$criteria->compare('is_inactive',$this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
