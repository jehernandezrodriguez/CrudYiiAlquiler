<?php
/* @var $this VendedorController */
/* @var $model Vendedor */

$this->breadcrumbs=array(
	'Vendedors'=>array('index'),
	$model->cedula_Vendedor=>array('view','id'=>$model->cedula_Vendedor),
	'Update',
);

$this->menu=array(
	array('label'=>'List Vendedor', 'url'=>array('index')),
	array('label'=>'Create Vendedor', 'url'=>array('create')),
	array('label'=>'View Vendedor', 'url'=>array('view', 'id'=>$model->cedula_Vendedor)),
	array('label'=>'Manage Vendedor', 'url'=>array('admin')),
);
?>

<h1>Update Vendedor <?php echo $model->cedula_Vendedor; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>