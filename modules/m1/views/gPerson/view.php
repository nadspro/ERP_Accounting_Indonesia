<?php if (CHttpRequest::getParam("tab") != null): ?>

    <script>

        $(document).ready(function() {
            $('#tabs a:contains("<?php echo CHttpRequest::getParam("tab"); ?>")').tab('show');
        });

    </script>

<?php endif; ?>
</php>

<?php
$this->breadcrumbs = array(
    'G people' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m1/gPerson')),
    array('label' => 'Update', 'icon' => 'edit', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Print Profile', 'icon' => 'print', 'url' => array('printProfile', 'id' => $model->id)),
    array('label' => 'Delete', 'icon' => 'remove', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
);


$this->menu1 = gPerson::getTopUpdated();
$this->menu2 = gPerson::getTopCreated();
$this->menu3 = gPerson::getTopRelated($model->employee_name);
$this->menu5 = array('Person');

$this->menu9 = array('model' => $model, 'action' => Yii::app()->createUrl('m1/gPerson/index'), 'field_name' => 'employee_name');
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-user"></i>
        <?php echo $model->employee_name_r; ?>
    </h1>
</div>

<div class="row">
    <div class="span2">
        <?php
        echo $model->photoPath;
        ?>

        <div style="text-align:center; padding:10px 0">
            <?php
            $this->widget('ext.EAjaxUpload.EAjaxUpload', array(
                'id' => 'uploadFile',
                'config' => array(
                    'action' => Yii::app()->createUrl('/m1/gPerson/upload', array('id' => $model->id)),
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

            <?php
            //echo CHtml::link('Print Profile',Yii::app()->createUrl('/m1/gPerson/printProfile',array('id'=>$model->id)),
            //array('class'=>'btn btn-mini btn-primary','target'=>'_blank')) 
            ?>
        </div>
    </div>

    <div class="span7">
        <?php echo $this->renderPartial('/gPerson/_personalInfo', array('model' => $model)); ?>
    </div>
</div>

<div class="row">
    <div class="span9">
        <?php
        $carC = ($model->many_careerC != 0) ? CHtml::tag("span", array('class' => 'badge badge-info'), $model->many_careerC) : "";
        $staC = ($model->many_statusC != 0) ? CHtml::tag("span", array('class' => 'badge badge-info'), $model->many_statusC) : "";
        $expC = ($model->many_experienceC != 0) ? CHtml::tag("span", array('class' => 'badge badge-info'), $model->many_experienceC) : "";
        $eduC = ($model->many_educationC != 0) ? CHtml::tag("span", array('class' => 'badge badge-info'), $model->many_educationC) : "";
        $famC = ($model->many_familyC != 0) ? CHtml::tag("span", array('class' => 'badge badge-info'), $model->many_familyC) : "";
        $othC = ($model->many_otherC != 0) ? CHtml::tag("span", array('class' => 'badge badge-info'), $model->many_otherC) : "";
        $edunfC = ($model->many_educationnfC != 0) ? CHtml::tag("span", array('class' => 'badge badge-info'), $model->many_educationnfC) : "";
        $traC = ($model->many_trainingC != 0) ? CHtml::tag("span", array('class' => 'badge badge-info'), $model->many_trainingC) : "";

        $this->widget('bootstrap.widgets.TbTabs', array(
            'type' => 'tabs', // 'tabs' or 'pills'
            'id' => 'tabs',
            'encodeLabel' => false,
            'tabs' => array(
                array('id' => 'tab1', 'label' => 'Detail', 'content' => $this->renderPartial("_tabDetail", array("model" => $model), true), 'active' => true),
                array('id' => 'tab2', 'label' => 'Internal Career ' . $carC, 'content' => $this->renderPartial("_mainCareer", array("model" => $model, "modelCareer" => $modelCareer), true)),
                array('id' => 'tab3', 'label' => 'Status ' . $staC, 'content' => $this->renderPartial("_mainStatus", array("model" => $model, "modelStatus" => $modelStatus), true)),
                array('id' => 'tab4', 'label' => 'Experience ' . $expC, 'content' => $this->renderPartial("_mainExperience", array("model" => $model, "modelExperience" => $modelExperience), true)),
                array('id' => 'tab5', 'label' => 'Education ' . $eduC, 'content' => $this->renderPartial("_mainEducation", array("model" => $model, "modelEducation" => $modelEducation), true)),
                array('id' => 'tab8', 'label' => 'Training ' . $traC, 'content' => $this->renderPartial("_mainTraining", array("model" => $model, "modelTraining" => $modelTraining), true)),
                array('id' => 'tab9', 'label' => 'Family ' . $famC, 'content' => $this->renderPartial("_mainFamily", array("model" => $model, "modelFamily" => $modelFamily), true)),
                array('id' => 'tab7', 'label' => 'More...', 'items' => array(
                        array('id' => 'tab10', 'label' => 'Non Formal Edu ' . $edunfC, 'content' => $this->renderPartial("_mainEducationNf", array("model" => $model, "modelEducationNf" => $modelEducationNf), true)),
                        array('id' => 'tab11', 'label' => 'Other Info ' . $othC, 'content' => $this->renderPartial("_mainOther", array("model" => $model, "modelOther" => $modelOther), true)),
                        //array('id'=>'tab6','label'=>'Cost Center','content'=>$this->renderPartial("_mainCostcenter", array("model"=>$model,"modelCostcenter"=>$modelCostcenter), true)),
                        array('id' => 'tab12', 'label' => 'Assignment', 'content' => $this->renderPartial("_tabCareer2", array("model" => $model, "modelCareer2" => $modelCareer2), true)),
                        array('id' => 'tab13', 'label' => 'SSO', 'content' => $this->renderPartial("_tabSso", array("model" => $model), true)),
                    )),
            ),
        ));
        ?>
    </div>
</div>

<div class="row">
    <div class="span4">
        <?php $this->renderPartial('_subOrdinate', array('model' => $model)); ?>
    </div>
    <div class="span4">
        <?php $this->renderPartial('_sameDepartment', array('model' => $model)); ?>
    </div>
    <div class="span3">
        <?php //$this->renderPartial('_sameLevel',array('model'=>$model));   ?>
    </div>
</div>
