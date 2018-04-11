<div class="htsNumbers index">
	<h2><?php echo __('Hts broj'); ?></h2>
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('Hts broj'); ?></th>
				<th class="actions"><?php echo __('Akcije'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($htsNumbers as $htsNumber): ?>
			<tr>
				<td><?php echo h($htsNumber['HtsNumber']['hts_number']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('Pogledaj'), array('action' => 'view', $htsNumber['HtsNumber']['id']), array('class' => 'button default')); ?>
					<?php echo $this->Html->link(__('Izmeni'), array('action' => 'edit', $htsNumber['HtsNumber']['id']), array('class' => 'button default')); ?>
					<?php echo $this->Form->postLink(__('Obrisi'), array('action' => 'delete', $htsNumber['HtsNumber']['id']), array('class' => 'button default' ,'confirm' => __('Da li ste sigurni da zelite da obrisete # %s?', $htsNumber['HtsNumber']['id']))); ?>
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
<div class="row">
	<?php echo $this->Html->link(__('Dodaj novi Hts broj'), array('action' => 'add'), array('class' => 'button default')); ?>
</div>
