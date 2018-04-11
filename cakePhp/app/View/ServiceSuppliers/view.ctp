<div class="serviceSuppliers view">
	<h2><?php echo __('Usluga dobavljaca'); ?></h2>
	<dl>
		<dt><?php echo __('#'); ?></dt>
		<dd>
			<?php echo h($serviceSupplier['ServiceSupplier']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kod'); ?></dt>
		<dd>
			<?php echo h($serviceSupplier['Item']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ime'); ?></dt>
		<dd>
			<?php echo h($serviceSupplier['Item']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Opis'); ?></dt>
		<dd>
			<?php echo h($serviceSupplier['Item']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tezina'); ?></dt>
		<dd>
			<?php echo h($serviceSupplier['Item']['weight']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($serviceSupplier['ServiceSupplier']['service_status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rejting'); ?></dt>
		<dd>
			<?php echo h($serviceSupplier['ServiceSupplier']['service_rating']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kreirano'); ?></dt>
		<dd>
			<?php echo h($serviceSupplier['ServiceSupplier']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modifikovano'); ?></dt>
		<dd>
			<?php echo h($serviceSupplier['ServiceSupplier']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
	<div class="action">
		<?php echo $this->Html->link(__('Izmeni uslugu dobavljaca'), array('action' => 'save', $serviceSupplier['ServiceSupplier']['id']), array('class' => 'button default')); ?>
		<?php echo $this->Form->postLink(__('Obrisi uslugu dobavljaca'), array('action' => 'delete', $serviceSupplier['ServiceSupplier']['id']), array('class' => 'button default', 'confirm' => __('Da li ste sigurni da zelite da obrisete # %s?', $serviceSupplier['ServiceSupplier']['id'])), array('class' => 'button default')); ?> 
		<?php echo $this->Html->link(__('Lista usluge dobavljaca'), array('action' => 'index'), array('class' => 'button default')); ?>
		<?php echo $this->Html->link(__('Nova usluga dobavljaca	'), array('action' => 'save'), array('class' => 'button default')); ?>
	</div>
</div>

