<?php

class SalesItemController extends Controller {

    public function filters() {
        return array(
            'access',
        );
    }

    public function filterAccess($filterChain) {
        if ($filterChain->action->id === 'report') {
            if (!(Yii::app()->user->checkAccess('ntInvoiceReport') || Yii::app()->user->checkAccess('tInvoiceReport') || Yii::app()->user->checkAccess('tsInvoiceReport')))
                $this->redirect(array('/site/login'));
        }

        $filterChain->run();
    }

    public function actionReport() {
        $product = new Product('search');
        $product->unsetAttributes();
        if (isset($_GET['Product'])) {
            $product->attributes = $_GET['Product'];
        }

        $startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : date('Y-m-d');
        $endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : date('Y-m-d');
        $pageSize = (isset($_GET['PageSize'])) ? $_GET['PageSize'] : '';
        $currentPage = (isset($_GET['page'])) ? $_GET['page'] : '';
        $currentSort = (isset($_GET['sort'])) ? $_GET['sort'] : '';

        $dataProvider = $product->search();
        $dataProvider->criteria->with = array('category', 'deliveryDetails' => array(
            'with' => array('deliveryHeader' => array(
                'condition' => "date BETWEEN :startDate AND :endDate",
                'params' => array(':startDate' => $startDate, ':endDate' => $endDate),
            )),
        ));
        $dataProvider->criteria->together = true;

        $page = array('size' => $pageSize, 'current' => $currentPage);

        $sort = new CSort(get_class($product));
        $sort->attributes = array('t.name', 'category.name');

        $dataProvider = ReportHelper::finalizeDataProvider($dataProvider, $page, $sort);

        $this->render('report', array(
            'product' => $product,
            'dataProvider' => $dataProvider,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'sort' => $sort,
            'currentSort' => $currentSort,
        ));
    }

    protected function reportGrandTotal($dataProvider) {
        $grandTotal = 0.00;

        foreach ($dataProvider->data as $data) {
            $grandTotal += $data->totalSales;
        }

        return $grandTotal;
    }

}
