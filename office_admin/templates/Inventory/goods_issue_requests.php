<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Purchase Requests</title>
        <meta name="description" content="" />
        <meta name="Author" content="" />

        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

        <!-- WEB FONTS -->
        <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />

        <!-- CORE CSS -->
        <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css'); ?>">
    
        <!-- THEME CSS -->
        <link href="<?php echo base_url('assets/css/essentials.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/layout.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/color_scheme/green.css'); ?>" rel="stylesheet" type="text/css" />
    </head>

    <body>
         <?php
         include(TEMPLATES_PATH . DS . 'leftmenu.tpl.php');
         include(TEMPLATES_PATH . DS . 'header.tpl.php');
    ?>
    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<strong>Goods Issue Requests</strong>
				</div>
				<?php
					$sql = mysql_query("SELECT es_in_goods_issue_requests.*, es_staff.st_firstname, es_staff.st_lastname FROM es_in_goods_issue_requests INNER JOIN es_staff ON es_staff.es_staffid = es_in_goods_issue_requests.staff_id ORDER BY es_in_goods_issueid DESC");
		 		?>
		 		<div class="panel-body">
		 			<div class="table-responsive">
						<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Request ID.</th>
								<th>Date</th>
								<th>Requester</th>
								<th>Description</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php
							while ($row = mysql_fetch_assoc($sql)) {
                                if($row['status'] == 'Pending')
                                {
                                    $class = 'warning';
                                }
                                elseif ($row['status'] == 'Rejected')
                                {
                                    $class = 'danger';
                                }
                                else
                                {
                                    $class = 'success';
                                }
							?>
							<tr class="<?php echo $class; ?>">
								<td align="center"><?php echo $row['es_in_goods_issueid']; ?></td>
								<td><?php echo date_format(date_create($row['in_issue_date']), 'd/m/Y'); ?></td>
								<td><?php echo $row['st_firstname']." ".$row['st_lastname']; ?></td>
								<td><?php echo $row['remarks']; ?></td>
								<td><?php echo $row['status'];?></td>
								<td>
                                    <a href="?pid=7&action=request_detail&request_id=<?php echo $row['es_in_goods_issueid']; ?>" title="Reject" class="btn btn-info btn-xs">
                                        &nbsp;<i class="fa fa-eye"></i>
                                    </a>
                                    <?php if($row['status'] == 'Pending' || $row['status']=='Rejected') { ?>
									<a href="?pid=7&action=goods_issue&request_id=<?php echo $row['es_in_goods_issueid']; ?>" class="btn btn-success btn-xs" title="Approve">
										&nbsp;<i class="fa fa-cart-plus" aria-hidden="true"></i>
									</a>
                                    <?php } ?>
                                    <?php if($row['status'] == 'Pending') { ?>
                                        <a href="?pid=7&action=reject_request&request_id=<?php echo $row['es_in_goods_issueid']; ?>" title="Reject" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to reject this request?')">
                                            &nbsp;<i class="fa fa-trash-o"></i>
                                        </a>
                                    <?php } ?>
								</td>
							</tr>
						<?php
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
    </div> <!-- col-LG-12 -->
  </div>
  </section>
</div>



  
    <!-- JAVASCRIPT FILES -->
    <script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
        <script>
        $(function () {
            $(".table").DataTable({
                ordering: false
            })
        });
        </script>
  </body>
</html>