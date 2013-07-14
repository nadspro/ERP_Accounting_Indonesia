<?php
$this->breadcrumbs = array(
    'Sequence',
);

$this->menu = array(
    array('label' => 'Home', 'icon' => 'th-list', 'url' => array('/m5/rSequence')),
);



//$this->menu1=gPerson::getTopUpdated();
//$this->menu2=gPerson::getTopCreated();
//$this->menu4=gPerson::getTopOther();  //uncomplete data
$this->menu5 = array('Sequence');
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-wrench"></i>
        Sequence Process
    </h1>
</div>

<?php
$gridDataProvider = new CArrayDataProvider(array(
    array('id' => 1, 'tanggal' => '01-05-2013', 'kapasitas_terpasang' => '3', 'plant_availability' => '0.8',
        'jam_mulai' => '07:00', 'jam_selesai' => '18:00', 'ritase_max_tm' => '7', 'ritase_max_tm' => '7', 'kebutuhan_tm' => '7'),
    array('id' => 2, 'tanggal' => '02-05-2013', 'kapasitas_terpasang' => '5', 'plant_availability' => '0.9',
        'jam_mulai' => '07:30', 'jam_selesai' => '15:00', 'ritase_max_tm' => '6', 'ritase_max_tm' => '7', 'kebutuhan_tm' => '9'),
    array('id' => 3, 'tanggal' => '03-05-2013', 'kapasitas_terpasang' => '2', 'plant_availability' => '1.0',
        'jam_mulai' => '08:00', 'jam_selesai' => '18:30', 'ritase_max_tm' => '9', 'ritase_max_tm' => '6', 'kebutuhan_tm' => '8'),
    array('id' => 4, 'tanggal' => '04-05-2013', 'kapasitas_terpasang' => '7', 'plant_availability' => '0.5',
        'jam_mulai' => '06:00', 'jam_selesai' => '17:00', 'ritase_max_tm' => '8', 'ritase_max_tm' => '6', 'kebutuhan_tm' => '7'),
        ));
?>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered condensed',
    'dataProvider' => $gridDataProvider,
    'template' => "{items}",
    'columns' => array(
        array('name' => 'id', 'header' => '#'),
        array('name' => 'tanggal', 'header' => 'Tanggal'),
        array('name' => 'kapasitas_terpasang', 'header' => 'Kapasitas Terpasang'),
        array('name' => 'plant_availability', 'header' => 'Plant Availability'),
        array('name' => 'jam_mulai', 'header' => 'Jam Mulai'),
        array('name' => 'jam_selesai', 'header' => 'Jam Selesai'),
        array('name' => 'ritase_max_tm', 'header' => 'Ritase Max TM'),
        array('name' => 'ritase_max_tm', 'header' => 'Kapasitas Max TM'),
        array('name' => 'kebutuhan_tm', 'header' => 'Kebutuhan TM'),
    //array(
    //    'class'=>'bootstrap.widgets.TbButtonColumn',
    //    'htmlOptions'=>array('style'=>'width: 50px'),
    //),
    ),
));
?>
