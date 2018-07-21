<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html;charset=utf-8"/>
        <title>MCQ Question</title>
        <meta name="description" content="" />
        <meta name="Author" content="" />

        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

        <!-- WEB FONTS -->
        <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />
        <!-- CORE CSS -->
        <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        
        <link href="<?php echo base_url('assets/plugins/bootstrap.datepicker/css/bootstrap-datetimepicker.css');  ?>" type="text/css" rel="stylesheet"/>

        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css'); ?>">
    
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
                            <?php if($res_year['fi_ac_startdate']!=""){ echo displaydate($res_year['fi_ac_startdate']);?> to <?php echo displaydate($res_year['fi_ac_enddate']); } else { echo "---"; }

                                $question = mysql_fetch_assoc(mysql_query("SELECT count(question_id) AS fill_question from es_mcq_questions where testid='".$_GET['test']."'"));
                            ?>
                        </li>
                    </ol>
                </header>

                <div id="content" class="dashboard">
                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                           <span class="title elipsis"><strong>MCQ Questions</strong></span>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                                    <div class="alert  alert-dismissible" style="display: none">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                          
                                    </div>
                               </div>

                                <form  id="question-form" >
                                    <input type="hidden" name="test"  id="test" value="<?php echo $_GET['test']; ?>" />
                                    <!--<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                    <label><b>Test</b><span  class="error-lbl">*</span></label>
                                        <select name="test" class="form-control"   id="test">
                                            <option value=''>Please Select Test</option>
                                        <?php 
                                        /*$test = mysql_query("SELECT `test_id`,`test_name`,`no_of_question` FROM es_mcq_test WHERE `no_of_question`>=(SELECT COUNT('id') as question_count FROM `es_mcq_questions`) ORDER BY test_name ASC");                             
                                        while($testRow = mysql_fetch_assoc($test)){*/
                                            ?>
                                          <option value="<?php //echo $testRow['test_id']; ?>">
                                          <?php //echo $testRow['test_name']; ?></option>
                                        <?php //} ?>
                                        </select>
                                    </div>-->
                                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                        <label><b>Question</b><span  class="error-lbl">*</span></label>
                                        <textarea class="ckeditor" id="question" name="question" rows="5"></textarea>
                                        <!-- <input type="text" name="question"  id="question" class="form-control" /> -->
                                    </div>
                                    
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                        <label><b>Options 1</b><span  class="error-lbl">*</span></label>
                                        <input type="text" name="option1"  id="option1" class="form-control" />
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                        <label><b>Options 2</b><span  class="error-lbl">*</span></label>
                                        <input type="text" name="option2"  id="option2" class="form-control" />
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                        <label><b>Options 3</b><span  class="error-lbl">*</span></label>
                                        <input type="text" name="option3"  id="option3" class="form-control" />
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                        <label><b>Options 4</b><span  class="error-lbl">*</span></label>
                                        <input type="text" name="option4"  id="option4" class="form-control" />
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
                                        <label><b>Answer</b><span  class="error-lbl">*</span></label>
                                        <input type="number" name="answer"  id="answer" class="form-control" min="1" max="4" autocomplete="off" />
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
                                        <label><b>Suject</b><span  class="error-lbl">*</span></label>
                                            <select name="subjectid" id="subject-id" class="form-control">
                                                
                                            </select>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group" >
                                        <label><b>Image</b></label>
                                        <div class="fancy-file-upload fancy-file-default">
                                            <i class="fa fa-upload"></i>
                                            
                                            <input type="file" class="form-control" id="question_image"  name="question_image" accept="image/*" onchange="$(this).next('input').val(this.value);">
                                            
                                            <input type="text" class="form-control" placeholder="no file selected" readonly="" id="image-name" name="image-name">
                                            <span class="button">Choose File</span>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 form-group pull-right">
                                        <input type="hidden" name="question_id"  id="question_id" />

                                        <button type="reset" class="btn btn-primary pull-right" >
                                            <i class="fa fa-undo"></i> Reset
                                        </button>
                                        <div class="add-que">
                                            <button type="submit" class="btn btn-primary pull-right" value="add-question" id="sub-add-btn">
                                                <i class="fa fa-plus"></i> Add Question
                                            </button>
                                        </div>
                                        <div class="update-que" style="display:none">
                                            <button type="submit" class="btn btn-primary pull-right" value="update-question" id="sub-updt-btn">
                                                <i class="fa fa-edit"></i> Update Question
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 text-center">
                                        <h4>Question Added:<span id="que-count"></span></h4>
                                    </div>
                                </form>
                            </div>
                           
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  table-responsive">
                                <table class="table table-bordered data-table">
                                    <thead>
                                        <tr>
                                            <!-- <th>Test Name</th> -->
                                            <th>Question</th>
                                            <th>Option 1</th>
                                            <th>Option 2</th>
                                            <th>Option 3</th>
                                            <th>Option 4</th>
                                            <th>Answer</th>
                                            <th>Status</th>
                                            <th width="75px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
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
        <script type="text/javascript" src="<?php echo base_url('assets/third_party/DataTables/datatables.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery.validate.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/plugins/moment.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/plugins/bootstrap.datepicker/js/bootstrap-datepicker.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/plugins/bootstrap.datepicker/js/bootstrap-timepicker.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/plugins/ckeditor/ckeditor.js'); ?>"></script>

<script type="text/javascript"> 
    //Find no of subject using ajax
    
    $(document).ready(function(){
        function loadQuestion()
        {
            $.ajax({
                'url':"?pid=143&action=questionList&test=<?php echo $_GET['test']?>",
                'method': 'GET',
                'contentType':'application/json',
                'async':'true',
                'success':function(response) 
                {
                    var subject = JSON.parse(response).subject
                    $('#subject-id').html('');
                    for(i=0;i<subject.length;i++)
                    {
                        $('#subject-id').append('<option value="'+subject[i].es_subjectid+'">'+subject[i].es_subjectname+'</option>');
                    }

                    table = $('.data-table').DataTable({
                        "data": JSON.parse(response).question,
                        "columns":[
                            /*{'data':'test_name'},*/
                            {'data':'question'},
                            {'data':'option1'},
                            {'data':'option2'},
                            {'data':'option3'},
                            {'data':'option4'},
                            {'data':'answer'},
                            {'data':'que_status'},
                            {'data':'action'}
                        ]
                    });
                    $('#que-count').css('color','#000');
                    $('#que-count').text(' '+table.rows().count());
                    table.destroy();
                }
            });                        
        }
        
        loadQuestion();
        
        CKEDITOR.replace('question',{
            fullPage: true,
            allowedContent: true,
            extraPlugins: 'wysiwygarea',
        });                
        
        $('.btn-primary').on('click',function(){
            $('#sub-updt-btn').attr('disabled',false);
            $('#sub-add-btn').attr('disabled',false);
        });

        $("#question-form").validate({
            rules: {
                //test:"required",
                question:"required",
                option1:"required",
                option2:"required",
                option3:"required",
                option4:"required",
                answer: "required"
                
            },
            messages:{
               /* test:{
                    required:"Please Select Test"
                },*/
                question:{
                    required:"Please Enter Question"
                },
                option1:{
                    required:"Please Enter Option 1"
                },
                option2:{
                    required:"Please Enter Option 2"
                },
                option3:{
                    required:"Please Enter Option 3"
                },
                option4:{
                    required:"Please Enter Option 4"
                },
                answer:{
                    required:"Please Enter Answer"
                }
            },
            submitHandler: function(form) {
                return false;
            }
        });

        $(document).on('change','.status',function(){
            
            $.ajax({
                url:"?pid=143&action=change_status&question_id="+$(this).attr('id')+"&status="+$(this).val(),
                dataType:"json",
                type:"GET",
                success:function(data) 
                {
                    //loadQuestion();           
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

        $(document).on('click','.btn-warning',function()
        {
            $.ajax({
                url:"?pid=143&action=edit_question&question_id="+$(this).attr('id'),
                dataType:"json",
                type:"GET",
                async:true,
                success:function(data) 
                {
                    $('#subject-id').html('');
                    var option='',i=0;

                    $('#test').val(data.testid);
                    //$('#question').val(data.question);
                    CKEDITOR.instances['question'].setData(data.question);
                    $('#option1').val(data.option1);
                    $('#option2').val(data.option2);
                    $('#option3').val(data.option3);
                    $('#option4').val(data.option4);
                    //$('#subject-id').val(data.subject_id);
                    
                    $('#answer').val(data.answer);
                    $('#question_id').val(data.question_id);
                    $('#image-name').val(data.question_image);
                    $('.add-que').hide();
                    $('.update-que').show();
                },
                error: function(jqXHR, textStatus, errorThrown ) {
                    console.log(errorThrown);
                }
            });
        });

        $(document).on('click','.btn-danger',function()
        {
            $.ajax({
                url : "?pid=143&action=delete_question&question_id="+$(this).attr('id'),
                type : "GET",
                success : function(data) 
                {
                    if(data=='success')
                    {
                        loadQuestion();
                        $('.alert').removeClass('alert-danger');
                        $('.alert').addClass('alert-success');
                        $('.alert').text('');
                        $('.alert').text('Question Deleted Successfully');
                        $('.alert').show();
                        setTimeout(function () {
                            $('.alert').fadeOut("slow");
                        },5000);   
                    }
                    else
                    {
                        $('.alert').removeClass('alert-success');
                        $('.alert').addClass('alert-danger');
                        $('.alert').text('');
                        $('.alert').text('Failed To Delete Question');
                        $('.alert').show();
                        setTimeout(function () {
                            $('.alert').fadeOut("slow");
                        },5000);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown ) {
                    console.log(errorThrown);
                }
            });
        });
        
        $("#question_image").on('change',function(event)
        {
            var type = ['image/png','image/jpeg','image/gif','image/jpg'];
            if($.inArray($('#question_image')[0].files[0].type,type)=== -1)
            {
                $('#sub-updt-btn').attr('disabled',true);
                $('#sub-add-btn').attr('disabled',true);
                $('.alert').removeClass('alert-success');
                $('.alert').addClass('alert-danger');
                $('.alert').text('');
                $('.alert').text('Invalid File');
                $('.alert').show();
                setTimeout(function () {
                    $('.alert').fadeOut("slow");
                },5000);
            }
            else if($('#question_image')[0].files[0].size > 1048576)
            {
                $('#sub-updt-btn').attr('disabled',true);
                $('#sub-add-btn').attr('disabled',true);
                $('.alert').removeClass('alert-success');
                $('.alert').addClass('alert-danger');
                $('.alert').text('');
                $('.alert').text('Upload Image Less Than OR Equal To 1MB');
                $('.alert').show();
                setTimeout(function () {
                    $('.alert').fadeOut("slow");
                },5000);
            }
            else
            {
                $('#sub-updt-btn').attr('disabled',false);
                $('#sub-add-btn').attr('disabled',false);
            }
        });

        $("#question-form").submit(function(event)
        {
            event.preventDefault();    

            var formData = new FormData();
            formData.append('question',CKEDITOR.instances.question.getData())
            formData.append('test',$('#test').val());
            formData.append('subject_id',$('#subject-id').val());
            formData.append('option1',$('#option1').val());
            formData.append('option2',$('#option2').val());
            formData.append('option3',$('#option3').val());
            formData.append('option4',$('#option4').val());
            formData.append('answer',$('#answer').val());
            formData.append('image-name',$('#image-name').val());
            formData.append('question_image',$('#question_image')[0].files[0]);
            formData.append('question_id',$('#question_id').val());
            
            var url='';
            if($('#question_id').val()!='')
            {
                url = '?pid=143&action=add-question'+'&question_id='+$('#question_id').val();
            }
            else
            {
                url = '?pid=143&action=add-question';
            }
        
            $.ajax({
                url:url,
                type:'POST',
                data:formData,
                contentType: false,
                success: function (data) 
                {
                    if(data=='limit_exceed')
                    {
                        $('.alert').removeClass('alert-success');
                        $('.alert').addClass('alert-danger');
                        $('.alert').text('');
                        $('.alert').text('Question Limit Exceed');
                        $('.alert').show();
                        setTimeout(function () {
                            $('.alert').fadeOut("slow");
                        },5000);
                    }
                    else if(data=='fail_upload')
                    {
                        $('.alert').removeClass('alert-success');
                        $('.alert').addClass('alert-danger');
                        $('.alert').text('');
                        $('.alert').text('Failed To Upload File');
                        $('.alert').show();
                        setTimeout(function () {
                            $('.alert').fadeOut("slow");
                        },5000);
                    }
                    else if(data=='success')
                    {
                        loadQuestion();
                        $('.alert').removeClass('alert-danger');
                        $('.alert').addClass('alert-success');
                        $('.alert').text('');
                        if($('#question_id').val()!='')
                        {
                            $('.alert').text('Question Updated Successfully');  
                            $('.update-que').hide();
                            $('.add-que').show(); 
                        }
                        else
                        {
                            $('.alert').text('Question Added Successfully');
                        }
                        $('.alert').show();
                        setTimeout(function () {
                            $('.alert').fadeOut("slow");
                        },5000);   
                        $("#question-form")[0].reset();
                        CKEDITOR.instances['question'].setData('');
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });                    
        });
    });
</script>
</body>
</html>