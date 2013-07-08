<div class="row-fluid">
    <div class="span3">
        <?php
        echo $model->photoPath;
        ?>

        <div style="text-align:center; padding:10px 0">
            <?php
            if ($model->company_id == sUser::model()->getGroup()) {
                $this->widget('ext.EAjaxUpload.EAjaxUpload', array(
                    'id' => 'uploadFile',
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
            }
            ?>

            <?php echo CHtml::link('Print Profile', Yii::app()->createUrl('/m1/gSelection/printProfile', array('id' => $model->id)), array('class' => 'btn btn-mini btn-primary', 'target' => '_blank'))
            ?>
        </div>
    </div>
    <div class="span8">
        <?php
        $this->widget('bootstrap.widgets.TbDetailView', array(
            'data' => $model,
            'attributes' => array(
                'code',
                'candidate_name',
                'for_position',
                'department.name',
                'level.name',
                'address',
                'address2',
                'address3',
                'email',
                'home_phone',
                'handphone',
                'birthdate',
                'quick_background',
                'work_experience',
                'sallary_expectation',
                'source.name',
                'document_date',
                'document_remark',
            ),
        ));
        ?>
    </div>
</div>