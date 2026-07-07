<?php

class BalanceSheetController extends Controller {

    public function filters() {
        return array(
            'access',
        );
    }

    public function filterAccess($filterChain) {
        if ($filterChain->action->id === 'report') {
            if (!(Yii::app()->user->checkAccess('ntAccountingReport') || Yii::app()->user->checkAccess('tAccountingReport') || Yii::app()->user->checkAccess('tsAccountingReport')))
                $this->redirect(array('/site/login'));
        }

        $filterChain->run();
    }

    public function actionReport() {
        $accountCategoryTypes = AccountCategoryType::model()->findAll(array('condition' => "id IN ( 1, 2)"));

        $endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : date('Y-m-d');

        $this->render('report', array(
            'accountCategoryTypes' => $accountCategoryTypes,
            'endDate' => $endDate,
        ));
    }

}
