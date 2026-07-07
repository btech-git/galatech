<?php

class ReceiptController extends Controller {

    public function filters() {
        return array(
            'access',
        );
    }

    public function filterAccess($filterChain) {
        $taxCreateValid = Yii::app()->user->checkAccess('tAccountingCreate') || Yii::app()->user->checkAccess('tsAccountingCreate');
        $nonTaxCreateValid = Yii::app()->user->checkAccess('ntAccountingCreate');
        $taxEditValid = Yii::app()->user->checkAccess('tAccountingEdit') || Yii::app()->user->checkAccess('tsAccountingEdit');
        $nonTaxEditValid = Yii::app()->user->checkAccess('ntAccountingEdit');

        if ($filterChain->action->id === 'create') {
            $params = $filterChain->controller->actionParams;

            if (isset($params['id'])) {
                if (!($taxEditValid || $nonTaxEditValid)) {
                    $this->redirect(array('/site/login'));
                }
            } else {
                if (isset($params['nt'])) {
                    if (!$nonTaxCreateValid) {
                        $this->redirect(array('/site/login'));
                    }
                } else {
                    if (!$taxCreateValid) {
                        $this->redirect(array('/site/login'));
                    }
                }
            }
        }
        if ($filterChain->action->id === 'ajaxHtmlAddInvoice' || $filterChain->action->id === 'ajaxHtmlRemoveDetail' || $filterChain->action->id === 'ajaxHtmlResetDetail' || $filterChain->action->id === 'customerAjaxData' || $filterChain->action->id === 'memo' || $filterChain->action->id === 'view') {
            if (!($taxCreateValid || $nonTaxCreateValid || $taxEditValid || $nonTaxEditValid)) {
                $this->redirect(array('/site/login'));
            }
        }
        if ($filterChain->action->id === 'delete' || $filterChain->action->id === 'admin') {
            if (!($taxEditValid || $nonTaxEditValid)) {
                $this->redirect(array('/site/login'));
            }
        }
        if ($filterChain->action->id === 'report') {
            if (!(Yii::app()->user->checkAccess('ntAccountingReport') || Yii::app()->user->checkAccess('tAccountingReport') || Yii::app()->user->checkAccess('tsAccountingReport'))) {
                $this->redirect(array('/site/login'));
            }
        }

        $filterChain->run();
    }

    public function actionCreate() {
        $receipt = new Receipt();

        if (isset($_GET['id'])) {
            $receipt->copyFromDb($_GET['id']);
        }

        $customerId = isset($_GET['ReceiptHeader']['customer_id']) ? $_GET['ReceiptHeader']['customer_id'] : '';

        $invoiceHeader = Search::bind(new InvoiceHeader('search'), isset($_GET['InvoiceHeader']) ? $_GET['InvoiceHeader'] : array());
        $invoiceHeaderDataProvider = $invoiceHeader->searchByReceipt();
        $invoiceHeaderDataProvider->criteria->with = array('deliveryHeader');

        if (!empty($customerId)) {
            $invoiceHeaderDataProvider->criteria->addCondition("deliveryHeader.customer_id = :customer_id");
            $invoiceHeaderDataProvider->criteria->params[':customer_id'] = $customerId;
        }
        
        $customer = new Customer('search');
        $customer->unsetAttributes();  // clear any default values
        if (isset($_GET['Customer'])) {
            $customer->attributes = $_GET['Customer'];
        }

        if (empty($receipt->header->id)) {
            $receipt->header->is_non_tax = intval(isset($_GET['nt']));
//            $receipt->header->number = CodeNumber::make($receipt->header, 'number', ($receipt->header->is_non_tax) ? 'NRCP' : 'RCP', ($receipt->header->is_non_tax) ? true : false);
        }

        $receipt->header->admin_id = Yii::app()->user->id;
        $this->loadState($receipt);

        $error = false;

        if (isset($_POST['Submit']) && IdempotentManager::check()) {
            if (empty($receipt->header->id)) {
                $receipt->header->number = CodeNumber::make($receipt->header, 'number', ($receipt->header->is_non_tax) ? 'NRCP' : 'RCP', ($receipt->header->is_non_tax) ? true : false);
            }

            $dbTransaction = CActiveRecord::$db->beginTransaction();
            try {
                if ($receipt->validate() && IdempotentManager::build()->save() && $receipt->save(false)) {
                    $dbTransaction->commit();
                    Yii::app()->session['ReceiptMemoAllowed'] = true;
                    $this->redirect(array('view', 'id' => $receipt->header->id));
                } else {
                    $dbTransaction->rollback();
                    $error = true;
                }
            } catch (Exception $e) {
                $dbTransaction->rollback();
                throw new CHttpException($e->getCode(), $e->getMessage());
            }
        }

        $this->render('create', array(
            'receipt' => $receipt,
            'invoiceHeader' => $invoiceHeader,
            'invoiceHeaderDataProvider' => $invoiceHeaderDataProvider,
            'customer' => $customer,
            'error' => $error,
        ));
    }

    public function actionView($id) {
        $receipt = ReceiptHeader::model()->findByPk($id);

        $this->render('view', array(
            'receipt' => $receipt,
        ));
    }

    public function actionMemo($id) {
        if (!(Yii::app()->user->checkAccess('administrator'))) {
            if (!(isset(Yii::app()->session['ReceiptMemoAllowed']) && Yii::app()->session['ReceiptMemoAllowed'] === true))
                $this->redirect(array('admin'));
        }

        Yii::app()->session->remove('ReceiptMemoAllowed');

        $receipt = ReceiptHeader::model()->findByPk($id);

        $receiptCustomer = ($receipt->is_non_tax) ? $receipt->customer->name : $receipt->customer->company;
        $receiptHeaderText = ($receipt->is_non_tax) ? '' : 'PT. GALATECH JAYA ABADI';

        $this->render('memo', array(
            'receipt' => $receipt,
            'receiptCustomer' => $receiptCustomer,
            'receiptHeaderText' => $receiptHeaderText,
        ));
    }

    public function actionAdmin() {
        $receipt = new ReceiptHeader('search');
        $receipt->unsetAttributes();

        if (isset($_GET['ReceiptHeader'])) {
            $receipt->attributes = $_GET['ReceiptHeader'];
        }

        $dataProvider = $receipt->search();
        $dataProvider->model->resetScope();

        $this->render('admin', array(
            'receipt' => $receipt,
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            $receipt = ReceiptHeader::model()->findByPk($id);
            if ($receipt !== null) {
                $receipt->is_inactive = !$receipt->is_inactive;
                $receipt->update(array('is_inactive'));
            }

            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionReport() {
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

    public function actionCustomerAjaxData($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $receipt = new Receipt();

//            if (!empty($id))
//                $receipt->copyFromDb($id);

            if (!isset($_POST['ReceiptDetail']))
                $receipt->details = array();

            $this->loadState($receipt);

            $object = array(
                'customer_id' => $receipt->header->customer->company,
                'customer_name' => $receipt->header->customer->name,
                'customer_address' => $receipt->header->customer->address,
            );
            echo CJSON::encode($object);
        }
    }

    public function actionAjaxHtmlRemoveDetail($index) {
        if (Yii::app()->request->isAjaxRequest) {
            $receipt = new Receipt();

            $this->loadState($receipt);

            $receipt->removeDetailAt($index);

            $this->renderPartial('_detail', array(
                'receipt' => $receipt,
                'error' => false,
            ));
        }
    }

    public function actionAjaxHtmlResetDetail() {
        if (Yii::app()->request->isAjaxRequest) {
            $receipt = new Receipt();

            $this->loadState($receipt);

            if (isset($_POST['ReceiptHeader']['customer_id']))
                $receipt->resetDetail($_POST['ReceiptHeader']['customer_id']);

            $this->renderPartial('_detail', array(
                'receipt' => $receipt,
                'error' => false,
            ));
        }
    }

    public function actionAjaxHtmlAddInvoice($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $receipt = new Receipt();
            $this->loadState($receipt);

            if (isset($_POST['invoiceHeaderId']))
                $receipt->addInvoice($_POST['invoiceHeaderId']);

            $this->renderPartial('_detail', array(
                'receipt' => $receipt,
                'error' => false,
            ));
        }
    }

    protected function loadState($receipt) {
        if (isset($_POST['ReceiptHeader'])) {
            $receipt->header->attributes = $_POST['ReceiptHeader'];
        }
        if (isset($_POST['ReceiptDetail'])) {
            foreach ($_POST['ReceiptDetail'] as $i => $item) {
                if (isset($receipt->details[$i]))
                    $receipt->details[$i]->attributes = $item;
                else {
                    $detail = new ReceiptDetail();
                    $detail->attributes = $item;
                    $receipt->details[] = $detail;
                }
            }
            if (count($_POST['ReceiptDetail']) < count($receipt->details))
                array_splice($receipt->details, $i + 1);
        }
    }
}
