<?php

/**
 * This is the model class for table "tblgt_category".
 *
 * The followings are the available columns in table 'tblgt_category':
 * @property integer $id
 * @property string $name
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property CategoryBrand[] $categoryBrands
 * @property CategoryClassification[] $categoryClassifications
 * @property CategoryConnection[] $categoryConnections
 * @property CategoryGrade[] $categoryGrades
 * @property CategoryMaterial[] $categoryMaterials
 * @property CategorySpecification[] $categorySpecifications
 * @property CategoryThickness[] $categoryThicknesses
 * @property CategoryType[] $categoryTypes
 * @property CategoryVariety[] $categoryVarieties
 * @property Product[] $products
 */
class Category extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Category the static model class
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
		return 'tblgt_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('is_inactive', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>60),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, is_inactive', 'safe', 'on'=>'search'),
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
			'categoryBrands' => array(self::HAS_MANY, 'CategoryBrand', 'category_id'),
			'categoryClassifications' => array(self::HAS_MANY, 'CategoryClassification', 'category_id'),
			'categoryConnections' => array(self::HAS_MANY, 'CategoryConnection', 'category_id'),
			'categoryGrades' => array(self::HAS_MANY, 'CategoryGrade', 'category_id'),
			'categoryMaterials' => array(self::HAS_MANY, 'CategoryMaterial', 'category_id'),
			'categorySpecifications' => array(self::HAS_MANY, 'CategorySpecification', 'category_id'),
			'categoryThicknesses' => array(self::HAS_MANY, 'CategoryThickness', 'category_id'),
			'categoryTypes' => array(self::HAS_MANY, 'CategoryType', 'category_id'),
			'categoryVarieties' => array(self::HAS_MANY, 'CategoryVariety', 'category_id'),
			'products' => array(self::HAS_MANY, 'Product', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('is_inactive',$this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}