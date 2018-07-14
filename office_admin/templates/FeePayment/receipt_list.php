<!doctype html>
  <html lang="en-US">
    <head>
      <meta charset="utf-8" />
      <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
      <title>Fees Receipts</title>
      <meta name="description" content="" />
      <meta name="Author" content="" />
      <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
      <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />
      <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url('assets/css/essentials.css'); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url('assets/css/layout.css'); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url('assets/css/color_scheme/green.css'); ?>" rel="stylesheet" type="text/css" />


      <link href="<?php echo base_url('assets/plugins/selectpicker/select.min.css'); ?>" rel="stylesheet" type="text/css" />

    </head>
    <body>
      <?php
      include(TEMPLATES_PATH . DS . 'leftmenu.tpl.php');
      include(TEMPLATES_PATH . DS . 'header_new.tpl.php');
      ?>
        <section id="middle">
        <?php
          $sel_year = "SELECT *FROM `es_finance_master`  ORDER BY `es_finance_masterid` DESC LIMIT 0 , 1";
          $res_year = getarrayassoc($sel_year);
        ?>
          <header id="page-header">
            <ol class="breadcrumb">
              <li>
                <b> Academic Year : </b>
                  <?php if($res_year['fi_ac_startdate']!=""){ echo displaydate($res_year['fi_ac_startdate']);?> to <?php echo displaydate($res_year['fi_ac_enddate']); } else { echo "---"; }?>
              </li>
            </ol>
          </header>
          <div id="content" class="dashboard" style="padding-top: 5px;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <!-- PANEL START -->
	            <div class="panel panel-primary">
		            <div class="panel-heading">
			            <span class="elipsis title"><strong>Student Receipts List</strong></span>
		            </div>

		            <div class="panel-body">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                    <a class="btn btn-warning pull-right" href="?pid=40&action=receipt_list_print&academic_year_id=<?php echo $_GET['academic_year_id']; ?>&section_id=<?php echo $_GET['section_id']; ?>&class_id=<?php echo $_GET['class_id']; ?>&semester_id=<?php echo $_GET['semester_id']; ?>&student_id=<?php echo $_GET['student_id']; ?>&cheque_no=<?php echo $_GET['cheque_no']; ?>&receipt_no=<?php echo $_GET['receipt_no']; ?>&from_date=<?php echo $_GET['from_date']; ?>&to_date=<?php echo $_GET['to_date']; ?>" target="_blank">
                      <i class="fa fa-file-pdf-o"></i> Print List
                    </a>
                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#Filter">
                      <i class="fa fa-filter"></i> Filter Results
                    </button>
                  </div>

                  <div class="modal fade modal-primary" tabindex="-1" role="dialog" aria-labelledby="FilterLabel" aria-hidden="true" id="Filter">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header" style="background-color: #4b5354;">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <h4 class="modal-title" id="FilterLabel" style="color:#ffffff">Filter Results</h4>
                        </div>

                        <form action="" method="get">
                          <input type="hidden" name="pid" value="40">
                          <input type="hidden" name="action" value="receipt_list">
                          <div class="modal-body">

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                              <label><b>Academic Year</b></label>
                              <select name="academic_year_id"  class="form-control selectpicker" data-live-search="true"  id="ac_year">
                              <?php  
                                foreach($school_details_res as $each_record) { ?>
                                <option value="<?php echo $each_record['es_finance_masterid']; ?>" <?php if ($each_record['es_finance_masterid']==$pre_year) { echo "selected"; }?>><?php echo displaydate($each_record['fi_startdate'])." To ".displaydate($each_record['fi_enddate']); ?>
                                </option>
                                <?php } ?>
                              </select>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                              <label><b>Select Section</b></label>
                              <?php $sql = mysql_query("SELECT * FROM es_groups"); ?>
                              <select   class="form-control selectpicker" data-live-search="true"  onchange="fetchclass(this.value)" name="section_id">
                                <option value="ALL">ALL SECTIONS</option>
                                <?php while($row = mysql_fetch_assoc($sql)){ ?>
                                <option value="<?php echo $row['es_groupsid']; ?>"> <?php echo $row['es_groupname']; ?> </option>
                              <?php } ?>
                              </select>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                              <label><b>Select Class</b></label>
                              <select   class="form-control selectpicker" data-live-search="true"  id="classes" onchange="fetchdivision(this.value)" name="class_id">
                                <option value="ALL">ALL CLASSES</option>
                              </select>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                              <label><b>Select Division</b></label>
                              <select  class="form-control selectpicker" data-live-search="true"  id="divisions" onchange="fetchstudents(this.value)" name="division_id">
                                <option value="ALL">ALL DIVISION</option>
                              </select>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                              <label><b>Select Semester</b></label>
                              <select   class="form-control selectpicker" data-live-search="true"  id="semesters" name="semester_id">
                                <option value="NULL">ALL SEMESTERS</option>
                              </select>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                              <label><b>Select Student</b></label>
                              <select class="form-control selectpicker" data-live-search="true"  id="students" name="student_id">
                                <option value="ALL">ALL STUDENTS</option>
                                <?php if(isset($studetails['es_preadmissionid'])) {
                                  echo "<option value='".$studetails['es_preadmissionid']."'>".$studetails['es_preadmissionid']."</option>";
                                } ?>
                              </select>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                              <label><b>Cheque No.</b></label>
                              <input type="text" name="cheque_no" class="form-control">
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                              <label><b>Receipt No.</b></label>
                              <input type="text" name="receipt_no" class="form-control">
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                              <label><b>From Date</b></label>
                              <input type="text" name="from_date" class="form-control datepicker" readonly="">
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                              <label><b>To Date</b></label>
                              <input type="text" name="to_date" class="form-control datepicker" readonly="">
                            </div>
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">SEARCH</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
                    <?php
                      $query ="SELECT es_feepaid.*, es_preadmission.pre_name, es_preadmission.middle_name, es_preadmission.pre_lastname, es_classes.es_classname, isd_class_division.division_name FROM es_feepaid INNER JOIN es_preadmission ON es_preadmission.es_preadmissionid = es_feepaid.es_preadmissionid INNER JOIN es_classes ON es_classes.es_classesid = es_feepaid.class_id INNER JOIN es_preadmission_details ON es_preadmission_details.es_preadmissionid =  es_preadmission.es_preadmissionid INNER JOIN  isd_class_division ON isd_class_division.class_division_id = es_preadmission_details.division_id INNER JOIN es_groups ON es_groups.es_groupsid = es_classes.es_groupid WHERE es_preadmission_details.academic_year_id = es_feepaid.financemaster_id";
                        if(isset($_GET['academic_year_id']))
                        {
                          $query .= " AND es_feepaid.financemaster_id =".$_GET['academic_year_id'];
                        }
                        else
                        {
                          $query .= " AND es_feepaid.financemaster_id =".$res_year['es_finance_masterid'];
                        }
                        if(isset($_GET['section_id']) && $_GET['section_id']!='ALL')
                        {
                          $query .= " AND es_groups.es_groupsid =".$_GET['section_id'];
                        }
                        if(isset($_GET['class_id']) && $_GET['class_id']!='ALL')
                        {
                          $query .= " AND es_feepaid.class_id =".$_GET['class_id'];
                        }
                        if(isset($_GET['division_id']) && $_GET['division_id']!='ALL')
                        {
                          $query .= " AND es_preadmission_details.division_id =".$_GET['division_id'];
                        }
                        if(isset($_GET['semester_id']) && $_GET['semester_id']!='NULL')
                        {
                          $query .= " AND (es_feepaid.semester_id = 'NULL' OR es_feepaid.semester_id =".$_GET['semester_id'].")";
                        }
                        if(isset($_GET['student_id']) && $_GET['student_id']!='ALL')
                        {
                          $query .= " AND es_feepaid.es_preadmissionid =".$_GET['student_id'];
                        }
                        if(isset($_GET['student_id']) && $_GET['student_id']!='ALL')
                        {
                          $query .= " AND es_feepaid.es_preadmissionid =".$_GET['student_id'];
                        }
                        if(isset($_GET['cheque_no']) && $_GET['cheque_no']!='')
                        {
                          $query .= " AND es_feepaid.cheque_no ='".$_GET['cheque_no']."'";
                        }
                        if(isset($_GET['receipt_no']) && $_GET['receipt_no']!='')
                        {
                          $query .= " AND es_feepaid.receipt_no ='".$_GET['receipt_no']."'";
                        }
                        if(isset($_GET['from_date']) && $_GET['from_date']!='')
                        {
                          $query .= " AND es_feepaid.receipt_date >='".$_GET['from_date']."'";
                        }
                        if(isset($_GET['to_date']) && $_GET['to_date']!='')
                        {
                          $query .= " AND es_feepaid.receipt_date <='".$_GET['to_date']."'";
                        }
                        $query .= " ORDER BY es_feepaid.fid DESC";
                        $results = mysqli_num_rows(mysqli_query($mysqli_con, $query));
                        $pages = ceil($results / 10);
                    ?>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Receipt ID</th>
                          <th>Receipt No.</th>
                          <th>Date</th>
                          <th>Student Name</th>
                          <th>Class</th>
                          <th>Amount</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="receipts">
                      </tbody>
                    </table>
                  </div>

                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 col-lg-offset-5 col-md-offset-5 col-sm-offset-4 col-xs-offset-4">
                    <div class="input-group">
                        <span class="input-group-btn">
                          <button class="btn btn-primary previous_page" type="button"><i class="fa fa-arrow-left"></i></button>
                        </span>

                        <input type="text" class="form-control" value="1" style="text-align:center;" id="page_number">

                        <span class="input-group-btn">
                          <button class="btn btn-primary next_page" type="button"><i class="fa fa-arrow-right"></i></button>
                        </span>
                    </div>
                  </div>
                </div>
              </div>

              <div id="EditReceipt" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color:#4b5354;">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <h4 class="modal-title" id="myModalLabel" style="color:white;">Edit Fees Receipt</h4>
                    </div>
                    <form action="?pid=40&action=edit_receipt" method="post">
                      <div class="modal-body" id="grn">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button name="editreceipt" type="submit" value="1" class="btn btn-primary">UPDATE</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
      <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
      <script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/plugins/selectpicker/select.min.js'); ?>"></script>
      <script>
        $(document).on('click', '.next_page', function(){
          var page_number  = $('#page_number').val();
          var next_page = parseInt(page_number) + 1;
          $('#page_number').val(next_page);
          pagination();
        })

        $(document).on('click', '.previous_page', function(){
          var page_number  = $('#page_number').val();
          var next_page = parseInt(page_number) - 1;
          $('#page_number').val(next_page);
          pagination();
        })
        
        function pagination()
        {
          var page_number = $('#page_number').val();
          var total_page = <?php echo $pages; ?>;
          if(page_number == total_page)
          {
            $('.next_page').prop('disabled', true);
          }
          else
          {
            $('.next_page').prop('disabled', false);
          }
          if(page_number == 1)
          {
            $('.previous_page').prop('disabled', true);
          }
          else
          {
            $('.previous_page').prop('disabled', false);
          }
          var query = "<?php echo $query; ?>";
              var data = {page_number : page_number, query : query};
              var saveData = $.ajax({
              type: 'POST',
              url: "?pid=40&action=receipt_pagination",
              data: data,
              dataType: "text",
                success: function(resultData) {
                  $('#receipts').html(resultData);
                }
              });
        }

        pagination();
      </script>

      <script>
        $(document).on('click', '.editreceipt', function(){
          str = this;
          if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
          } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              $('#grn').html(this.responseText);
            }
          };
          xmlhttp.open("GET","?pid=40&action=ajax_receipt_edit&q="+$(str).val(),true);
          xmlhttp.send();
        });
      </script>

      <script>
function calculation()
{
  var received_amount = 0; 
  var concession = 0;
  $(".fee_row").each(function() {
     received_amount = $(this).find('.received_amount').val();
     concession = $(this).find('.concession').val();
     total = parseInt(received_amount) - parseInt(concession);
     $(this).find('.total').val(total);
    });


    var sub_total = 0;
    $(".received_amount").each(function() {
    sub_total += parseInt(this.value);
    });

    var total_concession = 0;
    $(".concession").each(function() {
    total_concession += parseInt(this.value);
    });

    $('#total_concession').val(total_concession);
    $('#sub_total').val(sub_total);
    $('#grand_total').val(sub_total - total_concession);

}
$(document).on('keyup', '.received_amount', calculation);
$(document).on('keyup', '.concession', calculation);

      
  function hello(str)
  {

    $('.payment_mode').hide();
    if(str == 'Bank Deposit') { $('.bank_mode').show(); }
    if(str == 'Cheque') { $('.cheque_mode').show(); }
    if(str == 'DD') { $('.dd_mode').show(); }
  }

  $(document).on('change','.applicable', function() {
  if($(this).is(':checked'))
  {
    $(this).closest('tr').find('.received_amount').attr('readonly', false);
    $(this).closest('tr').find('.concession').attr('readonly', false);
  }
  else
  {
    $(this).closest('tr').find('.received_amount').val(0);
    $(this).closest('tr').find('.received_amount').attr('readonly', true);
    $(this).closest('tr').find('.concession').val(0);
    $(this).closest('tr').find('.concession').attr('readonly', true);
  }
  calculation();
});
    </script>

    <script>
      function fetchclass(str) {
        var ac_year = $('#ac_year').val();
        if (window.XMLHttpRequest) {
          xmlhttp = new XMLHttpRequest();
        } else {
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            var classes = document.getElementById('classes');
            classes.innerHTML = "<option selected='selected' value='ALL'>ALL CLASSES</option>";
            classes.innerHTML = classes.innerHTML + this.responseText;
            $('.selectpicker').selectpicker('refresh');
          }
        };
        xmlhttp.open("GET","ajax.php?action=classes&q="+str,true);
        xmlhttp.send();

        /* Fetch Semesters */
        if (window.XMLHttpRequest) {
          xmlhttp = new XMLHttpRequest();
        } else {
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            var semesters = document.getElementById('semesters');
            semesters.innerHTML = "<option value='NULL'>ALL SEMESTER</option>";
            semesters.innerHTML = semesters.innerHTML + this.responseText;
            $('.selectpicker').selectpicker('refresh');
          }
        };
        xmlhttp.open("GET","ajax.php?action=semesters&q="+str+"&ac_year="+ac_year,true);
        xmlhttp.send();
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
        divisions.innerHTML = "<option value='ALL'> --ALL DIVISION-- </option>";
      divisions.innerHTML = divisions.innerHTML + this.responseText;
      $('.selectpicker').selectpicker('refresh');
          }
      };
      xmlhttp.open("GET","ajax.php?action=divisions&q="+str,true);
      xmlhttp.send();
  }
</script>
    <script>
      function fetchstudents(str)
      {
        var ac_year = $('#ac_year').val();
        if (window.XMLHttpRequest) {
          xmlhttp = new XMLHttpRequest();
        } else {
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            var students = document.getElementById('students');
            students.innerHTML = "<option value='ALL'>ALL STUDENTS</option>";
            students.innerHTML = students.innerHTML + this.responseText;
            $('.selectpicker').selectpicker('refresh');
          }
        };
        xmlhttp.open("GET","ajax.php?action=students&q="+str+"&ac_year="+ac_year,true);
        xmlhttp.send();
      }
    </script>
    <script>
      $(document).ready(function() {
        $(document).on("focus", ".datepicker", function(){
          $(this).datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
          });
        });
      });
    </script>
        <script type="text/javascript">
          $('#dd-11').addClass('active');
          $('#dd-11-4').addClass('active');
        </script>
  </body>
</html>