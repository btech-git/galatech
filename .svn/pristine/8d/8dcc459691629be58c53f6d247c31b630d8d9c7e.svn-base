<?php

/**
 * This is the model class for table "tblgt_inventory".
 *
 * The followings are the available columns in table 'tblgt_inventory':
 * @property integer $id
 * @property string $transaction_number
 * @property string $date
 * @property integer $transaction_type
 * @property string $transaction_subject
 * @property integer $quantity_in
 * @property integer $quantity_out
 * @property string $price
 * @property integer $product_id
 * @property integer $warehouse_id
 * @property integer $admin_id
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property Product $product
 * @property Admin $admin
 * @property Warehouse $warehouse
 */
class Inventory extends ActiveRecord {

    const RECEIVE = 1;
    const PURCHASE_RETURN = 2;
    const ADJUSTMENT = 3;
    const TRANSFER = 4;
    const DELIVERY = 5;
    const SALES_RETURN = 6;

    /**
     * Returns the static model of the specified AR class.
     * @return Inventory the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tblgt_inventory';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('transaction_number, date, product_id, warehouse_id, admin_id', 'required'),
            array('transaction_type, quantity_in, quantity_out, product_id, warehouse_id, admin_id, is_inactive', 'numerical', 'integerOnly' => true),
            array('transaction_number, transaction_subject', 'length', 'max' => 60),
            array('price', 'length', 'max' => 18),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, transaction_number, date, transaction_type, transaction_subject, quantity_in, quantity_out, price, product_id, warehouse_id, admin_id, is_inactive', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
            'admin' => array(self::BELONGS_TO, 'Admin', 'admin_id'),
            'warehouse' => array(self::BELONGS_TO, 'Warehouse', 'warehouse_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'transaction_number' => 'Transaction Number',
            'date' => 'Date',
            'transaction_type' => 'Transaction Type',
            'transaction_subject' => 'Transaction Subject',
            'quantity_in' => 'Quantity In',
            'quantity_out' => 'Quantity Out',
            'price' => 'Price',
            'product_id' => 'Product',
            'warehouse_id' => 'Warehouse',
            'admin_id' => 'Admin',
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
        $criteria->compare('transaction_number', $this->transaction_number, true);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('transaction_type', $this->transaction_type);
        $criteria->compare('transaction_subject', $this->transaction_subject, true);
        $criteria->compare('quantity_in', $this->quantity_in);
        $criteria->compare('quantity_out', $this->quantity_out);
        $criteria->compare('price', $this->price, true);
        $criteria->compare('product_id', $this->product_id);
        $criteria->compare('warehouse_id', $this->warehouse_id);
        $criteria->compare('admin_id', $this->admin_id);
        $criteria->compare('is_inactive', $this->is_inactive);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getTransactionType() {
        switch ($this->transaction_type) {
            case self::RECEIVE: return 'Penerimaan';
            case self::PURCHASE_RETURN: return 'Retur Pembelian';
            case self::ADJUSTMENT: return 'Penyesuaian';
            case self::TRANSFER: return 'Transfer Barang';
            case self::DELIVERY: return 'Pengiriman';
            case self::SALES_RETURN: return 'Retur Penjualan';
            default: return '';
        }
    }

}
