<div class="consumables index">
	<h2><?php echo __('Potrosni materijal'); ?></h2>
	<div class="row form-inline field">
		<?php echo $this->Form->create("", ['type' => 'get']); ?>
		<?php echo $this->Form->control('keyword', array('class'=>'form-control'));?>
		<button type="submit" class="button default" id="search-b">Pretrazi</button>
		<?php echo $this->Form->end(); ?>
	</div>
	<table cellpadding="0" cellspacing="0" >
		<thead>
			<tr>	
				<th><?php echo $this->Paginator->sort('kod'); ?></th>
				<th><?php echo $this->Paginator->sort('ime'); ?></th>
				<th><?php echo $this->Paginator->sort('opis'); ?></th>
				<th><?php echo $this->Paginator->sort('tezina'); ?></th>
				<th><?php echo $this->Paginator->sort('status'); ?></th>
				<th><?php echo $this->Paginator->sort('rejting'); ?></th>
				<th class="action-btn"><?php echo __('Akcije'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($consumables as $consumable): ?>
			<tr>
				<td><?php echo h($consumable['Item']['code']); ?>&nbsp;</td>
				<td><?php echo h($consumable['Item']['name']); ?>&nbsp;</td>
				<td><?php echo h($consumable['Item']['description']); ?>&nbsp;</td>
				<td><?php echo h($consumable['Item']['weight']); ?>&nbsp;</td>
				<td><?php echo h($consumable['Consumable']['consumable_status']); ?>&nbsp;</td>
				<td><?php echo h($consumable['Consumable']['recommended_rating']); ?>&nbsp;</td>

				<td class="row">
					<?php echo $this->Html->link(__('Pogledaj'), array('action' => 'view', $consumable['Consumable']['id']), array('class' => 'button default')); ?>
					<?php echo $this->Html->link(__('Izmeni'), array('action' => 'save', $consumable['Consumable']['id']), array('class' => 'button default')); ?>
					<?php echo $this->Form->postLink(__('Obrisi'), array('action' => 'delete', $consumable['Consumable']['id']), array('class' => 'button default', 'confirm' => __('Da li ste sigurni da zelite da obrisete # %s?', $consumable['Consumable']['id']))); ?>
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
<div class="row container">
	<?php echo $this->Html->link(__('Novi PM'), array('action' => 'save'), array('class' => 'button default')); ?>
</div>
