<?php
Yii::app()->getClientScript()->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScript('datepicker', "
		$(function() {
			$( \"#" . CHtml::activeId($model, 'begindate') . "\" ).datepicker({
			'dateFormat' : 'dd-mm-yy',
			});
			$( \"#" . CHtml::activeId($model, 'enddate') . "\" ).datepicker({
			'dateFormat' : 'dd-mm-yy',
			});
			
		});

");
?>


<?php
$this->breadcrumbs = array(
    'Selection Report',
);

$this->menu4 = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/m1/gSelection')),
);

$this->menu = array(
    array('label' => 'Report', 'icon' => 'print', 'url' => array('report')),
);
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-tasks"></i>
        Periodic Selection Reports</h1>
</div>



<?php
$form = $this->beginWidget('TbActiveForm', array(
    'id' => 'allocation-form',
    'enableAjaxValidation' => false, 'type' => 'horizontal',
        ));
?>


<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'begindate'); ?>

<?php echo $form->textFieldRow($model, 'enddate'); ?>

<?php
echo $form->dropDownListRow($model, 'report_id', array(
    '1' => '1. Detail Monthly Report',
    '2' => '2. Summary Psycho Test Report',
    '3' => '3. Summary HR Interview Report',
    '4' => '4. Summary User Interview Report',
    '5' => '5. Summary Candidate Source Report',
        //'6'=>'6. Report 6',
        ), array(
    'class' => 'span4',
));
?>

<div class="form-actions">
    <?php echo CHtml::htmlButton('<i class="icon-print"></i> Report', array('class' => 'btn', 'type' => 'submit')); ?>
</div>


<?php
$this->endWidget();
