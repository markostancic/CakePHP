<div class="goods view">
	<h2><?php echo __('Roba'); ?></h2>
	<dl>
		<dt><?php echo __('#'); ?></dt>
		<dd>
			<?php echo h($good['Good']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kod'); ?></dt>
		<dd>
			<?php echo h($good['Item']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ime'); ?></dt>
		<dd>
			<?php echo h($good['Item']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Opis'); ?></dt>
		<dd>
			<?php echo h($good['Item']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tezina'); ?></dt>
		<dd>
			<?php echo h($good['Item']['weight']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pid'); ?></dt>
		<dd>
			<?php echo h($good['Good']['pid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hts Broj'); ?></dt>
		<dd>
			<?php echo h($good['HtsNumber']['hts_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Taksa'); ?></dt>
		<dd>
			<?php echo h($good['Tax']['tax']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Eccn'); ?></dt>
		<dd>
			<?php echo h($good['Good']['eccn']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Datum'); ?></dt>
		<dd>
			<?php echo h($good['Good']['release_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Za distribuitere'); ?></dt>
		<dd>
			<?php
			if($good['Good']['for_distributors'] == 1){
				 echo "Da"; 
			} else {
				echo "Ne"; 
			}
			?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($good['Good']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kreirano'); ?></dt>
		<dd>
			<?php echo h($good['Good']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modifikovano'); ?></dt>
		<dd>
			<?php echo h($good['Good']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
	<div class="action">
		<?php echo $this->Html->link(__('Izmeni robu'), array('action' => 'save', $good['Good']['id']), array('class' => 'button default')); ?>
		<?php echo $this->Form->postLink(__('Obrisi robu'), array('action' => 'delete', $good['Good']['id']), array('class' => 'button default', 'confirm' => __('Da li ste sigurni da zelite da obrisete # %s?', $good['Good']['id']))); ?>
		<?php echo $this->Html->link(__('Lista robe'), array('action' => 'index'), array('class' => 'button default')); ?>
		<?php echo $this->Html->link(__('Nova roba'), array('action' => 'save'), array('class' => 'button default')); ?>
	</div>
</div>

