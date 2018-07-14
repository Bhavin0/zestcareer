<!doctype html>
<html lang="en-US">
	<head>
	     <meta charset="utf-8" />
	     <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	     <title>Send Notice to Student</title>
	     <meta name="description" content="" />
	     <meta name="Author" content="" />
	     <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
	     <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />
        <!-- CORE CSS -->
        <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
  		<link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css'); ?>">
    
        <!-- THEME CSS -->
        <link href="<?php echo base_url('assets/css/essentials.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/layout.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/color_scheme/green.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/selectpicker/select.min.css'); ?>" rel="stylesheet" type="text/css" />
    </head>

    <body>
       	<?php
         	include(TEMPLATES_PATH . DS . 'leftmenu.tpl.php');
         	include(TEMPLATES_PATH . DS . 'header.tpl.php');
    	?>

			<div id="content" class="dashboard" style="padding-top: 5px;">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-3">
						<div class="row">
							<a href="#">
							<button class="btn btn-primary form-control" style="text-align: left"><i class="fa fa-plus-square"></i> Compose</button></a>
							<br><br>
							<div id="panel-ui-tan-l5" class="panel panel-default">
								<div class="panel-heading">
									<span class="elipsis">
										<strong>Folders</strong>
									</span>
									<ul class="options pull-right list-inline">
										<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
									</ul>
								</div>
								<div class="panel-body">

									<ul class="side-nav list-group margin-bottom30">
										
										<li class="list-group-item list-toggle">   <!-- NOTE: "active" to be open on page load -->                
											<a data-toggle="collapse" data-parent="#sidebar-nav" href="#collapse-2"><i class="fa fa-level-down"></i> inbox</a>
											<ul id="collapse-2" class="collapse"><!-- NOTE: "collapse in" to be open on page load -->
												<li><a href="?pid=31&action=sent_student_message"><i class="fa fa-angle-right"></i> Student</a></li>
												
											</ul>
										</li>
										<li class="list-group-item list-toggle">   <!-- NOTE: "active" to be open on page load -->                
											<a data-toggle="collapse" data-parent="#sidebar-nav" href="#collapse-3"><i class="fa fa-level-down"></i> Sent</a>
											<ul id="collapse-3" class="collapse"><!-- NOTE: "collapse in" to be open on page load -->
												<li><a href="?pid=31&action=sent_student_message"><i class="fa fa-angle-right"></i> Student</a></li>
												
											</ul>
										</li>

										<!-- <li class="list-group-item"><a href="#"><i class="fa fa-file-text-o"></i> Draft</a></li>
										<li class="list-group-item"><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li> -->
										
									</ul>

								</div>
							</div>
						</div>
					</div>

					<div class="col-md-9" style="left: 9px;">
				     <div class="row">
					  <div id="ui-1" class="panel panel-default">
					   <div class="panel panel-primary">
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>Compose New Message</strong>
							</span>
						</div>
						<div class="panel-body">
							<form method="post" action="">

											<input type="hidden" name="data[from_type]" value="admin">
											<input type="hidden" name="data[to_type]" value="student">


										  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
											<label><b>Academic Year:</b><font color="#FF0000"><b>*</b></font></label>
											<select name="data[academic_year_id]" class="form-control selectpicker" data-live-search="true"  id="ac_year" required> 
										
											<?php $academic_years = mysqli_query($mysqli_con, "SELECT * FROM es_finance_master ORDER BY es_finance_masterid DESC");
						                    while($academic_year = mysqli_fetch_assoc($academic_years))
						                    {
						                      echo"<option value='".$academic_year['es_finance_masterid']."'>
						                      ".date_format(date_create($academic_year['fi_ac_startdate']), 'd/m/Y')." - 
						                      ".date_format(date_create($academic_year['fi_ac_enddate']), 'd/m/Y')."
						                      </option>";
						                    }
						                    ?>
											</select>
									      </div>

										  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
											<label><b>Select Section:</b><font color="#FF0000"><b>*</b></font></label>
											<?php $sql = mysql_query("SELECT * FROM es_groups"); ?>
											<select class="form-control selectpicker" data-live-search="true"  onchange="fetchclass(this.value)" required>
												<option selected disabled >--SELECT SECTION--</option>
												<?php while($row = mysql_fetch_assoc($sql)){ ?>
												<option value="<?php echo $row['es_groupsid']; ?>"> <?php echo $row['es_groupname']; ?></option>
											<?php } ?>
											</select>
										  </div>

										  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
											<label><b>Select Class</b><font color="#FF0000"><b>*</b></font></label>
											<select class="form-control selectpicker" data-live-search="true" id="classes" onchange="fetchdivision(this.value)" name="data[class_id]" required>
												<option selected disabled >--SELECT CLASS--</option>
												 
											</select>
										  </div>

										  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
											<label><b>Select Division:</b><font color="#FF0000"><b>*</b></font></label>
											<select class="form-control selectpicker" data-live-search="true"  id="divisions" onchange="fetchstudents(this.value)" required>
												<option selected disabled >--SELECT DIVISION--</option>
											</select>
										  </div>

					                  	  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
						                    <label><b>Student:</b><font color="#FF0000"><b>*</b></font></label>
						                    <select class="form-control selectpicker" data-live-search="true"  id="students" name="data[to_id]" required>
						                    <option value="">--SELECT STUDENT--</option>
						                    <?php if(isset($studetails['es_preadmissionid'])) {
											echo "<option value='".$studetails['es_preadmissionid']."'>".$studetails['es_preadmissionid']."</option>";
											} ?>
						                    </select>
					                  	  </div>

					                  	  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
			                    			<label><b>Date:</b><font color="#FF0000"><b>*</b></font></label>
			                    			<input type="text" name="data[notice_date]" class="form-control datepicker  masked" required>
		                  				  </div>

		                  				  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			                    			<label><b>Subject:</b><font color="#FF0000"><b>*</b></font></label>
			                    			<input type="text" name="data[subject]"  class="form-control" required>
		                  				  </div>

		                  				  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
											<label><b>Notice:</b><font color="#FF0000"><b>*</b></font></label>
											<textarea col="100" row="50" name="data[message]"  class="form-control" required="required"></textarea>
											<span class="text-danger"><br></span>
										  </div>

										 <button type="submit" name="send_to_student" class="btn btn-primary pull-right" value="send_to_student" id="submit_btn">SEND MESSAGE</button>
			                            </form>
						    </div>
					     </div>
						<!-- /panel content -->
					   </div>
				      </div>
				    </div>

			<script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
	    	<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
	    	<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
		    <script type="text/javascript" src="<?php echo base_url('assets/plugins/selectpicker/select.min.js'); ?>"></script>
		    <script>
				function fetchclass(str) {
					var ac_year = $('#ac_year').val();
				    if (window.XMLHttpRequest) {
				    xmlhttp = new XMLHttpRequest();
				    } else {
				    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				    }
				    xmlhttp.onreadystatechange = function() {
				    if (this.readyState == 4 && this.status == 200) {
				    	var classes = document.getElementById('classes');
				    	classes.innerHTML = "<option selected='selected'>--SELECT CLASS--</option>";
						classes.innerHTML = classes.innerHTML + this.responseText;
						$('.selectpicker').selectpicker('refresh');
				        }
				    };
				    xmlhttp.open("GET","ajax.php?action=classes&q="+str,true);
				    xmlhttp.send();

				    /* Fetch Semesters */
				    if (window.XMLHttpRequest) {
				    xmlhttp = new XMLHttpRequest();
				    } else {
				    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				    }
				    xmlhttp.onreadystatechange = function() {
				    if (this.readyState == 4 && this.status == 200) {
				    	var semesters = document.getElementById('semesters');
				    	semesters.innerHTML = "<option value='NULL'>ALL SEMESTER</option>";
						semesters.innerHTML = semesters.innerHTML + this.responseText;
				        }
				    };
				    xmlhttp.open("GET","ajax.php?action=semesters&q="+str+"&ac_year="+ac_year,true);
				    xmlhttp.send();
				}
			</script>
			<script type="text/javascript">
				function fetchdivision(str)
				{
					if (window.XMLHttpRequest) {
			    		xmlhttp = new XMLHttpRequest();
			    	} else {
			    		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			    	}
			    		xmlhttp.onreadystatechange = function() {
			    		if (this.readyState == 4 && this.status == 200) {
			    		var divisions = document.getElementById('divisions');
			    		divisions.innerHTML = "<option selected disabled> --SELECT DIVISION-- </option>";
						divisions.innerHTML = divisions.innerHTML + this.responseText;
						$('.selectpicker').selectpicker('refresh');
			        	}
			    	};
			    	xmlhttp.open("GET","ajax.php?action=divisions&q="+str,true);
			    	xmlhttp.send();
				}
			</script>
			<script>
				function fetchstudents(str)
				{
					//FETCH STUDENTS
					var ac_year = $('#ac_year').val();
			    	if (window.XMLHttpRequest) {
			    	xmlhttp = new XMLHttpRequest();
			    	} else {
			    	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			    	}
			    	xmlhttp.onreadystatechange = function() {
			    	if (this.readyState == 4 && this.status == 200) {
			    		var students = document.getElementById('students');
						students.innerHTML = this.responseText;
						$('.selectpicker').selectpicker('refresh');
			        	}
			    	};
			    	xmlhttp.open("GET","ajax.php?action=students&q="+str+"&ac_year="+ac_year,true);
			    	xmlhttp.send();
				}
			</script>    
	    </body>
    </html>

