<?php
$pdf->SetTopMargin(30);
 
$pdf->setFooterMargin(25);
$pdf->SetAutoPageBreak(true, 25);  
 
$textfont = 'freesans';
$pdf->SetFont($textfont,'B', 20);
$pdf->SetKeywords('ServiceProduct');
// add a page (required with recent versions of tcpdf) 
$pdf->AddPage(); 
$pdf->SetXY(0, 40);
 
$pdf->Cell(0,0, "Kartica Artikla - Repromaterijal", 0,1,'C');

$pdf->SetY(60);
$pdf->SetFont($textfont,'R', 10); 
$html = '<table border="1">
			<thead>
				<tr>
					<th>&nbsp;Kod</th>
					<th>&nbsp;Ime</th>
					<th>&nbsp;Opis</th>
					<th>&nbsp;Tezina</th>
					<th>&nbsp;Pid</th>
					<th>&nbsp;Hts Broj</th>
					<th>&nbsp;Takse</th>
					<th>&nbsp;Eccn</th>
					<th>&nbsp;Datum</th>
					<th>&nbsp;Za distributere</th>
					<th>&nbsp;Status</th>
				</tr>
			</thead>';
	foreach ($serviceProducts as $serviceProduct){ 
	$html.= '<tr>
				<td>&nbsp;'. $serviceProduct['Item']['code']. '&nbsp;</td>
				<td>&nbsp;'. $serviceProduct['Item']['name']. '&nbsp;</td>
				<td>&nbsp;'. $serviceProduct['Item']['description']. '&nbsp;</td>
				<td>&nbsp;'. $serviceProduct['Item']['weight']. '&nbsp;</td>
				<td>&nbsp;'. $serviceProduct['ServiceProduct']['pid'] .'&nbsp;</td>
				<td>&nbsp;'. $serviceProduct['HtsNumber']['hts_number']. '&nbsp;</td>
				<td>&nbsp;'. $serviceProduct['Tax']['tax'].' &nbsp;</td>
				<td>&nbsp;'. $serviceProduct['ServiceProduct']['eccn'].'&nbsp;</td>
				<td>&nbsp;'. $serviceProduct['ServiceProduct']['release_date'] . '&nbsp;</td>
				<td>&nbsp;'. $serviceProduct['ServiceProduct']['for_distributors']. '&nbsp;</td>
				<td>&nbsp;'. $serviceProduct['ServiceProduct']['service_status'] .'&nbsp;</td>
			</tr>';
 }
$html .= '</table>'; 
$pdf->writeHTML($html, true, false, true, false, '');
 
//Generate pdf file      
$filename .= '.pdf';
$pdf->Output('test.pdf', 'D');
?>