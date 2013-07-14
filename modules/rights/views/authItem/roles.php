<?php
$this->breadcrumbs = array(
    'Rights' => Rights::getBaseUrl(),
    Rights::t('core', 'Roles'),
);
?>


<?php
$this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'items' => array(
        array('label' => 'Permission', 'icon' => 'user', 'url' => Yii::app()->createUrl('/rights')),
        array('label' => 'Roles', 'icon' => 'edit', 'url' => Yii::app()->createUrl('/rights/authItem/roles'), 'active' => true),
        array('label' => 'Tasks', 'icon' => 'cog', 'url' => Yii::app()->createUrl('/rights/authItem/tasks')),
        array('label' => 'Operations', 'icon' => 'wrench', 'url' => Yii::app()->createUrl('/rights/authItem/operations')),
    ),
));
?>


<div class="row">
    <div class="span12">

        <div class="page-header">
            <h1>
                <?php echo Rights::t('core', 'Roles'); ?>
            </h1>
        </div>

        <p>
            <?php
            echo CHtml::link(Rights::t('core', 'Create a new role'), array('authItem/create', 'type' => CAuthItem::TYPE_ROLE), array(
                'class' => 'add-role-link btn',
            ));
            ?>
        </p>

        <?php
        $this->widget('bootstrap.widgets.TbGridView', array(
            'itemsCssClass' => 'table table-striped table-bordered',
            'template' => '{items}{pager}{summary}',
            'dataProvider' => $dataProvider,
            'template' => '{items}',
            'emptyText' => Rights::t('core', 'No roles found.'),
            'htmlOptions' => array('class' => 'grid-view role-table'),
            'columns' => array(
                array(
                    'name' => 'name',
                    'header' => Rights::t('core', 'Name'),
                    'type' => 'raw',
                    'htmlOptions' => array('class' => 'name-column'),
                    'value' => '$data->getGridNameLink()',
                ),
                array(
                    'name' => 'description',
                    'header' => Rights::t('core', 'Description'),
                    'type' => 'raw',
                    'htmlOptions' => array('class' => 'description-column'),
                ),
                array(
                    'name' => 'bizRule',
                    'header' => Rights::t('core', 'Business rule'),
                    'type' => 'raw',
                    'htmlOptions' => array('class' => 'bizrule-column'),
                    'visible' => Rights::module()->enableBizRule === true,
                ),
                array(
                    'name' => 'data',
                    'header' => Rights::t('core', 'Data'),
                    'type' => 'raw',
                    'htmlOptions' => array('class' => 'data-column'),
                    'visible' => Rights::module()->enableBizRuleData === true,
                ),
                array(
                    'header' => '&nbsp;',
                    'type' => 'raw',
                    'htmlOptions' => array('class' => 'actions-column'),
                    'value' => '$data->getDeleteRoleLink()',
                ),
            )
        ));
        ?>

        <p class="info">
            <?php echo Rights::t('core', 'Values within square brackets tell how many children each item has.'); ?>
        </p>

    </div>
</div>
