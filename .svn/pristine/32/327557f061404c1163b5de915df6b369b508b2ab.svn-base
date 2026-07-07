<?php

class ProfitLossController extends Controller
{

	public function filters()
	{
		return array(
			'access',
		);
	}

	public function filterAccess($filterChain)
	{
		if ($filterChain->action->id === 'report' || $filterChain->action->id === 'receiveAjaxData' || $filterChain->action->id === 'updateDataAjax')
		{
			if (!(Yii::app()->user->checkAccess('ntAccountingReport') || Yii::app()->user->checkAccess('tAccountingReport') || Yii::app()->user->checkAccess('tsAccountingReport')))
				$this->redirect(array('/site/login'));
		}

		$filterChain->run();
	}

	public function actionReport()
	{
		$startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : date('Y-m-d');
		$endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : date('Y-m-d');
		
		$sql = SqlGenerator::profitLoss();
		$params = array(':start_date' => $startDate, ':end_date' => $endDate);

		$row = Yii::app()->db->createCommand($sql)->queryRow(true, $params);
		
		$this->render('report', array(
			'row' => $row,
			'startDate' => $startDate,
			'endDate' => $endDate,
		));
	}

	public function actionReceiveAjaxData()
	{
		if (Yii::app()->request->isAjaxRequest)
		{
			$receiveId = (isset($_POST['ReceiveId'])) ? $_POST['ReceiveId'] : '';
			$receive = ReceiveHeader::model()->findByPk($receiveId);

			$object = array(
				'receive_header_number' => CHtml::value($receive, 'number'),
				'supplier_name' => CHtml::value($receive, 'supplier.name'),
			);

			echo CJSON::encode($object);
		}
	}

	public function actionUpdateDataAjax()
	{
		if (Yii::app()->request->isAjaxRequest)
		{
			$receiveId = (isset($_POST['ReceiveId'])) ? $_POST['ReceiveId'] : '';

			$sql = SqlGenerator::profitLoss(empty($receiveId));

			$rows = Yii::app()->db->createCommand($sql)->queryRow(true, array(':receive_id' => $receiveId));

			$this->renderPartial('_report', array(
				'rows' => $rows,
			));
		}
	}

	protected function saveToExcel($dataProvider, array $options = array())
	{
		spl_autoload_unregister(array('YiiBase', 'autoload'));
		include_once Yii::getPathOfAlias('ext.phpexcel.Classes') . DIRECTORY_SEPARATOR . 'PHPExcel.php';
		spl_autoload_register(array('YiiBase', 'autoload'));

		$objPHPExcel = new PHPExcel();

		$documentProperties = $objPHPExcel->getProperties();
		$documentProperties->setCreator('Naili');
		$documentProperties->setTitle('Profit Loss');

		$worksheet = $objPHPExcel->setActiveSheetIndex(0);
		$worksheet->setTitle('Profit Loss');

		$worksheet->getColumnDimension('A')->setAutoSize(true);
		$worksheet->getColumnDimension('B')->setAutoSize(true);

		$worksheet->mergeCells('A1:B1');
		$worksheet->mergeCells('A2:B2');

		$worksheet->getStyle('A1:B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$worksheet->getStyle('A7')->getFont()->setBold(true);
		$worksheet->getStyle('A9')->getFont()->setBold(true);
		$worksheet->getStyle('A6:B6')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$worksheet->getStyle('A8:B8')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		$worksheet->setCellValue('A1', 'Laporan Profit / Loss');

		$worksheet->setCellValue('A4', 'SALES');
		$worksheet->setCellValue('A5', 'PURCHASE');
		$worksheet->setCellValue('A6', 'GROSS');
		$worksheet->setCellValue('A7', 'Expense');
		$worksheet->setCellValue('A8', 'PROFIT/LOSS');

		$counter = 8;
		
		$worksheet->getStyle("B4{$counter}")->getNumberFormat()->setFormatCode('#,##0.00');
		$worksheet->getStyle("B5{$counter}")->getNumberFormat()->setFormatCode('#,##0.00');
		$worksheet->getStyle("B6{$counter}")->getNumberFormat()->setFormatCode('#,##0.00');
		$worksheet->getStyle("B7{$counter}")->getNumberFormat()->setFormatCode('#,##0.00');
		$worksheet->getStyle("B8{$counter}")->getNumberFormat()->setFormatCode('#,##0.00');

		$worksheet->setCellValue("B4", $dataProvider['sales_amount']);
		$worksheet->setCellValue("B5", $dataProvider['purchase_amount']);
		$worksheet->setCellValue("B6", $dataProvider['gross']);
		$worksheet->setCellValue("B7", $dataProvider['expense_amount']);
		$worksheet->setCellValue("B8", $dataProvider['profit_loss']);

		header('Content-Type: application/xlsx');
		header('Content-Disposition: attachment;filename="profitloss.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');

		Yii::app()->end();
	}
}
