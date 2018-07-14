
<?php
//echo "hello";exit;
 if(isset($_GET['notice_message_id']))
   {
   	//echo "hello";exit;
   	$subj_id = $_GET['notice_message_id'];
   	$sql1 = "SELECT * FROM es_notice_messages WHERE es_messagesid = $subj_id";
	$res1 = mysql_query($sql1);
	$row1 = mysql_fetch_array($res1);
	if(isset($_POST['reply']))
	{
		//echo "hello";exit;
		$reply_message = $_POST['reply_message'];
		$notice_id = $row1['es_messagesid'];
        // echo $notice
		 $ins = "INSERT INTO `notice_replies` (`reply_message`,`notice_id`,`reply_time`) VALUES ('$reply_message','$notice_id',NOW())";
		$res = mysql_query($ins);

	}
  }
?>
<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>View Assignments</title>
        <meta name="description" content="" />
        <meta name="Author" content="" />

        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
        <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
		
		<!-- THEME CSS -->
		<link href="<?php echo base_url('assets/css/essentials.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/layout.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/color_scheme/green.css'); ?>" rel="stylesheet" type="text/css" />

		<!-- FOOTABLE TABLE -->
		<link href="<?php echo base_url('assets/plugins/footable/css/footable.core.min.css'); ?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/plugins/footable/css/footable.standalone.css'); ?>" rel="stylesheet" type="text/css" />
		
	</head>
	<body><?php
        include(TEMPLATES_PATH . DS . 'leftmenu.tpl.php');
        include(TEMPLATES_PATH . DS . 'header_new.tpl.php');
        ?>

			<section id="middle">
				<header id="page-header">
                    <ol class="breadcrumb">
                        <li>
                            <b> Academic Year : </b>
                            <?php if($res_year['fi_ac_startdate']!=""){ echo displaydate($res_year['fi_ac_startdate']);?> to <?php echo displaydate($res_year['fi_ac_enddate']); } else { echo "---"; }?> 
                        </li>
                    </ol>
                </header>


				<div id="content" class="padding-20">
					<div id="panel-1" class="panel panel-primary">
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>Send Message</strong> <!-- panel title -->
							</span>

						</div>

						<!-- panel content -->
						<div class="panel-body">
                             <div class="panel-body">
                             	   <form action="" method="post">
										<table id="user" class="table table-bordered table-striped">
											<tbody> 
												<tr>         
													<td colspan="2"><b>Message</b></td>
												</tr>
												<tr>
													<td colspan="2"><?php  echo $row1['message'];?></td>
												</tr>
												<tr>         
													<td colspan="2"><textarea name="reply_message" placeholder="Reply Message here..." class="form-control"></textarea></td>
												</tr>
												<tr>
													<td colspan="2">
														<input type="submit" name="reply" class="btn btn-primary pull-right" value="reply" >
													</td>
												</tr>
												
											</tbody>
										</table>
									</form>
									</div>
								</div>
						<div class="panel-footer">
						</div>
					</div>
					<!-- /PANEL -->

				</div>
			</section>
			<!-- /MIDDLE -->

		</div>



	
		<!-- JAVASCRIPT FILES -->
		<script type="text/javascript">var plugin_path = "<?php echo base_url('assets/plugins/'); ?>";</script>
		<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>

		<!-- PAGE LEVEL SCRIPTS -->
		

	</body>
</html>