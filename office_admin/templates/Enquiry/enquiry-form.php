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
            <strong>Enquiry Form</strong>
          </span>
        </div>

        <div class="panel-body">
        <?php
        if(count($errormessage)>0)
        { ?>
          <div class="alert alert-mini alert-danger margin-bottom-30">
          <?php
          foreach($errormessage as $eacherrormessage)
          {
            ?>
            <strong>Error!</strong> <?php echo $eacherrormessage; ?>.<br>
            <?php
          }
          ?>
          </div>
          <?php
        }
        else
        {
        if(isset($emsg) && $emsg!="")
          {
          ?>
          <div class="alert alert-mini alert-success margin-bottom-30">
            <strong>Success!</strong> <?php echo $sucessmessage[$emsg]; ?>.
          </div>
          <?php
          }
        }
        ?>
          <form method="post" name="newenquiry" action="" >

          <div class="row">
              <div class="col-md-12">
                  <u><h4>Applicant Detail</h4></u>
              </div>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
              <label><b>Applicant Name <font color="#FF0000">*</font></b></label>
              <input name="eq_wardname" type="text" id="eq_wardname" value="<?php echo $eq_wardname; ?>" class="form-control" required="required" placeholder="Enter Applicant Name..." />
              <input name="newapplicant" type="hidden" value="newapplicant" />
          </div>

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
              <label>Date of Birth</label>
              <input name="eq_dob" type="text" id="eq_dob" value="<?php if (isset($es_enquiryList[0]->eq_dob)) {  echo $es_enquiryList[0]->eq_dob;}else{echo date('d/m/Y'); } ?>" readonly="readonly"  class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" />
          </div>

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
              <label><b>Gender</b></label>
              <select name="eq_sex" class="form-control">
                <option value="male" >Male</option>
                <option value="female" <?php  if($eq_sex=='female'){ echo"selected='selected'"; } ?> >Female</option>
              </select>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
              <label><b>Father / Guardian Name <font color="#FF0000">*</font></b></label>
              <input type="text" name="eq_name"  id="eq_name" value="<?php echo $eq_name;?>" class="form-control" required="required" placeholder="Enter Father / Guardian Name..." />
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
              <label><b>Mother Name</b></label>
              <input type="text" name="eq_mothername"  id="eq_name2" value="<?php echo $eq_mothername;?>" class="form-control" placeholder="Enter Mother Name..." />
          </div>

          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
              <label><b>Address <font color="#FF0000">*</font></b></label>
              <textarea name="eq_address" id="eq_address" class="form-control" required="required" placeholder="Enter Address..."><?php echo $eq_address;?></textarea>
          </div>

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
              <label><b>City</b></label>
              <input name="eq_city" type="text" id="eq_city" value="<?php echo $eq_city; ?>" class="form-control" placeholder="Enter City..." />
          </div>

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
              <label><b>State</b></label>
              <input name="eq_state" type="text" id="eq_state" value="<?php echo $eq_state; ?>" class="form-control" placeholder="Enter State..." />
          </div>

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
              <label><b>Country</b></label>
              <input name="eq_countryid" type="text" id="eq_countryid"  value="<?php echo $eq_countryid; ?>" class="form-control" placeholder="Enter Country..." />
          </div>

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
              <label><b>Postal Code</b></label>
              <input name="eq_zip" type="text" id="eq_zip"  value="<?php echo $eq_zip; ?>" class="form-control" placeholder="Enter Postal Code..." />
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
              <label><b>Phone No</b></label>
              <input name="eq_phno" type="text" id="eq_phno" value="<?php echo $eq_phno; ?>" class="form-control" placeholder="Enter Phone No..." />
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
              <label><b>Mobile  No<font color="#FF0000"> *</font></b></label>
              <input name="eq_mobile" type="text" id="eq_mobile" value="<?php echo $eq_mobile; ?>" class="form-control" placeholder="All future SMS messages will be sent to this number" required="required" />
          </div>

          <div class="row">
              <div class="col-md-12">
                  <u><h4>Admission Details</h4></u>
              </div>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
              <label><b>Class to be Admitted <font color="#FF0000"> *</font></b></label>
              <select name="pre_class" class="form-control selectpicker" data-live-search="true" required="required">
                <option selected="selected" disabled="disabled"> -- SELECT CLASS -- </option>
                <?php 
                $classlist = getallClasses();
                foreach($classlist as $indclass) {
                if($es_enquiryList[0]->eq_class == $indclass['es_classesid'] || $indclass['es_classesid']==$pre_class) { 
                $sel_cl = "selected='selected'"; }else { $sel_cl  ="";}
                ?>
                  <option <?php echo $sel_cl; ?> value="<?php echo $indclass['es_classesid']; ?>" ><?php echo $indclass['es_classname']; ?></option>
                <?php } ?>
              </select>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
              <label><b>Previous Academics</b></label>
              <input name="eq_prv_acdmic" type="text" id="eq_prv_acdmic" value="<?php echo $eq_prv_acdmic; ?>" class="form-control" placeholder="Enter Previous Academics" />
          </div>

          <div class="row">
              <div class="col-md-12">
                  <u><h4>Referral Details</h4></u>
              </div>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
              <label><b>Reference Type</b></label>
              <select name="eq_reftype" id="eq_reftype" class="form-control">
                  <option selected="selected" disabled="disabled">--SELECT REFERENCE TYPE--</option>
                  <option value="Personal Reference" <?php if($eq_reftype == 'Personal Reference'){ echo "selected"; } ?>>Personal Reference</option>
                  <option value="News Paper" <?php if($eq_reftype == 'News Paper'){ echo "selected"; } ?>>News Paper</option>
                  <option value="Media Ads" <?php if($eq_reftype == 'Media Ads'){ echo "selected"; } ?>>Media Ads</option>
                  <option value="Hoardings" <?php if($eq_reftype == 'Hoardings'){ echo "selected"; } ?>>Hoardings</option>
            </select>  
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
              <label><b>Reference  Name</b></label>
              <input name="eq_refname" type="text" id="eq_refname" value="<?php echo $eq_refname; ?>" class="form-control" placeholder="Enter Reference Type" /> 
          </div>

          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
              <label>Details</label>
              <textarea name="eq_description" id="eq_description" class="form-control" placeholder="Enter Detail..."><?php echo $eq_description; ?></textarea>
          </div>

          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
              <input name="Submit" type="submit" class="btn btn-primary pull-right" value="Submit"/>
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
        <script type="text/javascript">
          $('#dd-8').addClass('active');
          $('#dd-8-1').addClass('active');
        </script>
  </body>
</html>