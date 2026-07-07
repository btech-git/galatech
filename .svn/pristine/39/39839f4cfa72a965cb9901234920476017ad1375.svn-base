<?php

class Completion extends CComponent
{
        public static function product($term)
        {
                $items = Product::model()->findAll(array('condition'=>'name LIKE :name', 'params'=>array(':name'=>'%'.$term.'%'), 'limit'=>10));

                $rows = array();
                foreach ($items as $item)
                {
                        $rows[] = array(
                                'label'=>$item->code.' - '.$item->name,  // label for dropdown list
                                'value'=>$item->id,  // value for input field
                                'id'=>$item->name,  // return value from autocomplete
                        );
                }

                return $rows;
        }
        
        public static function supplier($term)
        {
                $items = Supplier::model()->findAll(array('condition'=>'name LIKE :name OR company LIKE :company', 'params'=>array(':name'=>'%'.$term.'%', ':company'=>'%'.$term.'%'), 'limit'=>10));
                
                $rows = array();
                foreach ($items as $item)
                {
                        $rows[] = array(
                                'label'=>$item->company.' - '.$item->name, //label for dropdown list
                                'value'=>$item->id, //value for input field
                                'id'=>$item->company, //return value from autocomplete
                        );
                }
                
                return $rows;
        }
        
        public static function customer($term)
        {
                $items = Customer::model()->findAll(array('condition'=>'name LIKE :name OR company LIKE :company', 'params'=>array(':name'=>'%'.$term.'%', ':company'=>'%'.$term.'%'), 'limit'=>10));
                
                $rows = array();
                foreach ($items as $item)
                {
                        $rows[] = array(
                                'label'=>$item->company.' - '.$item->name, //label for dropdown list
                                'value'=>$item->id, //value for input field
                                'id'=>$item->company, //return value from autocomplete
                        );
                }
                
                return $rows;
        }
        
        public static function account($term)
        {
                $items = Account::model()->findAll(array('condition'=>'name LIKE :name OR code LIKE :code', 'params'=>array(':name'=>'%'.$term.'%', ':code'=>'%'.$term.'%'), 'limit'=>10));

                $rows = array();
                foreach ($items as $item)
                {
                        $rows[] = array(
                                'label'=>$item->code.' - '.$item->name,  // label for dropdown list
                                'value'=>$item->id,  // value for input field
                                'id'=>$item->name,  // return value from autocomplete
                        );
                }

                return $rows;
        }
}
