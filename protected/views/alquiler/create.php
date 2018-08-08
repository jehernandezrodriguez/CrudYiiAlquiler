<?php
/* @var $this AlquilerController */
/* @var $model Alquiler */

$this->breadcrumbs=array(
	'Alquilers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Alquiler', 'url'=>array('index')),
	array('label'=>'Manage Alquiler', 'url'=>array('admin')),
);
?>
<h1>Menu vendedor</h1>

<div class="container no-padding">
	<div class="col-lg-12 list-jure">
    	<div id="nav2">
           	<ul>
               	<li>
					<?php echo CHtml::link('Clientes ',array('cliente/admin'),array('class'=>''))?>
                </li>
                <li>
					<?php echo CHtml::link('Clientes Referidos ',array('cliente/adminrec'),array('class'=>''))?>
                </li>
               
              <li>
                   	<?php echo CHtml::link('Alquiler',array('alquiler/admin'),array('class'=>''))?>
                </li>
               
                
           	</ul>
    	</div >
	</div > 
	</div> 
<h1>Crear Alquiler</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>