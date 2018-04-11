<div class="consumables view">
	<h2><?php echo __('Potrosni materijal'); ?></h2>
	<dl>
		<dt><?php echo __('#'); ?></dt>
		<dd>
			<?php echo h($consumable['Consumable']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kod'); ?></dt>
		<dd>
			<?php echo h($consumable['Item']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ime'); ?></dt>
		<dd>
			<?php echo h($consumable['Item']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Opis'); ?></dt>
		<dd>
			<?php echo h($consumable['Item']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tezina'); ?></dt>
		<dd>
			<?php echo h($consumable['Item']['weight']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($consumable['Consumable']['consumable_status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rejting'); ?></dt>
		<dd>
			<?php echo h($consumable['Consumable']['recommended_rating']); ?>
			&nbsp;
		</dd>

		<dt><?php echo __('Kreirano'); ?></dt>
		<dd>
			<?php echo h($consumable['Consumable']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modifikovano'); ?></dt>
		<dd>
			<?php echo h($consumable['Consumable']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
	<div class="action">
		<?php echo $this->Html->link(__('Izmeni PM'), array('action' => 'edit', $consumable['Consumable']['id']), array('class' => 'button default')); ?>
		<?php echo $this->Form->postLink(__('Obrisi PM'), array('action' => 'delete', $consumable['Consumable']['id']), array('class' => 'button default', 'confirm' => __('Da li ste sigurni da zelite da obrisete # %s?', $consumable['Consumable']['id']))); ?> 
		<?php echo $this->Html->link(__('Lista PM'), array('action' => 'index'), array('class' => 'button default')); ?> 
		<?php echo $this->Html->link(__('Novi PM'), array('action' => 'save'), array('class' => 'button default')); ?> 
	</div>
</div>

