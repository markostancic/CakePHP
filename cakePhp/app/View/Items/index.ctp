<div class="items index">
	<h2><?php echo __('Artikli'); ?></h2>
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('Kod'); ?></th>
				<th><?php echo $this->Paginator->sort('Ime'); ?></th>
				<th><?php echo $this->Paginator->sort('Opis'); ?></th>
				<th><?php echo $this->Paginator->sort('Tezina'); ?></th>
				<th><?php echo $this->Paginator->sort('Merna jedinica'); ?></th>
				<th><?php echo $this->Paginator->sort('Tip'); ?></th>
				<th><?php echo $this->Paginator->sort('Obrisano'); ?></th>
				<th class="actions"><?php echo __('Akcije'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($items as $item): ?>
			<tr>
				<td><?php echo h($item['Item']['code']); ?>&nbsp;</td>
				<td><?php echo h($item['Item']['name']); ?>&nbsp;</td>
				<td><?php echo h($item['Item']['description']); ?>&nbsp;</td>
				<td><?php echo h($item['Item']['weight']); ?>&nbsp;</td>
				<td><?php echo h($item['MeasuementUnit']['name']); ?>&nbsp;</td>
				<td><?php echo h($item['ItemType']['name']); ?>&nbsp;</td>
				<td>
					<?php
					if($item['Item']['deleted'] == 1){
						 echo "Da"; 
					} else {
						echo "Ne"; 
					}
					?>
					&nbsp;
				</td>
				<td class="actions">
					<?php echo $this->Html->link(__('Pogledaj'), array('action' => 'view', $item['Item']['id']), array('class' => 'button default')); ?>
					<?php echo $this->Form->postLink(__('Obrisi'), array('action' => 'delete', $item['Item']['id']), array('class' => 'button default', 'confirm' => __('Da li ste sigurni da zelite da obrisete # %s?', $item['Item']['id']))); ?>
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

