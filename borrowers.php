<?php include 'db_connect.php' ?>

<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<large class="card-title">
					<b>Borrower List</b>
				</large>
				<?php if(!isset($_SESSION['login_type']) || $_SESSION['login_type'] != 2): ?>
				<button class="btn btn-primary btn-block col-md-2 float-right" type="button" id="new_borrower"><i class="fa fa-plus"></i> New Borrower</button>
				<?php endif; ?>
			</div>
			<div class="card-body">
				<table class="table table-bordered" id="borrower-list">
					<colgroup>
						<col width="10%">
						<col width="35%">
						<col width="30%">
						<col width="15%">
						<col width="5%">
					</colgroup>
					<thead>
						<tr>
							<th class="text-center">ID</th>
							<th class="text-center">Borrower</th>
							<th class="text-center">Current Loan</th>
							<th class="text-center">Next Payment Schedule</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						$where = "";
						if(isset($_SESSION['login_type']) && $_SESSION['login_type'] == 2 && isset($_SESSION['login_id'])) {
							$borrower_id = intval($_SESSION['login_id']) - 1;
							$where = "WHERE id = '{$borrower_id}'";
						}
						$qry = $conn->query("SELECT * FROM borrowers $where order by id desc");
						while($row = $qry->fetch_assoc()):
							$loan = $conn->query("SELECT * FROM loan_list WHERE borrower_id = {$row['id']} AND status = 2 ORDER BY id DESC LIMIT 1");
							$current_loan = $loan && $loan->num_rows ? $loan->fetch_assoc() : null;
							$next_payment = "N/A";
							if($current_loan) {
								$paid = $conn->query("SELECT COUNT(*) as cnt FROM payments WHERE loan_id = {$current_loan['id']}")->fetch_assoc()['cnt'];
								$offset = $paid > 0 ? " offset $paid " : "";
								$schedule = $conn->query("SELECT * FROM loan_schedules WHERE loan_id = {$current_loan['id']} ORDER BY date(date_due) ASC LIMIT 1 $offset");
								if($schedule && $schedule->num_rows) {
									$next_payment = date('M d, Y', strtotime($schedule->fetch_assoc()['date_due']));
								}
							}
						?>
						<tr>
							<td class="text-center"><?php echo $row['id'] ?></td>
							<td>
								<p>Name :<b><?php echo ucwords($row['lastname'].", ".$row['firstname'].' '.$row['middlename']) ?></b></p>
								<p><small>Tax ID :<b><?php echo $row['tax_id'] ?></small></b></p>
							</td>
							<td class="">
								<?php if($current_loan): ?>
									<p>Ref: <b><?php echo $current_loan['ref_no']; ?></b></p>
									<p>Amount: <b><?php echo number_format($current_loan['amount'],2); ?></b></p>
								<?php else: ?>
									None
								<?php endif; ?>
							</td>
							<td class="">
								<?php echo $current_loan ? $next_payment : 'N/A'; ?>
							</td>
							<td class="text-center">
								<button class="btn btn-outline-info btn-sm view_borrower" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-eye"></i></button>
								<button class="btn btn-outline-primary btn-sm edit_borrower" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-edit"></i></button>
								<button class="btn btn-outline-danger btn-sm delete_borrower" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-trash"></i></button>
							</td>
						</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Modal for borrower details -->
<div class="modal fade" id="borrowerDetailModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Borrower Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="borrower-detail-body">
        <!-- Details will be loaded here -->
      </div>
    </div>
  </div>
</div>
<style>
	td p {
		margin:unset;
	}
	td img {
	    width: 8vw;
	    height: 12vh;
	}
	td{
		vertical-align: middle !important;
	}
</style>	
<script>
	$('#borrower-list').dataTable()
	$('#new_borrower').click(function(){
		uni_modal("New borrower","manage_borrower.php",'mid-large')
	})
	// Use delegated events for buttons in table rows
	$('#borrower-list').on('click', '.edit_borrower', function(){
		uni_modal("Edit borrower","manage_borrower.php?id="+$(this).attr('data-id'),'mid-large')
	})
	$('#borrower-list').on('click', '.delete_borrower', function(){
		_conf("Are you sure to delete this borrower?","delete_borrower",[$(this).attr('data-id')])
	})
	$('#borrower-list').on('click', '.view_borrower', function(){
		var id = $(this).attr('data-id');
		$('#borrower-detail-body').html('<div class="text-center">Loading...</div>');
		$('#borrowerDetailModal').modal('show');
		$.ajax({
			url: 'view_borrower_detail.php',
			method: 'POST',
			data: {id: id},
			success: function(resp){
				$('#borrower-detail-body').html(resp);
			}
		});
	})
	// Add delete_borrower function to call ajax to delete borrower
	function delete_borrower(id){
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_borrower',
			method: 'POST',
			data: {id: id},
			success: function(resp){
				if(resp == 1){
					alert_toast("Borrower successfully deleted.","success")
					setTimeout(function(){
						location.reload();
					},1500)
				}
			}
		})
	}
</script>