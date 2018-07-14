!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Activities</title>
        <meta name="description" content="" />
        <meta name="Author" content="" />

        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

        <!-- WEB FONTS -->
        <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />

        <!-- CORE CSS -->
        <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/selectpicker/select.min.css'); ?>" rel="stylesheet" type="text/css" />
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
            <div class="panel panel-primary">
              <div class="panel-heading">
                <span class="elipsis title"><strong>Activities</strong></span>
              </div>
              <div class="panel-body">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 well table-responsive">
                                      <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th> Staff Id </th>
                                                <td colspan="3"> <?php echo $staffdetails['es_staffid']; ?> </td>
                                            </tr>
                                            <tr>
                                                <th> Name </th>
                                                <td colspan="3"> <?php echo $staffdetails['st_firstname']." ".$staffdetails['st_fthname']." ".$staffdetails['st_lastname']; ?> </td>
                                            </tr>
                                            <tr>
                                                <th> Gender </th>
                                                <td> <?php echo $staffdetails['st_gender']; ?> </td>
                                                <th> Date Of Birth </th>
                                                <td> <?php echo displaydate($staffdetails['st_dob']); ?> </td>
                                            </tr>
                                            <tr>
                                                <th> Department </th>
                                                <td> <?php echo deptname($staffdetails['st_department']); ?> </td>
                                                <th> Post </th>
                                                <td> <?php echo postname($staffdetails['st_post']); ?> </td>
                                            </tr>
                                            <tr>
                                            </tr>
                                            <tr>
                                                <th> Primary Subject </th>
                                                <td> <?php echo subjectname($staffdetails['st_subject']); ?> </td>
                                                <th> Basic Salary </th>
                                                <td> <?php echo $_SESSION['eschools']['currency'].".".number_format($staffdetails['st_basic'], 2, '.', ''); ; ?> </td>
                                            </tr>
                                            <tr>
                                            </tr>
                                            <tr>
                                                <th> Date Of Joining </th>
                                                <td> <?php if($staffdetails['st_dateofjoining']!="---") { echo displaydate($staffdetails['st_dateofjoining']); } else { echo "---"; } ?> </td>
                                                <th> Blood Group </th>
                                                <td> <?php echo $staffdetails['st_bloodgroup']; ?>
                                            </tr>
                                            <tr>
                                            </tr>
                                            <tr>
                                                <th> Email </th>
                                                <td colspan="3"> <?php echo $staffdetails['st_email']; ?> </td>
                                            </tr>
                                            <tr>
                                                <th colspan="2"> Permanent Address </th>
                                                <th colspan="2"> Present Address  </th>
                                            </tr>
                                            <tr>
                                                <th> Address </th>
                                                <td> <?php echo $staffdetails['st_peadress']; ?> </td>
                                                <th> Address </th>
                                                <td> <?php echo $staffdetails['st_pradress']; ?> </td>
                                            </tr>
                                            <tr>
                                                <th> City </th>
                                                <td> <?php echo $staffdetails['st_pecity']; ?> </td>
                                                <th> City </th>
                                                <td> <?php echo $staffdetails['st_prcity']; ?> </td>
                                            </tr>
                                            <tr>
                                                <th> State </th>
                                                <td> <?php echo $staffdetails['st_pestate']; ?> </td>
                                                <th> State </th>
                                                <td> <?php echo $staffdetails['st_prstate']; ?> </td>
                                            </tr>
                                            <tr>
                                                <th> Country </th>
                                                <td> <?php echo $staffdetails['st_pecountry']; ?> </td>
                                                <th> Country </th>
                                                <td> <?php echo $staffdetails['st_prcountry']; ?> </td>
                                            </tr>
                                            <tr>
                                                <th> Post Code </th>
                                                <td> <?php echo $staffdetails['st_pepincode']; ?> </td>
                                                <th> Post Code </th>
                                                <td> <?php echo $staffdetails['st_prpincode']; ?> </td>
                                            </tr>
                                            <tr>
                                                <th> Phone No </th>
                                                <td> <?php echo $staffdetails['st_pephoneno']; ?> </td>
                                                <th> Phone No </th>
                                                <td> <?php echo $staffdetails['st_prphonecode']; ?> </td>
                                            </tr>
                                            <tr>
                                                <th> Mobile </th>
                                                <td> <?php echo $staffdetails['st_pemobileno']; ?> </td>
                                                <th> Mobile </th>
                                                <td> <?php echo $staffdetails['st_prmobno']; ?> </td>
                                            </tr>
                                        </tbody>
                                      </table>
                                    </div>
              </div>
              </div> <!-- col-LG-12 -->
            </div>
          </section>
      </div>
    </div>
      <!-- JAVASCRIPT FILES -->
      <script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
      <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
      <script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
      <script type="text/javascript" src="<?php echo base_url('assets/plugins/selectpicker/select.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
        <script>
        $(function () {
            $(".table").DataTable({
                ordering: false
            })
        });
        </script>
    </body>
</html>