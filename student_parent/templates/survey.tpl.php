<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

<?php if($action=='view_survey') { 
	$sql = mysql_fetch_array(mysql_query("SELECT new_survey.*, es_classes.es_classname, es_subject.es_subjectname, es_staff1.st_firstname, es_staff1.st_lastname, es_staff2.st_firstname AS reviewer_fname, es_staff2.st_lastname AS reviewer_lname FROM new_survey INNER JOIN es_classes ON es_classes.es_classesid = new_survey.survey_standard INNER JOIN es_subject ON es_subject.es_subjectid = new_survey.survey_subject INNER JOIN es_staff es_staff1 ON es_staff1.es_staffid = new_survey.survey_reviewer INNER JOIN es_staff es_staff2 ON es_staff2.es_staffid = new_survey.teacher_id WHERE new_survey.survey_id = ".$_GET['survey_id']));

	?>
<div id="panel-1" class="panel panel-default">

	<div class="panel-heading">
		<span class="title elipsis">
			<strong><?php if($sql['survey_type'] == 1){ echo "Random Visit Evolution Form";}else{ echo "Monthly Visit Evolution Form";} ?></strong>
		</span>
	</div>
	<div class="panel-body">
	<table  class="table table-bordered">
		<tr>
			<th colspan="2">Survey Title : </th>
			<th colspan="2">Date</th>
		</tr>
		<tr>
			<td colspan="2"><?php echo $sql['survey_title']; ?></td>
			<td colspan="2"><?php echo $sql['survey_date']; ?></td>
		</tr>
		
		
		<tr>
			<th>Teacher Name</th><td><?php echo $sql['reviewer_fname']." ".$sql['reviewer_lname']; ?></td>
			<th>Surveyor Name</th><td><?php echo $sql['st_firstname']." ".$sql['st_lastname']; ?></td>
		</tr>
		<tr>
			<th>Standard</th><td><?php echo $sql['es_classname']; ?></td>
			<th>Subject</th><td><?php echo $sql['es_subjectname']; ?></td>
		</tr>
		<tr>
			<th colspan="4"> Survey Description : </th>
		</tr>
		<tr>
			<td colspan="4"> <?php echo $sql['survey_description']; ?></td>
		</tr>
	</table>
	

	<table class="table table-bordered">
	<?php
	// print_r($sql);
		// $option_titles = explode("@",$sql['survey_options_title']);
		// foreach ($option_titles as $option_title) {
			if($sql['survey_type'] == 1){
			echo"<tr><th colspan=2>RANDOM VISIT EVOLUTION</th>";
		}else{
			echo"<tr><th colspan=2>MONTHLY VISIT EVOLUTION</th>";
		}			
			echo "</tr>
			<tr><th>Title</th>
			<th>Growth</th>
			
			</tr>";
		

			$sql1 = mysql_query("SELECT * FROM new_survey_child WHERE survey_id=".$_GET['survey_id']);
			$tmp_amount = 0;
			while($row = mysql_fetch_assoc($sql1))
			{
			?>
			<tr>
				<td><?php echo $row['option_title']; ?></td>
				<!--<td><?php echo $row['rating']."%"; ?></td>
				<td><?php echo $row['b_amount']; ?></td>-->

				<td><?php if($row['rating'] > $row['actual_rating']){echo'Excellent';}else if($row['rating']== $row['actual_rating']){echo'Good';}else if($row['rating'] < $row['actual_rating'] && $row['rating'] != 0){echo'Fair';}else{echo'N.A';} ?></td>
			</tr>
			<?php
				$tmp_amount = $row['b_amount'];
				$total_amount = $total_amount + $tmp_amount;

		}
	?>
	<!--<tr><th colspan="2">Totol Bonus</th><th><?php echo $total_amount;?></th></tr>-->
	
	</table>

	

	</div>
</div>


<?php } ?>

<?php  if($action=='survey_list'){ ?>

<div id="panel-1" class="panel panel-default">

	<div class="panel-heading">
		<span class="title elipsis">
			<strong>RANDOM VISIT</strong>
		</span>
	</div>

	<div class="panel-body table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th>Sr No.</th>
					<th>Title</th>
					<th>Standard</th>
					<th>Subject</th>
					<th>Date</th>
					<th>Teacher Name</th>
					<th>Action</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
		<?php
			$sql = mysql_query("SELECT new_survey.*, es_classes.es_classname, es_subject.es_subjectname, es_staff.st_firstname, es_staff.st_lastname FROM new_survey INNER JOIN es_classes ON es_classes.es_classesid = new_survey.survey_standard INNER JOIN es_subject ON es_subject.es_subjectid = new_survey.survey_subject INNER JOIN es_staff ON es_staff.es_staffid = new_survey.teacher_id WHERE new_survey.survey_reviewer = ".$_SESSION['eschools']['user_id']." AND new_survey.survey_type = 1");
			$i = 1;
			while ($row = mysql_fetch_assoc($sql)) {
			?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $row['survey_title']; ?></td>
					<td><?php echo $row['es_classname']; ?></td>
					<td><?php echo $row['es_subjectname']; ?></td>
					<td><?php echo $row['survey_date']; ?></td>
					<td><?php echo $row['st_firstname']." ".$row['st_lastname']; ?></td>
					<td><a href="?pid=60&action=view_survey&survey_id=<?php echo $row['survey_id'] ?>">View</a> |
                                        <?php if($row['status']=="Pending"){?>
					<a href="?pid=60&action=edit_survey_detail&survey_id=<?php echo $row['survey_id'] ?>"><i class="fa fa-pencil-square-o"></i></a> <?php }else{ ?><i class="fa fa-pencil-square-o"></i><?php } ?>
                                        
					</td>
					<td><a href="" <?php if($row['status'] == "Pending"){ echo 'class="btn btn-primary"';}else{echo 'class="btn btn-success"';}?> ><?php echo $row['status']; ?></a></td>
				</tr>
			<?php $i++;
			} 
			?>
			</tbody>
		</table>
	</div>

</div>
<div id="panel-1" class="panel panel-default">

	<div class="panel-heading">
		<span class="title elipsis">
			<strong>MONTHLY VISIT</strong>
		</span>
	</div>

	<div class="panel-body table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th>Sr No.</th>
					<th>Title</th>
					<th>Standard</th>
					<th>Subject</th>
					<th>Date</th>
					<th>Teacher Name</th>
					<th>Action</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
		<?php
			$sql = mysql_query("SELECT new_survey.*, es_classes.es_classname, es_subject.es_subjectname, es_staff.st_firstname, es_staff.st_lastname FROM new_survey INNER JOIN es_classes ON es_classes.es_classesid = new_survey.survey_standard INNER JOIN es_subject ON es_subject.es_subjectid = new_survey.survey_subject INNER JOIN es_staff ON es_staff.es_staffid = new_survey.teacher_id WHERE new_survey.survey_reviewer = ".$_SESSION['eschools']['user_id']." AND new_survey.survey_type = 2");
			$i = 1;
			while ($row = mysql_fetch_assoc($sql)) {
			?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $row['survey_title']; ?></td>
					<td><?php echo $row['es_classname']; ?></td>
					<td><?php echo $row['es_subjectname']; ?></td>
					<td><?php echo $row['survey_date']; ?></td>
					<td><?php echo $row['st_firstname']." ".$row['st_lastname']; ?></td>
					<td><a href="?pid=60&action=view_survey&survey_id=<?php echo $row['survey_id'] ?>">View</a> |
                                        <?php if($row['status']=="Pending"){?>
					<a href="?pid=60&action=edit_survey_detail&survey_id=<?php echo $row['survey_id'] ?>"><i class="fa fa-pencil-square-o"></i></a><?php }else{?><i class="fa fa-pencil-square-o"></i><?php } ?>
                                     
					</td>
					<td><a href="" <?php if($row['status'] == "Pending"){ echo 'class="btn btn-primary"';}else{echo 'class="btn btn-success"';}?> ><?php echo $row['status']; ?></a></td>
				</tr>
			<?php $i++;
			} 
			?>
			</tbody>
		</table>
	</div>

</div>
<?php
if($_SESSION['eschools']['st_postaplied'] == 1)
{
?>
<div id="panel-1" class="panel panel-default">

	<div class="panel-heading">
		<span class="title elipsis">
			<strong>SURVEYS DONE BY YOU</strong>
		</span>
	</div>

	<div class="panel-body table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th>Sr No.</th>
					<th>Title</th>
					<th>Standard</th>
					<th>Subject</th>
					<th>Date</th>
					<th>Teacher</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
		<?php
			$sql = mysql_query("SELECT new_survey.*, es_classes.es_classname, es_subject.es_subjectname, es_staff.st_firstname, es_staff.st_lastname FROM new_survey INNER JOIN es_classes ON es_classes.es_classesid = new_survey.survey_standard INNER JOIN es_subject ON es_subject.es_subjectid = new_survey.survey_subject INNER JOIN es_staff ON es_staff.es_staffid = new_survey.survey_reviewer WHERE new_survey.survey_reviewer = ".$_SESSION['eschools']['user_id']);
			$i = 1;
			while ($row = mysql_fetch_assoc($sql)) {
			?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $row['survey_title']; ?></td>
					<td><?php echo $row['es_classname']; ?></td>
					<td><?php echo $row['es_subjectname']; ?></td>
					<td><?php echo $row['survey_date']; ?></td>
					<td><?php echo $row['st_firstname']." ".$row['st_lastname']; ?></td>
					<td><a href="?pid=60&action=view_survey&survey_id=<?php echo $row['survey_id'] ?>">View</a></td>
				</trd
			<?php
			}
			?>
			</tbody>
		</table>
	</div>

</div>

<?php } ?>

<?php } ?>

<?php  if($action=='new_survey'){ ?>

<div id="panel-1" class="panel panel-default">

	<div class="panel-heading">
		<span class="title elipsis">
			<strong>RANDOM VISIT EVOLUTION SURVEY FORM</strong>
		</span>
	</div>

	<div class="panel-body">
		<form name="new_survey" action="query_1.php" method="post" enctype="multipart/form-data">
		<input type="hidden" name="survey_type" value="1">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<label><b>Survey Detail</b></label>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label>Survey Title<font color="#FF0000">&nbsp;*</font></label>
			<input type="text" name="survey_title" class="form-control">
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label>Name of the Teacher<font color="#FF0000">&nbsp;*</font></label>
		<?php	$t_id = "SELECT teachers_id FROM new_survey_teacher_group WHERE head_teacher_id=".$_SESSION['eschools']['user_id'];
		// echo $t_id;

				$result_id = mysql_fetch_array(mysql_query($t_id));
			
				$option_titles = explode(",",$result_id['teachers_id']);
				 ?>
				
			<select name="teacher_name" class="form-control selectpicker" data-live-search="true" onchange="survey_bonus_ajax(this.value)" required="required">
			<option value="">Select Teacher</option>
			<?php
			foreach ($option_titles as $option_title) {
			$res1 = mysql_query("SELECT es_staffid,st_firstname,st_lastname FROM es_staff WHERE es_staffid =$option_title");
			echo $sql1;

				// $res1 = mysql_query($sql1);
				while( $row = mysql_fetch_assoc($res1))
				{
    				echo"<option value='".$row['es_staffid']."'> ".$row['st_firstname']." ".$row['st_lastname']." </option>";
    			}
    		}
    		?>
			</select>
		</div>

		

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label>Standard<font color="#FF0000">&nbsp;*</font></label>
			<select name="survey_standard" class="form-control selectpicker" data-live-search="true" onchange="survey_subject_ajax(this.value)"  required="required">
                             <option selected disabled> --SELECT STANDARD--</option>
			<?php
				$sql = mysql_query("SELECT * FROM es_classes");
				while($row = mysql_fetch_assoc($sql))
				{
					echo"<option value='".$row['es_classesid']."'>".$row['es_classname']."</option>";
				}
			?>
			</select>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label>Subject<font color="#FF0000">&nbsp;*</font></label>
			<select id="survey_subject" name="survey_subject" class="form-control" required="required">
			</select>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label>Date</label>
			<input type="text" name="survey_date" id="survey_date" value="<?php echo date('Y-m-d'); ?>" class="form-control datepicker" readonly>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label>Reviewer Name</label>
			<input type="hidden" readonly="" name="survey_reviewer_name" class="form-control" value="<?php echo $_SESSION['eschools']['user_id'];?>">
			<?php
			 $t_name = "SELECT es_staffid,st_firstname,st_lastname FROM es_staff WHERE es_staffid =".$_SESSION['eschools']['user_id'];
			 // echo $t_name;
			 $result_id = mysql_fetch_array(mysql_query($t_name));
 		// print_r($result_id);
			?>
			<input type="text" readonly="readonly" class="form-control" name="" value="<?php echo $result_id['st_firstname']." ".$result_id['st_firstname'];  ?>">
			<!-- <select name="survey_reviewer_name" class="form-control selectpicker" data-live-search="true">
			<?php
				$sql1 = "SELECT * FROM es_staff";
				$res1 = mysql_query($sql1);
				while( $row = mysql_fetch_assoc($res1))
				{
    				echo"<option value='".$row['es_staffid']."'> ".$row['st_firstname']." ".$row['st_lastname']." </option>";
    			}
    		?>
    		</select> -->
		</div>
		
		<div class="" id="test"></div>
		

	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<label>Notes</label>
			<textarea name="survey_description" class="form-control"></textarea>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<input type="submit" name="new_survey" value="SUBMIT" class="btn btn-primary pull-right">
		</div>

		</form>
	</div>

</div>
	<!-- get table by selected teacher -->

	<script>
	function survey_bonus_ajax(str)
	{
		
		// var t = document.getElementById("teacher_name").innerHTML;
		// alert(t);exit;

    if (str == "") {
        document.getElementById("test").innerHTML = "";
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
                document.getElementById("test").innerHTML = xmlhttp.responseText;
            }
        };
        var survey_date = document.getElementById("survey_date").value;
        xmlhttp.open("GET","ajax1.php?action=bonus_teacher&q="+str+"&s_date="+survey_date,true);
        xmlhttp.send();
    }
	}
	</script>	
	

	<!-- get table by selected teacher -->

	<script>
	function survey_subject_ajax(str)
	{
    if (str == "") {
        document.getElementById("survey_subject").innerHTML = "";
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
                document.getElementById("survey_subject").innerHTML = xmlhttp.responseText;
            }
        };

        xmlhttp.open("GET","ajax.php?action=subjects&q="+str,true);
        xmlhttp.send();
    }
	}
	</script>

<?php }?>

<?php  if($action=='monthly_survey'){ ?>
<div id="panel-1" class="panel panel-default">

	<div class="panel-heading">
		<span class="title elipsis">
			<strong>MONTHLY EVOLUTION FORM</strong>
		</span>
	</div>

	<div class="panel-body">
		<form name="new_survey" action="query_1.php" method="post" enctype="multipart/form-data">
		<input type="hidden" name="survey_type" value="2">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<label><b>Survey Detail</b></label>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label>Survey Title<font color="#FF0000">&nbsp;*</font></label>
			<input type="text" name="survey_title" class="form-control">
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label>Name of the Teacher<font color="#FF0000">&nbsp;*</font></label>
		<?php	$t_id = "SELECT teachers_id FROM new_survey_teacher_group WHERE head_teacher_id=".$_SESSION['eschools']['user_id'];
		// echo $t_id;

				$result_id = mysql_fetch_array(mysql_query($t_id));
			
				$option_titles = explode(",",$result_id['teachers_id']);
				 ?>
				
			<select name="teacher_name" class="form-control selectpicker" data-live-search="true" onchange="survey_bonus_ajax(this.value)" required="required">
			<option value="">Select Teacher</option>
			<?php
			foreach ($option_titles as $option_title) {
			$res1 = mysql_query("SELECT es_staffid,st_firstname,st_lastname FROM es_staff WHERE es_staffid =$option_title");
			echo $sql1;

				// $res1 = mysql_query($sql1);
				while( $row = mysql_fetch_assoc($res1))
				{
    				echo"<option value='".$row['es_staffid']."'> ".$row['st_firstname']." ".$row['st_lastname']." </option>";
    			}
    		}
    		?>
			</select>
		</div>

		

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label>Standard</label>
			<select name="survey_standard" class="form-control selectpicker" data-live-search="true" onchange="survey_subject_ajax(this.value)">
			<option selected="selected" disabled="disabled">--SELECT CLASS--</option>
			<?php
				$sql = mysql_query("SELECT * FROM es_classes");
				while($row = mysql_fetch_assoc($sql))
				{
					echo"<option value='".$row['es_classesid']."'>".$row['es_classname']."</option>";
				}
			?>
			</select>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label>Subject</label>
			<select id="survey_subject" name="survey_subject" class="form-control">
			</select>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label>Date</label>
			<input type="text" name="survey_date" id="survey_date" value="<?php echo date('Y-m-d'); ?>" class="form-control datepicker" readonly>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label>Reviewer Name</label>
			<input type="hidden" readonly="" name="survey_reviewer_name" class="form-control" value="<?php echo $_SESSION['eschools']['user_id'];?>">
			<?php
			 $t_name = "SELECT es_staffid,st_firstname,st_lastname FROM es_staff WHERE es_staffid =".$_SESSION['eschools']['user_id'];
			 // echo $t_name;
			 $result_id = mysql_fetch_array(mysql_query($t_name));
 		// print_r($result_id);
			?>
			<input type="text" readonly="readonly" class="form-control" name="" value="<?php echo $result_id['st_firstname']." ".$result_id['st_firstname'];  ?>">
			<!-- <select name="survey_reviewer_name" class="form-control selectpicker" data-live-search="true">
			<?php
				$sql1 = "SELECT * FROM es_staff";
				$res1 = mysql_query($sql1);
				while( $row = mysql_fetch_assoc($res1))
				{
    				echo"<option value='".$row['es_staffid']."'> ".$row['st_firstname']." ".$row['st_lastname']." </option>";
    			}
    		?>
    		</select> -->
		</div>
		
		<div class="" id="test1"></div>
		

	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<label>Notes</label>
			<textarea name="survey_description" class="form-control"></textarea>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<input type="submit" name="new_survey" value="SUBMIT" class="btn btn-primary pull-right">
		</div>

		</form>
	</div>

</div>

	<!-- get table by selected teacher -->

	<script>
	function survey_bonus_ajax(str)
	{
	
		// var t = document.getElementById("teacher_name").innerHTML;
		// alert(t);exit;

    if (str == "") {
        document.getElementById("test1").innerHTML = "";
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
                document.getElementById("test1").innerHTML = xmlhttp.responseText;
            }
        };
        var survey_date = document.getElementById("survey_date").value;
        xmlhttp.open("GET","ajax1.php?action=monthly_bonus_teacher&q="+str+"&s_date="+survey_date,true);
        xmlhttp.send();
    }
	}
	</script>	
	
	<!-- get table by selected teacher -->

	<script>
	function survey_subject_ajax(str)
	{
    if (str == "") {
        document.getElementById("survey_subject").innerHTML = "";
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
                document.getElementById("survey_subject").innerHTML = xmlhttp.responseText;
            }
        };

        xmlhttp.open("GET","ajax.php?action=subjects&q="+str,true);
        xmlhttp.send();
    }
	}
	</script>


<?php } ?>


</div>

<!-- edit survey form -->
<?php if($action=='edit_survey_detail'){ 

$sql = mysql_fetch_array(mysql_query("SELECT new_survey.*, es_classes.es_classname, es_subject.es_subjectname, es_staff1.st_firstname, es_staff1.st_lastname, es_staff2.st_firstname AS reviewer_fname, es_staff2.st_lastname AS reviewer_lname FROM new_survey INNER JOIN es_classes ON es_classes.es_classesid = new_survey.survey_standard INNER JOIN es_subject ON es_subject.es_subjectid = new_survey.survey_subject INNER JOIN es_staff es_staff1 ON es_staff1.es_staffid = new_survey.survey_reviewer INNER JOIN es_staff es_staff2 ON es_staff2.es_staffid = new_survey.teacher_id WHERE new_survey.survey_id = ".$_GET['survey_id']));

// print_r($sql);


	?>
	<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

	<div id="panel-1" class="panel panel-default">

	<div class="panel-heading">
		<span class="title elipsis">
			<strong><?php if($sql['survey_type']==1){echo "RANDOM VISIT EVOLUTION SURVEY FORM";}else{echo "MONTHLY EVOLUTION FORM";}?></strong>
		</span>
	</div>

	<div class="panel-body">
		<form name="edit_survey" action="query_1.php" method="post" enctype="multipart/form-data">
		<input type="hidden" name="survey_type" value="<?php echo $sql['survey_type'];?>">
		<input type="hidden" name="survey_id" value="<?php echo $sql['survey_id'];?>">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<label><b>Survey Detail</b></label>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label>Survey Title<font color="#FF0000">&nbsp;*</font></label>
			<input type="text" name="survey_title" class="form-control" value="<?php echo $sql['survey_title']; ?>">
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label>Name of the Teacher<font color="#FF0000">&nbsp;*</font></label>
		<?php	$t_id = "SELECT teachers_id FROM new_survey_teacher_group WHERE head_teacher_id=".$_SESSION['eschools']['user_id'];
		// echo $t_id;

				$result_id = mysql_fetch_array(mysql_query($t_id));
			
				$option_titles = explode(",",$result_id['teachers_id']);
				 ?>
				
			<select name="teacher_name" class="form-control selectpicker" data-live-search="true" onchange="survey_bonus_ajax(this.value)" required="required">
			<option value="">Select Teacher</option>
			<?php
			foreach ($option_titles as $option_title) {
			$res1 = mysql_query("SELECT es_staffid,st_firstname,st_lastname FROM es_staff WHERE es_staffid =$option_title");
			echo $sql1;

				// $res1 = mysql_query($sql1);
				while( $row = mysql_fetch_assoc($res1))
				{
                                      if($sql['teacher_id'] == $row['es_staffid']){

						$selected = "selected='selected'";
					}else{$selected = "";}

    				echo"<option value='".$row['es_staffid']."'".$selected."> ".$row['st_firstname']." ".$row['st_lastname']." </option>";
    			}
    		}
    		?>
			</select>
		</div>

		

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label>Standard<font color="#FF0000">&nbsp;*</font></label>
			<select name="survey_standard" class="form-control selectpicker" data-live-search="true" onchange="survey_subject_ajax(this.value)" required="required">
			<option selected="selected" disabled="disabled">--SELECT CLASS--</option>
			<?php
				$sql_class = mysql_query("SELECT * FROM es_classes");
				while($row = mysql_fetch_assoc($sql_class))
				{
					if($sql['survey_standard'] == $row['es_classesid']){

						$selected = "selected='selected'";
					}else{$selected = "";}

					echo"<option value='".$row['es_classesid']."'".$selected."> ".$row['es_classname']."</option>";
				}
			?>
			</select>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label>Subject<font color="#FF0000">&nbsp;*</font></label>
			<select id="survey_subject" name="survey_subject" class="form-control" required="required">
			<option value="<?php echo $sql['survey_subject'];?>" selected="selected"><?php echo $sql['es_subjectname'];?></option>
			</select>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label>Date</label>
			<input type="text" name="survey_date" id="survey_date" value="<?php echo $sql['survey_date']; ?>" class="form-control datepicker" readonly >
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label>Reviewer Name</label>
			<select name="survey_reviewer_name" class="form-control selectpicker" data-live-search="true">
			<?php
				$sql1 = "SELECT * FROM es_staff";
				$res1 = mysql_query($sql1);
				while( $row = mysql_fetch_assoc($res1))
				{
					if($sql['survey_reviewer'] == $row['es_staffid']){

						$selected = "selected='selected'";
					}else{$selected = "";}
    				echo"<option value='".$row['es_staffid']."'".$selected." > ".$row['st_firstname']." ".$row['st_lastname']." </option>";
    			}
    		?>
    		</select>
		</div>
		
		<div class="" id="test1"></div>
		 <div class="toggle transparent toggle-accordion">
			
			<input type="hidden" value="<?php echo $sql['actual_bonus'];?>" name="actual_bonus">
			

					
					<table class="fooTableInit table no-paging footable-loaded footable tablet">
								<thead>
									<tr>
										<th class="foo-cell"> Option </th>
										<th data-hide = "s300" class=""> Excellent </th>
										<th data-hide = "s300" class=""> Good </th>
										<th data-hide = "s300" class=""> Fair </th>
										<th data-hide = "s300" class=""> N.A </th>
									</tr>
								</thead>
								<tbody>
								
								<?php
				$sql2 = mysql_query("SELECT new_survey_child.* FROM new_survey_child INNER JOIN new_survey ON `new_survey`.`survey_id` =  `new_survey_child`.`survey_id` WHERE `new_survey`.`survey_id` =".$_GET['survey_id']);
				// echo "SELECT new_survey_child.* FROM new_survey_child INNER JOIN new_survey ON `new_survey`.`survey_id` =  `new_survey_child`.`survey_id` WHERE `new_survey`.`survey_id` =".$_GET['survey_id'];
				$i=0;
				while($row = mysql_fetch_array($sql2))
				{ 
			?>
									<tr>
										<td class="foo-cell"><?php echo $row['option_title']; ?>
										<input type="hidden" name="survey_child_id[<?php echo $i;?>]" value="<?php echo $row['survey_child_id']; ?>">
										<?php // echo $sql['survey_bonus'];?></td>
										<td><input type="radio" required value="<?php echo 12.5*10*$row['actual_rating']/100;?>" name="bonus[<?php echo $i;?>]"
										<?php 
										 if($row['actual_rating'] < $row['rating']){echo "checked='checked'";} ?>>
										</td>
										<td><input type="radio" value="<?php echo 10*10*$row['actual_rating']/100;?>" name="bonus[<?php echo $i;?>]"
										<?php 
										 if($row['actual_rating'] == $row['rating']){echo "checked='checked'";} ?>
										>
										</td>
										<td><input type="radio" value="<?php echo 7.5*10*$row['actual_rating']/100;?>" name="bonus[<?php echo $i;?>]"
											<?php 
										 if($row['actual_rating'] > $row['rating']){echo "checked='checked'";} ?>
										>
										</td>
										<td><input type="radio" value="0" name="bonus[<?php echo $i;?>]"
										<?php $i_val = 0; 
										 if($i_val == $row['rating']){echo "checked='checked'";} ?>
										>

										</td>
									</tr>
									<?php
				$i++;
				}
			?>
								</tbody>
							</table>
											
					
				
			
		</div>

	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<label>Notes</label>
			<textarea name="survey_description" class="form-control"><?php echo $sql['survey_description'];?></textarea>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<input type="submit" name="edit_survey" value="UPDATE" class="btn btn-primary pull-right">
		</div>

		</form>
	</div>

</div>

<script>
	function survey_subject_ajax(str)
	{
    if (str == "") {
        document.getElementById("survey_subject").innerHTML = "";
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
                document.getElementById("survey_subject").innerHTML = xmlhttp.responseText;
            }
        };

        xmlhttp.open("GET","ajax.php?action=subjects&q="+str,true);
        xmlhttp.send();
    }
	}
	</script>
</div>



<?php } ?>
<!-- /edit survey form -->