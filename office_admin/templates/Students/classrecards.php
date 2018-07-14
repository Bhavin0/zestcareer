<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Update Class Records</title>
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
					           <span class="elipsis title"><strong>Update Class Records</strong></span>
				            </div>

				            <div class="panel-body">
								<form action="" method="post">
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
										<label><b>Academic Year</b></label>
										<select class="form-control" id="ac_year" name="ac_year">
										<?php
												$ac_years = mysqli_query($mysqli_con, "SELECT * FROM es_finance_master ORDER BY es_finance_masterid DESC");
											while($row = mysqli_fetch_assoc($ac_years))
											{
												echo"<option value='".$row['es_finance_masterid']."'> ".date_format(date_create($row['fi_ac_startdate']), 'd/m/Y')." - ".date_format(date_create($row['fi_ac_enddate']), 'd/m/Y')." </option>";
											}
										?>
										</select>
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
										<label><b>Classes</b></label>
										<select class="form-control" id="class_id" name="class_id">
										<?php
											$classses = mysqli_query($mysqli_con, "SELECT * FROM es_classes ORDER BY es_orderby");
											while($row = mysqli_fetch_assoc($classses))
											{
												echo"<option value='".$row['es_classesid']."'> ".$row['es_classname']." </option>";
											}
										?>
				  						</select>
				  					</div>
				  					<div id="studentlist"></div>
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
        <script>
        function fetch_detail()
        {
            $('#studentlist').html("<img src='<?php echo base_url('assets/images/ajax-loader.gif'); ?>' class='img-responsive'>");
            var ac_year = $('#ac_year').val();
            var class_id = $('#class_id').val();
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("studentlist").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","?pid=21&action=update_class_record_ajax&ac_year="+ac_year+"&class_id="+class_id,true);
            xmlhttp.send();
        }

        $(document).on('change', '#ac_year', fetch_detail);
        $(document).on('change', '#class_id', fetch_detail);
        fetch_detail();
        </script>


        <script>
            $(document).on('change', '#parent_status', function(){
                $(".result_status").val(this.value);
            });
            $(document).on('change', '#promoted_class', function(){
                $(".promoted_class").val(this.value);
            });
        </script>
    </body>
</html>