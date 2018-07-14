<?php
	$teacher = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_staff WHERE es_staffid = ".$_POST['teacher_id']));

	$tests = mysqli_query($mysqli_con, "SELECT isd_class_tests.*, es_subject.es_subjectname, es_classes.es_classname, isd_class_division.division_name FROM isd_class_tests INNER JOIN es_subject ON es_subject.es_subjectid = isd_class_tests.subject_id INNER JOIN es_classes ON es_classes.es_classesid = isd_class_tests.standard_id INNER JOIN isd_class_division ON isd_class_division.class_division_id = isd_class_tests.division_id WHERE test_status='COMPLETED' AND teacherid = ".$_POST['teacher_id']." AND class_test_date BETWEEN '".$_POST['from_date']."' AND '".$_POST['to_date']."'");

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
	<caption><?php echo strtoupper($teacher['st_firstname']." ".$teacher['st_lastname']); ?></caption>
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