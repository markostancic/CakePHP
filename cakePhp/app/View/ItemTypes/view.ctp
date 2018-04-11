<div class="itemTypes view">
	<h2><?php echo __('Tipovi'); ?></h2>
	<dl>
		<dt><?php echo __('#'); ?></dt>
		<dd>
			<?php echo h($itemType['ItemType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sifra'); ?></dt>
		<dd>
			<?php echo h($itemType['ItemType']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ime'); ?></dt>
		<dd>
			<?php echo h($itemType['ItemType']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Klasa'); ?></dt>
		<dd>
			<?php echo h($itemType['ItemType']['class']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Opipljiv'); ?></dt>
		<dd>
			<?php
			if($itemType['ItemType']['tangible'] == 1){
				 echo "Da"; 
			} else {
				echo "Ne"; 
			}
			?>
			&nbsp;
		</dd>
		<dt><?php echo __('Aktivan'); ?></dt>
		<dd>
			<?php
			if($itemType['ItemType']['active'] == 1){
				 echo "Da"; 
			} else {
				echo "Ne"; 
			}
			?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kreirano'); ?></dt>
		<dd>
			<?php echo h($itemType['ItemType']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modifikovano'); ?></dt>
		<dd>
			<?php echo h($itemType['ItemType']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="action">
	<?php echo $this->Html->link(__('Izmeni tip'), array('action' => 'edit', $itemType['ItemType']['id']), array('class' => 'button default')); ?>
	<?php echo $this->Form->postLink(__('Obrisi tip'), array('action' => 'delete', $itemType['ItemType']['id']), array('class' => 'button default', 'confirm' => __('Da li ste sigurni da zelite da obrisete # %s?', $itemType['ItemType']['id']))); ?>
	<?php echo $this->Html->link(__('Lista tipova'), array('action' => 'index'), array('class' => 'button default')); ?>
	<?php echo $this->Html->link(__('Dodaj novi tip'), array('action' => 'add'), array('class' => 'button default')); ?>
</div>
