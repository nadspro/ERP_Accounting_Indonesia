<?php
/* @var $this SUserRegistrationController */
/* @var $model sUserRegistration */

$this->breadcrumbs = array(
    'S User Registrations' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/sUserRegistration')),
);
?>

<div class="page-header">
    <h1><i class="icon-fa-user"></i> Create</h1>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>