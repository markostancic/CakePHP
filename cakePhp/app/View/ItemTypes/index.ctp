<div class="itemTypes index">
	<h2><?php echo __('Tipovi'); ?></h2>
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('Sifra'); ?></th>
				<th><?php echo $this->Paginator->sort('Ime'); ?></th>
				<th><?php echo $this->Paginator->sort('Klasa'); ?></th>
				<th><?php echo $this->Paginator->sort('Opipljiv'); ?></th>
				<th><?php echo $this->Paginator->sort('Aktivan'); ?></th>
				<th class="actions"><?php echo __('Akcije'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($itemTypes as $itemType): ?>
			<tr>
				<td><?php echo h($itemType['ItemType']['code']); ?>&nbsp;</td>
				<td><?php echo h($itemType['ItemType']['name']); ?>&nbsp;</td>
				<td><?php echo h($itemType['ItemType']['class']); ?>&nbsp;</td>
				<td>
					<?php
					if($itemType['ItemType']['tangible'] == 1){
						 echo "Da"; 
					} else {
						echo "Ne"; 
					}
					?>
					&nbsp;
				</td>
				<td>
					<?php
					if($itemType['ItemType']['active'] == 1){
						 echo "Da"; 
					} else {
						echo "Ne"; 
					}
					?>
					&nbsp;
				</td>
				<td class="actions">
					<?php echo $this->Html->link(__('Pogledaj'), array('action' => 'view', $itemType['ItemType']['id']), array('class' => 'button default')); ?>
					<?php echo $this->Html->link(__('Izmeni'), array('action' => 'edit', $itemType['ItemType']['id']), array('class' => 'button default')); ?>
					<?php echo $this->Form->postLink(__('Obrisi'), array('action' => 'delete', $itemType['ItemType']['id']), array('class' => 'button default', 'confirm' => __('Da li ste sigurni da zelite da obrisete # %s?', $itemType['ItemType']['id']))); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="action">
		<?php echo $this->Html->link(__('Dodaj novi tip'), array('action' => 'add'), array('class' => 'button default')); ?>
</div>
