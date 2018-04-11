<div class="htsNumbers view">
	<h2><?php echo __('Hts broj'); ?></h2>
	<dl>
		<dt><?php echo __('#'); ?></dt>
		<dd>
			<?php echo h($htsNumber['HtsNumber']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hts broj'); ?></dt>
		<dd>
			<?php echo h($htsNumber['HtsNumber']['hts_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kreirano'); ?></dt>
		<dd>
			<?php echo h($htsNumber['HtsNumber']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modifikovano'); ?></dt>
		<dd>
			<?php echo h($htsNumber['HtsNumber']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="row container btn-group action">
	<?php echo $this->Html->link(__('Izmeni Hts broj'), array('action' => 'edit', $htsNumber['HtsNumber']['id']), array('class' => 'button default')); ?>
	<?php echo $this->Form->postLink(__('Obrisi Hts broj'), array('action' => 'delete', $htsNumber['HtsNumber']['id']), array('class' => 'button default','confirm' => __('Da li ste sigurni da zelite da obrisete # %s?', $htsNumber['HtsNumber']['id']))); ?>
	<?php echo $this->Html->link(__('Lista Hts brojeva'), array('action' => 'index'), array('class' => 'button default')); ?>
	<?php echo $this->Html->link(__('Dodaj novi Hts broj'), array('action' => 'add'), array('class' => 'button default')); ?> 
</div>
