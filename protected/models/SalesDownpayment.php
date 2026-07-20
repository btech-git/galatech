<?php

/**
 * This is the model class for table "tblgt_sales_downpayment".
 *
 * The followings are the available columns in table 'tblgt_sales_downpayment':
 * @property integer $id
 * @property string $number
 * @property string $date
 * @property integer $quantity
 * @property string $amount
 * @property integer $tax
 * @property string $note
 * @property integer $customer_id
 * @property integer $board_id
 * @property integer $account_id
 * @property integer $admin_id
 * @property integer $is_non_tax
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property DeliveryHeader[] $deliveryHeaders
 * @property Admin $admin
 * @property Customer $customer
 * @property Account $account
 * @property Board $board
 * @property TaxForm[] $taxForms
 */
class SalesDownpayment extends ActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return SalesDownpayment the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tblgt_sales_downpayment';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('number, date, customer_id, board_id, account_id, admin_id', 'required'),
            array('quantity, tax, customer_id, board_id, account_id, admin_id, is_non_tax, is_inactive', 'numerical', 'integerOnly' => true),
            array('number', 'length', 'max' => 60),
            array('amount', 'length', 'max' => 18),
            array('note', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, number, date, quantity, amount, tax, note, customer_id, board_id, account_id, admin_id, is_non_tax, is_inactive', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'deliveryHeaders' => array(self::HAS_MANY, 'DeliveryHeader', 'sales_downpayment_id'),
            'admin' => array(self::BELONGS_TO, 'Admin', 'admin_id'),
            'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
            'account' => array(self::BELONGS_TO, 'Account', 'account_id'),
            'board' => array(self::BELONGS_TO, 'Board', 'board_id'),
            'taxForms' => array(self::HAS_MANY, 'TaxForm', 'sales_downpayment_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'number' => 'Number',
            'date' => 'Date',
            'quantity' => 'Quantity',
            'amount' => 'Amount',
            'tax' => 'Tax',
            'note' => 'Note',
            'customer_id' => 'Customer',
            'board_id' => 'Board',
            'account_id' => 'Account',
            'admin_id' => 'Admin',
            'is_non_tax' => 'Is Non Tax',
            'is_inactive' => 'Is Inactive',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('number', $this->number, true);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('quantity', $this->quantity);
        $criteria->compare('amount', $this->amount, true);
        $criteria->compare('tax', $this->tax);
        $criteria->compare('note', $this->note, true);
        $criteria->compare('customer_id', $this->customer_id);
        $criteria->compare('board_id', $this->board_id);
        $criteria->compare('account_id', $this->account_id);
        $criteria->compare('admin_id', $this->admin_id);
        $criteria->compare('is_non_tax', $this->is_non_tax);
        $criteria->compare('is_inactive', $this->is_inactive);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getCalculatedTax() {
        return $this->amount * $this->tax / 100;
    }

    public function getGrandTotal() {
        return $this->amount + $this->calculatedTax;
    }

    public function getCodeNumber() {
        $constant = '';
        $length = 0;

        if ($this->number !== null) {
            $constant = ($this->is_non_tax) ? 'NINV' : '/INV';
            $length = ($this->is_non_tax) ? 5 : 4;
        }

        return substr_replace($this->number, $constant, 5, $length);
    }

}
