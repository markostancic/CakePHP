<div class="measuementUnits form">
	<?php echo $this->Form->create('MeasuementUnit'); ?>
	<h2><?php echo __('Dodaj jedinicu mere'); ?></h2>
	<div class="row">	
		<?php
			echo $this->Form->input('name' , array('label' => 'Ime', 'class' => 'form-control'));
			echo $this->Form->input('symbol' , array('label' => 'Simbol', 'class' => 'form-control'));
			echo $this->Form->input('active', array('label' => 'Aktivno'));
		?>
	</div>
	<div class="col_6 button-save">
			<?php echo $this->Form->button(__("Sacuvaj"), array("class" => "button green", "type" => "submit")); ?>
			<?php echo $this->Html->link(__('Odustani'), array('action' => 'index'), array('class' => 'button orange')); ?>
	</div>
	<?php echo $this->Form->end(); ?>
</div>

