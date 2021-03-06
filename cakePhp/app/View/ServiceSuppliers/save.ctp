<div class="serviceSuppliers form">
	<?php echo $this->Form->create('ServiceSupplier'); ?>
	<h2><?php echo __('Usluga dobavljaca'); ?></h2>
	<div class="row">
		<div class="col_6">
			<?php
				echo $this->Form->input('id');
				echo $this->Form->input('code' , ['type' => 'hidden']);
				echo $this->Form->input('name', array('label' => 'Ime', 'class' => 'form-control'));
				echo $this->Form->input('description', array('type' => 'textarea', 'label' => 'Opis'));
				echo $this->Form->input('weight', array('label' => 'Tezina', 'class' => 'form-control'));
			?>
		</div>
		<div class="col_6 pull-right" id="right-supp">
			<?php
				echo $this->Form->input('measurement_unit_id', array('empty' => '-Izaberite-', 'class' => 'form-control', 'label' => 'Merna jedinica', 'options' => $measurementUnits));
				echo $this->Form->input('service_status', array('empty' => '-Izaberite-', 'class' => 'form-control', 'label' => 'Status', 'options' => $statuses));
				echo $this->Form->input('item_type_id', array('empty' => '-Izaberi-', 'class' => 'form-control', 'label' => 'Tip', 'options' => $itemTypes));
				echo $this->Form->input('service_rating', array('empty' => '-Izaberi-', 'class' => 'form-control', 'label' => 'Rejting', 'options' => $rating));
			?>
		</div>
		<div class="col_6 button-save">
			<?php echo $this->Form->button(__("Sacuvaj"), array("class" => "button green", "type" => "submit")); ?>
			<?php echo $this->Html->link(__('Odustani'), array('action' => 'index'), array('class' => 'button orange')); ?>
		</div>
	</div>
	<?php echo $this->Form->end(); ?>
</div>


