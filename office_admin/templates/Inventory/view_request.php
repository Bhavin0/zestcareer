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
        <link href="<?php echo base_url('assets/plugins/selectpicker/select.min.css'); ?>" rel="stylesheet" type="text/css" />
    
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
	 	<?php
			$sql = mysql_fetch_array(mysql_query("SELECT es_in_goods_issue.*, es_staff.st_firstname, es_staff.st_lastname FROM es_in_goods_issue INNER JOIN es_staff ON es_staff.es_staffid = es_in_goods_issue.staff_id WHERE es_in_goods_issue.es_in_goods_issueid = ".$_GET['request_id']));
		?>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<span class="title elipsis">
						<strong>Goods Issue Request Detail</strong>
					</span>
				</div>
				<div class="panel-body">
				<table  class="table table-bordered">
					<tr>
						<th width="30%">Requester : </th>
						<th>Date</th>
					</tr>
					<tr>
						<td><?php echo $sql['st_firstname']." ".$sql['st_lastname']; ?></td>
						<td><?php echo date_format(date_create($sql['in_issue_date']), 'd/m/Y'); ?></td>
					</tr>
					<tr>
						<th colspan="2">Remarks</th>
					</tr>
					<tr>
						<td colspan="2"><?php echo nl2br($sql['remarks']); ?></td>
					</tr>
					<tr>
						<th>Status</th>
						<td><?php echo nl2br($sql['status']); ?></td>
					</tr>
				</table>
	
				<table class="table table-bordered">
					<tr>
						<th colspan=2>ITEMS</th>
					</tr>
					<tr>
						<th>Item</th>
						<th>Qty.</th>
					</tr>
					<?php
					$sql1 = mysql_query("SELECT es_in_goods_issue_items.*, es_in_item_master.in_item_name FROM es_in_goods_issue_items INNER JOIN es_in_item_master ON es_in_item_master.es_in_item_masterid = es_in_goods_issue_items.item_id WHERE es_in_goods_issue_id=".$_GET['request_id']);
					while($row = mysql_fetch_assoc($sql1))
					{
					?>
					<tr>
						<td><?php echo $row['in_item_name']; ?></td>
						<td><?php echo $row['qty']; ?></td>
					</tr>
					<?php
					}
					?>
					</table>

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
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/selectpicker/select.min.js'); ?>"></script>
  </body>
</html>