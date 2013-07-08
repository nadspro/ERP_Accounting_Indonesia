<?php
/* @var $this SUserRegistrationController */
/* @var $model sUserRegistration */

$this->breadcrumbs = array(
    'User Registration' => array('/sUserRegistration'),
    $model->id,
);

$this->menu5 = array('User Registration');

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/sUserRegistration')),
    array('label' => 'Update', 'icon' => 'pencil', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Update Password', 'icon' => 'pencil', 'url' => array('updatePassword', 'id' => $model->id)),
    array('label' => 'Delete', 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
);
?>

<div class="page-header">
    <h1>		<i class="icon-fa-user"></i>
        <?php echo $model->email; ?></h1>
</div>

<?php
$this->widget('TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'module_name',
        'registration_date',
        'activation_code',
        'email',
        'password',
        'status.name',
    ),
));
?>
