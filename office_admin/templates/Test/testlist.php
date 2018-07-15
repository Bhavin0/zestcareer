<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>MCQ Tests</title>
        <meta name="description" content="" />
        <meta name="Author" content="" />

        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

        <!-- WEB FONTS -->
        <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />
        <!-- CORE CSS -->
        <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        
        <link href="<?php echo base_url('assets/plugins/bootstrap.datepicker/css/bootstrap-datetimepicker.css');  ?>" type="text/css" rel="stylesheet"/>

        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css'); ?>">

        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2/css/select2.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2/css/select2.css'); ?>">
        
        <!-- THEME CSS -->
        <link href="<?php echo base_url('assets/css/essentials.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/layout.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/color_scheme/green.css'); ?>" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/third_party/DataTables/datatables.min.css'); ?>">

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
                           <span class="title elipsis"><strong>MCQ Tests</strong></span>
                        </div>
                        <div class="panel-body">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#add-test">
                                    <i class="fa fa-plus"></i> Add Test
                                </button>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  table-responsive">
                                <table class="table table-bordered data-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Class</th>
                                            <th>Subject</th>
                                            <th>Question</th>
                                            <th>Question Added</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <!-- <th>Start Time</th>
                                            <th>End Time</th> -->
                                            <th>Duration</th>
                                            <th>Weightage</th>
                                            <th>Negative Marking</th>
                                            <th>Created At</th>
                                            <th>Status</th>
                                            <th style="width:50px;!important">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php 
                                    $test = mysql_query("SELECT  `test_id`, `subject_id`, `test_name`, `no_of_question`,`weightage`,`negative_marking`,`from_date`, `to_date`, `duration`, `start_time`, `end_time`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`, `deleted_at`,`es_classesid`,`es_classname`,`es_subjectid`,`es_subjectname` FROM `es_mcq_test` INNER JOIN `es_classes` as e ON  `es_classesid`=`class_id` INNER JOIN `es_subject` as es ON  `es_subjectid`=`subject_id` WHERE deleted_at IS NULL ORDER BY updated_at DESC");

                                    while($row = mysql_fetch_assoc($test))
                                    { ?>
                                    <tr>
                                        <td><a href="?pid=143&action=question&test=<?php echo $row['test_id'];?>" target="_blank" data-toggle="tooltip" data-original-title="Question List"><?php echo $row['test_name'];?></a></td>
                                        <td><?php echo $row['es_classname'];?></td>
                                        <td><?php echo $row['es_subjectname'];?></td>
                                        <td><?php echo $row['no_of_question'];?></td>
                                        <td>
                                            <?php 
                                                $question = mysql_fetch_assoc(mysql_query("SELECT count(question_id) AS fill_question from es_mcq_questions where testid='".$row['test_id']."'"));
                                                echo $question['fill_question'];
                                            ?>
                                        </td>
                                        <td><?php echo date("d, M Y",strtotime($row['from_date']));
                                        ?></td>
                                        <td><?php echo date("d, M Y",strtotime($row['to_date']));?></td>
                                        <!-- <td><?php //echo $row['start_time'];?></td>
                                        <td><?php //echo $row['end_time'];?></td> -->
                                        <td><?php echo $row['duration'];?></td>
                                        <td><?php echo $row['weightage'];?></td>
                                        <td><?php echo $row['negative_marking'].' %';?></td>
                                        <td><?php echo date("d, M Y",strtotime($row['created_at']));?></td>
                                        <td>

                                        <!-- success -->
                                        <label class="switch switch-success switch-round" >
                                            <input type="checkbox"  class="status" value="<?php echo $row['status'];?>" id="<?php echo $row['test_id'];?>" <?php if($row['status']==1){ echo "checked";}?> >
                                            <span class="switch-label" data-on="" data-off=""></span>
                                        </label>

                                        </td>
                                        <td>
                                            <a href="javascritpt:void(0)" id="<?php echo $row['test_id']; ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-original-title="Edit Test" > &nbsp;<i class="fa fa-edit" ></i> </a>

                                            <a href="?pid=143&action=delete_test&test_id=<?php echo $row['test_id']; ?>" class="btn btn-danger btn-xs" data-toggle="tooltip" data-original-title="Delete Test" onclick="return confirm('Are you sure ?');"> &nbsp;<i class="fa fa-trash-o"></i> </a>
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
            </section>
        </div>

        <div id="add-test" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="AddItemLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#4b5354;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"  style="color:white;">ADD TEST</h4>
                    </div>

                    <form action ="?pid=143&action=testlist" method = "post" id="test-form"/>
                        <div class="modal-body"> 
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <span class="pull-right">
                                    <font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif" size="2">Note :  * denotes mandatory&nbsp;</font>
                                </span>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                <label><b>Class</b><span  class="error-lbl">*</span></label>
                                <select name="classid" class="form-control"   id="classid">
                                  <option value=''>Please Select Class</option>
                                <?php 
                                $class = mysql_query("SELECT es_classesid,es_classname FROM es_classes ORDER BY es_classesid DESC");                             
                                while($classRow = mysql_fetch_assoc($class)){?>
                                  <option value="<?php echo $classRow['es_classesid']; ?>">
                                  <?php echo $classRow['es_classname']; ?></option>
                                <?php } ?>
                                </select>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                <label><b>Suject</b><span  class="error-lbl">*</span></label>
                                <select name="subjectid[]" id="subject-id" class="form-control select2-multiple select2-hidden-accessible" multiple aria-hidden="true">
                                    <option value=''>Please Select Subject</option>
                                </select>
                                <span id="subject-error"></span>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                <label><b>Test Name</b><span  class="error-lbl">*</span></label>
                                <input type="text" name="test_name"  id="test_name" class="form-control" />
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                <label><b>No Of Question</b><span  class="error-lbl">*</span></label>
                                <input type="number" name="no_of_question" id="no_of_question" class="form-control" min="0" max="100"/>
                            </div> 
                            
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                <label><b>Weightage (Marks/Quesion)</b><span  class="error-lbl">*</span></label>
                                <input type="number" name="weightage" id="weightage" class="form-control" min="0" max="100"/>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                <label><b>Negative Marking (In Percentage)</b><span  class="error-lbl">*</span></label>
                                <input type="number" name="negative_marking" id="negative_marking" class="form-control" value="0" min="0" max="100"/>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                <label><b>Duration (In Minutes)</b><span  class="error-lbl">*</span></label>
                                <input type="number" name="duration" id="duration" class="form-control" min="0"/>
                            </div> 

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                <label><b>Start Date</b><span  class="error-lbl">*</span></label>
                                <input name="from_date" class="form-control masked" id="from_date" placeholder="YYYY-MM-DD" required="required" autocomplete="off">
                                <span class="text-danger"><br></span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                <label><b>End Date</b><span  class="error-lbl">*</span></label>
                                <input name="to_date" class="form-control  masked" id="to_date" placeholder="YYYY-MM-DD" required="required" autocomplete="off">
                                <span class="text-danger"><br></span>
                            </div> 
                             <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                <label><b>Start Time</b><span  class="error-lbl">*</span></label>
                                <input name="start_time" class="form-control" id="start_time" placeholder="HH:MM" required="required" autocomplete="off">
                                <span class="text-danger"><br></span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                <label><b>End Time</b><span  class="error-lbl">*</span></label>
                                <input name="end_time" class="form-control" id="end_time" placeholder="HH:MM" required="required" autocomplete="off">
                                <span class="text-danger"><br></span>
                            </div>                        
                        </div>

                        <div class="modal-footer">
                            <input name="test_id" id="test_id" type="hidden" />
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                    <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
                                    <button name="AddTest" type="submit"  class="btn btn-primary" value="Submit">SUBMIT</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
        <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/third_party/DataTables/datatables.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery.validate.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/plugins/moment.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/plugins/bootstrap.datepicker/js/bootstrap-datepicker.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/plugins/bootstrap.datepicker/js/bootstrap-timepicker.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/plugins/select2/js/select2.full.js'); ?>"></script>
        <script type="text/javascript"> 
            $('.data-table').DataTable();
            
            $('#subject-id').select2({
                theme: "bootstrap"
            });

            //Find no of subject using ajax
            $(document).ready(function(){
                
                $('#from_date').datepicker({
                    format: 'yyyy-mm-dd',
                    startDate: new Date(),
                    todayHighlight:'TRUE',
                    autoclose: true,
                }).on('changeDate', function (selected) {
                    var startDate = new Date(selected.date.valueOf());
                    $('#to_date').datepicker('setStartDate', startDate);
                }).on('clearDate', function (selected) {
                    $('#to_date').datepicker('setStartDate', null);
                });

                $('#to_date').datepicker({
                    format: 'yyyy-mm-dd',
                    startDate: new Date(),
                    todayHighlight:'TRUE',
                    autoclose: true,
                }).on('changeDate', function (selected) {
                   var endDate = new Date(selected.date.valueOf());
                   $('#from_date').datepicker('setEndDate', endDate);
                }).on('clearDate', function (selected) {
                   $('#from_date').datepicker('setEndDate', null);
                });

                $('#start_time').datetimepicker({
                    format:"LT"
                });
                $('#end_time').datetimepicker({
                   format:"LT" 
                });

                $('#subject-error').hide();
                $('#classid').on('change',function(){
                    $.ajax({
                            url: "?pid=143&action=testlist&classid="+$(this).val(),
                            dataType: "json",
                            type : "GET",
                            success : function(data) {
                                $('#subject-id').html('');
                                $('#subject-id').append('<options value="">Please Select Subject</option>');
                                var option='',i=0;
                                if(data.length>0)    
                                {
                                    $('#subject-error').hide();
                                    for(i=0;i<data.length;i++)
                                    {
                                        $('#subject-id').append('<option value="'+data[i].es_subjectid+'">'+data[i].es_subjectname+'</option>');
                                    }
                                }
                                else
                                {
                                    $('#subject-error').show();
                                    $('#subject-error').css('color','red');
                                    $('#subject-error').text("Subject not exist to this class please add subject");
                                }

                            },
                            error: function(jqXHR, textStatus, errorThrown ) {
                                console.log(errorThrown);
                            }
                    });
                });

                $('.status').on('change',function(){
                    $.ajax({
                            url: "?pid=143&action=change_status&test_id="+$(this).attr('id')+"&status="+$(this).val(),
                            dataType: "json",
                            type : "GET",
                            success : function(data) {
                                
                            }
                    });
                    
                    
                    
                    if($(this).val()=='0')
                    {                   
                        $(this).prop('checked',true);  
                        $(this).val('1');
                    }
                    else
                    {   
                        $(this).prop('checked',false);
                        $(this).val('0');   
                    }

                });

                $("#test-form").validate({
                    rules: {
                        classid: "required",
                        test_name:"required",
                        subjectid:"required",
                        duration: "required",
                        no_of_question:"required",
                        negative_marking:
                        {
                            "required":true,
                            "number":true,
                        },
                        weightage:
                        {
                            "required":true,
                            "number":true,
                        },
                        from_date: "required",
                        to_date: "required",
                        start_time: "required",
                        end_time: "required"
                    },
                    messages:{
                        classid:{
                            required:"Please Select Class"
                        },
                        subjectid:{
                            required:"Please Select Class"
                        },
                        test_name:{
                            required:"Please Enter Test Name"
                        },
                        duration:{
                            required:"Please Enter Duration"
                        },
                        no_of_question:{
                            required:"Please Enter No Of Question",
                            number:"Please Enter Number Only"
                        },
                        Weightage:{
                            required:"Please Enter Weightage",
                            number:"Please Enter Number Only"
                        },
                        negative_marking:
                        {
                            required:"Please Enter Negative Marking Percentage",
                        },
                        from_date:{
                            required:"Please Select Start Date"
                        },
                        to_date:{
                            required:"Please Select End Date"
                        },
                        start_time:{
                            required:"Please Select Start Time"
                        },
                        end_time:{
                            required:"Please Select End Time"
                        }
                    },
                    submitHandler: function(form) {
                        form.submit();
                    }
                });

                 $('.btn-warning').on('click',function(){
                    
                    $.ajax({
                            url: "?pid=143&action=edit_test&test_id="+$(this).attr('id'),
                            dataType: "json",
                            type : "GET",
                            success : function(data) 
                            {
                                $('#subject-id').html('');
                                var option='',i=0;
                                if(data.length!=0)
                                {
                                    
                                    $('#subject-id').html('<options value="">Please Select Subject</option>');
                                    for(i=0;i<data.subjectid.length;i++)
                                    {
                                        if(data.es_subjectid==data.subjectid[i].es_subjectid)
                                        {
                                            $('#subject-id').append('<option value="'+data.subjectid[i].es_subjectid+'" selected="true">'+data.subjectid[i].es_subjectname+'</option>');    
                                        }
                                        else
                                        {
                                            $('#subject-id').append('<option value="'+data.subjectid[i].es_subjectid+'">'+data.subjectid[i].es_subjectname+'</option>');
                                        }
                                    }
                                    $('#test_name').val(data.test_name);
                                    $('#classid').val(data.es_classesid);
                                    $('#subject-id').val(data.es_subjectid);
                                    $('#no_of_question').val(data.no_of_question);
                                    $('#negative_marking').val(data.negative_marking);
                                    $('#weightage').val(data.weightage);
                                    $('#duration').val(data.duration);
                                    $('#from_date').val(data.from_date);
                                    $('#to_date').val(data.to_date);
                                    $('#start_time').val(data.start_time); 
                                    $('#end_time').val(data.end_time);
                                    $('#test_id').val(data.test_id);
                                    $('#add-test').modal('show');

                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown ) {
                                console.log(errorThrown);
                            }
                    });
                });
            });
        </script>
</body>
</html>