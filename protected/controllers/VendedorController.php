<?php

class VendedorController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model_telefono = new VendedorTelefonos ;

		$model=$this->loadModel($id);

		$model_telefono->cedula_Vendedor=$model->cedula_Vendedor;

		if(isset($_POST['VendedorTelefonos']))
		{
			$model_telefono->attributes=$_POST['VendedorTelefonos'];
			if($model_telefono->save())
				$this->redirect(array('view','id'=>$model->cedula_Vendedor));
		}
 	
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'model_telefono'=>$model_telefono,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Vendedor;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Vendedor']))
		{
			$model->attributes=$_POST['Vendedor'];

			$nombre_usuario=str_replace ( "." , "", $model->cedula_Vendedor);
			
			$values = array(
				'username' => $nombre_usuario,
				'email' => $model->email,
				'password' => $model->clave,
             );

			 $keyses=md5($nombre_usuario);
	         $usuario = Yii::app()->user->um->createNewUser($values);
		     $model->id_user = $usuario->iduser;


			if($model->save())
			{
				//print_r( $usuario );
						 Yii::app()->user->um->changePassword($usuario,$model->clave);
						 Yii::app()->user->um->save($usuario);
						 
				$this->redirect(array('view','id'=>$model->cedula_Vendedor));
			}
		}
        
         

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Vendedor']))
		{
			$model->attributes=$_POST['Vendedor'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->cedula_Vendedor));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Vendedor');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Vendedor('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Vendedor']))
			$model->attributes=$_GET['Vendedor'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Vendedor the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Vendedor::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Vendedor $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='vendedor-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
