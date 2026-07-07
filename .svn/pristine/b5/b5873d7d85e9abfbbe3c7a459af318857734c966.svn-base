<?php

class PurchaseItemsController extends Controller {

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
        set_time_limit(0);
        ini_set('memory_limit', '1024M');
        
        $startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : date('Y-m-d');
        $endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : date('Y-m-d');
        $pageSize = (isset($_GET['PageSize'])) ? $_GET['PageSize'] : '';
        $currentPage = (isset($_GET['page'])) ? $_GET['page'] : '';
        $currentSort = (isset($_GET['sort'])) ? $_GET['sort'] : '';
        
        $product = Search::bind(new Product('search'), isset($_GET['Product']) ? $_GET['Product'] : array());
        $purchaseItemsReport = new PurchaseItemsReport($product->search());
        $purchaseItemsReport->setupLoading();
        $purchaseItemsReport->setupPaging($pageSize, $currentPage);
        $purchaseItemsReport->setupSorting();
        $purchaseItemsReport->setupFilter( $startDate, $endDate);
        
        $this->render('report', array(
            'product' => $product,
            'purchaseItemsReport' => $purchaseItemsReport,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'pageSize' => $pageSize,
            'currentPage' => $currentPage,
            'currentSort' => $currentSort,
        ));
    }
}