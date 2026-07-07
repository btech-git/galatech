<?php

class ProductSize extends CFormModel {

    public $size;
    public $is_inactive;

    public function rules() {
        return array(
            array('size', 'required'),
            array('is_inactive', 'numerical', 'integerOnly' => true),
//            array('size', 'max' => 60),
//            array('size, is_inactive', 'safe', 'on' => 'search'),
        );
    }

    public function attributeLabels() {
        return array(
            'verifyCode' => 'Verification Code',
        );
    }

}