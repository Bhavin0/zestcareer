<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Semesters</title>
        <meta name="description" content="" />
        <meta name="Author" content="" />

        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

        <!-- WEB FONTS -->
        <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />

        <!-- CORE CSS -->
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
		                        <span class="title elipsis">
			                        <strong>Semester / Terms Details</strong>
		                        </span>
	                        </div>
	                        <div class="panel-body">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                    <button type="button" class="btn btn-primary pull-right"  data-toggle="modal" data-target="#AddNewSemester">
                                        <i class="fa fa-plus"></i> Add New Semester
                                    </button>
                                </div>
                                <div id="AddNewSemester" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:#4b5354;">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel" style="color:white;">ADD NEW SEMESTER</h4>
                                            </div>
                                            <form action="?pid=22&action=semesters" method="post">
                                            <div class="modal-body">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                                    <label><b>Academic Year</b></label>
                                                    <select class="form-control selectpicker" data-live-search="true" name="academic_year_id">
                                                    <?php
                                                        for($i=0; $i < count($academic_years); $i++)
                                                        {
                                                            echo "<option value='".$academic_years[$i]['es_finance_masterid']."'>";
                                                            echo date_format(date_create($academic_years[$i]['fi_ac_startdate']), 'd/m/Y')." - ".date_format(date_create($academic_years[$i]['fi_ac_enddate']), 'd/m/Y');
                                                            echo "</option>";
                                                        }
                                                    ?>
                                                    </select>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                                    <label><b>Department</b></label>
                                                    <select class="form-control selectpicker" data-live-search="true" name="department_id">
                                                    <?php
                                                        $sections = mysqli_query($mysqli_con, "SELECT * FROM es_groups ORDER BY es_grouporderby");
                                                        while( $row = mysqli_fetch_assoc($sections))
                                                        {
                                                            echo"<option value='".$row['es_groupsid']."'> ".$row['es_groupname']." </option>";
                                                        }
                                                    ?>
                                                    </select>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                                    <label><b>From</b></label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        <input type="text" class="form-control datepicker" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false" readonly="" value="" name="from_date">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                                    <label><b>To</b></label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        <input type="text" class="form-control datepicker" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false" readonly="" value="" name="to_date">
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <label><b>Name</b></label>
                                                    <input type="text" name="name" class="form-control">
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button name="addsemester" type="submit" class="btn btn-primary">SUBMIT</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <?php      

                                $query1 = "SELECT new_semesters.*, es_groups.es_groupname, es_finance_master.fi_ac_startdate, es_finance_master.fi_ac_enddate FROM new_semesters INNER JOIN es_groups ON es_groups.es_groupsid = new_semesters.department_id INNER JOIN es_finance_master ON new_semesters.academic_year_id = es_finance_master.es_finance_masterid";
                                    if(isset($_GET['academic_year_id']))
                                    {
                                        $query1 .= " WHERE new_semesters.academic_year_id =".$_GET['academic_year_id'];
                                    }
                                    else
                                    {
                                        $query1 .= " WHERE new_semesters.academic_year_id =".$academic_years[0]['es_finance_masterid'];
                                    }
                                    $semesters = mysqli_query($mysqli_con, $query1);
                                ?>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                    <form method="get">
                                    <input type="hidden" name="pid" value="22">
                                    <input type="hidden" name="action" value="semesters">
                                    <select class="form-control" name="academic_year_id" onchange="this.form.submit()">
                                    <?php
                                    for($i=0; $i < count($academic_years); $i++)
                                    {
                                        $selected = ($_GET['academic_year_id']==$academic_years[$i]['es_finance_masterid'])?'selected':'';
                                        echo "<option value='".$academic_years[$i]['es_finance_masterid']."' ".$selected.">";
                                        echo date_format(date_create($academic_years[$i]['fi_ac_startdate']), 'd/m/Y')." - ".date_format(date_create($academic_years[$i]['fi_ac_enddate']), 'd/m/Y');
                                        echo "</option>";
                                    }
                                    ?>
                                    </select>
                                    </form>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group table-responsive">
	                                <table class="table table-striped table-bordered table-hover">
		                                <thead>
			                                <tr>
				                                <th>S NO</th>
                                                <th>Name</th>
				                                <th>Department</th>
				                                <th>Period</th>
				                                <th>Action</th>
			                                </tr>
		                                </thead>
		                                <tbody>
		                                <?php $i = 1;
			                            while($row = mysqli_fetch_assoc($semesters)) { ?>
			                                <tr>
				                                <td><?php echo $i++; ?></td>
				                                <td><?php echo $row['name'];?></td>
				                                <td><?php echo $row['es_groupname']; ?></td>
				                                <td><?php echo displaydate($row['from_date'])." To <br/>". displaydate($row['to_date']);?></td>
				                                <td>-</td>
			                                 </tr>
                                        <?php } ?>
		                                </tbody>
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
    </body>
</html>