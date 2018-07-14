<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Quotations</title>
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
        <link href="<?php echo base_url('assets/plugins/selectpicker/select.min.css'); ?>" rel="stylesheet" type="text/css" />
    </head>

    <body>
                <?php
                    include(TEMPLATES_PATH . DS . 'leftmenu.tpl.php');
                    include(TEMPLATES_PATH . DS . 'header.tpl.php');
                ?>
    	       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			        <div class="panel panel-primary">
				        <div class="panel-heading">
					       <span class="elipsis title"><strong>Quotation Request</strong></span>
				        </div>

				<div class="panel-body">
                    <form action="" method="post">
                        <?php if(isset($_GET['quotation_id']))
                        {
                            $quote = mysqli_fetch_array(mysqli_query($mysqli_con,"SELECT * FROM es_in_quotation_requests WHERE rfq_id =".$_GET['quotation_id']), MYSQLI_ASSOC);
                        }
                        ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                            <label><b>Supplier</b></label>
                            <select class="form-control selectpicker" multiple="multiple" data-live-search="true" required="required" name="supplier_id[]">
                            <?php while($supplier = mysqli_fetch_assoc($suppliers))
                            {
                                echo"<option value='".$supplier['es_in_supplier_masterid']."'>".$supplier['in_name']."</option>";
                            }
                            ?>
                            </select>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                            <label><b>Subject</b></label>
                            <input type="text" name="quotation_subject" class="form-control" required="required" value="<?php echo $quote['quotation_subject']; ?>">
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                            <label><b>Message</b></label>
                            <textarea class="summernote form-control" data-height="200" data-lang="en-US" name="message"><?php echo $quote['message_body']; ?></textarea>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                            <button name="request_quote" type="submit" class="btn btn-primary" value="1">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
        <!-- JAVASCRIPT FILES -->
        <script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
        <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/plugins/selectpicker/select.min.js'); ?>"></script>
    </body>
</html>