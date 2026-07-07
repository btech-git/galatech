<?php

class SaleReceiptChequePaymentController extends Controller
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
		$receipt = new ReceiptHeader('search');
		$receipt->unsetAttributes();
		if (isset($_GET['ReceiptHeader']))
			$receipt->attributes = $_GET['ReceiptHeader'];

		$startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : '';
		$endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : '';
		$pageSize = (isset($_GET['PageSize'])) ? $_GET['PageSize'] : '';
		$currentPage = (isset($_GET['page'])) ? $_GET['page'] : '';
		$currentSort = (isset($_GET['sort'])) ? $_GET['sort'] : '';
		$customerId = (isset($_GET['CustomerId'])) ? $_GET['CustomerId'] : '';

		$dataProvider = $receipt->search();
		$dataProvider->criteria->compare('customer_id', $customerId);
		$dataProvider->criteria->with = array('customer');

		$page = array('size' => $pageSize, 'current' => $currentPage);
		$date = array('attribute' => 't.date', 'start' => $startDate, 'end' => $endDate);

		$sort = new CSort(get_class($receipt));
		$sort->attributes = array('date', 'customer.name');

		$dataProvider = ReportHelper::finalizeDataProvider($dataProvider, $page, $sort, $date);

		$this->render('report', array(
			'receipt' => $receipt,
			'dataProvider' => $dataProvider,
			'startDate' => $startDate,
			'endDate' => $endDate,
			'sort' => $sort,
			'currentSort' => $currentSort,
			'customerId' => $customerId,
		));
	}
}
