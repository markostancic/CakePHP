<div class="inventories index">
	<h2><?php echo __('Inventari'); ?></h2>
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>	
				<th><?php echo $this->Paginator->sort('Kod'); ?></th>
				<th><?php echo $this->Paginator->sort('Ime'); ?></th>
				<th><?php echo $this->Paginator->sort('Opis'); ?></th>
				<th><?php echo $this->Paginator->sort('Tezina'); ?></th>
				<th><?php echo $this->Paginator->sort('Status'); ?></th>
				<th><?php echo $this->Paginator->sort('Rejting'); ?></th>
				<th class="action-btn"><?php echo __('Akcije'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($inventories as $inventory): ?>
			<tr>
				<td><?php echo h($inventory['Item']['code']); ?>&nbsp;</td>
				<td><?php echo h($inventory['Item']['name']); ?>&nbsp;</td>
				<td><?php echo h($inventory['Item']['description']); ?>&nbsp;</td>
				<td><?php echo h($inventory['Item']['weight']); ?>&nbsp;</td>
				<td><?php echo h($inventory['Inventory']['status']); ?>&nbsp;</td>
				<td><?php echo h($inventory['Inventory']['recommended_rating']); ?>&nbsp;</td>

				<td class="row">
					<?php echo $this->Html->link(__('Pogledaj'), array('action' => 'view', $inventory['Inventory']['id']), array('class' => 'button default')); ?>
					<?php echo $this->Html->link(__('Izmeni'), array('action' => 'save', $inventory['Inventory']['id']), array('class' => 'button default')); ?>
					<?php echo $this->Form->postLink(__('Obrisi'), array('action' => 'delete', $inventory['Inventory']['id']), array('class' => 'button default', 'confirm' => __('Da li ste sigurni da zelite da obrisete # %s?', $inventory['Inventory']['id']))); ?>
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
	<?php echo $this->Html->link(__('Novi inventar'), array('action' => 'save'), array('class' => 'button default')); ?>
</div>
