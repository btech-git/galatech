<?php

class ProductComponent extends CComponent
{
	public $header;
	public $details;

	public function __construct($header, array $details)
	{
		$this->header = $header;
		$this->details = $details;
	}
	
	public function addDetail() {
		$this->details[] = new ProductSize();
	}

	public function removeDetailAt($index)
	{
		array_splice($this->details, $index, 1);
	}
	
	public function save($dbConnection)
	{
		$dbTransaction = $dbConnection->beginTransaction();
		try
		{
			$valid = $this->validate();
			if ($valid)
			{
				$valid = $valid && $this->flush();
				if ($valid)
					$dbTransaction->commit();
				else
				{
					$dbTransaction->rollback();
				}
			}
			else
			{
				$dbTransaction->rollback();
			}
		}
		catch (Exception $e)
		{
			$dbTransaction->rollback();
			$valid = false;
			$this->header->addError('error', $e->getMessage());
		}
		
		return $valid;
	}
	
	public function validate()
	{
		$valid = $this->header->validate();
		if (!$valid)
			$this->header->addError('error', 'Header Error');
		
		$valid = $valid && $this->validateDetailsCount();
		if (!$valid)
			$this->header->addError('error', 'Details Count Error');
		
		if (count($this->details) > 0)
		{
			foreach ($this->details as $detail)
			{
				$fields = array('size');
				$valid = $valid && $detail->validate($fields);
				if (!$valid)
					$this->header->addError('error', 'Details Error');
			}
		}
		else
			$valid = false;

		return $valid;
	}
	
	public function validateDetailsCount()
	{
		$valid = true;
		if (count($this->details) === 0)
		{
			$valid = false;
			$this->header->addError('error', 'Form tidak ada data untuk insert database. Minimal satu data detail untuk melakukan penyimpanan.');
		}
		return $valid;
	}
	
	public function flush()
	{
                $valid = true;
		foreach ($this->details as $detail)
                {
                    $product = new Product();
                    $product->attributes = $this->header->attributes;
                    $product->size = $detail->size;
                    $valid = $valid && $product->save(false);
                     
                    $product->code = $product->id;
                    $valid = $valid && $product->save(false);
                }
                
//                    $product = new Product;
//                    $product = $this->header;
//                    $product->size = 5;
//                    $valid = $valid && $product->save(false);
//                     
//                    $product->code = $product->id;
//                    $valid = $valid && $product->save(false);
//                    
//                    $product2 = new Product;
//                    $product2 = $this->header;
//                    $product2->size = 6;
//                    $valid = $valid && $product2->save(false);
//                     
//                    $product2->code = $product2->id;
//                    $valid = $valid && $product2->save(false);
            
		return $valid;
	}
	
	public function delete($db) {
		$dbTransaction = $db->beginTransaction();
		try {
			$valid = TRUE;
			foreach ($this->details as $detail) {
				$detail->is_inactive = 1;
				$valid = $valid && $detail->save();
			}

			$this->header->is_inactive = 1;
			$valid = $valid && $this->header->save();

			if ($valid) $dbTransaction->commit();
			else $dbTransaction->rollback();
		}
		catch (Exception $e) {
			$dbTransaction->rollback();
			Yii::app()->user->setFlash('message', $e->getMessage());
		}
		
		return $valid;
	}
}

