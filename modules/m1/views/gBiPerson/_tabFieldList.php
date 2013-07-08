<h4>SELECT</h4>
<p>Select which field that you want to show on result page....</p>


<?php
$this->widget('ext.appendo.JAppendo', array(
    'id' => 'repeateEnum1',
    'model' => $model,
    'viewName' => '_select',
    'labelDel' => 'Remove Row',
    'appendoPath' => '/modules/m1/views/jAppendo/',
        //'cssFile' => 'css/jquery.appendo2.css'
));

