<?php

class AccountingJournalController extends Controller
{

	public function filters()
	{
		return array(
			'access',
		);
	}

	public function filterAccess($filterChain)
	{
		if ($filterChain->action->id === 'report')
		{
			if (!(Yii::app()->user->checkAccess('ntAccountingReport') || Yii::app()->user->checkAccess('tAccountingReport') || Yii::app()->user->checkAccess('tsAccountingReport')))
				$this->redirect(array('/site/login'));
		}

		$filterChain->run();
	}

	public function actionReport()
	{
		set_time_limit(0);
		ini_set('memory_limit', '1024M');
		
		$accountingJournal = new AccountingJournal('search');
		$accountingJournal->unsetAttributes();
		if (isset($_GET['AccountingJournal']))
			$accountingJournal->attributes = $_GET['AccountingJournal'];
		
		$startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : '';
		$endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : '';
		$pageSize = (isset($_GET['PageSize'])) ? $_GET['PageSize'] : '';
		$currentPage = (isset($_GET['page'])) ? $_GET['page'] : '';
		$currentSort = (isset($_GET['sort'])) ? $_GET['sort'] : '';

		$dataProvider = $accountingJournal->search();
		$dataProvider->criteria->with = array('account');

		$page = array('size' => $pageSize, 'current' => $currentPage);
		$date = array('attribute' => 'date', 'start' => $startDate, 'end' => $endDate);

		$sort = new CSort(get_class($accountingJournal));
		$sort->attributes = array('date', 'account.name');

		$dataProvider = ReportHelper::finalizeDataProvider($dataProvider, $page, $sort, $date);
		
		if (isset($_GET['SaveExcel']))
			$this->saveToExcel($dataProvider, array('startDate' => $startDate, 'endDate' => $endDate));

		$this->render('report', array(
			'accountingJournal' => $accountingJournal,
			'dataProvider' => $dataProvider,
			'sort' => $sort,
			'currentSort' => $currentSort,
			'startDate' => $startDate,
			'endDate' => $endDate,
		));
	}
	
	protected function saveToExcel($dataProvider, array $options = array())
	{
		set_time_limit(0);
		ini_set('memory_limit', '1024M');
		
		spl_autoload_unregister(array('YiiBase', 'autoload'));
		include_once Yii::getPathOfAlias('ext.phpexcel.Classes') . DIRECTORY_SEPARATOR . 'PHPExcel.php';
		spl_autoload_register(array('YiiBase', 'autoload'));

		$objPHPExcel = new PHPExcel();

		$documentProperties = $objPHPExcel->getProperties();
		$documentProperties->setCreator('Galatech');
		$documentProperties->setTitle('Laporan Jurnal Pembukuan');

		$worksheet = $objPHPExcel->setActiveSheetIndex(0);
		$worksheet->setTitle('Jurnal Pembukuan');

		$worksheet->getColumnDimension('A')->setAutoSize(true);
		$worksheet->getColumnDimension('B')->setAutoSize(true);
		$worksheet->getColumnDimension('C')->setAutoSize(true);
		$worksheet->getColumnDimension('D')->setAutoSize(true);
		$worksheet->getColumnDimension('E')->setAutoSize(true);

		$worksheet->mergeCells('A1:E1');
		$worksheet->mergeCells('A2:E2');

		$worksheet->getStyle('A1:E5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$worksheet->getStyle('A1:E5')->getFont()->setBold(true);

		$worksheet->setCellValue('A1', 'Laporan Jurnal Pembukuan');
		$worksheet->setCellValue('A2', Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($options['startDate'])) . ' - ' . Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($options['endDate'])));

		$worksheet->getStyle('A5:E5')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);

		$worksheet->setCellValue('A5', 'Nomor Transaksi');
		$worksheet->setCellValue('B5', 'Tanggal');
		$worksheet->setCellValue('C5', 'Debit');
		$worksheet->setCellValue('D5', 'Kredit');
		$worksheet->setCellValue('E5', 'Kode Akun');

		$counter = 6;
		foreach ($dataProvider->data as $header)
		{
			$worksheet->getStyle("A{$counter}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$worksheet->getStyle("C{$counter}")->getNumberFormat()->setFormatCode('#,##0.00');
			$worksheet->getStyle("D{$counter}")->getNumberFormat()->setFormatCode('#,##0.00');

			$worksheet->setCellValue("A{$counter}", $header->transaction_number);
			$worksheet->setCellValue("B{$counter}", Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($header->date)));
			$worksheet->setCellValue("C{$counter}", $header->debit);
			$worksheet->setCellValue("D{$counter}", $header->credit);
			$worksheet->setCellValue("E{$counter}", ($header->account_id === null) ? 'NULL' : $header->account->name);

			$counter++;
		}

		header('Content-Type: application/xlsx');
		header('Content-Disposition: attachment;filename="Laporan Jurnal Pembukuan.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');

		Yii::app()->end();
	}
}
