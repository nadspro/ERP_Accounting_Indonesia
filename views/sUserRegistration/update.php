<?php
/* @var $this SUserRegistrationController */
/* @var $model sUserRegistration */

$this->breadcrumbs = array(
    'User Registration' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Update',
);

$this->menu5 = array('User Registration');

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/sUserRegistration')),
    array('label' => 'View', 'icon' => 'edit', 'url' => array('view', 'id' => $model->id)),
);
?>

<div class="page-header">
    <h1><i class="icon-fa-user"></i> Update:  <?php echo $model->email; ?></h1>
</div>
<?php echo $this->renderPartial('_form', array('model' => $model)); ?>