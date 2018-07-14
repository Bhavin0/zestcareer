<?php
$edit_mod = $db->getRow("SELECT * FROM es_modules_alloted  WHERE id=1");

$max_students=$edit_mod['max_no_students'];
$max_courses=$edit_mod['max_no_courses'];
$modules_permissions=$edit_mod['modules_permissions'];
$top_level_permissions= explode(',', $modules_permissions);
$admin_permissions = explode(',', $permissions['admin_permissions']);
?>

<div id="wrapper" class="clearfix">
  <aside id="aside">
    <nav id="sideNav">
      <ul class="nav nav-list" id="myUL">

        <li id="dd-1">
          <a href="?pid=44">
            <i class="main-icon fa fa-tachometer"></i><span>Dashboard</span>
          </a>
        </li>
        <?php if (in_array('1_p', $top_level_permissions) ){ if (in_array('1_p', $admin_permissions) ){?>
        <li id="dd-3">
          <a href="#">
            <i class="fa fa-menu-arrow pull-right"></i>
            <i class="main-icon et-lock"></i><span>Administration</span>
          </a>
          <ul>
            <li><a href="?pid=42&action=adminlist">Admin List</a></li>
            <?php if (in_array("1_3", $admin_permissions)) {?>
            <li id="dd-3-2"><a href="?pid=42&action=addadmin">Add Admin</a></li>
            <?php }?>
          </ul>
        </li>
         <li id="dd-3">
          <a href="#">
            <i class="fa fa-menu-arrow pull-right"></i>
            <i class="main-icon et-clipboard"></i><span>Test</span>
          </a>
          <ul>
            <li><a href="?pid=143&action=testlist">Test List</a></li>
            
          </ul>
        </li>
        
        <?php } } ?>

        <?php
        if (in_array('2_p', $top_level_permissions) ){
        if (in_array('2_p', $admin_permissions)){?>
        <li id="dd-5">
          <a href="#">
            <i class="fa fa-menu-arrow pull-right"></i>
            <i class="main-icon et-tools-2"></i><span>Setup</span>
          </a>
          <ul>
            <li>
              <a href="?pid=22&action=school_details">Institute Details</a>
            </li>
            <li>
              <a href="?pid=22&action=semesters">Semester / Term</a>
            </li>
            <li>
              <a href="?pid=20&action=manageclasses&subaction=sections">Sections</a>
            </li>
            <li>
              <a href="?pid=20&action=manageclasses&subaction=classes">Classes</a>
            </li>
            <li>
              <a href="?pid=20&action=manageclasses&subaction=division">Class Division</a>
            </li>
            <li>
              <a href="?pid=20&action=manageclasses&subaction=subjects">Subjects</a>
            </li>
            <li>
              <a href="?pid=20&action=htmlcode">API for Login</a>
            </li>
            <li>
              <a href="?pid=94&page=caste">Caste Categories</a>
            </li>
          </ul>
      </li>

      <?php }?>
      <?php } ?>

       <?php if (in_array('5_p', $top_level_permissions) ){
      if (in_array('5_p', $admin_permissions)){?>
      <li id="dd-10">
        <a href="#">
          <i class="fa fa-menu-arrow pull-right"></i>
          <i class="main-icon fa fa-group"></i><span>Students</span>
        </a>
        <ul>
          <li>
            <a href="?pid=139&action=assign_division">Update Division / Roll No.</a>
          </li>
          <li>
            <a href="?pid=21&action=classrecards">Transfer Students</a>
          </li>  
          <?php if (in_array('5_5', $admin_permissions)){?>
          <li>
             <a href="?pid=23&action=issuetcforstudent">Transferred Students</a>
          </li>
          <?php } ?>
           <li>
            <a href="?pid=21&action=studentlist">Students List</a>
          </li>    
          <!-- <li>
            <a href="?pid=21&action=student_violation">Students Violation</a>
          </li>       
          <li>
            <a href="?pid=21&action=defaulter_students">Defaulter Students</a>
          </li>  -->  
        </ul>
      </li>

      <?php }} ?>
      <?php if (in_array('10_p', $top_level_permissions) ){
      if (in_array('10_p', $admin_permissions)){?>
      <li id="dd-14">
        <a href="#">
          <i class="fa fa-menu-arrow pull-right"></i>
          <i class="main-icon fa fa-user"></i><span>Staff</span>
        </a>
        <ul>
          <li>
            <a href="?pid=49&action=department">Add Department</a>
          </li>
          <li>
            <a href="?pid=46&action=addnewstaff">Add Staff</a>
          </li>
          <li>
            <a href="?pid=15&action=staffviewing">View Staff</a>
          </li>
          <li>
            <a href="?pid=141&action=view_plans"> Staff Planner</a>
          </li>
        </ul>
      </li>

      <?php } } ?>

      <?php if (in_array('18_p', $top_level_permissions) ){
      if (in_array('18_p', $admin_permissions)){?>
      <li id="dd-6">
        <a href="#">
          <i class="fa fa-menu-arrow pull-right"></i>
          <i class="main-icon fa fa-check-square"></i><span>Attendance</span>
        </a>
        <ul>
          <li>
            <a href="#">
              <i class="fa fa-menu-arrow pull-right"></i>
              Staff Attendance
            </a>
            <ul>
              <li><a href="?pid=27&action=staff_attend">Staff Attendance</a></li>
              <!-- <li><a href="?pid=27&action=upload_staff_attend">Upload Staff Attendance</a></li> -->
              <li><a href="?pid=27&action=edit_staff_attendence">Edit Attendance</a></li>
              <li><a href="?pid=27&action=staff_wise_report">Employee Report</a></li>    
              <li><a href="?pid=27&action=staff_report">Staff  Report</a></li>   
            </ul>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-menu-arrow pull-right"></i>
              Student Attendance
            </a>
            <ul>
              <li><a href="?pid=140&action=stud_attend">Student Attendancesheets</a></li>
              <li><a href="?pid=140&action=student_attendancesheets">Attendancesheets</a></li>    
            </ul>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-menu-arrow pull-right"></i>
              Leaves Master
            </a>
            <ul>
              <li><a href="?pid=137&action=create_annual_leave">Create Annual Leave</a></li>
              <li><a href="?pid=137&action=leavemaster">Annual Leaves</a></li>
              <li><a href="?pid=137&action=leave_requestes">Leave Requests</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <?php }} ?>

      <?php if (in_array('17_p', $top_level_permissions) ){
      if (in_array('17_p', $admin_permissions)){?>
      <li>
        <a href="#">
            <i class="fa fa-menu-arrow pull-right"></i>
            <i class="main-icon et-edit"></i><span>Class Tests</span>
        </a>
        <ul>
            <li><a href="?pid=138&action=view_tests">View Test</a></li>
            <li><a href="?pid=138&action=teacher_performance">Teacher Performance</a></li>
            <li><a href="?pid=138&action=student_performance">Student Performance</a></li>
            <li><a href="?pid=138&action=class_performance">Class Performance</a></li>
        </ul>
      </li>
      <?php } } ?>

      <?php if (in_array('35_p', $top_level_permissions) ){
      if (in_array('35_p', $admin_permissions)){?>
      <li id="dd-7">
        <a href="#">
          <i class="fa fa-menu-arrow pull-right"></i>
          <i class="main-icon et-browser"></i><span> Certificates</span>
        </a>
        <ul>
          <li id="dd-7-1">
            <a href="?pid=117&action=list">Bonafied Certificate</a>
          </li>
          <li>
            <a href="?pid=116&action=list">Experience Letter</a>
          </li>
          <li>
            <a href="?pid=95&action=attemptlist">Attempt Certificate</a>
          </li>
          <li>
            <a href="?pid=95&action=undertakinglist"> Undertaking Letter</a>
          </li>
          <li>
             <a href="?pid=95&action=holilist"> Holiday Notice</a>
          </li>
          <li>
            <a href="?pid=95&action=eligibilitylist"> Eligibility Certificate</a>
          </li>
          <li>
            <a href="?pid=95&action=absentlist"> Student Absent Notice</a>
          </li>
        </ul>
      </li>

      <?php } } ?>

      <?php if (in_array('3_p', $top_level_permissions) ){
      if (in_array('3_p', $admin_permissions)){ ?>
      <li id="dd-8">
        <a href="#">
            <i class="fa fa-menu-arrow pull-right"></i>
            <i class="main-icon fa fa-tv"></i><span>Front Office</span>
        </a>
        <ul>
          <?php if (in_array('3_1', $admin_permissions)){ ?>
          <li id="dd-8-1">
            <a href="?pid=8">Enquiry Form</a>
          </li>
          <?php }?>
          <li id="dd-8-2">
            <a href="?pid=2&action=list_enquiry">Enquiry List</a>
           </li>
        </ul>
      </li>

      <?php } } ?>

      <li id="dd-4">
          <a href="#">
            <i class="fa fa-menu-arrow pull-right"></i>
            <i class="main-icon glyphicon glyphicon-stats"></i><span>Evaluation Form</span>
          </a>
          <ul>
            <li>
              <a href="?pid=135&action=new_survey">Random Visit Evaluation Form</a>
            </li>
            <li>
              <a href="?pid=135&action=monthly_survey">Monthly Evaluation Form</a>
            </li>
            <li>
              <a href="?pid=135&action=survey_option">Evaluation Option</a>
            </li>
            <li>
              <a href="?pid=135&action=view_survey">View Evaluations</a>
            </li>
            <li>
              <a href="?pid=135&action=survey_groups">Teacher's Groups</a>
            </li>
          </ul>
        </li>

      <?php if (in_array('4_p', $top_level_permissions) ){
      if (in_array('4_p', $admin_permissions)){ ?>
      <li id="dd-9">
        <a href="?pid=5&action=admission_form">
          <i class="main-icon et-document"></i><span>Admission Form</span>
        </a>
      </li>
      <?php } } ?>

     
      <?php if (in_array('6_p', $top_level_permissions) ){
      if (in_array('6_p', $admin_permissions)){?>
      <!-- <li id="dd-11">
        <a href="#">
          <i class="fa fa-menu-arrow pull-right"></i>
          <i class="main-icon et-printer"></i><span>Fee Payment</span>
        </a>
        <ul> -->
          <?php if (in_array('6_1', $admin_permissions)){?>
          <!-- <li id="dd-11-1">
            <a href="?pid=17&action=createfeetypes" >Add  Fees </a>
          </li> -->
          <?php } ?>
          <?php if (in_array('6_2', $admin_permissions)){?>
          <!-- <li>
            <a href="?pid=17&action=viewfees">Fee Details</a>
          </li> -->
          <?php } ?>
        <!--  <li id="dd-11-3">
            <a href="?pid=40&action=payfee">Pay Fee</a>
          </li> -->
          <?php if (in_array('6_3', $admin_permissions)){?>
          <!-- <li id="dd-11-5">
            <a href="?pid=17&action=fee_cards">Generate Fees Slip</a>
          </li> -->
           <?php } ?>
          <?php if (in_array('6_4', $admin_permissions)){?> 
          <!-- <li id="dd-11-6">
            <a href="?pid=17&action=fee_cards_list">Student Fees Slips</a>
          </li> -->
           <?php } ?>
           
         <?php if (in_array('6_7', $admin_permissions)){?>
          <!-- <li id="dd-11-4">
            <a href="?pid=40&action=receipt_list">Receipts</a>
          </li>  -->
           <?php } ?>
          <?php if (in_array('6_5', $admin_permissions)){?>
          <!-- <li id="dd-11-7">
            <a href="?pid=40&action=classwisefees">Class Wise Fee Status</a>
          </li>  -->
           <?php } ?>
         
        <!-- </ul>
      </li>
 -->
      <?php }} ?>

            <?php if (in_array('14_p', $top_level_permissions) ){
      if (in_array('14_p', $admin_permissions)){?>
      <li>
        <a href="#">
          <i class="fa fa-menu-arrow pull-right"></i>
          <i class="main-icon fa fa-bus"></i><span>Transport</span>
        </a>
        <ul>
          <!-- <li>
            <a href="?pid=75&action=routes">Route </a>
          </li>
          <li>
            <a href="?pid=75&action=routelist">Route List</a>
          </li>
          <li>
            <a href="?pid=76&action=boardlist">Board List</a>
          </li>
          <li>
            <a href="?pid=81&action=driverlist">Drivers List</a>
          </li>
          <li>
            <a href="?pid=80&action=allottedlist">Allot Vehicle to Board</a>
          </li>
          <li>
            <a href="?pid=82&action=allotteddriverlist">Allot Driver to Vehicle</a>
          </li> -->
          <li>
            <a href="?pid=142&action=transportpickuppoint">Transport Pickup Point</a>
          </li>
          <li>
            <a href="?pid=75&action=allottedstudent">Allot Student to Pick-up Point</a>
          </li>
          <?php if (in_array("14_13", $admin_permissions)) {?>
          <!-- <li>
            <a href="?pid=83&action=preparetransportbill">Prepare Transport Fee </a>
          </li> -->
          <?php }?>
         <!--  <li>
            <a href="?pid=84&action=viewtransportbill">View Transport Bills</a>
          </li>
          <li>
            <a href="?pid=85 &action=maintenancedetails">Maintenance Details</a>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-menu-arrow pull-right"></i>
              Reports
            </a>
            <ul>
              <li>
                <a href="?pid=86&action=driverreport">Driver Report</a>
              </li>
              <li>
                <a href="?pid=87&action=vehiclereport">Vehicle Report</a>
              </li>
              <li>
                <a href="?pid=88&action=driver_copy">Student Wise Report</a>
              </li>
              <li>
                <a href="?pid=89&action=staffreport">Staff Wise Report</a>
              </li>
            </ul>
          </li> -->
        </ul>
      </li>
      <?php } } ?>

       <?php if (in_array('22_p', $top_level_permissions) ){
      if (in_array('22_p', $admin_permissions)){?>
      <li>
        <a href="#">
          <i class="fa fa-menu-arrow pull-right"></i>
          <i class="main-icon fa fa-exclamation-triangle"></i><span>Messages</span>
        </a>
        <ul>
          <?php if (in_array("22_1", $admin_permissions)) {?>
          <li>
            <a href="?pid=57&action=compose">Compose</a>
          </li>
          <?php }?>
          <?php if (in_array("22_2", $admin_permissions)) {?>
          <li>
            <a href="?pid=57&action=sent_student_message">Student Messages</a>
          </li>
          <?php }?>
          <li>
            <a href="?pid=57&action=sent_staff_message" class="mainsidelink">Staff Message</a>
          </li>
          <li>
            <a href="?pid=57&action=mailbox" class="mainsidelink">Sent message</a>
          </li>
        </ul>
      </li>
      <?php }} ?>



      <?php if (in_array('17_p', $top_level_permissions) ){
      if (in_array('17_p', $admin_permissions)){?>
      <li id="dd-12">
        <a href="#">
            <i class="fa fa-menu-arrow pull-right"></i>
            <i class="main-icon et-documents"></i><span>Examination</span>
        </a>
        <ul>
          <li><a href="?pid=47&action=manageexams"> Exams Category </a></li>
          <?php if (in_array("17_1", $admin_permissions)) {?>
          <li><a href="?pid=36&action=examreport"> Academic Exams </a></li>   
          <?php }?>
          <li><a href="?pid=36&action=examreport">Enter Marks</a></li> 
          <li>
            <a href="#">
              <i class="fa fa-menu-arrow pull-right"></i>
              Extra Activities
            </a>
            <ul>
              <li>
                <a href="?pid=36&action=activities">Activities</a>
              </li>
              <li>
                <a href="?pid=36&action=add_annual_activity">Add Annual Activity</a>
              </li>
              <li>
                <a href="?pid=36&action=coscholastic">Enter Marks</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-menu-arrow pull-right"></i>
              Report Cards
            </a>
            <ul>
              <?php if (in_array("17_7", $admin_permissions)) {?>
              <li>
                <a href="?pid=36&action=yearly_report_cards">Yearly Report Cards</a>
              </li>
              <?php }?>
            </ul>
          </li>
        </ul>
      </li>
      <?php } } ?>
      
      <?php if (in_array('7_p', $top_level_permissions) ){
            if (in_array('7_p', $admin_permissions)){?>
      <li >
        <a href="#">
          <i class="fa fa-menu-arrow pull-right"></i>
          <i class="main-icon et-book-open"></i><span>Assignment</span>
        </a>
        <ul>
          <li>
            <a href="?pid=4&action=add_assignment">Add Assignment</a>
          </li>
          <li>
            <a href="?pid=4&action=view_assignment">View Assignment</a>
          </li>
        </ul>
      </li>

      <?php }} ?>
      <?php if (in_array('8_p', $top_level_permissions) ){ 
      if (in_array('8_p', $admin_permissions)){?>
      <li id="dd-13">
        <a href="#">
          <i class="fa fa-menu-arrow pull-right"></i>
          <i class="main-icon glyphicon glyphicon-book"></i><span>Study Material</span>
        </a>
        <ul>
          <li>
            <a href="?pid=51&action=add_study_material">Add Study Material</a>
          </li>
          <li>
            <a href="?pid=51&action=view_material">view Study Material</a>
          </li>
          
        </ul>
      </li>

      <?php } } ?>
      
      <?php if (in_array('9_p', $top_level_permissions) ){
      if (in_array('9_p', $admin_permissions)){?>
      <li id="dd-15">
        <a href="#">
          <i class="fa fa-menu-arrow pull-right"></i>
          <i class="main-icon fa fa-puzzle-piece"></i><span>HRD</span>
        </a>
        <ul>
          <li>
            <a href="?pid=9&action=post_vacancy">Post Vacancy</a>
          </li>
          <li>
            <a href="?pid=9&action=list_classifieds">Classifieds</a>
          </li>
          <li>
            <a href="?pid=23&action=applicant_enquiries">Applicant Enquiry</a>
          </li>
          <li>
            <a href="?pid=23&action=search_applicants">Search Applicants</a>
          </li>
          <li>
            <a href="?pid=23&action=take_interview">Take Interview</a>
          </li>
          <li>
            <a href="?pid=23&action=offerlettergenration">Generate Offer Letter</a>
          </li>   
          <li>
            <a href="?pid=23&action=letter_formats">Letter Formats</a>
          </li>   
          <li>
            <a href="?pid=23&action=issuetcstaff">Resignation/Termination</a>
          </li>   
          <li>
            <a href="?pid=23&action=letterslist">Other letter Formats</a>
          </li>    
          <li>
            <a href="?pid=23&action=sendlettertostaff">Send Letter</a>
          </li>    
          <li>
            <a href="?pid=23&action=otherlettergeneration">Print Letter </a>
          </li>    
        </ul>
      </li>

      <?php }} ?>
      <?php if (in_array('11_p', $top_level_permissions) ){
      if (in_array('11_p', $admin_permissions)){?>  
      <li id="dd-16">
        <a href="#">
          <i class="fa fa-menu-arrow pull-right"></i>
          <i class="main-icon fa fa-calculator"></i><span>Payroll</span>
        </a>
        <ul>
          <li>
            <a href="?pid=136&action=createallowencemaster">Create Allowance</a>
          </li>
          <li>
            <a href="?pid=136&action=allowencemaster">Allowance Master</a>
          </li>
          <li>
            <a href="?pid=136&action=createdeductionsmaster">Create Deduction</a>
          </li>
          <li>
            <a href="?pid=136&action=deductionsmaster">Deduction Master</a>
          </li>
          <li>
            <a href="?pid=136&action=taxmaster">Create Tax</a>
          </li>
          <li>
            <a href="?pid=136&action=pfmaster">Create PF</a>
          </li>

          <li>
            <a href="?pid=136&action=update_employeedata">Employee Data</a>
          </li>
          <li>
            <a href="?pid=136&action=employee_report">Employee Salary Report</a>
          </li>
          <li><a href="?pid=29&action=loanmaster">Create a Loan</a></li>

<li><b>Employee</b></li>
<li><a href="?pid=35&action=issueloan">Issue loan</a></li>
<li><a href="?pid=35&action=loanissueslist"><span id="internal-source-marker_0.820553458583017">Loan Issued To</span></a></li>
          <li>
            <a href="#">
              <i class="fa fa-menu-arrow pull-right"></i>
              Payslip Generation
            </a>
            <ul>
              <li>
                <a href="?pid=136&action=employeewisepayslip">Employee Payslip</a>
              </li>
              <?php if (in_array("11_103", $admin_permissions)) {?>
              <li>
                <a href="?pid=136&action=paysliplist">Payslip List</a>
              </li>
              <?php }?>
            </ul>
          </li>
        </ul>
      </li>

      <?php } } ?>
      <?php if (in_array('12_p', $top_level_permissions) ){
      if (in_array('12_p', $admin_permissions)){?>
      <li id="dd-17">
        <a href="#">
          <i class="fa fa-menu-arrow pull-right"></i>
          <i class="main-icon fa fa-inr"></i><span>Accounting</span>
        </a>
        <ul>
          <li>
            <a href="?pid=22&action=master_group">Create Account Groups</a>
          </li>
          <li>
            <a href="?pid=22&action=ledger">Create Account Ledger</a>
          </li>
          <li>
            <a href="?pid=22&action=voucher">Manage Voucher</a></li>
          <li>
            <a href="#">
              <i class="fa fa-menu-arrow pull-right"></i>
              Transaction
            </a>
            <ul>
              <li>
                <a href="?pid=24&action=voucher_entry">Voucher Entry</a>
              </li>
              <li>
                <a href="?pid=24&action=vouchers_list">Voucher List</a>
              </li>
            </ul>
          </li>
          <li id="dd-17-5">
            <a href="#">
              <i class="fa fa-menu-arrow pull-right"></i>
              Report
            </a>
            <ul>
              <li>
                <a href="?pid=25&action=balancesheet">Balance Sheet</a>
              </li>
              <li id="dd-17-5-2">
                <a href="?pid=25&action=ledger">Ledger Summary</a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
      <?php } } ?>

      <?php if (in_array('13_p', $top_level_permissions) ){
      if (in_array('13_p', $admin_permissions)){?>
      <li>
        <a href="#">
          <i class="fa fa-menu-arrow pull-right"></i>
          <i class="main-icon fa fa-tags"></i><span>Inventory</span>
        </a>
        <ul>
        <?php if (in_array("13_4", $admin_permissions)) {?>
          <li>
            <a href="?pid=7&action=addcategory">Add Product Category</a>
          </li>
          <?php }?>
          <?php if (in_array("13_7", $admin_permissions)) {?>
          <li>
            <a href="?pid=7&action=additem">Add  Item</a>
          </li>
          <?php }?>
          <?php if (in_array("13_10", $admin_permissions)) {?>
          <li>
            <a href="?pid=7&action=addsupply">Add  Supplier</a>
          </li>
          <?php }?>
          <li>
            <a href="?pid=7&action=quotation">Quotations</a>
          </li>
          <?php if (in_array("13_13", $admin_permissions)) {?>
          <li>
            <a href="?pid=7&action=purchase_orders">Purchase Orders</a>
          </li>
          <?php }?>
          <?php if (in_array("13_14", $admin_permissions)) {?>
          <li>
            <a href="?pid=7&action=goods_reciept_notes">Goods Receipt Notes</a>
          </li>
          <li>
            <a href="?pid=7&action=supplier_payments">Supplier Payments</a>
          </li>
          <?php }?>
          <?php if (in_array("13_15", $admin_permissions)) {?>
          <li>
            <a href="?pid=7&action=goods_issue_requests">Goods Issue Requests</a>
          </li>
          <li>
            <a href="?pid=7&action=goods_issue_notes">Goods Issue Notes</a>
          </li>
          <?php }?>
          <?php if (in_array("13_16", $admin_permissions)) {?>   
          <li>
            <a href="?pid=7&action=return_issue">Issue Return Note</a>
          </li>
          <?php }?>
        </ul>
      </li> 
      <?php }} ?>

      <?php if (in_array('21_p', $top_level_permissions) ){
      if (in_array('21_p', $admin_permissions)){?>
      <li>
        <a href="#">
          <i class="fa fa-menu-arrow pull-right"></i>
          <i class="main-icon et-mobile"></i><span>SMS</span>
        </a>
        <ul>
          <?php if (in_array("21_1", $admin_permissions)) {?>
          <li>
            <a href="?pid=62&action=smstoadmin">To Admin</a>
          </li>
          <li>
            <a href="?pid=62&action=smstostaff">To Staff</a>
          </li>
          <?php }?>
          <?php if (in_array("21_2", $admin_permissions)) {?>
          <li>
            <a href="?pid=62&action=smstostudents">To Students</a>
          </li>
          <?php }?>
          <?php if (in_array("21_1", $admin_permissions)) {?>
          <li>
            <a href="?pid=62&action=smstocustomnumber">To Custom Number</a>
          </li>
          <?php }?>
          <li>
            <a href="?pid=62&action=smssetup">SMS Setup</a>
          </li>
        </ul>
      </li>
      <?php } }?>

      <?php  if (in_array('15_p', $top_level_permissions) ){
      if(in_array('15_p', $admin_permissions)){?>
      <li>
        <a href="#">
          <i class="fa fa-menu-arrow pull-right"></i>
          <i class="main-icon et-clock"></i><span>Time Table</span>
        </a>
        <ul>
          <li>
            <a href="?pid=106&action=timetable">Class wise timetables</a>
          </li>
          <li>
            <a href="?pid=90&action=staff">Staff wise timetables</a>
          </li>
          <li>
            <a href="#" onclick="window.open('?pid=90&action=free_staff')">View Free Staff</a>
          </li>
        </ul>
      </li>
      <?php } } ?>

      <?php if (in_array('16_p', $top_level_permissions) ){
      if (in_array('16_p', $admin_permissions)){?>
      <li>
        <a href="?pid=32&action=first" class="header_link">
          <i class="main-icon fa fa-book"></i><span>Library</span>
        </a>
      </li>
      <?php }} ?>

      
      <?php if (in_array('32_p', $top_level_permissions) ){
      if (in_array('32_p', $admin_permissions)){?>
      <li>
        <a href="#">
            <i class="fa fa-menu-arrow pull-right"></i>
            <i class="main-icon glyphicon glyphicon-credit-card"></i><span>ID Card</span>
        </a>
        <ul>
          <li>
            <a href="?pid=72&action=addimage">Add Id Card Image</a>
          </li>
          <?php if (in_array("32_4", $admin_permissions)) {?>
          <li>
            <a href="?pid=72&action=mailtostaff">Staff</a>
          </li>
          <?php }?>
          <?php if (in_array("32_4", $admin_permissions)) {?>
          <li>
            <a href="?pid=72&action=mailtostudents">Students</a>
          </li>
          <?php }?>
        </ul>
      </li>
      <?php }} ?>

      <?php if (in_array('33_p', $top_level_permissions) ){
      if (in_array('33_p', $admin_permissions)){?>
      <li>
        <a href="#">
          <i class="fa fa-menu-arrow pull-right"></i>
          <i class="main-icon et-focus"></i><span>Back Office</span>
        </a>
        <ul>
          <li>
            <a href="?pid=74&action=dispatchcategory">Add Dispatch Group</a>
          </li>
          <?php if (in_array("33_4", $admin_permissions)) {?>
          <li>
            <a href="?pid=74&action=incomingletters">Inward/Outward Dispatch Entry</a>
          </li>
          <?php }?>
          <li>
            <a href="?pid=74&action=manageletters">Manage Letters</a>
          </li>
        </ul>
      </li>
      <?php }} ?>

     

      <?php if (in_array('23_p', $top_level_permissions) ){
      if (in_array('23_p', $admin_permissions)){?>
      <li>
        <a href="?pid=53&action=view">
          <i class="main-icon fa fa-question-circle"></i><span>Help Desk</span>
        </a>
      </li>
      <?php }} ?>

      <?php if (in_array('24_p', $top_level_permissions) ){
      if (in_array('24_p', $admin_permissions)){?>
      <li>
        <a href="?pid=52&action=tip_day">
          <i class="main-icon fa fa-lightbulb-o"></i><span>TODAY'S Thought</span>
        </a>
      </li>
      <?php }} ?>

      <?php if (in_array('27_p', $top_level_permissions) ){
      if (in_array('27_p', $admin_permissions)){?>
      <li>
        <a href="?pid=58&action=holidayslist">
          <i class="main-icon fa fa-thumbs-o-up"></i><span>Holidays</span>
        </a>
      </li>
      <?php }} ?>

      <?php if (in_array('35_p', $top_level_permissions) ){
      if (in_array('35_p', $admin_permissions)){?>
      <li>
        <a href="#">
          <i class="fa fa-menu-arrow pull-right"></i>
          <i class="main-icon fa fa-external-link"></i><span>Helpful Links</span>
        </a>
        <ul>
          <?php if (in_array('35_1', $admin_permissions)){?>
          <li>
            <a href="?pid=93&action=addnew">Add Link</a>
          </li>
          <?php }?>
          <li>
            <a href="?pid=93&action=list"> View Links</a>
          </li>
          <?php if (in_array("22_1", $admin_permissions)) {?>
          <li>
            <a href="?pid=57&action=mailtostaff">To Staff</a>
          </li>
          <?php }?>
          <?php if (in_array("22_2", $admin_permissions)) {?>
          <li>
            <a href="?pid=57&action=mailtostudents">To Students</a>
          </li>
          <?php }?>
        </ul>
      </li>
      <?php }} ?>

      <?php if (in_array('28_p', $top_level_permissions) ){
      if (in_array('28_p', $admin_permissions)){?>
      <li>
        <a href="#">
          <i class="fa fa-menu-arrow pull-right"></i>
          <i class="main-icon glyphicon glyphicon-lock"></i><span>Security</span>
        </a>
        <ul>
          <li>
            <a href="?pid=26&action=vehicle">Visitors Record</a>
          </li>
          <li>
            <a href="?pid=26&action=report"> Report</a>
          </li>
        </ul>
      </li>
      <?php }} ?>

      <?php if (in_array('30_p', $top_level_permissions) ){
      if (in_array('30_p', $admin_permissions)){?>
      <li>
        <a href="#">
          <i class="fa fa-menu-arrow pull-right"></i>
          <i class="main-icon et-newspaper"></i><span>Knowledge Base</span>
        </a>
        <ul>
          <li>
            <a href="?pid=30&action=know_category">Create Category</a>
          </li>
          <li>
            <a href="?pid=30&action=know_categ">Search Articles</a>
          </li>
        </ul>
      </li>

      <?php }} if (in_array('31_p', $top_level_permissions) ){
      if (in_array('31_p', $admin_permissions)){?>
      <li>
        <a href="?pid=37&action=noticeboard">
          <i class="main-icon fa fa-clipboard"></i><span>Notice Board</span>
        </a>
      </li>
      <?php }}?>
     

    </ul>
  </nav>

  <span id="asidebg"></span>
</aside>