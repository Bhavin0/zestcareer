<!doctype html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Send SMS to Students</title>
    <meta name="description" content="" />
    <meta name="Author" content="" />
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
    <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />
    <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
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
                <span class="title elipsis"><strong>Send SMS to Students</strong></span>
              </div>
              <div class="panel-body">
                <form method="post" action="">

                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                    <label><b>Academic Year</b></label>
                    <select name="pre_year" class="form-control selectpicker" data-live-search="true" id="ac_year">
                    <?php $academic_years = get_all_results('es_finance_master', 'es_finance_masterid', 'DESC');
                    foreach($academic_years as $academic_year) { ?>
                      <option value="<?php echo $academic_year['es_finance_masterid']; ?>">
                        <?php echo displaydate($academic_year['fi_startdate'])." -".displaydate($academic_year['fi_enddate']); ?>
                      </option>
                    <?php } ?>
                    </select>
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                    <label><b>Select Section</b></label>
                    <?php $sql = mysql_query("SELECT * FROM es_groups"); ?>
                    <select class="form-control selectpicker" data-live-search="true" name="section" id="section_id">
                      <option value="all">ALL SECTION</option>
                      <?php while($row = mysql_fetch_assoc($sql)){ ?>
                      <option value="<?php echo $row['es_groupsid']; ?>"> <?php echo $row['es_groupname']; ?> </option>
                    <?php } ?>
                    </select>
                  </div>

                  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
                    <label><b>Select Class</b></label>
                    <select class="form-control selectpicker" data-live-search="true" id="class_id" name="class">
                      <option value="all">ALL CLASSES</option>
                    </select>
                  </div>

                  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
                    <label><b>Select Division</b></label>
                    <select class="form-control selectpicker" data-live-search="true" id="division_id" name="division">
                      <option value="all">ALL DIVISION</option>
                    </select>
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                    <label><b>Select Student</b></label>
                    <select class="form-control selectpicker" data-live-search="true" id="student_id" name="student_id">
                      <option value="all">ALL STUDENTS</option>
                    </select>
                  </div>

				  				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				  					<label><b>Message</b></label>
				  					<textarea class="form-control" id="message"></textarea>
				  				</div>

				  				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				  					<button type="button" id="send" name="send" class="btn btn-primary pull-right">
				  						<i class="fa fa-paper-plane-o"></i> SEND
				  					</button>
				  				</div>

				  				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
				  					<table class="table table-bordered">
				  						<thead>
				  							<tr>
				  								<td>Student Name</td>
				  								<td>Mobile No</td>
				  								<td>Response</td>
				  							</tr>
				  						</thead>
				  						<tbody id="response">
				  						</tbody>
				  					</table>
				  				</div>
				  			</form>
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
        //ON ACADEMIC YEAR CHANGE
      $(document).on('change', '#ac_year', function(){
        $('#section_id').val('all');
        $('#class_id').html("<option value='all'>ALL CLASSES</option>");
        $('#division_id').html("<option value='all'>ALL DIVISION</option>");
        $('#student_id').html("<option value='all'>ALL STUDENT</option>");
        $('.selectpicker').selectpicker('refresh');
      });

      //ON SECTION CHANGE
      $(document).on('change', '#section_id', function(){
        $('#class_id').html("<option value='all'>ALL CLASSES</option>");
        $('#division_id').html("<option value='all'>ALL DIVISION</option>");
        $('#student_id').html("<option value='all'>ALL STUDENT</option>");
        $('.selectpicker').selectpicker('refresh');

        var ac_year = $('#ac_year').val();
        var section_id = $(this).val();

        //FETCH CLASSES
        var classes_url = "ajax.php?action=classes&q="+section_id;
        $.get(classes_url, function( data ) {
          data = "<option value='all'>ALL CLASSES</option>" + data;
          $('#class_id').html(data);
          $('.selectpicker').selectpicker('refresh');
        });
      });

      //ON CLASS CHANGE
      $(document).on('change', '#class_id', function(){
        $('#division_id').html("<option value='all'>ALL DIVISION</option>");
        $('#student_id').html("<option value='all'>ALL STUDENT</option>");
        $('.selectpicker').selectpicker('refresh');

        var class_id = $(this).val();
        if(class_id != 'all')
        {
          var url = "ajax.php?action=divisions&q="+class_id;
          $.get(url, function( data ) {
              data = "<option value='all'>ALL DIVISION</option>" + data;
            $('#division_id').html(data);
            $('.selectpicker').selectpicker('refresh');
          });
        } 
      });

        //ON DIVISION CHANGE
      $(document).on('change', '#division_id', function(){
        $('#student_id').html("<option value='all'>ALL STUDENT</option>");
        $('.selectpicker').selectpicker('refresh');

        var ac_year = $('#ac_year').val();
        var division_id = $(this).val();
        if(class_id != 'all')
        {
          var url = "ajax.php?action=students&q="+division_id+"&ac_year="+ac_year;
          $.get(url, function( data ) {
            data = "<option value='all'>ALL STUDENT</option>" + data;
            $('#student_id').html(data);
            $('.selectpicker').selectpicker('refresh');
          });
        }
      });
      </script>
      <?php $sms_detail = get_single_row('smsconfig', array('configid' => 1)); ?>
      <script>
      $(document).on('click', '#send', function(){
        $('#send').fadeOut();


        var ac_year = $('#ac_year').val();
        var section_id = $('#section_id').val();
        var class_id = $('#class_id').val();
        var division_id = $('#division_id').val();
        var student_id = $('#student_id').val();
        var semester = $('#semesters').val();
        var status = $('#status').val();

        var url = "<?php echo base_url('office_admin'); ?>?pid=62&action=sms_student_json&ac_id="+ac_year+"&section_id="+section_id+"&class_id="+class_id+"&division_id="+division_id+"&student_id="+student_id;

        var sms_api = "<?php echo $sms_detail['sms_api_url']; ?>";
        var message = encodeURI($('#message').val());
        sms_api = sms_api.replace("[message]", message);

        $.get(url, function(data) {
          var students = JSON.parse(data);
            var i;
            var index;
            for(i = 0; i < students.length; ++i) {( function(index){
              
              var mobile_no = students[index].sms_no;
              var student_name = students[index].student_name;

              if((mobile_no.match(/^\d{10}$/)))
              {
                sms_api = sms_api.replace("[phone_nos]", mobile_no);

                $.ajax(sms_api).always(function() {
                  $("#response").append('<tr class="success">'+
                                        '<td>'+ student_name + '</td>'+
                                        '<td>'+ mobile_no +'</td>'+
                                        '<td>Success</td>'+
                                      '</tr>');
                });
              }
              else
              {
                $("#response").append('<tr class="danger">'+
                                        '<td>'+ student_name + '</td>'+
                                        '<td>'+ mobile_no +'</td>'+
                                        '<td>Failed</td>'+
                                      '</tr>');
              }
            })(i); }
        });
      });
      </script>
  	</body>
</html>