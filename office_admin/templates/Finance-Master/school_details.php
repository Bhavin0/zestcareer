<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title><?php if (isset($arr_pages[$pid]['title'])) echo $arr_pages[$pid]['title']; ?></title>
        <meta name="description" content="" />
        <meta name="Author" content="" />

        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

        <!-- WEB FONTS -->
        <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />

        <!-- CORE CSS -->
        <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
    
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
			                        <strong>School / College Details</strong>
		                        </span>
	                        </div>
	                        <div class="panel-body">

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                    <button type="button" class="btn btn-primary pull-right"  data-toggle="modal" data-target="#AddNewAcademicYear">
                                        <i class="fa fa-plus"></i> Add New Academic Year
                                    </button>
                                </div>

                                <div id="AddNewAcademicYear" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:#4b5354;">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel" style="color:white;">
                                                    Add New Academic Year
                                                </h4>
                                            </div>

                                            <form id="form1" name="schooldetailsform" method="post" action="" enctype="multipart/form-data">
                                            <div class="modal-body"> 
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <label><b>Financial year</b></label>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group ">
                                                    <label>Start Date: <font color="#FF0000">*</font></label>
                                                    <div class="input-group">  
                                                        <input class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" name="fi_startdate" readonly />
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                                    <label>End Date: <font color="#FF0000">*</font></label>
                                                    <div class="input-group">  
                                                        <input class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" name="fi_enddate" value="" readonly>
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <label><b>Academic Year</b></label>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                                    <label>Start Date: <font color="#FF0000">*</font></label>
                                                    <div class="input-group">  
                                                        <input class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" name="fi_ac_startdate" value="" readonly />
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <label>End Date: <font color="#FF0000">*</font></label>
                                                    <div class="input-group">  
                                                        <input class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" name="fi_ac_enddate" value="" readonly>
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <label>School / College Name <font color="#FF0000">*</font></label>
                                                    <input type="text" name="fi_schoolname" value="" class="form-control" />
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <label>Address <font color="#FF0000">*</font></label>
                                                    <input type="hidden" name="fi_currency" value="INR" />
                                                    <input type="hidden" name="fi_symbol" value="Rs" />
                                                    <textarea class="form-control" name="fi_address" ></textarea>
                                                </div>

                                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <label>Affiliation Details</label>
                                                    <input type="text" name="fi_endclass" value="" class="form-control" />
                                                </div>

                                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <label>E-mail  <font color="#FF0000">*</font></label>
                                                    <input type="text" name="fi_email" value="" class="form-control" />
                                                </div>

                                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <label>Phone Number <font color="#FF0000">*</font></label>
                                                    <input type="text" name="fi_phoneno" value="" class="form-control" />
                                                </div>

                                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <label>Web Site Url</label>
                                                    <input type="text" name="fi_website" value="" class="form-control" />
                                                </div>

                                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <label>Logo (Upload image of size 100 X 100)</label>
                                                    <input type="file" name="fi_school_logo" />
                                                    <input type="hidden" name="oldlogoimage" value="" />
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button name="Submit" type="submit" class="btn btn-primary" value="Submit">SUBMIT</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
	                                <table class="table table-striped table-bordered table-hover">
		                                <thead>
			                                <tr>
				                                <th>S NO</th>
				                                <th>Name</th>
				                                <th>Academic Year</th>
				                                <th>Address</th>
			                                </tr>
		                                </thead>
		                                <tbody>
		                                <?php
			                                $i = 1;
			                                foreach ($get_school_details as $each_school) { ?>
			                                <tr>
				                                <td><?php echo $i++; ?></td>
				                                <td><?php echo $each_school['fi_schoolname'];?></td>
				                                <td><?php echo displaydate($each_school['fi_ac_startdate'])." To <br/>". displaydate($each_school['fi_ac_enddate']);?></td>
				                                <td><?php echo $each_school['fi_address']."<br/>Phone :".$each_school['fi_phoneno']."<br/>Email:".$each_school['fi_email'];?></td>
			                                </tr>
		                                </tbody>
                                        <?php } ?>
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