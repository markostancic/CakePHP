<div class="kits index">
	<h2><?php echo __('Kitovi'); ?></h2>
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
				<th><?php echo $this->Paginator->sort('Trzina'); ?></th>
				<th><?php echo $this->Paginator->sort('Pid'); ?></th>
				<th><?php echo $this->Paginator->sort('Hts broj'); ?></th>
				<th><?php echo $this->Paginator->sort('Takse'); ?></th>
				<th><?php echo $this->Paginator->sort('Eccn'); ?></th>
				<th><?php echo $this->Paginator->sort('Datum'); ?></th>
				<th><?php echo $this->Paginator->sort('Za distributere'); ?></th>
				<th><?php echo $this->Paginator->sort('Status'); ?></th>
				<th class="actions"><?php echo __('Akcije'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($kits as $kit): ?>
			<tr>
				<td><?php echo h($kit['Item']['code']); ?>&nbsp;</td>
				<td><?php echo h($kit['Item']['name']); ?>&nbsp;</td>
				<td><?php echo h($kit['Item']['description']); ?>&nbsp;</td>
				<td><?php echo h($kit['Item']['weight']); ?>&nbsp;</td>
				<td><?php echo h($kit['Kit']['pid']); ?>&nbsp;</td>
				<td><?php echo h($kit['HtsNumber']['hts_number']); ?>&nbsp;</td>
				<?php if(!empty($kit['Tax']['tax'])): ?>
				<td><?php echo h($kit['Tax']['tax'].'%'); ?>&nbsp;</td>
				<?php else: ?>
				<td><?php echo h($kit['Tax']['tax']); ?>&nbsp;</td>
				<?php endif; ?>
				<td><?php echo h($kit['Kit']['eccn']); ?>&nbsp;</td>
				<td><?php echo h($kit['Kit']['release_date']); ?>&nbsp;</td>
				<td>
					<?php
					if($kit['Kit']['for_distributors'] == 1){
						 echo "Da"; 
					} else {
						echo "Ne"; 
					}
					?>
					&nbsp;
				</td>
				<td><?php echo h($kit['Kit']['kit_status']); ?>&nbsp;</td>

				<td class="row">
					<?php echo $this->Html->link(__('Pogledaj'), array('action' => 'view', $kit['Kit']['id']), array('class' => 'button default')); ?>
					<?php echo $this->Html->link(__('Izmeni'), array('action' => 'save', $kit['Kit']['id']), array('class' => 'button default')); ?>
					<?php echo $this->Form->postLink(__('Obrisi'), array('action' => 'delete', $kit['Kit']['id']), array('class' => 'button default', 'confirm' => __('Da li ste sigurni da zelite da obrisete # %s?', $kit['Kit']['id']))); ?>
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
	<?php echo $this->Html->link(__('Novi kit'), array('action' => 'save'), array('class' => 'button default')); ?>
	<?php echo $this->Html->link(__('Izvezi u Excel'), array('action' => 'index_excel'), array('class' => 'button default')); ?>
	<?php echo $this->Html->link(__('Izvezi u PDF'), array('action' => 'index_pdf'), array('class' => 'button default')); ?>
	<?php echo $this->Html->link(__('Uvezi iz Excela'), array('action' => 'import_excel'), array('class' => 'button default')); ?>
</div>
