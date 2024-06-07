<?php
	require 'conn.php';
	$totalcustomer = 0;
	$totalincome=0;
	$totalpackage=0;
	$totalextcharges=0;
	$totalamountpaid=0;
	if(ISSET($_POST['search'])){
		$date1 = date("Y-m-d", strtotime($_POST['date1']));
		$date2 = date("Y-m-d", strtotime($_POST['date2']));
		$query=mysqli_query($conn, "SELECT * FROM `resdetails` WHERE date(`dateuploaded`) BETWEEN '$date1' AND '$date2'") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
				$totalcustomer ++;
				$totalpackage += intval($fetch['paymentamount']);
				$totalextcharges += intval($fetch['extcharge_total']);
				$totalincome += intval($fetch['paymentamount'])+intval($fetch['extcharge_total']);
				
?>
	<tr>
		<td><?php echo $fetch['res_id']?></td>
		<td><?php echo $fetch['fname']?></td>
		<td><?php echo $fetch['lname']?></td>
		<td><?php echo $fetch['rate_id']?></td>
		<td><?php echo $fetch['paymentamount']?></td>
		<td><?php echo $fetch['extcharge_total']?></td>
		<td><?php echo intval($fetch['paymentamount']) + intval($fetch['extcharge_total']) ?></td>
		<td><?php echo $fetch['date']?></td>
		<td><?php echo $fetch['dateuploaded']?></td>
		<td> ASD </td>
	</tr>
<?php
			}
		}else{
			echo'
			<tr>
				<td colspan = "9"><center>Record Not Found</center></td>
			</tr>';
		}
	}else{
		$query=mysqli_query($conn, "SELECT * FROM `resdetails`") or die(mysqli_error());
		
		while($fetch=mysqli_fetch_array($query)){
			$totalcustomer ++;
			$totalincome += intval($fetch['paymentamount']) + intval($fetch['extcharge_total']);
			$totalpackage += intval($fetch['paymentamount']);
			$totalextcharges += intval($fetch['extcharge_total']);

?>
	<tr>
		<td><?php echo $fetch['res_id']?></td>
		<td><?php echo $fetch['fname']?></td>
		<td><?php echo $fetch['lname']?></td>
		<td><?php echo $fetch['rate_id']?></td>
		<td><?php echo $fetch['paymentamount']?></td>
		<td><?php echo $fetch['extcharge_total']?></td>
		<td><?php echo intval($fetch['paymentamount']) + intval($fetch['extcharge_total']) ?></td>
		<td><?php echo $fetch['date']?></td>
		<td><?php echo $fetch['dateuploaded']?></td>
		<td> asd </td>
	</tr>
	</tbody>
	
<?php
		} 
}
?>
						
