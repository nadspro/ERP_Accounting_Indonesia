<?php

$this->widget('ext.phpexcel.tlbExcelView', array(
    'id' => 'g-bi-grid',
    'dataProvider' => $dataProvider,
    'grid_mode' => $production, // Same usage as EExcelView v0.33
    'title' => 'Some title - ' . date('d-m-Y - H-i-s'),
    'sheetTitle' => 'Report on ' . date('m-d-Y H-i'),
    //'template'=>'{items}',
    'columns' => $field
));
?>

<?php /*
<div style="border-color:#cbcbcb;border-style:solid; border-width:1px; padding:2px 4px; margin:5px 0" id="cResult" >
<?php
	if (isset($sql))
		echo $sql;
?>
</div>

