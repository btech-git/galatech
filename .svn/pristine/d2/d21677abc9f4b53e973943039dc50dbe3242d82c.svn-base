<?php

class AgingPayableController extends Controller
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
		
		$purchaseReceiptHeader = new PurchaseReceiptHeader('search');
		$purchaseReceiptHeader->unsetAttributes();
		if (isset($_GET['PurchaseReceiptHeader']))
			$purchaseReceiptHeader->attributes = $_GET['PurchaseReceiptHeader'];

		$startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : '';
		$endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : '';
		$pageSize = (isset($_GET['PageSize'])) ? $_GET['PageSize'] : '';
		$currentPage = (isset($_GET['page'])) ? $_GET['page'] : '';
		$currentSort = (isset($_GET['sort'])) ? $_GET['sort'] : '';

		$dataProvider = $purchaseReceiptHeader->search();
		$dataProvider->criteria->with = array('supplier:resetScope');
		$dataProvider->criteria->addCondition(SqlViewGenerator::agingPayable());
		
		$page = array('size' => $pageSize, 'current' => $currentPage);
		$date = array('attribute' => 't.date', 'start' => $startDate, 'end' => $endDate);

		$sort = new CSort(get_class($purchaseReceiptHeader));
		$sort->attributes = array('t.date', 'supplier.company');

		$dataProvider = ReportHelper::finalizeDataProvider($dataProvider, $page, $sort, $date);
		
		if (isset($_GET['SaveExcel']))
			$this->saveToExcel($dataProvider, array('startDate' => $startDate, 'endDate' => $endDate));
		
		$this->render('report', array(
			'purchaseReceiptHeader' => $purchaseReceiptHeader,
			'dataProvider' => $dataProvider,
			'startDate' => $startDate,
			'endDate' => $endDate,
			'sort' => $sort,
			'currentSort' => $currentSort,
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
		$documentProperties->setTitle('Laporan Utang Pembelian Barang');

		$worksheet = $objPHPExcel->setActiveSheetIndex(0);
		$worksheet->setTitle('Utang Pembelian');

		$worksheet->getColumnDimension('A')->setAutoSize(true);
		$worksheet->getColumnDimension('B')->setAutoSize(true);
		$worksheet->getColumnDimension('C')->setAutoSize(true);
		$worksheet->getColumnDimension('D')->setAutoSize(true);
		$worksheet->getColumnDimension('E')->setAutoSize(true);
		$worksheet->getColumnDimension('F')->setAutoSize(true);

		$worksheet->mergeCells('A1:F1');
		$worksheet->mergeCells('A2:F2');

		$worksheet->getStyle('A1:F6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$worksheet->getStyle('A1:F6')->getFont()->setBold(true);

		$worksheet->setCellValue('A1', 'Laporan Utang Pembelian Barang');
		$worksheet->setCellValue('A2', Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($options['startDate'])) . ' - ' . Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($options['endDate'])));

		$worksheet->setCellValue('A5', 'Invoice #');
		$worksheet->setCellValue('B5', 'Tanggal');
		$worksheet->setCellValue('C5', 'Supplier');
		$worksheet->setCellValue('D5', 'Total');

		$worksheet->getStyle('A6:F6')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
		
		$worksheet->setCellValue('B6', 'Tanda Terima #');
		$worksheet->setCellValue('C6', 'Tanggal');
		$worksheet->setCellValue('D6', 'Total');
		$worksheet->setCellValue('E6', 'Pelunasan');
		$worksheet->setCellValue('F6', 'Sisa');
		
		$counter = 8;
		foreach ($dataProvider->data as $header)
		{
			$worksheet->getStyle("A{$counter}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$worksheet->getStyle("C{$counter}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			$worksheet->getStyle("D{$counter}")->getNumberFormat()->setFormatCode('#,##0.00');
			
			$worksheet->setCellValue("A{$counter}", $header->number);
			$worksheet->setCellValue("B{$counter}", Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($header->date)));
			$worksheet->setCellValue("C{$counter}", $header->purchaseHeader->supplier->company);
			$worksheet->setCellValue("D{$counter}", $header->totalPurchase);

			$counter++;
			foreach ($header->purchaseReceiptDetails as $detail)
			{
				$worksheet->getStyle("D{$counter}:F{$counter}")->getNumberFormat()->setFormatCode('#,##0.00');

				$worksheet->setCellValue("B{$counter}", $detail->purchaseReceiptHeader->number);
				$worksheet->setCellValue("C{$counter}", $detail->purchaseReceiptHeader->date);
				$worksheet->setCellValue("D{$counter}", $detail->purchaseReceiptHeader->totalPurchase);
				$worksheet->setCellValue("E{$counter}", $detail->purchaseReceiptHeader->payment);
				$worksheet->setCellValue("F{$counter}", $detail->purchaseReceiptHeader->remaining);

				$counter++;
			}

			$worksheet->getStyle("A{$counter}:F{$counter}")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
//			$worksheet->getStyle("B{$counter}:F{$counter}")->getFont()->setBold(true);
			$worksheet->getStyle("D{$counter}")->getNumberFormat()->setFormatCode('#,##0');
		}

		header('Content-Type: application/xlsx');
		header('Content-Disposition: attachment;filename="utang_pembelian.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');

		Yii::app()->end();
	}
	
	public function reportTotalPayable($dataProvider)
	{
		$grandTotal = 0.00;

		foreach ($dataProvider->data as $data)
			$grandTotal += $data->totalPurchase;

		return $grandTotal;
	}
}
