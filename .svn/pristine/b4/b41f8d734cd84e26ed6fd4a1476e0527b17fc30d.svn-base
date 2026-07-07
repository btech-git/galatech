<?php

class JournalVoucherController extends Controller {

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
        if ($filterChain->action->id === 'accountCompletion' || $filterChain->action->id === 'addAccountAjax' || $filterChain->action->id === 'removeAccountAjax' || $filterChain->action->id === 'totalCreditAjaxData' || $filterChain->action->id === 'totalDebitAjaxData' || $filterChain->action->id === 'memo' || $filterChain->action->id === 'view') {
            if (!($taxCreateValid || $nonTaxCreateValid || $taxEditValid || $nonTaxEditValid))
                $this->redirect(array('/site/login'));
        }
        if ($filterChain->action->id === 'delete' || $filterChain->action->id === 'admin') {
            if (!($taxEditValid || $nonTaxEditValid))
                $this->redirect(array('/site/login'));
        }
        if ($filterChain->action->id === 'report') {
            if (!(Yii::app()->user->checkAccess('ntAccountingReport') || Yii::app()->user->checkAccess('tAccountingReport') || Yii::app()->user->checkAccess('tsAccountingReport')))
                $this->redirect(array('/site/login'));
        }

        $filterChain->run();
    }

    public function actionCreate() {
        $journal = new JournalVoucher();

//        if (isset($_GET['id'])) //&& !isset($_POST['JournalVoucherHeader']) && !isset($_POST['JournalVoucherDetail']))
//            $journal->copyFromDb($_GET['id']);

        if ($journal->header->isNewRecord) {
            $journal->header->is_non_tax = intval(isset($_GET['nt']));
//            $journal->header->number = CodeNumber::make($journal->header, 'number', ($journal->header->is_non_tax) ? 'NJV' : 'JV', ($journal->header->is_non_tax) ? true : false);
        }

        $journal->header->admin_id = Yii::app()->user->id;
        $this->loadState($journal);

        $error = false;

        if (isset($_POST['Submit']) && IdempotentManager::check()) {
            if ($journal->header->isNewRecord) {
                $journal->header->is_non_tax = intval(isset($_GET['nt']));
                $journal->header->number = CodeNumber::make($journal->header, 'number', ($journal->header->is_non_tax) ? 'NJV' : 'JV', ($journal->header->is_non_tax) ? true : false);
            }

            $dbTransaction = CActiveRecord::$db->beginTransaction();
            try {
                $valid = $journal->validate() && IdempotentManager::build()->save() && $journal->save(false);

                if ($valid) {
                    $dbTransaction->commit();
                    $this->redirect(array('view', 'id' => $journal->header->id));
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
            'journal' => $journal,
            'error' => $error,
        ));
    }

    public function actionView($id) {
        $journal = JournalVoucherHeader::model()->findByPk($id);

        $this->render('view', array(
            'journal' => $journal,
        ));
    }

    public function actionAdmin() {
        $journal = new JournalVoucherHeader('search');
        $journal->unsetAttributes();

        if (isset($_GET['JournalVoucherHeader']))
            $journal->attributes = $_GET['JournalVoucherHeader'];

        $dataProvider = $journal->search();

        $this->render('admin', array(
            'journal' => $journal,
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionReport() {
        $journal = new JournalVoucherHeader('search');
        $journal->unsetAttributes();
        if (isset($_GET['JournalVoucherHeader']))
            $journal->attributes = $_GET['JournalVoucherHeader'];

        $startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : '';
        $endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : '';
        $pageSize = (isset($_GET['PageSize'])) ? $_GET['PageSize'] : '';
        $currentPage = (isset($_GET['page'])) ? $_GET['page'] : '';
        $currentSort = (isset($_GET['sort'])) ? $_GET['sort'] : '';

        $dataProvider = $journal->search();

        $page = array('size' => $pageSize, 'current' => $currentPage);
        $date = array('attribute' => 't.date', 'start' => $startDate, 'end' => $endDate);

        $sort = new CSort(get_class($journal));
        $sort->attributes = array('t.date');

        $dataProvider = ReportHelper::finalizeDataProvider($dataProvider, $page, $sort, $date);

        $this->render('report', array(
            'journal' => $journal,
            'dataProvider' => $dataProvider,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'sort' => $sort,
            'currentSort' => $currentSort,
        ));
    }

    public function actionAddAccountAjax() {
        if (Yii::app()->request->isAjaxRequest) {
            $journal = new JournalVoucher();

            $this->loadState($journal);

            if (isset($_POST['Account']))
                $journal->addAccount($_POST['Account']);

            $this->renderPartial('_detail', array(
                'journal' => $journal,
                'error' => false,
            ));
        }
    }

    public function actionRemoveAccountAjax($index) {
        if (Yii::app()->request->isAjaxRequest) {
            $journal = new JournalVoucher();

            $this->loadState($journal);

            $journal->removeAccountAt($index);

            $this->renderPartial('_detail', array(
                'journal' => $journal,
                'error' => false,
            ));
        }
    }

    public function actionTotalDebitAjaxData($index) {
        if (Yii::app()->request->isAjaxRequest) {
            $journal = new JournalVoucher();

            $this->loadState($journal);

            $debit = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($journal->details[$index], 'debit')));
            $totalDebit = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $journal->totalDebit));

            echo CJSON::encode(array(
                'debit' => $debit,
                'totalDebit' => $totalDebit,
            ));
        }
    }

    public function actionTotalCreditAjaxData($index) {
        if (Yii::app()->request->isAjaxRequest) {
            $journal = new JournalVoucher();

            $this->loadState($journal);

            $credit = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($journal->details[$index], 'credit')));
            $totalCredit = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $journal->totalCredit));

            echo CJSON::encode(array(
                'credit' => $credit,
                'totalCredit' => $totalCredit,
            ));
        }
    }

    public function actionAccountCompletion() {
        echo CJSON::encode(Completion::account($_GET['term']));
    }

    protected function loadState(&$journal) {
        if (isset($_POST['JournalVoucherHeader'])) {
            $journal->header->attributes = $_POST['JournalVoucherHeader'];
        }
        if (isset($_POST['JournalVoucherDetail'])) {
            foreach ($_POST['JournalVoucherDetail'] as $item) {
                $detail = new JournalVoucherDetail();
                $detail->attributes = $item;
                $journal->details[] = $detail;
            }
        }
    }
}
