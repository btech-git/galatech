<?php

class StockController extends Controller {

    public function filters() {
        return array(
            'access',
        );
    }

    public function filterAccess($filterChain) {
        if ($filterChain->action->id === 'report') {
            if (!(Yii::app()->user->checkAccess('ntWarehouseReport') || Yii::app()->user->checkAccess('tWarehouseReport') || Yii::app()->user->checkAccess('tsWarehouseReport')))
                $this->redirect(array('/site/login'));
        }

        $filterChain->run();
    }

    public function actionReport() {
        $product = new Product('search');
        $product->unsetAttributes();
        if (isset($_GET['Product']))
            $product->attributes = $_GET['Product'];

        $startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : date('Y-m-d');
        $endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : date('Y-m-d');
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
            $this->saveToExcel($dataProvider, $startDate, $endDate);
        }

        $this->render('report', array(
            'product' => $product,
            'dataProvider' => $dataProvider,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'sort' => $sort,
            'currentSort' => $currentSort,
//                        'warehouseId'=>$warehouseId,
        ));
    }

    protected function reportStockBeginning($dataProvider, $startDate) {
        $grandTotal = 0.00;

        foreach ($dataProvider->data as $data)
            $grandTotal += $data->getStockBeginning($startDate);

        return $grandTotal;
    }

    protected function reportStockEnding($dataProvider, $endDate) {
        $grandTotal = 0.00;

        foreach ($dataProvider->data as $data)
            $grandTotal += $data->getStockEnding($endDate);

        return $grandTotal;
    }

    protected function reportStockIn($dataProvider, $startDate, $endDate) {
        $grandTotal = 0.00;

        foreach ($dataProvider->data as $data)
            $grandTotal += $data->getStockIn($startDate, $endDate);

        return $grandTotal;
    }

    protected function reportStockOut($dataProvider, $startDate, $endDate) {
        $grandTotal = 0.00;

        foreach ($dataProvider->data as $data)
            $grandTotal += $data->getStockOut($startDate, $endDate);

        return $grandTotal;
    }

    protected function saveToExcel($dataProvider, $startDate, $endDate) {
        spl_autoload_unregister(array('YiiBase', 'autoload'));
        include_once Yii::getPathOfAlias('ext.phpexcel.Classes') . DIRECTORY_SEPARATOR . 'PHPExcel.php';
        spl_autoload_register(array('YiiBase', 'autoload'));

        $objPHPExcel = new PHPExcel();

        $documentProperties = $objPHPExcel->getProperties();
        $documentProperties->setCreator('Galatech Jaya Abadi');
        $documentProperties->setTitle('Mutasi Stok Barang Global');

        $worksheet = $objPHPExcel->setActiveSheetIndex(0);
        $worksheet->setTitle('Mutasi Stok Barang Global');

        $worksheet->mergeCells('A1:I1');
        $worksheet->mergeCells('A2:I2');
        $worksheet->mergeCells('A3:I3');

        $worksheet->getStyle('A1:I5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyle('A1:I5')->getFont()->setBold(true);

        $worksheet->setCellValue('A1', 'Galatech Jaya Abadi');
        $worksheet->setCellValue('A2', 'Mutasi Stok Barang Global');

        $worksheet->getStyle('A5:I5')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $worksheet->setCellValue('A5', 'Kategori');
        $worksheet->setCellValue('B5', 'Nama Produk');
        $worksheet->setCellValue('C5', 'Ukuran');
        $worksheet->setCellValue('D5', 'Stok Awal');
        $worksheet->setCellValue('E5', 'Stok Masuk');
        $worksheet->setCellValue('F5', 'Stok Keluar');
        $worksheet->setCellValue('G5', 'Stok Akhir');
//        $worksheet->setCellValue('H5', 'HPP');
//        $worksheet->setCellValue('I5', 'Nilai Stok');

        $worksheet->getStyle('A5:I5')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $counter = 6;
        foreach ($dataProvider->data as $header) {
            $beginningStock = $header->getStockBeginning($startDate);
            $stockIn = $header->getStockIn($startDate, $endDate);
            $stockOut = $header->getStockOut($startDate, $endDate);
            $endingStock = $beginningStock + $stockIn - $stockOut;
            $costOfGoodsSold = $header->costOfGoodsSold;
            $totalStockValue = $endingStock * $costOfGoodsSold;
            
            $worksheet->setCellValue("A{$counter}", CHtml::value($header, 'category.name'));
            $worksheet->setCellValue("B{$counter}", CHtml::value($header, 'name'));
            $worksheet->setCellValue("C{$counter}", CHtml::value($header, 'size'));
            $worksheet->setCellValue("D{$counter}", $beginningStock);
            $worksheet->setCellValue("E{$counter}", $stockIn);
            $worksheet->setCellValue("F{$counter}", $stockOut);
            $worksheet->setCellValue("G{$counter}", $endingStock);
//            $worksheet->setCellValue("H{$counter}", round($costOfGoodsSold, 2));
//            $worksheet->setCellValue("I{$counter}", round($totalStockValue, 2));

            $counter++;
        }
        
        for ($col = 'A'; $col !== 'Z'; $col++) {
            $objPHPExcel->getActiveSheet()
            ->getColumnDimension($col)
            ->setAutoSize(true);
        }
        
        header('Content-Type: application/xlsx');
        header('Content-Disposition: attachment;filename="mutasi_stok_barang_global.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');

        Yii::app()->end();
    }
}
