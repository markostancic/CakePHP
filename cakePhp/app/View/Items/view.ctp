<div class="items view">
	<h2><?php echo __('Artikal'); ?></h2>
	<dl>
		<dt><?php echo __('#'); ?></dt>
		<dd>
			<?php echo h($item['Item']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kod'); ?></dt>
		<dd>
			<?php echo h($item['Item']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ime'); ?></dt>
		<dd>
			<?php echo h($item['Item']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Opis'); ?></dt>
		<dd>
			<?php echo h($item['Item']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tezina'); ?></dt>
		<dd>
			<?php echo h($item['Item']['weight']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Merna jedinica'); ?></dt>
		<dd>
			<?php echo h($item['MeasuementUnit']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tip'); ?></dt>
		<dd>
			<?php echo h($item['ItemType']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Obrisano'); ?></dt>
		<dd>
			<?php
				if($item['Item']['deleted'] == 1){
					 echo "Da"; 
				} else {
					echo "Ne"; 
				}
				?>
				&nbsp;
		</dd>
		<dt><?php echo __('Kreirano'); ?></dt>
		<dd>
			<?php echo h($item['Item']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modifikovano'); ?></dt>
		<dd>
			<?php echo h($item['Item']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="action">
		<?php echo $this->Form->postLink(__('Obrisi artikal'), array('action' => 'delete', $item['Item']['id']), array('class' => 'button default', 'confirm' => __('Da li ste sigurni da zelite da obrisete # %s?', $item['Item']['id']))); ?>
		<?php echo $this->Html->link(__('Lista artikala'), array('action' => 'index'), array('class' => 'button default')); ?>
</div>
