<!doctype html>
  <html lang="en-US">
    <head>
      <meta charset="utf-8" />
      <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
      <title>Add Fees</title>
      <meta name="description" content="" />
      <meta name="Author" content="" />
      <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
      <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />
      <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css'); ?>">
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
          	$sel_year = "SELECT * FROM `es_finance_master`  ORDER BY `es_finance_masterid` DESC LIMIT 0 , 1";
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
    				<!-- PANEL START -->
						<div class="panel panel-primary">
							<div class="panel-heading">
								<span class="title elipsis">
									<strong>Add Fees</strong>
								</span>
							</div>

							<div class="panel-body">
								<form action="" name="fee_master" method="post" >
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
										<label><b>Academic Year</b></label>
										<select name="academy_year_id" id="academy_year_id" class="form-control" data-live-search="true" required="required">
											<option selected="" disabled=""> --SELECT ACADEMIC YEAR-- </option>
											<?php for($i = 0; $i < count($school_details_res); $i++) { ?>				
											<option value="<?php echo $school_details_res[$i]['es_finance_masterid']; ?>"><?php echo displaydate($school_details_res[$i]['fi_startdate'])." To ".displaydate($school_details_res[$i]['fi_enddate']); ?></option>
											<?php } ?>
										</select>
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
										<label><b>Section</b></label>
										<select name="section_id" class="form-control" onchange="fetchclass(this.value)" required="required">
											<option value="All" >All</option>
											<?php foreach($c_groups as $eachgroup) { ?>
											<option value="<?php echo $eachgroup['es_groupsid']; ?>"><?php echo $eachgroup['es_groupname']; ?></option>
											<?php } ?>
										</select>
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
										<label><b>Class</b></label>
										<select name="fee_class" class="form-control" id="classes" required="required">
											<option value="All" >All</option>
											<?php if (count($class_data)>0)
											{
												foreach($class_data as $eachclass) { ?>						
												<option value="<?php echo $eachclass['es_classesid']; ?>"   <?php echo ($eachclass['es_classesid']==$selectclass)?"selected":""?> ><?php echo $eachclass['es_classname']; ?></option>
												<?php }
											} ?>
										</select>
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
										<label><b>Semester</b></label>
										<select name="semester_id" class="form-control" id="semesters" required="">
											<option value="All" >All</option>
										</select>
									</div>

									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
										<table class="table table-bordered">
											<thead>
												<th>Particulars</th>
												<th>Amount</th>
												<th>Optional</th>
												<th>Ledger</th>
												<th>Action</th>
											</thead>
											<tbody id="top-div">
												<td>
													<input name="particulars[]" type="text" class="form-control" required="required" />
												</td>
												<td>
													<input type="number" name="amount[]" id="fee" class="form-control" required="required" />
												</td>
												<td>
													<select name="optional[]" class="form-control" required="required">
														<option value="NO">NO</option>
														<option value="YES">YES</option>
													</select>
												</td>
												<td>
													<select name="ledger[]" class="form-control" required="required">
													<?php for($i = 0; $i < count($ledgers); $i++)
													{
														echo"<option value='".$ledgers[$i]['es_ledgerid']."'>".$ledgers[$i]['lg_name']."</option>";
													}
													?>
													</select>
												</td>
												<td>
													<button type="button" class="btn btn-success btn-sm" onclick="AddRow();">
														<i class="fa fa-plus"></i>
													</button>
												</td>
											</tbody>
										</table>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<?php if(in_array('2_15',$admin_permissions)) { ?>
										<input name="Submit" type="submit" class="btn btn-primary pull-right" value="Save" />
										<input name="back" type="reset" class="btn btn-primary pull-right" value="Reset" />
									<?php } ?>
									</div>
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
		<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>

		<script type="text/javascript">
		function AddRow()
		{
			$("#top-div").append("<tr>"+
				"<td>"+
					"<input name='particulars[]'' type='text' class='form-control' required='required' />"+
				"</td>"+
				"<td>"+
					"<input type='number' name='amount[]' class='form-control' required='required' />"+
				"</td>"+
				"<td>"+
					"<select name='optional[]' class='form-control' required='required'>"+
						"<option value='NO'>NO</option>"+
						"<option value='YES'>YES</option>"+
					"</select>"+
				"</td>"+
				"<td>"+
					"<select name='ledger[]' class='form-control' required='required'>"+
						"<?php for($i = 0; $i < count($ledgers); $i++) { echo'<option value='.$ledgers[$i]['es_ledgerid'].'>'.$ledgers[$i]['lg_name'].'</option>'; } ?>"+
					"</select>"+
				"</td>"+
				"<td>"+
					"<button type='button' class='btn btn-danger btn-sm' onclick='DelRow(this)'>"+
						"<i class='fa fa-trash-o'></i>"+
					"</button>"+
				"</td>"+
			"</tr>");
		}
		
		//This function will delete the last row
		function DelRow(e)
		{
				e.parentNode.parentNode.parentNode.removeChild(e.parentNode.parentNode);
		}
		</script>

		<script>
		function fetchclass(str) {
    		if (window.XMLHttpRequest) {
    			xmlhttp = new XMLHttpRequest();
    		} else {
    			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    		}
    		xmlhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
    			var classes = document.getElementById('classes');
    			classes.innerHTML = "<option value='All'>All</option>";
				classes.innerHTML = classes.innerHTML + this.responseText;
        	}
    		};
    		xmlhttp.open("GET","ajax.php?action=classes&q="+str,true);
    		xmlhttp.send();

    		/* Fetch Semesters */
    		var ac_year = $('#academy_year_id').val();
    		if (window.XMLHttpRequest) {
   		 		xmlhttp = new XMLHttpRequest();
    		} else {
    			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    		}
    		xmlhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
    			var semesters = document.getElementById('semesters');
    			semesters.innerHTML = "<option value='All'>All</option>";
				semesters.innerHTML = semesters.innerHTML + this.responseText;
        	}
    	};
    	xmlhttp.open("GET","ajax.php?action=semesters&q="+str+"&ac_year="+ac_year,true);
    	xmlhttp.send();
		}
		</script>
		<script type="text/javascript">
			$('#dd-11').addClass('active');
			$('#dd-11-1').addClass('active');
		</script>
  	</body>
</html>