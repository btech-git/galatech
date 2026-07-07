<?php

class TransferController extends SelectionController {

    public function filters() {
        return array(
            'access',
        );
    }

    public function filterAccess($filterChain) {
        //user groups, to shorten the if below
        $taxCreateValid = Yii::app()->user->checkAccess('tWarehouseCreate') || Yii::app()->user->checkAccess('tsWarehouseCreate') || Yii::app()->user->checkAccess('tTransferCreate') || Yii::app()->user->checkAccess('tsTransferCreate');
        $nonTaxCreateValid = Yii::app()->user->checkAccess('ntWarehouseCreate') || Yii::app()->user->checkAccess('ntTransferCreate');
        $taxEditValid = Yii::app()->user->checkAccess('tWarehouseEdit') || Yii::app()->user->checkAccess('tsWarehouseEdit');
        $nonTaxEditValid = Yii::app()->user->checkAccess('ntWarehouseEdit');

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
        if ($filterChain->action->id === 'productCompletion' || $filterChain->action->id === 'addProductAjax' || $filterChain->action->id === 'removeProductAjax' || $filterChain->action->id === 'updateAllProductAjax' || $filterChain->action->id === 'memo' || $filterChain->action->id === 'view') {
            if (!($taxCreateValid || $nonTaxCreateValid || $taxEditValid || $nonTaxEditValid))
                $this->redirect(array('/site/login'));
        }
        if ($filterChain->action->id === 'report') {
            if (!(Yii::app()->user->checkAccess('ntWarehouseReport') || Yii::app()->user->checkAccess('tWarehouseReport') || Yii::app()->user->checkAccess('tsWarehouseReport') ))
                $this->redirect(array('/site/login'));
        }

        //admin page can only be accessed by user with transfer print
        if ($filterChain->action->id === 'admin') {
            if (!(Yii::app()->user->checkAccess('tTransferPrint') || Yii::app()->user->checkAccess('tsTransferPrint') || Yii::app()->user->checkAccess('ntTransferPrint') ))
                $this->redirect(array('/site/login'));
        }
        if ($filterChain->action->id === 'delete') {
            if (!(Yii::app()->user->checkAccess('administrator')))
                $this->redirect(array('/site/login'));
        }


        $filterChain->run();
    }

    public function actionCreate() {
        $transfer = new Transfer();

        $product = new Product('search');
        $product->unsetAttributes();
        if (isset($_GET['Product'])) {
            $product->attributes = $_GET['Product'];
        }

        if (empty($transfer->header->id)) {
            $transfer->header->is_non_tax = intval(isset($_GET['nt']));
//            $transfer->header->number = CodeNumber::make($transfer->header, 'number', ($transfer->header->is_non_tax) ? 'NTRF' : 'TRF', ($transfer->header->is_non_tax) ? true : false);
        }

        $transfer->header->admin_id = Yii::app()->user->id;
        $this->loadState($transfer);

        $error = false;

        if (isset($_POST['Submit']) && IdempotentManager::check()) {
            if (empty($transfer->header->id)) {
                $transfer->header->number = CodeNumber::make($transfer->header, 'number', ($transfer->header->is_non_tax) ? 'NTRF' : 'TRF', ($transfer->header->is_non_tax) ? true : false);
            }

            $dbTransaction = CActiveRecord::$db->beginTransaction();
            try {
                $valid = $transfer->validate() && IdempotentManager::build()->save() && $transfer->insert();

                if ($valid) {
                    $dbTransaction->commit();
                    $this->redirect(array('view', 'id' => $transfer->header->id));
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
            'transfer' => $transfer,
            'product' => $product,
            'error' => $error,
        ));
    }

    public function actionView($id) {
        $transfer = TransferHeader::model()->findByPk($id);

        $this->render('view', array(
            'transfer' => $transfer,
        ));
    }

    public function actionReport() {
        $transferHeader = new TransferHeader('search');
        $transferHeader->unsetAttributes();
        if (isset($_GET['TransferHeader']))
            $transferHeader->attributes = $_GET['TransferHeader'];

        $startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : '';
        $endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : '';
        $pageSize = (isset($_GET['PageSize'])) ? $_GET['PageSize'] : '';
        $currentPage = (isset($_GET['page'])) ? $_GET['page'] : '';
        $currentSort = (isset($_GET['sort'])) ? $_GET['sort'] : '';

        $dataProvider = $transferHeader->search();
        $dataProvider->criteria->with = array('warehouseIdFrom');

        $page = array('size' => $pageSize, 'current' => $currentPage);
        $date = array('attribute' => 'date', 'start' => $startDate, 'end' => $endDate);

        $sort = new CSort(get_class($transferHeader));
        $sort->attributes = array('date', 'warehouseIdFrom.name');

        $dataProvider = ReportHelper::finalizeDataProvider($dataProvider, $page, $sort, $date);

        $this->render('report', array(
            'transferHeader' => $transferHeader,
            'dataProvider' => $dataProvider,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'sort' => $sort,
            'currentSort' => $currentSort,
        ));
    }

    public function actionAdmin() {
        $transfer = new TransferHeader('search');
        $transfer->unsetAttributes();

        if (isset($_GET['TransferHeader']))
            $transfer->attributes = $_GET['TransferHeader'];

        $this->render('admin', array(
            'transfer' => $transfer,
        ));
    }

    public function actionMemo($id) {
        $transfer = TransferHeader::model()->findByPk($id);

        //$transferCustomer = ($transfer->is_non_tax) ? $transfer->customer->name : $transfer->customer->company;

        $this->memoToExcel($transfer);

//		$this->render('memo', array(
//			'transfer' => $transfer,
//			'transferCustomer' => $transferCustomer,
//		));
    }

    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            $transfer = TransferHeader::model()->findByPk($id);
            if ($transfer !== null) {
                $transfer->is_inactive = !$transfer->is_inactive;
                $transfer->update(array('is_inactive'));

                foreach ($transfer->transferDetails as $detail) {
                    $detail->is_inactive = !$detail->is_inactive;
                    $detail->update(array('is_inactive'));
                }
            }

            Inventory::model()->DeleteAllByAttributes(array(
                'transaction_number' => $transfer->number
            ));

            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionAddProductAjax($id, $nt) {
        if (Yii::app()->request->isAjaxRequest) {
            $transfer = new Transfer();

            if ($transfer->header->isNewRecord)
                $transfer->header->is_non_tax = intval($nt);

            $this->loadState($transfer);

            if (isset($_POST['ProductId']))
                $transfer->addProduct($_POST['ProductId']);

            $this->renderPartial('_detail', array(
                'transfer' => $transfer,
                'error' => false,
            ));
        }
    }

    public function actionRemoveProductAjax($index) {
        if (Yii::app()->request->isAjaxRequest) {
            $transfer = new Transfer();
            $this->loadState($transfer);

            $transfer->removeProductAt($index);

            $this->renderPartial('_detail', array(
                'transfer' => $transfer,
                'error' => false,
            ));
        }
    }

    public function actionUpdateAllProductAjax() {
        if (Yii::app()->request->isAjaxRequest) {
            $transfer = new Transfer();
            $this->loadState($transfer);

            $this->renderPartial('_detail', array(
                'transfer' => $transfer,
            ));
        }
    }

    public function actionProductCompletion() {
        echo CJSON::encode(Completion::product($_GET['term']));
    }

    protected function memoToExcel($transfer) {
        spl_autoload_unregister(array('YiiBase', 'autoload'));
        include_once Yii::getPathOfAlias('ext.phpexcel.Classes') . DIRECTORY_SEPARATOR . 'PHPExcel.php';
        spl_autoload_register(array('YiiBase', 'autoload'));

        $objPHPExcel = new PHPExcel();

        $documentProperties = $objPHPExcel->getProperties();
        $documentProperties->setCreator('Galatech');
        $documentProperties->setTitle('Surat Jalan Transfer');

        $objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.25);
        $objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.5);
        $objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.5);

        $worksheet = $objPHPExcel->setActiveSheetIndex(0);
        $worksheet->setTitle('Surat Jalan Transfer');

        $worksheet->mergeCells('A1:M1');
        $worksheet->getStyle('A1:M1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $worksheet->getStyle('A1:M1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyle('A1:M1')->getFont()->setBold(true);
        $worksheet->getStyle('A1:M1')->getFont()->setSize(10);
        $worksheet->setCellValue('A1', 'PT. Galatech Jaya Abadi');
//		$worksheet->getStyle('A1')->getFont()->setName('Bodoni MT Poster Compressed');

        $worksheet->mergeCells('A2:M2');
//		$worksheet->getRowDimension('A3')->setAutoSize(true);
        $worksheet->getStyle('A2:M2')->getFont()->setBold(true);
        $worksheet->getStyle('A2:M2')->getFont()->setSize(10);
        $worksheet->getStyle('A2:M2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $worksheet->setCellValue('A2', 'SURAT JALAN TRANSFER');

        $worksheet->getColumnDimension('A')->setAutoSize(false);
        $worksheet->getColumnDimension('A')->setWidth('7');

        $worksheet->getColumnDimension('B')->setAutoSize(false);
        $worksheet->getColumnDimension('B')->setWidth('7');

        $worksheet->getColumnDimension('C')->setAutoSize(false);
        $worksheet->getColumnDimension('C')->setWidth('3');

        $worksheet->getColumnDimension('D')->setAutoSize(false);
        $worksheet->getColumnDimension('D')->setWidth('7');

        $worksheet->getColumnDimension('E')->setAutoSize(false);
        $worksheet->getColumnDimension('E')->setWidth('7');

        $worksheet->getColumnDimension('F')->setAutoSize(false);
        $worksheet->getColumnDimension('F')->setWidth('3');

        $worksheet->getColumnDimension('G')->setAutoSize(false);
        $worksheet->getColumnDimension('G')->setWidth('7');

        $worksheet->getColumnDimension('H')->setAutoSize(false);
        $worksheet->getColumnDimension('H')->setWidth('7');

        $worksheet->getColumnDimension('I')->setAutoSize(false);
        $worksheet->getColumnDimension('I')->setWidth('3');

        $worksheet->getColumnDimension('J')->setAutoSize(false);
        $worksheet->getColumnDimension('J')->setWidth('7');

        $worksheet->getColumnDimension('K')->setAutoSize(false);
        $worksheet->getColumnDimension('K')->setWidth('7');

        $worksheet->mergeCells('A4:B4');
        $worksheet->mergeCells('A5:B5');
        $worksheet->mergeCells('A6:B6');
        $worksheet->getStyle('A4:B6')->getFont()->setBold(true);
        $worksheet->getStyle('A4:B6')->getFont()->setSize(10);
        $worksheet->getStyle('A4:B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $worksheet->setCellValue('A4', 'Transfer #');
        $worksheet->setCellValue('A5', 'Tanggal');
        $worksheet->setCellValue('A6', 'Dibuat oleh');

        $worksheet->mergeCells('D4:E4');
        $worksheet->mergeCells('D5:E5');
        $worksheet->mergeCells('D6:E6');
        $worksheet->getStyle('D4:E6')->getFont()->setSize(10);
        $worksheet->getStyle('D4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $worksheet->setCellValue('D4', $transfer->number);
        $worksheet->setCellValue('D5', Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($transfer->date)));
        $worksheet->setCellValue('D6', $transfer->admin->name);

        $worksheet->mergeCells('G4:H4');
        $worksheet->mergeCells('G5:H5');
        $worksheet->mergeCells('G6:H6');
        $worksheet->getStyle('G4:H6')->getFont()->setBold(true);
        $worksheet->getStyle('G4:H6')->getFont()->setSize(10);
        $worksheet->getStyle('G4:H6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $worksheet->setCellValue('G4', 'Dari Gudang');
        $worksheet->setCellValue('G5', 'Ke Gudang');
        $worksheet->setCellValue('G6', '');

        $worksheet->mergeCells('J4:M4');
        $worksheet->mergeCells('J5:K5');
        $worksheet->mergeCells('J6:K6');
        $worksheet->getStyle('J4:K6')->getFont()->setSize(10);
        $worksheet->getStyle('J4:K6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $worksheet->setCellValue('J4', $transfer->warehouseIdFrom->code);
        $worksheet->setCellValue('J5', $transfer->warehouseIdTo->code);
        $worksheet->setCellValue('J6', '');

        $worksheet->mergeCells('A8:H8');
        $worksheet->mergeCells('I8:K8');
        $worksheet->getStyle('A8:M8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyle('A8:M8')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $worksheet->setCellValue('A8', 'Nama Barang');
        $worksheet->setCellValue('I8', 'Ukuran');
        $worksheet->setCellValue('L8', 'Jumlah');
        $worksheet->setCellValue('M8', 'Satuan');

        $counter = 9;
        foreach ($transfer->transferDetails as $i => $detail) {
            $worksheet->getStyle("A{$counter}")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $worksheet->getStyle("I{$counter}")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $worksheet->getStyle("L{$counter}")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $worksheet->getStyle("M{$counter}")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $worksheet->getStyle("M{$counter}")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $worksheet->getStyle("I{$counter}:K{$counter}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $worksheet->getStyle("L{$counter}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $worksheet->mergeCells("A{$counter}:H{$counter}");
            $worksheet->mergeCells("I{$counter}:K{$counter}");
            $worksheet->setCellValue("A{$counter}", CHtml::value($detail, 'product.name'));
            $worksheet->setCellValue("I{$counter}", CHtml::value($detail, 'product.size'));
            $worksheet->setCellValue("L{$counter}", CHtml::value($detail, 'quantity'));
            $worksheet->setCellValue("M{$counter}", CHtml::value($detail, 'product.unit.name'));

            $counter++;
        }

        for ($j = 12, $i = $i % $j + 1; $j > $i; $j--) {
            $worksheet->getStyle("A{$counter}")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $worksheet->getStyle("I{$counter}")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $worksheet->getStyle("L{$counter}")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $worksheet->getStyle("M{$counter}")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $worksheet->getStyle("M{$counter}")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $worksheet->mergeCells("A{$counter}:H{$counter}");
            $worksheet->mergeCells("I{$counter}:K{$counter}");
            $counter++;
        }

        $worksheet->getStyle("A{$counter}:M{$counter}")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $worksheet->mergeCells("A{$counter}:H{$counter}");
        $worksheet->mergeCells("I{$counter}:K{$counter}");
        $worksheet->getStyle("I{$counter}:K{$counter}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $worksheet->getStyle("L{$counter}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $worksheet->setCellValue("I{$counter}", 'TOTAL');
        $worksheet->setCellValue("L{$counter}", CHtml::value($transfer, 'totalQuantity'));
        $counter++;

        $worksheet->mergeCells("A{$counter}:B{$counter}");
        $worksheet->mergeCells("B{$counter}:M{$counter}");
        $worksheet->getStyle("A{$counter}:B{$counter}")->getFont()->setBold(true);
        $worksheet->setCellValue("A{$counter}", 'Catatan');
        $worksheet->setCellValue("C{$counter}", $transfer->note);
        $counter++;
        $counter++;

        $worksheet->mergeCells("A{$counter}:B{$counter}");
        $worksheet->mergeCells("D{$counter}:F{$counter}");
        $worksheet->mergeCells("G{$counter}:J{$counter}");
        $worksheet->mergeCells("K{$counter}:M{$counter}");
        $worksheet->getStyle("A{$counter}:M{$counter}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $worksheet->setCellValue("A{$counter}", 'Tanda Terima,');
        $worksheet->setCellValue("D{$counter}", 'Disiapkan oleh,');
        $worksheet->setCellValue("G{$counter}", 'Diperiksa oleh,');
        $worksheet->setCellValue("K{$counter}", 'Hormat kami,');

        header('Content-Type: application/xlsx');
        header('Content-Disposition: attachment;filename="surat jalan.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');

        Yii::app()->end();
    }

    protected function loadState(&$transfer) {
        if (isset($_POST['TransferHeader'])) {
            $transfer->header->attributes = $_POST['TransferHeader'];
        }
        if (isset($_POST['TransferDetail'])) {
            foreach ($_POST['TransferDetail'] as $item) {
                $detail = new TransferDetail();
                $detail->attributes = $item;
                $transfer->details[] = $detail;
            }
        }
    }
}
