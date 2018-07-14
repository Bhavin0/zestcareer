<!doctype html>
  <html lang="en-US">
    <head>
      <meta charset="utf-8" />
      <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
      <title>Fee Slips</title>
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
			            <span class="elipsis title"><strong>Fee Slip Lists</strong></span>
		            </div>

		            <div class="panel-body">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
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
                          <input type="hidden" name="pid" value="17">
                          <input type="hidden" name="action" value="fee_cards_list">
                          <div class="modal-body">

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                              <label><b>Academic Year</b></label>
                              <select name="academic_year_id" class="form-control selectpicker" data-live-search="true" id="ac_year">
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
                              <select class="form-control selectpicker" data-live-search="true" onchange="fetchclass(this.value)" name="section_id">
                                <option value="ALL">ALL SECTIONS</option>
                                <?php while($row = mysql_fetch_assoc($sql)){ ?>
                                <option value="<?php echo $row['es_groupsid']; ?>"> <?php echo $row['es_groupname']; ?> </option>
                              <?php } ?>
                              </select>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                              <label><b>Select Class</b></label>
                              <select class="form-control selectpicker" data-live-search="true" id="classes" name="class_id" onchange="fetchdivision(this.value)">
                                <option value="ALL">ALL CLASSES</option>
                              </select>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                              <label><b>Select Division</b></label>
                              <select class="form-control selectpicker" data-live-search="true" id="divisions" onchange="fetchstudents(this.value)" name="division_id">
                                <option value="NULL">ALL DIVISIONS</option>
                              </select>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                              <label><b>Select Semester</b></label>
                              <select class="form-control selectpicker" data-live-search="true" id="semesters" name="semester_id">
                                <option value="NULL">ALL SEMESTERS</option>
                              </select>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                              <label><b>Select Student</b></label>
                              <select class="form-control selectpicker" data-live-search="true" id="students" name="student_id">
                                <option value="ALL">ALL STUDENTS</option>
                                <?php if(isset($studetails['es_preadmissionid'])) {
                                  echo "<option value='".$studetails['es_preadmissionid']."'>".$studetails['es_preadmissionid']."</option>";
                                } ?>
                              </select>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                              <label><b>Card ID</b></label>
                              <input type="text" name="card_id" value="" class="form-control">
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                              <label><b>Slip No.</b></label>
                              <input type="text" name="slip_no" value="" class="form-control">
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
                      $query ="SELECT fm_fee_cards.*, es_preadmission.pre_name, es_preadmission.middle_name, es_preadmission.pre_lastname, es_classes.es_classname, new_semesters.name, isd_class_division.division_name FROM fm_fee_cards LEFT JOIN es_preadmission ON es_preadmission.es_preadmissionid = fm_fee_cards.es_preadmissionid INNER JOIN es_classes ON es_classes.es_classesid = fm_fee_cards.class_id INNER JOIN es_preadmission_details ON es_preadmission_details.es_preadmissionid =  es_preadmission.es_preadmissionid INNER JOIN  isd_class_division ON isd_class_division.class_division_id = es_preadmission_details.division_id INNER JOIN es_groups ON es_groups.es_groupsid = es_classes.es_groupid LEFT JOIN new_semesters ON new_semesters.semester_id = fm_fee_cards.semester_id WHERE es_preadmission_details.academic_year_id = fm_fee_cards.financemaster_id";
                        if(isset($_GET['academic_year_id']))
                        {
                          $query .= " AND fm_fee_cards.financemaster_id =".$_GET['academic_year_id'];
                        }
                        else
                        {
                          $query .= " AND fm_fee_cards.financemaster_id =".$res_year['es_finance_masterid'];
                        }
                        if(isset($_GET['section_id']) && $_GET['section_id']!='ALL')
                        {
                          $query .= " AND es_groups.es_groupsid =".$_GET['section_id'];
                        }
                        if(isset($_GET['class_id']) && $_GET['class_id']!='ALL')
                        {
                          $query .= " AND fm_fee_cards.class_id =".$_GET['class_id'];
                        }
                        if(isset($_GET['division_id']) && $_GET['division_id']!='NULL')
                        {
                          $query .= " AND es_preadmission_details.division_id =".$_GET['division_id'];
                        }
                        if(isset($_GET['semester_id']) && $_GET['semester_id']!='NULL')
                        {
                          $query .= " AND (fm_fee_cards.semester_id = 'NULL' OR fm_fee_cards.semester_id =".$_GET['semester_id'].")";
                        }
                        if(isset($_GET['student_id']) && $_GET['student_id']!='ALL' && $_GET['student_id']!='Blank')
                        {
                          $query .= " AND fm_fee_cards.es_preadmissionid =".$_GET['student_id'];
                        }
                        if(isset($_GET['card_id']) && $_GET['card_id']!='')
                        {
                          $query .= " AND fm_fee_cards.card_id='".$_GET['card_id']."'";
                        }
                        if(isset($_GET['slip_no']) && $_GET['slip_no']!='')
                        {
                          $query .= " AND fm_fee_cards.slip_no='".$_GET['slip_no']."'";
                        }
                        $query .= " ORDER BY fm_fee_cards.card_id DESC";
                    ?>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Slip No.</th>
                          <th>Date</th>
                          <th>Student Name</th>
                          <th>Class</th>
                          <th>Sem</th>
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

              <div id="EditCard" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color:#4b5354;">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <h4 class="modal-title" id="myModalLabel" style="color:white;">Edit Fees Card</h4>
                    </div>
                    <form action="?pid=17&action=edit_card" method="post">
                      <div class="modal-body" id="grn">
                      </div>
                      <div class="modal-footer">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button name="editcard" type="submit" value="1" class="btn btn-primary">UPDATE</button>
                        </div>
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
          var query = "<?php echo $query; ?>";
              var data = {page_number : page_number, query : query};
              var saveData = $.ajax({
              type: 'POST',
              url: "?pid=17&action=cards_pagination",
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
        $(document).on('click', '.editcard', function(){
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
          xmlhttp.open("GET","?pid=17&action=ajax_card_edit&q="+$(str).val(),true);
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
  </body>
</html>