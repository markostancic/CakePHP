<div class="goods index">
	<h2><?php echo __('Roba'); ?></h2>
	<div class="row form-inline field">
		<?php echo $this->Form->create("", ['type' => 'get']); ?>
		<?php echo $this->Form->control('keyword', array('class'=>'form-control'));?>
		<button type="submit" class="button default" id="search-b">Pretrazi</button>
		<?php echo $this->Form->end(); ?>
	</div>
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>	
				<th><?php echo $this->Paginator->sort('kod'); ?></th>
				<th><?php echo $this->Paginator->sort('ime'); ?></th>
				<th><?php echo $this->Paginator->sort('opis'); ?></th>
				<th><?php echo $this->Paginator->sort('tezina'); ?></th>
				<th><?php echo $this->Paginator->sort('pid'); ?></th>
				<th><?php echo $this->Paginator->sort('hts number'); ?></th>
				<th><?php echo $this->Paginator->sort('taksa'); ?></th>
				<th><?php echo $this->Paginator->sort('eccn'); ?></th>
				<th><?php echo $this->Paginator->sort('datum'); ?></th>
				<th><?php echo $this->Paginator->sort('status'); ?></th>
				<th><?php echo $this->Paginator->sort('za distributere'); ?></th>
				<th class="action-btn"><?php echo __('Akcije'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($goods as $good): ?>
			<tr>
				<td><?php echo h($good['Item']['code']); ?>&nbsp;</td>
				<td><?php echo h($good['Item']['name']); ?>&nbsp;</td>
				<td><?php echo h($good['Item']['description']); ?>&nbsp;</td>
				<td><?php echo h($good['Item']['weight']); ?>&nbsp;</td>
				<td><?php echo h($good['Good']['pid']); ?>&nbsp;</td>
				<td><?php echo h($good['HtsNumber']['hts_number']); ?>&nbsp;</td>
				<?php if(!empty($good['Tax']['tax'])): ?>
				<td><?php echo h($good['Tax']['tax'].'%'); ?>&nbsp;</td>
				<?php else: ?>
				<td><?php echo h($good['Tax']['tax']); ?>&nbsp;</td>
				<?php endif; ?>
				<td><?php echo h($good['Good']['eccn']); ?>&nbsp;</td>
				<td><?php echo h($good['Good']['release_date']); ?>&nbsp;</td>
				<td><?php echo h($good['Good']['status']); ?>&nbsp;</td>
				<td>
					<?php
					if($good['Good']['for_distributors'] == 1){
						 echo "Da"; 
					} else {
						echo "Ne"; 
					}
					?>
					&nbsp;
				</td>
				
				<td class="row">
					<?php echo $this->Html->link(__('Pogledaj'), array('action' => 'view', $good['Good']['id']), array('class' => 'button default')); ?>
					<?php echo $this->Html->link(__('Izmeni'), array('action' => 'save', $good['Good']['id']), array('class' => 'button default')); ?>
					<?php echo $this->Form->postLink(__('Obrisi'), array('action' => 'delete', $good['Good']['id']), array('class' => 'button default', 'confirm' => __('Da li ste sigurni da zelite da obrisete # %s?', $good['Good']['id']))); ?>
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
	<?php echo $this->Html->link(__('Nova roba'), array('action' => 'save'), array('class' => 'button default')); ?>
	<?php echo $this->Html->link(__('Izvezi u Excel'), array('action' => 'index_excel'), array('class' => 'button default')); ?>
	<?php echo $this->Html->link(__('Izvezi u PDF'), array('action' => 'index_pdf'), array('class' => 'button default')); ?>
	<?php echo $this->Html->link(__('Uvezi iz Excela'), array('action' => 'import_excel'), array('class' => 'button default')); ?>
</div>
