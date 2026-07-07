<?php

class PurchasePaymentController extends Controller {

    public function filters() {
        return array(
            'access',
        );
    }

    public function filterAccess($filterChain) {
        $taxCreateValid = Yii::app()->user->checkAccess('tPurchasePaymentCreate') || Yii::app()->user->checkAccess('tsPurchasePaymentCreate');
        $nonTaxCreateValid = Yii::app()->user->checkAccess('ntPurchasePaymentCreate');
        $taxEditValid = Yii::app()->user->checkAccess('tPurchasePaymentEdit') || Yii::app()->user->checkAccess('tsPurchasePaymentEdit');
        $nonTaxEditValid = Yii::app()->user->checkAccess('ntPurchasePaymentEdit');

        if ($filterChain->action->id === 'create') {
            $params = $filterChain->controller->actionParams;

            if (isset($params['id'])) {
                if (!($taxEditValid || $nonTaxEditValid))
                    $this->redirect(array('/site/login'));
            } else {
                if (isset($params['nt'])) {
                    if (!$nonTaxCreateValid)
                        $this->redirect(array('/site/login'));
                } else {
                    if (!$taxCreateValid)
                        $this->redirect(array('/site/login'));
                }
            }
        }
        if ($filterChain->action->id === 'addPaymentAjax' || $filterChain->action->id === 'paymentAjaxData' || $filterChain->action->id === 'removePaymentAjax' || $filterChain->action->id === 'resetPaymentAjax' || $filterChain->action->id === 'summaryAjaxData' || $filterChain->action->id === 'view') {
            if (!($taxCreateValid || $nonTaxCreateValid || $taxEditValid || $nonTaxEditValid))
                $this->redirect(array('/site/login'));
        }
        if ($filterChain->action->id === 'delete' || $filterChain->action->id === 'admin') {
            if (!($taxEditValid || $nonTaxEditValid))
                $this->redirect(array('/site/login'));
        }
        if ($filterChain->action->id === 'report') {
            if (!(Yii::app()->user->checkAccess('ntPurchasePaymentReport') || Yii::app()->user->checkAccess('tPurchasePaymentReport') || Yii::app()->user->checkAccess('tsPurchasePaymentReport')))
                $this->redirect(array('/site/login'));
        }

        $filterChain->run();
    }

    public function actionCreate() {
        $purchasePayment = new PurchasePayment();

        if (isset($_GET['id'])) {
            $purchasePayment->copyFromDb($_GET['id']);
        }

        if (empty($purchasePayment->header->id)) {
            $purchasePayment->header->is_non_tax = intval(isset($_GET['nt']));
//            $purchasePayment->header->number = CodeNumber::make($purchasePayment->header, 'number', ($purchasePayment->header->is_non_tax) ? 'NPPY' : 'PPY', ($purchasePayment->header->is_non_tax) ? true : false);
        }

        $purchasePaymentAccountSecondary = 'id IN (3, 48, 1, 215, 288, 370, 160, 161, 467)';
        $purchasePaymentAccountPrimary = 'id IN (47, 2, 214, 260, 160, 161, 463)';

        $purchasePayment->header->admin_id = Yii::app()->user->id;
        $this->loadState($purchasePayment);

        $supplier = new Supplier('search');
        $supplier->unsetAttributes();  // clear any default values
        if (isset($_GET['Supplier'])) {
            $supplier->attributes = $_GET['Supplier'];
        }

        $supplierId = isset($_GET['PurchasePaymentHeaderRev']['supplier_id']) ? $_GET['PurchasePaymentHeaderRev']['supplier_id'] : '';

        $purchaseReceiptHeader = Search::bind(new PurchaseReceiptHeader('search'), isset($_GET['PurchaseReceiptHeader']) ? $_GET['PurchaseReceiptHeader'] : array());
        $purchaseReceiptDataProvider = $purchaseReceiptHeader->searchByPurchasePayment();

        if (!empty($supplierId)) {
            $purchaseReceiptDataProvider->criteria->addCondition("t.supplier_id = :supplier_id");
            $purchaseReceiptDataProvider->criteria->params[':supplier_id'] = $supplierId;
        }
        
        $account = new Account('search');
        $account->unsetAttributes();
        if (isset($_GET['Account'])) {
            $account->attributes = $_GET['Account'];
        }

        $error = false;

        if (isset($_POST['Submit']) && IdempotentManager::check()) {
            if (empty($purchasePayment->header->id)) {
                $purchasePayment->header->number = CodeNumber::make($purchasePayment->header, 'number', ($purchasePayment->header->is_non_tax) ? 'NPPY' : 'PPY', ($purchasePayment->header->is_non_tax) ? true : false);
            }

            $dbTransaction = CActiveRecord::$db->beginTransaction();
            try {
                if ($purchasePayment->validate() && IdempotentManager::build()->save() && $purchasePayment->save(false)) {
                    $dbTransaction->commit();
                    Yii::app()->session['PurchasePaymentMemoAllowed'] = true;
                    $this->redirect(array('view', 'id' => $purchasePayment->header->id));
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
            'purchasePayment' => $purchasePayment,
            'purchaseReceiptHeader' => $purchaseReceiptHeader,
            'purchaseReceiptDataProvider' => $purchaseReceiptDataProvider,
            'supplier' => $supplier,
            'account' => $account,
            'purchasePaymentAccountSecondary' => $purchasePaymentAccountSecondary,
            'purchasePaymentAccountPrimary' => $purchasePaymentAccountPrimary,
            'error' => false,
        ));
    }

    public function actionView($id) {
        $purchasePayment = PurchasePaymentHeaderRev::model()->findByPk($id);

        $this->render('view', array(
            'purchasePayment' => $purchasePayment,
        ));
    }

    public function actionMemo($id) {
        if (!(Yii::app()->user->checkAccess('administrator'))) {
            if (!(isset(Yii::app()->session['PurchasePaymentMemoAllowed']) && Yii::app()->session['PurchasePaymentMemoAllowed'] === true))
                $this->redirect(array('admin'));
        }

        Yii::app()->session->remove('PurchasePaymentMemoAllowed');

        $purchasePayment = PurchasePaymentHeaderRev::model()->findByPk($id);

        $purchasePaymentSupplier = ($purchasePayment->is_non_tax) ? $purchasePayment->supplier->name : $purchasePayment->supplier->company;
        $purchasePaymentHeaderText = ($purchasePayment->is_non_tax) ? '' : 'PT. GALATECH JAYA ABADI';

        $this->render('memo', array(
            'purchasePayment' => $purchasePayment,
            'purchasePaymentSupplier' => $purchasePaymentSupplier,
            'purchasePaymentHeaderText' => $purchasePaymentHeaderText,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            $purchasePayment = PurchasePaymentHeaderRev::model()->resetScope()->findByPk($id);
            if ($purchasePayment !== null) {
                $purchasePayment->is_inactive = !$purchasePayment->is_inactive;
                $purchasePayment->update(array('is_inactive'));
            }

            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionAdmin() {
        $purchasePayment = new PurchasePaymentHeaderRev('search');
        $purchasePayment->unsetAttributes();

        if (isset($_GET['PurchasePaymentHeaderRev']))
            $purchasePayment->attributes = $_GET['PurchasePaymentHeaderRev'];

        $supplierId = (isset($_GET['SupplierId'])) ? $_GET['SupplierId'] : '';

        $dataProvider = $purchasePayment->search();
//		$dataProvider->criteria->join = "INNER JOIN tblgt_purchase_receipt_header purchaseReceiptHeader ON (t.purchase_receipt_header_id = purchaseReceiptHeader.id) AND (purchaseReceiptHeader.is_inactive = 0)";
//		$dataProvider->criteria->compare('purchaseReceiptHeader.supplier_id', $supplierId);

        $this->render('admin', array(
            'purchasePayment' => $purchasePayment,
            'dataProvider' => $dataProvider,
            'supplierId' => $supplierId,
        ));
    }

    public function actionReport() {
        $purchasePaymentHeader = new PurchasePaymentHeaderRev('search');
        $purchasePaymentHeader->unsetAttributes();
        if (isset($_GET['PurchasePaymentHeaderRev']))
            $purchasePaymentHeader->attributes = $_GET['PurchasePaymentHeaderRev'];

        $startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : '';
        $endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : '';
        $pageSize = (isset($_GET['PageSize'])) ? $_GET['PageSize'] : '';
        $currentPage = (isset($_GET['page'])) ? $_GET['page'] : '';
        $currentSort = (isset($_GET['sort'])) ? $_GET['sort'] : '';

        $number = (isset($_GET['Number'])) ? $_GET['Number'] : '';
        $supplierId = (isset($_GET['SupplierId'])) ? $_GET['SupplierId'] : '';

        $dataProvider = $purchasePaymentHeader->search();
//		$dataProvider->criteria->compare('purchaseReceiptHeader.number', $number);$dataProvider->criteria->compare('purchaseReceiptHeader.supplier_id', $supplierId);
//		$dataProvider->criteria->join = "INNER JOIN " . PurchaseReceiptHeader::model()->tableName() . " purchaseReceiptHeader ON purchaseReceiptHeader.id = t.purchase_receipt_header_id INNER JOIN " . Supplier::model()->tableName() . " supplier ON purchaseReceiptHeader.supplier_id = supplier.id";

        $page = array('size' => $pageSize, 'current' => $currentPage);
        $date = array('attribute' => 't.date', 'start' => $startDate, 'end' => $endDate);

        $sort = new CSort(get_class($purchasePaymentHeader));
        $sort->attributes = array('t.date', 'supplier_id');

        $dataProvider = ReportHelper::finalizeDataProvider($dataProvider, $page, $sort, $date);

        $this->render('report', array(
            'purchasePaymentHeader' => $purchasePaymentHeader,
            'dataProvider' => $dataProvider,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'sort' => $sort,
            'currentSort' => $currentSort,
            'number' => $number,
            'supplierId' => $supplierId,
        ));
    }

    protected function reportGrandTotal($dataProvider) {
        $grandTotal = 0.00;

        foreach ($dataProvider->data as $data)
            $grandTotal += $data->totalPayment;

        return $grandTotal;
    }

    public function actionSupplierAjaxData($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $purchasePayment = new PurchasePayment();

//            if (!empty($id))
//                $purchasePayment->copyFromDb($id);

            if (!isset($_POST['PurchasePaymentDetailRev']))
                $purchasePayment->details = array();

            $this->loadState($purchasePayment);

            $object = array(
                'supplier_name' => $purchasePayment->header->supplier->name,
                'supplier_company' => $purchasePayment->header->supplier->company,
            );
            echo CJSON::encode($object);
        }
    }

    public function actionAjaxHtmlResetDetail() {
        if (Yii::app()->request->isAjaxRequest) {
            $purchasePayment = new PurchasePayment();

            $this->loadState($purchasePayment);

            if (isset($_POST['PurchasePaymentHeaderRev']['supplier_id']))
                $purchasePayment->resetDetail($_POST['PurchasePaymentHeaderRev']['supplier_id']);

            $this->renderPartial('_detail', array(
                'purchasePayment' => $purchasePayment,
                'error' => false,
            ));
        }
    }

    public function actionPurchaseReceiptAjaxData($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $purchasePayment = new PurchasePayment();

//            if (!empty($id))
//                $purchasePayment->copyFromDb($id);

            if (!isset($_POST['PurchasePaymentDetailRev']))
                $purchasePayment->details = array();

            $this->loadState($purchasePayment);

            $object = array(
                'purchase_receipt_header_number' => $purchasePayment->header->purchaseReceiptHeader->number,
                'purchase_receipt_header_date' => Yii::app()->dateFormatter->format("d MMMM yyyy", $purchasePayment->header->purchaseReceiptHeader->date),
                'purchase_receipt_header_supplier' => $purchasePayment->header->purchaseReceiptHeader->supplier->company,
            );

            echo CJSON::encode($object);
        }
    }

    public function actionSummaryAjaxData($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $purchasePayment = new PurchasePayment();

//            if (!empty($id))
//                $purchasePayment->copyFromDb($id);

            if (!isset($_POST['PurchasePaymentDetailRev']))
                $purchasePayment->details = array();

            $this->loadState($purchasePayment);

            $amount = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($purchasePayment->details[$index], 'amount')));
            $total = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($purchasePayment, 'totalReceipt')));
            $payment = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($purchasePayment, 'payment')));
            $totalPayment = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($purchasePayment, 'totalPayment')));

            echo CJSON::encode(array(
                'amount' => $amount,
                'total' => $total,
                'payment' => $payment,
                'totalPayment' => $totalPayment,
            ));
        }
    }

    public function actionAjaxJsonTotalExtra($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $purchasePayment = new PurchasePayment();

//            if (!empty($id))
//                $purchasePayment->copyFromDb($id);

            if (!isset($_POST['PurchasePaymentExtra']))
                $purchasePayment->extras = array();

            $this->loadState($purchasePayment);

            $amount = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($purchasePayment->extras[$index], 'amount')));
            $totalExtra = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $purchasePayment->totalExtras));
            $totalPayment = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($purchasePayment, 'totalPayment')));

            echo CJSON::encode(array(
                'amount' => $amount,
                'totalExtra' => $totalExtra,
                'totalPayment' => $totalPayment,
            ));
        }
    }

    public function actionAddPurchaseReceiptAjax($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $purchasePayment = new PurchasePayment();

//			if (!empty($id))
//				$purchasePayment->copyFromDb($id);
//
//			if ($purchasePayment->header->isNewRecord)
//				$purchasePayment->header->is_non_tax = intval($nt);

            $this->loadState($purchasePayment);

            $purchasePaymentAccountSecondary = 'id IN (3, 48, 1, 215, 288, 370, 160, 161, 467)';
            $purchasePaymentAccountPrimary = 'id IN (47, 2, 214, 260, 160, 161)';

            if (isset($_POST['PurchaseReceiptHeaderId']))
                $purchasePayment->addPurchaseReceiptHeader($_POST['PurchaseReceiptHeaderId']);

            $this->renderPartial('_detail', array(
                'purchasePayment' => $purchasePayment,
                'purchasePaymentAccountSecondary' => $purchasePaymentAccountSecondary,
                'purchasePaymentAccountPrimary' => $purchasePaymentAccountPrimary,
                'error' => false,
            ));
        }
    }

    public function actionAjaxHtmlAddAccount($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $purchasePayment = new PurchasePayment();

            $this->loadState($purchasePayment);

            $purchasePaymentAccountSecondary = 'id IN (3, 48, 1, 215, 288, 370, 160, 161, 467)';
            $purchasePaymentAccountPrimary = 'id IN (47, 2, 214, 260, 160, 161, 463)';

            if (isset($_POST['AccountId']))
                $purchasePayment->addAccount($_POST['AccountId']);

            $this->renderPartial('_detail', array(
                'purchasePayment' => $purchasePayment,
                'purchasePaymentAccountSecondary' => $purchasePaymentAccountSecondary,
                'purchasePaymentAccountPrimary' => $purchasePaymentAccountPrimary,
                'error' => false,
            ));
        }
    }

    public function actionRemovePaymentAjax($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $purchasePayment = new PurchasePayment();

//            if (!empty($id))
//                $purchasePayment->copyFromDb($id);

            if (!isset($_POST['PurchasePaymentDetailRev']))
                $purchasePayment->details = array();

            $this->loadState($purchasePayment);

            $purchasePayment->removePaymentAt($index);

            $this->renderPartial('_detail', array(
                'purchasePayment' => $purchasePayment,
                'error' => false,
            ));
        }
    }

    public function actionAjaxHtmlRemoveExtras($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $purchasePayment = new PurchasePayment();

//            if (!empty($id))
//                $purchasePayment->copyFromDb($id);

            if (!isset($_POST['PurchasePaymentDetailRev']))
                $purchasePayment->extras = array();

            $this->loadState($purchasePayment);

            $purchasePayment->removeExtraAt($index);

            $this->renderPartial('_detail', array(
                'purchasePayment' => $purchasePayment,
                'error' => false,
            ));
        }
    }

    protected function loadState($purchasePayment) {
        if (isset($_POST['PurchasePaymentHeaderRev']))
            $purchasePayment->header->attributes = $_POST['PurchasePaymentHeaderRev'];

        if (isset($_POST['PurchasePaymentDetailRev'])) {
            foreach ($_POST['PurchasePaymentDetailRev'] as $i => $item) {
                if (isset($purchasePayment->details[$i]))
                    $purchasePayment->details[$i]->attributes = $item;
                else {
                    $detail = new PurchasePaymentDetailRev();
                    $detail->attributes = $item;
                    $purchasePayment->details[] = $detail;
                }
            }

            if (count($_POST['PurchasePaymentDetailRev']) < count($purchasePayment->details))
                array_splice($purchasePayment->details, $i + 1);
        }
        if (isset($_POST['PurchasePaymentExtra'])) {
            foreach ($_POST['PurchasePaymentExtra'] as $i => $item) {
                if (isset($purchasePayment->extras[$i]))
                    $purchasePayment->extras[$i]->attributes = $item;
                else {
                    $extras = new PurchasePaymentExtra();
                    $extras->attributes = $item;
                    $purchasePayment->extras[] = $extras;
                }
            }
            if (count($_POST['PurchasePaymentExtra']) < count($purchasePayment->extras))
                array_splice($purchasePayment->extras, $i + 1);
        }
    }
}
