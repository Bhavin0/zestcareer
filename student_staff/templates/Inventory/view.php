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
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css'); ?>">
    
        <!-- THEME CSS -->
        <link href="<?php echo base_url('assets/css/essentials.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/layout.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/color_scheme/green.css'); ?>" rel="stylesheet" type="text/css" />
    </head>
    <body>
         <?php
         include(TEMPLATES_PATH . DS . 'leftmenu.tpl.php');
         include(TEMPLATES_PATH . DS . 'header.tpl.php');
    ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <span class="title elipsis">
            <strong>Goods Issue Requests</strong>
          </span>
        </div>

        <div class="panel-body">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                <div class="table-responsive">
                <?php
                    $requests = mysqli_query($mysqli_con, "SELECT * FROM es_in_goods_issue_requests WHERE staff_id = ".$_SESSION['eschools']['user_id']." ORDER BY es_in_goods_issueid DESC");
                ?>
                    <table class="table table-bordered">
                        <thead> 
                            <tr>
                                <th>GIN No.</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($request = mysqli_fetch_assoc($requests)) {
                                if($request['status'] == 'Pending')
                                {
                                    $class = 'warning';
                                }
                                elseif ($request['status'] == 'Rejected')
                                {
                                    $class = 'danger';
                                }
                                else
                                {
                                    $class = 'success';
                                }
                                ?>
                            <tr class="<?php echo $class; ?>">
                                <td width=10% align="center">
                                    <?php echo $request['es_in_goods_issueid']; ?>
                                </td>
                                <td width="15%">
                                    <?php echo date_format(date_create($request['in_issue_date']), 'd/m/Y'); ?>
                                </td>
                                <td width="35%">
                                    <?php echo $request['remarks']; ?>
                                </td>
                                <td width=20%>
                                    <?php echo $request['status']; ?>
                                </td>
                                <td align="center">
                                    <a href="?pid=61&action=detail&issue_id=<?php echo $request['es_in_goods_issueid']; ?>" class="btn btn-info btn-xs">
                                        &nbsp;<i class="fa fa-eye"></i>
                                    </a>
                                    <?php if($request['status'] == 'Pending') { ?>
                                    <a href="?pid=61&action=edit&issue_id=<?php echo $request['es_in_goods_issueid']; ?>" class="btn btn-warning btn-xs">
                                        &nbsp;<i class="fa fa-pencil-square-o"></i>
                                    </a>
                                    <a href="?pid=61&action=delete&issue_id=<?php echo $request['es_in_goods_issueid']; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this request?')">
                                        &nbsp;<i class="fa fa-trash-o" ></i>
                                    </a>
                                    <?php } ?>
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