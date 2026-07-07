<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'

        if (Yii::app()->user->isGuest) {
            $this->redirect(array('login'));
        }
        
        $this->render('index');
    }

    public function actionDashboard() {
        set_time_limit(0);
        ini_set('memory_limit', '1024M');
        
        $totalReceivables = ReceiptHeader::totalReceivables();
        $totalPayables = PurchaseReceiptHeader::totalPayables();
        
        $resultSet = RegistrationTransaction::graphSale();
        $records = array();
        $year = intval(date('Y'));
        $month = intval(date('m'));
        for ($i = 0; $i < 12; $i++) {
            $records[$year][$month] = 0;
            $month--;
            if ($month <= 0) {
                $month += 12;
                $year--;
            }
        }
        foreach ($resultSet as $item) {
            $month = intval($item['month']);
            $year = intval($item['year']);
            if (isset($records[$year][$month])) {
                $records[$year][$month] = doubleval($item['grand_total']);
            }
        }
        $rows = array();
        foreach ($records as $y => $record) {
            foreach ($record as $m => $value) {
                $month = date("M", mktime(0, 0, 0, $m));
                $year = substr($y, 2);
                $rows[] = array($month . " " . $year, $value);
            }
        }
        $dataSale = array_merge(array(array('Monthly', 'Sales')), array_reverse($rows));

        if (!Yii::app()->user->isGuest) {
            $supplier = new Supplier('search');
            $supplier->attributes = isset($_GET['Supplier']) ? $_GET['Supplier'] : '';
            $supplierDataProvider = $supplier->search();

            $customer = new Customer('search');
            $customer->attributes = isset($_GET['Customer']) ? $_GET['Customer'] : '';
            $customerDataProvider = $customer->search();

            $this->render('dashboard', array(
                'supplier' => $supplier,
                'supplierDataProvider' => $supplierDataProvider,
                'customer' => $customer,
                'customerDataProvider' => $customerDataProvider,
                'totalReceivables' => $totalReceivables,
                'totalPayables' => $totalPayables,
            ));
        } else {
            $this->redirect(array('/site/login'));
        }
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(array('index'));
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionSelect($view, $option) {
        Yii::app()->session['DatabaseConnection'] = $option;

        $this->redirect(array('site/page', 'view' => $view));
    }

    public function actionAjaxHtmlSelectView($type) {
        if (Yii::app()->request->isAjaxRequest) {
            if ($type == 1) {
                $this->renderPartial('//../modules/admin/views/supplier/view', array(
                    'model' => Supplier::model()->findByPk($_POST['SupplierId']),
                ), false, true);
            } else {
                $this->renderPartial('//../modules/admin/views/customer/view', array(
                    'model' => Customer::model()->findByPk($_POST['CustomerId']),
                ), false, true);
            }
        }
    }
}