<?php

class sPhotoNewsAdminController extends Controller {

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
            'rights', // perform access control for CRUD operations
                //'accessControl',
        );
    }

    public function actionIndex() {
        $model = new fPhoto;

        if (isset($_POST['fPhoto'])) {

            $model->attributes = $_POST['fPhoto'];

            if ($model->validate()) {

                mkdir(Yii::getPathOfAlias('webroot') . '/shareimages/photo/' . date("Ymd") . "-" . $model->title);

                $images = CUploadedFile::getInstancesByName($model->images);
                $images2 = CUploadedFile::getInstancesByName($model->images);

                if (isset($images) && count($images) > 0) {

                    foreach ($images as $image => $pic) {
                        $pic->saveAs(Yii::getPathOfAlias('webroot') . '/shareimages/photo/' . date("Ymd") . "-" . $model->title . '/' . $pic->name);
                    }

                    //Make Thumb
                    copy(Yii::getPathOfAlias('webroot') . '/shareimages/photo/' . date("Ymd") . "-" . $model->title . "/" . $pic->name, Yii::getPathOfAlias('webroot') . '/shareimages/photo/' . date("Ymd") . "-" . $model->title . ".jpg");

                    //resize
                    Yii::import('ext.iwi.Iwi');
                    $picture = new Iwi(Yii::app()->basePath . "/../shareimages/photo/" . date("Ymd") . "-" . $model->title . ".jpg");
                    $picture->resize(570, 428, Iwi::AUTO);
                    $picture->save(Yii::app()->basePath . "/../shareimages/photo/" . date("Ymd") . "-" . $model->title . ".jpg", TRUE);

                    //change permission
                    chmod(Yii::getPathOfAlias('webroot') . '/shareimages/photo/' . date("Ymd") . "-" . $model->title . ".jpg", "0777");

                    //Make XML
                    $File = Yii::getPathOfAlias('webroot') . '/shareimages/photo/' . date("Ymd") . "-" . $model->title . ".xml";
                    $Handle = fopen($File, 'w');
                    $Data = '<?xml version="1.0" encoding="ISO-8859-1"?>';
                    fwrite($Handle, $Data);
                    $Data = "<album>";
                    fwrite($Handle, $Data);
                    $Data = "<title>";
                    fwrite($Handle, $Data);
                    $Data = $model->title;
                    fwrite($Handle, $Data);
                    $Data = "</title>";
                    fwrite($Handle, $Data);
                    $Data = "<description>";
                    fwrite($Handle, $Data);
                    $Data = $model->description;
                    fwrite($Handle, $Data);
                    $Data = "</description>";
                    fwrite($Handle, $Data);
                    $Data = "<publish_date>";
                    fwrite($Handle, $Data);
                    $Data = $model->datetime;
                    fwrite($Handle, $Data);
                    $Data = "</publish_date>";
                    fwrite($Handle, $Data);
                    $Data = "</album>";
                    fwrite($Handle, $Data);
                    fclose($Handle);

                    $model = new fPhoto;
                }
            }
        }

        $this->render('index', array('model' => $model));
    }

    public function actionUpload() {
        header('Vary: Accept');
        if (isset($_SERVER['HTTP_ACCEPT']) &&
                (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {
            header('Content-type: application/json');
        } else {
            header('Content-type: text/plain');
        }

        $data = array();

        $model = new fPhoto('upload');
        $model->images = CUploadedFile::getInstance($model, 'images');
        if ($model->images !== null && $model->validate(array('images'))) {
            $model->saveAs(Yii::getPathOfAlias('webroot') . '/shareimages/photo/' . date("Ymd") . "-" . $model->title . '/' . $pic->name);
            $model->file_name = $model->images->name;
            if ($model->save()) {
                // return data to the fileuploader
                $data[] = array(
                    'name' => $model->images->name,
                    'type' => $model->images->type,
                    'size' => $model->images->size,
                        // we need to return the place where our image has been saved
                        //'url' => $model->getImageUrl(), // Should we add a helper method?
                        // we need to provide a thumbnail url to display on the list
                        // after upload. Again, the helper method now getting thumbnail.
                        //	'thumbnail_url' => $model->getImageUrl(MyModel::IMG_THUMBNAIL),
                        // we need to include the action that is going to delete the picture
                        // if we want to after loading 
                        //'delete_url' => $this->createUrl('my/delete', 
                        //	array('id' => $model->id, 'method' => 'uploader')),
                        //'delete_type' => 'POST'
                );
            } else {
                $data[] = array('error' => 'Unable to save model after saving picture');
            }
        } else {
            if ($model->hasErrors('images')) {
                $data[] = array('error', $model->getErrors('images'));
            } else {
                throw new CHttpException(500, "Could not upload file " . CHtml::errorSummary($model));
            }
        }
        echo json_encode($data);
    }

}
