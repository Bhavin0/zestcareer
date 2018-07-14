<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Edit Class Test</title>
        <meta name="description" content="" />
        <meta name="Author" content="" />

        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

        <!-- WEB FONTS -->
        <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />

        <!-- CORE CSS -->
        <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
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
                           <span class="title elipsis"><strong>Edit Class Test</strong></span>
                        </div>
                            <div class="panel-body">
                              <form action="" method="post">

                                <?php
                                $test = mysql_query("SELECT * FROM `isd_class_tests` WHERE class_test_id = ".$_GET['test_id']);
                                $test_detail = mysql_fetch_array($test);
                                ?>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                    <label><b>Academic Year</b></label>
                                    <select class="form-control" id="ac_year" required="required" name="academic_year_id">
                                    <?php
                                    $academic_years = mysqli_query($mysqli_con, "SELECT *FROM `es_finance_master`  ORDER BY `es_finance_masterid` DESC");
                                    while($academic_year = mysqli_fetch_assoc($academic_years))
                                    {
                                        $selected = ($test_detail['academic_year_id']==$academic_year['es_finance_masterid'])?'selected':'';

                                        echo "<option value='".$academic_year['es_finance_masterid']."' ".$selected.">";
                                        echo date_format(date_create($academic_year['fi_ac_startdate']), 'd/m/Y')." - ".date_format(date_create($academic_year['fi_ac_enddate']), 'd/m/Y');
                                        echo "</option>";
                                    }
                                    ?>
                                    </select>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                    <label><b>Class</b></label>
                                    <select class="form-control" id="class_id" required="required" name="class_id">
                                        <option selected="" disabled=""> --SELECT CLASS--</option>
                                        <?php
                                        $classes = mysqli_query($mysqli_con, "SELECT * FROM es_classes ORDER BY es_orderby");
                                        while($class = mysqli_fetch_assoc($classes))
                                        {

                                            $selected = ($test_detail['standard_id']==$class['es_classesid'])?'selected':'';

                                            echo "<option value='".$class['es_classesid']."' ".$selected.">";
                                            echo $class['es_classname'];
                                            echo "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                    <label><b>Subject</b></label>
                                    <select class="form-control" id="subjet_id" required="required" name="subjet_id">
                                        <?php
                                        $subjects = mysqli_query($mysqli_con, "SELECT * FROM es_subject WHERE es_subjectshortname = ".$test_detail['standard_id']." ORDER BY es_subjectname");
                                        while($subject = mysqli_fetch_assoc($subjects))
                                        {

                                            $selected = ($test_detail['subject_id']==$subject['es_subjectid'])?'selected':'';

                                            echo "<option value='".$subject['es_subjectid']."' ".$selected.">";
                                            echo $subject['es_subjectname'];
                                            echo "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                    <label><b>Total Marks</b></label>
                                    <input type="number" name="total_marks" class="form-control" required="required" value="<?php echo $test_detail['total_marks']; ?>">
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                    <label><b>Test Date</b></label>
                                    <input type="text" name="test_date" value="<?php echo $test_detail['class_test_date']; ?>" class="form-control datepicker" readonly>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                    <input type="submit" name="edit_test" class="btn btn-primary pull-right" value="Edit Test">
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
        <script>

        $(document).on('change', '#class_id', function(){
          $('#subjet_id').html("<option selected disabled>PLEASE WAIT SUBJECT LOADING...");  
            var class_id = $('#class_id').val();
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    $('#subjet_id').html(this.responseText);
                }
            };
            xmlhttp.open("GET","?pid=59&action=fetch_subjects&class_id="+class_id,true);
            xmlhttp.send();

        });
        </script>
    </body>
</html>