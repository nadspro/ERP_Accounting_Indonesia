<div class="row-fluid">
    <div class="span12">
        <?php
        //$this->widget('bootstrap.widgets.TbDetailView', array(
        $this->widget('ext.XDetailView', array(
            'ItemColumns' => 1,
            'data' => array(
                'id' => 1,
                'joindate' => $model->companyfirst->start_date,
                'mass_permission' => (isset($model->permissionBalance)) ? $model->permissionBalance->mass_permission : 0,
                'person_permission' => (isset($model->permissionBalance)) ? $model->permissionBalance->person_permission : 0,
                'balance' => (isset($model->permissionBalance)) ? $model->permissionBalance->balance : 0,
            ),
            'attributes' => array(
                array('name' => 'joindate', 'label' => 'Join Date'),
                array('name' => 'mass_permission', 'label' => 'Mass Permission'),
                array('name' => 'person_permission', 'label' => 'Private Permission'),
                array('name' => 'balance', 'label' => 'Balance'),
                array('value' => (isset($model->permissionBalance)) ? $model->permissionBalance->start_date . " (" . waktu::nicetime(strtotime($model->permissionBalance->start_date)) . ")" : 0, 'label' => 'Last Permission'),
                array('value' => (isset($model->lastPermission)) ? $model->lastPermission->permission_reason . " (" . $model->lastPermission->number_of_day . " days)" : '', 'label' => 'Last Permission Reason'),
            ),
        ));
        ?>
    </div>
</div>

