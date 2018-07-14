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
			                     <span class="title elipsis"><strong>Fee Details</strong></span>
		                    </div>

                            <div class="panel-body">

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                    <label><b>Academic Year</b></label>
                                    <select class="form-control" id="ac_year">
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
                                    <label><b>Class</b></label>
                                    <select class="form-control" id="class_id">
                                        <option value="ALL"> --SELECT CLASS--</option>
                                        <?php
                                        $classes = mysqli_query($mysqli_con, "SELECT * FROM es_classes ORDER BY es_orderby");
                                        while($class = mysqli_fetch_assoc($classes))
                                        {
                                        echo "<option value='".$class['es_classesid']."'>";
                                        echo $class['es_classname'];
                                        echo "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive" align="center" id="fees_detail">
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
        <script>
        function fetch_detail()
        {
            $('#fees_detail').html("<img src='<?php echo base_url('assets/images/ajax-loader.gif'); ?>' class='img-responsive'>");
            var ac_year = $('#ac_year').val();
            var class_id = $('#class_id').val();
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("fees_detail").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","?pid=17&action=viewfees_pagination&ac_year="+ac_year+"&class_id="+class_id,true);
            xmlhttp.send();
        }

        $(document).on('change', '#ac_year', fetch_detail);
        $(document).on('change', '#class_id', fetch_detail);
        fetch_detail();
        </script>
        <script>
            $(document).on('click', '.edit-fees', function(){
                var btn = this;
                var particular = $(btn).closest('tr').find('.fee_particular').html();
                $(btn).closest('tr').find('.fee_particular').html('<input class="form-control" value="'+particular+'">');
                var amount = $(btn).closest('tr').find('.fee_amount').html();
                $(btn).closest('tr').find('.fee_amount').html('<input class="form-control" value="'+amount+'">');
                $(btn).closest('tr').find('.ledger_span').hide();
                $(btn).closest('tr').find('.ledger_dropdown').show();
                $(btn).hide();
                $(btn).closest('tr').find('.save-fees').show();

            });
        </script>
        <script>
            $(document).on('click', '.save-fees', function(){
                var btn = this;
                var particular = $(btn).closest('tr').find('.fee_particular input').val();
                var amount = $(btn).closest('tr').find('.fee_amount input').val();
                var ledger = $(btn).closest('tr').find('.ledger_dropdown').val();
                var particular_id = $(btn).closest('tr').find('.particular_id').val();
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        $(btn).closest('tr').find('.fee_particular').html(particular);
                        $(btn).closest('tr').find('.fee_amount').html(amount);
                        ledger = $(btn).closest('tr').find('.ledger_dropdown option:selected').text();
                        $(btn).closest('tr').find('.ledger_span').html(ledger);
                        $(btn).closest('tr').find('.ledger_span').show();
                        $(btn).closest('tr').find('.ledger_dropdown').hide();
                        $(btn).hide();
                        $(btn).closest('tr').find('.edit-fees').show();
                    }
                };
                xmlhttp.open("GET","?pid=17&action=update_fee&particular="+particular+"&amount="+amount+"&ledger="+ledger+"&particular_id="+particular_id,true);
                xmlhttp.send();
                });
        </script>
        <script>
            $(document).on('click', '.delete-fee', function(){
                var sure = confirm('are you sure you want to delete this?');
                if(sure)
                {
                    var btn = this;
                    var particular_id = $(btn).closest('tr').find('.particular_id').val();
                    if (window.XMLHttpRequest) {
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            $(btn).closest('tr').remove();
                        }
                    };
                    xmlhttp.open("GET","?pid=17&action=delete_fee&particular_id="+particular_id,true);
                    xmlhttp.send();
                }
                });
        </script>
    </body>
</html>