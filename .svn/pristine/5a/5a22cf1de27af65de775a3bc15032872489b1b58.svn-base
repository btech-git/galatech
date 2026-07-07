<?php

class ProductController extends SelectionController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'access',
        );
    }

    public function filterAccess($filterChain) {
        if ($filterChain->action->id === 'admin' || $filterChain->action->id === 'create' || $filterChain->action->id === 'delete' || $filterChain->action->id === 'index' || $filterChain->action->id === 'update' || $filterChain->action->id === 'view') {
            if (!Yii::app()->user->checkAccess('master'))
                $this->redirect(array('/site/login'));
        }

        $filterChain->run();
    }

    public function instantiate($id) {
        if (empty($id))
            $model = new ProductComponent(new Product, array());
        else {
            $header = $this->loadModel($id);
            $model = new ProductComponent($header, $header->sizes);
        }

        return $model;
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $model = $this->loadModel($id);

        $specificationList = $this->specificationList($model->category_id);

        $this->render('view', array(
            'model' => $model,
            'specificationList' => $specificationList,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
//        $model = new Product;

        $model = $this->instantiate(null);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Product'])) {
//            $model->attributes = $_POST['Product'];

            $this->loadState($model);

            if ($model->save(Yii::app()->db)) {
                $this->redirect(array('admin'));
            }
        }

        $specificationList = $this->specificationList($model->header->category_id);
        $listData = $this->listData($model->header);

        $this->render('create', array(
            'model' => $model,
            'specificationList' => $specificationList,
            'listData' => $listData,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Product'])) {
            $model->attributes = $_POST['Product'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $specificationList = $this->specificationList($model->category_id);
        $listData = $this->listData($model);

        $this->render('update', array(
            'model' => $model,
            'specificationList' => $specificationList,
            'listData' => $listData,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Product');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Product('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Product']))
            $model->attributes = $_GET['Product'];

        $dataProvider = $model->search();
        $dataProvider->model->resetScope();

        $this->render('admin', array(
            'model' => $model,
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Product::model()->resetScope()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
    
    public function loadState($model) {
        if (isset($_POST['Product'])) {
            $model->header->attributes = $_POST['Product'];
        }
        if (isset($_POST['ProductSize'])) {
            foreach ($_POST['ProductSize'] as $i => $item) {
                if (isset($model->details[$i]))
                    $model->details[$i]->attributes = $item;
                else {
                    $detail = new ProductSize();
                    $detail->attributes = $item;
                    $model->details[] = $detail;
                }
            }
            if (count($_POST['ProductSize']) < count($model->details))
                array_splice($model->details, $i + 1);
        }
        else
            $model->details = array();
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'product-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionExportToExcel() {
        set_time_limit(0);
        ini_set('memory_limit', '1024M');

        $criteria = new CDbCriteria();
        $criteria->select = 'name, size';
        $criteria->compare('t.is_inactive', 0);
        $products = Product::model()->findAll($criteria);

        //initialization
        spl_autoload_unregister(array('YiiBase', 'autoload'));
        include_once Yii::getPathOfAlias('ext.phpexcel.Classes') . DIRECTORY_SEPARATOR . 'PHPExcel.php';
        spl_autoload_register(array('YiiBase', 'autoload'));

        $objPHPExcel = new PHPExcel();

        $documentProperties = $objPHPExcel->getProperties();
        $documentProperties->setCreator('Galatech');
        $documentProperties->setTitle('All Product');

        $worksheet = $objPHPExcel->setActiveSheetIndex(0);

        //content
        $index = 1;
        foreach ($products as $product) {
            $worksheet->setCellValue("A{$index}", $product->name . ' ' . $product->size);
            $index++;
        }

        //finishing
        header('Content-Type: application/xlsx');
        header('Content-Disposition: attachment;filename="Products.xls"');  //set excel file name
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');

        Yii::app()->end();
    }
    
    public function actionAjaxHtmlAddDetail($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $model = $this->instantiate($id);
            $this->loadState($model);

            $model->addDetail();

            $this->renderPartial('_detail', array(
                'model' => $model,
            ));
        }
    }
    
    public function actionAjaxHtmlRemoveDetail($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $model = $this->instantiate($id);
            $this->loadState($model);

            $model->removeDetailAt($index);

            $this->renderPartial('_detail', array(
                'model' => $model,
            ));
        }
    }

}
