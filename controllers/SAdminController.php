<?php

class SAdminController extends Controller {

    public $layout = '//layouts/column1';

    public function actions() {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
        );
    }

    public function filters() {
        return array(
            'rights',
        );
    }

    public function actionReadExcel() {
        $this->render('readExcel', array(
        ));
    }

    public function actionSqlStatement() {
        $model = new fSqlStatement;

        if (isset($_POST['fSqlStatement'])) {
            $model->attributes = $_POST['fSqlStatement'];
            if ($model->validate()) {
                $commandD = Yii::app()->db->createCommand($model->sql);
                $commandD->execute();

                Yii::app()->user->setFlash('success', 'SQL statement has been executed');
                $this->refresh();
            }
        }
        $this->render('sqlstatement', array('model' => $model));
    }

    public function actionBackup() {

        Yii::import('SDatabaseDumper');
        $dumper = new SDatabaseDumper;

        // Get path to new backup file
        $file = Yii::getPathOfAlias('webroot.protected.backups') . '/dump.' . Yii::app()->dateFormatter->format("yyyyMMdd", time()) . '.sql';

        // Gzip dump
        if (function_exists('gzencode'))
            file_put_contents($file . '.gz', gzencode($dumper->getDump()));
        else
            file_put_contents($file, $dumper->getDump());

        Yii::app()->user->setFlash('success', '<strong>Great!</strong> backup process finished..');
        $this->redirect(array('/menu'));
    }

    public function actionCall1() {

        try {
            $api = new PhpSIP('202.153.128.34'); // IP we will bind to
            $api->setMethod('MESSAGE');
            $api->setFrom('sip:peterjkambey@voiprakyat.or.id');
            $api->setUri('sip:sicc1@voiprakyat.or.id');
            $api->setBody('Hi, ....');
            $res = $api->send();
            echo "res1: $res\n";
        } catch (Exception $e) {

            echo $e->getMessage() . "\n";
        }
    }

    public function actionCall2() {
        try {
            $api = new PhpSIP(); // IP we will bind to
            $api->setUsername('118338'); // authentication username
            $api->setPassword('55XI8N'); // authentication password
            $api->setProxy('202.153.128.34');
            $api->addHeader('Event: resync');
            $api->setMethod('NOTIFY');
            $api->setFrom('sip:118338@voiprakyat.or.id');
            $api->setUri('sip:118339@voiprakyat.or.id');
            $res = $api->send();
            echo "res1: $res\n";
        } catch (Exception $e) {

            echo $e->getMessage() . "\n";
        }
    }

    public function actionChatFB() {

        $obj = new FacebookChat("peterjkambey@yahoo.co.id", ".....");
        $obj->login();
        print_r($obj->buddylist());
        $obj->sendmsg("Hey jhonny, how are u?", "my_friend_id");
    }

    public function actionGraph1() {
        /* $bars = array(41,52,53,12,85,61,53,8,79,10,92,36);
          $graph = new Chart();
          $graph->addBars($bars, 'ff0000');
          $graph->output();
          $graph->output('filename.png'); */

        $bars = array(5, 5, 5, 1, 8, 6, 5, 8, 7, 1, 2, 3);
        $dates = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
        $graph = new Chart();
        $graph->addBars($bars, 'ff0000');
        $graph->addXLabels($dates, '000000');
        $graph->addYScale('000000');
        $graph->output();
    }

    public function actionGraph2() {
        /* Create and populate the pData object */
        $MyData = new pData();
        $MyData->addPoints(array(13251, 4118, 3087, 1460, 1248, 156, 26, 9, 8), "Hits");
        $MyData->setAxisName(0, "Hits");
        $MyData->addPoints(array("Firefox", "Chrome", "Internet Explorer", "Opera", "Safari", "Mozilla", "SeaMonkey", "Camino", "Lunascape"), "Browsers");
        $MyData->setSerieDescription("Browsers", "Browsers");
        $MyData->setAbscissa("Browsers");

        /* Create the pChart object */
        $myPicture = new pImage(500, 500, $MyData);
        $myPicture->drawGradientArea(0, 0, 500, 500, DIRECTION_VERTICAL, array("StartR" => 240, "StartG" => 240, "StartB" => 240, "EndR" => 180, "EndG" => 180, "EndB" => 180, "Alpha" => 100));
        $myPicture->drawGradientArea(0, 0, 500, 500, DIRECTION_HORIZONTAL, array("StartR" => 240, "StartG" => 240, "StartB" => 240, "EndR" => 180, "EndG" => 180, "EndB" => 180, "Alpha" => 20));
        $myPicture->setFontProperties(array("FontName" => "../fonts/pf_arma_five.ttf", "FontSize" => 6));

        /* Draw the chart scale */
        $myPicture->setGraphArea(100, 30, 480, 480);
        $myPicture->drawScale(array("CycleBackground" => TRUE, "DrawSubTicks" => TRUE, "GridR" => 0, "GridG" => 0, "GridB" => 0, "GridAlpha" => 10, "Pos" => SCALE_POS_TOPBOTTOM)); //

        /* Turn on shadow computing */
        $myPicture->setShadow(TRUE, array("X" => 1, "Y" => 1, "R" => 0, "G" => 0, "B" => 0, "Alpha" => 10));

        /* Draw the chart */
        $myPicture->drawBarChart(array("DisplayPos" => LABEL_POS_INSIDE, "DisplayValues" => TRUE, "Rounded" => TRUE, "Surrounding" => 30));

        /* Write the legend */
        $myPicture->drawLegend(570, 215, array("Style" => LEGEND_NOBORDER, "Mode" => LEGEND_HORIZONTAL));

        /* Render the picture (choose the best way) */
        $myPicture->autoOutput("pictures/example.drawBarChart.vertical.png");
    }

    public function actionBarcode() {
        $this->render('barcode');
    }

    public function actionHelp() {   //OK BANGET tapi sayangnya masih Port 25
        $model = new fEmail('help');

        if (isset($_POST['fEmail'])) {
            $model->attributes = $_POST['fEmail'];
            if ($model->validate()) {

                EmailComponent::sendEmail('peterjkambey@gmail.com', $model->subject, $model->body, 'non-ssl');

                Yii::app()->user->setFlash('success', '<strong>Great!</strong> Your Message has been sent...');
                $this->redirect(array('/menu'));
            }
        }
        $this->render('help', array('model' => $model));
    }

    public function actionTableFpdf() {
        $pdf = new mc_table();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 14);
        //Table with 20 rows and 4 columns
        $pdf->SetWidths(array(30, 50, 30, 40));
        srand(microtime() * 1000000);
        for ($i = 0; $i < 20; $i++)
            $pdf->Row(array($this->GenerateSentence(), $this->GenerateSentence(), $this->GenerateSentence(), $this->GenerateSentence()));
        $pdf->Output();
    }

    private function GenerateWord() {
        //Get a random word
        $nb = rand(3, 10);
        $w = '';
        for ($i = 1; $i <= $nb; $i++)
            $w.=chr(rand(ord('a'), ord('z')));
        return $w;
    }

    private function GenerateSentence() {
        //Get a random sentence
        $nb = rand(1, 10);
        $s = '';
        for ($i = 1; $i <= $nb; $i++)
            $s.=$this->GenerateWord() . ' ';
        return substr($s, 0, -1);
    }

    public function actionCode39() {
        $pdf = new PDF_Code39();
        $pdf->AddPage();
        $pdf->Code39(80, 40, 'PETERKAMBEY', 1, 10);
        $pdf->Output();
    }

    public function actionContact() {
        //$model=new ContactForm;
        //if(isset($_POST['ContactForm']))
        //{
        //	$model->attributes=$_POST['ContactForm'];
        //	if($model->validate())
        //	{
        $headers = "From: Peter J. Kambey\r\nReply-To: peterjkambey@gmail.com";
        mail(Yii::app()->params['adminEmail'], 'Testing Subject', 'Testing Body', $headers);
        Yii::app()->user->setFlash('success', '<strong>Great!</strong> Your Message has been sent...');
        $this->redirect(array('/menu'));
        //	}
        //}
        //$this->render('contact',array('model'=>$model));
    }

    public function actionFlush() {
        Yii::app()->cache->flush();
        $this->redirect(array('/menu'));
    }

    public function actionFormWithFile() {
        $form = new fPhoto();
        if (Yii::app()->request->getParam('title')) {
            $form->attributes = Yii::app()->request->getParam('title');
            $form->fileField = UploadedFile::getInstanceByName("fPhoto[title]");
            if ($form->validate()) {
                $form->fileField->saveAs(dirname(__FILE__) . '/../files/tmp.txt');
            }
        }
    }
    

    private $_indexFiles = 'runtime.search';

    public function actionSearchIndex() {
        $this->layout = 'column2';
        if (($term = Yii::app()->getRequest()->getParam('q', null)) !== null) {
            $index = new Zend_Search_Lucene(Yii::getPathOfAlias('application.' . $this->_indexFiles));
            $results = $index->find($term);
            $query = Zend_Search_Lucene_Search_QueryParser::parse($term);

            $this->render('/sParameter/search', compact('results', 'term', 'query'));
        }
    }
    /**
     * Search index creation
     */
    public function actionSearchCreate() {
        $index = new Zend_Search_Lucene(Yii::getPathOfAlias('application.' . $this->_indexFiles), true);

        $posts = tAccount::model()->findAll();
        foreach ($posts as $post) {
            $doc = new Zend_Search_Lucene_Document();

            $doc->addField(Zend_Search_Lucene_Field::Text('account_no', CHtml::encode($post->account_no), 'utf-8')
            );

            $doc->addField(Zend_Search_Lucene_Field::Text('short_description', CHtml::encode($post->short_description)
                            , 'utf-8')
            );

            $doc->addField(Zend_Search_Lucene_Field::Text('account_name', CHtml::encode($post->account_name)
                            , 'utf-8')
            );


            $index->addDocument($doc);
        }
        $index->commit();
        echo 'Lucene index created';
    }

	public function actionLogging() {

			$this->render('logging');
	
	}    

}
