<?php

class TransactionModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application
		// import the module-level models and components
		$this->setImport(array(
			'transaction.models.*',
			'transaction.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if (parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			
			try
			{
//				$taxValid = TaxConnectionChecking::taxValid();
//				$taxSecondaryValid = TaxConnectionChecking::taxSecondaryValid();
//				$nonTaxValid = TaxConnectionChecking::nonTaxValid();
//
//				if ($taxValid && ($taxSecondaryValid || $nonTaxValid))
//				{
//					if (TaxConnectionChecking::isCurrentConnectionPrimary())
//						CActiveRecord::$db = Yii::app()->db;
//					else if (TaxConnectionChecking::isCurrentConnectionSecondary())
//						CActiveRecord::$db = Yii::app()->db2;
//					else
//						CActiveRecord::$db = Yii::app()->db;
//				}
//				else if ($taxValid)
//					CActiveRecord::$db = Yii::app()->db;
//				else if ($taxSecondaryValid || $nonTaxValid)
//					CActiveRecord::$db = Yii::app()->db2;
//				else
//					CActiveRecord::$db = Yii::app()->db;
				
				if ((int)Yii::app()->user->serverConnection === 1)
					CActiveRecord::$db = Yii::app()->db;
				else if ((int)Yii::app()->user->serverConnection === 2)
					CActiveRecord::$db = Yii::app()->db2;
				else
				{
					Yii::app()->user->logout();
					Yii::app()->getRequest()->redirect(Yii::app()->homeUrl);
				}
			}
			catch (Exception $e)
			{
				Yii::app()->user->logout();
				Yii::app()->getRequest()->redirect(Yii::app()->homeUrl);
			}

			return true;
		}
		else
			return false;
	}
}
