<?php

class TaxFormController extends Controller
{
	public function filters()
	{
		return array(
			'access',
		);
	}

	public function filterAccess($filterChain)
	{
		if ($filterChain->action->id === 'view' || $filterChain->action->id === 'create' || $filterChain->action->id === 'deliveryAjaxData' || $filterChain->action->id === 'showDeliveryAjax' || $filterChain->action->id === 'taxForm' || $filterChain->action->id === 'memo')
		{
			if (!(Yii::app()->user->checkAccess('ntInvoiceCreate') || Yii::app()->user->checkAccess('ntInvoiceEdit') || Yii::app()->user->checkAccess('tInvoiceCreate') || Yii::app()->user->checkAccess('tInvoiceEdit') || Yii::app()->user->checkAccess('tsInvoiceCreate') || Yii::app()->user->checkAccess('tsInvoiceEdit')))
				$this->redirect(array('/site/login'));
		}
		if ($filterChain->action->id === 'report')
		{
			if (!(Yii::app()->user->checkAccess('ntInvoiceReport') || Yii::app()->user->checkAccess('tInvoiceReport') || Yii::app()->user->checkAccess('tsInvoiceReport')))
				$this->redirect(array('/site/login'));
		}

		$filterChain->run();
	}
	
	public function actionMemo($id, $modelType)
	{
		$taxForm = TaxForm::model()->findByPk($id);

		$this->render('memo', array(
			'taxForm' => $taxForm,
			'modelType' => $modelType,
		));
	}
}
