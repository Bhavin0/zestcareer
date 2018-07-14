<?php 
   

     if(isset($_GET['subj_id']))
   {
   	$sub_id = $_GET['subj_id'];
   	$sql1 = "SELECT es_preadmission.pre_name, es_preadmission.middle_name, es_preadmission.pre_lastname,es_finance_master.fi_startdate,es_finance_master.fi_enddate,es_classes.es_classname,es_notice_messages.*   FROM es_notice_messages INNER JOIN es_preadmission ON es_preadmission.es_preadmissionid = es_notice_messages.to_id INNER JOIN es_finance_master ON es_finance_master.es_finance_masterid = es_notice_messages.academic_year_id INNER JOIN es_classes ON es_classes.es_classesid = es_notice_messages.class_id WHERE es_messagesid = $sub_id";
	$res1 = mysql_query($sql1);
	$row1 = mysql_fetch_array($res1);
  }

?>
<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>View Assignment Detail</title>
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
        include(TEMPLATES_PATH . DS . 'header_new.tpl.php');
        ?>
		<section id="middle">
            <?php
                $sel_year = "SELECT *FROM `es_finance_master`  ORDER BY `es_finance_masterid` DESC LIMIT 0 , 1";
                $res_year = getarrayassoc($sel_year);

            ?>
                <header id="page-header">
                    <ol class="breadcrumb">
                        <li>
                            <b> Academic Year : </b>
                            <?php if($res_year['fi_ac_startdate']!=""){ echo displaydate($res_year['fi_ac_startdate']);?> to <?php echo displaydate($res_year['fi_ac_enddate']); } else { echo "---"; }?>
                        </li>
                    </ol>
                </header>
			<div id="content" class="padding-20">
				
							<div id="ui-1" class="panel panel-default">
                      			<div class="panel panel-primary">
									<div class="panel-heading">
										<span class="title elipsis">
											<strong><?php if($row1['to_type'] == 'student'){ echo $row1['subject'];}
											if($row['to_type'] == 'staff'){echo $row['subject'];}?></strong> <!-- panel title -->
										</span>
									</div>
                     				<?php if($row1['to_type'] == 'student')
									 	{
									 ?>
									<div class="panel-body">
										<table id="user" class="table table-bordered table-striped">
											<tbody> 
												<tr>         
													<td width="35%"><b>Name</b></td>
													<td width="65%"><?php  echo $row1['pre_name']." ".$row1['middle_name']." ".$row1['pre_lastname'];?></td>
												</tr>
												<tr>         
													<td><b>Acadamic Year</b></td>
													<td><?php $start = YMDtoDMY($row1['fi_startdate']);
												          $end = YMDtoDMY($row1['fi_enddate']);
												          echo $start."-".$end;?></td>
												</tr> 
												<tr>         
													<td><b>Class</b></td>
													<td><?php echo $row1['es_classname'];?></td>
												</tr>
											
												<tr>         
													<td colspan="2"><b>Message</b></td>
													<tr><td colspan="2"><?php echo nl2br($row1['message']);?></td></tr>
												</tr>
											 
												<tr>         
													<td><b>Date</b></td>
													<td><?php echo YMDtoDMY($row1['notice_date']);?></td>
												</tr> 
											</tbody>
										</table>
									</div>
									<?php 
										}
									?>
                          		</div>
							</div>
						</div>
			
		</section>
			<!-- /MIDDLE -->

		



	
		<!-- JAVASCRIPT FILES -->
		<script type="text/javascript">var plugin_path = "<?php echo base_url('assets/plugins/'); ?>";</script>
		<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>

		<!-- PAGE LEVEL SCRIPTS -->
		

	</body>
</html>