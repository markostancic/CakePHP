<div class="serviceProducts view">
	<h2><?php echo __('Usluga'); ?></h2>
	<dl>
		<dt><?php echo __('#'); ?></dt>
		<dd>
			<?php echo h($serviceProduct['ServiceProduct']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kod'); ?></dt>
		<dd>
			<?php echo h($serviceProduct['Item']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ime'); ?></dt>
		<dd>
			<?php echo h($serviceProduct['Item']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Opis'); ?></dt>
		<dd>
			<?php echo h($serviceProduct['Item']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tezina'); ?></dt>
		<dd>
			<?php echo h($serviceProduct['Item']['weight']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pid'); ?></dt>
		<dd>
			<?php echo h($serviceProduct['ServiceProduct']['pid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hts Broj'); ?></dt>
		<dd>
			<?php echo h($serviceProduct['HtsNumber']['hts_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Taksa'); ?></dt>
		<dd>
			<?php echo h($serviceProduct['Tax']['tax']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Eccn'); ?></dt>
		<dd>
			<?php echo h($serviceProduct['ServiceProduct']['eccn']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Datum'); ?></dt>
		<dd>
			<?php echo h($serviceProduct['ServiceProduct']['release_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Za distributere'); ?></dt>
		<dd>
			<?php
			if($serviceProduct['ServiceProduct']['for_distributors'] == 1){
				 echo "Da"; 
			} else {
				echo "Ne"; 
			}
			?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($serviceProduct['ServiceProduct']['service_status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kreirano'); ?></dt>
		<dd>
			<?php echo h($serviceProduct['ServiceProduct']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modifikovano'); ?></dt>
		<dd>
			<?php echo h($serviceProduct['ServiceProduct']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
	<div class="action">
		<?php echo $this->Html->link(__('Izmeni uslugu'), array('action' => 'save', $serviceProduct['ServiceProduct']['id']), array('class' => 'button default')); ?> <?php echo $this->Form->postLink(__('Obrisi uslugu'), array('action' => 'delete', $serviceProduct['ServiceProduct']['id']), array('class' => 'button default', 'confirm' => __('Da li ste sigurni da zelite da obrisete # %s?', $serviceProduct['ServiceProduct']['id']))); ?>
		<?php echo $this->Html->link(__('Lista usluga'), array('action' => 'index'), array('class' => 'button default')); ?>
		<?php echo $this->Html->link(__('Nova usluga'), array('action' => 'save'), array('class' => 'button default')); ?>
	</div>
</div>

