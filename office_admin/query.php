<?php
session_start();
include ('../includes/db_config.php');

	if(isset($_POST['new_survey']))
	{
		$option_title = implode("@",$_POST['option_title']);
		$sql = "INSERT INTO new_survey(survey_title, teacher_id, survey_description, survey_standard, survey_subject, survey_date, survey_reviewer, survey_options_title) VALUES(";
		$sql .= "'".$_POST['survey_title']."',";
		$sql .= "'".$_POST['teacher_name']."',";
		$sql .= "'".$_POST['survey_description']."',";
		$sql .= "'".$_POST['survey_standard']."',";
		$sql .= "'".$_POST['survey_subject']."',";
		$sql .= "'".$_POST['survey_date']."',";
		$sql .= "'".$_POST['survey_reviewer_name']."',";
		$sql .= "'".$option_title."')";

		mysql_query($sql);
		$survey_id = mysql_insert_id();
		$i = 0;
		foreach ($_POST['option_title'] as $option_title) {
			$j = 0;
			foreach ($_POST['option'][$i] as $option) {
				$sql = "INSERT INTO new_survey_child(survey_id, option_title, option_description, rating) VALUES(";
				$sql .= "'".$survey_id."',";
				$sql .= "'".$option_title."',";
				$sql .= "'".$option."',";
				$sql .= "".$_POST['rating'][$i][$j].")";

				mysql_query($sql);
				$j++;
			}
			$i++;
		}
		header('location: index.php?pid=135&action=new_survey&emsg=1');
	}

	if(isset($_POST['new_survey_option']))
	{
		$sql = "INSERT INTO new_survey_option(option_title,options) VALUES(";
		$sql .= "'".$_POST['option_title']."',";
		$sql .= "'".$_POST['options']."')";

		mysql_query($sql);
		header('location: index.php?pid=135&action=survey_option&emsg=1');

	}

	if(isset($_POST['edit_survey_option']))
	{
		$sql = "UPDATE new_survey_option SET ";
		$sql .= "option_title = '".$_POST['option_title']."', ";
		$sql .= "options = '".$_POST['options']."'";
		$sql .= " WHERE option_id = ".$_POST['option_id'];

		mysql_query($sql);
		header('location: index.php?pid=135&action=survey_option&emsg=1');

	}

	if(isset($_POST['update_salary']))
	{
		print_r($_POST);
		$sql = "UPDATE es_payslipdetails SET ";
		$sql .= "tot_allowance = '".$_POST['tot_allowance']."', ";
		$sql .= "tot_deductions = '".$_POST['tot_deductions']."',";
		$sql .= "net_salary = '".$_POST['net_salary']."'";
		$sql .= " WHERE es_payslipdetailsid = ".$_POST['payslip_id'];

		$sql1 = "UPDATE es_voucherentry SET ";
		$sql1 .= "es_paymentmode = '".$_POST['es_paymentmode']."', ";
		$sql1 .= "es_amount = '".$_POST['net_salary']."' ";
		$sql1 .= " WHERE es_voucherentryid = ".$_POST['voucherentryid'];

		echo $sql1;

		mysql_query($sql);
		mysql_query($sql1);

		$i = 0;
		foreach ($_POST['child_id'] as $child) {
			$sql2 = "UPDATE new_payslip_childs SET ";
			$sql2 .= "amount = '".$_POST['value'][$child]."'";
			$sql2 .= " WHERE payslip_child_id =".$child;

			mysql_query($sql2);
			$i++;
		}

		header('location: index.php?pid=136&action=employeewisepayslip');

	}

	if(isset($_GET['action']) && $_GET['action']=='delete_survey_option')
	{
		$sql = "DELETE FROM new_survey_option WHERE option_id = ".$_GET['deleteid'];
		mysql_query($sql);
		header('location: index.php?pid=135&action=survey_option&emsg=1');
	}

	if(isset($_POST['saveallowance']))
	{
		$dc1 = $_POST['from_year']."-".$_POST['from_month'];
		$dc2 = $_POST['to_year']."-".$_POST['to_month'];
		$sql = "INSERT INTO es_allowencemaster(alw_type, alw_fromdate, alw_todate, alw_dept) VALUES(";
			$sql .= "'".$_POST['allonctype']."',";
			$sql .= "'".$dc1."',";
			$sql .= "'".$dc2."',";
			$sql .= "'".$_POST['st_department']."')";

			mysql_query($sql);

			$insert_id = mysql_insert_id();


		foreach ($_POST['staff'] as $teacher){

			$sql = "INSERT INTO new_allowencemaster_childs(es_allowencemasterid, es_staffid, alw_amount,alw_amt_type) VALUES(";
			$sql .= $insert_id.",";
			$sql .= "'".$teacher."',";
			$sql .= "'".$_POST['alwamount'][$teacher]."',";
			$sql .= "'".$_POST['alw_amt_type'][$teacher]."')";

			mysql_query($sql);

		}
		
		header('location: index.php?pid=136&action=allowencemaster&id='.$insert_id);

	}

	if(isset($_POST['savededuction']))
	{
		$dc1 = $_POST['from_year']."-".$_POST['from_month'];
		$dc2 = $_POST['to_year']."-".$_POST['to_month'];

			$sql = "INSERT INTO es_deductionmaster(ded_type, ded_fromdate, ded_todate, ded_dept) VALUES(";
			$sql .= "'".$_POST['allonctype']."',";
			$sql .= "'".$dc1."',";
			$sql .= "'".$dc2."',";
			$sql .= "'".$_POST['st_department']."')";

			mysql_query($sql);

			$insert_id = mysql_insert_id();
		foreach ($_POST['staff'] as $teacher){

			$sql = "INSERT INTO new_deductionmaster_childs(es_deductionmasterid, es_staffid, ded_amount, ded_amt_type) VALUES(";
			$sql .= "'".$insert_id."',";
			$sql .= "'".$teacher."',";
			$sql .= "'".$_POST['alwamount'][$teacher]."',";
			$sql .= "'".$_POST['alw_amt_type'][$teacher]."')";

			mysql_query($sql);

		}
		
		header('location: index.php?pid=136&action=deductionsmaster&id='.$insert_id);

	}

	if(isset($_POST['savetax']))
	{

			$sql = "INSERT INTO es_taxmaster(es_dept, tax_name, tax_from_date, tax_to_date) VALUES(";
			$sql .= "'".$_POST['st_department']."', ";
			$sql .= "'".$_POST['taxname']."', ";
			$sql .= "'".$_POST['from_date_year']."-".$_POST['from_date_month']."',";
			$sql .= "'".$_POST['to_date_year']."-".$_POST['to_date_month']."')";

			mysql_query($sql);

			echo $sql;

			$insert_id = mysql_insert_id();

		for($i=0;$i<count($_POST['slabratefrom']);$i++){

			$sql = "INSERT INTO new_taxmaster_childs(es_taxmasterid, slab_from, slab_to, tax_rate, tax_type) VALUES(";
			$sql .= "'".$insert_id."',";
			$sql .= "'".$_POST['slabratefrom'][$i]."',";
			$sql .= "'".$_POST['slabrateto'][$i]."',";
			$sql .= "'".$_POST['rateamount'][$i]."',";
			$sql .= "'".$_POST['allonctype'][$i]."')";

			mysql_query($sql);
			}

			header('location: index.php?pid=136&action=taxmaster&emsg=1');

	}

	if(isset($_POST['updateallowance']))
	{

			$sql = "UPDATE es_allowencemaster SET ";
			$sql .= "alw_type ='".$_POST['allonctype']."', ";
			$sql .= "alw_fromdate ='".$_POST['from_year']."-".$_POST['from_month']."', ";
			$sql .= "alw_todate ='".$_POST['to_year']."-".$_POST['to_month']."' ";
			$sql .= "WHERE es_allowencemasterid ='".$_POST['e_id']."'";

			mysql_query($sql);

			for($i=0;$i<count($_POST['elid_child']);$i++)
			{

				$sql = "UPDATE new_allowencemaster_childs SET ";
				$sql .= "alw_amount ='".$_POST['alw_amount'][$i]."', ";
				$sql .= "alw_amt_type ='".$_POST['alw_amt_type'][$i]."' ";
				$sql .= "WHERE new_allowencemaster_child_id ='".$_POST['elid_child'][$i]."'";

				mysql_query($sql);

			}

			header('location: index.php?pid=136&action=allowencemaster&id='.$_POST['e_id']);

	}

	if(isset($_POST['updatededuction']))
	{

			$sql = "UPDATE es_deductionmaster SET ";
			$sql .= "ded_type ='".$_POST['ded_type']."', ";
			$sql .= "ded_fromdate ='".$_POST['from_year']."-".$_POST['from_month']."', ";
			$sql .= "ded_todate ='".$_POST['to_year']."-".$_POST['to_month']."' ";
			$sql .= "WHERE es_deductionmasterid ='".$_POST['e_id']."'";

			mysql_query($sql);

			for($i=0;$i<count($_POST['elid_child']);$i++)
			{

				$sql = "UPDATE new_deductionmaster_childs SET ";
				$sql .= "ded_amount ='".$_POST['ded_amount'][$i]."', ";
				$sql .= "ded_amt_type ='".$_POST['ded_amt_type'][$i]."' ";
				$sql .= "WHERE new_deductionmaster_child_id ='".$_POST['elid_child'][$i]."'";

				mysql_query($sql);

			}

			header('location: index.php?pid=136&action=deductionsmaster&id='.$_POST['e_id']);

	}

	if(isset($_POST['updatetax']))
	{

			$sql = "UPDATE es_taxmaster SET ";
			$sql .= "tax_name ='".$_POST['tax_name']."',";
			$sql .= "tax_from_date ='".$_POST['from_year']."-".$_POST['from_month']."',";
			$sql .= "tax_to_date ='".$_POST['to_year']."-".$_POST['to_month']."' WHERE ";
			$sql .= "es_taxmasterid ='".$_POST['e_id']."'";

			mysql_query($sql);

			for($i=0;$i<count($_POST['elid_child']);$i++)
			{

			$sql = "UPDATE new_taxmaster_childs SET ";
			$sql .= "slab_from ='".$_POST['slabratefrom'][$i]."',";
			$sql .= "slab_to ='".$_POST['slabrateto'][$i]."',";
			$sql .= "tax_rate ='".$_POST['rate_amount'][$i]."',";
			$sql .= "tax_type ='".$_POST['rate_type'][$i]."' WHERE ";
			$sql .= "new_taxmaster_child_id ='".$_POST['elid_child'][$i]."'";

			mysql_query($sql);

			}

			header('location: index.php?pid=136&action=taxmaster&emsg=2');

	}

	if(isset($_POST['update_emp_payroll_data']))
	{
		foreach ($_POST['emp_id'] as $emp_id) {
		
			$sql = "UPDATE es_staff SET ";
			$sql .= "st_basic ='".$_POST['basic'][$emp_id]."', ";
			$sql .= "occupation2 ='".$_POST['b_code'][$emp_id]."', ";
			$sql .= "st_perviouspackage ='".$_POST['bonus'][$emp_id]."', ";
			$sql .= "occupation3 ='".$_POST['ac_no'][$emp_id]."' WHERE ";
			$sql .= "es_staffid ='".$emp_id."'";

			mysql_query($sql);
		}

		header('location: index.php?pid=136&action=update_employeedata');

	}

	if(isset($_POST['savepf']))
	{
		$sql = "INSERT INTO es_pfmaster(pf_post, pf_empcont, pf_empconttype, pf_empycont, pf_empyconttype, pf_dept, pf_from_date, pf_to_date) VALUES(";
		$sql .= "'1', ";
		$sql .= "'".$_POST['employeercont']."', ";
		$sql .= "'".$_POST['empconttype']."', ";
		$sql .= "'".$_POST['employeecont']."', ";
		$sql .= "'".$_POST['emyconttype']."', ";
		$sql .= "'".$_POST['st_department']."', ";
		$sql .= "'".$_POST['from_date_year']."-".$_POST['from_date_month']."', ";
		$sql .= "'".$_POST['to_date_year']."-".$_POST['to_date_month']."')";

		mysql_query($sql);

		header('location: index.php?pid=136&action=pfmaster');

	}

	if(isset($_POST['remallowance']))
	{
		for($i=0;$i<count($_POST['elid_child']);$i++){

			$sql = "INSERT INTO new_allowencemaster_childs(es_allowencemasterid, es_staffid, alw_amount,alw_amt_type) VALUES(";
			$sql .= $_POST['alwid'].",";
			$sql .= "'".$_POST['elid_child'][$i]."',";
			$sql .= "'".$_POST['alw_amount'][$i]."',";
			$sql .= "'".$_POST['alw_amt_type'][$i]."')";

			mysql_query($sql);

		}
		
		header('location: index.php?pid=136&action=allowencemaster&id='.$_POST['alwid']);
	}

	if(isset($_POST['remdeduction']))
	{
		for($i=0;$i<count($_POST['elid_child']);$i++){

			$sql = "INSERT INTO new_deductionmaster_childs(es_deductionmasterid, es_staffid, ded_amount,ded_amt_type) VALUES(";
			$sql .= $_POST['alwid'].",";
			$sql .= "'".$_POST['elid_child'][$i]."',";
			$sql .= "'".$_POST['ded_amount'][$i]."',";
			$sql .= "'".$_POST['ded_amt_type'][$i]."')";

			mysql_query($sql);

		}
		
		header('location: index.php?pid=136&action=deductionsmaster&id='.$_POST['alwid']);
	}

	if(isset($_POST['updatepf']))
	{

		
			$sql = "UPDATE es_pfmaster SET ";
			$sql .= "pf_empcont ='".$_POST['employeercont']."', ";
			$sql .= "pf_empconttype ='".$_POST['empconttype']."', ";
			$sql .= "pf_empycont ='".$_POST['employeecont']."', ";
			$sql .= "pf_empyconttype ='".$_POST['emyconttype']."', ";
			$sql .= "pf_from_date ='".$_POST['from_year']."-".$_POST['from_month']."', ";
			$sql .= "pf_to_date ='".$_POST['to_year']."-".$_POST['to_month']."' WHERE ";
			$sql .= "es_pfmasterid ='".$_POST['elid']."'";

			mysql_query($sql);

		header('location: index.php?pid=136&action=pfmaster');

	}

?>