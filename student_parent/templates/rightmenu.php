<?php 
    if (in_array('31_p', $top_level_permissions) )
    {
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
						    <a href="javascript: void(0)" onclick="popup_letter('?pid=14&nid=<?php echo $each_user['es_noticeid']; ?>')" class="header_link" >
						    <?php echo stripslashes(ucfirst( $each_user['es_title'])); ?>      
                </a>
                <br><br>
            <?php }
            if( ($no_rows2)>=5)
            { ?>
            <a href="?pid=33&action=noticeboard" class="header_link"> More..</a>
            <?php }
            if( ($no_rows2)==0)
            {
              echo"Comming Soon!";
            } ?>      
            </div>

        </div> 
			  <?php }?>

			  <?php if (in_array('24_p', $top_level_permissions) ){?>
        <div class="box warning __web-inspector-hide-shortcut__">
            <div class="box-title">
                <h4>TODAY'S THOUGHT</h4>
                <i class="fa fa-lightbulb-o"></i>
            </div>

            <div class="box-body text-center">
            <?php 
						    $todays_tip_right = $db->getrow("SELECT * FROM es_tips WHERE status='active' ORDER BY rand() LIMIT 0,1");
	              $todaystip = $todays_tip_right['message'];
				        if(isset($todaystip) && $todaystip!="")
                {
                  echo ucfirst($todaystip);
                }
                else
                {
                  echo "Comming Soon!";
                }?>
            </div>

        </div>
			  <?php }?>
              
			  <?php if (in_array('27_p', $top_level_permissions) ){?>
        <div class="box danger __web-inspector-hide-shortcut__">
            <div class="box-title">
                <h4>HOLIDAYS</h4>
                <i class="fa fa-bell"></i>
            </div>

            <div class="box-body text-center height-35">
            <?php 
				$holidays_right = $db->getRows("SELECT title,DATE_FORMAT(holiday_date, '%y') as year,DATE_FORMAT(holiday_date, '%b') as month,DATE_FORMAT(holiday_date, '%e') as day  FROM es_holidays WHERE holiday_date>='".date("Y-m-d")."' ORDER BY holiday_date ASC LIMIT 0,4");
						    if(count($holidays_right==0))
                {
					foreach($holidays_right as $each_holiday)
					{
                    echo $each_holiday['day']." - ".$each_holiday['month']."&nbsp;".$each_holiday['year']." : ".$each_holiday['title'];
                	}
				}
				else 
				{
					echo"Comming Soon!";
				} ?>      
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
							<a id="thumb2" href="../office_admin/images/student_photos/<?php echo $gallery[0]['image_path'];?>" style="cursor: pointer;" onclick="return hs.expand(this,	{ slideshowGroup: <?php echo $i; ?>} )" class="header_link">
							<b>	<?php echo $all_albums[$i]['title']; ?></b>
							</a>
							<?php echo $gallery[0]['title'];
							for($j=1;$j<count($gallery);$j++)
							{ ?>
								<a href="../office_admin/images/student_photos/<?php echo $gallery[$j]['image_path'];?>" class="highslide" onclick="return hs.expand(this, { thumbnailId: 'thumb2', slideshowGroup: <?php echo $i; ?> })">
								</a>
							<?php echo $gallery[$j]['title'];?>
							<?php } ?>
						<?php } 
					}
				}
				else
				{
					echo "Comming Soon!";
				}
				?>
              </div>
        </div>
		<?php }?>


        <div class="box default __web-inspector-hide-shortcut__">
            <div class="box-title">
                <h4>VIDEOS</h4>
                <i class="fa fa-video-camera"></i>
            </div>
            <div class="box-body text-center">
            <?php
        		$header_videos   = "SELECT * FROM  es_videogallery  WHERE  status='Active' ORDER BY  id DESC  LIMIT 0, 2"; 
        		$header_videos_rows  = sqlnumber("select * from es_videogallery where status !='Deleted'");
        		$header_videos_det  = $db->getRows($header_videos );
          		if ($header_videos_rows>= 1)
        		{
          			foreach ($header_videos_det as $each_header_videos)
          			{
          				$rownum++;
    				?>  
      					<object width="100" height="100">
      						<param name="movie" value="<?php echo $each_header_videos['image_path']; ?>" /></param>
							<param name="wmode" value="transparent" /></param>
							<embed src="<?php echo $each_header_videos['image_path']; ?>" type="application/x-shockwave-flash" wmode="transparent" width="105" height="90"></embed>
						</object>
    				<?php }
    			} ?>
    			<?php if ($header_videos_rows>= 1)
    			{?>
    			<a href="?pid=32&action=gallerylist" class="video_link">View More Videos&nbsp;</a>
    			<?php }
    			else{echo "Videos to be added";}?>
            </div>
        </div>