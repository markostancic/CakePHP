<div class="products form">
	<?php echo $this->Form->create('Product'); ?>
	<h2><?php echo __('Proizvod'); ?></h2>
	<div class="row">
		<div class="col_6">
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('code' , ['type' => 'hidden']);
			echo $this->Form->input('name', array('label' => 'Ime', 'class' => 'form-control'));
			echo $this->Form->input('description', array('type' => 'textarea', 'label' => 'Opis'));
			echo $this->Form->input('weight', array('label' => 'Tezina', 'class' => 'form-control'));
			echo $this->Form->input('measurement_unit_id', array('empty' => '-Izaberite-', 'class' => 'form-control', 'label' => 'Merna jedinica', 'options' => $measurementUnits));
			echo $this->Form->input('pid', array('id' => 'pid', 'class' => 'form-control', 'label' => array('text' => 'Pid', 'id' => 'pid-label')));

		?>
		</div>
		<div class="col_6 pull-right" id="right-pro">
			<?php
				echo $this->Form->input('hts_number_id', array('id' => 'hts', 'class' => 'form-control', 'label' => array('text' => 'Hts Broj', 'id' => 'hts-label'), 'empty' => '-Izaberi-', 'options' => $htsNumbers));
				echo $this->Form->input('tax_group_id', array('id' => 'tax', 'class' => 'form-control', 'label' => array('text' => 'Takse', 'id' => 'tax-label'), 'empty' => '-Izaberi-', 'options' => $taxes));
				echo $this->Form->input('product_eccn', array('id' => 'eccn', 'class' => 'form-control', 'label' => array('text' => 'Eccn', 'id' => 'eccn-label'), 'empty' => '-Izaberi-', 'options' => $product_eccn));
				
				if(!empty($id)){
					echo $this->Form->input('product_release_date', array('type' => 'text', 'class' => 'form-control', 'label' => 'Datum', 'id' => 'datepicker', 'class' => 'date form_datetime'));
				}
			
				echo $this->Form->input('for_distributors', array('label' => 'Za distributere'));
				echo $this->Form->input('product_status', array('id' => 'status', 'class' => 'form-control', 'label' => 'Status', 'empty' => '-Izaberi-','options' => $statuses));
				echo $this->Form->input('item_type_id', array('empty' => '-Izaberi-', 'class' => 'form-control', 'label' => 'Tip', 'options' => $itemTypes));
				echo $this->Form->input('service_production', array('label' => 'Usluga proizvodnje'));
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