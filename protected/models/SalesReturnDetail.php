<?php

/**
 * This is the model class for table "tblgt_sales_return_detail".
 *
 * The followings are the available columns in table 'tblgt_sales_return_detail':
 * @property integer $id
 * @property integer $quantity
 * @property integer $sales_return_header_id
 * @property integer $product_id
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property SalesReturnHeader $salesReturnHeader
 * @property Product $product
 */
class SalesReturnDetail extends ActiveRecord
{
//	public $quantity_sold;
	public $unit_price;
	public $discount;

	/**
	 * Returns the static model of the specified AR class.
	 * @return SalesReturnDetail the static model class
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
		return 'tblgt_sales_return_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sales_return_header_id, product_id', 'required'),
			array('quantity, sales_return_header_id, product_id, is_inactive', 'numerical', 'integerOnly' => true),
			array('quantity_sold, unit_price', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, quantity, sales_return_header_id, product_id, is_inactive', 'safe', 'on' => 'search'),
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
			'salesReturnHeader' => array(self::BELONGS_TO, 'SalesReturnHeader', 'sales_return_header_id'),
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
			'sales_return_header_id' => 'Sales Return Header',
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
		$criteria->compare('sales_return_header_id', $this->sales_return_header_id);
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
			return $this->unit_price * (1 - $this->discount / 100);
		else
		{
			$deliveryDetail = DeliveryDetail::model()->findByAttributes(array(
				'delivery_header_id' => $this->salesReturnHeader->invoiceHeader->delivery_header_id,
				'product_id' => $this->product_id,
			));

			return ($deliveryDetail === null) ? 0.00 : $deliveryDetail->unit_price * (1 - $deliveryDetail->discount / 100);
		}
	}

	public function getQuantitySold($invoiceHeaderId = null)
	{
		if ($this->isNewRecord)
			$returnSql = '';
		else
			$returnSql = 'AND h.id <> :return_id';

		$sql = "SELECT delivery.quantity - SUM(COALESCE(returned.quantity, 0)) AS quantity_sold
				FROM
				(
					SELECT h.id, d.quantity, d.product_id
					FROM tblgt_delivery_header h
					INNER JOIN tblgt_delivery_detail d ON h.id = d.delivery_header_id
					WHERE h.is_inactive = 0 AND d.is_inactive = 0
				) delivery
				LEFT OUTER JOIN
				(
					SELECT h.id, h.delivery_header_id
					FROM tblgt_invoice_header h
					WHERE h.is_inactive = 0 
				) invoice
				ON delivery.id = invoice.delivery_header_id
				LEFT OUTER JOIN
				(
					SELECT h.invoice_header_id, d.quantity, d.product_id
					FROM tblgt_sales_return_header h
					INNER JOIN tblgt_sales_return_detail d ON h.id = d.sales_return_header_id
					WHERE h.is_inactive = 0 AND d.is_inactive = 0 {$returnSql}
				) returned
				ON invoice.id = returned.invoice_header_id
				AND delivery.product_id = returned.product_id
				INNER JOIN tblgt_product
				ON delivery.product_id = tblgt_product.id
				WHERE invoice.id = :invoice_id AND delivery.product_id = :product_id AND NOT (returned.product_id IS NOT NULL AND returned.invoice_header_id IS NULL)
				GROUP BY invoice.id, delivery.product_id";

		$params = array(
			':invoice_id' => ($invoiceHeaderId === null) ? $this->salesReturnHeader->invoice_header_id : $invoiceHeaderId,
			':product_id' => $this->product_id,
		);
		
		if (!$this->isNewRecord)
			$params['return_id'] = $this->salesReturnHeader->id;
		
		$value = CActiveRecord::$db->createCommand($sql)->queryScalar($params);

		return ($value === false) ? 0.00 : $value;
	}
}
