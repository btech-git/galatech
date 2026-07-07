<?php

/**
 * This is the model class for table "tblgt_category_material".
 *
 * The followings are the available columns in table 'tblgt_category_material':
 * @property integer $id
 * @property integer $category_id
 * @property integer $material_id
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property Category $category
 * @property Material $material
 * @property CategoryMaterialGrade[] $categoryMaterialGrades
 */
class CategoryMaterial extends ActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @return CategoryMaterial the static model class
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
		return 'tblgt_category_material';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_id, material_id', 'required'),
			array('category_id, material_id, is_inactive', 'numerical', 'integerOnly' => true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, category_id, material_id, is_inactive', 'safe', 'on' => 'search'),
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
			'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
			'material' => array(self::BELONGS_TO, 'Material', 'material_id'),
			'categoryMaterialGrades' => array(self::HAS_MANY, 'CategoryMaterialGrade', 'category_material_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category_id' => 'Category',
			'material_id' => 'Material',
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
		$criteria->compare('category_id', $this->category_id);
		$criteria->compare('material_id', $this->material_id);
		$criteria->compare('is_inactive', $this->is_inactive);

		return new CActiveDataProvider($this, array(
				'criteria' => $criteria,
			));
	}

	public function getName()
	{
		return $this->category->name . ' - ' . $this->material->name;
	}
}