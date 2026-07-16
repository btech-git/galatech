<?php

class StockValueController extends Controller {

    public function filters() {
        return array(
            'access',
        );
    }

    public function filterAccess($filterChain) {
        if ($filterChain->action->id === 'report') {
            if (!(Yii::app()->user->checkAccess('ntWarehouseReport') || Yii::app()->user->checkAccess('tWarehouseReport') || Yii::app()->user->checkAccess('tsWarehouseReport'))) {
                $this->redirect(array('/site/login'));
            }
        }

        $filterChain->run();
    }

    public function actionReport() {
        $product = new Product('search');
        $product->unsetAttributes();
        if (isset($_GET['Product'])) {
            $product->attributes = $_GET['Product'];
        }
        
        $pageSize = (isset($_GET['PageSize'])) ? $_GET['PageSize'] : '';
        $currentPage = (isset($_GET['page'])) ? $_GET['page'] : '';
        $currentSort = (isset($_GET['sort'])) ? $_GET['sort'] : '';

        $dataProvider = $product->search();
        $dataProvider->criteria->with = array('category');

        $page = array('size' => $pageSize, 'current' => $currentPage);

        $sort = new CSort(get_class($product));
        $sort->attributes = array('t.name', 'category.name');

        $dataProvider = ReportHelper::finalizeDataProvider($dataProvider, $page, $sort);

        if (isset($_GET['SaveExcel'])) {
            $this->saveToExcel($dataProvider);
        }

        $this->render('report', array(
            'product' => $product,
            'dataProvider' => $dataProvider,
            'sort' => $sort,
            'currentSort' => $currentSort,
        ));
    }

    protected function saveToExcel($dataProvider) {
        spl_autoload_unregister(array('YiiBase', 'autoload'));
        include_once Yii::getPathOfAlias('ext.phpexcel.Classes') . DIRECTORY_SEPARATOR . 'PHPExcel.php';
        spl_autoload_register(array('YiiBase', 'autoload'));

        $objPHPExcel = new PHPExcel();

        $documentProperties = $objPHPExcel->getProperties();
        $documentProperties->setCreator('Galatech Jaya Abadi');
        $documentProperties->setTitle('Nilai Stok Barang');

        $worksheet = $objPHPExcel->setActiveSheetIndex(0);
        $worksheet->setTitle('Nilai Stok Barang');

        $worksheet->mergeCells('A1:F1');
        $worksheet->mergeCells('A2:F2');
        $worksheet->mergeCells('A3:F3');

        $worksheet->getStyle('A1:F5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyle('A1:F5')->getFont()->setBold(true);

        $worksheet->setCellValue('A1', 'Galatech Jaya Abadi');
        $worksheet->setCellValue('A2', 'Laporan Nilai Stok Barang');

        $worksheet->getStyle('A5:F5')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $worksheet->setCellValue('A5', 'Kategori');
        $worksheet->setCellValue('B5', 'Nama Produk');
        $worksheet->setCellValue('C5', 'Ukuran');
        $worksheet->setCellValue('D5', 'Stok');
        $worksheet->setCellValue('E5', 'HPP');
        $worksheet->setCellValue('F5', 'Nilai Stok');

        $worksheet->getStyle('A5:F5')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $counter = 6;
        $totalStockValueSum = '0.00';
        foreach ($dataProvider->data as $header) {
            $stockQuantity = $header->getCurrentStock();
            $costOfGoodsSold = $header->costOfGoodsSold;
            $totalStockValue = $stockQuantity * $costOfGoodsSold;
            
            $worksheet->setCellValue("A{$counter}", CHtml::value($header, 'category.name'));
            $worksheet->setCellValue("B{$counter}", CHtml::value($header, 'name'));
            $worksheet->setCellValue("C{$counter}", CHtml::value($header, 'size'));
            $worksheet->setCellValue("D{$counter}", $stockQuantity);
            $worksheet->setCellValue("E{$counter}", round($costOfGoodsSold, 2));
            $worksheet->setCellValue("F{$counter}", round($totalStockValue, 2));

            $totalStockValueSum += $totalStockValue;
            $counter++;
        }
        
        $worksheet->getStyle("A{$counter}:F{$counter}")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $worksheet->setCellValue("E{$counter}", 'TOTAL');
        $worksheet->setCellValue("F{$counter}", round($totalStockValueSum, 2));
        $counter++;

        for ($col = 'A'; $col !== 'Z'; $col++) {
            $objPHPExcel->getActiveSheet()
            ->getColumnDimension($col)
            ->setAutoSize(true);
        }
        
        header('Content-Type: application/xlsx');
        header('Content-Disposition: attachment;filename="laporan_nilai_stok_barang.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');

        Yii::app()->end();
    }
}
