<?php

class SaleProductAveragePriceController extends SelectionController {

    public function filters() {
        return array(
//            'access',
        );
    }

    public function filterAccess($filterChain) {
        if ($filterChain->action->id === 'report') {
            if (!(
                Yii::app()->user->checkAccess('ntDeliveryReport') || 
                Yii::app()->user->checkAccess('tDeliveryReport') || 
                Yii::app()->user->checkAccess('tsDeliveryReport')
            )) {
                $this->redirect(array('/site/login'));
            }
        }

        $filterChain->run();
    }

    public function actionReport() {
        $startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : date('Y-m-d');
        $endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : date('Y-m-d');
        $customerName = (isset($_GET['CustomerName'])) ? $_GET['CustomerName'] : '';
        $productName = (isset($_GET['ProductName'])) ? $_GET['ProductName'] : '';
        $productSize = (isset($_GET['ProductSize'])) ? $_GET['ProductSize'] : '';

        if (isset($_GET['ResetFilter'])) {
            $startDate = date('Y-m-d');
            $endDate = date('Y-m-d');
            $customerName = '';
            $productName = '';
            $productSize = '';
        }
        
        $saleProductAveragePriceReport = DeliveryDetail::getSaleProductAveragePriceReport($startDate, $endDate, $customerName, $productName, $productSize);
        
        if (isset($_GET['SaveExcel'])) {
            $this->saveToExcel($saleProductAveragePriceReport, array('startDate' => $startDate, 'endDate' => $endDate));
        }

        $this->render('report', array(
            'saleProductAveragePriceReport' => $saleProductAveragePriceReport,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'customerName' => $customerName,
            'productName' => $productName, 
            'productSize' => $productSize,
        ));
    }
    
    protected function saveToExcel($saleProductAveragePriceReport, array $options = array()) {
        set_time_limit(0);
        ini_set('memory_limit', '1024M');
        
        spl_autoload_unregister(array('YiiBase', 'autoload'));
        include_once Yii::getPathOfAlias('ext.phpexcel.Classes') . DIRECTORY_SEPARATOR . 'PHPExcel.php';
        spl_autoload_register(array('YiiBase', 'autoload'));

        $objPHPExcel = new PHPExcel();

        $documentProperties = $objPHPExcel->getProperties();
        $documentProperties->setCreator('Galatech Jaya Abadi');
        $documentProperties->setTitle('Profit Penjualan Barang');

        $worksheet = $objPHPExcel->setActiveSheetIndex(0);
        $worksheet->setTitle('Profit Penjualan Barang');

        $worksheet->mergeCells('A1:I1');
        $worksheet->mergeCells('A2:I2');
        $worksheet->mergeCells('A3:I3');

        $worksheet->getStyle('A1:I5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyle('A1:I5')->getFont()->setBold(true);

        $worksheet->setCellValue('A1', 'Galatech Jaya Abadi');
        $worksheet->setCellValue('A2', 'Laporan Profit Penjualan Barang (Average)');
        $worksheet->setCellValue('A3', Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($options['startDate'])) . ' - ' . Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($options['endDate'])));

        $worksheet->getStyle('A5:I5')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);

        $worksheet->setCellValue('A5', 'Penjualan #');
        $worksheet->setCellValue('B5', 'Tanggal');
        $worksheet->setCellValue('C5', 'Customer');
        $worksheet->setCellValue('D5', 'Nama Barang');
        $worksheet->setCellValue('E5', 'Ukuran');
        $worksheet->setCellValue('F5', 'Jumlah');
        $worksheet->setCellValue('G5', 'Harga Satuan');
        $worksheet->setCellValue('H5', 'Total');
        $worksheet->setCellValue('I5', 'HPP');

        $worksheet->getStyle('A5:I5')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);

        $counter = 7;
        foreach ($saleProductAveragePriceReport as $i => $dataItem) {
            $worksheet->getStyle("E{$counter}:F{$counter}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            $worksheet->setCellValue("A{$counter}", $dataItem['number']);
            $worksheet->setCellValue("B{$counter}", $dataItem['date']);
            $worksheet->setCellValue("C{$counter}", $dataItem['customer_name']);
            $worksheet->setCellValue("D{$counter}", $dataItem['product_name']);
            $worksheet->setCellValue("E{$counter}", $dataItem['size']);
            $worksheet->setCellValue("F{$counter}", $dataItem['quantity']);
            $worksheet->setCellValue("G{$counter}", $dataItem['unit_price']);
            $worksheet->setCellValue("H{$counter}", $dataItem['total']);
            $worksheet->setCellValue("I{$counter}", $dataItem['average_purchase_price']);

            $counter++;
        }

        for ($col = 'A'; $col !== 'P'; $col++) {
            $objPHPExcel->getActiveSheet()
            ->getColumnDimension($col)
            ->setAutoSize(true);
        }
        
        ob_end_clean();
        // We'll be outputting an excel file
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="profit_penjualan_average.xls"');
        header('Cache-Control: max-age=0');
        
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');

        Yii::app()->end();
    }
}