<?php 
 
$objExcel->setActiveSheetIndex(0);

// Add some data
$objExcel->getActiveSheet()->mergeCells("A1:L1");
$objExcel->getActiveSheet()->setCellValue("A1", "Izvoz");
$objExcel->getActiveSheet()->getStyle("A1")->getFont()->setSize(25); 
?>
<table border="1">
	<thead>
		<tr>
			<th>&nbsp;Kod</th>
			<th>&nbsp;Ime</th>
			<th>&nbsp;Opis</th>
			<th>&nbsp;Trzina</th>
			<th>&nbsp;Pid</th>
			<th>&nbsp;Hts Broj</th>
			<th>&nbsp;Takse</th>
			<th>&nbsp;Eccn</th>
			<th>&nbsp;Datum</th>
			<th>&nbsp;Status</th>
			<th>&nbsp;Za distributere</th>
		</tr>
	</thead> 
<?php
foreach ($goods as $good) { ?>
	<tr>
		<td><?php echo h($good['Item']['code']); ?>&nbsp;</td>
			<td><?php echo h($good['Item']['name']); ?>&nbsp;</td>
			<td><?php echo h($good['Item']['description']); ?>&nbsp;</td>
			<td><?php echo h($good['Item']['weight']); ?>&nbsp;</td>
			<td><?php echo h($good['Good']['pid']); ?>&nbsp;</td>
			<td><?php echo h($good['HtsNumber']['hts_number']); ?>&nbsp;</td>
			<?php if(!empty($good['Tax']['tax'])): ?>
			<td><?php echo h($good['Tax']['tax'].'%'); ?>&nbsp;</td>
			<?php else: ?>
			<td><?php echo h($good['Tax']['tax']); ?>&nbsp;</td>
			<?php endif; ?>
			<td><?php echo h($good['Good']['eccn']); ?>&nbsp;</td>
			<td><?php echo h($good['Good']['release_date']); ?>&nbsp;</td>
			<td><?php echo h($good['Good']['status']); ?>&nbsp;</td>
			<td>
				<?php
				if($good['Good']['for_distributors'] == 1){
					 echo "Da"; 
				} else {
					echo "Ne"; 
				}
				?>
				&nbsp;
			</td>
		</tr> 
	<?php 
}
?>
</table>
<?php

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objExcel->setActiveSheetIndex(0);

$objExcelWriter->save("php://output");

?>