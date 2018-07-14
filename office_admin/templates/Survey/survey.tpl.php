 <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
<?php
	if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" )
	{
		header('location: ./?pid=1&unauth=0');
		exit;
	}
?>

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
			<select name="teacher_name" class="form-control selectpicker" data-live-search="true" onchange="survey_bonus_ajax(this.value)" required="required">
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

		

		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
			<label>Standard<font color="#FF0000">&nbsp;*</font></label>
			<select name="survey_standard" class="form-control selectpicker" data-live-search="true" onchange="survey_subject_ajax(this.value)" required="required">
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

		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
			<label>Division<font color="#FF0000">&nbsp;*</font></label>
			<select id="survey_division" name="survey_division" class="form-control" required="required">
			</select>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
			<label>Subject<font color="#FF0000">&nbsp;*</font></label>
			<select id="survey_subject" name="survey_subject" class="form-control" required="required">
			</select>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label>Date</label>
			<input type="text" name="survey_date" id="survey_date" value="<?php echo date('Y-m-d'); ?>" class="form-control datepicker" readonly>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label>Reviewer Name<font color="#FF0000">&nbsp;*</font></label>
			<select name="survey_reviewer_name" class="form-control selectpicker" data-live-search="true" required="required">
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

		$.get( "ajax.php?action=subjects&q="+str, function( data ) {
  			$( "#survey_subject" ).html( data );
		});

		$.get( "ajax.php?action=divisions&q="+str, function( data ) {
  			$( "#survey_division" ).html( data );
		});
    
	}
	</script>

<?php } ?>

<?php  if($action=='view_survey_detail'){

 

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
			echo"<tr><th colspan=3>RANDOM VISIT EVOLUTION</th>";
		}else{
			echo"<tr><th colspan=3>MONTHLY VISIT EVOLUTION</th>";
		}			
			echo "</tr>
			<tr><th>Title</th>
			<th>Evolution</th>
			<th>Actual Bonus</th>
			<th>Bonus</th>
			</tr>";
		

			$sql1 = mysql_query("SELECT * FROM new_survey_child WHERE survey_id=".$_GET['survey_id']);
			$tmp_amount = 0;
			while($row = mysql_fetch_assoc($sql1))
			{
			?>
			<tr>
				<td><?php echo $row['option_title']; ?></td>
				<td><?php echo $row['rating']."%"; ?></td>
				<td><?php echo ($sql['survey_bonus'] * $row['actual_rating']) / 100; ?></td>
				<td><?php echo $row['b_amount']; ?></td>

				<!-- <td><?php if($row['rating']==3){echo'Excellent';}else if($row['rating']==2){echo'Good';}else if($row['rating']==1){echo'Fair';}else{echo'N.A';} ?></td> -->
			</tr>
			<?php
				$tmp_amount = $row['b_amount'];
				$total_amount = $total_amount + $tmp_amount;

		}
	?>
	<tr><th colspan="2">Totol Bonus</th>
		<th> <?php echo $sql['survey_bonus']; ?></th>
		<th><?php echo round($total_amount);?></th></tr>
	
	</table>

	
	<a href="print_survay.php?survey_id=<?php echo $_GET['survey_id'] ?>" role="button" class="btn">Print</a>
	</div>

</div>

<?php }?>
<?php if($action=='survey_option'){ ?>
<div id="panel-1" class="panel panel-default">

	<div class="panel-heading">
		<span class="title elipsis">
			<strong><?php echo isset($_GET['editid'])?'EDIT SURVEY OPTION':'NEW SURVEY OPTION'; ?></strong>
		</span>

		<ul class="options pull-right list-inline">
			<li><font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif" size="2">Note :  * denotes mandatory&nbsp;</font></li>
								
		</ul>
	</div>

	<div class="panel-body">
	<form action="query_1.php" method="post" name="<?php echo isset($_GET['editid'])?'edit':'new'; ?>_survey_option">
		<?php if(isset($_GET['editid']))
				{
					echo"<input type='hidden' name='option_id' value='".$_GET['editid']."'>";
					$sql = mysql_query("SELECT * FROM new_survey_option WHERE option_id=".$_GET['editid']);
					$result = mysql_fetch_array($sql);
				}
		?>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
					<label><b>Standard</b></label>
					<select name="class_id" class="form-control selectpicker" data-live-search="true" name="standard">
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

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<label><b> Option Title </b></label>
			<input type="text" name="option_title" value="<?php echo $result['option_title']; ?>" class="form-control" required="required">
		</div>


		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<label><b> Percentage </b>(%)</label>
			<input type="text" name="options" value="<?php echo $result['options']; ?>" class="form-control" required="required">
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<label><b>Type </b></label>
			<div class="form-group">
			<div class="col-sm-6">
			<input type="radio" name="survey_type" class="" value="1" required="required" checked="checked"> Weekly Survey Option
			</div>
			<div class="col-sm-6">
			<input type="radio" name="survey_type" class="" value="2" required="required"> Monthly Survey Option 
			</div>
			</div>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<input type="submit" name="<?php echo isset($_GET['editid'])?'edit':'new'; ?>_survey_option" value="<?php echo isset($_GET['editid'])?'UPDATE':'SUBMIT'; ?>" class="btn btn-primary pull-right">
		</div>
	</form>
	</div>

</div>
<div id="panel-1" class="panel panel-default">
		<div class="panel-heading">

		<span class="title elipsis">
			<strong>Search</strong>
		</span>
	</div>
	<div class="panel-body">
		<form name="ssfetch" method="POST" action="query_1.php">

	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 form-group">
					
					<select name="class_id" class="form-control selectpicker" data-live-search="true" name="standard">
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
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 form-group">
				<input type="submit" name="fetchss" value="Search" class="btn btn-primary pull-right">
				</div>
				</form>
				</div>
			</div>

<div id="panel-1" class="panel panel-default">

	<div class="panel-heading">

		<span class="title elipsis">
			<strong>Random Visit Option</strong>
		</span>
	</div>


	<div class="panel-body">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Sr No.</th>
					<th>Option Title</th>
					<th>Options</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$i = 1;
				$sql1 = mysql_query("SELECT * FROM new_survey_option");
				while($row = mysql_fetch_assoc($sql1))
				{ if($row['type'] == 1 && $row['class_id'] == $_GET['classid']){
				?>

					<tr>
						<td> <?php echo $i; ?> </td>
						<td> <?php echo $row['option_title']; ?> </td>
						<td> <?php echo $row['options']."%"; ?> </td>
						<td>
							<a href="?pid=135&action=survey_option&editid=<?php echo $row['option_id']; ?>"> <i class="fa fa-pencil-square-o"></i> </a>
							<a href="query.php?action=delete_survey_option&deleteid=<?php echo $row['option_id']; ?>" onclick="return confirm('Do you really want to delete this option?');"> <i class="fa fa-trash-o"></i> </a> </td>
					</tr>
				<?php
				$i++;
				}}
			?>
			</tbody>
		</table>
	</div>
</div>

<div id="panel-1" class="panel panel-default">

	<div class="panel-heading">
		<span class="title elipsis">
			<strong>Monthly Visit Option</strong>
		</span>
	</div>

	<div class="panel-body">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Sr No.</th>
					<th>Option Title</th>
					<th>Options</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$i = 1;
				$sql1 = mysql_query("SELECT * FROM new_survey_option");
				while($row = mysql_fetch_assoc($sql1))
				{ if($row['type'] == 2 && $row['class_id'] == $_GET['classid']){
				?>

					<tr>
						<td> <?php echo $i; ?> </td>
						<td> <?php echo $row['option_title']; ?> </td>
						<td> <?php echo $row['options']."%"; ?> </td>
						<td>
							<a href="?pid=135&action=survey_option&editid=<?php echo $row['option_id']; ?>"> <i class="fa fa-pencil-square-o"></i> </a>
							<a href="query.php?action=delete_survey_option&deleteid=<?php echo $row['option_id']; ?>" onclick="return confirm('Do you really want to delete this option?');"> <i class="fa fa-trash-o"></i> </a> </td>
					</tr>
				<?php
				$i++;
				}}
			?>
			</tbody>
		</table>
	</div>
</div>


<?php } ?>

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
			<select name="teacher_name" class="form-control selectpicker" data-live-search="true" onchange="survey_bonus_ajax(this.value)" required="required">
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
			<label>Standard<font color="#FF0000">&nbsp;*</font></label>
			<select name="survey_standard" class="form-control selectpicker" data-live-search="true" onchange="survey_subject_ajax(this.value)" required="required" id="standard_id">
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
			<select name="survey_reviewer_name" class="form-control selectpicker" data-live-search="true">
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
		
		<div class="" id="test1"></div>
		

	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<label>Notes</label>
			<textarea name="survey_description" class="form-control"></textarea>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<input type="submit" name="new_survey" value="SUBMIT" class="btn btn-primary pull-right">
		</div>
		<input type="hidden" value="<?php echo $sql['actual_bonus'];?>" name="actual_bonus">
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



        alert("hello");
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

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-print-6 form-group">
			<label>Survey Title<font color="#FF0000">&nbsp;*</font></label>
			<input type="text" name="survey_title" class="form-control" value="<?php echo $sql['survey_title']; ?>">
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-print-6 form-group">
			<label>Name of the Teacher<font color="#FF0000">&nbsp;*</font></label>
			<select name="teacher_name" id="teacher_name" class="form-control selectpicker" data-live-search="true" onchange="survey_bonus_ajax(this.value)">
			<?php
				$sql1 = "SELECT * FROM es_staff";
				$res1 = mysql_query($sql1);
				while( $row = mysql_fetch_assoc($res1))
				{
					if($sql['teacher_id'] == $row['es_staffid']){

						$selected = "selected='selected'";
					}else{$selected = "";}
    				echo"<option value='".$row['es_staffid']."'".$selected."> ".$row['st_firstname']." ".$row['st_lastname']." </option>";
    			}
    		?>
			</select>
		</div>

		

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-print-6 form-group">
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

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-print-6 form-group">
			<label>Subject<font color="#FF0000">&nbsp;*</font></label>
			<select id="survey_subject" name="survey_subject" class="form-control" required="required">
			<option value="<?php echo $sql['survey_subject'];?>" selected="selected"><?php echo $sql['es_subjectname'];?></option>
			</select>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-print-6 form-group">
			<label>Date</label>
			<input type="text" name="survey_date" id="survey_date" value="<?php echo $sql['survey_date']; ?>" class="form-control datepicker" readonly >
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-print-6 form-group">
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
		<input type="hidden" value="<?php echo $sql['actual_bonus'];?>" name="actual_bonus">
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
										<td><input type="radio" value="<?php echo 12.5*10*$row['actual_rating']/100;?>" name="bonus[<?php echo $i;?>]"
										<?php 
										 if($row['actual_rating'] < $row['rating']){echo "checked='checked'";} ?> required="required">
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

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group no-print">
			<input type="submit" name="edit_survey" value="UPDATE" class="btn btn-primary pull-right">
		</div>

		</form>
	</div>

</div>

<script>
	function survey_subject_ajax(str)
	{


        alert("hello");
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

<?php  if($action=='view_survey')
{
	include'view_survey.php';
}?>
<?php if($action=='survey_groups')
{ ?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="title elipsis">
				<strong>SURVEY GROUPS</strong>
			</span>
		</div>
		<div class="panel-body">
			<?php
				$sql = mysql_query("SELECT new_survey_teacher_group.*, es_staff.* FROM new_survey_teacher_group INNER JOIN es_staff ON new_survey_teacher_group.head_teacher_id =  es_staff.es_staffid ORDER BY CHAR_LENGTH(teachers_id) DESC");
			?>
			<?php
				while($row = mysql_fetch_assoc($sql))
				{
			?>
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
			<table class="table table-bordered table-striped table-condensed">
				<thead>
					<tr>
						<th> * </th>
						<th><?php echo $row['st_firstname']." ".$row['st_fthname']." ".$row['st_lastname']; ?></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$sub_teacher = explode(',', $row['teachers_id']);
						for($j=0;$j<count($sub_teacher);$j++)
						{
							$teacher_detail = mysql_fetch_array(mysql_query("SELECT * FROM es_staff WHERE es_staffid =".$sub_teacher[$j]));
					?>
						<tr>
							<td><?php echo $j + 1; ?></td>
							<td><?php echo $teacher_detail['st_firstname']." ".$teacher_detail['st_fthname']." ".$teacher_detail['st_lastname']; ?></td>
						</tr>
					<?php
						}
					?>
				</tbody>
			</table>
			</div>
			<?php
				}
			?>

		</div>
	</div>
</div>

<?php }
?>
