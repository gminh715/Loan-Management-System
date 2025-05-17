<?php include 'db_connect.php' ?>
<?php 

if(isset($_GET['id'])){
	// Nếu là staff, chỉ cho phép xem/sửa borrower ứng với user[x] => borrower id[x-1]
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] == 2 && isset($_SESSION['login_id'])) {
		$expected_borrower_id = intval($_SESSION['login_id']) - 1;
		if($_GET['id'] != $expected_borrower_id) {
			echo "<div class='alert alert-danger'>Permission denied.</div>";
			exit;
		}
	}
	$qry = $conn->query("SELECT * FROM borrowers where id=".$_GET['id']);
	foreach($qry->fetch_array() as $k => $val){
		$$k = $val;
	}
}

?>
<div class="container-fluid">
	<div class="col-lg-12">
		<form id="manage-borrower">
			<!-- Add ID input field -->
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="" class="control-label">ID</label>
						<input name="id" class="form-control" required=""
							value="<?php echo isset($id) ? $id : '' ?>"
							<?php echo isset($id) && $id !== '' ? 'readonly' : '' ?>>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="" class="control-label">Last Name</label>
						<input name="lastname" class="form-control" required="" value="<?php echo isset($lastname) ? $lastname : '' ?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">First Name</label>
						<input name="firstname" class="form-control" required="" value="<?php echo isset($firstname) ? $firstname : '' ?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Middle Name</label>
						<input name="middlename" class="form-control" value="<?php echo isset($middlename) ? $middlename : '' ?>">
					</div>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-6">
							<label for="">Address</label>
							<textarea name="address" id="" cols="30" rows="2" class="form-control" required=""><?php echo isset($address) ? $address : '' ?></textarea>
				</div>
				<div class="col-md-5">
					<div class="">
						<label for="">Contact #</label>
						<input type="text" class="form-control" name="contact_no" value="<?php echo isset($contact_no) ? $contact_no : '' ?>">
					</div>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-6">
							<label for="">Email</label>
							<input type="email" class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>">
				</div>
				<div class="col-md-5">
					<div class="">
						<label for="">Tax ID</label>
						<input type="text" class="form-control" name="tax_id" value="<?php echo isset($tax_id) ? $tax_id : '' ?>">
					</div>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-4">
					<label for="">LIMIT_BAL</label>
					<input type="number" class="form-control" name="LIMIT_BAL" value="<?php echo isset($LIMIT_BAL) ? $LIMIT_BAL : '' ?>">
				</div>
				<div class="col-md-4">
					<label for="">SEX</label>
					<select class="form-control" name="SEX">
						<option value="">Select</option>
						<option value="1" <?php if(isset($SEX) && $SEX==1) echo 'selected'; ?>>Male</option>
						<option value="2" <?php if(isset($SEX) && $SEX==2) echo 'selected'; ?>>Female</option>
					</select>
				</div>
				<div class="col-md-4">
					<label for="">EDUCATION</label>
					<select class="form-control" name="EDUCATION">
						<option value="">Select</option>
						<option value="1" <?php if(isset($EDUCATION) && $EDUCATION==1) echo 'selected'; ?>>Graduate School</option>
						<option value="2" <?php if(isset($EDUCATION) && $EDUCATION==2) echo 'selected'; ?>>University</option>
						<option value="3" <?php if(isset($EDUCATION) && $EDUCATION==3) echo 'selected'; ?>>High School</option>
						<option value="4" <?php if(isset($EDUCATION) && $EDUCATION==4) echo 'selected'; ?>>Others</option>
						<option value="5" <?php if(isset($EDUCATION) && $EDUCATION==5) echo 'selected'; ?>>Unknown</option>
						<option value="6" <?php if(isset($EDUCATION) && $EDUCATION==6) echo 'selected'; ?>>Unknown</option>
					</select>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-4">
					<label for="">MARRIAGE</label>
					<select class="form-control" name="MARRIAGE">
						<option value="">Select</option>
						<option value="1" <?php if(isset($MARRIAGE) && $MARRIAGE==1) echo 'selected'; ?>>Married</option>
						<option value="2" <?php if(isset($MARRIAGE) && $MARRIAGE==2) echo 'selected'; ?>>Single</option>
						<option value="3" <?php if(isset($MARRIAGE) && $MARRIAGE==3) echo 'selected'; ?>>Others</option>
					</select>
				</div>
				<div class="col-md-4">
					<label for="">AGE</label>
					<input type="number" class="form-control" name="AGE" value="<?php echo isset($AGE) ? $AGE : '' ?>">
				</div>
				<?php if(!isset($_SESSION['login_type']) || $_SESSION['login_type'] != 2): ?>
				<div class="col-md-4">
					<label for="">PAY_0</label>
					<input type="number" class="form-control" name="PAY_0" value="<?php echo isset($PAY_0) ? $PAY_0 : '' ?>">
				</div>
				<?php endif; ?>
			</div>
			<?php if(!isset($_SESSION['login_type']) || $_SESSION['login_type'] != 2): ?>
			<div class="row form-group">
				<div class="col-md-2">
					<label for="">PAY_2</label>
					<input type="number" class="form-control" name="PAY_2" value="<?php echo isset($PAY_2) ? $PAY_2 : '' ?>">
				</div>
				<div class="col-md-2">
					<label for="">PAY_3</label>
					<input type="number" class="form-control" name="PAY_3" value="<?php echo isset($PAY_3) ? $PAY_3 : '' ?>">
				</div>
				<div class="col-md-2">
					<label for="">PAY_4</label>
					<input type="number" class="form-control" name="PAY_4" value="<?php echo isset($PAY_4) ? $PAY_4 : '' ?>">
				</div>
				<div class="col-md-2">
					<label for="">PAY_5</label>
					<input type="number" class="form-control" name="PAY_5" value="<?php echo isset($PAY_5) ? $PAY_5 : '' ?>">
				</div>
				<div class="col-md-2">
					<label for="">PAY_6</label>
					<input type="number" class="form-control" name="PAY_6" value="<?php echo isset($PAY_6) ? $PAY_6 : '' ?>">
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-2">
					<label for="">BILL_AMT1</label>
					<input type="number" class="form-control" name="BILL_AMT1" value="<?php echo isset($BILL_AMT1) ? $BILL_AMT1 : '' ?>">
				</div>
				<div class="col-md-2">
					<label for="">BILL_AMT2</label>
					<input type="number" class="form-control" name="BILL_AMT2" value="<?php echo isset($BILL_AMT2) ? $BILL_AMT2 : '' ?>">
				</div>
				<div class="col-md-2">
					<label for="">BILL_AMT3</label>
					<input type="number" class="form-control" name="BILL_AMT3" value="<?php echo isset($BILL_AMT3) ? $BILL_AMT3 : '' ?>">
				</div>
				<div class="col-md-2">
					<label for="">BILL_AMT4</label>
					<input type="number" class="form-control" name="BILL_AMT4" value="<?php echo isset($BILL_AMT4) ? $BILL_AMT4 : '' ?>">
				</div>
				<div class="col-md-2">
					<label for="">BILL_AMT5</label>
					<input type="number" class="form-control" name="BILL_AMT5" value="<?php echo isset($BILL_AMT5) ? $BILL_AMT5 : '' ?>">
				</div>
				<div class="col-md-2">
					<label for="">BILL_AMT6</label>
					<input type="number" class="form-control" name="BILL_AMT6" value="<?php echo isset($BILL_AMT6) ? $BILL_AMT6 : '' ?>">
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-2">
					<label for="">PAY_AMT1</label>
					<input type="number" class="form-control" name="PAY_AMT1" value="<?php echo isset($PAY_AMT1) ? $PAY_AMT1 : '' ?>">
				</div>
				<div class="col-md-2">
					<label for="">PAY_AMT2</label>
					<input type="number" class="form-control" name="PAY_AMT2" value="<?php echo isset($PAY_AMT2) ? $PAY_AMT2 : '' ?>">
				</div>
				<div class="col-md-2">
					<label for="">PAY_AMT3</label>
					<input type="number" class="form-control" name="PAY_AMT3" value="<?php echo isset($PAY_AMT3) ? $PAY_AMT3 : '' ?>">
				</div>
				<div class="col-md-2">
					<label for="">PAY_AMT4</label>
					<input type="number" class="form-control" name="PAY_AMT4" value="<?php echo isset($PAY_AMT4) ? $PAY_AMT4 : '' ?>">
				</div>
				<div class="col-md-2">
					<label for="">PAY_AMT5</label>
					<input type="number" class="form-control" name="PAY_AMT5" value="<?php echo isset($PAY_AMT5) ? $PAY_AMT5 : '' ?>">
				</div>
				<div class="col-md-2">
					<label for="">PAY_AMT6</label>
					<input type="number" class="form-control" name="PAY_AMT6" value="<?php echo isset($PAY_AMT6) ? $PAY_AMT6 : '' ?>">
				</div>
			</div>
			<?php endif; ?>
		</form>
	</div>
</div>

<script>
	 $('#manage-borrower').submit(function(e){
	 	e.preventDefault()
	 	start_load()
	 	$.ajax({
	 		url:'ajax.php?action=save_borrower',
	 		method:'POST',
	 		data:$(this).serialize(),
	 		success:function(resp){
	 			if(resp == 1){
	 				alert_toast("Borrower data successfully saved.","success");
	 				setTimeout(function(e){
	 					location.reload()
	 				},1500)
	 			}
	 		}
	 	})
	 })
</script>