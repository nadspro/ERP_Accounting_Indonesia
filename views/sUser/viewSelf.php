<?php
$this->breadcrumbs = array(
    $model->username,
);
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-user"></i>
        <?php echo CHtml::encode($model->username); ?>
    </h1>
</div>

<?php
$this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'items' => array(
        array('label' => 'Update Password', 'url' => Yii::app()->createUrl('/sUser/updatePasswordAuthenticated', array("id" => $model->id))),
    ),
));
?>

<?php echo $this->renderPartial('_userDetail', array('model' => $model)); ?>

<ul class="nav nav-list">
    <li class="nav-header"><span class="h-icon-folder_database">Personal Folder</span>
    </li>
</ul>
<?php
// ElFinder widget
$this->widget('ext.elFinder.ElFinderWidget', array(
    'connectorRoute' => 'sCompanyDocuments/connectorPersonalDocuments',
        )
);
?>
