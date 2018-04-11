<div class="kits form">
	<?php echo $this->Form->create('Kit'); ?>
	<h2><?php echo __('Kit'); ?></h2>
	<div class="row">
		<div class="col_6">	
			<?php
				echo $this->Form->input('id');
				echo $this->Form->input('code', ['type' => 'hidden']);
				echo $this->Form->input('name' , array('label' => 'Ime', 'class' => 'form-control'));
				echo $this->Form->input('description', array('type' => 'textarea', 'label' => 'Opis'));
				echo $this->Form->input('weight', array('label' => 'Tezina', 'class' => 'form-control'));
				echo $this->Form->input('measurement_unit_id', array('empty' => '-Izaberite-', 'class' => 'form-control', 'label' => 'Merna jedinica' , 'options' => $measurementUnits));
				echo $this->Form->input('pid', array('id' => 'pid', 'class' => 'form-control', 'label' => array('text' => 'Pid', 'id' => 'pid-label')));
			?>
		</div>
		<div class="col_6 pull-right" id="right-pro">
			<?php
				
				echo $this->Form->input('hts_number_id', array('id' => 'hts', 'class' => 'form-control', 'label' => array('text' => 'Hts Broj', 'id' => 'hts-label'), 'empty' => '-Izaberi-', 'options' => $htsNumbers));
				echo $this->Form->input('tax_group_id', array('id' => 'tax', 'class' => 'form-control', 'label' => array('text' => 'Taksa', 'id' => 'tax-label'), 'empty' => '-Izaberi-', 'options' => $taxes));
				echo $this->Form->input('eccn', array('id' => 'eccn', 'class' => 'form-control', 'label' => array('text' => 'Eccn' ,'id' => 'eccn-label'), 'empty' => '-Izaberi-', 'options' => $eccn));
				if(!empty($id)){
					echo $this->Form->input('release_date', array('type' => 'text', 'class' => 'form-control', 'id' => 'datepicker', 'class' => 'date form_datetime'));
				}
				echo $this->Form->input('for_distributors');
				echo $this->Form->input('kit_status', array('id' => 'status', 'class' => 'form-control', 'empty' => '-Izaberi-', 'label' => 'Status' ,'options' => $statuses));
				echo $this->Form->input('item_type_id', array('empty' => '-Izaberi-', 'class' => 'form-control', 'label' => 'Tip', 'options' => $itemTypes));
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