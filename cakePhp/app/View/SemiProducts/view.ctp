<div class="products view">
	<h2><?php echo __('Poluproizvod'); ?></h2>
	<dl>
		<dt><?php echo __('#'); ?></dt>
		<dd>
			<?php echo h($semiProduct['SemiProduct']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kod'); ?></dt>
		<dd>
			<?php echo h($semiProduct['Item']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ime'); ?></dt>
		<dd>
			<?php echo h($semiProduct['Item']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Opis'); ?></dt>
		<dd>
			<?php echo h($semiProduct['Item']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tezina'); ?></dt>
		<dd>
			<?php echo h($semiProduct['Item']['weight']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($semiProduct['SemiProduct']['semi_product_status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Usluga proizvodnje'); ?></dt>
		<dd>
			<?php
			if($semiProduct['SemiProduct']['service_production'] == 1){
				 echo "Da"; 
			} else {
				echo "Ne"; 
			}
			?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kreirano'); ?></dt>
		<dd>
			<?php echo h($semiProduct['SemiProduct']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modifikovano'); ?></dt>
		<dd>
			<?php echo h($semiProduct['SemiProduct']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
	<div class="action">
		<?php echo $this->Html->link(__('Izmeni poluproizvod'), array('action' => 'save', $semiProduct['SemiProduct']['id']), array('class' => 'button default')); ?>
		<?php echo $this->Form->postLink(__('Obrisi poluproizvod'), array('action' => 'delete', $semiProduct['SemiProduct']['id']), array('class' => 'button default', 'confirm' => __('Da li ste sigurni da zelite da obrisete # %s?', $semiProduct['SemiProduct']['id']))); ?>
		<?php echo $this->Html->link(__('Lista poluproizvoda'), array('action' => 'index'), array('class' => 'button default')); ?>
		<?php echo $this->Html->link(__('Novi poluproizvod'), array('action' => 'save'), array('class' => 'button default')); ?>
	</div>
</div>
