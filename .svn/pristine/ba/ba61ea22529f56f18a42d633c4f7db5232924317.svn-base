<?php

/**
 * This is the model class for table "tblgt_category_brand_connection".
 *
 * The followings are the available columns in table 'tblgt_category_brand_connection':
 * @property integer $id
 * @property integer $category_brand_id
 * @property integer $connection_id
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property Connection $connection
 * @property CategoryBrand $categoryBrand
 */
class CategoryBrandConnection extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CategoryBrandConnection the static model class
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
		return 'tblgt_category_brand_connection';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_brand_id, connection_id', 'required'),
			array('category_brand_id, connection_id, is_inactive', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, category_brand_id, connection_id, is_inactive', 'safe', 'on'=>'search'),
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
			'connection' => array(self::BELONGS_TO, 'Connection', 'connection_id'),
			'categoryBrand' => array(self::BELONGS_TO, 'CategoryBrand', 'category_brand_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category_brand_id' => 'Category Brand',
			'connection_id' => 'Connection',
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
		$criteria->compare('category_brand_id',$this->category_brand_id);
		$criteria->compare('connection_id',$this->connection_id);
		$criteria->compare('is_inactive',$this->is_inactive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}