<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<div class="panel panel-default">
	<div class="panel-body">
		<button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#myModal">
			<i class="fa fa-search"></i> SEARCH
		</button>
	</div>


<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Search Survey</h4>
			</div>

			<form action="?pid=135&action=view_survey" method="post">
			<!-- Modal Body -->
			<div class="modal-body">

				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
					<label><b>From</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						<input type="text" class="form-control datepicker" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false" readonly="" value="" name="from_date">
					</div>
				</div>

				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
					<label><b>To</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						<input type="text" class="form-control datepicker" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false" readonly="" value="" name="to_date">
					</div>
				</div>

				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
					<label><b>Teacher</b></label>
					<select class="form-control selectpicker" data-live-search="true" name="teacher">
						<option value="0">All Teachers</option>
					<?php
						$sql1 = "SELECT * FROM es_staff";
						$res1 = mysql_query($sql1);
						while( $row = mysql_fetch_assoc($res1))
						{
    						echo"<option value='".$row['es_staffid']."'> ".$row['st_firstname']." ".$row['st_lastname']." </option>";
    					}
    				?>
					</select>
				</div>

				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
					<label><b>Surveyor</b></label>
					<select class="form-control selectpicker" data-live-search="true" name="surveyor">
						<option value="0">All Teachers</option>
						<?php
							$sql1 = "SELECT * FROM es_staff";
							$res1 = mysql_query($sql1);
							while( $row = mysql_fetch_assoc($res1))
							{
    							echo"<option value='".$row['es_staffid']."'> ".$row['st_firstname']." ".$row['st_lastname']." </option>";
    						}
    					?>
					</select>
				</div>


				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
					<label><b>Standard</b></label>
					<select name="survey_standard" class="form-control selectpicker" data-live-search="true" name="standard"   onchange="fetchdivision(this.value)">
						<option value="0">All Standard</option>
					<?php
						$sql1 = "SELECT * FROM es_classes";
						$res1 = mysql_query($sql1);
						while( $row = mysql_fetch_assoc($res1))
						{
    						echo"<option value='".$row['es_classesid']."'> ".$row['es_classname']." </option>";
    					}
    				?>
					</select>
				</div>

				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
					<label><b>Select Division</b></label>
					<select class="form-control" id="divisions" name="division">
						<option value="0" >ALL DIVISION</option>
					</select>
				</div>

				<!-- 

				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
					<label><b>Subject</b></label>
					<select class="form-control selectpicker" name="subject"></select>
				</div> -->

			</div>
			<!-- Modal Footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">SEARCH</button>
			</div>
			</form>

		</div>
	</div>
</div>
</div>

<div class="panel panel-default">

	<div class="panel-heading">
		<strong>Random Visit List</strong>
	</div>
	<?php
		$sql = "SELECT new_survey.*, es_classes.es_classname, es_subject.es_subjectname, es_staff1.st_firstname, es_staff1.st_lastname, es_staff2.st_firstname AS reviewer_fname, es_staff2.st_lastname AS reviewer_lname, isd_class_division.division_name FROM new_survey INNER JOIN es_classes ON es_classes.es_classesid = new_survey.survey_standard INNER JOIN es_subject ON es_subject.es_subjectid = new_survey.survey_subject INNER JOIN es_staff es_staff1 ON es_staff1.es_staffid = new_survey.survey_reviewer INNER JOIN es_staff es_staff2 ON es_staff2.es_staffid = new_survey.teacher_id INNER JOIN `isd_class_division` ON `isd_class_division`.`class_division_id` = `new_survey`.`survey_division` WHERE (`new_survey`.`survey_type`=1)";

		if((isset($_POST['from_date']) && isset($_POST['to_date'])) && ($_POST['from_date']!='' && $_POST['to_date']!=''))
		{
			$sql .= " AND (survey_date BETWEEN '".$_POST['from_date']."' AND '".$_POST['to_date']."')";
		}
		else
		{
			$sql .= " AND (survey_date BETWEEN '".$_SESSION['eschools']['from_finance']."' AND '".$_SESSION['eschools']['to_finance']."')";
		}

		if(isset($_POST['teacher']) && $_POST['teacher']!='0')
		{
			$sql .= " AND (teacher_id='".$_POST['teacher']."')";	
		}
		if(isset($_POST['surveyor']) && $_POST['surveyor']!=0)
		{
			$sql .= " AND (survey_reviewer='".$_POST['surveyor']."')";
		}
		if(isset($_POST['standard']) && $_POST['standard']!=0)
		{
			$sql .= " AND (survey_standard='".$_POST['standard']."')";
		}
		if(isset($_POST['division']) && $_POST['division']!=0)
		{
			$sql .= " AND (survey_division='".$_POST['division']."')";
		}
		if(isset($_POST['subject']) && $_POST['subject']!=0)
		{
			$sql .= " AND (survey_subject='".$_POST['subject']."')";
		}

		$sql = mysql_query($sql);

		 ?>
		 	<div class="panel-body">
		 	<div class="table-responsive">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th width="5%">ID</th>
					<th width="10%">Date</th>
					<th>Standard</th>
					<th>Title</th>
					<th>Subject</th>
					<th>Teacher</th>
					<th>Surveyor</th>
					<th width="10%">Status</th>
					<th width="10%">Action</th>
				</tr>
			</thead>
			<tbody>
		<?php
		$i=1;
			while ($row = mysql_fetch_assoc($sql)) {
			?>
				<tr>
					<td><?php echo $i++; ?></td>
					<td><?php echo date_format(date_create($row['survey_date']), 'd/m/Y'); ?></td>
					<td><?php echo $row['es_classname']; ?> - <?php echo $row['division_name']; ?></td>
					<td><?php echo $row['survey_title']; ?></td>
					<td><?php echo $row['es_subjectname']; ?></td>
					<td><?php echo $row['reviewer_fname']." ".$row['reviewer_lname']; ?></td>
					<td><?php echo $row['st_firstname']." ".$row['st_lastname']; ?></td>
					<td><a <?php if($row['status'] == "Pending"){ echo 'class="btn btn-warning btn-xs"';}else{echo 'class="btn btn-success btn-xs"';}?> href="query_1.php?action=status_survey&s_status=<?php echo $row['status'];?>&survey_id=<?php echo $row['survey_id']; ?>"><?php echo $row['status'];?></a></td>
					<td><a href="?pid=135&action=view_survey_detail&survey_id=<?php echo $row['survey_id'] ?>"> <i class="fa fa-eye" aria-hidden="true"></i></a> | 
					<a href="?pid=135&action=edit_survey_detail&survey_id=<?php echo $row['survey_id'] ?>"><i class="fa fa-pencil-square-o"></i></a> |

					<a href="query_1.php?action=delete_survey_detail&survey_id=<?php echo $row['survey_id'] ?>"><i class="fa fa-trash-o"></i></a>

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

<div id="panel-1" class="panel panel-default">

	<div class="panel-heading">
		<strong>Monthly Visit List</strong>
	</div>
	<?php
		$sql = "SELECT new_survey.*, es_classes.es_classname, es_subject.es_subjectname, es_staff1.st_firstname, es_staff1.st_lastname, es_staff2.st_firstname AS reviewer_fname, es_staff2.st_lastname AS reviewer_lname, `isd_class_division`.`division_name` FROM new_survey INNER JOIN es_classes ON es_classes.es_classesid = new_survey.survey_standard INNER JOIN es_subject ON es_subject.es_subjectid = new_survey.survey_subject INNER JOIN es_staff es_staff1 ON es_staff1.es_staffid = new_survey.survey_reviewer INNER JOIN es_staff es_staff2 ON es_staff2.es_staffid = new_survey.teacher_id INNER JOIN `isd_class_division` ON `isd_class_division`.`class_division_id` = `new_survey`.`survey_division` WHERE (`new_survey`.`survey_type`=2)";
			if((isset($_POST['from_date']) && isset($_POST['to_date'])) && ($_POST['from_date']!='' && $_POST['to_date']!=''))
			{
				$sql .= " AND (survey_date BETWEEN '".$_POST['from_date']."' AND '".$_POST['to_date']."')";
			}
		else
		{
			$sql .= " AND (survey_date BETWEEN '".$_SESSION['eschools']['from_finance']."' AND '".$_SESSION['eschools']['to_finance']."')";
		}
			if(isset($_POST['teacher']) && $_POST['teacher']!='0')
			{
				$sql .= " AND (teacher_id='".$_POST['teacher']."')";	
			}
			if(isset($_POST['surveyor']) && $_POST['surveyor']!=0)
			{
				$sql .= " AND (survey_reviewer='".$_POST['surveyor']."')";
			}
			if(isset($_POST['standard']) && $_POST['standard']!=0)
			{
				$sql .= " AND (survey_standard='".$_POST['standard']."')";
			}
			if(isset($_POST['division']) && $_POST['division']!=0)
			{
				$sql .= " AND (survey_division='".$_POST['division']."')";
			}
			if(isset($_POST['subject']) && $_POST['subject']!=0)
			{
				$sql .= " AND (survey_subject='".$_POST['subject']."')";
			}
		  $sql = mysql_query($sql);

		 ?>
		 	<div class="panel-body">
		 	<div class="table-responsive">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th width="5%">ID</th>
					<th width="10%">Date</th>
					<th>Standard</th>
					<th>Title</th>
					<th>Subject</th>
					<th>Teacher</th>
					<th>Surveyor</th>
					<th width="10%">Status</th>
					<th width="10%">Action</th>
				</tr>
			</thead>
			<tbody>
		<?php
		$i=1;
			while ($row = mysql_fetch_assoc($sql)) {
			?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo date_format(date_create($row['survey_date']), 'd/m/Y'); ?></td>
					<td><?php echo $row['es_classname']; ?> - <?php echo $row['division_name']; ?></td>
					<td><?php echo $row['survey_title']; ?></td>
					<td><?php echo $row['es_subjectname']; ?></td>
					<td><?php echo $row['reviewer_fname']." ".$row['reviewer_lname']; ?></td>
					<td><?php echo $row['st_firstname']." ".$row['st_lastname']; ?></td>
					<td><a <?php if($row['status'] == "Pending"){ echo 'class="btn btn-warning btn-xs"';}else{echo 'class="btn btn-success btn-xs"';}?> href="query_1.php?action=status_survey&s_status=<?php echo $row['status'];?>&survey_id=<?php echo $row['survey_id']; ?>"><?php echo $row['status'];?></a></td>
					<td><a href="?pid=135&action=view_survey_detail&survey_id=<?php echo $row['survey_id'] ?>"><i class="fa fa-eye" aria-hidden="true"></i></a> |

						<a href="?pid=135&action=edit_survey_detail&survey_id=<?php echo $row['survey_id'] ?>"><i class="fa fa-pencil-square-o"></i></a> |

					<a href="query_1.php?action=delete_survey_detail&survey_id=<?php echo $row['survey_id'] ?>"><i class="fa fa-trash-o"></i></a>
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
<!-- get table by selected teacher -->

	<script>
	function view_survey_ajax(str)
	{
		
		// var t = document.getElementById("teacher_name").innerHTML;
		// alert(t);exit;

    if (str == "") {
        document.getElementById("view_survey").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("view_survey").innerHTML = xmlhttp.responseText;
            }
        };
        var teacher_id = document.getElementById("teacher_id").value;
        xmlhttp.open("GET","ajax1.php?action=view_survey_ajax&q="+str+"&teacher_id="+teacher_id,true);
        xmlhttp.send();
    }
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
    		divisions.innerHTML = "<option value='0'>All Division</option>";
			divisions.innerHTML = divisions.innerHTML + this.responseText;
        	}
    	};
    	xmlhttp.open("GET","ajax.php?action=divisions&q="+str,true);
    	xmlhttp.send();
	}
</script>	

</div>