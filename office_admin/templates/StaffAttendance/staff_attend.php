<!doctype html>
<html lang="en-US">
  	<head>
    	<meta charset="utf-8" />
    	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    	<title>Upload Staff Attendance</title>
    	<meta name="description" content="" />
    	<meta name="Author" content="" />

    	<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
    	<link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />
    	<link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
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

        		<div id="content" class="dashboard" style="padding-top: 5px;">
          			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<span class="title elispe">
									<strong>Staff Attendance</strong>
								</span>
							</div>

							<div class="panel-body">
								<form action="" method="post" >

									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
										<label><b>Date</b><font color="#FF0000">&nbsp;*</font></label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											<input name="at_staff_date" readonly="readonly" value="<?php echo date('Y-m-d') ?>" class="form-control datepicker" id="at_staff_date">
										</div>
									</div>

									<div id="ajax_data" align="center"></div>

								</form>
							</div>
						</div>
					</div>
        		</div>
      		</section>
    	</div>
    	<!-- JAVASCRIPT FILES -->
    	<script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
    	<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
    	<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
      <script type="text/javascript" src="<?php echo base_url('assets/plugins/selectpicker/select.min.js'); ?>"></script>
      <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.form.js'); ?>"></script>


        <script>
        function fetch_detail()
        {
            $('#ajax_data').html("<img src='<?php echo base_url('assets/images/ajax-loader.gif'); ?>' class='img-responsive'>");
            var at_staff_date = $('#at_staff_date').val();
            //var at_staff_dept = $('#at_staff_dept').val();
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("ajax_data").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","?pid=27&action=ajax_staff_attendance&at_staff_date="+at_staff_date,true);
            xmlhttp.send();
        }

        $(document).on('change', '#at_staff_date', fetch_detail);
        //$(document).on('change', '#at_staff_dept', fetch_detail);
        fetch_detail();
        </script>

		<script>
		$(document).on('change', '.at_staff_attend', function(){
			var element = $(this);
    		if(element.val()=='A')
    		{
    			element.closest('tr').find('select.at_staff_remarks').html("<option  value='Paid'>Paid Leave</option><option  value='Unpaid'>Unpaid Leave</option>");
    			element.closest('tr').find('select.leave_type').show();
    		}
    		else
    		{	
    			element.closest('tr').find('select.at_staff_remarks').html("<option  value='Full Day'>Full Day</option><option  value='Half Day'>Half Day</option>");
    			element.closest('tr').find('select.leave_type').val('');
    			element.closest('tr').find('select.leave_type').hide();
    		}
			$('.selectpicker').selectpicker('refresh');
		});

		$(document).on('change', '.at_staff_remarks', function(){
			var element = $(this);
			if(element.val()=='Paid')
			{
				element.closest('tr').find('select.leave_type').show();
			}
			else
			{
    			element.closest('tr').find('select.leave_type').val('');
				element.closest('tr').find('select.leave_type').hide();
			}
		});
		</script>
		<script>
			$('body').on('focus',".timepicker", function(){
    			$(this).timepicker();
			});​
		</script>
  	</body>
</html>