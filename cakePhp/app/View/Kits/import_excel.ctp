<div class="kits form">
	<?php echo $this->Form->create('Kit', array('type' => 'file')); ?>
	<h3><?php echo __('Uvoz'); ?></h3>
	<div class="col_6">
		
		<?php
			echo $this->Form->input('import', ['type' => 'file', 'label' => 'Uvoz']);
		?>
		<?php echo $this->Form->button(__("Sacuvaj"), array("class" => "button green", "type" => "submit")); ?>
	</div>
	<?php echo $this->Form->end(); ?>

</div>











