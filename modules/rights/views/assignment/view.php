<?php
$this->breadcrumbs = array(
    'Rights' => Rights::getBaseUrl(),
    Rights::t('core', 'Assignments'),
);
?>


<?php
$this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'items' => array(
        array('label' => 'Permission', 'icon' => 'user', 'url' => Yii::app()->createUrl('/rights'), 'active' => true),
        array('label' => 'Roles', 'icon' => 'edit', 'url' => Yii::app()->createUrl('/rights/authItem/roles')),
        array('label' => 'Tasks', 'icon' => 'cog', 'url' => Yii::app()->createUrl('/rights/authItem/tasks')),
        array('label' => 'Operations', 'icon' => 'wrench', 'url' => Yii::app()->createUrl('/rights/authItem/operations')),
    ),
));
?>

<div class="page-header">
    <h1>
        <?php echo Rights::t('core', 'Assignments'); ?>
    </h1>
</div>

<p>
    <?php echo Rights::t('core', 'Here you can view which permissions has been assigned to each user.'); ?>
</p>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'itemsCssClass' => 'table table-striped table-bordered',
    'template' => '{items}{pager}{summary}',
    'dataProvider' => $dataProvider,
    'template' => "{items}\n{pager}",
    'emptyText' => Rights::t('core', 'No users found.'),
    'htmlOptions' => array('class' => 'grid-view assignment-table'),
    'columns' => array(
        array(
            'name' => 'name',
            'header' => Rights::t('core', 'Name'),
            'type' => 'raw',
            'htmlOptions' => array('class' => 'name-column'),
            'value' => '$data->getAssignmentNameLink()',
        ),
        array(
            'name' => 'assignments',
            'header' => Rights::t('core', 'Roles'),
            'type' => 'raw',
            'htmlOptions' => array('class' => 'role-column'),
            'value' => '$data->getAssignmentsText(CAuthItem::TYPE_ROLE)',
        ),
        array(
            'name' => 'assignments',
            'header' => Rights::t('core', 'Tasks'),
            'type' => 'raw',
            'htmlOptions' => array('class' => 'task-column'),
            'value' => '$data->getAssignmentsText(CAuthItem::TYPE_TASK)',
        ),
        array(
            'name' => 'assignments',
            'header' => Rights::t('core', 'Operations'),
            'type' => 'raw',
            'htmlOptions' => array('class' => 'operation-column'),
            'value' => '$data->getAssignmentsText(CAuthItem::TYPE_OPERATION)',
        ),
    )
));
?>

