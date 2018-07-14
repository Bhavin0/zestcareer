<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>ALBUM DETAIL</title>
        <meta name="description" content="" />
        <meta name="Author" content="" />

        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
        <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
    
        <!-- THEME CSS -->
        <link href="<?php echo base_url('assets/css/essentials.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/layout.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/color_scheme/green.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/selectpicker/select.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
        
        <style>
            .thumbnail { border-radius: 9px;transition: 0.15s ease-in-out;border: 1px solid #f3f3f3 !important; }
            .tz-gallery .thumbnail:hover {
                transform: translateY(-10px) scale(1.02);
            }
        </style>
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

                $album_detail = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM photo_gallery WHERE photo_galleryid=".$_GET['album_id']), MYSQLI_ASSOC) or die(MYSQLI_ERROR($mysqli_con));

                $photos = mysqli_query($mysqli_con, "SELECT * FROM photo_gallery_images WHERE photo_gallery_id=".$_GET['album_id']) or die(MYSQLI_ERROR($mysqli_con));
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
                               <span class="title elipsis"><strong>ALBUM DETAIL</strong></span>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td><b>Album Name : </b> <?php echo $album_detail['photo_gallery_name']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Album Description : </b>
                                                <br><?php echo nl2br($album_detail['photo_gallery_description']); ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Date : </b><?php echo YMDtoDMY($album_detail['photo_gallery_date']); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tz-gallery">
                                <?php $j=0; $i=0; while($photo = mysqli_fetch_assoc($photos)) {
                                if($i==0) { ?>
                                <div class="row">
                                <?php } ?>
                                    <div class="col-md-3"> 
                                        <div class="thumbnail">
                                            <a href="<?php echo base_url('uploads/photo_gallery/'.$_GET['album_id'].'/'.$photo['photo_gallery_imageid'].'.jpg'); ?>">
                                                <img src="<?php echo base_url('uploads/photo_gallery/'.$_GET['album_id'].'/'.$photo['photo_gallery_imageid'].'.jpg'); ?>" alt="Lights" style="width:100%">
                                                <div class="caption">
                                                    <b><?php echo $photo['image_name']; ?></b>
                                                    <p><?php echo nl2br($photo['image_description']); ?></p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                <?php if($i==3 || $j==mysqli_num_rows($photos)) { $i=0; ?>
                                    </div>
                                <?php } else { $i++; } $j++; ?>
                                <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
        <script>
            baguetteBox.run('.tz-gallery');
        </script>
        <script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
        <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/plugins/selectpicker/select.min.js'); ?>"></script>
    </body>
</html> 