<div style="text-align:center; padding:10px 0">
    <?php
    $this->widget('ext.EAjaxUpload.EAjaxUpload', array(
        'id' => 'uploadFile2',
        'config' => array(
            'action' => Yii::app()->createUrl('/m1/gSelection/upload', array('id' => $model->id)),
            'allowedExtensions' => array("jpg"), //array("jpg","jpeg","gif","exe","mov" and etc...
            'sizeLimit' => 500 * 1024, // maximum file size in bytes
            //'minSizeLimit'=>1*1024*1024,// minimum file size in bytes
            'onComplete' => "js:function(id, fileName, responseJSON){ location.reload(true); }",
            'messages' => array(
                'typeError' => "{file} has invalid extension. Only {extensions} are allowed.",
                'sizeError' => "{file} is too large, maximum file size is {sizeLimit}.",
                'minSizeError' => "{file} is too small, minimum file size is {minSizeLimit}.",
                'emptyError' => "{file} is empty, please select files again without it.",
                'onLeave' => "The files are being uploaded, if you leave now the upload will be cancelled."
            ),
        //'showMessage'=>"js:function(message){ alert(message); }"
        ),
    ));
    ?>
</div>

<hr/>
<?php
if (!is_dir(Yii::getPathOfAlias('webroot.sharedocs.recruitmentdocuments') . '/' . $model->id))
    mkdir(Yii::getPathOfAlias('webroot.sharedocs.recruitmentdocuments') . '/' . $model->id);

if ($handle = opendir(Yii::getPathOfAlias('webroot.sharedocs.recruitmentdocuments') . '/' . $model->id)) {

    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            echo CHtml::link($entry, Yii::app()->baseUrl . "/sharedocs/recruitmentdocuments/" . $model->id . "/" . $entry, array("target" => "_blank"));
            echo "<br/>";
        }
    }

    closedir($handle);
}
