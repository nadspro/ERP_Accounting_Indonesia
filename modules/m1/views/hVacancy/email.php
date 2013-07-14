<?php
/* @var $this GVacancyController */
/* @var $model gVacancy */

$this->breadcrumbs = array(
    'G Vacancies' => array('index'),
);

$this->menu7 = hVacancy::model()->getTopRecentVacancy();

$this->menu = array(
    array('label' => 'Vacancy', 'icon' => 'home', 'url' => array('/m1/hVacancy')),
    array('label' => 'Applicant', 'icon' => 'user', 'url' => array('/m1/hApplicant')),
    array('label' => 'Selection Registration', 'icon' => 'tint', 'url' => array('/m1/jSelection')),
    array('label' => 'Interview', 'icon' => 'volume-up', 'url' => array('/m1/hVacancy/interview')),
);
$this->menu4 = hVacancyApplicant::model()->getTopRecentInterview();
$this->menu8 = hApplicant::model()->getTopRecentApplicant();
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-paper-clip"></i>
        Email Invitation
    </h1>
</div>


<?php
$form = $this->beginWidget('TbActiveForm', array(
    'id' => 'email-form',
    //'type'=>'horizontal',
    'enableAjaxValidation' => true,
        ));
?>

<?php echo $form->textFieldRow($model, 'email', array('class' => 'span5')); ?>
<div class="control-group">
    <?php echo $form->labelEx($model, 'datetime', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php
        $this->widget(
                'ext.EJuiDateTimePicker.EJuiDateTimePicker', array(
            'model' => $model,
            'attribute' => 'datetime',
            'options' => array(
                'dateFormat' => 'dd-mm-yy',
                'timeFormat' => 'hh:mm', //'hh:mm tt' default
                'defaultValue' => (isset($model->cdate)) ? date('d-m-Y', strtotime($model->cdate)) : date('d-m-Y h:i'),
            //'minDate' => ($model->cdate !=null) ? date('d-m-Y',strtotime($model->cdate)) : date('d-m-Y',strtotime('01-'.date("m-Y"))),
            //'maxDate' => ($model->cdate !=null) ? date('d-m-Y',strtotime($model->cdate."1 day")) : 
            //		date('d-m-Y',strtotime('01-'.date("m-Y",strtotime(date("d-m-Y")."1 month"))."-1 day")),
            ),
                )
        );
        ?>
    </div>
</div>

<?php echo $form->textAreaRow($model, 'place', array('rows' => 3, 'class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'pic', array('class' => 'span3')); ?>

<div class="form-actions">
    <?php echo CHtml::htmlButton('<i class="icon-ok"></i> Send Email', array('class' => 'btn', 'type' => 'submit')); ?>
</div>

<?php
$this->endWidget();

