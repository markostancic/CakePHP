<div class="goods form">
	<?php echo $this->Form->create('Good'); ?>
	<h2><?php echo __('Roba'); ?></h2>
	<div class="row">
		<div class="col_6">
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('code', ['type' => 'hidden']);
			echo $this->Form->input('name' , array('label' => 'Ime', 'class' => 'form-control'));
			echo $this->Form->input('description', array('type' => 'textarea', 'class' => 'form-control', 'label' => 'Opis'));
			echo $this->Form->input('weight', array('label' => 'Tezina', 'class' => 'form-control'));
			echo $this->Form->input('measurement_unit_id', array('empty' => '-Izaberite-', 'class' => 'form-control', 'label' => 'Merna jedinica', 'options' => $measurementUnits));
			echo $this->Form->input('pid', array('id' => 'pid', 'class' => 'form-control', 'label' => array('id' => 'pid-label')));
			echo $this->Form->input('hts_number_id', array('id' => 'hts', 'class' => 'form-control', 'label' => array('id' => 'hts-label', 'text' => 'Hts broj'), 'empty' => '-Izaberi-', 'class' => 'form-control', 'options' => $htsNumbers));
			?>
		</div>
		<div class="col_6 pull-right" id="right-good">
			<?php
			echo $this->Form->input('tax_group_id', array('id' => 'tax', 'class' => 'form-control', 'label' => array('text' => 'Taksa' ,'id' => 'tax-label'), 'empty' => '-Izaberi-', 'options' => $taxes));
			echo $this->Form->input('eccn', array('id' => 'eccn', 'class' => 'form-control', 'label' => array('id' => 'eccn-label'), 'empty' => '-Izaberi-', 'options' => $eccn));
			if(!empty($id)){
				echo $this->Form->input('release_date', array('type' => 'text', 'class' => 'form-control', 'id' => 'datepicker', 'class' => 'date form_datetime'));
			}
			echo $this->Form->input('status', array('id' => 'status', 'class' => 'form-control', 'empty' => '-Izaberi-','options' => $statuses));
			echo $this->Form->input('item_type_id', array('empty' => '-Izaberi-', 'class' => 'form-control', 'label' => 'Tip', 'options' => $itemTypes));
			echo $this->Form->input('for_distributors',array('label' => 'Usluga proizvodnje'));
		?>
		</div>
		<div class="col_6 button-save">
			<?php echo $this->Form->button(__("Sacuvaj"), array("class" => "button green", "type" => "submit")); ?>
			<?php echo $this->Html->link(__('Odustani'), array('action' => 'index'), array('class' => 'button orange')); ?>
		</div>
	</div>

		<?php echo $this->Form->end(); ?>
</div>
<?php echo $this->Html->script('date'); 
 echo $this->Html->script('required'); ?>