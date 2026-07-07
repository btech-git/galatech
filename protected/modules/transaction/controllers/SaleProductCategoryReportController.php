<?php

class SaleProductCategoryReportController extends Controller {

    public function filters() {
        return array(
//            'access',
        );
    }

    public function filterAccess($filterChain) {
//        if ($filterChain->action->id === 'report') {
//            if (!(Yii::app()->user->checkAccess('ntInvoiceReport') || Yii::app()->user->checkAccess('tInvoiceReport') || Yii::app()->user->checkAccess('tsInvoiceReport')))
//                $this->redirect(array('/site/login'));
//        }

        $filterChain->run();
    }

    public function actionReport() {
        $startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : date('Y-m-d');
        $endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : date('Y-m-d');
        
        $sql = "SELECT p.category_id, MIN(c.name) AS category_name, SUM(quantity) AS total_quantity, SUM(d.quantity * (d.unit_price * (100 - d.discount) / 100)) * 1.11 AS total_price
                FROM " . DeliveryDetail::model()->tableName() . " d 
                INNER JOIN " . DeliveryHeader::model()->tableName() . " h ON h.id = d.delivery_header_id
                INNER JOIN " . Product::model()->tableName() . " p ON p.id = d.product_id
                INNER JOIN " . Category::model()->tableName() . " c ON c.id = p.category_id
                WHERE h.date BETWEEN :start_date AND :end_date
                GROUP BY p.category_id
                ORDER BY c.name";
        
        
        $resultSet = Yii::app()->db->createCommand($sql)->queryAll(true, array(
            ':start_date' => $startDate,
            ':end_date' => $endDate,
        ));
        
        if (isset($_GET['SaveExcel'])) {
            $this->saveToExcel($startDate, $endDate, $resultSet);
        }

        $this->render('report', array(
            'startDate' => $startDate,
            'endDate' => $endDate,
            'resultSet' => $resultSet,
        ));
    }

    protected function saveToExcel($startDate, $endDate, $resultSet) {
        spl_autoload_unregister(array('YiiBase', 'autoload'));
        include_once Yii::getPathOfAlias('ext.phpexcel.Classes') . DIRECTORY_SEPARATOR . 'PHPExcel.php';
        spl_autoload_register(array('YiiBase', 'autoload'));

        $objPHPExcel = new PHPExcel();

        $documentProperties = $objPHPExcel->getProperties();
        $documentProperties->setCreator('Galatech');
        $documentProperties->setTitle('Laporan Penjualan per Kategori Produk');

        $worksheet = $objPHPExcel->setActiveSheetIndex(0);
        $worksheet->setTitle('Penjualan per Kategori Produk');

        $worksheet->mergeCells('A1:C1');
        $worksheet->mergeCells('A2:C2');
        $worksheet->mergeCells('A3:C3');

        $worksheet->getStyle('A1:C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyle('A1:C3')->getFont()->setBold(true);

        $worksheet->setCellValue('A1', 'Galatech');
        $worksheet->setCellValue('A2', 'Laporan Penjualan per Kategori Produk');
        $worksheet->setCellValue('A3', Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($startDate)) . ' - ' . Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($endDate)));

        $worksheet->setCellValue('A5', 'Kategori');
        $worksheet->setCellValue('B5', 'Total Quantity');
        $worksheet->setCellValue('C5', 'Total Price');

        $worksheet->getStyle('A5:C5')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $worksheet->getStyle('A5:C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $counter = 7;
        $totalQuantity = 0;
        $totalPrice = '0.00';
        foreach ($resultSet as $dataItem) {
            $worksheet->getStyle("A{$counter}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $worksheet->getStyle("B{$counter}")->getNumberFormat()->setFormatCode('#,##0');
            $worksheet->getStyle("C{$counter}")->getNumberFormat()->setFormatCode('#,##0.00');

            $worksheet->setCellValue("A{$counter}", $dataItem['category_name']);
            $worksheet->setCellValue("B{$counter}", $dataItem['total_quantity']);
            $worksheet->setCellValue("C{$counter}", $dataItem['total_price']);

            $totalQuantity += $dataItem['total_quantity'];
            $totalPrice += $dataItem['total_price'];
            
            $counter++;
        }
        $counter++;

        $worksheet->getStyle("A{$counter}:C{$counter}")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $worksheet->getStyle("A{$counter}:C{$counter}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $worksheet->getStyle("B{$counter}")->getNumberFormat()->setFormatCode('#,##0');
        $worksheet->getStyle("C{$counter}")->getNumberFormat()->setFormatCode('#,##0.00');
        
        $worksheet->setCellValue("A{$counter}", 'TOTAL');
        $worksheet->setCellValue("B{$counter}", $totalQuantity);
        $worksheet->setCellValue("C{$counter}", $totalPrice);

        for ($col = 'A'; $col !== 'P'; $col++) {
            $objPHPExcel->getActiveSheet()
            ->getColumnDimension($col)
            ->setAutoSize(true);
        }
        
        header('Content-Type: application/xlsx');
        header('Content-Disposition: attachment;filename="laporan_penjualan_kategori_produk.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');

        Yii::app()->end();
    }
}
