
<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
<?php
         		if(isset($_GET['emsg']))
         		{
         			if($_GET['emsg']==1)
         			{
         				echo"Test has been started successfully.";
         			}
         		}
         	?>

<?php 
/*
*Start of Create Examination a particular staff can create Exam for his class only
*/	
if ($action=="start_test"){
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
         <td height="3" colspan="3">
         	
         </td>
  </tr>
	<tr>
		<td height="25" colspan="3" class="bgcolor_02" align="center"><table width="95%"><tr class="bgcolor_02"><td align="left">START TEST</td><td  align="right" valign="top" ></td></tr></table></td>
	</tr>
	<form action="query.php" method="post" name="start_test">
	<input type="hidden" name="action" value="<?php echo $action?>" >
	<tr>
		<td width="1" class="bgcolor_02"></td>
		<td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td colspan="2" align="right" valign="top"><font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif" size="2">Note :  * denotes mandatory&nbsp;</font><br /></td>
			</tr>
			<tr>
				<td width="18%" height="25" align="left" valign="middle" class="narmal">&nbsp;Standard&nbsp;</td>
			  <td width="82%" height="25" align="left" valign="middle">
			  <?php
				$query1 = mysql_query("SELECT * FROM es_classes");
				?>
			  <select class="selectpicker form-control"  data-live-search="true" name="standard" id="standard" required="required" onchange="showSubjects(this.value)">
                    <option disabled selected value> --- Select Standard --- </option>
                    <?php
                    	while($row = mysql_fetch_assoc($query1))
                    	{
                    		echo"<option value='".$row['es_classesid']."'>".$row['es_classname']."</option>";
                    	}
                    ?>
              </select>
			  <font color="#FF0000">*</font></td>
			</tr>
			<tr>
				<td width="18%" height="25" align="left" valign="middle" class="narmal">&nbsp;Subject&nbsp;</td>
			  <td width="82%" height="25" align="left" valign="middle">
			  <select class="form-control" name="subjects" id="subjects" required="required">
                    <option selected disabled> --- Select Subject --- </option>
              </select>
			  <font color="#FF0000">*</font></td>
			</tr>
			<tr>
				<td width="18%" height="25" align="left" valign="middle" class="narmal">&nbsp;Total Marks&nbsp;</td>
			  <td width="82%" height="25" align="left" valign="middle">
			  <input type="text" class="form-control" name="testmarks" id="testmarks" required="required" maxlength=3 size=3 />
			  <font color="#FF0000">*</font></td>
			</tr>
			<tr>
				<td width="18%" height="25" align="left" valign="middle" class="narmal">&nbsp;Test Date&nbsp;</td>
			  <td width="82%" height="25" align="left" valign="middle">
			  <input data-datepick="dateFormat: 'yyyy-mm-dd'" size="10" class="form-control" name="testdate" id="testdate" required="required" placeholder="yyyy-mm-dd"/>
			  <font color="#FF0000">*</font></td>
			</tr>
			<tr>
				<td height="25" align="left" valign="middle" class="narmal">&nbsp;</td>
				<td height="25" align="left" valign="middle" class="narmal">
			  <input name="start_test" type="submit" class="bgcolor_02" value="Start Test" style="cursor:pointer" /></td>
			</tr>
			</table>
		</td>
		<td width="1" class="bgcolor_02"></td>
	</tr>
	</form>
	<tr><td height="1" colspan="3" class="bgcolor_02"></td>
	</tr>
</table>
<?php }

if ($action=="view_test"){
	$query1 = mysql_query("SELECT es_class_tests.*, es_classes.es_classname, es_subject.es_subjectname, es_staff.st_firstname, es_staff.st_lastname  FROM es_class_tests INNER JOIN es_classes ON es_class_tests.es_classesid=es_classes.es_classesid INNER JOIN es_subject ON es_class_tests.es_subjectid=es_subject.es_subjectid INNER JOIN es_staff ON es_class_tests.es_staffid=es_staff.es_staffid WHERE es_class_tests.es_staffid=".$_SESSION['eschools']['user_id']);
?>

                             <table width="100%" border="1" cellspacing="0" cellpadding="0"><thead>
                                <tr>
                                    <td>Test ID</td>
                                    <td>Date</td>
                                    <td>Marks</td>
                                    <td>Standard</td>
                                    <td>Subject</td>
                                    <td>Teacher Name</td>
                                    <td>Test Status</td>
                                    <td></td>
                                    <td></td>
                                </tr></thead><tbody id="d_table">
                                <?php
                                    while( $row = mysql_fetch_assoc($query1))
                                    {
                                ?>
    
                                <tr>
                                    <td><?php echo $row['class_test_id']; ?></td>
                                    <td><?php echo date('d-M-Y', strtotime($row['testdate'])); ?></td>
                                    <td><?php echo $row['totalmarks']; ?></td>
                                    <td><?php echo $row['es_classname']; ?></td>
                                    <td><?php echo $row['es_subjectname']; ?></td>
                                    <td><?php echo $row['st_firstname']." ".$row['st_lastname']; ?></td>
                                    <td><?php echo $row['status']; ?></td>
                                    <?php
                                        if($row['status']=="PENDING")
                                        {
                                    	echo"<td><a href='index.php?pid=59&action=enter_test_marks&test_id=".$row['class_test_id']."'>Enter Marks</a></td>";

                                        }
                                        else if($row['status']=="ACTIVE")
                                        {
                                    		echo"<td><a href='index.php?pid=59&action=enter_test_marks&test_id=".$row['class_test_id']."'>Edit Marks</a></td>";
                                        }
                                        else 
                                        {
                                        	echo"<td> Submitted </td>";
                                    	}


                                        if($row['status']=="CLOSED")
                                        {
                                        	echo"<td><a href='index.php?pid=59&action=view_marksheet&test_id=".$row['class_test_id']."'>View Marksheet</a></td>";
                                        }
                                     	
                                     	else if($row['status']=="ACTIVE")
                                        { ?>
                                    		<td><a href="query.php?action=end_test&test_id=<?php echo $row['class_test_id']; ?>" onclick="return confirm('do you really want to end this test?')">End Test</a></td>

                                        <?php }
                                        else
                                        {
                                        	echo"<td></td>";
                                     	}
                                     	?>        
                                </tr>
       
                                    <?php 
                                     } ?>
                                </tbody>
                            </table>


<?php }
if ($action=="enter_test_marks"){
	$query1 = mysql_query("SELECT es_class_tests.*, es_classes.es_classname, es_subject.es_subjectname FROM es_class_tests INNER JOIN es_classes ON es_class_tests.es_classesid=es_classes.es_classesid INNER JOIN es_subject ON es_class_tests.es_subjectid=es_subject.es_subjectid WHERE es_class_tests.class_test_id=".$_GET['test_id']." AND es_class_tests.es_staffid=".$_SESSION['eschools']['user_id']);
	$result1 = mysql_fetch_array($query1);
	if(mysql_num_rows($query1)<1)
	{
		echo"No test found or you dont have permission to view this page";
	}
	else
	{

?>
	<table width="100%" border="1" cellspacing="0" cellpadding="0">
        <tr>
        	<td><strong>Test ID :</strong> <?php echo $result1['class_test_id']; ?></td>
        	<td><strong>Test Date : </strong> <?php echo $result1['testdate']; ?></td>
        </tr>
        <tr>
        	<td><strong>Standard :</strong> <?php echo $result1['es_classname']; ?> </td>
       		<td><strong>Total Marks :</strong> <?php echo $result1['totalmarks']; ?> </td>
        </tr>
        <tr>
        	<td colspan=2><strong>Subject :</strong> <?php echo $result1['es_subjectname']; ?> </td>
        </tr>
    </table>

    <?php
    if($result1['status']=='PENDING')
    	{
    		$query2 = mysql_query("SELECT * FROM es_preadmission  WHERE pre_class=".$result1['es_classesid']);
    	}
    else
    	{
    		$query2 = mysql_query("SELECT es_class_test_marksheet.*, es_preadmission.pre_name, es_preadmission.middle_name, es_preadmission.pre_lastname FROM es_class_test_marksheet INNER JOIN es_preadmission ON es_class_test_marksheet.student_id=es_preadmission.es_preadmissionid  WHERE es_class_test_marksheet.class_test_id=".$result1['class_test_id']);

    	}
    
    ?>

    <br><br>
    <strong><?php echo $result1['status']=='PENDING'?'Enter Marks':'Update Marks'; ?></strong>

   	<table width="100%" border="1" cellspacing="0" cellpadding="0">
   	<form action="query.php" method="post" name="<?php echo $result1['status']=='PENDING'?'enter_marks':'update_marks'; ?>">
   	<input type="hidden" name="test_id" value="<?php echo $result1['class_test_id']; ?>">
  		<tr>
    		<td>Student ID.</td>
    		<td>Student Name</td>
    		<td>Scored Marks (Select 'AB' if student is Absent.)</td>
  		</tr>
	 

		<?php
		while( $row = mysql_fetch_assoc($query2)){
		?>
    
   	 	<tr>
    		<td>
    			<?php echo $result1['status']=='PENDING'?$row['es_preadmissionid']:$row['student_id']; ?>
    			<input type="hidden" name="student_id[]" value="<?php echo $result1['status']=='PENDING'?$row['es_preadmissionid']:$row['es_marksheet_id']; ?>">
    		</td>
    		<td><?php echo $row['pre_name']." ".$row['middle_name']." ".$row['pre_lastname']; ?></td>
    		<td>
    			<select name="scored_marks[]" required="required">

    				<?php
    				for($i=0; $i<=$result1['totalmarks']; $i++)
    				{
    					if($row['scored_marks']==$i)
    					{
    						echo"<option selected value='".$i."'> ".$i." </option>";
    					}
    					else
    					{
    						echo"<option value='".$i."'> ".$i." </option>";
    					}
    				}
    				?>
    					<option value="AB">AB</option>
    			</select>
    		</td>
    	</tr>
    	<?php 
   			}
		?>
		<tr>
			<td colspan="3">
				<input type="submit" value="<?php echo $result1['status']=='PENDING'?'Submit Marks':'Update Marks'; ?>" name="<?php echo $result1['status']=='PENDING'?'enter_marks':'update_marks'; ?>">
			</td>
		</tr>
	</form>
	</table>

<?php
	}
}
if ($action=="view_marksheet"){

	$query1=mysql_query("SELECT es_class_tests.*, es_classes.es_classname, es_subject.es_subjectname, es_staff.st_firstname, es_staff.st_lastname  FROM es_class_tests INNER JOIN es_classes ON es_class_tests.es_classesid=es_classes.es_classesid INNER JOIN es_subject ON es_class_tests.es_subjectid=es_subject.es_subjectid INNER JOIN es_staff ON es_class_tests.es_staffid=es_staff.es_staffid WHERE es_class_tests.class_test_id=".$_GET['test_id']." AND es_class_tests.es_staffid=".$_SESSION['eschools']['user_id']);
	$result1 = mysql_fetch_array($query1);
?>

	   	<lable><strong><u> Test Detail</u></strong></lable>
      	<table width="100%" border="1" cellspacing="0" cellpadding="0">
                          <tr>
                          <td><strong>Test ID :</strong> <?php echo $_GET['test_id']; ?></td>
                          <td><strong>Test Date : </strong> <?php echo $result1['testdate']; ?></td>
                          <td><strong>Total Marks :</strong> <?php echo $result1['totalmarks']; ?> </td>
                          </tr>
                          <tr>
                          <td><strong>Standard :</strong> <?php echo $result1['es_classname']; ?> </td>
                          <td colspan=2><strong>Subject :</strong> <?php echo $result1['es_subjectname']; ?> </td>
                          </tr>
       	</table>
        <br>

    <?php
    	$query2 = mysql_query("SELECT COUNT(*) FROM `es_preadmission` WHERE pre_class=".$result1['es_classesid']);
		$result2 = mysql_fetch_array($query2);

		$query3 = mysql_query("SELECT es_class_test_marksheet.*, es_preadmission.pre_name, es_preadmission.middle_name, es_preadmission.pre_lastname FROM es_class_test_marksheet INNER JOIN es_preadmission ON es_class_test_marksheet.student_id=es_preadmission.es_preadmissionid  WHERE es_class_test_marksheet.class_test_id=".$_GET['test_id']." ORDER BY es_class_test_marksheet.scored_marks DESC");
		$result3 = mysql_num_rows($query3);

    	$query4 = mysql_query("SELECT AVG(scored_marks) FROM `es_class_test_marksheet` WHERE class_test_id=".$_GET['test_id']);
		$result4 = mysql_fetch_array($query4);


		$seventyper = ($result1['totalmarks'] * 70) / 100;

		$query5 = mysql_query("SELECT AVG(scored_marks) FROM `es_class_test_marksheet` WHERE scored_marks>=".$seventyper." AND class_test_id=".$_GET['test_id']);
		$result5 = mysql_fetch_array($query5);

		$query6 = mysql_query("SELECT AVG(scored_marks) FROM `es_class_test_marksheet` WHERE scored_marks<".$seventyper." AND class_test_id=".$_GET['test_id']);
		$result6 = mysql_fetch_array($query6);

		$query7 = mysql_query("SELECT COUNT(*) FROM `es_class_test_marksheet` WHERE scored_marks>=".$seventyper." AND class_test_id=".$_GET['test_id']);
	?>
        <lable><strong><u> Grades Detail </u></strong></lable>
      	<table width="100%" border="1" cellspacing="0" cellpadding="0">
            <tr>
                <td><strong>Excluded Student :</strong></td>
                <td colspan="5"> <?php echo $result2[0]-$result3; ?></td>
            </tr>
           	<tr>
              	<td><strong>Total Student : </strong></td>
              	<td> <?php echo $result3; ?></td>
                <td><strong>Number of Student Scored Above 70% :</strong></td>
                <td> <?php echo mysql_num_rows($query7); ?> </td>
                <td><strong>Number of Student Scored Below 70% :</strong></td>
                <td> <?php echo $result3-mysql_num_rows($query7); ?> </td>
            </tr>
            <tr>
                <td><strong>Avg. Marks of All Students :</strong></td>
                <td> <?php echo round($result4[0],2); ?> </td>
                <td><strong>Avg. Marks of Students Scored Above 70% :</strong></td>
                <td> <?php echo round($result5[0],2); ?> </td>
                <td><strong>Avg. Marks of Students Scored Below 70% :</strong></td>
                <td> <?php echo round($result6[0],2); ?> </td>
            </tr>
        </table>

        <br><br>
        <lable><strong><u> Marksheet </u> </strong></lable>
		<table width="100%" border="1" cellspacing="0" cellpadding="0">
  			<tr>
    			<td>Student ID</td>
    			<td>Student Name</td>
    			<td>Scored Marks</td>
    			<td>Percentage</td>
    			<td>Rank</td>
  			</tr>
		<?php
		$i=1;
			while( $row = mysql_fetch_assoc($query3)){
		?>
    
    		<tr>
    			<td><?php echo $row['student_id']; ?></td>
    			<td><?php echo $row['pre_name']." ".$row['middle_name']." ".$row['pre_lastname']; ?></td>
    			<td><?php echo $row['scored_marks'] ?></td>
    			<td><?php echo round(($row['scored_marks'] * 100) / $result1['totalmarks'], 2); ?>%</td>
    			<td><?php echo $i ?></td>
    		</tr>
       
		<?php $i++;  
   		}
		?>
		</table>
<?php
}
?>


<script>
function showSubjects(str) {
    if (str == "") {
        document.getElementById("subjects").innerHTML = "";
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
                document.getElementById("subjects").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","showSubjects.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
</div>