<?php

class GPersonHoldingController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /*
      public function filters()
      {
      return array(
      'accessControl', // perform access control for CRUD operations
      'ajaxOnly + PersonAutoComplete',
      array(
      'COutputCache +index',
      // will expire in a year
      'duration'=>24*3600*365,
      'dependency'=>array(
      'class'=>'CChainedCacheDependency',
      'dependencies'=>array(
      new CGlobalStateCacheDependency('gperson'),
      new CDbCacheDependency('SELECT id FROM g_person
      ORDER BY id DESC LIMIT 1'),
      ),
      ),
      ),
      );
      }
     */

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'rights',
            'ajaxOnly + PersonAutoComplete',
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $model = $this->loadModel($id);

        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new gPerson('search');
        $model->unsetAttributes();

        $criteria = new CDbCriteria;
        $criteria1 = new CDbCriteria;

        //if (Yii::app()->user->name != "admin") {
        //	$criteria->with=array('company');
        //	$criteria->addInCondition('company.company_id',sUser::model()->getGroupArray());
        //}

        if (isset($_GET['gPerson'])) {
            $model->attributes = $_GET['gPerson'];

            $criteria1->compare('employee_name', $_GET['gPerson']['employee_name'], true, 'OR');
            //$criteria1->compare('address1',$_GET['gPerson']['address1'],true,'OR');
        }

        $criteria->order = 'updated_date DESC';

        $criteria->mergeWith($criteria1);

        $dataProvider = new CActiveDataProvider('gPerson', array(
            'criteria' => $criteria,
                )
        );

        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'model' => $model,
        ));
    }

    public function actionReport() {
        $this->render('report');
    }

    public function actionReport1() { //assignment List
        $pdf = new assignmentList('L', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $pdf->report();

        $pdf->Output();
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $criteria = new CDbCriteria;

        //if (Yii::app()->user->name != "admin") {
        //	$criteria->with=array('company');
        //	$criteria->addInCondition('company.company_id',sUser::model()->getGroupArray());
        //
		//}

        $model = gPerson::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'g-person-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionPrintProfile($id) {
        $pdf = new profile('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        //$model=gPerson::model()->findByPk((int)$id);
        $pdf->report($id);

        $pdf->Output();
    }

    public function actionPersonAutoComplete() {
        $res = array();
        if (isset($_GET['term'])) {
            if (Yii::app()->user->name != "admin") {
                $qtxt = 'SELECT DISTINCT a.employee_name FROM g_person a
			WHERE a.employee_name LIKE :name AND ' .
                        '((select c.company_id from g_person_career c WHERE a.id=c.parent_id AND c.status_id IN (' .
                        implode(",", Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
                        ') ORDER BY c.start_date DESC LIMIT 1) IN (' .
                        implode(",", sUser::model()->getGroupArray()) . ') OR ' .
                        '(select c2.company_id from g_person_career2 c2 WHERE a.id=c2.parent_id AND c2.company_id IN (' .
                        implode(",", sUser::model()->getGroupArray()) . ') ORDER BY c2.start_date DESC LIMIT 1) IN (' .
                        implode(",", sUser::model()->getGroupArray()) . ')) ' .
                        'ORDER BY a.employee_name LIMIT 20';
            } else {
                $qtxt = "SELECT DISTINCT a.employee_name FROM g_person a
			WHERE a.employee_name LIKE :name
			ORDER BY a.employee_name LIMIT 20";
            }
            $command = Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":name", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            $res = $command->queryColumn();
            //$res =$command->queryAll();
        }
        echo CJSON::encode($res);
    }


}
