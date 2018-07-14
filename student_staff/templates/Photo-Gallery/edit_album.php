<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>EDIT ALBUM</title>
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
                    <form action="" method="post" enctype="multipart/form-data">
                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                               <span class="title elipsis"><strong>EDIT ALBUM</strong></span>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label><b>Album Name</b></label>
                                        <input type="text" name="data[photo_gallery_name]" value="<?php echo $album_detail['photo_gallery_name']; ?>" class="form-control">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label><b>Album Description</b></label>
                                        <textarea name="data[photo_gallery_description]" class="form-control"><?php echo nl2br($album_detail['photo_gallery_description']); ?></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label><b>Album Cover (only if you want to change)</b></label>
                                        <div class="fancy-file-upload fancy-file-primary">
                                            <i class="fa fa-upload"></i>
                                            <input type="file" class="form-control" name="album_cover" onchange="jQuery(this).next('input').val(this.value);" />
                                            <input type="text" class="form-control" placeholder="no file selected" readonly="" />
                                            <span class="button">Choose File</span>
                                        </div>
                                    </div>
                                </div>
                                <br><br>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>SR NO.</th>
                                                <th>IMAGE</th>
                                                <th>NAME</th>
                                                <th>DESCRIPTION</th>
                                                <th width="10%">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; while($photo = mysqli_fetch_assoc($photos)) { ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><img src="<?php echo base_url('uploads/photo_gallery/'.$_GET['album_id'].'/'.$photo['photo_gallery_imageid'].'.jpg'); ?>" alt="Image Not Found" width="150px">
                                                    <input type="hidden" name="image_id[]" value="<?php echo $photo['photo_gallery_imageid']; ?>">
                                                </td>
                                                <td><input type="text" name="image[image_name][]" class="form-control" value="<?php echo $photo['image_name']; ?>"></td>
                                                <td><textarea name="image[image_description][]" class="form-control"><?php echo nl2br($photo['image_description']); ?></textarea></td>
                                                <td align="center">
                                                    <button class="btn btn-danger btn-sm remove_img" value="<?php echo $photo['photo_gallery_imageid']; ?>">&nbsp;<i class="fa fa-trash-o"></i></button>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <button type="submit" class="btn btn-primary pull-right" name="update_album" value="update">
                                    <i class="fa fa-save"></i> SAVE
                                </button>
                            </div>
                        </div>
                    </div>
                    
                </form>
                </div>
            </section>
        </div>

         
        <script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
        <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/plugins/selectpicker/select.min.js'); ?>"></script>

        <script type="text/javascript">
            $(document).on('click', '.remove_img', function(){
                var image_id = $(this).val();
                var album_id = "<?php echo $_GET['album_id']; ?>";
                var tr = $(this).closest('tr');
                var url = "?pid=54&action=remove_img&album_id="+album_id+"&img_id="+image_id;
                $.get(url, function(data){
                    tr.remove();
                });
            });
        </script>
    </body>
</html> 