<div class="htsNumbers form">
	<?php echo $this->Form->create('HtsNumber'); ?>
	<h2><?php echo __('Dodaj novi Hts broj'); ?></h2>
	<div class="row">
		<?php
			echo $this->Form->input('hts_number', array('label' => 'Hts broj', 'class' => 'form-control'));
		?>
		<div class="col_6 button-save">
			<?php echo $this->Form->button(__("Sacuvaj"), array("class" => "button green", "type" => "submit")); ?>
			<?php echo $this->Html->link(__('Odustani'), array('action' => 'index'), array('class' => 'button orange')); ?>
		</div>
	</div>
	<?php echo $this->Form->end(); ?>
</div>

