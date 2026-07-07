<?php

class BankBookController extends Controller {

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
        set_time_limit(0);
        ini_set('memory_limit', '1024M');

        $account = new Account('search');
        $account->unsetAttributes();
        if (isset($_GET['AccountId'])) {
            $account->attributes = $_GET['AccountId'];
        }

        $startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : date('Y-m-d');
        $endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : date('Y-m-d');
        $accountId = (isset($_GET['AccountId'])) ? $_GET['AccountId'] : 1;
        $pageSize = (isset($_GET['PageSize'])) ? $_GET['PageSize'] : 10;
        $currentPage = (isset($_GET['CurrentPage'])) ? $_GET['CurrentPage'] - 1 : 0;

        $sql = SqlGenerator::bankBook();
        $params = array(':account_id' => $accountId, ':start_date' => $startDate, ':end_date' => $endDate);

        $dataProvider = new CSqlDataProvider($sql, array(
            'db' => CActiveRecord::$db,
            'params' => $params,
            'totalItemCount' => CActiveRecord::$db->createCommand(SqlViewGenerator::count($sql))->queryScalar($params),
            'pagination' => array(
                'pageVar' => 'CurrentPage',
                'pageSize' => ($pageSize > 0) ? $pageSize : 1,
                'currentPage' => $currentPage,
            ),
        ));

        $accountName = Account::model()->findByPk($accountId);

        if (isset($_GET['SaveExcel']))
            $this->saveToExcel($dataProvider, array('startDate' => $startDate, 'endDate' => $endDate, 'accountId' => $accountId));

        $this->render('report', array(
            'account' => $account,
            'dataProvider' => $dataProvider,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'accountId' => $accountId,
            'accountName' => $accountName,
        ));
    }

    protected function saveToExcel($dataProvider, array $options = array()) {
        set_time_limit(0);
        ini_set('memory_limit', '1024M');

        spl_autoload_unregister(array('YiiBase', 'autoload'));
        include_once Yii::getPathOfAlias('ext.phpexcel.Classes') . DIRECTORY_SEPARATOR . 'PHPExcel.php';
        spl_autoload_register(array('YiiBase', 'autoload'));

        $objPHPExcel = new PHPExcel();

        $documentProperties = $objPHPExcel->getProperties();
        $documentProperties->setCreator('Galatech');
        $documentProperties->setTitle('Laporan Buku Bank');

        $worksheet = $objPHPExcel->setActiveSheetIndex(0);
        $worksheet->setTitle('Buku Bank');

        $worksheet->getColumnDimension('A')->setAutoSize(true);
        $worksheet->getColumnDimension('B')->setAutoSize(true);
        $worksheet->getColumnDimension('C')->setAutoSize(true);
        $worksheet->getColumnDimension('D')->setAutoSize(true);
        $worksheet->getColumnDimension('E')->setAutoSize(true);
        $worksheet->getColumnDimension('F')->setAutoSize(true);
        $worksheet->getColumnDimension('G')->setAutoSize(true);

        $worksheet->mergeCells('A1:G1');
        $worksheet->mergeCells('A2:G2');

        $worksheet->getStyle('A1:G5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyle('A5:G6')->getFont()->setBold(true);

        $worksheet->setCellValue('A1', 'Laporan Buku Bank');
        $worksheet->setCellValue('A2', Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($options['startDate'])) . ' - ' . Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($options['endDate'])));

        $worksheet->setCellValue('A5', 'Transaksi #');
        $worksheet->setCellValue('B5', 'Tanggal');
        $worksheet->setCellValue('C5', 'Account');
        $worksheet->setCellValue('D5', 'Keterangan');
        $worksheet->setCellValue('E5', 'Debit');
        $worksheet->setCellValue('F5', 'Credit');
        $worksheet->setCellValue('G5', 'Saldo');

        $worksheet->getStyle('A5:G5')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);

        $initialBalance = Account::model()->getBeginningBalance($options['accountId'], $options['startDate']);
        $worksheet->getStyle("G6")->getNumberFormat()->setFormatCode('#,##0.00');
        $worksheet->setCellValue("E6", 'SALDO AWAL');
        $worksheet->setCellValue("G6", $initialBalance);

        $counter = 7;

        $totalDebit = 0.00;
        $totalCredit = 0.00;
        foreach ($dataProvider->data as $header) {
            $debit = $header['debit'];
            $credit = $header['credit'];
            $totalDebit += $debit;
            $totalCredit += $credit;
            $balance = $initialBalance + $debit - $credit;

            $worksheet->getStyle("C{$counter}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $worksheet->getStyle("D{$counter}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $worksheet->getStyle("E{$counter}")->getNumberFormat()->setFormatCode('#,##0.00');
            $worksheet->getStyle("F{$counter}")->getNumberFormat()->setFormatCode('#,##0.00');
            $worksheet->getStyle("G{$counter}")->getNumberFormat()->setFormatCode('#,##0.00');
            $worksheet->setCellValue("A{$counter}", $header['number']);
            $worksheet->setCellValue("B{$counter}", Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($header['date'])));
            $worksheet->setCellValue("C{$counter}", $header['code']);
            $worksheet->setCellValue("D{$counter}", $header['account']);
            $worksheet->setCellValue("E{$counter}", $debit);
            $worksheet->setCellValue("F{$counter}", $credit);
            $worksheet->setCellValue("G{$counter}", $balance);

            $initialBalance = $balance;

            $counter++;
        }

        header('Content-Type: application/xlsx');
        header('Content-Disposition: attachment;filename="Laporan Buku Bank.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');

        Yii::app()->end();
    }

}
