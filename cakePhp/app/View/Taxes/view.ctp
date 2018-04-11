<div class="taxes view">
	<h2><?php echo __('Tax'); ?></h2>
	<dl>
		<dt><?php echo __('#'); ?></dt>
		<dd>
			<?php echo h($tax['Tax']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Porez'); ?></dt>
		<dd>
			<?php echo h($tax['Tax']['tax'] . '%'); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kreirano'); ?></dt>
		<dd>
			<?php echo h($tax['Tax']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modifikovano'); ?></dt>
		<dd>
			<?php echo h($tax['Tax']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="action">
	<?php echo $this->Html->link(__('Izmeni porez'), array('action' => 'edit', $tax['Tax']['id']), array('class' => 'button default')); ?> </li>
	<?php echo $this->Form->postLink(__('Obrisi porez'), array('action' => 'delete', $tax['Tax']['id']), array('class' => 'button default', 'confirm' => __('Da li ste sigurni da zelite da obrisete # %s?', $tax['Tax']['id']))); ?>
	<?php echo $this->Html->link(__('Lista svih porez'), array('action' => 'index'), array('class' => 'button default')); ?>
	<?php echo $this->Html->link(__('Dodaj novi porez'), array('action' => 'add'), array('class' => 'button default')); ?>
</div>
