<div class="products index">
	<h2><?php echo __('Poluproizvod'); ?></h2>
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
				<th><?php echo $this->Paginator->sort('Status'); ?></th>
				<th><?php echo $this->Paginator->sort('Usluga proizvodnje'); ?></th>
				<th class="actions"><?php echo __('Akcije'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($semiProducts as $product): ?>
			<tr>
				<!--<td><?php //echo h($product['Product']['item_id']); ?>&nbsp;</td>-->
				<td><?php echo h($product['Item']['code']); ?>&nbsp;</td>
				<td><?php echo h($product['Item']['name']); ?>&nbsp;</td>
				<td><?php echo h($product['Item']['description']); ?>&nbsp;</td>
				<td><?php echo h($product['Item']['weight']); ?>&nbsp;</td>
				<td><?php echo h($product['SemiProduct']['semi_product_status']); ?>&nbsp;</td>
				<td>
					<?php
					if($product['SemiProduct']['service_production'] == 1){
						 echo "Da"; 
					} else {
						echo "Ne"; 
					}
					?>
					&nbsp;
				</td>
				<td class="actions">
					<?php echo $this->Html->link(__('Pogledaj'), array('action' => 'view', $product['SemiProduct']['id']), array('class' => 'button default')); ?>
					<?php echo $this->Html->link(__('Izmeni'), array('action' => 'save', $product['SemiProduct']['id']), array('class' => 'button default')); ?>
					<?php echo $this->Form->postLink(__('Obrisi'), array('action' => 'delete', $product['SemiProduct']['id']), array('class' => 'button default', 'confirm' => __('Da li ste sigurni da zelite da obrisete # %s?', $product['SemiProduct']['id']))); ?>
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
	<?php echo $this->Html->link(__('Novi poluproizvod'), array('action' => 'save'), array('class' => 'button default')); ?>
</div>
