<div class="serviceSuppliers index">
	<h2><?php echo __('Usluge Dobavljaca'); ?></h2>
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>	
				<th><?php echo $this->Paginator->sort('Kod'); ?></th>
				<th><?php echo $this->Paginator->sort('Ime'); ?></th>
				<th><?php echo $this->Paginator->sort('Opis'); ?></th>
				<th><?php echo $this->Paginator->sort('Tezina'); ?></th>
				<th><?php echo $this->Paginator->sort('Status'); ?></th>
				<th><?php echo $this->Paginator->sort('Rejting'); ?></th>
				<th class="actions"><?php echo __('Akcije'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($serviceSuppliers as $serviceSupplier): ?>
			<tr>
				<td><?php echo h($serviceSupplier['Item']['code']); ?>&nbsp;</td>
				<td><?php echo h($serviceSupplier['Item']['name']); ?>&nbsp;</td>
				<td><?php echo h($serviceSupplier['Item']['description']); ?>&nbsp;</td>
				<td><?php echo h($serviceSupplier['Item']['weight']); ?>&nbsp;</td>
				<td><?php echo h($serviceSupplier['ServiceSupplier']['service_status']); ?>&nbsp;</td>
				<td><?php echo h($serviceSupplier['ServiceSupplier']['service_rating']); ?>&nbsp;</td>
				<td class="row">
					<?php echo $this->Html->link(__('Pogledaj'), array('action' => 'view', $serviceSupplier['ServiceSupplier']['id']), array('class' => 'button default')); ?>
					<?php echo $this->Html->link(__('Izmeni'), array('action' => 'save', $serviceSupplier['ServiceSupplier']['id']), array('class' => 'button default')); ?>
					<?php echo $this->Form->postLink(__('Obrisi'), array('action' => 'delete', $serviceSupplier['ServiceSupplier']['id']), array('class' => 'button default', 'confirm' => __('Da li ste sigurni da zelite da obrisete # %s?', $serviceSupplier['ServiceSupplier']['id']))); ?>
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
	<?php echo $this->Html->link(__('Nova usluga dobavljaca'), array('action' => 'save'), array('class' => 'button default')); ?>
</div>
