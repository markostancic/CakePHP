<div class="taxes form">
	<?php echo $this->Form->create('Tax'); ?>
	<h2><?php echo __('Izmeni porez'); ?></h2>
	<div class="row">
		
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('tax', array('label' => 'Porez', 'class' => 'form-control'));
	?>
	</div>
	<div class="col_6 button-save">
		<?php echo $this->Form->button(__("Sacuvaj"), array("class" => "button green", "type" => "submit")); ?>
		<?php echo $this->Html->link(__('Odustani'), array('action' => 'index'), array('class' => 'button orange')); ?>
	</div>
	<?php echo $this->Form->end(); ?>
</div>

