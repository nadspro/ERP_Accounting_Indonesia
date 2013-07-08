<?php

class GBiPersonController extends Controller {

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
        );
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new fBusinessIntellegence;

        if (isset($_POST['field'])) {
            $model->field = $_POST['field'];
            $model->group = $_POST['group'];
            $model->fieldfilter = $_POST['fieldfilter'];
            $model->expression = $_POST['expression'];
            $model->value = $_POST['value'];
            $model->limit = $_POST['fBusinessIntellegence']['limit'];

            Yii::import('application.components.sql_generator');
            $sql1 = new sql_generator();

            //SELECT*************************************
            //OPTIONAL
            //$sql->select('tab1.column1,tab1.column2,tab1.column3,column4,tab2.*');
            //WHERE**************************************
            //$sql->where('column1','val1');
            //$sql->where('column2','val2');
            //$sql->where('column3','val3','OR');
            //OR
            //$sql->where(array('column1' => 'val1', 'column2' => 'val2'),NULL,'AND');
            //LIKE***************************************
            //$sql->like('column3','val3','both'/* before, after, both (default) OR none */,'AND');
            //RESULT WHERE ... AND column3 LIKE '%val3%'
            //$sql->like('column2','val3','before','OR');
            //RESULT ... OR column2 LIKE '%val3'
            //JOIN***************************************
            //$sql->join('tab2','tab1.id = tab2.id');
            //OR
            //$sql->join('tab3','tab2.id = tab3.id','inner'); //OPTIONS left, right, outer, inner, left outer, and right outer
            //ORDER**************************************
            //$sql->order_by('calumn1','asc'); //asc or desc
            //OR
            //$sql->order_by('calumn2 asc'); //asc or desc
            //FOR ADD MORE REPEAT THIS FUNCTION
            //LIMIT**************************************
            //$limite = 10;
            //$inicio = 5;
            //$sql->limit($limite);
            //GENERATES: LIMIT 10
            //OR
            //$sql->limit($limite,$inicio);
            //GENERATES: LIMIT 5,10
            //GENERATE SQL SELECT************************
            //echo $sql1->get('g_bi_person');
            //SELECT
            foreach ($_POST['field'] as $key => $mgroup) {
                if ($_POST['group'][$key] == null || $_POST['group'][$key] == 'GROUP BY') {
                    $fieldarray[] = $_POST['field'][$key];
                } else {
                    $matharray[] = $_POST['group'][$key] . "(" . $_POST['field'][$key] . ") as " . $_POST['field'][$key];
                }
            }

            $field = implode(",", $fieldarray);
            $group = " GROUP BY " . implode(",", $fieldarray);
            $sql1->select($field);

            //FILTER
            if ($_POST['value'][0] != null) {
                foreach ($_POST['value'] as $key => $mfilter) {
                    $sql1->where($_POST['fieldfilter'][$key], $_POST['value'][$key]);
                }

                $filter = implode(" AND ", $filterserial);

                if (!$_POST['fBusinessIntellegence']['plusResign'])
                    $filter = $filter . ' AND employee_status NOT IN ("Resign","Termination","End Of Contract","Unpaid Leave","Black List") ';
                $sql1->where($_POST['fieldfilter'][$key], $_POST['value'][$key]);
            }


            $sql1->limit($_POST['fBusinessIntellegence']['limit']);

            try {
                $rawData = Yii::app()->db->createCommand($sql1->get('g_bi_person'))->queryAll();
            } catch (Exception $e) {
                throw new CHttpException(404, 'Error Code: 1064. You have an error in your SQL syntax. Press Backspace to return...');
            }

            $dataProvider = new CArrayDataProvider($rawData, array(
                'id' => 'bi_person',
                'pagination' => false,
            ));

            //'columns'=>array(
            //	'start_date',
            //	array(
            //			'header'=>'Status',
            //			'value'=>'isset($data->status->name) ? $data->status->name : ""',
            //	),

            $labels = gBiPerson::model()->attributeLabels();
            foreach ($_POST['field'] as $key => $mgroup) {
                $fieldres['header'] = $labels[$mgroup];
                $fieldres['value'] = '$data["' . $mgroup . '"]';
                $fieldresult[] = $fieldres;
            }

            if ($_POST['fBusinessIntellegence']['export']) {
                $production = 'export';
            } else {
                $production = 'grid';
            }

            $this->render('index', array(
                'model' => $model,
                'dataProvider' => $dataProvider,
                'field' => $fieldresult,
                'production' => $production,
            ));

            Yii::app()->end();
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

}
