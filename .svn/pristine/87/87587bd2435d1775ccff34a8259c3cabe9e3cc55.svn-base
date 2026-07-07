<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo" style="display: inline-block"><?php echo CHtml::encode(Yii::app()->name); ?></div>
		<?php if (!Yii::app()->user->isGuest): ?>
			<div style="width: 70%; display: inline-block; text-align: right; font-weight: bold; text-transform: uppercase">
				<span style="color: #009900">Server: </span>
				<span style="text-decoration: underline; color: #00CC00"><?php echo (isset(Yii::app()->user->serverConnection) && (int)Yii::app()->user->serverConnection === 2) ? 'Secondary' : 'Primary'; ?></span>
			</div>
		<?php endif; ?>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label' => 'Dashboard', 'url' => array('/site/dashboard'), 'visible' => !Yii::app()->user->isGuest),
				array('label'=>'Master', 'url'=>array('/site/page', 'view'=>'master'), 'visible'=>Yii::app()->user->checkAccess('master')),
				array('label'=>'User Account', 'url'=>array('/admin/admin/admin'), 'visible'=>Yii::app()->user->checkAccess('administrator')),
				array('label'=>'Transaksi', 'url'=>array('/site/page', 'view'=>'transaction'), 'visible'=> TaxConnectionChecking::transactionValid()),
				array('label'=>'Keuangan', 'url'=>array('/site/page', 'view'=>'accounting'), 'visible'=>TaxConnectionChecking::accountingValid()),
				array('label'=>'Gudang', 'url'=>array('/site/page', 'view'=>'warehouse'), 'visible'=>TaxConnectionChecking::deliveryValid() || TaxConnectionChecking::transferValid()),
				array('label'=>'Laporan', 'url'=>array('/site/page', 'view'=>'report') , 'visible'=>TaxConnectionChecking::reportValid()),
				array('label'=>'Revisi', 'url'=>array('/site/page', 'view'=>'edit'), 'visible'=>TaxConnectionChecking::revisionValid()),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest, 'itemOptions'=>array('style'=>'float: right'))
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by PT. Galatech Jaya Abadi<br/>
		All Rights Reserved.<br/>
		Powered by <?php echo CHtml::link('BloomingTech', 'http://www.bloomingtech.com'); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>