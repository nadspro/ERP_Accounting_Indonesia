<h4>FILTER</h4>
<p>Reduce the result by input the field parameter. Tips: You can use %word_to_filter% in the value ...</p>
<?php
$this->widget('ext.appendo.JAppendo', array(
    'id' => 'repeateEnum2',
    'model' => $model,
    'viewName' => '_filter',
    'labelDel' => 'Remove Row',
    'appendoPath' => '/modules/m1/views/jAppendo/',
        //'cssFile' => 'css/jquery.appendo2.css'
));

