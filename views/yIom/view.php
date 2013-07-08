<?php
/* @var $this SCompanyNewsController */
/* @var $model SCompanyNews */

$this->breadcrumbs = array(
    'Inter Office Memo' => array('index'),
    $model->subject,
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'home', 'url' => array('/yIom')),
    array('label' => 'Update', 'icon' => 'pencil', 'url' => array('/yIom/update', "id" => $model->id)),
    array('label' => 'Print', 'icon' => 'print', 'url' => array('/yIom/print', "id" => $model->id)),
);

$this->menu1 = yIom::getTopUpdated();
$this->menu2 = yIom::getTopCreated();
?>

<div class="page-header">
    <h1>
        <i class="iconic-article"></i>
        <?php echo $model->subject; ?>
    </h1>
</div>

<div class="row">
    <div class="span9">
        <?php
        $this->widget('TbDetailView', array(
            'data' => $model,
            'attributes' => array(
                'iom_number',
                'iom_to',
                'iom_cc',
                'iom_from',
                'subject',
                'attachment',
                'iom_date',
                'sender_by',
                'sender_title',
                'approved_by',
                'approved_title',
            //'other_by',
            //'other_title',
            ),
        ));

        $this->beginWidget('CMarkdown', array('purifyOutput' => true));
        echo $model->content;
        $this->endWidget();
        ?>
    </div>
</div>
