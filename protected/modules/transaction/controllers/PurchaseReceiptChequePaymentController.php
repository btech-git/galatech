<?php

class PurchaseReceiptChequePaymentController extends Controller
{

	public function filters()
	{
		return array(
			'access',
		);
	}

	public function filterAccess($filterChain)
	{
		if ($filterChain->action->id === 'report')
		{
			if (!(Yii::app()->user->checkAccess('ntAccountingReport') || Yii::app()->user->checkAccess('tAccountingReport') || Yii::app()->user->checkAccess('tsAccountingReport')))
				$this->redirect(array('/site/login'));
		}

		$filterChain->run();
	}

	public function actionReport()
	{
		$purchaseReceipt = new PurchaseReceiptHeader('search');
		$purchaseReceipt->unsetAttributes();
		if (isset($_GET['PurchaseReceiptHeader']))
			$purchaseReceipt->attributes = $_GET['PurchaseReceiptHeader'];

		$startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : '';
		$endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : '';
		$pageSize = (isset($_GET['PageSize'])) ? $_GET['PageSize'] : '';
		$currentPage = (isset($_GET['page'])) ? $_GET['page'] : '';
		$currentSort = (isset($_GET['sort'])) ? $_GET['sort'] : '';
		$supplierId = (isset($_GET['SupplierId'])) ? $_GET['SupplierId'] : '';

		$dataProvider = $purchaseReceipt->search();
		$dataProvider->criteria->compare('supplier_id', $supplierId);
		$dataProvider->criteria->with = array('supplier');

		$page = array('size' => $pageSize, 'current' => $currentPage);
		$date = array('attribute' => 't.date', 'start' => $startDate, 'end' => $endDate);

		$sort = new CSort(get_class($purchaseReceipt));
		$sort->attributes = array('date', 'supplier.name');

		$dataProvider = ReportHelper::finalizeDataProvider($dataProvider, $page, $sort, $date);

		$this->render('report', array(
			'purchaseReceipt' => $purchaseReceipt,
			'dataProvider' => $dataProvider,
			'startDate' => $startDate,
			'endDate' => $endDate,
			'sort' => $sort,
			'currentSort' => $currentSort,
			'supplierId'=>$supplierId,
		));
	}
}
