<?php
sm_registerglobal('pid', 'action','emsg', 'update', 'start', 'back', 'saveleave', 'seldepartment', 'leavetype', 'noofleaves', 'carryforward', 'encashable', 'nofocarryfordays', 'start', 'lid', 'elid', 'saveallowance', 'allonctype', 'dc1', 'dc2', 'alwamount', 'alw_amt_type', 'loanctype', 'loanname', 'intrestrate', 'taxname', 'slabrateto', 'slabratefrom', 'rateamount', 'employeercont', 'empconttype', 'employeecont', 'emyconttype', 'st_department','st_postaplied','alw_dept','es_postname','pre_year','leave_school_year','allowance_school_year','deduction_school_year','loan_school_year','tax_school_year','pf_school_year','elid' );

/**
* Only Admin users can view the pages
*/
if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" ) {
	header('location: ./?pid=1&unauth=0');
	exit;
}


$school_details_sel = "SELECT * FROM `es_finance_master` ORDER BY `es_finance_masterid` DESC";
$school_details_res = getamultiassoc($school_details_sel);

?>

<!-- Create Allowance -->
<?php
	if($action=='createallowencemaster')
	{
		$st_departments = mysql_query("SELECT * FROM es_departments");

		if(isset($_GET['elid']))
		{
			$elid = mysql_fetch_array(mysql_query("SELECT * FROM es_allowencemaster WHERE es_allowencemasterid =".$_GET['elid']));
			$elid_child = mysql_query("SELECT es_staff.st_firstname, es_staff.st_fthname, es_staff.st_lastname, new_allowencemaster_childs.* FROM new_allowencemaster_childs INNER JOIN es_staff ON es_staff.es_staffid = new_allowencemaster_childs.es_staffid WHERE new_allowencemaster_childs.es_allowencemasterid =".$_GET['elid']);
		}
		if(isset($_GET['id']))
		{
			$elid = mysql_fetch_array(mysql_query("SELECT es_allowencemaster.*, es_departments.es_deptname FROM es_allowencemaster INNER JOIN es_departments ON es_allowencemaster.alw_dept=es_departments.es_departmentsid WHERE es_allowencemasterid =".$_GET['id']));
			$elid_child = mysql_query("SELECT * FROM es_staff WHERE st_department=".$elid['alw_dept']." AND es_staffid NOT IN(SELECT es_staffid FROM new_allowencemaster_childs WHERE es_allowencemasterid=".$_GET['id'].")");	
		}
	}
?>
<!-- Create Allowance -->

<!-- View Allowance -->
<?php
	if($action=='allowencemaster')
	{

		if(isset($_POST['search_allowancemaster']) && ($_POST['emp']!=0))
		{
			$data = mysql_fetch_array(mysql_query("SELECT es_staff.*, es_departments.es_deptname FROM es_staff INNER JOIN es_departments ON es_staff.st_department = es_departments.es_departmentsid WHERE es_staff.es_staffid=".$_POST['emp']));
			$data_child = mysql_query("SELECT new_allowencemaster_childs.*, es_allowencemaster.* FROM new_allowencemaster_childs INNER JOIN es_allowencemaster ON es_allowencemaster.es_allowencemasterid = new_allowencemaster_childs.es_allowencemasterid WHERE new_allowencemaster_childs.es_staffid =".$_POST['emp']);
		}
		else
		{
			$data = mysql_fetch_array(mysql_query("SELECT * FROM  es_departments WHERE es_departmentsid=".$_POST['dept']));
			$data_child = mysql_query("SELECT * FROM es_allowencemaster WHERE alw_dept =".$_POST['dept']);

		}

		if(isset($_GET['id']))
		{
			$data = mysql_fetch_array(mysql_query("SELECT es_allowencemaster.*, es_departments.es_deptname FROM es_allowencemaster INNER JOIN es_departments ON es_allowencemaster.alw_dept = es_departments.es_departmentsid WHERE es_allowencemaster.es_allowencemasterid =".$_GET['id']));
			$data_child = mysql_query("SELECT es_staff.st_firstname, es_staff.st_fthname, es_staff.st_lastname, new_allowencemaster_childs.* FROM new_allowencemaster_childs INNER JOIN es_staff ON es_staff.es_staffid = new_allowencemaster_childs.es_staffid WHERE new_allowencemaster_childs.es_allowencemasterid =".$_GET['id']);
		}
	}
?>
<!-- View Allowance -->

<!-- Create Deduction -->
<?php
	if($action=='createdeductionsmaster')
	{
		$st_departments = mysql_query("SELECT * FROM es_departments");

		if(isset($_GET['elid']))
		{
			$elid = mysql_fetch_array(mysql_query("SELECT * FROM es_deductionmaster WHERE es_deductionmasterid =".$_GET['elid']));
			$elid_child = mysql_query("SELECT es_staff.st_firstname, es_staff.st_fthname, es_staff.st_lastname, new_deductionmaster_childs.* FROM new_deductionmaster_childs INNER JOIN es_staff ON es_staff.es_staffid = new_deductionmaster_childs.es_staffid WHERE new_deductionmaster_childs.es_deductionmasterid =".$_GET['elid']);
		}
		if(isset($_GET['id']))
		{
			$elid = mysql_fetch_array(mysql_query("SELECT es_deductionmaster.*, es_departments.es_deptname FROM es_deductionmaster INNER JOIN es_departments ON es_deductionmaster.ded_dept=es_departments.es_departmentsid WHERE es_deductionmasterid =".$_GET['id']));
			$elid_child = mysql_query("SELECT * FROM es_staff WHERE st_department=".$elid['ded_dept']." AND es_staffid NOT IN(SELECT es_staffid FROM new_deductionmaster_childs WHERE es_deductionmasterid=".$_GET['id'].")");	
		}
	}
?>
<!-- Create Deduction -->

<!-- View Deduction -->
<?php
	if($action=='deductionsmaster')
	{

		if(isset($_POST['search_deductionmaster']) && ($_POST['emp']!=0))
		{
			$data = mysql_fetch_array(mysql_query("SELECT es_staff.*, es_departments.es_deptname FROM es_staff INNER JOIN es_departments ON es_staff.st_department = es_departments.es_departmentsid WHERE es_staff.es_staffid=".$_POST['emp']));
			$data_child = mysql_query("SELECT new_deductionmaster_childs.*, es_deductionmaster.* FROM new_deductionmaster_childs INNER JOIN es_deductionmaster ON es_deductionmaster.es_deductionmasterid = new_deductionmaster_childs.es_deductionmasterid WHERE new_deductionmaster_childs.es_staffid =".$_POST['emp']);
		}
		else
		{
			$data = mysql_fetch_array(mysql_query("SELECT * FROM  es_departments WHERE es_departmentsid=".$_POST['dept']));
			$data_child = mysql_query("SELECT * FROM es_deductionmaster WHERE ded_dept =".$_POST['dept']);

		}

		if(isset($_GET['id']))
		{
			$data = mysql_fetch_array(mysql_query("SELECT es_deductionmaster.*, es_departments.es_deptname FROM es_deductionmaster INNER JOIN es_departments ON es_deductionmaster.ded_dept = es_departments.es_departmentsid WHERE es_deductionmaster.es_deductionmasterid =".$_GET['id']));
			$data_child = mysql_query("SELECT es_staff.st_firstname, es_staff.st_fthname, es_staff.st_lastname, new_deductionmaster_childs.* FROM new_deductionmaster_childs INNER JOIN es_staff ON es_staff.es_staffid = new_deductionmaster_childs.es_staffid WHERE new_deductionmaster_childs.es_deductionmasterid =".$_GET['id']);
		}
	}
?>
<!-- View Deduction -->

<?php
	if($action=='employeewisepayslip')
	{
		$st_departments = mysql_query("SELECT * FROM es_departments");
	}

	if($action=='update_salary')
	{
		$sql1 = mysql_query("SELECT * FROM es_payslipdetails WHERE es_payslipdetailsid =".$_GET['sal_id']);
		$payslip_data = mysql_fetch_array($sql1);

		$sql2 = mysql_query("SELECT * FROM es_voucherentry WHERE es_voucherentryid =".$payslip_data['voucherid']);
		$voucherdata = mysql_fetch_array($sql2);

		$sql2 = mysql_query("SELECT es_departments.es_deptname, es_staff.*, es_deptposts.es_postname FROM es_staff INNER JOIN es_departments ON es_departments.es_departmentsid = es_staff.st_department INNER JOIN es_deptposts ON es_deptposts.es_deptpostsid = es_staff.st_post WHERE es_staffid =".$payslip_data['staff_id']);
		$staff_data = mysql_fetch_array($sql2);

		$allowance_data = mysql_query("SELECT new_payslip_childs.*, es_allowencemaster.alw_type FROM new_payslip_childs INNER JOIN es_allowencemaster ON es_allowencemaster.es_allowencemasterid = new_payslip_childs.name WHERE new_payslip_childs.type='Allowance' AND new_payslip_childs.payslip_id =".$_GET['sal_id']);

		$bonus_data = mysql_fetch_array(mysql_query("SELECT * FROM new_payslip_childs WHERE type='Bonus' AND payslip_id =".$_GET['sal_id']));

		$deduction_data = mysql_query("SELECT * FROM new_payslip_childs WHERE type='Deduction' AND payslip_id =".$_GET['sal_id']);

		$leave_deduction = mysql_fetch_array(mysql_query("SELECT * FROM new_payslip_childs WHERE type='Leave Deduction' AND payslip_id =".$_GET['sal_id']));

		$pf_data = mysql_query("SELECT * FROM new_payslip_childs WHERE type='PF' AND payslip_id =".$_GET['sal_id']);

		$tax_data = mysql_query("SELECT new_payslip_childs.*, es_taxmaster.tax_name FROM new_payslip_childs INNER JOIN es_taxmaster ON es_taxmaster.es_taxmasterid=new_payslip_childs.name WHERE type='Tax' AND payslip_id =".$_GET['sal_id']);
	}

	if($action=='paysliplist')
	{
		$sql = mysql_query("SELECT * FROM es_departments");

		$sql1 = mysql_query("SELECT DISTINCT pay_month FROM es_payslipdetails ORDER BY pay_month DESC");

		if((isset($_GET['month'])) && (isset($_GET['dept'])))
		{
			$list = mysql_query("SELECT es_payslipdetails.*, es_departments.es_deptname, es_staff.st_firstname, es_staff.st_fthname, es_staff.st_lastname, es_voucherentry.es_paymentmode, es_voucherentry.es_bankacc, es_voucherentry.es_narration FROM es_payslipdetails INNER JOIN es_staff ON es_staff.es_staffid = es_payslipdetails.staff_id INNER JOIN es_deptposts ON es_deptposts.es_deptpostsid = es_staff.st_post INNER JOIN es_voucherentry ON es_voucherentry.es_voucherentryid = es_payslipdetails.voucherid INNER JOIN es_departments ON es_departments.es_departmentsid = es_staff.st_department WHERE es_payslipdetails.pay_month='".$_GET[month]."' AND es_staff.st_department=".$_GET['dept']);

			$allowance = mysql_query("SELECT * FROM es_allowencemaster WHERE alw_fromdate<='".$_GET[month]."' AND alw_todate>='".$_GET[month]."' AND alw_dept=".$_GET['dept']);
			$numall = mysql_num_rows($allowance);

			$deductions = mysql_query("SELECT * FROM es_deductionmaster WHERE ded_fromdate<='".$_GET[month]."' AND ded_todate>='".$_GET[month]."' AND ded_dept=".$_GET['dept']);
			$numded = mysql_num_rows($deductions);

			$taxes = mysql_query("SELECT * FROM es_taxmaster WHERE tax_from_date<='".$_GET[month]."' AND tax_to_date>='".$_GET[month]."' AND es_dept=".$_GET['dept']);
			$numtax = mysql_num_rows($taxes);
		}

	}

	if($action=='employee_report')
	{
		$employee_list = mysql_query("SELECT * FROM es_staff");
		if(isset($_POST['search']))
		{
			$payslips = mysql_query("SELECT * FROM es_payslipdetails WHERE staff_id=".$_POST['emp_id']);
		}
	}

	if($action=='deductionsmaster')
	{
		$st_departments = mysql_query("SELECT * FROM es_departments");

		if(isset($_POST['search_deductionsmaster']))
		{
			$deductionsmaster = mysql_query("SELECT * FROM es_deductionmaster WHERE ded_dept =".$_POST['staffid']);
		}
		if(isset($_GET['elid']))
		{
			$elid = mysql_fetch_array(mysql_query("SELECT * FROM es_deductionmaster WHERE es_deductionmasterid =".$_GET['elid']));
			$elid_child = mysql_query("SELECT new_deductionmaster_childs.*, es_staff.st_firstname, es_staff.st_fthname, es_staff.st_lastname FROM new_deductionmaster_childs INNER JOIN es_staff ON es_staff.es_staffid = new_deductionmaster_childs.es_staffid WHERE new_deductionmaster_childs.es_deductionmasterid =".$_GET['elid']);
		}
		if(isset($_GET['emsg']))
		{
			if($_GET['emsg']==1)
			{
				$msg = "Deductions Successfully Added.";
			}
			else if($_GET['emsg']==2)
			{
				$msg = "Deductions Successfully Updated.";
			}
		}
	}

	if($action=='taxmaster')
	{
		$st_departments = mysql_query("SELECT * FROM es_departments");

		if(isset($_POST['searchtaxmaster']))
		{
			$taxmaster = mysql_query("SELECT es_taxmaster.*, es_departments.es_deptname FROM es_taxmaster INNER JOIN es_departments ON es_taxmaster.es_dept=es_departments.es_departmentsid WHERE es_dept =".$_POST['st_department']);
		}
		if(isset($_GET['elid']))
		{
			$elid = mysql_fetch_array(mysql_query("SELECT * FROM es_taxmaster WHERE es_taxmasterid =".$_GET['elid']));
			$elid_child = mysql_query("SELECT * FROM new_taxmaster_childs WHERE es_taxmasterid =".$_GET['elid']);
		}

		if(isset($_GET['emsg']))
		{
			if($_GET['emsg']==1)
			{
				$msg = "Tax Successfully Added.";
			}
			else if($_GET['emsg']==2)
			{
				$msg = "Tax Successfully Updated.";
			}
		}
	}

	if($action=='pfmaster')
	{
		$st_departments = mysql_query("SELECT * FROM es_departments");

		$pf_data = mysql_query("SELECT * FROM es_pfmaster INNER JOIN es_departments ON es_departments.es_departmentsid = es_pfmaster.pf_dept");

		if(isset($_GET['elid']))
		{
			$elid = mysql_fetch_array(mysql_query("SELECT * FROM es_pfmaster WHERE es_pfmasterid =".$_GET['elid']));
		}
	}



?>