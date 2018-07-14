<?php
	$student = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_preadmission WHERE es_preadmissionid = ".$_POST['student_id']));

	$class_name = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_classes WHERE es_classesid = ".$_POST['standard_id']));

	$division_name = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM isd_class_division WHERE class_division_id = ".$_POST['division_id']));

        
	$tests = mysqli_query($mysqli_con, "SELECT * FROM isd_class_test_marks INNER JOIN isd_class_tests ON isd_class_tests.class_test_id = isd_class_test_marks.class_test_id INNER JOIN es_subject ON es_subject.es_subjectid = isd_class_tests.subject_id WHERE isd_class_tests.academic_year_id = ".$_POST['academic_year_id']." AND isd_class_tests.standard_id = ".$_POST['standard_id']." AND  isd_class_test_marks.student_id = ".$_POST['student_id']." AND class_test_date BETWEEN '".$_POST['from_date']."' AND '".$_POST['to_date']."'");

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<title>Charting</title>
	<link href="<?php echo base_url('assets/charting/css/basic.css'); ?>" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="<?php echo base_url('assets/charting/js/enhance.js'); ?>"></script>
	<script type="text/javascript">
		// Run capabilities test
		enhance({
			loadScripts: [
				{src: '<?php echo base_url('assets/charting/js/excanvas.js'); ?>', iecondition: 'all'},
				'<?php echo base_url('assets/charting/js/jquery.js'); ?>',
				'<?php echo base_url('assets/charting/js/visualize.jQuery.js'); ?>',
				'<?php echo base_url('assets/charting/js/example.js'); ?>'
			],
			loadStyles: [
				'<?php echo base_url('assets/charting/css/visualize.css'); ?>',
				'<?php echo base_url('assets/charting/css/visualize-dark.css'); ?>'
			]
		});
    </script>
</head>
<body>
<table >
	<caption><?php echo $student['pre_name']." ".$student['middle_name']." ".$student['pre_lastname']." (".$class_name['es_classname']." - ".$division_name['division_name'].")"; ?></caption>
	<thead>
		<tr>
			<td></td>
            <?php
              	while ($row = mysqli_fetch_assoc($tests)) {
					echo"<th scope='col'> ".date_format(date_create($row['class_test_date']), 'd/m/Y')." <br>".$row['es_subjectname']."<br></th>";
            } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th scope="row">Total Marks</th>
           	<?php
           	mysqli_data_seek($tests,0);
         	while ($row = mysqli_fetch_assoc($tests)) {
				echo"<td>".$row['total_marks']."</td>";
           	} ?>
		</tr>
		<tr>
			<th scope="row">Scored Marks</th>
            <?php
           	mysqli_data_seek($tests,0);
         	while ($row = mysqli_fetch_assoc($tests)) {
				echo"<td>".$row['scored_marks']."</td>";
           	} ?>
		</tr>
		<tr>
			<th scope="row">Marksheet</th>
                        <?php
                        mysqli_data_seek($tests,0);
                        while ($row =mysqli_fetch_assoc($tests)) {
			echo"<td><a href='?pid=138&action=view_marksheet&test_id=".$row['class_test_id']."' target='_blank'>View</a></td>";
                        } ?>
		</tr>
	</tbody>
</table>	

</body>
</html>