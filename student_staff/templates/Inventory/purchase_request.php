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
        <link href="<?php echo base_url('assets/plugins/selectpicker/select.min.css'); ?>" rel="stylesheet" type="text/css" />
    
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
            <strong>Goods Issue Request</strong>
          </span>
        </div>

        <div class="panel-body">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                <form action="" method="post" name="pur_req">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">

                    <table class="table table-bordered">
                        <thead> 
                            <tr>
                                <th>Category</th>
                                <th>Item Code (Item Name)</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
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
                                <td width="20%">
                                    <input type="number" name="item_qty[]" class="form-control">
                                </td>
                                <td>
                                    <button type="button" class="add btn btn-info btn-sm">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>    
                    </table>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                        <label>Remarks</label>
                        <textarea class="form-control" rows="3" name="main_remarks" required="required"></textarea>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                        <button type="submit" name="submit" value="purchase" class="btn btn-primary pull-right">Submit</button>
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
  function addrow() {
    $("<tr><td><select class='category form-control' name='item_category[]'><option selected disabled value>--SELECT CATEGORY--</option><?php for($i = 0; $i < count($category_json); $i++){ echo'<option value='.$category_json[$i]['es_in_categoryid'].'>'.$category_json[$i]['in_category_name'].'</option>'; } ?></select></td><td><select class='items form-control' name='item_id[]'><option selected disabled>--SELECT ITEM--</option></select></td><td><input type='number' name='item_qty[]' class='form-control'></td><td><button type='button' class='add btn btn-info btn-sm'><i class='fa fa-plus'></i></button> <button type='button' class='remove btn btn-danger btn-sm'><i class='fa fa-minus'></i></button></td></tr>").insertAfter($(this).closest('tr'));
    
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
                $(str).closest('tr').find('.items').html(this.responseText);
            }
        };
        xmlhttp.open("GET","ajax.php?action=items&q="+$(str).val(),true);
        xmlhttp.send();
    });
});

</script>
  </body>
</html>