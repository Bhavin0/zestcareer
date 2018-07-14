<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title> Product Category</title>
        <meta name="description" content="" />
        <meta name="Author" content="" />

        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

        <!-- WEB FONTS -->
        <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />

        <!-- CORE CSS -->
        <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/selectpicker/select.min.css'); ?>" rel="stylesheet" type="text/css" />
    
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
					            <span class="elipsis title"><strong>Goods Issue Note (GIN)</strong></span>
				            </div>

				            <div class="panel-body">
                                <form action="?pid=7&action=goods_issue" method="post">
                                <?php if(isset($_GET['request_id']))
                                { 
                                    $req_items = mysqli_query($mysqli_con, "SELECT * FROM es_in_goods_issue_request_items WHERE es_in_goods_issue_id = ".$_GET['request_id']);
                                    $req = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT es_in_goods_issue_requests.*, es_staff.st_firstname, es_staff.st_lastname  FROM es_in_goods_issue_requests INNER JOIN es_staff ON es_staff.es_staffid = es_in_goods_issue_requests.staff_id WHERE es_in_goods_issue_requests.es_in_goods_issueid =".$_GET['request_id']), MYSQLI_ASSOC);
                                }
                                ?>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
                                    <label>GIN No</label>
                                    <span class="form-control"><?php echo $gin_no[0]; ?></span>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                    <label>GIN Date</label>
                                    <input name="in_issue_date" value="<?php echo date('Y-m-d'); ?>" class="datepicker form-control">
                                </div>

                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 form-group">
                                    <label>Issued to</label>
                                    <?php if(isset($_GET['request_id'])) { ?>
                                    <input type="hidden" name="request_id" value="<?php echo $_GET['request_id']; ?>">
                                    <input type="hidden" name="staff_id" value="<?php echo $req['staff_id']; ?>">
                                    <input type="text" name="in_issue_to" class="form-control" value="<?php echo $req['st_firstname']." ".$req['st_lastname']; ?>" />
                                    <?php } else { ?>
                                    <input type="hidden" name="request_id" value="NULL">
                                    <input type="hidden" name="staff_id" value="NULL">
                                    <input type="text" name="in_issue_to" class="form-control" value="" />
                                    <?php } ?>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
                                    <table class="table table-bordered">
                                        <thead> 
                                            <tr>
                                                <th>Category</th>
                                                <th>Item Code (Item Name)</th>
                                                <th>Available Quantity</th>
                                                <th>Required Quantity</th>
                                                <th align="center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(mysqli_num_rows($req_items)) {
                                        while($item = mysqli_fetch_assoc($req_items)) { ?>
                                            <tr>
                                                <td width="30%">
                                                    <select class="category form-control" name="item_category[]">
                                                        <option selected="" disabled="">--SELECT CATEGORY--</option>
                                                        <?php
                                                        for($i = 0; $i < count($category_json); $i++)
                                                        {
                                                        $selected = ($category_json[$i]['es_in_categoryid']==$item['item_category'])?'selected':'';
                                                        echo"<option value='".$category_json[$i]['es_in_categoryid']."' ".$selected.">".$category_json[$i]['in_category_name']."</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                <td width="35%">
                                                <?php
                                                    $temp = mysqli_query($mysqli_con, "SELECT * FROM es_in_item_master WHERE in_category_id=".$item['item_category']);
                                                ?>
                                                    <select class="items form-control" name="item_id[]">
                                                        <option selected="" disabled="">--SELECT ITEM--</option>
                                                    <?php while($tem = mysqli_fetch_assoc($temp))
                                                    {
                                                        $selected = ($tem['es_in_item_masterid']==$item['item_id'])?'selected':'';
                                                        echo"<option value='".$tem['es_in_item_masterid']."' ".$selected.">".$tem['in_item_code']." (".$tem['in_item_name'].")</option>";
                                                    }
                                                    ?>
                                                    </select>
                                                </td>
                                                <td width="10%" align="center" class="available">
                                                    <?php $avail_qty = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT in_qty_available FROM es_in_item_master WHERE es_in_item_masterid=".$item['item_id']), MYSQLI_NUM);
                                                    echo $avail_qty[0]; ?>
                                                </td>
                                                <td width="10%">
                                                    <input type="number" name="item_qty[]" class="qty form-control" value="<?php echo $item['qty']; ?>" max=<?php echo $avail_qty[0]; ?> min=0>
                                                </td>
                                                <td align="center">
                                                    <button type="button" class="add btn btn-info btn-sm">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                    <button type='button' class='remove btn btn-danger btn-sm'>
                                                        <i class='fa fa-minus'></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php }
                                            } else { ?>
                                            <tr>
                                                <td width="30%">
                                                    <select class="category form-control" name="item_category[]">
                                                        <option selected="" disabled="">--SELECT CATEGORY--</option>
                                                        <?php
                                                        for($i = 0; $i < count($category_json); $i++)
                                                        {
                                                        echo"<option value='".$category_json[$i]['es_in_categoryid']."'>".$category_json[$i]['in_category_name']."</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                <td width="35%">
                                                    <select class="items form-control" name="item_id[]">
                                                        <option selected="" disabled="">--SELECT ITEM--</option>
                                                    </select>
                                                </td>
                                                <td width="10%" align="center" class="available">
                                                    -
                                                </td>
                                                <td width="10%">
                                                    <input type="number" name="item_qty[]" class="qty form-control" value="<?php echo $item['qty']; ?>" max=0 min=0>
                                                </td>
                                                <td align="center">
                                                    <button type="button" class="add btn btn-info btn-sm">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                    <button type='button' class='remove btn btn-danger btn-sm'>
                                                        <i class='fa fa-minus'></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>    
                                    </table>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                    <input type="submit" name="issue_goods" class="btn btn-primary pull-right" value="Issue">
                                </div>
                                </form>
			                </div>
		                </div>
	                </div>
                </div>
            </section>
        </div>

        <!-- JAVASCRIPT FILES -->
        <script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
        <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/plugins/selectpicker/select.min.js'); ?>"></script>
        <script>
        function myFunction() {
            // Declare variables
            var input, filter, ul, li, a, i;
            input = document.getElementById('myInput');
            filter = input.value.toUpperCase();
            ul = document.getElementById("myUL");
            li = ul.getElementsByTagName('li');
            // Loop through all list items, and hide those who don't match the search query
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("a")[0];
                if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }
        </script>
        <script>
        function addrow() {
            $("<tr>"+
                "<td>"+
                    "<select class='category form-control' name='item_category[]' required='required'>"+
                        "<option selected disabled value>--SELECT CATEGORY--</option>"+
                        "<?php for($i = 0; $i < count($category_json); $i++){ echo'<option value='.$category_json[$i]['es_in_categoryid'].'>'.$category_json[$i]['in_category_name'].'</option>'; } ?>"+
                    "</select>"+
                "</td>"+
                "<td>"+
                    "<select class='items form-control' name='item_id[]' required='required'>"+
                        "<option selected disabled>--SELECT ITEM--</option>"+
                    "</select>"+
                "</td>"+
                "<td align='center' class='available'>"+
                    " - "+
                "</td>"+
                "<td>"+
                    "<input type='number' name='item_qty[]' class='qty form-control' required='required' min=0 max=0>"+
                "</td>"+
                "<td align='center'>"+
                    "<button type='button' class='add btn btn-info btn-sm'>"+
                        "<i class='fa fa-plus'></i>"+
                    "</button>"+
                    "<button type='button' class='remove btn btn-danger btn-sm'>"+
                        "<i class='fa fa-minus'></i>"+
                    "</button>"+
                "</td>"+
            "</tr>").insertAfter($(this).closest('tr'));
        };

        $(document).on('click', '.add', addrow);

        function remove_row() {
            $(this).closest('tr').remove();
        }

        $(document).on('click', '.remove', remove_row);

        $(document).ready(function() {
            $(document).on('change', '.category', function(){
                var str = this;
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                        var item = $(str).closest('tr').find('.items');
                        $(item).html("<option selected disabled>--SELECT ITEM--</option>");
                        $(item).html($(item).html() + this.responseText);
                    }
                };
                xmlhttp.open("GET","ajax.php?action=items&q="+$(str).val(),true);
                xmlhttp.send();
            });


            $(document).on('change', '.items', function(){
                var str = this;
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                        $(str).closest('tr').find('.available').html(this.responseText);
                        $(str).closest('tr').find('.qty').attr('max', this.responseText);
                    }
                };
                xmlhttp.open("GET","ajax.php?action=avail_qty&q="+$(str).val(),true);
                xmlhttp.send();
            });
        });
        </script>
    </body>
</html>