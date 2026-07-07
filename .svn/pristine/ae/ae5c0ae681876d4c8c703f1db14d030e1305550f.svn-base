<?php

/**
 * This is the model class for table "tblgt_purchase_detail".
 *
 * The followings are the available columns in table 'tblgt_purchase_detail':
 * @property integer $id
 * @property integer $quantity
 * @property integer $quantity_received
 * @property integer $quantity_received_remaining
 * @property string $unit_price
 * @property string $price_before_tax
 * @property string $discount
 * @property integer $purchase_header_id
 * @property integer $product_id
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property PurchaseHeader $purchaseHeader
 * @property Product $product
 * @property ReceiveDetail[] $receiveDetails
 */
class PurchaseDetail extends ActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return PurchaseDetail the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tblgt_purchase_detail';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('purchase_header_id, product_id', 'required'),
            array('quantity, quantity_received, quantity_received_remaining, purchase_header_id, product_id, is_inactive', 'numerical', 'integerOnly' => true),
            array('unit_price, price_before_tax', 'length', 'max' => 18),
            array('discount', 'length', 'max' => 10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, quantity, quantity_received, quantity_received_remaining, unit_price, price_before_tax, discount, purchase_header_id, product_id, is_inactive', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'purchaseHeader' => array(self::BELONGS_TO, 'PurchaseHeader', 'purchase_header_id'),
            'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
            'receiveDetails' => array(self::HAS_MANY, 'ReceiveDetail', 'purchase_detail_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'quantity' => 'Quantity',
            'unit_price' => 'Unit Price',
            'price_before_tax' => 'DPP',
            'discount' => 'Discount',
            'purchase_header_id' => 'Purchase Header',
            'product_id' => 'Product',
            'is_inactive' => 'Status',
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
        $criteria->compare('quantity', $this->quantity);
        $criteria->compare('unit_price', $this->unit_price, true);
        $criteria->compare('price_before_tax', $this->price_before_tax, true);
        $criteria->compare('discount', $this->discount, true);
        $criteria->compare('purchase_header_id', $this->purchase_header_id);
        $criteria->compare('product_id', $this->product_id);
        $criteria->compare('is_inactive', $this->is_inactive);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    public function getPriceAfterDiscount() {
        return $this->unit_price * (1 - ($this->discount / 100));
    }

    public function getPriceAfterTax($taxType, $tax) {
        return ($taxType == 1) ? round($this->priceAfterDiscount * (1 + ($tax / 100)), 2) : round($this->priceAfterDiscount, 2);
    }

    public function getTotal() {
        return $this->quantity * $this->getPriceAfterDiscount();
    }
    
    public function getTotalQuantityReceived() {
        $total = 0;
        
        foreach($this->receiveDetails as $detail) {
            if ($detail->is_inactive == 0) {
                $total += $detail->quantity;
            }
        }
        
        return $total;
    }
}
