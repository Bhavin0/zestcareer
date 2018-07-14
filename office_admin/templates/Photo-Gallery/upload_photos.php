<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>UPLOAD PHOTOS</title>
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
        <link href="<?php echo base_url('assets/css/thumbnail-gallery.css'); ?>" rel="stylesheet" type="text/css" />

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
                               <span class="title elipsis"><strong>UPLOAD PHOTOS</strong></span>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#upload-photo">
                                        <i class="fa fa-plus"></i> ADD PHOTO
                                    </button>
                                    <br><br>
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

         <div class="modal fade modal-primary" tabindex="-1" role="dialog" aria-hidden="true" id="upload-photo">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header" style="background-color: #4b5354;">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <h4 class="modal-title" id="FilterLabel" style="color:#ffffff">Upload Photo</h4>
                </div>

                <form action="" method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label><b>Image Name</b></label>
                            <input class="form-control" type="text" name="data[image_name]" required="required">
                        </div>

                        <div class="col-md-12 form-group">
                            <label><b>Image Description</b></label>
                            <textarea class="form-control" name="data[image_description]"></textarea>
                        </div>

                        <div class="col-md-12">
                            <label><b>Image</b></label>
                            <div class="fancy-file-upload fancy-file-primary">
                                <i class="fa fa-upload"></i>
                                <input type="file" class="form-control" name="image" onchange="jQuery(this).next('input').val(this.value);" required="" />
                                <input type="text" class="form-control" placeholder="no file selected" readonly="" />
                                <span class="button">Choose File</span>
                            </div>
                        </div>
                    </div>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="upload" value="upload" name="upload" class="btn btn-primary">UPLOAD</button>
                  </div>
                </form>
              </div>
            </div>
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