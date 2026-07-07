<?php

/**
 * This is the model class for table "tblgt_delivery_purchase_cart_info".
 *
 * The followings are the available columns in table 'tblgt_delivery_purchase_cart_info':
 * @property integer $id
 * @property integer $quantity
 * @property string $unit_price
 * @property string $discount
 * @property integer $delivery_detail_id
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property DeliveryDetail $deliveryDetail
 */
class DeliveryPurchaseCartInfo extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tblgt_delivery_purchase_cart_info';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('delivery_detail_id', 'required'),
            array('quantity, delivery_detail_id, is_inactive', 'numerical', 'integerOnly' => true),
            array('unit_price', 'length', 'max' => 18),
            array('discount', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, quantity, unit_price, discount, delivery_detail_id, is_inactive', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'deliveryDetail' => array(self::BELONGS_TO, 'DeliveryDetail', 'delivery_detail_id'),
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
            'discount' => 'Discount',
            'delivery_detail_id' => 'Delivery Detail',
            'is_inactive' => 'Is Inactive',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('quantity', $this->quantity);
        $criteria->compare('unit_price', $this->unit_price, true);
        $criteria->compare('discount', $this->discount, true);
        $criteria->compare('delivery_detail_id', $this->delivery_detail_id);
        $criteria->compare('is_inactive', $this->is_inactive);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return DeliveryPurchaseCartInfo the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
}