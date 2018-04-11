<div class="itemTypes form">
	<?php echo $this->Form->create('ItemType'); ?>
	<h2><?php echo __('Dodaj novi tip'); ?></h2>
	<div class="row">
		<?php
			echo $this->Form->input('code', array('label' => 'Sifra', 'class' => 'form-control'));
			echo $this->Form->input('name', array('label' => 'Ime', 'class' => 'form-control'));
			echo $this->Form->input('class', array('empty' => '-Izaberite-', 'class' => 'form-control', 'label' => 'Klasa'));
			echo $this->Form->input('tangible', array('label' => 'Opipljiv'));
			echo $this->Form->input('active', array('label' => 'Aktivan'));
		?>
	</div>
	<div class="col_6 button-save">
		<?php echo $this->Form->button(__("Sacuvaj"), array("class" => "button green", "type" => "submit")); ?>
		<?php echo $this->Html->link(__('Odustani'), array('action' => 'index'), array('class' => 'button orange')); ?>
	</div>
	<?php echo $this->Form->end(); ?>
</div>

