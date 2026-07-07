<?php

class TaxFormRevisedController extends Controller
{

	public function filters()
	{
		return array(
			'access',
		);
	}

	public function filterAccess($filterChain)
	{
		if ($filterChain->action->id === 'view' || $filterChain->action->id === 'create' || $filterChain->action->id === 'productCompletion' || $filterChain->action->id === 'addProductAjax' || $filterChain->action->id === 'removeProductAjax')
		{
			if (!(Yii::app()->user->checkAccess('createTransaction') || Yii::app()->user->checkAccess('editTransaction')))
				$this->redirect(array('/site/login'));
		}
		if ($filterChain->action->id === 'delete' || $filterChain->action->id === 'admin')
		{
			if (!Yii::app()->user->checkAccess('editTransaction'))
				$this->redirect(array('/site/login'));
		}
		if ($filterChain->action->id === 'report')
		{
			if (!Yii::app()->user->checkAccess('report'))
				$this->redirect(array('/site/login'));
		}

		$filterChain->run();
	}

	public function actionCreate()
	{
		$taxFormRevised = new TaxFormRevised();

		if (isset($_GET['id']))
			$taxFormRevised->copyFromDb($_GET['id']);
//                
//                if ($taxFormRevised->header->isNewRecord)
//                        $taxFormRevised->header->number = CodeNumber::make($taxFormRevised->header, 'number', 'RCV');

		$taxFormRevised->header->admin_id = Yii::app()->user->id;
		$this->loadState($taxFormRevised);

		$taxForm = new TaxForm('search');
		$taxForm->unsetAttributes();  // clear any default values
		if (isset($_GET['TaxForm']))
			$taxForm->attributes = $_GET['TaxForm'];

		$error = false;

		if (isset($_POST['Submit']))
		{
			$dbTransaction = CActiveRecord::$db->beginTransaction();
			try
			{
				if ($taxFormRevised->validate() && $taxFormRevised->save(false))
				{
					$dbTransaction->commit();
					Yii::app()->session['TaxFormRevisedMemoAllowed'] = true;
					$this->redirect(array('view', 'id' => $taxFormRevised->header->id));
				}
				else
				{
					$dbTransaction->rollback();
					$error = true;
				}
			}
			catch (Exception $e)
			{
				$dbTransaction->rollback();
				throw new CHttpException($e->getCode(), $e->getMessage());
			}
		}

		$this->render('create', array(
			'taxFormRevised' => $taxFormRevised,
			'taxForm' => $taxForm,
			'product' => $product,
			'error' => $error,
		));
	}

	public function actionDelete($id)
	{
		if (Yii::app()->request->isPostRequest)
		{
			$taxFormRevised = TaxFormRevised::model()->resetScope()->findByPk($id);
			if ($taxFormRevised !== null)
			{
				$taxFormRevised->is_inactive = !$taxFormRevised->is_inactive;
				$taxFormRevised->update(array('is_inactive'));
			}

			if (!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
	}

	public function actionView($id)
	{
		$taxFormRevised = TaxFormRevised::model()->findByPk($id);

		$this->render('view', array(
			'taxFormRevised' => $taxFormRevised,
		));
	}

	public function actionMemo($id)
	{
		if (!(Yii::app()->user->checkAccess('administrator')))
		{
			if (!(isset(Yii::app()->session['TaxFormRevisedMemoAllowed']) && Yii::app()->session['TaxFormRevisedMemoAllowed'] === true))
				$this->redirect(array('admin'));
		}
		
		Yii::app()->session->remove('TaxFormRevisedMemoAllowed');
		
		$taxFormRevised = TaxFormRevised::model()->findByPk($id);
		
		$taxFormRevisedSupplier = ($taxFormRevised->is_non_tax) ? $taxFormRevised->purchaseHeader->supplier->name : $taxFormRevised->purchaseHeader->supplier->company;
		$taxFormRevisedHeaderText = ($taxFormRevised->is_non_tax) ? '' : 'PT. Galatech';
		
		$this->render('memo', array(
			'taxFormRevised' => $taxFormRevised,
			'taxFormRevisedSupplier' => $taxFormRevisedSupplier,
			'taxFormRevisedHeaderText' => $taxFormRevisedHeaderText,
		));
	}

	public function actionAdmin()
	{
		$taxFormRevised = new TaxFormRevisedHeader('search');
		$taxFormRevised->unsetAttributes();

		if (isset($_GET['TaxFormRevisedHeader']))
			$taxFormRevised->attributes = $_GET['TaxFormRevisedHeader'];

//                $supplierId = (isset($_GET['SupplierId'])) ? $_GET['SupplierId'] : '';

		$dataProvider = $taxFormRevised->search();
//                $dataProvider->criteria->join = "INNER JOIN tblgt_purchase_header purchaseHeader ON (t.purchase_header_id = purchaseHeader.id) AND (purchaseHeader.is_inactive = 0)";
////                $dataProvider->criteria->with = array('purchaseHeader');
//                $dataProvider->criteria->compare('purchaseHeader.supplier_id', $supplierId);

		$this->render('admin', array(
			'taxFormRevised' => $taxFormRevised,
			'dataProvider' => $dataProvider,
//                        'supplierId'=>$supplierId,
		));
	}

	public function actionReport()
	{
		$taxFormRevised = new TaxFormRevised('search');
		$taxFormRevised->unsetAttributes();
		if (isset($_GET['TaxFormRevised']))
			$taxFormRevised->attributes = $_GET['TaxFormRevised'];

		$startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : '';
		$endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : '';
		$pageSize = (isset($_GET['PageSize'])) ? $_GET['PageSize'] : '';
		$currentPage = (isset($_GET['page'])) ? $_GET['page'] : '';
		$currentSort = (isset($_GET['sort'])) ? $_GET['sort'] : '';

		$supplierId = (isset($_GET['SupplierId'])) ? $_GET['SupplierId'] : '';

		$dataProvider = $taxFormRevised->search();
		$dataProvider->criteria->compare('purchaseHeader.supplier_id', $supplierId);
		$dataProvider->criteria->join = "INNER JOIN " . PurchaseHeader::model()->tableName() . " purchaseHeader ON purchaseHeader.id = t.purchase_header_id INNER JOIN " . Supplier::model()->tableName() . " supplier ON purchaseHeader.supplier_id = supplier.id";

		$page = array('size' => $pageSize, 'current' => $currentPage);
		$date = array('attribute' => 't.date', 'start' => $startDate, 'end' => $endDate);

		$sort = new CSort(get_class($taxFormRevised));
		$sort->attributes = array('t.date', 'supplier.name');

		$dataProvider = ReportHelper::finalizeDataProvider($dataProvider, $page, $sort, $date);

		$this->render('report', array(
			'taxFormRevised' => $taxFormRevised,
			'dataProvider' => $dataProvider,
			'startDate' => $startDate,
			'endDate' => $endDate,
			'sort' => $sort,
			'currentSort' => $currentSort,
			'supplierId' => $supplierId,
		));
	}

	public function actionRemoveProductAjax($id, $index)
	{
		if (Yii::app()->request->isAjaxRequest)
		{
			$taxFormRevised = new TaxFormRevised();

			if (!empty($id))
				$taxFormRevised->copyFromDb($id);

			if (!isset($_POST['TaxFormRevisedDetail']))
				$taxFormRevised->details = array();

			$this->loadState($taxFormRevised);

			$taxFormRevised->removeProductAt($index);

			$this->renderPartial('_detail', array(
				'taxFormRevised' => $taxFormRevised,
			));
		}
	}

	public function actionPurchaseAjaxData($id)
	{
		if (Yii::app()->request->isAjaxRequest)
		{
			$taxFormRevised = new TaxFormRevised();

			if (!empty($id))
				$taxFormRevised->copyFromDb($id);

			if (!isset($_POST['TaxFormRevisedDetail']))
				$taxFormRevised->details = array();

			$this->loadState($taxFormRevised);

			$object = array(
				'purchase_header_number' => $taxFormRevised->header->purchaseHeader->number,
				'supplier_company' => $taxFormRevised->header->purchaseHeader->supplier->company,
			);

			echo CJSON::encode($object);
		}
	}

	public function actionAddItemAjax($id)
	{
		if (Yii::app()->request->isAjaxRequest)
		{
			$taxFormRevised = new TaxFormRevised();

			if (!empty($id))
				$taxFormRevised->copyFromDb($id);

			if (!isset($_POST['TaxFormRevisedDetail']))
				$taxFormRevised->details = array();

			$this->loadState($taxFormRevised);

			if (isset($_POST['TaxFormRevised']['tax_form_id']))
				$taxFormRevised->addItemByTaxform($_POST['TaxFormRevised']['tax_form_id']);

			$this->renderPartial('_detail', array(
				'taxFormRevised' => $taxFormRevised,
				'error' => false,
			));
		}
	}

	protected function loadState(&$taxFormRevised)
	{
		if (isset($_POST['TaxFormRevised']))
		{
			$taxFormRevised->header->attributes = $_POST['TaxFormRevised'];
		}
		if (isset($_POST['TaxFormRevised']))
		{
			foreach ($_POST['TaxFormRevised'] as $i => $item)
			{
				if (isset($taxFormRevised->details[$i]))
					$taxFormRevised->details[$i]->attributes = $item;
				else
				{
					$detail = new TaxFormRevisedDetail();
					$detail->attributes = $item;
					$taxFormRevised->details[] = $detail;
				}
			}
			if (count($_POST['TaxFormRevisedDetail']) < count($taxFormRevised->details))
				array_splice($taxFormRevised->details, $i + 1);
		}
	}
}
