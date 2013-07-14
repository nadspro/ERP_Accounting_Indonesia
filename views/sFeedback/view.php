<?php
$this->breadcrumbs = array(
    'Feedback' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/sFeedback')),
    array('label' => 'Update', 'icon' => 'edit', 'url' => array('update', 'id' => $model->id), 'visible' => ($model->sender_id == Yii::app()->user->id)),
);

$this->menu1 = sFeedback::getTopUpdated();
$this->menu2 = sFeedback::getTopCreated();
?>

<div class="page-header">
    <h1>
        <i class="iconic-comment"></i>
        <?php echo $model->sender_ref ?>
    </h1>
</div>

<?php if (Yii::app()->user->name == "admin") { ?>
    <div class="pull-right">
        <?php
        $form = $this->beginWidget('TbActiveForm', array(
            'action' => Yii::app()->createUrl('sFeedback/view', array("id" => $model->id)),
            'method' => 'post',
            'type' => 'inline',
        ));
        ?>

        <?php echo $form->dropDownList($model, 'status_id', sParameter::items('cRead')); ?>

        <?php echo CHtml::htmlButton('<i class="icon-ok"></i> Process', array('class' => 'btn', 'type' => 'submit')); ?>

        <?php $this->endWidget(); ?>
    </div>
<?php } ?>

<div class="row">
    <div class="span9">
        <div class="well">
            <h6 class="pull-right">
                <?php echo $model->nicetime($model->sender_date); ?>
            </h6>
            <h5><span class="icon fam-note"></span>
                <?php echo sUser::model()->findName($model->sender_id) . ' to ' . sUser::model()->findName($model->receiver_id) ?>
                |
                <?php echo sParameter::item("cCategory", $model->category_id) ?>
            </h5>
            <?php echo $model->long_desc; ?>
        </div>
        <?php
        $comment = sFeedbackDetail::model()->findAll(array('condition' => 'parent_id = ' . $model->id));
        if (isset($comment)) {
            $this->renderPartial('/sFeedback/_comments', array(
                'comments' => $comment,
            ));
        }
        ?>

        <?php
        $this->renderPartial('_commentform', array(
            'model' => $comments,
        ));
        ?>

    </div>

</div>



