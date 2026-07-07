<?php

/**
 * This is the model class for table "tblgt_grade".
 *
 * The followings are the available columns in table 'tblgt_grade':
 * @property integer $id
 * @property string $name
 * @property integer $is_inactive
 *
 * The followings are the available model relations:
 * @property CategoryGrade[] $categoryGrades
 * @property CategoryMaterialGrade[] $categoryMaterialGrades
 * @property Product[] $products
 */
class Grade extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Grade the static model class
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
		return 'tblgt_grade';
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
			'categoryGrades' => array(self::HAS_MANY, 'CategoryGrade', 'grade_id'),
			'categoryMaterialGrades' => array(self::HAS_MANY, 'CategoryMaterialGrade', 'grade_id'),
			'products' => array(self::HAS_MANY, 'Product', 'grade_id'),
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