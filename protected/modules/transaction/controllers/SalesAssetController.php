<?php

class SalesAssetController extends SelectionController {

    public function filters() {
        return array(
            'access',
        );
    }

    public function filterAccess($filterChain) {
        $taxCreateValid = Yii::app()->user->checkAccess('tInvoiceCreate') || Yii::app()->user->checkAccess('tsInvoiceCreate');
        $nonTaxCreateValid = Yii::app()->user->checkAccess('ntInvoiceCreate');
        $taxEditValid = Yii::app()->user->checkAccess('tInvoiceEdit') || Yii::app()->user->checkAccess('tsInvoiceEdit');
        $nonTaxEditValid = Yii::app()->user->checkAccess('ntInvoiceEdit');

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
        if ($filterChain->action->id === 'addItemAjax' || $filterChain->action->id === 'removeProductAjax' || $filterChain->action->id === 'totalAjaxData' || $filterChain->action->id === 'memo' || $filterChain->action->id === 'view') {
            if (!($taxCreateValid || $nonTaxCreateValid || $taxEditValid || $nonTaxEditValid))
                $this->redirect(array('/site/login'));
        }
        if ($filterChain->action->id === 'delete' || $filterChain->action->id === 'admin') {
            if (!($taxEditValid || $nonTaxEditValid))
                $this->redirect(array('/site/login'));
        }
        if ($filterChain->action->id === 'report') {
            if (!(Yii::app()->user->checkAccess('ntInvoiceReport') || Yii::app()->user->checkAccess('tInvoiceReport') || Yii::app()->user->checkAccess('tsInvoiceReport')))
                $this->redirect(array('/site/login'));
        }

        $filterChain->run();
    }

    public function actionCreate() {
        $salesAsset = new SalesAsset();

        if (isset($_GET['id'])) {
            $salesAsset->copyFromDb($_GET['id']);
        }

        if ($salesAsset->header->isNewRecord) {
            $salesAsset->header->number = CodeNumber::make($salesAsset->header, 'number', 'PRC');
        }

        $salesAsset->header->admin_id = Yii::app()->user->id;
        $this->loadState($salesAsset);

        $error = false;

        if (isset($_POST['Submit']) && IdempotentManager::check()) {
            if ($salesAsset->header->isNewRecord) {
                $salesAsset->header->number = CodeNumber::make($salesAsset->header, 'number', 'PRC');
            }

            $dbTransaction = CActiveRecord::$db->beginTransaction();
            try {
                if ($salesAsset->validate() && IdempotentManager::build()->save() && $salesAsset->save(false)) {
                    $dbTransaction->commit();
                    Yii::app()->session['SalesAssetMemoAllowed'] = true;
                    $this->redirect(array('view', 'id' => $salesAsset->header->id));
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
            'salesAsset' => $salesAsset,
            'error' => $error,
        ));
    }

    public function actionView($id) {
        $salesAsset = SalesAssetHeader::model()->findByPk($id);

        $this->render('view', array(
            'salesAsset' => $salesAsset,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            $salesAssetHeader = SalesAssetHeader::model()->resetScope()->findByPk($id);
            if ($salesAssetHeader !== null) {
                $salesAssetHeader->is_inactive = !$salesAssetHeader->is_inactive;
                $salesAssetHeader->update(array('is_inactive'));
            }

            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionMemo($id) {
        if (!(Yii::app()->user->checkAccess('administrator'))) {
            if (!(isset(Yii::app()->session['SalesAssetMemoAllowed']) && Yii::app()->session['SalesAssetMemoAllowed'] === true))
                $this->redirect(array('admin'));
        }

        Yii::app()->session->remove('SalesAssetMemoAllowed');

        $salesAsset = SalesAssetHeader::model()->findByPk($id);

        $salesAssetCustomer = ($salesAsset->is_non_tax) ? $salesAsset->customer->name : $salesAsset->customer->company;
        $salesAssetHeaderText = ($salesAsset->is_non_tax) ? '' : 'PT. Galatech';

        $this->render('memo', array(
            'salesAsset' => $salesAsset,
            'salesAssetCustomer' => $salesAssetCustomer,
            'salesAssetHeaderText' => $salesAssetHeaderText,
        ));
    }

    public function actionAdmin() {
        $salesAsset = new SalesAssetHeader('search');
        $salesAsset->unsetAttributes();

        if (isset($_GET['SalesAssetHeader']))
            $salesAsset->attributes = $_GET['SalesAssetHeader'];

        $dataProvider = $salesAsset->search();
        $dataProvider->model->resetScope();

        $this->render('admin', array(
            'salesAsset' => $salesAsset,
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionReport() {
        $salesAssetHeader = new SalesAssetHeader('search');
        $salesAssetHeader->unsetAttributes();
        if (isset($_GET['SalesAssetHeader']))
            $salesAssetHeader->attributes = $_GET['SalesAssetHeader'];

        $startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : '';
        $endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : '';
        $pageSize = (isset($_GET['PageSize'])) ? $_GET['PageSize'] : '';
        $currentPage = (isset($_GET['page'])) ? $_GET['page'] : '';
        $currentSort = (isset($_GET['sort'])) ? $_GET['sort'] : '';

        $dataProvider = $salesAssetHeader->search();
//                $dataProvider->criteria->with = array('customer');

        $page = array('size' => $pageSize, 'current' => $currentPage);
        $date = array('attribute' => 'date', 'start' => $startDate, 'end' => $endDate);

        $sort = new CSort(get_class($salesAssetHeader));
        $sort->attributes = array('date');

        $dataProvider = ReportHelper::finalizeDataProvider($dataProvider, $page, $sort, $date);

        $this->render('report', array(
            'salesAssetHeader' => $salesAssetHeader,
            'dataProvider' => $dataProvider,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'sort' => $sort,
            'currentSort' => $currentSort,
        ));
    }

    public function actionAddItemAjax($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $salesAsset = new SalesAsset();

            if (!empty($id))
                $salesAsset->copyFromDb($id);

            if (!isset($_POST['SalesAssetDetail']))
                $salesAsset->details = array();

            $this->loadState($salesAsset);

            $salesAsset->addItem();

            $this->renderPartial('_detail', array(
                'salesAsset' => $salesAsset,
                'error' => false,
            ));
        }
    }

    public function actionRemoveProductAjax($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $salesAsset = new SalesAsset();

            if (!empty($id))
                $salesAsset->copyFromDb($id);

            $this->loadState($salesAsset);

            $salesAsset->removeProductAt($index);

            $this->renderPartial('_detail', array(
                'salesAsset' => $salesAsset,
            ));
        }
    }

    public function actionTotalAjaxData($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $salesAsset = new SalesAsset();

            if (!empty($id))
                $salesAsset->copyFromDb($id);

            if (!isset($_POST['SalesAssetDetail']))
                $salesAsset->details = array();

            $this->loadState($salesAsset);

            $unitPrice = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($salesAsset->details[$index], 'unit_price')));
            $total = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($salesAsset->details[$index], 'total')));
            $subTotal = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $salesAsset->subTotal));

            echo CJSON::encode(array(
                'unitPrice' => $unitPrice,
                'total' => $total,
                'subTotal' => $subTotal,
            ));
        }
    }

    protected function reportGrandTotal($dataProvider) {
        $grandTotal = 0.00;

        foreach ($dataProvider->data as $data)
            $grandTotal += $data->subTotal;

        return $grandTotal;
    }

    protected function loadState(&$salesAsset) {
        if (isset($_POST['SalesAssetHeader'])) {
            $salesAsset->header->attributes = $_POST['SalesAssetHeader'];
        }
        if (isset($_POST['SalesAssetDetail'])) {
            foreach ($_POST['SalesAssetDetail'] as $i => $item) {
                if (isset($salesAsset->details[$i]))
                    $salesAsset->details[$i]->attributes = $item;
                else {
                    $detail = new SalesAssetDetail();
                    $detail->attributes = $item;
                    $salesAsset->details[] = $detail;
                }
            }
            if (count($_POST['SalesAssetDetail']) < count($salesAsset->details))
                array_splice($salesAsset->details, $i + 1);
        }
    }
}
