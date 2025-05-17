<?php
include 'db_connect.php';
if (!isset($_POST['id'])) {
	echo "No data found.";
	exit;
}
$id = intval($_POST['id']);
$qry = $conn->query("SELECT * FROM borrowers WHERE id = $id");
if (!$qry || $qry->num_rows == 0) {
	echo "No data found.";
	exit;
}
$row = $qry->fetch_assoc();
?>
<table class="table table-bordered">
	<tr><th>ID</th><td><?php echo $row['id']; ?></td></tr>
	<tr><th>Name</th><td><?php echo ucwords($row['lastname'].", ".$row['firstname'].' '.$row['middlename']); ?></td></tr>
	<tr><th>Address</th><td><?php echo $row['address']; ?></td></tr>
	<tr><th>Contact #</th><td><?php echo $row['contact_no']; ?></td></tr>
	<tr><th>Email</th><td><?php echo $row['email']; ?></td></tr>
	<tr><th>Tax ID</th><td><?php echo $row['tax_id']; ?></td></tr>
	<tr><th>LIMIT_BAL</th><td><?php echo $row['LIMIT_BAL']; ?></td></tr>
	<tr><th>SEX</th><td><?php echo $row['SEX']; ?></td></tr>
	<tr><th>EDUCATION</th><td><?php echo $row['EDUCATION']; ?></td></tr>
	<tr><th>MARRIAGE</th><td><?php echo $row['MARRIAGE']; ?></td></tr>
	<tr><th>AGE</th><td><?php echo $row['AGE']; ?></td></tr>
	<?php if(!isset($_SESSION['login_type']) || $_SESSION['login_type'] != 2): ?>
	<tr><th>PAY_0</th><td><?php echo $row['PAY_0']; ?></td></tr>
	<tr><th>PAY_2</th><td><?php echo $row['PAY_2']; ?></td></tr>
	<tr><th>PAY_3</th><td><?php echo $row['PAY_3']; ?></td></tr>
	<tr><th>PAY_4</th><td><?php echo $row['PAY_4']; ?></td></tr>
	<tr><th>PAY_5</th><td><?php echo $row['PAY_5']; ?></td></tr>
	<tr><th>PAY_6</th><td><?php echo $row['PAY_6']; ?></td></tr>
	<tr><th>BILL_AMT1</th><td><?php echo $row['BILL_AMT1']; ?></td></tr>
	<tr><th>BILL_AMT2</th><td><?php echo $row['BILL_AMT2']; ?></td></tr>
	<tr><th>BILL_AMT3</th><td><?php echo $row['BILL_AMT3']; ?></td></tr>
	<tr><th>BILL_AMT4</th><td><?php echo $row['BILL_AMT4']; ?></td></tr>
	<tr><th>BILL_AMT5</th><td><?php echo $row['BILL_AMT5']; ?></td></tr>
	<tr><th>BILL_AMT6</th><td><?php echo $row['BILL_AMT6']; ?></td></tr>
	<tr><th>PAY_AMT1</th><td><?php echo $row['PAY_AMT1']; ?></td></tr>
	<tr><th>PAY_AMT2</th><td><?php echo $row['PAY_AMT2']; ?></td></tr>
	<tr><th>PAY_AMT3</th><td><?php echo $row['PAY_AMT3']; ?></td></tr>
	<tr><th>PAY_AMT4</th><td><?php echo $row['PAY_AMT4']; ?></td></tr>
	<tr><th>PAY_AMT5</th><td><?php echo $row['PAY_AMT5']; ?></td></tr>
	<tr><th>PAY_AMT6</th><td><?php echo $row['PAY_AMT6']; ?></td></tr>
	<?php endif; ?>
</table>
