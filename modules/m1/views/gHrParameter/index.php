
<?php
$this->breadcrumbs = array(
    $this->module->id,
);
?>
<div class="page-header">
    <h1>
        <i class="icon-fa-wrench"></i>
        HR Parameter
    </h1>
</div>

<?php
$this->widget('bootstrap.widgets.TbTabs', array(
    'type' => 'tabs', // 'tabs' or 'pills'
    'placement' => 'left',
    'tabs' => array(
        array('id' => 'tab5', 'label' => 'Level', 'content' => $this->renderPartial('_tabParamLevel', array('model' => $modelParamLevel), true), 'active' => true),
        array('id' => 'tab6', 'label' => 'Permission', 'content' => $this->renderPartial('_tabParamPermission', array('model' => $modelParamPermission), true)),
        array('id' => 'tab8', 'label' => 'Payroll', 'content' => $this->renderPartial('_tabParamPayroll', array('model' => $modelParamPayroll), true)),
        array('id' => 'tab9', 'label' => 'Benefit', 'content' => $this->renderPartial('_tabParamBenefit', array('model' => $modelParamBenefit), true)),
        array('id' => 'tab10', 'label' => 'Deduction', 'content' => $this->renderPartial('_tabParamDeduction', array('model' => $modelParamDeduction), true)),
        array('id' => 'tab1', 'label' => 'Mass Leave Generator', 'content' => $this->renderPartial('_tabMassLeave', array(), true)),
        array('id' => 'tab2', 'label' => 'Absence Work Pattern', 'content' => 'Testing'),
        array('id' => 'tab3', 'label' => 'OverTime Process', 'content' => 'Testing'),
        array('id' => 'tab4', 'label' => 'Absence Recapitulation', 'content' => 'Testing'),
        array('id' => 'tab7', 'label' => 'Update Applicant', 'content' => $this->renderPartial('_tabApplicant', array(), true)),
    ),
));

