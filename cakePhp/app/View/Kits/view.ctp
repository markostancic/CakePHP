<div class="kits view">
	<h2><?php echo __('Kit'); ?></h2>
	<dl>
		<dt><?php echo __('#'); ?></dt>
		<dd>
			<?php echo h($kit['Kit']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kod'); ?></dt>
		<dd>
			<?php echo h($kit['Item']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ime'); ?></dt>
		<dd>
			<?php echo h($kit['Item']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Opis'); ?></dt>
		<dd>
			<?php echo h($kit['Item']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tezina'); ?></dt>
		<dd>
			<?php echo h($kit['Item']['weight']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pid'); ?></dt>
		<dd>
			<?php echo h($kit['Kit']['pid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hts Broj'); ?></dt>
		<dd>
			<?php echo h($kit['HtsNumber']['hts_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Taksa'); ?></dt>
		<dd>
			<?php echo h($kit['Tax']['tax']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Eccn'); ?></dt>
		<dd>
			<?php echo h($kit['Kit']['eccn']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Datum'); ?></dt>
		<dd>
			<?php echo h($kit['Kit']['release_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Za distributere'); ?></dt>
		<dd>
			<?php
			if($kit['Kit']['for_distributors'] == 1){
				 echo "Da"; 
			} else {
				echo "Ne"; 
			}
			?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($kit['Kit']['kit_status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kreirano'); ?></dt>
		<dd>
			<?php echo h($kit['Kit']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modifikovano'); ?></dt>
		<dd>
			<?php echo h($kit['Kit']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
	<div class="action">
	<?php echo $this->Html->link(__('Izmeni kit'), array('action' => 'save', $kit['Kit']['id']), array('class' => 'button default')); ?>
	<?php echo $this->Form->postLink(__('Obrisi kit'), array('action' => 'delete', $kit['Kit']['id']), array('class' => 'button default', 'confirm' => __('Da li ste sigurni da zelite da obrisete # %s?', $kit['Kit']['id']))); ?>
	<?php echo $this->Html->link(__('Lista kitova'), array('action' => 'index'), array('class' => 'button default')); ?>
	<?php echo $this->Html->link(__('Novi kit'), array('action' => 'save'), array('class' => 'button default')); ?>
	</div>
</div>

