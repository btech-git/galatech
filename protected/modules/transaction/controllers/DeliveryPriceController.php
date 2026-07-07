<?php

class DeliveryPriceController extends SelectionController
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
			if (!(Yii::app()->user->checkAccess('ntDeliveryReport') || Yii::app()->user->checkAccess('tDeliveryReport') || Yii::app()->user->checkAccess('tsDeliveryReport')))
				$this->redirect(array('/site/login'));
		}

		$filterChain->run();
	}
	
	public function actionReport()
	{
		$deliveryHeader = new DeliveryHeader('search');
		$deliveryHeader->unsetAttributes();
		if (isset($_GET['DeliveryHeader']))
			$deliveryHeader->attributes = $_GET['DeliveryHeader'];

		$startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : '';
		$endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : '';
		$pageSize = (isset($_GET['PageSize'])) ? $_GET['PageSize'] : '';
		$currentPage = (isset($_GET['page'])) ? $_GET['page'] : '';
		$currentSort = (isset($_GET['sort'])) ? $_GET['sort'] : '';

		$dataProvider = $deliveryHeader->search();
		$dataProvider->criteria->with = array('customer');

		$page = array('size' => $pageSize, 'current' => $currentPage);
		$date = array('attribute' => 'date', 'start' => $startDate, 'end' => $endDate);

		$sort = new CSort(get_class($deliveryHeader));
		$sort->attributes = array('date', 'customer.name');

		$dataProvider = ReportHelper::finalizeDataProvider($dataProvider, $page, $sort, $date);

		$this->render('report', array(
			'deliveryHeader' => $deliveryHeader,
			'dataProvider' => $dataProvider,
			'startDate' => $startDate,
			'endDate' => $endDate,
			'sort' => $sort,
			'currentSort' => $currentSort,
		));
	}
	
	protected function reportGrandTotal($dataProvider)
	{
		$grandTotal = 0.00;

		foreach ($dataProvider->data as $data)
			$grandTotal += $data->grandTotal;

		return $grandTotal;
	}

}
?>
