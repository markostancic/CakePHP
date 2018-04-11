<div class="products view">
	<h2><?php echo __('Proizvod'); ?></h2>
	<dl>
		<dt><?php echo __('#'); ?></dt>
		<dd>
			<?php echo h($product['Product']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kod'); ?></dt>
		<dd>
			<?php echo h($product['Item']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ime'); ?></dt>
		<dd>
			<?php echo h($product['Item']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Opis'); ?></dt>
		<dd>
			<?php echo h($product['Item']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tezina'); ?></dt>
		<dd>
			<?php echo h($product['Item']['weight']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pid'); ?></dt>
		<dd>
			<?php echo h($product['Product']['pid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hts Broj'); ?></dt>
		<dd>
			<?php echo h($product['HtsNumber']['hts_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Taksa'); ?></dt>
		<dd>
			<?php echo h($product['Tax']['tax']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Eccn'); ?></dt>
		<dd>
			<?php echo h($product['Product']['product_eccn']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Datum'); ?></dt>
		<dd>
			<?php echo h($product['Product']['product_release_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Za distributere'); ?></dt>
		<dd>
			<?php
			if($product['Product']['for_distributors'] == 1){
				 echo "Da"; 
			} else {
				echo "Ne"; 
			}
			?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($product['Product']['product_status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Usluga proizvodnje'); ?></dt>
		<dd>
			<?php
			if($product['Product']['service_production'] == 1){
				 echo "Da"; 
			} else {
				echo "Ne"; 
			}
			?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kreirano'); ?></dt>
		<dd>
			<?php echo h($product['Product']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modifikovano'); ?></dt>
		<dd>
			<?php echo h($product['Product']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
	<div class="action">
			<?php echo $this->Html->link(__('Izmeni proizvod'), array('action' => 'save', $product['Product']['id']), array('class' => 'button default')); ?>
			<?php echo $this->Form->postLink(__('Obrisi proizvod'), array('action' => 'delete', $product['Product']['id']), array('class' => 'button default', 'confirm' => __('Da li ste sigurni da zelite da obrisete # %s?', $product['Product']['id']))); ?>
			<?php echo $this->Html->link(__('Lista proizvoda'), array('action' => 'index'), array('class' => 'button default')); ?>
			<?php echo $this->Html->link(__('Novi proizvod'), array('action' => 'save'), array('class' => 'button default')); ?>
	</div>
</div>
