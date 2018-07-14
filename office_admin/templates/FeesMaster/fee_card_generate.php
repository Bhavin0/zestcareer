<!doctype html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Generate Student Fee Slip</title>
    <meta name="description" content="" />
    <meta name="Author" content="" />
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
    <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />
    <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css'); ?>">
    <!-- THEME CSS -->
    <link href="<?php echo base_url('assets/css/essentials.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/layout.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/color_scheme/green.css'); ?>" rel="stylesheet" type="text/css" />
    </head>
  <body>
  <?php
    include(TEMPLATES_PATH . DS . 'leftmenu.tpl.php');
    include(TEMPLATES_PATH . DS . 'header_new.tpl.php');
    ?>
      <section id="middle">
      <?php
        $sel_year = "SELECT * FROM `es_finance_master`  ORDER BY `es_finance_masterid` DESC LIMIT 0 , 1";
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
        <!-- PANEL START -->
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <span class="title elipsis">
                  <strong>Generate Student Fee Slip</strong>
                </span>
              </div>

              <div class="panel-body">
                <form action="" method="post">
                <?php
                  $student_detail = mysql_fetch_array(mysql_query("SELECT * FROM es_preadmission WHERE es_preadmissionid = '".$_POST['studentid']."' LIMIT 1"));

                  $academicyear = mysql_fetch_array(mysql_query("SELECT * FROM es_finance_master WHERE es_finance_masterid = '".$_POST['pre_year']."' LIMIT 1"));

                  $classname = mysql_fetch_array(mysql_query("SELECT es_classname FROM es_classes WHERE es_classesid = '".$_POST['class']."' LIMIT 1"));

                  $semesters = mysql_fetch_array(mysql_query("SELECT name FROM new_semesters WHERE semester_id = '".$_POST['semesters']."' LIMIT 1"));

                  $query = "SELECT es_feemaster.*, new_semesters.name FROM es_feemaster INNER JOIN new_semesters ON es_feemaster.semester_id = new_semesters.semester_id WHERE academy_year_id = ".$_POST['pre_year']." AND fee_class = ".$_POST['class'];

                    if($_POST['semesters'] != 'NULL')
                    {
                      $query .= " AND es_feemaster.semester_id = ".$_POST['semesters'];
                    }

                      $query .= " ORDER BY es_feemaster.semester_id";

                      $sql = mysql_query($query);
                  ?>

                  <input type="hidden" name="es_preadmissionid" value="<?php echo $_POST['studentid']; ?>">
                  <input type="hidden" name="semster_id" value="<?php echo $_POST['semesters']; ?>">
                  <input type="hidden" name="financemaster_id" value="<?php echo $_POST['pre_year']; ?>">
                  <input type="hidden" name="class_id" value="<?php echo $_POST['class']; ?>">

                  <ul>
                    <li><b>Academic Year : </b>
                    <?php echo $academicyear['fi_ac_startdate']." - ".$academicyear['fi_ac_enddate']; ?></li>
                    <li><b> Student Name : </b>
                    <?php echo $student_detail['pre_name']." ".$student_detail['middle_name']." ".$student_detail['pre_lastname']; ?></li>
                    <li><b> Class : </b><?php echo $classname['es_classname']; ?></li>
                    <li><b>Semester :</b> <?php echo $semesters['name']; ?> </li>
                  </ul>

                  <div class="col-md-4 form-group">
                    <label><b>Bank Name</b></label>
                    <input type="text" name="bank_name" class="form-control" value="AXIS BANK">
                  </div>

                  <div class="col-md-4 form-group">
                    <label><b>Last Date</b></label>
                    <input type="text" name="last_date" class="datepicker form-control" value="2017-06-30" readonly="readonly">
                  </div>

                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Particular</th>
                          <th>Fees Amount</th>
                          <th>Paid</th>
                          <th>Outstanding</th>
                          <th width=15%>Received Amount</th>
                          <th width=10%>Concession</th>
                          <th width=15%>Total</th>
                          <th>Applicable</th>
                        </tr>
                        <?php
                        $total_fee_amount = 0;
                        $total_paid_fees = 0;
                        $total_outstanding = 0;
                        $received_amount = 0;
                        while($inner_row = mysql_fetch_assoc($sql)) {
                        $paid_fees = mysql_fetch_array(mysql_query("SELECT SUM(amount) FROM fm_fee_card_childs WHERE student_id = ".$_POST['studentid']." AND particular_id = ".$inner_row['es_feemasterid']));
                        $paid_fees = !isset($paid_fees)?'0':$paid_fees;
                        if($inner_row['fee_amount'] - $paid_fees[0] > 0) { ?>
                        <tr class="fee_row">
                          <td>
                            <input type="hidden" name="particularid[]" value="<?php echo $inner_row['es_feemasterid']; ?>">
                            <input type="hidden" name="particulartname[]" value="<?php echo $inner_row['fee_particular']; ?>">
                            <input type="hidden" name="ledger_id[]" value="<?php echo $inner_row['ledger_id']; ?>">
                            <?php
                              echo $inner_row['fee_particular'];
                              if($_POST['semesters'] == 'NULL')
                              {
                                echo " - ".$inner_row['name'];
                              }
                            ?>
                          </td>
                          <td><?php echo $inner_row['fee_amount']; ?></td>
                          <td><?php echo $paid_fees[0]; ?></td>
                          <td><?php echo $inner_row['fee_amount'] - $paid_fees[0]; ?></td>
                          <td>
                            <input type="number" name="received_amount[]" class="received_amount form-control" max="<?php echo $inner_row['fee_amount'] - $paid_fees[0]; ?>" min="0" required="required" value="<?php echo ($inner_row['optional']=='NO')?$inner_row['fee_amount'] - $paid_fees[0]:'0'; ?>" <?php echo ($inner_row['optional']=='NO')?'':'readonly'; ?>>
                          </td>
                          <td>
                            <input type="number" name="concession_amount[]" class="concession form-control" value="0" <?php echo ($inner_row['optional']=='NO')?'':'readonly'; ?>>
                          </td>
                          <td>
                            <input type="text" name="total_amount[]" class="total form-control" value="0" readonly>
                          </td>
                          <td align="center">
                            <label class="switch switch-primary switch-round">
                              <input type="checkbox" name="applicable[<?php echo $inner_row['es_feemasterid']; ?>]" class="applicable" <?php echo ($inner_row['optional']=='NO')?'checked':''; ?>>
                              <span class="switch-label" data-on="YES" data-off="NO"></span>
                            </label>
                            <input type="hidden" name="not_applicable[]" value="<?php echo $inner_row['fee_amount'] - $paid_fees[0]; ?>">
                          </td>
                        </tr>
                          <?php
                          if($inner_row['optional']=='NO')
                          {
                            $received_amount = $received_amount + ($inner_row['fee_amount'] - $paid_fees[0]);
                          }
                            $total_fee_amount = $total_fee_amount + $inner_row['fee_amount'];
                            $total_paid_fees = $total_paid_fees + $paid_fees[0];
                            $total_outstanding = $total_outstanding + ($inner_row['fee_amount'] - $paid_fees[0]);
                          }
                          } ?>
                          <!-- TRANSPORT FEES -->
                          <?php
                          $transport_fee = get_single_row('transport_student_allocation', array('acdemic_year_id' => $_POST['pre_year'], 'student_id' => $_POST['studentid']), 'transport_student_allocation_id', 'DESC');

                          $generated_transport_fees = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(transportation_fees),0) as paid, COALESCE(SUM(transport_concession),0) as concession FROM fm_fee_cards WHERE es_preadmissionid=".$_POST['studentid']." AND financemaster_id=".$_POST['pre_year']));
                          
                          if(!empty($transport_fee))
                          {
                          ?>
                          <tr class="fee_row">
                            <td>Transportation Fees
                            <input type="hidden" name="trasportation_id" value="<?php echo $transport_fee['transport_student_allocation_id']; ?>">
                            <input type="hidden" name="transport_ledger" value="<?php echo $transport_fee['ledger_id']; ?>">
                            </td>
                            <td><?php echo $transport_fee['payble_charges']; ?></td>
                            <td><?php echo $generated_transport_fees['paid'] + $generated_transport_fees['concession']; ?></td>
                            <td><?php echo $transport_fee['payble_charges'] - ($generated_transport_fees['paid'] + $generated_transport_fees['concession']); ?></td>
                            <td>
                              <input type="number" name="transportation_amount" class="received_amount form-control" value="<?php echo $transport_fee['payble_charges'] - ($generated_transport_fees['paid'] + $generated_transport_fees['concession']); ?>" max="<?php echo $transport_fee['payble_charges'] - ($generated_transport_fees['paid'] + $generated_transport_fees['concession']); ?>">
                            </td>
                            <td>
                              <input type="number" name="trasport_concession" class="concession form-control" value="0" >
                            </td>
                            
                              <td>
                                <input type="text" name="total_transport" class="total form-control" value="0" readonly>
                              </td>
                            <td></td>
                          </tr>
                          <?php
                            $total_fee_amount = $total_fee_amount + $transport_fee['payble_charges'];
                            $total_paid_fees = $total_paid_fees + $generated_transport_fees['paid'] + $generated_transport_fees['concession'];
                            $total_outstanding = $total_outstanding + ($transport_fee['payble_charges'] - ($generated_transport_fees['paid'] + $generated_transport_fees['concession']));
                            $received_amount = $received_amount + ($transport_fee['payble_charges'] - ($generated_transport_fees['paid'] + $generated_transport_fees['concession']));
                          }
                          ?>
                          <!-- END OF TRANSPORT FEES -->
                          <tr>
                            <th>TOTAL</th>
                            <th><?php echo $total_fee_amount; ?></th>
                              <th><?php echo $total_paid_fees; ?></th>
                              <th><?php echo $total_outstanding; ?></th>
                              <th>
                                <input type="text" name="sub_total" id="sub_total" readonly="" class="form-control">
                              </th>
                              <th>
                                <input type="number" name="total_concession" class="form-control" value="0" id="total_concession">
                              </th>
                              <th><input type="text" name="grand_total" id="grand_total" readonly class="form-control"></th>
                              <th></th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                  <div class="col-md-12 form-group">
                    <input type="submit" name="generate_fee_card" value="Generate" class="btn btn-primary pull-right">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
    <script>
    $(".applicable").change(function() {
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
    calculation();
    </script>
    <script type="text/javascript">
      $('#dd-11').addClass('active');
      $('#dd-11-5').addClass('active');
    </script>
  </body>
</html>