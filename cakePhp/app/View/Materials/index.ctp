<div class="materials index">
	<h2><?php echo __('Materijali'); ?></h2>
	<div class="row form-inline field">
		<?php echo $this->Form->create("", ['type' => 'get']); ?>
		<?php echo $this->Form->control('keyword', array('class'=>'form-control'));?>
		<button type="submit" class="button default" id="search-b">Pretrazi</button>
		<?php echo $this->Form->end(); ?>
	</div>
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>	
				<th><?php echo $this->Paginator->sort('Kod'); ?></th>
				<th><?php echo $this->Paginator->sort('Ime'); ?></th>
				<th><?php echo $this->Paginator->sort('Opis'); ?></th>
				<th><?php echo $this->Paginator->sort('Tezina'); ?></th>
				<th><?php echo $this->Paginator->sort('Status'); ?></th>
				<th><?php echo $this->Paginator->sort('Rejting'); ?></th>
				<th><?php echo $this->Paginator->sort('Usluga proizvodnje'); ?></th>
				<th class="actions"><?php echo __('Akcije'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($materials as $material): ?>
			<tr>
				<td><?php echo h($material['Item']['code']); ?>&nbsp;</td>
				<td><?php echo h($material['Item']['name']); ?>&nbsp;</td>
				<td><?php echo h($material['Item']['description']); ?>&nbsp;</td>
				<td><?php echo h($material['Item']['weight']); ?>&nbsp;</td>
				<td><?php echo h($material['Material']['material_status']); ?>&nbsp;</td>
				<td><?php echo h($material['Material']['recommended_rating']); ?>&nbsp;</td>
				<td>
					<?php
					if($material['Material']['service_production'] == 1){
						 echo "Da"; 
					} else {
						echo "Ne"; 
					}
					?>
					&nbsp;
				</td>
				<td class="actions">
					<?php echo $this->Html->link(__('Pogledaj'), array('action' => 'view', $material['Material']['id']), array('class' => 'button default')); ?>
					<?php echo $this->Html->link(__('Izmeni'), array('action' => 'save', $material['Material']['id']), array('class' => 'button default')); ?>
					<?php echo $this->Form->postLink(__('Obrisi'), array('action' => 'delete', $material['Material']['id']), array('class' => 'button default', 'confirm' => __('Da li ste sigurni da zelite da obrisete # %s?', $material['Material']['id']))); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('prethodna'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('sledeca') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="action">
	<?php echo $this->Html->link(__('Novi materijal'), array('action' => 'save'), array('class' => 'button default')); ?>
</div>
