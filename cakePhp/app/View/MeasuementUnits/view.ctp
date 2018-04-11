<div class="measuementUnits view">
	<h2><?php echo __('Jedinice mere'); ?></h2>
	<dl>
		<dt><?php echo __('#'); ?></dt>
		<dd>
			<?php echo h($measuementUnit['MeasuementUnit']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ime'); ?></dt>
		<dd>
			<?php echo h($measuementUnit['MeasuementUnit']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Simbol'); ?></dt>
		<dd>
			<?php echo h($measuementUnit['MeasuementUnit']['symbol']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Aktivno'); ?></dt>
		<dd>
			<?php
			if($measuementUnit['MeasuementUnit']['active'] == 1){
				 echo "Da"; 
			} else {
				echo "Ne"; 
			}
			?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kreirano'); ?></dt>
		<dd>
			<?php echo h($measuementUnit['MeasuementUnit']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modifikovano'); ?></dt>
		<dd>
			<?php echo h($measuementUnit['MeasuementUnit']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="action">
	<?php echo $this->Html->link(__('Izmeni jedinicu mere'), array('action' => 'edit', $measuementUnit['MeasuementUnit']['id']), array('class' => 'button default')); ?>
	<?php echo $this->Form->postLink(__('Obrisi jedinicu mere'), array('action' => 'delete', $measuementUnit['MeasuementUnit']['id']), array('class' => 'button default', 'confirm' => __('Da li ste sigurni da zelite da obrisete # %s?', $measuementUnit['MeasuementUnit']['id']))); ?>
	<?php echo $this->Html->link(__('Lista jedinice mere'), array('action' => 'index'), array('class' => 'button default')); ?>
	<?php echo $this->Html->link(__('Dodaj novu jedinicu mere'), array('action' => 'add'), array('class' => 'button default')); ?>
</div>
