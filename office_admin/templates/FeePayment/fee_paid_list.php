<!doctype html>
  <html lang="en-US">
    <head>
      <meta charset="utf-8" />
      <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
      <title>Category Wise Fee Paid</title>
      <meta name="description" content="" />
      <meta name="Author" content="" />
      <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
      <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />
      <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css'); ?>">
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
			            <span class="elipsis title">
				            <strong>Category Wise Fee Paid</strong>
			            </span>
		            </div>

		            <div class="panel-body">
			            <form action="" method="get">
                    <input type="hidden" name="pid" value="40">
                    <input type="hidden" name="action" value="fee_paid_list">
			              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
				              <label><b>Select Fee Category</b></label>
                      <select name="feecategories"  class="form-control">
							          <option value="all" <?php if($_GET['feecategories']=='all') { echo'selected'; } ?>>- - All- - </option>
                        <?php for($i = 0; $i < count($fees_category); $i++){ ?>
                        <option value="<?php echo $fees_category[$i]['fee_particular']; ?>"  <?php if($_GET['feecategories']==$fees_category[$i]['fee_particular']) { echo'selected'; } ?>>
                          <?php echo $fees_category[$i]['fee_particular']; ?>
                        </option>
                        <?php } ?>
                        <option value="Transportation Fees"  <?php if($_GET['feecategories']=='Transportation Fees') { echo'selected'; } ?>>Transportation Fees</option>
                        <option value="Fine"  <?php if($_GET['feecategories']=='Fine') { echo'selected'; } ?>>Fine</option>
                      </select>
                    </div>

			              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
				              <label><b>From</b></label>
				              <div class="input-group">
					              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					              <input class="form-control datepicker" name="from_date" value="<?php echo (isset($_GET['from_date']))?$_GET['from_date']:date('Y-m-d'); ?>" readonly />
				              </div>
			              </div>

			              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
				              <label><b>To</b></label>
				              <div class="input-group">
					              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input class="form-control datepicker" name="to_date" value="<?php echo (isset($_GET['to_date']))?$_GET['to_date']:date('Y-m-d'); ?>" readonly />
				              </div>
			              </div>

			              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				              <label><b>Academic Year</b></label>
				              <select name="pre_year" class="form-control selectpicker" data-live-search="true">
								      <?php foreach($school_details_res as $each_record) { ?>
								        <option value="<?php echo $each_record['es_finance_masterid']; ?>">
                          <?php echo displaydate($each_record['fi_startdate'])." To ".displaydate($each_record['fi_enddate']); ?>
                        </option>
								      <?php } ?>
								      </select>
			              </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                      <label><b>Section</b></label>
                      <select name="section"  class="form-control">
                        <option value="all">ALL</option>
                      <?php
                      $sections = mysqli_query($mysqli_con, "SELECT * FROM es_groups ORDER BY es_grouporderby");
                      while ($section = mysqli_fetch_assoc($sections))
                      {
                        echo"<option value='".$section['es_groupsid']."'>".$section['es_groupname']."</option>";
                      }
                      ?>
                      </select>
                    </div>

			              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				              <input type="submit" name="search" class="btn btn-primary pull-right" value="Submit"/>
			              </div>
                  </form>

                  <?php if(isset($_GET['search'])) { ?>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                      <a class="btn btn-warning pull-right" target="_blank" href="?pid=40&action=fee_paid_list_print&feecategories=<?php echo $_GET['feecategories']; ?>&from_date=<?php echo $_GET['from_date']; ?>&to_date=<?php echo $_GET['to_date']; ?>&pre_year=<?php echo $_GET['pre_year']; ?>&section=<?php echo $_GET['section']; ?>">
                        PRINT
                      </a>
                  </div>
                  <?php } ?>

			            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
				            <table class="table table-bordered">
					            <thead>
						            <tr>
							            <th>S.No</th>
							            <th>Date</th>
							            <th>Student's Name </th>
					                <th>Class</th>
						  	          <th>Mode&nbsp;of&nbsp;Payment </th>
						  	          <th>Receipt&nbsp;No </th>
						  	          <th>Amount Received </th>
						            </tr>
					            </thead>
					            <tbody>	
                      <?php if(isset($_GET['search']))
                      {
                        if($_GET['feecategories']=='all')
                        {
                          $category_types = mysqli_query($mysqli_con, "SELECT DISTINCT ledger_detail FROM ledger_entries");
                        }
                        else
                        {
                          $category_types = mysqli_query($mysqli_con, "SELECT DISTINCT ledger_detail FROM ledger_entries WHERE ledger_detail='".$_GET['feecategories']."'");
                        }
                        while($category_type = mysqli_fetch_assoc($category_types))
                        {
                          ?>
                          <tr>
                            <th colspan="7" class="info"><?php echo $category_type['ledger_detail']; ?></th>
                          </tr>
                          <?php
                          $i = 1;
                          $ledger_query = "SELECT es_voucherentry.es_voucherdate, es_voucherentry.opposite_partyname, es_classes.es_classname, es_voucherentry.es_paymentmode, es_voucherentry.es_voucherno, ledger_entries.amount_in, es_voucherentry.es_narration, isd_class_division.division_name FROM ledger_entries INNER JOIN es_voucherentry ON es_voucherentry.es_voucherentryid = ledger_entries.es_voucher_id INNER JOIN es_feepaid ON es_feepaid.voucherid = es_voucherentry.es_voucherentryid INNER JOIN es_classes ON es_classes.es_classesid = es_feepaid.class_id INNER JOIN es_preadmission_details ON es_preadmission_details.es_preadmissionid =  es_feepaid.es_preadmissionid INNER JOIN  isd_class_division ON isd_class_division.class_division_id = es_preadmission_details.division_id WHERE (es_preadmission_details.academic_year_id = es_feepaid.financemaster_id) AND (ledger_entries.amount_in > 0) AND (ledger_entries.ledger_detail='".$category_type['ledger_detail']."') AND (es_voucherdate BETWEEN '".$_GET['from_date']."' AND '".$_GET['to_date']."') AND (es_feepaid.financemaster_id = '".$_GET['pre_year']."')";

                          if($_GET['section']!='all')
                          {
                            $ledger_query .= " AND es_classes.es_groupid=".$_GET['section'];
                          }

                          $ledgers = mysqli_query($mysqli_con, $ledger_query);
                          $sub_total = 0;
                          $cash_total = 0;
                          $cheque_total = 0;
                          while($ledger = mysqli_fetch_assoc($ledgers))
                          {
                            ?>
                            <tr>
                              <td><?php echo $i++; ?></td>
                              <td><?php echo date_format(date_create($ledger['es_voucherdate']), 'd/m/Y'); ?></td>
                              <td><?php echo $ledger['opposite_partyname']; ?></td>
                              <td><?php echo $ledger['es_classname']; ?> - <?php echo $ledger['division_name']; ?></td>
                              <td><?php echo $ledger['es_paymentmode']; ?>
                                  <?php if($ledger['es_narration'] != '')
                                  {
                                    echo"<br>".$ledger['es_narration'];
                                  }
                                  ?>
                              </td>
                              <td><?php echo $ledger['es_voucherno']; ?></td>
                              <td><?php echo $ledger['amount_in']; ?></td>
                            </tr>
                            <?php
                            if($ledger['es_paymentmode']=='Cash')
                            {
                              $cash_total = $cash_total + $ledger['amount_in'];
                            }
                            if($ledger['es_paymentmode']=='Cheque')
                            {
                              $cheque_total = $cheque_total + $ledger['amount_in'];
                            }
                            $sub_total = $sub_total + $ledger['amount_in'];
                          }
                          ?>
                          <tr>
                            <td colspan="6" align="right"><b>CASH</b></td>
                            <td><b><?php echo $cash_total; ?></b></td>
                          </tr>
                          <tr>
                            <td colspan="6" align="right"><b>CHEQUE</b></td>
                            <td><b><?php echo $cheque_total; ?></b></td>
                          </tr>
                          <tr>
                            <td colspan="6" align="right"><b>SUBTOTAL</b></td>
                            <td><b><?php echo $sub_total; ?></b></td>
                          </tr>
                          <?php
                          $cheque_grandtotal = $cheque_grandtotal + $cheque_total;
                          $cash_grandtotal = $cash_grandtotal + $cash_total;
                          $grandtotal = $grandtotal + $sub_total;
                        }
                        ?>
                      </tbody>
                      <tfoot>
                          <tr>
                            <td colspan="6" align="right"><b>CASH GRAND TOTAL</b></td>
                            <td><b><?php echo $cash_grandtotal; ?></b></td>
                          </tr>
                          <tr>
                            <td colspan="6" align="right"><b>CHEQUE GRAND TOTAL</b></td>
                            <td><b><?php echo $cheque_grandtotal; ?></b></td>
                          </tr>
                          <tr>
                            <td colspan="6" align="right"><b>GRANDTOTAL</b></td>
                            <td><b><?php echo $grandtotal; ?></b></td>
                          </tr>


                        <?php
                      }
                      ?>
					            </tfoot>
				            </table>
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

        <script type="text/javascript">
          $('#dd-11').addClass('active');
          $('#dd-11-8').addClass('active');
        </script>
  </body>
</html>