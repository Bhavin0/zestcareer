<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Admin List</title>
        <meta name="description" content="" />
        <meta name="Author" content="" />
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
        <link href="<?php echo base_url('assets/fonts/googlefonts.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('assets/css/essentials.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/layout.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/color_scheme/green.css'); ?>" rel="stylesheet" type="text/css" />
    </head>
    <body>
  	<?php
    	include(TEMPLATES_PATH . DS . 'leftmenu.tpl.php');
    	include(TEMPLATES_PATH . DS . 'header_new.tpl.php');
    	?>
      		<section id="middle">
        		<header id="page-header">
          			<h1><i class="fa fa-dashboard"></i> Admin List</h1>
          			<ol class="breadcrumb">
            			<li><a href="?pid=44">Admin</a></li>
            			<li class="active">Admin List</li>
          			</ol>
        		</header>

        		<div id="content" class="dashboard" style="padding-top: 5px;">
        			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  						<div class="panel panel-primary">
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
										<table  class="table table-striped table-bordered table-hover">
											<thead>
		  										<tr>
													<th>S No</th>
													<th>Name</th>
													<th>User Name</th>
													<?php if(isset($_SESSION['eschools']['superadmin_email']) && $_SESSION['eschools']['superadmin_email']!='')
													{echo "<th> Password </th>";}?>
													<th>Email ID</th>
													<th>Action</th>
		  										</tr>
											</thead>
											<tbody>
		  									<?php 
		  										$i = 1;
												while($admin = mysqli_fetch_assoc($admins)) { ?>	
		  										<tr>
													<td><?php echo $i++; ?></td>
													<td><?php echo $admin['admin_fname']." ".$admin['admin_lname']; ?></td>
													<td><?php echo $admin['admin_username']; ?> </td>
													<?php
														if(isset($_SESSION['eschools']['superadmin_email'])){echo "<td>".$admin['admin_password']."</td>"; } ?>
													<td><?php echo $admin['admin_email']; ?></td>
													<td>
													<a href="?pid=42&action=edit&elid=<?php echo $admin['es_adminsid']; ?>" title="Edit" class="btn btn-warning btn-xs">
														&nbsp;<i class="fa fa-pencil-square-o"></i>
													</a>&nbsp;
            										<a href="?pid=42&action=delete_admin&admin_id=<?php echo $admin['es_adminsid']; ?>" title="Delete" class="btn btn-danger btn-xs" onclick="return confirm('are you sure you want to delete this admin');">
            											&nbsp;<i class="fa fa-trash-o"></i>
            										</a></td>
		  										</tr>
		  									<?php } ?>
      										</tbody>
										</table>
    								</div>
  								</div>
							</div>
  						</div>
  					</div>
  				</div>
  			</section>
		</div>
		
    	<script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
    	<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
    	<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
  	</body>
</html>