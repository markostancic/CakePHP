<div class="measuementUnits index">
	<h2><?php echo __('Jedinice mere'); ?></h2>
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('Ime'); ?></th>
				<th><?php echo $this->Paginator->sort('Simbol'); ?></th>
				<th><?php echo $this->Paginator->sort('Aktivno'); ?></th>
				<th class="actions"><?php echo __('Akcije'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($measuementUnits as $measuementUnit): ?>
			<tr>
				<td><?php echo h($measuementUnit['MeasuementUnit']['name']); ?>&nbsp;</td>
				<td><?php echo h($measuementUnit['MeasuementUnit']['symbol']); ?>&nbsp;</td>
				<td><?php
					if($measuementUnit['MeasuementUnit']['active'] == 1){
						 echo "Da"; 
					} else {
						echo "Ne"; 
					}
				 ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('Pregledaj'), array('action' => 'view', $measuementUnit['MeasuementUnit']['id']), array('class' => 'button default')); ?>
					<?php echo $this->Html->link(__('Izmeni'), array('action' => 'edit', $measuementUnit['MeasuementUnit']['id']), array('class' => 'button default')); ?>
					<?php echo $this->Form->postLink(__('Obrisi'), array('action' => 'delete', $measuementUnit['MeasuementUnit']['id']), array('class' => 'button default', 'confirm' => __('Da li ste sigurni da zelite da obrisete # %s?', $measuementUnit['MeasuementUnit']['id']))); ?>
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
	<?php echo $this->Html->link(__('Dodaj novu jedinicu mere'), array('action' => 'add'), array('class' => 'button default')); ?>
</div>
