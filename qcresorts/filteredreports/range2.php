<?php
	require 'conn.php';

	if(ISSET($_POST['search'])){
		$date1 = date("Y-m-d", strtotime($_POST['date1']));
		$date2 = date("Y-m-d", strtotime($_POST['date2']));
		$query=mysqli_query($conn, "SELECT poolrates.ratename,rate_id,resdetails.dateuploaded, COUNT(rate_id) as total, SUM(resdetails.paymentamount) as sum 
        FROM resdetails 
        LEFT JOIN poolrates
		ON resdetails.rate_id=poolrates.rateid
        WHERE date(`dateuploaded`) BETWEEN '$date1' AND '$date2'
        GROUP BY resdetails.rate_id;") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td><?php echo $fetch['ratename']?></td>
		<td><?php echo $fetch['total']?></td>
		<td><?php echo $fetch['sum']?></td>

	</tr>
<?php
			}
		}else{
			echo'
			<tr>
				<td colspan = "3"><center>Record Not Found</center></td>
			</tr>';
		}
	}else{
		$query=mysqli_query($conn, "SELECT poolrates.ratename,rate_id,resdetails.dateuploaded, COUNT(rate_id) as total, SUM(resdetails.paymentamount) as sum 
        FROM resdetails 
        LEFT JOIN poolrates
        ON resdetails.rate_id=poolrates.rateid
        GROUP BY resdetails.rate_id;") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
?>
		<tr>
			<td><?php echo $fetch['ratename']?></td>
			<td><?php echo $fetch['total']?></td>
			<td><?php echo $fetch['sum']?></td>

		</tr>
		</tbody>
<?php
		} 
}
?>
						
