    <h4><?php echo CHtml::link(CHtml::encode($data->company_name), array('view', 'id' => $data->id)); ?>
    </h4> 

      <b><?php echo CHtml::encode($data->getAttributeLabel('pic')); ?>:</b>
      <?php echo CHtml::encode($data->pic); ?>
      <br />
      <b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
      <?php echo CHtml::encode($data->address); ?>
      <br />
		
      <b><?php echo CHtml::encode($data->getAttributeLabel('city')); ?>:</b>
      <?php echo CHtml::encode($data->city); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('pos_code')); ?>:</b>
      <?php echo CHtml::encode($data->pos_code); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('province')); ?>:</b>
      <?php echo CHtml::encode($data->province); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('telephone')); ?>:</b>
      <?php echo CHtml::encode($data->telephone); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('fax')); ?>:</b>
      <?php echo CHtml::encode($data->fax); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
      <?php echo CHtml::encode($data->email); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('status_id')); ?>:</b>
      <?php echo CHtml::encode($data->status_id); ?>
      <br />

