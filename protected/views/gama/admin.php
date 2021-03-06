<?php
/* @var $this GamaController */
/* @var $model Gama */

$this->breadcrumbs=array(
	'Gamas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Gama', 'url'=>array('index')),
	array('label'=>'Create Gama', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#gama-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrador de  Gamas</h1>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gama-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_gama',
		'nombre_gama',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<div class="btnAddTrabajo">
<?php

 echo CHtml::link('Nuevo ', array('/gama/create'),array('class'=>'register-btn','style'=>'background: #FFF;
    color: #62AD00;'));

?>

</div>