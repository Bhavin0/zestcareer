<div class="col-lg-3 col-md-3 col-sm-12 hidden-xs no-print">

    <script type="text/javascript">
        function popup(url)
        {
		    var width  = 600;
		    var height = 400;
		    var left   = (screen.width  - width)/2;
		    var top    = (screen.height - height)/2;
		    var params = 'width='+width+', height='+height;
		    params += ', top='+top+', left='+left;
		    params += ', directories=no';
		    params += ', location=no';
		    params += ', menubar=no';
		    params += ', resizable=no';
		    params += ', scrollbars=no';
		    params += ', status=no';
		    params += ', toolbar=no';
		    newwin=window.open(url,'windowname5', params);
		    if (window.focus)
        {
			     newwin.focus()
		    }
	      return false;
        }
    </script>

    <script type="text/javascript">
        function popup_letter(url)
        {
		    var width  = 700;
		    var height = 500;
		    var left   = (screen.width  - width)/2;
		    var top    = (screen.height - height)/2;
		    var params = 'width='+width+', height='+height;
		    params += ', top='+top+', left='+left;
		    params += ', directories=no';
		    params += ', location=no';
		    params += ', menubar=no';
		    params += ', resizable=no';
		    params += ', scrollbars=yes';
		    params += ', status=no';
		    params += ', toolbar=no';
		    newwin=window.open(url,'windowname5', params);
		    if (window.focus)
        {
			    newwin.focus()
		    }
	      return false;
        }
    </script>

    <?php if (in_array('31_p', $top_level_permissions) ){?>
        <?php
            $birthdays = $db->getRows("SELECT * FROM `es_preadmission` WHERE DAY(pre_dateofbirth)=DAY(CURDATE()) AND MONTH(pre_dateofbirth)=MONTH(CURDATE())");
				?>
        <div class="box success __web-inspector-hide-shortcut__">
            <div class="box-title">
                <h4>BIRTHDAYS</h4>
                <small class="block"><?php echo count($birthdays); ?> birthdays today</small>
                <i class="fa fa-birthday-cake"></i>
            </div>
            <div class="box-body text-center">
                <?php
                if(count($birthdays) > 0)
                {
                ?>
                  <marquee direction="up" scrolldelay="10" vspace="10px" scrollamount="2">
                    <ol>
                    <?php                      
                      foreach($birthdays as $dob)
                      {
                      $current_class = $db->getOne("SELECT es_classname FROM es_classes WHERE es_classesid=(SELECT MAX(pre_class) FROM es_preadmission_details WHERE es_preadmissionid=".$dob['es_preadmissionid'].")");
                        {
                        ?>
                          <li>
                            <strong>
                              <?php echo ucwords($dob['pre_name']." ".$dob['pre_lastname']); ?>
                            </strong>
                            <br><?php echo strtoupper($current_class); ?><br><br>
                          </li>
                        <?php
                        }
                      }
                    ?>
                    </ol>
                  </marquee>
                <?php
                }
                else
                {
                  echo "No birthdays today";
                }
                ?>
            </div>
        </div>
        <?php } ?>

        <?php

          $online_sql1="select * from es_notice  ORDER BY es_noticeId   ";
          $online_row1=$db->getRows($online_sql1);
          $online_sql="select * from es_notice ORDER BY es_noticeId  DESC limit 0,5 ";
          $online_row=$db->getRows($online_sql);
          $no_rows2 =count($online_row1);
        ?>

        <div class="box info __web-inspector-hide-shortcut__">
            <div class="box-title">
                <h4>NOTICE BOARD</h4>
                <small class="block"><?php echo count($online_row1); ?> notices.</small>
                <i class="fa fa-file-o"></i>
            </div>

            <div class="box-body text-center height-35">
                <?php 
                  foreach ($online_row as $each_user)
                    {
                      echo displaydate( $each_user['es_date']);
                    ?>
                      <br>
                      <a style="color:white;" href="javascript: void(0)" onclick="popup_letter('?pid=39&nid=<?php echo $each_user['es_noticeid']; ?>')">
                        <?php echo stripslashes(ucfirst( $each_user['es_title'])); ?>
                      </a>
                      <br><br>
                    <?php
                    }
                    ?>  
                    <?php 
                      if( ($no_rows2)>=5)
                      {
                      ?>
                      <a href="?pid=37&action=noticeboard"> More..</a>
                      <?php
                      }
                      if( ($no_rows2)==0)
                      {
                      echo"Comming Soon!";
                      }
                    ?>      
            </div>

        </div>

        <div class="box warning __web-inspector-hide-shortcut__">
            <div class="box-title">
                <h4>TODAY'S THOUGHT</h4>
                <i class="fa fa-lightbulb-o"></i>
            </div>

            <div class="box-body text-center">
                <?php if (in_array('24_p', $top_level_permissions) )
                { 
                  $todays_tip_right = $db->getrow("SELECT * FROM es_tips WHERE status='active' order by rand() LIMIT 0,1");
                  $todaystip = $todays_tip_right['message'];
                  if(isset($todaystip) && $todaystip!="")
                    {
                      echo ucfirst($todaystip);
                    }
                  else
                    {
                      echo "Comming Soon!";
                    }
                }
                ?>
            </div>

        </div>


        <div class="box default __web-inspector-hide-shortcut__">

            <div class="box-title">
                <h4>CALENDAR</h4>
                <i class="fa fa-calendar "></i>
            </div>

            <div class="box-body text-center height-35">

              <script type="text/javascript">
                  var day_of_week = new Array('Su','Mo','Tu','We','Th','Fr','Sa');
                  var month_of_year = new Array('January','February','March','April','May','June','July','August','September','October','November','December');
                  var Calendar = new Date();
                  var year = Calendar.getYear();	
                  if(year<300)
                  {
	                  year = year+1900;
                  }
                  var month = Calendar.getMonth();
                  var today = Calendar.getDate();
                  var weekday = Calendar.getDay();
                  var DAYS_OF_WEEK = 7;
                  var DAYS_OF_MONTH = 31;
                  var cal;
                  Calendar.setDate(1);
                  Calendar.setMonth(month);
                  var TR_start = '<TR class="narmal">';
                  var TR_end = '</TR>';
                  var highlight_start = '<TD WIDTH="30"><TABLE CELLSPACING=0 BORDER=1 BGCOLOR=DEDEFF BORDERCOLOR=CCCCCC align="center"><TR><TD WIDTH=20><B><CENTER>';
                  var highlight_end   = '</CENTER></TD></TR></TABLE></B>';
                  var TD_start = '<TD WIDTH="30"><CENTER>';
                  var TD_end = '</CENTER></TD>';
                  cal =  '<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH=100%><TR><TD>';
                  cal += '<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=2>' + TR_start;
                  cal += '<TD COLSPAN="' + DAYS_OF_WEEK + '" ><CENTER><B>';
                  cal += month_of_year[month]  + '   ' + year + '</B>' + TD_end + TR_end;
                  cal += TR_start;
                  for(index=0; index < DAYS_OF_WEEK; index++)
                  {
                    if(weekday == index)
                    {
                      cal += TD_start + '<B>' + day_of_week[index] + '</B>' + TD_end;
                    }
                    else
                    {
                      cal += TD_start + day_of_week[index] + TD_end;
                    }
                  }
                  cal += TD_end + TR_end;
                  cal += TR_start;
                  for(index=0; index < Calendar.getDay(); index++)
                  cal += TD_start + '  ' + TD_end;
                  for(index=0; index < DAYS_OF_MONTH; index++)
                  {
                    if( Calendar.getDate() > index )
                    {
                      week_day =Calendar.getDay();
                      if(week_day == 0)
                        cal += TR_start;
                        if(week_day != DAYS_OF_WEEK)
                        {
                          var day  = Calendar.getDate();
                          if( today==Calendar.getDate() )
                          cal += highlight_start + day + highlight_end + TD_end;
                          else
                          cal += TD_start + day + TD_end;
                        }
                        if(week_day == DAYS_OF_WEEK)
                        cal += TR_end;
                    }
                    Calendar.setDate(Calendar.getDate()+1);
                  }
                  cal += '</TD></TR></TABLE></TABLE>';
                  document.write(cal);
              </script>      
            </div>
        </div>


			  <?php if (in_array('27_p', $top_level_permissions) ){?>
        <div class="box danger __web-inspector-hide-shortcut__">
            <div class="box-title">
                <h4>HOLIDAYS</h4>
                <i class="fa fa-bell"></i>
            </div>

            <div class="box-body text-center height-35">

              <?php 
						      $holidays_right = $db->getRows("SELECT title,DATE_FORMAT(holiday_date, '%y') as year,DATE_FORMAT(holiday_date, '%b') as month,DATE_FORMAT(holiday_date, '%e') as day  FROM es_holidays WHERE holiday_date>='".date("Y-m-d")."' ORDER BY holiday_date ASC LIMIT 0,4");
						      if(count($holidays_right)>0)
                  {
							       foreach($holidays_right as $each_holiday)
                     {
                        echo $each_holiday['day']; ?>-<?php echo $each_holiday['month']."&nbsp;".$each_holiday['year'].":".$each_holiday['title'];
            
							       }
						      }
                  else
                  {
                    echo"Comming Soon...!";
                  }
              ?>      
            </div>

        </div>
        <?php }?>

			  <?php if (in_array('25_p', $top_level_permissions) ){?>
        <div class="box success __web-inspector-hide-shortcut__">
            <div class="box-title">
              <h4>PHOTO GALLERY</h4>
              <i class="fa fa-picture-o"></i>
            </div>

            <div class="box-body text-center height-35">
              <?php 
					      $all_albums = $db->getRows("SELECT * FROM es_photogallery WHERE pid=0 ORDER BY id DESC LIMIT 0,5");
					     if(count($all_albums)>=1)
               {
					       for($i=0;$i<count($all_albums);$i++)
                 {					
						        $gallery = $db->getRows("SELECT * FROM es_photogallery WHERE pid='".$all_albums[$i]['id']."'");
						        if(count($gallery)>0)
                    {
                    ?>
	                    <a id="thumb2" href="images/student_photos/<?php echo $gallery[0]['image_path'];?>" style="cursor: pointer;" onclick="return hs.expand(this,	{ slideshowGroup: <?php echo $i; ?>} )">
                        <b><?php echo $all_albums[$i]['title']; ?></b>
                      </a>

	                     <?php echo $gallery[0]['title'];
                       for($j=1;$j<count($gallery);$j++)
                       {
                        ?>
                        <a href="images/student_photos/<?php echo $gallery[$j]['image_path'];?>"></a>
		                    <?php
                        echo $gallery[$j]['title'];
                       }
                    } 
                  }
               }
               else
               {
                echo"Comming Soon!";
               }
              ?>
              </div>
        </div>
			  <?php }?>
</div>