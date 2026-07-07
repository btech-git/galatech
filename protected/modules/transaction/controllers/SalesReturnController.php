<?php

class SalesReturnController extends Controller {

    public function filters() {
        return array(
            'access',
        );
    }

    public function filterAccess($filterChain) {
        $taxCreateValid = Yii::app()->user->checkAccess('tSalesReturnCreate') || Yii::app()->user->checkAccess('tsSalesReturnCreate');
        $nonTaxCreateValid = Yii::app()->user->checkAccess('ntSalesReturnCreate');
        $taxEditValid = Yii::app()->user->checkAccess('tSalesReturnEdit') || Yii::app()->user->checkAccess('tsSalesReturnEdit');
        $nonTaxEditValid = Yii::app()->user->checkAccess('ntSalesReturnEdit');

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
        if ($filterChain->action->id === 'addProductAjax' || $filterChain->action->id === 'removeProductAjax' || $filterChain->action->id === 'returnAjaxData' || $filterChain->action->id === 'totalAjaxData' || $filterChain->action->id === 'grandTotalAjaxData' || $filterChain->action->id === 'taxTotalAjaxData' || $filterChain->action->id === 'memo' || $filterChain->action->id === 'view') {
            if (!($taxCreateValid || $nonTaxCreateValid || $taxEditValid || $nonTaxEditValid))
                $this->redirect(array('/site/login'));
        }
        if ($filterChain->action->id === 'delete' || $filterChain->action->id === 'admin') {
            if (!($taxEditValid || $nonTaxEditValid))
                $this->redirect(array('/site/login'));
        }
        if ($filterChain->action->id === 'report') {
            if (!(Yii::app()->user->checkAccess('ntSalesReturnReport') || Yii::app()->user->checkAccess('tSalesReturnReport') || Yii::app()->user->checkAccess('tsSalesReturnReport')))
                $this->redirect(array('/site/login'));
        }

        $filterChain->run();
    }

    public function actionCreate() {
        $salesReturn = new SalesReturn();

//        if (isset($_GET['id']))
//            $salesReturn->copyFromDb($_GET['id']);

        $product = new Product('search');
        $product->unsetAttributes();
        if (isset($_GET['Product']))
            $product->attributes = $_GET['Product'];

        $invoiceHeader = new InvoiceHeader('search');
        $invoiceHeader->unsetAttributes();  // clear any default values
        if (isset($_GET['InvoiceHeader']))
            $invoiceHeader->attributes = $_GET['InvoiceHeader'];

        if ($salesReturn->header->isNewRecord) {
            $salesReturn->header->is_non_tax = intval(isset($_GET['nt']));
//            $salesReturn->header->number = CodeNumber::make($salesReturn->header, 'number', ($salesReturn->header->is_non_tax) ? 'NSRET' : 'SRET', ($salesReturn->header->is_non_tax) ? true : false);
        }

        $salesReturn->header->admin_id = Yii::app()->user->id;
        $this->loadState($salesReturn);

        $error = false;

        if (isset($_POST['Submit']) && IdempotentManager::check()) {
            if ($salesReturn->header->isNewRecord) {
                $salesReturn->header->number = CodeNumber::make($salesReturn->header, 'number', ($salesReturn->header->is_non_tax) ? 'NSRET' : 'SRET', ($salesReturn->header->is_non_tax) ? true : false);
            }

            $dbTransaction = CActiveRecord::$db->beginTransaction();
            try {
                if ($salesReturn->validate() && IdempotentManager::build()->save() && $salesReturn->save(false)) {
                    $dbTransaction->commit();
                    Yii::app()->session['SalesReturnMemoAllowed'] = true;
                    $this->redirect(array('view', 'id' => $salesReturn->header->id));
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
            'salesReturn' => $salesReturn,
            'invoiceHeader' => $invoiceHeader,
            'product' => $product,
            'error' => false,
        ));
    }

    public function actionView($id) {
        $salesReturn = SalesReturnHeader::model()->findByPk($id);

        $this->render('view', array(
            'salesReturn' => $salesReturn,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            $salesReturn = SalesReturnHeader::model()->resetScope()->findByPk($id);
            if ($salesReturn !== null) {
                $salesReturn->is_inactive = !$salesReturn->is_inactive;
                $salesReturn->update(array('is_inactive'));

                foreach ($salesReturn->saleReturnDetails as $detail) {
                    $detail->is_inactive = !$detail->is_inactive;
                    $detail->update(array('is_inactive'));
                }
            }

            Inventory::model()->DeleteAllByAttributes(array(
                'transaction_number' => $salesReturn->number
            ));

            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionMemo($id) {
        if (!(Yii::app()->user->checkAccess('administrator'))) {
            if (!(isset(Yii::app()->session['SalesReturnMemoAllowed']) && Yii::app()->session['SalesReturnMemoAllowed'] === true))
                $this->redirect(array('admin'));
        }

        Yii::app()->session->remove('SalesReturnMemoAllowed');

        $salesReturn = SalesReturnHeader::model()->findByPk($id);

        $salesReturnCustomer = ($salesReturn->is_non_tax) ? $salesReturn->invoiceHeader->deliveryHeader->customer->name : $salesReturn->invoiceHeader->deliveryHeader->customer->company;
        $salesReturnHeaderText = ($salesReturn->is_non_tax) ? '' : 'PT. Galatech';

        $this->render('memo', array(
            'salesReturn' => $salesReturn,
            'salesReturnCustomer' => $salesReturnCustomer,
            'salesReturnHeaderText' => $salesReturnHeaderText,
        ));
    }

    public function actionAdmin() {
        $salesReturnHeader = new SalesReturnHeader('search');
        $salesReturnHeader->unsetAttributes();

        if (isset($_GET['SalesReturnHeader']))
            $salesReturnHeader->attributes = $_GET['SalesReturnHeader'];

        $customerId = (isset($_GET['CustomerId'])) ? $_GET['CustomerId'] : '';

        $dataProvider = $salesReturnHeader->search();
        $dataProvider->criteria->with = array('invoiceHeader.deliveryHeader');
        $dataProvider->criteria->compare('deliveryHeader.customer_id', $customerId);

        $this->render('admin', array(
            'salesReturnHeader' => $salesReturnHeader,
            'dataProvider' => $dataProvider,
            'customerId' => $customerId,
        ));
    }

    public function actionReport() {
        $salesReturnHeader = new SalesReturnHeader('search');
        $salesReturnHeader->unsetAttributes();
        if (isset($_GET['SalesReturnHeader']))
            $salesReturnHeader->attributes = $_GET['SalesReturnHeader'];

        $startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : '';
        $endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : '';
        $pageSize = (isset($_GET['PageSize'])) ? $_GET['PageSize'] : '';
        $currentPage = (isset($_GET['page'])) ? $_GET['page'] : '';
        $currentSort = (isset($_GET['sort'])) ? $_GET['sort'] : '';

        $customerId = (isset($_GET['CustomerId'])) ? $_GET['CustomerId'] : '';

        $dataProvider = $salesReturnHeader->search();
        $dataProvider->criteria->compare('deliveryHeader.customer_id', $customerId);
        $dataProvider->criteria->join = "INNER JOIN " . InvoiceHeader::model()->tableName() . " invoiceHeader ON invoiceHeader.id = t.invoice_header_id INNER JOIN " . DeliveryHeader::model()->tableName() . " deliveryHeader ON deliveryHeader.id = invoiceHeader.delivery_header_id INNER JOIN " . Customer::model()->tableName() . " customer ON deliveryHeader.customer_id = customer.id";

        $page = array('size' => $pageSize, 'current' => $currentPage);
        $date = array('attribute' => 't.date', 'start' => $startDate, 'end' => $endDate);

        $sort = new CSort(get_class($salesReturnHeader));
        $sort->attributes = array('t.date', 'customer.name');

        $dataProvider = ReportHelper::finalizeDataProvider($dataProvider, $page, $sort, $date);

        $this->render('report', array(
            'salesReturnHeader' => $salesReturnHeader,
            'dataProvider' => $dataProvider,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'sort' => $sort,
            'currentSort' => $currentSort,
            'customerId' => $customerId,
        ));
    }

    public function actionAddProductAjax($id, $nt) {
        if (Yii::app()->request->isAjaxRequest) {
            $salesReturn = new SalesReturn();

//            if (!empty($id))
//                $salesReturn->copyFromDb($id);

            if ($salesReturn->header->isNewRecord)
                $salesReturn->header->is_non_tax = intval($nt);

            if (!isset($_POST['SalesReturnDetail']))
                $salesReturn->details = array();

            $this->loadState($salesReturn);

            if (isset($_POST['SalesReturnHeader']['invoice_header_id']))
                $salesReturn->addProductByInvoice($_POST['SalesReturnHeader']['invoice_header_id']);

            $this->renderPartial('_detail', array(
                'salesReturn' => $salesReturn,
                'error' => false,
            ));
        }
    }

    public function actionRemoveProductAjax($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $salesReturn = new SalesReturn();

//            if (!empty($id))
//                $salesReturn->copyFromDb($id);

            if (!isset($_POST['SalesReturnDetail']))
                $salesReturn->details = array();

            $this->loadState($salesReturn);

            $salesReturn->removeProductAt($index);

            $this->renderPartial('_detail', array(
                'salesReturn' => $salesReturn,
                'error' => false,
            ));
        }
    }

    public function actionReturnAjaxData($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $salesReturn = new SalesReturn();

//            if (!empty($id))
//                $salesReturn->copyFromDb($id);

            if (!isset($_POST['SalesReturnDetail']))
                $salesReturn->details = array();

            $this->loadState($salesReturn);

            $object = array(
                'invoice_header_number' => $salesReturn->header->invoiceHeader->number,
                'customer_company' => $salesReturn->header->invoiceHeader->deliveryHeader->customer->company,
            );

            echo CJSON::encode($object);
        }
    }

    public function actionTotalAjaxData($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $salesReturn = new SalesReturn();

//            if (!empty($id))
//                $salesReturn->copyFromDb($id);

            if (!isset($_POST['SalesReturnDetail']))
                $salesReturn->details = array();

            $this->loadState($salesReturn);

            $total = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($salesReturn->details[$index], 'total')));
            $subTotal = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $salesReturn->subTotal));
            $tax = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $salesReturn->calculatedTax));
            $grandTotal = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $salesReturn->grandTotal));
            $subTotalQuantity = CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $salesReturn->subTotalQuantity));

            echo CJSON::encode(array(
                'total' => $total,
                'tax' => $tax,
                'subTotal' => $subTotal,
                'grandTotal' => $grandTotal,
                'subTotalQuantity' => $subTotalQuantity
            ));
        }
    }

    public function actionTaxTotalAjaxData($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $salesReturn = new SalesReturn();

//            if (!empty($id))
//                $delivery->copyFromDb($id);

            if (!isset($_POST['SalesReturnDetail']))
                $salesReturn->details = array();

            $this->loadState($salesReturn);

            $tax = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $salesReturn->calculatedTax));
            $grandTotal = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $salesReturn->grandTotal));

            echo CJSON::encode(array(
                'tax' => $tax,
                'grandTotal' => $grandTotal,
            ));
        }
    }

    public function actionGrandTotalAjaxData($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $salesReturn = new SalesReturn();
//            if (!empty($id))
//                $salesReturn->copyFromDb($id);

            if (!isset($_POST['SalesReturnDetail']))
                $salesReturn->details = array();

            $this->loadState($salesReturn);

            $grandTotal = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $salesReturn->grandTotal));

            echo CJSON::encode(array(
                'grandTotal' => $grandTotal,
            ));
        }
    }

    protected function reportGrandTotal($dataProvider) {
        $grandTotal = 0.00;

        foreach ($dataProvider->data as $data)
            $grandTotal += $data->grandTotal;

        return $grandTotal;
    }

    protected function loadState(&$salesReturn) {
        if (isset($_POST['SalesReturnHeader'])) {
            $salesReturn->header->attributes = $_POST['SalesReturnHeader'];
        }
        if (isset($_POST['SalesReturnDetail'])) {
            foreach ($_POST['SalesReturnDetail'] as $i => $item) {
                if (isset($salesReturn->details[$i]))
                    $salesReturn->details[$i]->attributes = $item;
                else {
                    $detail = new SalesReturnDetail();
                    $detail->attributes = $item;
                    $salesReturn->details[] = $detail;
                }
            }
            if (count($_POST['SalesReturnDetail']) < count($salesReturn->details))
                array_splice($salesReturn->details, $i + 1);
        }
    }
}
