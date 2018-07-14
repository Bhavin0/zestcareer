<!doctype html>
  <html lang="en-US">
    <head>
      <meta charset="utf-8" />
      <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
      <title>Routes</title>
      <meta name="description" content="" />
      <meta name="Author" content="" />
      <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
      <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />
      <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
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
              <!-- PANEL START -->
	            <div class="panel panel-primary">
		            <div class="panel-heading">
			            <span class="elipsis title"><strong>Routes</strong></span>
		            </div>

		            <div class="panel-body">
		            <?php
		            	$routes = mysqli_query($mysqli_con, "SELECT * FROM `es_translist`");
		            ?>
						<table class="table table-bordered table-striped table-hover">
							<thead>
								<tr>
									<th>Sr No.</th>
									<th>Route Title</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php while($route = mysqli_fetch_assoc($routes))
							{
								?>
								<tr>
									
								</tr>
								<?php
							}
							?>
							</tbody>
				  <?php if(count($route_row) > 0 ){ ?>
				  <?php						
					$rw = 1;
					$slno = $start+1;
					foreach ($route_row as $route)
						 {  
							if($rw%2==0)
								$rowclass = "even";
								else
								$rowclass = "odd";
					?>
				  <tr class="<?php echo $rowclass;?>">
					<td align="center"><?php echo $slno;?></td>
					<td align="left"><?php echo ucfirst($route['route_title']); ?></td>
						<td align="center">
                    <?php if (in_array("14_2", $admin_permissions)) {?>
                   
					<a title="Edit route" href="?pid=75&action=editroute1&id=<?php echo $route['id'];?>"><?php echo editIcon(); ?></a>&nbsp;
                    
                    <?php }else{ echo "-"; }?>
                    <?php
					$count_query_sql="SELECT * FROM es_trans_board WHERE route_id=".$route['id'];
					$count_query_exe=mysql_query($count_query_sql);
					$count_query_num=mysql_num_rows($count_query_exe);
					if($count_query_num==0){?>
                    
                     <?php if (in_array("14_3", $admin_permissions)) {?>
                     
					<a title="Delete route" href="?pid=75&action=deleteroute1&id=<?php echo $route['id'];?>" onclick="return confirm('Do you want to delete this record');"><?php echo deleteIcon(); ?></a>&nbsp;
                    
					<?php }}?>
                    <!--<a title="View Vehicles" href="" ><?php echo viewIcon(); ?></a> -->
					</td>
				  </tr>
				  <?php           
				  $rw++;
				  $slno++;	   
				  } ?>
				  <tr>
					<td colspan="6" align="center"><?php paginateexte($start, $q_limit, $no_rows, "action=routelist1") ?></td>
				  </tr>
				  <tr>
					<td colspan="6" align="center"> <?php if (in_array("14_101", $admin_permissions)) {?><input type="button" style="cursor:pointer;" value="Print Route List" onclick="window.open('?pid=75&action=print_routelist1&start=<?php echo $start;?>',null,'width=700,height=500,scrollbars=yes,toolbar=no,directories=no,status=no,menubar=yes,left=140,top=30');"  class="bgcolor_02"  /><?php }?></td>
				  </tr>
				 
				  <?php } 
											
							  else {
							   echo "<tr>";
							   echo "<td align='center' class='narmal' colspan='7'>No records found</td>";
							   echo "</tr>";
						} 
										
										
										
				  ?>
				</table>
</td>
<td width="1" class="bgcolor_02"></td>
</tr>
<tr>
<td height="1" colspan="3" class="bgcolor_02"></td>
</tr>
</table>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
      <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
      <script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
  </body>
</html>