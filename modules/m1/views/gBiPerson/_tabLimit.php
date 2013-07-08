<h4>LIMIT</h4>
<p>Limit total output record</p>
<?php echo $form->dropDownList($model, 'limit', array('500' => '500', '1000' => '1000', '5000' => '5000')); ?>

<?php
echo $form->checkboxRow($model, 'plusResign');