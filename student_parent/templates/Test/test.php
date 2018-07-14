<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>MCQ Test</title>
        <meta name="description" content="" />
        <meta name="Author" content="" />

        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

        <!-- WEB FONTS -->
        <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />

        <!-- CORE CSS -->
        <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/selectpicker/select.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css'); ?>">
    
        <!-- THEME CSS -->
        <link href="<?php echo base_url('assets/css/essentials.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/layout.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/color_scheme/green.css'); ?>" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <?php

            include(TEMPLATES_PATH . DS . 'leftmenu.tpl.php');
            include(TEMPLATES_PATH . DS . 'header_new.tpl.php');

             $sel_year = "SELECT *FROM `es_finance_master`  ORDER BY `es_finance_masterid` DESC LIMIT 0 , 1";
                $res_year = getarrayassoc($sel_year);

            //Find class from database
            $class = mysql_fetch_assoc(mysql_query("SELECT `es_preadmission_detailsid`,  `pre_class` FROM `es_preadmission_details` WHERE `es_preadmissionid`='".$_SESSION['eschools']['user_id']."'"));

            //Find test from based on class
            /*echo "SELECT  `test_id`, `subject_id`, `test_name`, `no_of_question`, `from_date`, `to_date`, `duration`, `start_time`, `end_time`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`, `deleted_at`,`es_classesid`,`es_classname`,`es_subjectid`,`es_subjectname` FROM `es_mcq_test` INNER JOIN `es_classes` as e ON  `es_classesid`=`class_id` INNER JOIN `es_subject` as es ON  `es_subjectid`=`subject_id` WHERE deleted_at IS NULL AND `es_classesid`='".$class['pre_class']."' AND  `from_date`>='".date('Y-m-d')."' AND  '".date('Y-m-d')."' <=`to_date`  AND  `start_time`>='".date('H:i')."' AND '".date('H:i')."' <=`end_time` and status='1' ORDER BY updated_at DESC";die;*/

            $test = [];
            $testSource = mysql_query("SELECT  `test_id`, `subject_id`, `test_name`, `no_of_question`, `from_date`, `to_date`, `duration`, `start_time`, `end_time`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`, `deleted_at`,`es_classesid`,`es_classname`,`es_subjectid`,`es_subjectname` FROM `es_mcq_test` INNER JOIN `es_classes` as e ON  `es_classesid`=`class_id` INNER JOIN `es_subject` as es ON  `es_subjectid`=`subject_id` WHERE deleted_at IS NULL AND `es_classesid`='".$class['pre_class']."' AND  `from_date`>='".date('Y-m-d')."' AND  '".date('Y-m-d')."' <=`to_date`  AND  status='1' ORDER BY updated_at DESC");
            
            if(mysql_num_rows($testSource))
            {
                while ($row = mysql_fetch_assoc($testSource)) 
                {
                    $test[] = $row;
                }
            }
        ?>
        <section id="middle">
            <header id="page-header">
                <ol class="breadcrumb">
                    <li>
                        <b> Academic Year : </b>
                        <?php if($res_year['fi_ac_startdate']!=""){ echo displaydate($res_year['fi_ac_startdate']);?> to <?php echo displaydate($res_year['fi_ac_enddate']); } else { echo "---"; }
                        ?>
                    </li>
                </ol>
            </header>

            <div id="content" class="dashboard" style="padding-top: 5px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <span class="elipsis title"><strong>Test</strong></span>
                        </div>
                        <div class="panel-body">
                            <div id="test-boxes">
                        <?php 
                            $count = 0;
                            if(!empty($test))
                            {
                                foreach ($test as $tkey => $tvalue) 
                                { 
                                    ++$count;
                                    ?>
                                    <div class="col-md-3 col-sm-6" id="test_<?php echo $tvalue['test_id']; ?>">
                                        <div class="box success">
                                            <div class="box-title text-center">
                                                    <h5><?php echo $tvalue['test_name']; ?></h5>
                                                        <small class="block"></small>
                                                        <i class="fa fa-list"></i>
                                                </div>
                                                <div class="box-body text-center">
                                                    No Of Question : <?php echo $tvalue['no_of_question']; ?><br/> 
                                                    Duration: <span id="duration_<?php echo $tvalue['test_id']; ?>"><?php echo $tvalue['duration']; ?></span>
                                                    <br/>
                                                    <button type="button"  class="btn btn-warning fill-test" id="<?php echo $tvalue['test_id']; ?>">Start Test</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="test_id"  id="test_unique_<?php echo $tvalue['test_id']; ?>" value="<?php echo $tvalue['test_id']; ?>" />
                                    
                                <?php 
                                } 
                            }
                            
                            ?>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-xs-6 pull-right add-que" style="display:none">
                                   
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-6 timer" style="display:none">
                                    Remaining Time : <span id="test-timer" class="count-timer"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 col-sm-8 col-xs-8">
                                    <form action="?pid=62&action=test" method="post" id="ans-form" style="display: none">
                                        <div class="col-md-6 col-sm-12 col-xs-12">  
                                            
                                            <input type="hidden" name="no_of_question"  
                                            id="no_of_question" />
                                            <input type="hidden" name="question_id" id="question_id" />
                                            <input type="hidden" name="curr-que" id="curr-que"  />
                                                <span id="question">
                                                
                                                </span>
                                        </div>
                                        
                                        <div class="col-md-12 col-sm-12 col-xs-12 form-choice">  
                                            <!-- <input type="radio" name="option[]" id="option1" class="form-choice" value="1"/>
                                            <span id="ans-op1"></span> -->
                                            <label class="radio">
                                                <input type="radio" name="option[]" id="option1" value="1" />
                                                <i></i><span id="ans-op1"></span>
                                            </label>
                                        </div>
                                        
                                        <div class="col-md-12 col-sm-12 col-xs-12 form-choice">  
                                            <label class="radio">
                                                <input type="radio" name="option[]" id="option2"  value="2"/><i></i>
                                                <span id="ans-op2"></span>
                                            </label>
                                        </div>
                                        
                                        <div class="col-md-12 col-sm-12 col-xs-12 form-choice">  
                                            <label class="radio">
                                                <input type="radio" name="option[]" id="option3"  value="3"/>
                                                <i></i><span id="ans-op3"></span>
                                            </label>  
                                        </div>

                                        <div class="col-md-12 col-sm-12 col-xs-12 form-choice">  
                                            <label class="radio">
                                                <input type="radio" name="option[]" id="option4" 
                                                value="4"/>
                                                <i></i><span id="ans-op4"></span>
                                            </label>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">  
                                            <span class="select-error"></span>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">  
                                            <button type="button" class="btn btn-primary form-choice " id="prev">
                                                <i class="fa fa-chevron-circle-left"></i>Prev
                                            </button>
                                            <button type="button" class="btn btn-primary form-choice" id="next">
                                                Next&nbsp;&nbsp;<i class="fa fa-chevron-circle-right"></i> 
                                            </button>
                                            <button type="button" class="btn btn-primary form-choice" id="save_next">
                                                Save & Next&nbsp;&nbsp;<i class="fa fa-pencil-square-o"></i> 
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4" id="que-list">
                                    
                                </div>
                            </div>
                        </div>
                    </div> <!-- col-LG-12 -->
                </div>
        </div>
    </section>
      <!-- JAVASCRIPT FILES -->
    <script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/selectpicker/select.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery-countdown/jquery.countdowntimer.min.js'); ?>"></script>
    


    <script type="text/javascript">
        /*Call function after every five minute
        var timeout,html='',flag=1;
        function findTest()
        {    
            timeout = setInterval(findTest,(1000*60));
            $.ajax({
                url: "?pid=62&action=findtest",
                dataType: "json",
                type : "GET",
                success : function(data) 
                {
                    if(!$.isEmptyObject(data))
                    {
                        for(var i=0;i<data.length;i++) 
                        {
                            html+='<div class=\"col-md-3 col-sm-6\" id="test_'+data[i].test_id+'\"><div class=\"box success\"><div class=\"box-title text-center\"><h5>'+data[i].test_name+'</h5><small class=\"block\"></small><i class=\"fa fa-list\"></i></div><div class=\"box-body text-center\">No Of Question : '+data[i].no_of_question+'<br/> Duration: '+data[i].duration+'<br/><button type=\"button\"  class=\"btn btn-link fill-test\">Start Test</button></div></div></div>';    
                            //$('#test-boxes').load('#test_'+data[i].test_id);
                        }
                        
                        $('#test-boxes').append(html);
                    
                        $('.add-que').show();
                        $('#test_id').val(data.test_id);
                        $('#duration').val(data.duration);
                        
                        clearInterval(timeout);
                    }     
                },
                error: function(jqXHR, textStatus, errorThrown ) 
                {
                    console.log(errorThrown);
                }
            }); 
        }*/

        $(document).ready(function(){
            //findTest();
            $('.fill-test').on('click',function(event){
                
                var id = $(this).attr('id');
                var duration = $('#duration_'+id).text();
                
                $('#test_'+$(this).attr('id')).remove();
                    $.ajax({
                        url:"?pid=62&action=question&test="+$('#test_unique_'+id).val(),
                        dataType:"json",
                        type:"GET",
                        success:function(response) 
                        {
                            data = response;
                            var question='';
                            var seq = 1;
                            //console.log(response[0]); return false;
                            $('.test-boxes').hide();
                            
                            if(!$.isEmptyObject(response))
                            {
                                $('.timer').show();
                                
                                if(duration>=60)
                                {
                                    $('#test-timer').countdowntimer({
                                        hours:duration/60,
                                        seconds:00,
                                        size:"lg"
                                    });
                                }
                                else
                                {
                                    
                                    $('#test-timer').countdowntimer({
                                        minutes:duration,
                                        seconds:00,
                                        size:"lg"
                                    });
                                }
                                $('#ans-form').show();
                                $('#question_id').val(response[0].question_id);
                                $('#question').text('1. '+response[0].question);
                                $('#curr-que').val('1');
                            
                                $('#ans-op1').text('a. '+response[0].option1);
                                $('#ans-op2').text('b. '+response[0].option2);
                                $('#ans-op3').text('c. '+response[0].option3);
                                $('#ans-op4').text('d. '+response[0].option4);

                                $('#prev').val(response[0].testid);
                                $('#prev').attr('disabled',true);
                                $('#next').val(response[0].testid);
                                $('#save_next').val(response[0].testid);
                                $('#no_of_question').val(data.length);
                                for(i=0;i<data.length;i++) 
                                {
                                    if((i+1)==1)
                                    {
                                        question+='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">'+(i+1)+' : <a class="text-success load-que" id="que_'+(i+1)+'" data-params="'+data[i].question_id+'">'+data[i].question+'</a></div>';   
                                    }
                                    else
                                    {
                                        question+='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">'+(i+1)+' : <a id="que_'+(i+1)+'" class="load-que" data-params="'+data[i].question_id+'" >'+data[i].question+'</a></div>';
                                    }
                                }
                                
                                $('#que-list').html(question);
                                $('#que-list').hide().fadeIn(500);
                            }   
                        },
                        error: function(jqXHR, textStatus, errorThrown ) {
                            console.log(errorThrown);
                        }
                    });
                });
            
            $('input[type=radio]').on('click',function(){
                $('.select-error').hide();
            });
           
            $('#save_next').on('click',function(){
                if($('input[type=radio]:checked').attr('id')==undefined)
                {
                    $('.select-error').addClass('text-danger');
                    $('.select-error').text('Please Select Answer');
                    $('.select-error').show();
                }
                else
                {
                    $.ajax({
                        url:"?pid=62&action=question&test="+$(this).val()+"&seq=next&question_id="+$('#question_id').val()+"&ans="+$('input[type=radio]:checked').val()+"&offset="+$('#curr-que').val(),
                        dataType:"json",
                        type:"GET",
                        success:function(response) 
                        {
                            $('#prev').attr('disabled',false);
                            if(response.next_question==0)
                            {
                                $('#next').attr('readonly',true);
                                $('#save_next').attr('readonly',true);
                            }
                            else
                            {

                                if(!$.isEmptyObject(response))
                                {
                                    $('input[type=radio]').attr('checked', false); 
                                    $('#curr-que').val(response.next_question);
                                    $('#question_id').val(response.data.question_id);
                                    $('#question').text(response.next_question+' : '+response.data.question);
                                    $("#que_"+(response.next_question-1)).removeClass('text-success');
                                    $("#que_"+(response.next_question-1)).addClass('text-muted');
                                    //$("#que_"+response.next_question).removeAttr("href");

                                    $("#que_"+(response.next_question)).addClass('text-success');
                                    
                                    $('#ans-op1').text('a. '+response.data.option1);
                                    $('#ans-op2').text('b. '+response.data.option2);
                                    $('#ans-op3').text('c. '+response.data.option3);
                                    $('#ans-op4').text('d. '+response.data.option4);
                                }
                            }                   
                        },
                        error: function(jqXHR, textStatus, errorThrown ) 
                        {
                            console.log(errorThrown);
                        }
                    });
                }
            });

             $('#prev').on('click',function(){
                
                $('.select-error').hide();
                $('#next').attr('disabled',false);
                $('#save_next').attr('disabled',false);
                var offset = Number($('#curr-que').val())-1;
                
                $.ajax({
                    url:"?pid=62&action=question&test="+$(this).val()+"&seq=prev&question_id="+$('#que_'+(offset+1)).data().params+"&offset="+offset,
                    dataType:"json",
                    type:"GET",
                    success:function(response) 
                    {
                        if(!$.isEmptyObject(response))
                        {
                            if(Number(response.next_question)==0)
                            {
                                $('#prev').attr('disabled',true);
                            }

                            $('input[type=radio]').attr('checked', false); 
                            
                            $('#curr-que').val(response.next_question+1);

                            //$("#que_"+$('#curr-que').val()).removeClass('text-muted');

                            $("#que_"+Number($('#curr-que').val())).addClass('text-success');
                            
                            $("#que_"+(Number($('#curr-que').val())+1)).removeClass('text-success');

                            
                            $('#question_id').val(response.data.question_id);
                            
                            $('#question').text((response.next_question+1)+' : '+response.data.question);
                            
                            $('#ans-op1').text('a. '+response.data.option1);
                            $('#ans-op2').text('b. '+response.data.option2);
                            $('#ans-op3').text('c. '+response.data.option3);
                            $('#ans-op4').text('d. '+response.data.option4);

                            if(response.data.answer.answer!=0)  
                            {
                                for (var i=1; i<=4; i++) 
                                {
                                    if(i==response.data.answer.answer)
                                    {
                                        $('#option'+i).prop('checked',true);
                                    }
                                }                                 
                            }
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown ) 
                    {
                        console.log(errorThrown);
                    }
                });
                /*if($('#curr-que').val()==1)
                {
                    $('#prev').attr('readonly',true);
                }*/
                
            });

            $('#next').on('click',function(){
                $('#prev').attr('disabled',false);
                $('.select-error').hide();
                $.ajax({
                    url:"?pid=62&action=question&test="+$(this).val()+"&seq=next&question_id="+$('#question_id').val()+"&offset="+$('#curr-que').val(),
                    dataType:"json",
                    type:"GET",
                    success:function(response) 
                    {
                      
                        if(!$.isEmptyObject(response))
                        {
                            if(Number(response.next_question)==Number($('#no_of_question').val()))
                            {
                                $('#next').attr('disabled',true);
                            }

                            $('input[type=radio]').attr('checked', false); 
                           
                            $('#curr-que').val(response.next_question);
                            $('#question_id').val(response.data.question_id);
                            $('#question').text(response.next_question+' : '+response.data.question);

                            $("#que_"+(response.next_question-1)).removeClass('text-success');
                            $("#que_"+(response.next_question)).addClass('text-success');
                            
                            $('#ans-op1').text('a. '+response.data.option1);
                            $('#ans-op2').text('b. '+response.data.option2);
                            $('#ans-op3').text('c. '+response.data.option3);
                            $('#ans-op4').text('d. '+response.data.option4);

                            if(response.data.answer.answer!=0)
                            {
                                for (var i=1; i<=4; i++) 
                                {
                                    if(i==response.data.answer.answer)
                                    {
                                        $('#option'+i).prop('checked',true);
                                    }
                                }                                 
                            }
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown ) 
                    {
                        console.log(errorThrown);
                    }
                });
            });

            $('.load-que').click(function(){
                console.log('hi');
                console.log($('.load-que').attr('data-params'));return fasle;
            });
        });
    </script>
    </body>
</html>