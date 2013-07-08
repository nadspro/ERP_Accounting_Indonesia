<?php
$this->renderPartial('_menuEss', array('model' => $model));
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-user"></i>
        <?php echo $model->employee_name; ?>
    </h1>
</div>

<div class="row">
    <div class="span2">
        <?php
        echo $model->photoPath;
        ?>
    </div>
    <div class="span7">
        <?php echo $this->renderPartial('/gPerson/_personalInfo', array('model' => $model)); ?>
    </div>
</div>

<div class="row">
    <div class="span9">
        <?php
        $carC = ($model->many_careerC != 0) ? " (" . $model->many_careerC . ")" : "";
        $staC = ($model->many_statusC != 0) ? " (" . $model->many_statusC . ")" : "";
        $expC = ($model->many_experienceC != 0) ? " (" . $model->many_experienceC . ")" : "";
        $eduC = ($model->many_educationC != 0) ? " (" . $model->many_educationC . ")" : "";
        $famC = ($model->many_familyC != 0) ? " (" . $model->many_familyC . ")" : "";
        $othC = ($model->many_otherC != 0) ? " (" . $model->many_otherC . ")" : "";
        $edunfC = ($model->many_educationnfC != 0) ? " (" . $model->many_educationnfC . ")" : "";
        $traC = ($model->many_trainingC != 0) ? " (" . $model->many_trainingC . ")" : "";

        $this->widget('bootstrap.widgets.TbTabs', array(
            'type' => 'tabs', // 'tabs' or 'pills'
            'tabs' => array(
                array('label' => 'Detail', 'content' => $this->renderPartial("/gPerson/_tabDetail", array("model" => $model), true), 'active' => true),
                array('label' => 'Career - Experience - Status', 'content' => $this->renderPartial("/gPersonHolding/_mainCareerExperienceStatus", array("model" => $model), true)),
                //array('label'=>'Internal Career'.$carC,'content'=>$this->renderPartial("/gPerson/_tabCareer", array("model"=>$model), true)),
                //array('label'=>'Experience'.$expC,'content'=>$this->renderPartial("/gPerson/_tabExperience", array("model"=>$model), true)),
                //array('label'=>'Status'.$staC,'content'=>$this->renderPartial("/gPerson/_tabStatus", array("model"=>$model), true)),
                array('label' => 'Education', 'content' => $this->renderPartial("/gPersonHolding/_mainEducation", array("model" => $model), true)),
                //array('label'=>'Education'.$eduC,'content'=>$this->renderPartial("/gPerson/_tabEducation", array("model"=>$model), true)),
                //array('label'=>'Non Formal Education'.$edunfC,'content'=>$this->renderPartial("/gPerson/_tabEducationNf", array("model"=>$model), true)),
                array('label' => 'Training' . $traC, 'content' => $this->renderPartial("/gPersonHolding/_mainTraining", array("model" => $model), true)),
                array('label' => 'Family' . $famC, 'content' => $this->renderPartial("/gPerson/_tabFamily", array("model" => $model), true)),
                array('label' => 'Other' . $othC, 'content' => $this->renderPartial("/gPerson/_tabOther", array("model" => $model, "modelOther" => $modelOther), true)),
            ),
        ));
        ?>

    </div>
</div>
