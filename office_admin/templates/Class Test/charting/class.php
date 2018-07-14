<?php
	$class_name = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_classes WHERE es_classesid = ".$_POST['standard_id']));

	$division_name = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM isd_class_division WHERE class_division_id = ".$_POST['division_id']));

	$test_query = "SELECT isd_class_tests.*, es_subject.es_subjectname FROM isd_class_tests INNER JOIN es_subject ON es_subject.es_subjectid = isd_class_tests.subject_id WHERE test_status='COMPLETED' AND division_id = ".$_POST['division_id']." AND class_test_date BETWEEN '".$_POST['from_date']."' AND '".$_POST['to_date']."'";

	if($_POST['subject_id'] != 0)
	{
		$test_query = $test_query." AND subject_id=".$_POST['subject_id'];
	}

	$tests = mysqli_query($mysqli_con, $test_query);

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
<table style="width: 90%;">
	<caption><?php echo strtoupper($class_name['es_classname']." - ".$division_name['division_name']); ?></caption>
	<thead>
		<tr>
			<td></td>
           	<?php
           	while ($row = mysqli_fetch_assoc($tests)) {
			echo"<th scope='col'> ".date_format(date_create($row['class_test_date']), 'd/m/Y')." <br>".$row['es_subjectname']."<br>".$row['es_classname']." - ".$row['division_name']."</th>";
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
			$AVG = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT AVG(scored_marks) as avg_scored_marks FROM isd_class_test_marks WHERE class_test_id=".$row['class_test_id']));
			echo"<td>".round($AVG['avg_scored_marks'],2)."</td>";
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