<div class="materials view">
	<h2><?php echo __('Material'); ?></h2>
	<dl>
		<dt><?php echo __('#'); ?></dt>
		<dd>
			<?php echo h($material['Material']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kod'); ?></dt>
		<dd>
			<?php echo h($material['Item']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ime'); ?></dt>
		<dd>
			<?php echo h($material['Item']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Opis'); ?></dt>
		<dd>
			<?php echo h($material['Item']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tezina'); ?></dt>
		<dd>
			<?php echo h($material['Item']['weight']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($material['Material']['material_status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rejting'); ?></dt>
		<dd>
			<?php echo h($material['Material']['recommended_rating']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Usluga proizvodnje'); ?></dt>
		<dd>
			<?php
			if($material['Material']['service_production'] == 1){
				 echo "Da"; 
			} else {
				echo "Ne"; 
			}
			?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kreirano'); ?></dt>
		<dd>
			<?php echo h($material['Material']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modifikovano'); ?></dt>
		<dd>
			<?php echo h($material['Material']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="action">
	<?php echo $this->Html->link(__('Izmeni materijal'), array('action' => 'save', $material['Material']['id']), array('class' => 'button default')); ?>
	<?php echo $this->Form->postLink(__('Obrisi materijal'), array('action' => 'delete', $material['Material']['id']), array('class' => 'button default', 'confirm' => __('Da li ste sigurni da zelite da obrisete # %s?', $material['Material']['id']))); ?>
	<?php echo $this->Html->link(__('Lista materijala'), array('action' => 'index'), array('class' => 'button default')); ?>
	<?php echo $this->Html->link(__('Novi materijal'), array('action' => 'save'), array('class' => 'button default')); ?>
</div>
