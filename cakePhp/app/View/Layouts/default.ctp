<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'Robno-Materijalno');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		
		echo $this->Html->css('http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css', false);
		echo $this->Html->css('kickstart');
		echo $this->Html->css('style');
		echo $this->Html->script('https://code.jquery.com/jquery-1.12.4.js', false);
		echo $this->Html->script('https://code.jquery.com/ui/1.12.1/jquery-ui.js', false);
		echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', false);
		echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js', false);
		//echo $this->Html->script('jquery');
		echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
		echo $this->Html->script('kickstart');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');

	?>
</head>
<body>	
		<!-- Menu Horizontal -->
		<ul class="menu">
		<li><?php echo $this->Html->link(__('Tipovi'), array('controller' => 'itemTypes', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Artikli'), array('controller' => 'items', 'action' => 'index')); ?>
			<ul>
				<li><?php echo $this->Html->link(__('Repromaterijal'), array('controller' => 'materials', 'action' => 'index')); ?></li>
		      	<li><?php echo $this->Html->link(__('Poluproizvod'), array('controller' => 'semiProducts', 'action' => 'index')); ?></li>
		      	<li><?php echo $this->Html->link(__('Proizvod'), array('controller' => 'products', 'action' => 'index')); ?></li>
		      	<li><?php echo $this->Html->link(__('Roba'), array('controller' => 'goods', 'action' => 'index')); ?></li>
		      	<li><?php echo $this->Html->link(__('Kit'), array('controller' => 'kits', 'action' => 'index')); ?></li>
		      	<li><?php echo $this->Html->link(__('Potrosni materijal'), array('controller' => 'consumables', 'action' => 'index')); ?></li>
		      	<li><?php echo $this->Html->link(__('Inventar'), array('controller' => 'inventories', 'action' => 'index')); ?></li>
		      	<li><?php echo $this->Html->link(__('Usluga'), array('controller' => 'serviceProducts', 'action' => 'index')); ?></li>
		      	<li><?php echo $this->Html->link(__('Usluga dobavljaca'), array('controller' => 'serviceSuppliers', 'action' => 'index')); ?></li>
			</ul>
		</li>
		<li><?php echo $this->Html->link(__('Hts Broj'), array('controller' => 'htsNumbers', 'action' => 'index')); ?></li>
      	<li><?php echo $this->Html->link(__('Takse'), array('controller' => 'taxes', 'action' => 'index')); ?></li>
      	<li><?php echo $this->Html->link(__('Merna jedinica'), array('controller' => 'measuementUnits', 'action' => 'index')); ?></li>
		</ul>
		
		<div id="content">

			<?php echo $this->Flash->render(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>

		<div id="footer">

		</div>
	</div>
	
</body>
</html>
