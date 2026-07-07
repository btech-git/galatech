<?php

/**
 * This is the model class for table "tblgt_product".
 *
 * The followings are the available columns in table 'tblgt_product':
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $weighted_purchase_price
 * @property string $selling_price
 * @property string $size
 * @property string $length
 * @property integer $drat
 * @property string $physical_thickness
 * @property string $connection_diameter
 * @property integer $category_id
 * @property integer $type_id
 * @property integer $brand_id
 * @property integer $material_id
 * @property integer $disc_material_id
 * @property integer $body_type_id
 * @property integer $connection_id
 * @property integer $grade_id
 * @property integer $classification_id
 * @property integer $thickness_id
 * @property integer $variety_id
 * @property integer $connection_material_id
 * @property integer $parameter_id
 * @property integer $range_id
 * @property integer $handling_id
 * @property integer $bellow_id
 * @property integer $unit_id
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property AdjustmentDetail[] $adjustmentDetails
 * @property DeliveryDetail[] $deliveryDetails
 * @property IndentDetail[] $indentDetails
 * @property Inventory[] $inventories
 * @property Category $category
 * @property Thickness $thickness
 * @property Unit $unit
 * @property Classification $classification
 * @property Variety $variety
 * @property ConnectionMaterial $connectionMaterial
 * @property Parameter $parameter
 * @property Range $range
 * @property Handling $handling
 * @property Bellow $bellow
 * @property Type $type
 * @property Brand $brand
 * @property Material $material
 * @property DiscMaterial $discMaterial
 * @property BodyType $bodyType
 * @property Connection $connection
 * @property Grade $grade
 * @property PurchaseDetail[] $purchaseDetails
 * @property PurchaseReturnDetail[] $purchaseReturnDetails
 * @property ReceiveDetail[] $receiveDetails
 * @property SalesReturnDetail[] $salesReturnDetails
 * @property TransferDetail[] $transferDetails
 */
class Product extends ActiveRecord {

    public $sizes = array();

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Product the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tblgt_product';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('category_id, unit_id', 'required'),
            array('drat, category_id, type_id, brand_id, material_id, disc_material_id, body_type_id, connection_id, grade_id, classification_id, thickness_id, variety_id, connection_material_id, parameter_id, range_id, handling_id, bellow_id, unit_id, is_inactive', 'numerical', 'integerOnly' => true),
            array('code, size, length', 'length', 'max' => 60),
            array('name', 'length', 'max' => 200),
            array('weighted_purchase_price, selling_price, physical_thickness, connection_diameter', 'length', 'max' => 18),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, code, name, weighted_purchase_price, selling_price, size, length, drat, physical_thickness, connection_diameter, category_id, type_id, brand_id, material_id, disc_material_id, body_type_id, connection_id, grade_id, classification_id, thickness_id, variety_id, connection_material_id, parameter_id, range_id, handling_id, bellow_id, unit_id, is_inactive', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'adjustmentDetails' => array(self::HAS_MANY, 'AdjustmentDetail', 'product_id'),
            'deliveryDetails' => array(self::HAS_MANY, 'DeliveryDetail', 'product_id'),
            'indentDetails' => array(self::HAS_MANY, 'IndentDetail', 'product_id'),
            'inventories' => array(self::HAS_MANY, 'Inventory', 'product_id'),
            'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
            'thickness' => array(self::BELONGS_TO, 'Thickness', 'thickness_id'),
            'unit' => array(self::BELONGS_TO, 'Unit', 'unit_id'),
            'classification' => array(self::BELONGS_TO, 'Classification', 'classification_id'),
            'variety' => array(self::BELONGS_TO, 'Variety', 'variety_id'),
            'connectionMaterial' => array(self::BELONGS_TO, 'ConnectionMaterial', 'connection_material_id'),
            'parameter' => array(self::BELONGS_TO, 'Parameter', 'parameter_id'),
            'range' => array(self::BELONGS_TO, 'Range', 'range_id'),
            'handling' => array(self::BELONGS_TO, 'Handling', 'handling_id'),
            'bellow' => array(self::BELONGS_TO, 'Bellow', 'bellow_id'),
            'type' => array(self::BELONGS_TO, 'Type', 'type_id'),
            'brand' => array(self::BELONGS_TO, 'Brand', 'brand_id'),
            'material' => array(self::BELONGS_TO, 'Material', 'material_id'),
            'discMaterial' => array(self::BELONGS_TO, 'DiscMaterial', 'disc_material_id'),
            'bodyType' => array(self::BELONGS_TO, 'BodyType', 'body_type_id'),
            'connection' => array(self::BELONGS_TO, 'Connection', 'connection_id'),
            'grade' => array(self::BELONGS_TO, 'Grade', 'grade_id'),
            'purchaseDetails' => array(self::HAS_MANY, 'PurchaseDetail', 'product_id'),
            'purchaseReturnDetails' => array(self::HAS_MANY, 'PurchaseReturnDetail', 'product_id'),
            'receiveDetails' => array(self::HAS_MANY, 'ReceiveDetail', 'product_id'),
            'salesReturnDetails' => array(self::HAS_MANY, 'SalesReturnDetail', 'product_id'),
            'transferDetails' => array(self::HAS_MANY, 'TransferDetail', 'product_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'weighted_purchase_price' => 'Weighted Purchase Price',
            'selling_price' => 'Selling Price',
            'size' => 'Size',
            'length' => 'Length',
            'drat' => 'Drat',
            'physical_thickness' => 'Physical Thickness',
            'connection_diameter' => 'Connection Diameter',
            'category_id' => 'Category',
            'type_id' => 'Type',
            'brand_id' => 'Brand',
            'material_id' => 'Material',
            'disc_material_id' => 'Disc Material',
            'body_type_id' => 'Body Type',
            'connection_id' => 'Connection',
            'grade_id' => 'Grade',
            'classification_id' => 'Classification',
            'thickness_id' => 'Thickness',
            'variety_id' => 'Variety',
            'connection_material_id' => 'Connection Material',
            'parameter_id' => 'Parameter',
            'range_id' => 'Range',
            'handling_id' => 'Handling',
            'bellow_id' => 'Bellow',
            'unit_id' => 'Unit',
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
        $criteria->compare('code', $this->code, true);

        $keywords = explode(' ', $this->name);
        foreach ($keywords as $keyword) {
            $criteria->compare('t.name', trim($keyword), true, 'AND');
        }

        $criteria->compare('weighted_purchase_price', $this->weighted_purchase_price, true);
        $criteria->compare('selling_price', $this->selling_price, true);
        $criteria->compare('size', $this->size, true);
        $criteria->compare('length', $this->length, true);
        $criteria->compare('drat', $this->drat);
        $criteria->compare('physical_thickness', $this->physical_thickness, true);
        $criteria->compare('connection_diameter', $this->connection_diameter, true);
        $criteria->compare('category_id', $this->category_id);
        $criteria->compare('type_id', $this->type_id);
        $criteria->compare('brand_id', $this->brand_id);
        $criteria->compare('material_id', $this->material_id);
        $criteria->compare('disc_material_id', $this->disc_material_id);
        $criteria->compare('body_type_id', $this->body_type_id);
        $criteria->compare('connection_id', $this->connection_id);
        $criteria->compare('grade_id', $this->grade_id);
        $criteria->compare('classification_id', $this->classification_id);
        $criteria->compare('thickness_id', $this->thickness_id);
        $criteria->compare('variety_id', $this->variety_id);
        $criteria->compare('connection_material_id', $this->connection_material_id);
        $criteria->compare('parameter_id', $this->parameter_id);
        $criteria->compare('range_id', $this->range_id);
        $criteria->compare('handling_id', $this->handling_id);
        $criteria->compare('bellow_id', $this->bellow_id);
        $criteria->compare('unit_id', $this->unit_id);
        $criteria->compare('is_inactive', $this->is_inactive);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 50,
            ),
        ));
    }

    public function getLocalStock($warehouseId) {
        $sql = SqlGenerator::localStock();

        $value = CActiveRecord::$db->createCommand($sql)->queryScalar(array(
            ':product_id' => $this->id,
            ':warehouse_id' => $warehouseId,
        ));

        return ($value === false) ? 0 : $value;
    }

    public function getCurrentStock() {
        $sql = SqlGenerator::globalStock();

//        $sql = "
//            SELECT COALESCE(SUM(quantity_in - quantity_out), 0) AS current_stock 
//            FROM " . Inventory::model()->tableName() . "
//            WHERE product_id = :product_id AND is_inactive = 0
//            GROUP BY product_id
//        ";

        $value = CActiveRecord::$db->createCommand($sql)->queryScalar(array(
            ':product_id' => $this->id,
        ));

        return ($value === false) ? 0 : $value;
    }

    public function getInventoryStockReport($startDate, $endDate) {
        
        $params = array(
            ':start_date' => $startDate,
            ':end_date' => $endDate,
            ':product_id' => $this->id,
        );
        
        $sql = "SELECT i.id, i.transaction_number, i.date, i.transaction_type, i.transaction_subject, i.quantity_in, i.quantity_out, w.name as warehouse_name
                FROM " . Inventory::model()->tableName() . " i
                INNER JOIN " . Warehouse::model()->tableName() . " w ON w.id = i.warehouse_id
                WHERE i.date BETWEEN :start_date AND :end_date AND i.is_inactive = 0 AND i.product_id = :product_id
                ORDER BY i.date ASC";
        
        $resultSet = Yii::app()->db->createCommand($sql)->queryAll(true, $params);
        
        return $resultSet;
    }
    
    public function getStockBeginning($startDate) {
        $sql = SqlGenerator::stockBeginning();

//        $sql = "
//            SELECT COALESCE(SUM(quantity_in - quantity_out), 0) AS current_stock 
//            FROM " . Inventory::model()->tableName() . "
//            WHERE product_id = :product_id AND is_inactive = 0 AND date < :start_date
//            GROUP BY product_id
//        ";

        $value = CActiveRecord::$db->createCommand($sql)->queryScalar(array(
            ':product_id' => $this->id,
            ':start_date' => $startDate,
        ));

        return ($value === false) ? 0 : $value;
    }

    public function getStockEnding($endDate) {
        $sql = SqlGenerator::stockEnding();

        $value = CActiveRecord::$db->createCommand($sql)->queryScalar(array(
            ':product_id' => $this->id,
            ':end_date' => $endDate,
        ));

        return ($value === false) ? 0 : $value;
    }

    public function getStockIn($startDate, $endDate) {
        $sql = SqlGenerator::stockIn();

//        $sql = "
//            SELECT COALESCE(SUM(quantity_in), 0) AS stock_in 
//            FROM " . Inventory::model()->tableName() . "
//            WHERE product_id = :product_id AND is_inactive = 0 AND date BETWEEN :start_date AND :end_date
//            GROUP BY product_id
//        ";

        $value = CActiveRecord::$db->createCommand($sql)->queryScalar(array(
            ':product_id' => $this->id,
            ':start_date' => $startDate,
            ':end_date' => $endDate,
        ));

        return ($value === false) ? 0 : $value;
    }

    public function getStockOut($startDate, $endDate) {
        $sql = SqlGenerator::stockOut();

//        $sql = "
//            SELECT COALESCE(SUM(quantity_out), 0) AS stock_out 
//            FROM " . Inventory::model()->tableName() . "
//            WHERE product_id = :product_id AND is_inactive = 0 AND date BETWEEN :start_date AND :end_date
//            GROUP BY product_id
//        ";

        $value = CActiveRecord::$db->createCommand($sql)->queryScalar(array(
            ':product_id' => $this->id,
            ':start_date' => $startDate,
            ':end_date' => $endDate,
        ));

        return ($value === false) ? 0 : $value;
    }

    public function getTotalQuantitySales() {
        $totalQuantitySales = '0.00';

        foreach ($this->deliveryDetails as $deliveryDetail) {
            $totalQuantitySales += $deliveryDetail->quantity;
        }

        return $totalQuantitySales;
    }

    public function getTotalSales() {
        $totalSales = '0.00';

        foreach ($this->deliveryDetails as $deliveryDetail) {
            $totalSales += $deliveryDetail->total * (1 + ($deliveryDetail->deliveryHeader->tax/100));
        }

        return $totalSales;
    }

    public function getTotalQuantityPurchase() {
        $totalQuantityPurchase = '0.00';

        foreach ($this->purchaseDetails as $purchaseDetail) {
            $totalQuantityPurchase += $purchaseDetail->quantity;
        }

        return $totalQuantityPurchase;
    }

    public function getTotalQuantityReceive() {
        $sql = "SELECT SUM(quantity_received) AS total_quantity
                FROM " . PurchaseDetail::model()->tableName() . " 
                WHERE product_id = :product_id";

        $value = Yii::app()->db->createCommand($sql)->queryScalar(array(
            ':product_id' => $this->id,
        ));

        return $value;
    }

    public function getTotalPurchase() {
        $sql = "SELECT SUM(quantity_received * price_before_tax) AS total_price
                FROM " . PurchaseDetail::model()->tableName() . " 
                WHERE product_id = :product_id";

        $value = Yii::app()->db->createCommand($sql)->queryScalar(array(
            ':product_id' => $this->id,
        ));

        return $value;
    }

    public function getPurchasePerItem() {
        $purchasePerItem = '0.00';

        foreach ($this->purchaseDetails as $purchaseDetail) {
            $purchasePerItem = $purchaseDetail->total * (1 - $purchaseDetail->purchaseHeader->discount / 100) * (1 + $purchaseDetail->purchaseHeader->tax / 100);
        }
        
        return $purchasePerItem;
    }

    public function getTotalReceive() {
        $totalReceive = '0.00';

        foreach ($this->receiveDetails as $receiveDetail) {
            $totalReceive += $receiveDetail->total;
        }

        return $totalReceive;
    }

    public function getCostOfGoodsSold() {
        $cogs = '0.00';

        if ($this->totalQuantityPurchase > 0) {
            $cogs = $this->totalPurchase / $this->totalQuantityPurchase;
        }

        return $cogs;
    }

    public function getPurchaseItemsReport($startDate, $endDate) {
        
        $sql = "
            SELECT d.product_id, h.number, h.date, s.company, d.quantity, d.unit_price, d.discount, d.quantity * (d.unit_price * (1 - (d.discount / 100))) AS total
            FROM " . PurchaseDetail::model()->tableName() . " d 
            INNER JOIN " . PurchaseHeader::model()->tableName() . " h ON h.id = d.purchase_header_id
            INNER JOIN " . Supplier::model()->tableName() . " s ON s.id = h.supplier_id
            WHERE h.date BETWEEN :start_date AND :end_date AND d.product_id = :product_id
            ORDER BY h.date, h.number
        ";

        $resultSet = Yii::app()->db->createCommand($sql)->queryAll(true, array(
            ':start_date' => $startDate,
            ':end_date' => $endDate,
            ':product_id' => $this->id
        ));
        
        return $resultSet;
    }
}
