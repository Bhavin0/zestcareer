<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Goods Issue Notes</title>
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
                                <strong>Goods Issue Notes</strong>
                            </div>
				            <?php
					            $sql = mysql_query("SELECT * FROM es_in_goods_issue ORDER BY es_in_goods_issueid DESC");
		 		            ?>
		 		            <div class="panel-body">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                    <a href="?pid=7&action=goods_issue" class="btn btn-primary pull-right">
                                        Issue Goods
                                    </a>
                                </div>
		 			            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
						            <table class="table table-bordered table-striped">
						                <thead>
							                <tr>
								                <th>GIN ID.</th>
								                <th>Issue Date</th>
								                <th>Issued to</th>
								                <th>Action</th>
							                </tr>
						                </thead>
						                <tbody>
						                <?php while ($row = mysql_fetch_assoc($sql)) { ?>
							                <tr>
								                <td align="center"><?php echo $row['es_in_goods_issueid']; ?></td>
								                <td><?php echo date_format(date_create($row['in_issue_date']), 'd/m/Y'); ?></td>
								                <td><?php echo $row['in_issue_to']; ?></td>
								                <td align="center">
                                                    <a href="?pid=7&action=goods_issue_note&gin_id=<?php echo $row['es_in_goods_issueid']; ?>" title="Reject" class="btn btn-info btn-xs">
                                                        &nbsp;<i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="?pid=7&action=delete_gin&gin_id=<?php echo $row['es_in_goods_issueid']; ?>" title="Delete" class="btn btn-danger btn-xs">
                                                        &nbsp;<i class="fa fa-trash-o" onclick="return confirm('Are you sure you want to delete this?')"></i>
                                                    </a>
								                </td>
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