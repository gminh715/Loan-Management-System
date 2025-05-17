<?php 
include('db_connect.php');
if(isset($_GET['id'])){
$qry = $conn->query("SELECT * FROM loan_list where id = ".$_GET['id']);
foreach($qry->fetch_array() as $k => $v){
	$$k = $v;
}
}
?>
<div class="container-fluid">
	<div class="col-lg-12">
	<form action="" id="loan-application">
		<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
		<div class="row">
			<div class="col-md-6">
				<label class="control-label">Borrower</label>
				<?php
				$borrower = null;
				if(isset($_SESSION['login_type']) && $_SESSION['login_type'] == 2 && isset($_SESSION['login_id'])) {
					$borrower = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM borrowers WHERE id = '{$_SESSION['login_id']}'");
				} else {
					$borrower = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM borrowers order by concat(lastname,', ',firstname,' ',middlename) asc ");
				}
				?>
				<select name="borrower_id" id="borrower_id" class="custom-select browser-default select2" <?php if(isset($_SESSION['login_type']) && $_SESSION['login_type'] == 2) echo 'readonly disabled'; ?>>
					<option value=""></option>
						<?php while($row = $borrower->fetch_assoc()): ?>
							<option value="<?php echo $row['id'] ?>" <?php echo isset($borrower_id) && $borrower_id == $row['id'] ? "selected" : '' ?>><?php echo $row['name'] . ' | Tax ID:'.$row['tax_id'] ?></option>
						<?php endwhile; ?>
				</select>
			</div>
			<div class="col-md-6">
				<label class="control-label">Loan Type</label>
				<?php
				$type = $conn->query("SELECT * FROM loan_types order by `type_name` desc ");
				?>
				<select name="loan_type_id" id="loan_type_id" class="custom-select browser-default select2">
					<option value=""></option>
						<?php while($row = $type->fetch_assoc()): ?>
							<option value="<?php echo $row['id'] ?>" <?php echo isset($loan_type_id) && $loan_type_id == $row['id'] ? "selected" : '' ?>><?php echo $row['type_name'] ?></option>
						<?php endwhile; ?>
				</select>
			</div>
			
		</div>

		<div class="row">
			<div class="col-md-6">
				<label class="control-label">Loan Plan</label>
				<?php
				$plan = $conn->query("SELECT * FROM loan_plan order by `months` desc ");
				?>
				<select name="plan_id" id="plan_id" class="custom-select browser-default select2">
					<option value=""></option>
						<?php while($row = $plan->fetch_assoc()): ?>
							<option value="<?php echo $row['id'] ?>" <?php echo isset($plan_id) && $plan_id == $row['id'] ? "selected" : '' ?> data-months="<?php echo $row['months'] ?>" data-interest_percentage="<?php echo $row['interest_percentage'] ?>" data-penalty_rate="<?php echo $row['penalty_rate'] ?>"><?php echo $row['months'] . ' month/s [ '.$row['interest_percentage'].'%, '.$row['penalty_rate'].'% ]' ?></option>
						<?php endwhile; ?>
				</select>
				<small>months [ interest%,penalty% ]</small>
			</div>
		<div class="form-group col-md-6">
			<label class="control-label">Loan Amount</label>
			<input type="number" name="amount" class="form-control text-right" step="any" id="" value="<?php echo isset($amount) ? $amount : '' ?>">
		</div>
		</div>
		<div class="row">
			<div class="form-group col-md-6">
			<label class="control-label">Purpose</label>
			<textarea name="purpose" id="" cols="30" rows="2" class="form-control"><?php echo isset($purpose) ? $purpose : '' ?></textarea>
		</div>
		
		<div class="form-group col-md-2 offset-md-2 .justify-content-center">
			<label class="control-label">&nbsp;</label>
			<button class="btn btn-primary btn-sm btn-block align-self-end" type="button" id="calculate">Calculate</button>
		</div>
		</div>
		<div id="calculation_table">
			
		</div>
		<?php if(isset($status)): ?>
		<div class="row">
			<div class="form-group col-md-6">
				<label class="control-label">&nbsp;</label>
				<select class="custom-select browser-default" name="status"
					<?php if(isset($_SESSION['login_type']) && $_SESSION['login_type'] == 2) echo 'disabled readonly'; ?>>
					<option value="0" <?php echo $status == 0 ? "selected" : '' ?>>For Approval</option>
					<option value="1" <?php echo $status == 1 ? "selected" : '' ?>>Approved</option>
					<?php if($status !='4' ): ?>
					<option value="2" <?php echo $status == 2 ? "selected" : '' ?>>Released</option>
					<?php endif ?>
					<?php if($status =='2' ): ?>
					<option value="3" <?php echo $status == 3 ? "selected" : '' ?>>Complete</option>
					<?php endif ?>
					<?php if($status !='2' ): ?>
					<option value="4" <?php echo $status == 4 ? "selected" : '' ?>>Denied</option>
					<?php endif ?>
				</select>
				<?php if(isset($_SESSION['login_type']) && $_SESSION['login_type'] == 2): ?>
					<input type="hidden" name="status" value="<?php echo $status; ?>">
				<?php endif; ?>
			</div>
		</div>
		<hr>
	<?php endif ?>
		<div id="row-field">
			<div class="row ">
				<div class="col-md-12 text-center">
					<button class="btn btn-primary btn-sm " >Save</button>
					<button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
		
	</form>
	</div>
</div>

<!-- ML Prediction Result Section -->
<div class="alert alert-info mt-3">
    <div class="row">
        <div class="col-md-12">
            <strong>Prediction Result:</strong> <span id="model-message">Loading...</span>
        </div>
        <div class="col-md-12">
            <strong>Default Probability:</strong> <span id="model-probability">...</span>
        </div>
    </div>
</div>

<script>
	$('.select2').select2({
		placeholder:"Please select here",
		width:"100%"
	})
	$('#calculate').click(function(){
		calculate()
	})
	

	function calculate(){
		start_load()
		if($('#loan_plan_id').val() == '' && $('[name="amount"]').val() == ''){
			alert_toast("Select plan and enter amount first.","warning");
			return false;
		}
		var plan = $("#plan_id option[value='"+$("#plan_id").val()+"']")
		$.ajax({
			url:"calculation_table.php",
			method:"POST",
			data:{amount:$('[name="amount"]').val(),months:plan.attr('data-months'),interest:plan.attr('data-interest_percentage'),penalty:plan.attr('data-penalty_rate')},
			success:function(resp){
				if(resp){
					
					$('#calculation_table').html(resp)
					end_load()
				}
			}

		})
	}
	$('#loan-application').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_loan',
			method:"POST",
			data:$(this).serialize(),
			success:function(resp){
				if(resp ==1 ){
					$('.modal').modal('hide')
					alert_toast("Loan Data successfully saved.","success")
					setTimeout(function(){
						location.reload();
					},1500)
				}
			}
		})
	})
	$(document).ready(function(){
		if('<?php echo isset($_GET['id']) ?>' == 1)
			calculate()
	})
</script>
<style>
	#uni_modal .modal-footer{
		display: none
	}
</style>
<script>
<?php
// Lấy dữ liệu borrower từ DB khi form được load
$ml_features = [
    'LIMIT_BAL','SEX','EDUCATION','MARRIAGE','AGE',
    'PAY_0','PAY_2','PAY_3','PAY_4','PAY_5','PAY_6', 
    'BILL_AMT1','BILL_AMT2','BILL_AMT3','BILL_AMT4','BILL_AMT5','BILL_AMT6',
    'PAY_AMT1','PAY_AMT2','PAY_AMT3','PAY_AMT4','PAY_AMT5','PAY_AMT6'
];

// Lấy dữ liệu borrower khi có borrower_id
if(isset($borrower_id)) {
    $qry = $conn->query("SELECT * FROM borrowers WHERE id = '$borrower_id'");
    if($qry && $qry->num_rows > 0) {
        $borrower_data = $qry->fetch_assoc();
        // Tạo object JS chứa dữ liệu
        echo "var borrowerData = " . json_encode($borrower_data) . ";";
    } else {
        echo "var borrowerData = null;";
    }
} else {
    echo "var borrowerData = null;";
}
?>

// Xử lý và gửi dữ liệu sang Flask API
function predictDefault(data) {
    // One-hot encoding
    let input = {
        LIMIT_BAL: Number(data.LIMIT_BAL) || 0,
        AGE: Number(data.AGE) || 0,
        PAY_1: Number(data.PAY_0) || 0,
        PAY_2: Number(data.PAY_2) || 0,
        PAY_3: Number(data.PAY_3) || 0,
        PAY_4: Number(data.PAY_4) || 0,
        PAY_5: Number(data.PAY_5) || 0,
        PAY_6: Number(data.PAY_6) || 0,
        BILL_AMT1: Number(data.BILL_AMT1) || 0,
        BILL_AMT2: Number(data.BILL_AMT2) || 0,
        BILL_AMT3: Number(data.BILL_AMT3) || 0,
        BILL_AMT4: Number(data.BILL_AMT4) || 0,
        BILL_AMT5: Number(data.BILL_AMT5) || 0,
        BILL_AMT6: Number(data.BILL_AMT6) || 0,
        PAY_AMT1: Number(data.PAY_AMT1) || 0,
        PAY_AMT2: Number(data.PAY_AMT2) || 0,
        PAY_AMT3: Number(data.PAY_AMT3) || 0,
        PAY_AMT4: Number(data.PAY_AMT4) || 0,
        PAY_AMT5: Number(data.PAY_AMT5) || 0,
        PAY_AMT6: Number(data.PAY_AMT6) || 0
    };

    // Thêm one-hot encoding
    input['SEX_1'] = Number(data.SEX) === 1 ? 1 : 0;
    input['SEX_2'] = Number(data.SEX) === 2 ? 1 : 0;
    
    input['EDUCATION_1'] = Number(data.EDUCATION) === 1 ? 1 : 0;
    input['EDUCATION_2'] = Number(data.EDUCATION) === 2 ? 1 : 0;
    input['EDUCATION_3'] = Number(data.EDUCATION) === 3 ? 1 : 0;
    input['EDUCATION_4'] = Number(data.EDUCATION) === 4 ? 1 : 0;

    input['MARRIAGE_1'] = Number(data.MARRIAGE) === 1 ? 1 : 0;
    input['MARRIAGE_2'] = Number(data.MARRIAGE) === 2 ? 1 : 0;
    input['MARRIAGE_3'] = Number(data.MARRIAGE) === 3 ? 1 : 0;

    // Gọi API Flask
    fetch('http://localhost:5000/predict', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(input)
    })
    .then(response => response.json())
    .then(result => {
        document.getElementById('model-message').innerHTML = `<b>${result.message}</b>`;
        document.getElementById('model-probability').innerHTML = `${(result.probability*100).toFixed(2)}%`;
    })
    .catch(error => {
        document.getElementById('model-message').innerHTML = "Lỗi kết nối tới model";
        document.getElementById('model-probability').innerHTML = "N/A";
    });
}

// Tự động dự đoán khi form được load
$(document).ready(function() {
    if(borrowerData) {
        predictDefault(borrowerData);
    }
    
    // Cập nhật dự đoán khi thay đổi borrower
    $('#borrower_id').change(function() {
        var borrower_id = $(this).val();
        if(borrower_id) {
            $.ajax({
                url: 'ajax.php?action=get_borrower',
                method: 'POST',
                data: {id: borrower_id},
                success: function(resp) {
                    var data = JSON.parse(resp);
                    if(data) {
                        predictDefault(data);
                    }
                }
            });
        }
    });
});
</script>