<div class="inventories view">
	<h2><?php echo __('Inventar'); ?></h2>
	<dl>
		<dt><?php echo __('#'); ?></dt>
		<dd>
			<?php echo h($inventory['Inventory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kod'); ?></dt>
		<dd>
			<?php echo h($inventory['Item']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ime'); ?></dt>
		<dd>
			<?php echo h($inventory['Item']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Opis'); ?></dt>
		<dd>
			<?php echo h($inventory['Item']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tezina'); ?></dt>
		<dd>
			<?php echo h($inventory['Item']['weight']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($inventory['Inventory']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rejting'); ?></dt>
		<dd>
			<?php echo h($inventory['Inventory']['recommended_rating']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kreirano'); ?></dt>
		<dd>
			<?php echo h($inventory['Inventory']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modifikovano'); ?></dt>
		<dd>
			<?php echo h($inventory['Inventory']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
	<div class="action">
		<?php echo $this->Html->link(__('Izmeni inventar'), array('action' => 'save', $inventory['Inventory']['id']), array('class' => 'button default')); ?> 
		<?php echo $this->Form->postLink(__('Obrisi inventar'), array('action' => 'delete', $inventory['Inventory']['id']), array('class' => 'button default', 'confirm' => __('Da li ste sigurni da zelite da obriste # %s?', $inventory['Inventory']['id']))); ?>
		<?php echo $this->Html->link(__('Lista inventara'), array('action' => 'index'), array('class' => 'button default')); ?>
		<?php echo $this->Html->link(__('Novi inventar'), array('action' => 'save'), array('class' => 'button default')); ?>
	</div>
</div>

