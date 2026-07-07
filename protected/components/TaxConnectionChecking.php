<?php

class TaxConnectionChecking extends CComponent
{
	public static function isCurrentConnectionPrimary()
	{
		return (isset(Yii::app()->user->serverConnection) && (int)Yii::app()->user->serverConnection === 1) || !isset(Yii::app()->user->serverConnection);
	}

	public static function isCurrentConnectionSecondary()
	{
		return (isset(Yii::app()->user->serverConnection) && (int)Yii::app()->user->serverConnection === 2);
	}
	
	public static function taxValid($userId = null)
	{
		return self::taxSessionValid(array('t'), null, null, $userId);
	}
	
	public static function taxSecondaryValid($userId = null)
	{
		return self::taxSessionValid(array('ts'), null, null, $userId);
	}

	public static function nonTaxValid($userId = null)
	{
		return self::taxSessionValid(array('nt'), null, null, $userId);
	}
	
	public static function transactionValid($userId = null)
	{
		return self::taxSessionValid(null, array('Delivery', 'Purchase', 'PurchaseReturn', 'Receive', 'SalesDownpayment', 'SalesReturn', 'Warehouse'), array('Create'), $userId);
	}
	
	public static function accountingValid($userId = null)
	{
		return self::taxSessionValid(null, array('Accounting', 'Invoice', 'PurchasePayment', 'SalesPayment'), array('Create'), $userId);
	}
	
	public static function deliveryValid($userId = null)
	{
		return self::taxSessionValid(null, array('Delivery'), array('View'), $userId);
	}
	
	public static function transferValid($userId = null)
	{
		return self::taxSessionValid(null, array('Transfer'), array('Create', 'Print'), $userId);
	}
	
	public static function reportValid($userId = null)
	{
		return self::taxSessionValid(null, null, array('Report'), $userId);
	}
	
	public static function revisionValid($userId = null)
	{
		return self::taxSessionValid(null, null, array('Edit'), $userId);
	}
	
	private static function taxSessionValid(array $prefixes = null, array $tasks = null, array $operations = null, $userId = null)
	{
		if ($prefixes === null)
			$prefixes = array('t', 'ts', 'nt');
		
		if ($tasks === null)
			$tasks = array('Accounting', 'Delivery', 'Invoice', 'Purchase', 'PurchasePayment', 'PurchaseReturn', 'Receive', 'SalesDownpayment', 'SalesPayment', 'SalesReturn', 'Warehouse', 'Delivery', 'Transfer');
		
		if ($operations === null)
			$operations = array('Create', 'Edit', 'Report', 'View', 'Print');
		
		if ($userId === null)
			$userId = Yii::app()->user->id;

		$valid = false;

		foreach ($prefixes as $prefix)
		{
			foreach ($tasks as $task)
			{
				$role = $prefix . $task;
				if (!$valid)
					$valid = Yii::app()->authManager->checkAccess($role, $userId) || $valid;

				foreach ($operations as $operation)
				{
					$role2 = $role . $operation;
					if (!$valid)
						$valid = Yii::app()->authManager->checkAccess($role2, $userId) || $valid;
				}
			}
		}

		return $valid;
	}
}