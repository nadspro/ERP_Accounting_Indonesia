<div class="page-header">
    <h1>
        <i class="iconic-image"></i>
        Company Documents Administration</h1>
</div>

<?php
// ElFinder widget
$this->widget('ext.elFinder.ElFinderWidget', array(
    'connectorRoute' => 'sCompanyDocumentsAdmin/connectorCompanyDocumentsAdmin',
        )
);
?>