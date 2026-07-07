<?php

/**
 * This is the model class for table "tblgt_account".
 *
 * The followings are the available columns in table 'tblgt_account':
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property integer $account_category_id
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property AccountCategory $accountCategory
 * @property AccountingJournal[] $accountingJournals
 * @property Customer[] $customers
 * @property Customer[] $customers1
 * @property DepositDetail[] $depositDetails
 * @property DepositHeader[] $depositHeaders
 * @property ExpenseDetail[] $expenseDetails
 * @property ExpenseHeader[] $expenseHeaders
 * @property JournalVoucherDetail[] $journalVoucherDetails
 * @property PurchasePaymentDetailRev[] $purchasePaymentDetailRevs
 * @property SalesDownpayment[] $salesDownpayments
 * @property SalesPaymentDetailRev[] $salesPaymentDetailRevs
 * @property Supplier[] $suppliers
 */
class Account extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Account the static model class
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
		return 'tblgt_account';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, name, account_category_id', 'required'),
			array('account_category_id, is_inactive', 'numerical', 'integerOnly'=>true),
			array('code, name', 'length', 'max'=>60),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, code, name, description, account_category_id, is_inactive', 'safe', 'on'=>'search'),
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
			'accountCategory' => array(self::BELONGS_TO, 'AccountCategory', 'account_category_id'),
			'accountingJournals' => array(self::HAS_MANY, 'AccountingJournal', 'account_id'),
			'customers' => array(self::HAS_MANY, 'Customer', 'account_id'),
			'customers1' => array(self::HAS_MANY, 'Customer', 'journal_downpayment_id'),
			'depositDetails' => array(self::HAS_MANY, 'DepositDetail', 'account_id'),
			'depositHeaders' => array(self::HAS_MANY, 'DepositHeader', 'account_id'),
			'expenseDetails' => array(self::HAS_MANY, 'ExpenseDetail', 'account_id'),
			'expenseHeaders' => array(self::HAS_MANY, 'ExpenseHeader', 'account_id'),
			'journalVoucherDetails' => array(self::HAS_MANY, 'JournalVoucherDetail', 'account_id'),
			'purchasePaymentDetailRevs' => array(self::HAS_MANY, 'PurchasePaymentDetailRev', 'account_id'),
			'salesDownpayments' => array(self::HAS_MANY, 'SalesDownpayment', 'account_id'),
			'salesPaymentDetailRevs' => array(self::HAS_MANY, 'SalesPaymentDetailRev', 'account_id'),
			'suppliers' => array(self::HAS_MANY, 'Supplier', 'account_id'),
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
			'description' => 'Description',
			'account_category_id' => 'Account Category',
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('account_category_id',$this->account_category_id);
		$criteria->compare('is_inactive',$this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchByPurchasePayment()
	{
		$criteria = new CDbCriteria;

		$criteria->condition = "t.id NOT IN (SELECT account_id FROM tblgt_purchase_payment_detail WHERE is_inactive = 0)";

		$criteria->compare('code', $this->code, true);
		$criteria->compare('name', $this->name, true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria' => $criteria,
		));
	}
	
	public function searchBySalesPayment()
	{
		$criteria = new CDbCriteria;

		$criteria->condition = "t.id NOT IN (SELECT account_id FROM tblgt_sales_payment_detail WHERE is_inactive = 0)";

		$criteria->compare('code', $this->code, true);
		$criteria->compare('name', $this->name, true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria' => $criteria,
		));
	}
	
	public function getBeginningBalance($accountId, $startDate)
	{
		$sql = SqlGenerator::beginningBalance();
		
		$value = CActiveRecord::$db->createCommand($sql)->queryScalar(array(
			':account_id' => $accountId,
			':start_date' => $startDate,
		));

		return ($value === false) ? 0 : $value;
	}
	
	public function getEndingBalance($accountId, $endDate)
	{
		$sql = SqlGenerator::endingBalance();
		
		$value = CActiveRecord::$db->createCommand($sql)->queryScalar(array(
			':account_id' => $accountId,
			':end_date' => $endDate,
		));

		return ($value === false) ? 0 : $value;
	}
	
	
    public function getBalanceTotal($endDate) {
        $sql = "SELECT SUM(balance) AS total_balance
                FROM (
                    SELECT account_id, SUM(j.debit - j.credit) AS balance
                    FROM " . AccountingJournal::model()->tableName() . " j 
                    INNER JOIN " . Account::model()->tableName() . " a ON a.id = j.account_id
                    INNER JOIN " . AccountCategory::model()->tableName() . " c ON c.id = a.account_category_id 
                    WHERE account_id = :account_id AND date <= :end_date AND c.account_category_type_id IN (1)
                    GROUP BY account_id
                    UNION
                    SELECT account_id, SUM(j.credit - j.debit) AS balance
                    FROM " . AccountingJournal::model()->tableName() . " j 
                    INNER JOIN " . Account::model()->tableName() . " a ON a.id = j.account_id
                    INNER JOIN " . AccountCategory::model()->tableName() . " c ON c.id = a.account_category_id 
                    WHERE account_id = :account_id AND date <= :end_date AND c.account_category_type_id IN (2)
                    GROUP BY account_id
                ) transaction
                GROUP BY account_id";

        $value = CActiveRecord::$db->createCommand($sql)->queryScalar(array(
            ':account_id' => $this->id,
            ':end_date' => $endDate,
        ));

        return ($value === false) ? 0 : $value;
    }
}