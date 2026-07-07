<?php

/**
 * This is the model class for table "tblgt_purchase_return_detail".
 *
 * The followings are the available columns in table 'tblgt_purchase_return_detail':
 * @property integer $id
 * @property integer $quantity
 * @property integer $purchase_return_header_id
 * @property integer $product_id
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property PurchaseReturnHeader $purchaseReturnHeader
 * @property Product $product
 */
class PurchaseReturnDetail extends ActiveRecord
{
//	public $quantity_purchased;
	public $unit_price;

	/**
	 * Returns the static model of the specified AR class.
	 * @return PurchaseReturnDetail the static model class
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
		return 'tblgt_purchase_return_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('purchase_return_header_id, product_id', 'required'),
			array('quantity, purchase_return_header_id, product_id, is_inactive', 'numerical', 'integerOnly' => true),
			array('quantity_purchased, unit_price', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, quantity, purchase_return_header_id, product_id, is_inactive', 'safe', 'on' => 'search'),
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
			'purchaseReturnHeader' => array(self::BELONGS_TO, 'PurchaseReturnHeader', 'purchase_return_header_id'),
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'quantity' => 'Quantity',
			'purchase_return_header_id' => 'Purchase Return Header',
			'product_id' => 'Product',
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

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('quantity', $this->quantity);
		$criteria->compare('purchase_return_header_id', $this->purchase_return_header_id);
		$criteria->compare('product_id', $this->product_id);
		$criteria->compare('is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
				'criteria' => $criteria,
			));
	}

	public function getTotal()
	{
		return $this->quantity * $this->unitPrice;
	}

	public function getUnitPrice()
	{
		if ($this->isNewRecord)
			return $this->unit_price;
		else
		{
			$purchaseDetail = PurchaseDetail::model()->findByAttributes(array(
				'purchase_header_id' => $this->purchaseReturnHeader->purchaseInvoice->purchase_header_id,
				'product_id' => $this->product_id,
				));

			return ($purchaseDetail === null) ? 0.00 : $purchaseDetail->unit_price;
		}
	}

	public function getQuantityPurchased($purchaseInvoiceId = null)
	{
		if ($this->isNewRecord)
			$returnSql = '';
		else
			$returnSql = 'AND p.id <> :return_id';
		
		$sql = "SELECT purchase.quantity - COALESCE(returned.quantity, 0) AS quantity_purchased
				FROM
				(
					SELECT p.id, pd.quantity, pd.unit_price, pd.product_id
					FROM tblgt_purchase_header p
					INNER JOIN tblgt_purchase_detail pd ON p.id = pd.purchase_header_id
					WHERE p.is_inactive = 0 AND pd.is_inactive = 0
				)purchase
				LEFT OUTER JOIN
				(
					SELECT p.id, p.purchase_header_id
					FROM tblgt_purchase_invoice p
					WHERE p.is_inactive = 0 
				) purchaseInvoice
				ON purchase.id = purchaseInvoice.purchase_header_id
				LEFT OUTER JOIN
				(
					SELECT p.purchase_invoice_id, SUM(COALESCE(rd.quantity, 0)) AS quantity, rd.product_id
					FROM tblgt_purchase_return_header p
					INNER JOIN tblgt_purchase_return_detail rd ON p.id = rd.purchase_return_header_id
					WHERE p.is_inactive = 0 AND rd.is_inactive = 0 {$returnSql}
					GROUP BY p.purchase_invoice_id, rd.product_id
				) returned
				ON purchaseInvoice.id = returned.purchase_invoice_id
				AND purchase.product_id = returned.product_id
				INNER JOIN tblgt_product
				ON purchase.product_id = tblgt_product.id
				WHERE purchaseInvoice.id = :purchase_invoice_id AND purchase.product_id = :product_id AND NOT (returned.product_id IS NOT NULL AND returned.purchase_invoice_id IS NULL)
				HAVING quantity_purchased > 0";

		$params = array(
			'purchase_invoice_id' => ($purchaseInvoiceId === null) ? $this->purchaseReturnHeader->purchase_invoice_id : $purchaseInvoiceId,
			'product_id' => $this->product_id,
		);

		if (!$this->isNewRecord)
			$params['return_id'] = $this->purchaseReturnHeader->id;

		$value = CActiveRecord::$db->createCommand($sql)->queryScalar($params);

		return ($value === false) ? 0.00 : $value;
	}
}
