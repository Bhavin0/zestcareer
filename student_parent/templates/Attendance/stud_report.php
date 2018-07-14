<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>My Attendance</title>
        <meta name="description" content="" />
        <meta name="Author" content="" />

        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
        <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/css/essentials.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/layout.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/color_scheme/green.css'); ?>" rel="stylesheet" type="text/css" />
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
								<strong>My Attendance</strong> <!-- panel title -->
							</span>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-4 form-group">
									<label><b>From Date</b></label>
									<input type="text" id="from_date" class="datepicker form-control" value="<?php echo date('Y-m-01'); ?>" readonly="readonly">
								</div>
								<div class="col-md-4 form-group">
									<label><b>To Date</b></label>
									<input type="text" id="to_date" class="datepicker form-control" value="<?php echo date('Y-m-t'); ?>" readonly="readonly">
								</div>
								<div class="col-md-4 form-group">
									<button type="button" class="btn btn-primary" style="margin-top: 23px;" id="search_report">
										<i class="fa fa-search"></i> SEARCH
									</button>
								</div>
							</div>
							<div class="row">
								<div id="report"></div>
							</div>
						</div>
					</div>
			</section>

		</div>
		<script type="text/javascript">var plugin_path = "<?php echo base_url('assets/plugins/'); ?>";</script>
		<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>

		<script type="text/javascript">
			$(document).on('click', '#search_report', show_report);
			show_report();
			function show_report() {
				var from_date = $('#from_date').val();
				var to_date = $('#to_date').val();
				var url = "?pid=3&action=stud_report_ajax&from_date="+from_date+"&to_date="+to_date;
				$.get(url, function(data){
					$('#report').html(data);
				});
			}
		</script>

	</body>
</html>