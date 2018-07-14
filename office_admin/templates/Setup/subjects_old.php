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
        <link href="<?php echo base_url('assets/css/layout-nestable.css" rel="stylesheet'); ?>" type="text/css" />
    
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
    <?php 
    if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" )
    {
      header('location: ./?pid=1&unauth=0');
      exit;
    }

    if(isset($_REQUEST['group_id']) && $_REQUEST['group_id'] != '')
	  {
		  $group = $_REQUEST['group_id'];
		  $exesqlquery =mysql_query("SELECT * FROM `es_classes` where es_groupid=".$group);
		  echo "<option>--Select Class--</option>";
		  while($subList=mysql_fetch_assoc($exesqlquery))
		  {
			if($sub_class==$subList['es_classesid'])
				$selected = "selected";
			else
				$selected = "";
				echo "<option value='".$subList["es_classesid"]."' ".$selected.">".$subList['es_classname']."</option>";
		  }
	  }

	  if(isset($_REQUEST['group_id']) && $_REQUEST['group_id'] == '')
	  {
		    echo "<option>Select valid group</option>";
	  }
    if($action == 'manageclasses')
    {
  ?>
  <header>
      <div class="col-lg-12">
          <span> <b>Groups / Classes / Subjects </b> </span>
      </div>
  </header>

  <section>
      <header>
          <div class="col-lg-12">
              <span> <b>Create Groups</b> </span>
          </div>
      </header>

      <table class="table table-striped table-bordered table-hover">
        <form method="post" name="managegroups" action="" >
        <thead>
          <tr>
              <th>S.No</th>                 
              <th>Group Name </th>                                           
              <th>Action</th>
          </tr>
        </thead>
        <tbody id="addgrolis">
              <?php
              $rownum = 0;
              if (is_array($obj_grouplistarr) && count($obj_grouplistarr) > 0)
              {
                foreach ($obj_grouplistarr as $eachrecord){
                $rownum++;
                ?>
              <tr>
              <?php if (isset($gid) && $gid == $eachrecord->es_groupsId ) {?>
                  <td><?php echo $rownum; ?></td>
                  <td><?php echo '<input type="text" class="form-control" name="gr_name" value="'.$eachrecord->es_groupname.'">'; ?></td>
                  <td><a href="javascript:AddRow1()" title="Add"><img src="images/add_16.png" border="0" /></a>&nbsp;
                      <a onclick="return del_group(<?php echo $eachrecord->es_groupsId; ?>)" title="Delete"><img src="images/b_drop.png" border="0" /></a>&nbsp;
                      <input type="image" src="images/save_16.png"  name="editGroup" value="Update" onClick="return confirm('Are you sure you want to save Group ?')">
                  </td>
              <?php }
              else { 
                  $obj_delgroup = new es_groups(); 
              ?>
                  <td><?php echo $rownum; ?></td>
                  <td><?php echo $eachrecord->es_groupname; ?></td>
                  <td><?php if(in_array('2_3',$admin_permissions)){?><a href="javascript:AddRow1()" title="Add"><img src="images/add_16.png" border="0" /></a><?php }?>
                      <?php if(in_array('2_5',$admin_permissions)){?>&nbsp;<a onclick="return del_group(<?php echo $eachrecord->es_groupsId; ?>, <?php $no_rows = $db->getone("SELECT COUNT(*) FROM es_classes WHERE es_groupid=".$eachrecord->es_groupsId); if($no_rows>=1){echo 'true';}else{echo 'false';} ?>);" title="Delete"><img src="images/b_drop.png" border="0" /></a>      <?php }?>
                      <?php if(in_array('2_4',$admin_permissions)){?>&nbsp;<a href="<?php echo buildurl(array('pid'=>20,'action'=>'manageclasses','gid'=>$eachrecord->es_groupsId)); ?>" title="Edit Group" ><?php echo editIcon(); ?> </a><?php } ?>
                  </td>
              <?php } ?>
              </tr>
              <?php }  } ?>
              <tr>
                  <td><?php echo $rownum+1; ?></td>
                  <td><input name="groupname[]" type="text" class="form-control" /></td>
                  <td><?php if(in_array('2_3',$admin_permissions)){?><a href="javascript:AddRow1()" title="Add"><img src="images/add_16.png" border="0" /></a>&nbsp;
                      <?php if(in_array('2_5',$admin_permissions)){?><a href="javascript:DelRow1()" title="Delete"><img src="images/b_drop.png" border="0" /></a><?php }?>
                      <?php }?>
                  </td>
              </tr>
          </tbody>
          <tfoot>
              <tr>
                  <td colspan="3"><?php if(in_array('2_3',$admin_permissions)){?><input class="bgcolor_02" type="submit" name="savegroups" value="Save" />&nbsp;<input class="bgcolor_02" type="reset" name="reset" value="Reset" /><?php }?>
                  </td>
              </tr>
          </tfoot>
      </table>
      </form>
  </section>

  <section>
      <header>
          <div class="col-lg-12">
              <span> <b>Create Class</b> </span>
          </div>
      </header>
      <table class="table table-striped table-hover table-bordered">
        <form action="" method="post" >
        <thead>
            <tr>
                <th>S.No</th>
                <th>Class</th>
                <th>Group</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="uplimg">
            <?php
            if (is_array($obj_classlistarr) && count($obj_classlistarr) > 0)
            {
              $rownumcla = 0;
              foreach ($obj_classlistarr as $eachrecord)
              {
                $rownumcla++;
            ?>
            <tr>
            <?php if (isset($cg) && $cg == $eachrecord->es_classesId  ) { ?>
                <td><?php echo $rownumcla; ?></td>
                <td><?php echo '<input type="text" class="form-control" size="7" name="class_name" value="'.$eachrecord->es_classname.'" >'; ?></td>
                <td><select name="class_type" class="form-control">
                        <?php 
                          if (is_array($obj_grouplistarr) && count($obj_grouplistarr) > 0) { 
                          foreach ($obj_grouplistarr as $eachrecord1){
                          ?>
                          <option value="<?php echo $eachrecord1->es_groupsId; ?>
                            <?php if($cg == $eachrecord->es_classesId) { echo 'selected'; }  ?>">
                            <?php echo $eachrecord1->es_groupname; ?>
                          </option>
                        <?php } ?>
                    </select>
                </td>
                <td><a href="javascript:AddRow()" title="Add"><img src="images/add_16.png" border="0" /></a>
                    <a onclick="return del_class(<?php echo $eachrecord->es_classesId; ?>)" title="Delete"><img src="images/b_drop.png" border="0" /></a>
                    <input type="image" src="images/save_16.png" name="editClass" value="Update"  onclick="return confirm('Are you sure you want to  save Class?')"/>
                </td>
            <?php }} else {
            $obj_feesmaster = new es_classes(); ?>
                <td><?php echo $rownumcla; ?></td>
                <td><?php echo $eachrecord->es_classname; ?></td>
                <td><?php $groupdetails = get_groupname($eachrecord->es_groupId);
                    echo $groupdetails['es_groupname']; ?>                     
                </td>
                <td><?php if(in_array('2_6',$admin_permissions)){?>
                    <a href="javascript:AddRow()" title="Add"><img src="images/add_16.png" border="0" /></a>
                    <?php }?>
                    <?php if(in_array('2_8',$admin_permissions)){?>
                    <a onclick="return del_class(<?php echo $eachrecord->es_classesId; ?>, <?php $cl_no_rows = $db->getone("SELECT COUNT(*) FROM es_subject WHERE es_subjectshortname=".$eachrecord->es_classesId); if($cl_no_rows>=1){echo 'true';}else{echo 'false';}?>)" title="Delete"><img src="images/b_drop.png" border="0" /></a>
                    <?php }?>
                    <?php if(in_array('2_7',$admin_permissions)){?>
                    <a href="<?php echo buildurl(array('pid'=>20, 'action'=>'manageclasses', 'cg'=>$eachrecord->es_classesId)); ?>" title="Edit Class" ><?php echo editIcon(); ?></a>
                    <?php }?>
                </td>
                <?php } ?>
            </tr>
            <?php } } ?>

            <tr>
                <td><?php echo $rownumcla+1; ?></td>
                <td><input name="classname[]" type="text" class="form-control" /></td>
                <td><select name="classtype[]" class="form-control">
                    <?php 
                      if (is_array($obj_grouplistarr) && count($obj_grouplistarr) > 0) { 
                        foreach ($obj_grouplistarr as $eachrecord){ ?>
                          <option value="<?php echo $eachrecord->es_groupsId; ?>"><?php echo $eachrecord->es_groupname; ?></option>
                          <?php } }?>
                    </select>
                </td>
                <td><?php if(in_array('2_6',$admin_permissions)){?>
                    <a href="javascript:AddRow()" title="Add"><img src="images/add_16.png" border="0" /></a>&nbsp;
                    <?php if(in_array('2_8',$admin_permissions)){?>
                    <a href="javascript:DelRow()" title="Delete"><img src="images/b_drop.png" border="0" /></a>
                    <?php }?>
                    <?php }?>
                </td>
            </tr>
        </tbody>
        <tfoot>
        <tr>
        <td colspan="4">
            <?php if(in_array('2_6',$admin_permissions)){?>
                <input class="bgcolor_02" type="submit" name="save" value="Save" />
                &nbsp;
                <input class="bgcolor_02" type="reset" name="reset2" value="Reset" />
            <?php }?> 
        </td>
        </tr></tfoot>                   
        </tfoot>
        </form>
      </table>
  </section>

  <section>
      <header>
        <span>
          <b>Create Subjects</b>
        </span>
      </header>

      <form name="addsubject" method="post" action="" enctype="multipart/form-data"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Group</label>
              <select name="group" id="group" onchange="javascript:getClasses(this.value);" class="form-control">
                  <option value=''>Select Group</option>
                  <?php 
                    foreach ($obj_grouplistarr as $eachrecord1)
                    {
                      if($group == $eachrecord1->es_groupsId)
                        $sel = "selected";
                      else
                        $sel = "";                        
                        echo "<option value='$eachrecord1->es_groupsId' $sel>$eachrecord1->es_groupname</option>";
                    }
                  ?>
              </select>
          </div>

          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Choose Class</label>
              <select name="sub_class" id="sub_class" class="form-control" onchange="javascript:document.addsubject.submit();">
                  <option value=""></option>
                  <option>Select group first</option>
              </select>
          </div>
        </form>

      <table class="table table-striped table-bordered table-hover">
      <form action="" method="post" >     
      <?php
        if($sub_class != "")
        {
      ?>
          <thead>
            <tr>
                <th>S.No</th>                 
                <th>Subject Name </th>                                 
                <th>Action</th>
            </tr>
          </thead>
          <tbody id="addsub">
          <?php   $rownum = 1;
            if(count($obj_subjectlistarr) > 0)
            { 
              foreach ($obj_subjectlistarr as $eachrecord)
              {
              ?>
              <tr>
          <?php if (isset($scid) && $scid == $eachrecord->es_subjectId )
                {
          ?> 
                  <td><?php echo $rownum ?></td>
                  <td>
                      <?php echo '<input type="text" class="form-control" name="sub_edit" size="7" value="'.$eachrecord->es_subjectname.'">'; ?>
                  </td>
                  <td>
                     <a href="javascript:AddRow2()" title="Add"><img src="images/add_16.png" border="0" /></a>
                     <a onclick="return del_subject(<?php echo $eachrecord->es_subjectId; ?>)" title="Delete"><img src="images/b_drop.png" border="0" /></a>
                     <input type="image" value="Update" alt="Update" src="images/save_16.png" name="editSubject" onClick="return confirm('Are you sure you want to save Subject ?')" />
                  </td>
          <?php }
            else
                {
          ?>
                  <td><?php echo $rownum ?></td>
                  <td><?php echo $eachrecord->es_subjectname; ?></td>
                  <td><?php if(in_array('2_9',$admin_permissions))
                      { ?>                        
                      <a href="javascript:AddRow2()" title="Add">
                          <img src="images/add_16.png" border="0" />
                      </a>
                      <?php } if(in_array('2_11',$admin_permissions))
                      { ?>
                      <a onclick="return del_subject(<?php echo $eachrecord->es_subjectId; ?>)" title="Delete">
                      <img src="images/b_drop.png" border="0" />
                      </a>
                      <a onclick="return del_subject(<?php echo $eachrecord->es_subjectId; ?>)" title="Delete"></a>
                      <?php } if(in_array('2_10',$admin_permissions))
                      { ?>
                      <a href="<?php echo buildurl(array('pid'=>20,'action'=>'manageclasses','scid'=>$eachrecord->es_subjectId,'sub_class'=>$sub_class)); ?>" title="EditSubject"><?php echo editIcon();?></a>
                      <?php } ?>
                  </td>
          <?php } ?>
              </tr>
          <?php
            $rownum++;
            }
          }
          ?>
              <tr>
                  <td><?php echo $rownum; ?></td>
                  <td><input name="subject[]" class="form-control" type="text" size="15" /></td>
                  <td><?php if(in_array('2_9',$admin_permissions)){?>
                      <a href="javascript:AddRow2()" title="Add">
                      <img src="images/add_16.png" border="0" /></a>
                      <?php if(in_array('2_11',$admin_permissions)){?>
                      <a href="javascript:DelRow2()" title="Delete">
                      <img src="images/b_drop.png" border="0" /></a><?php }?>                    
                      <?php } ?>
                  </td>
              </tr>
          </tbody>  
          <tfoot>
              <tr>
                  <td colspan="4">
                      <input type="hidden" name="sub_class"value="<?php if($sub_class!=""){echo $sub_class;}?>"/>
                      <?php if(in_array('2_9',$admin_permissions))
                      { ?>
                      <input class="bgcolor_02" type="submit" name="savesubject" value="Save" />&nbsp;
                      <input class="bgcolor_02" type="reset" name="reset" value="Reset" />
                      <?php } ?>        
                  </td>
              </tr>
          </tfoot>
      <?php } ?>  
      </form>
      </table>
  </section>

<script type="text/javascript" >

	var gblvar = 1;

	// for adding classes

	function AddRow() //This function will add extra row to provide another file

	 {

	  var prevrow = document.getElementById("uplimg");

	  var newrowiddd = parseInt(prevrow.rows.length);

	  $(prevrow).append("<tr><td>"+ newrowiddd +"</td><td><input class='form-control' name='classname[]' type='text'/></td><td><select name='classtype[]' class='form-control'><?php foreach ($obj_grouplistarr as $eachrecord){ echo "<option value='".$eachrecord->es_groupsId."'>".$eachrecord->es_groupname."</option>"; } ?></select></td><td><a href='javascript:AddRow()' title='Add'><img src='images/add_16.png' border='0' /></a>&nbsp;<a href=javascript:del_class(<?php echo $eachrecord->es_classesId?>)' title='Delete'><img src='images/b_drop.png' border='0' /></a></td></tr>");
	  }



	function DelRow() //This function will delete the last row

	{

		if(gblvar == 1)

			return;

		var prevrow = document.getElementById("uplimg");

		prevrow.deleteRow(prevrow.rows.length-1);

		gblvar = gblvar - 1;

	}

//for adding groups////

	function AddRow1() //This function will add extra row to provide another file

	 {

	  var prevrow = document.getElementById("addgrolis");

	  var newrowiddd = parseInt(prevrow.rows.length) +1;

    $(prevrow).append("<tr><td>"+ newrowiddd +"</td><td><input name='groupname[]' type='text' class='form-control' /></td><td><a href='javascript:AddRow1()' title='Add'><img src='images/add_16.png' border='0' /></a>&nbsp;<a href='javascript:DelRow1()' title='Delete'><img src='images/b_drop.png' border='0' /></a></td></tr>");


	  }

	

	

	

	function DelRow1() //This function will delete the last row

	{

		var prevrow = document.getElementById("addgrolis");

		$(this).closest('tr').remove();

	}

	

	//for adding subjects//

	

	function AddRow2() //This function will add extra row to provide another file

	 {

	  var prevrow = document.getElementById("addsub");

	  var newrowiddd = parseInt(prevrow.rows.length)+1;

	  $(prevrow).append("<tr><td>"+ newrowiddd +"</td><td><input name='subject[]' type='text' class='form-control' /></td><td><a href='javascript:AddRow2()' title='Add'><img src='images/add_16.png' border='0' /></a>&nbsp;<a href='javascript:DelRow2()' title='Delete'><img src='images/b_drop.png' border='0' /></a></td></tr>");
	  }

	

	function DelRow2() //This function will delete the last row

	{

		if(gblvar == 1)

			return;

		var prevrow = document.getElementById("addsub");

		prevrow.deleteRow(prevrow.rows.length-1);

		gblvar = gblvar - 1;

	}

	

	// adding Dept

	

	

	//for adding subjects//

	

	

	

	

	function del_group(adminid, is_data)
	{
		if(is_data)
		{
			alert("Cannot delete group. It has some data associated with it.");
			return false;
		}
		if(confirm(" Are you sure you want to delete Group?"))
		{
			document.location.href = '?pid=20&action=deletegroup&gid='+adminid;
		}
	}

	function del_class(adminid, is_data)
	{
		if(is_data)
		{
			alert("Cannot delete class. It has some data associated with it.");
			return false;
		}
		if(confirm(" Are you sure you want to delete class?"))
		{
			document.location.href = '?pid=20&action=deleteclass&cid='+adminid;
		}
	}

	

	function del_subject(adminid)
	{
		if(confirm("Are you sure you want to delete Subject?"))
			document.location.href = '?pid=20&action=deletesubject&sid='+adminid;
		return false;
	}

</script>	

<?php }
if($action=='htmlcode'){ ?>

<header>
  <span><b>API for Login</b></span>
</header>

<section>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group"> 
        <label>API Code for Login Button</label>
        <textarea name="htmlcode" class="form-control">
        <?php
            if (isset($_SERVER['HTTP_HOST']) AND (!empty($_SERVER['HTTP_HOST']))) {
            if(isset($_SERVER['HTTPS']) AND (!empty($_SERVER['HTTPS'])) AND strtolower($_SERVER['HTTPS'])!='off') {
            $k_path_url = 'https://';
            } else {
            $k_path_url = 'http://';
            }
            $k_path_url .= $_SERVER['HTTP_HOST'];
            $k_path_url .= str_replace( '\\', '/', substr($_SERVER['PHP_SELF'], 0, -23));
            }
            $path_arr = explode('/', $_SERVER['PHP_SELF']);
            $cur_foldpath =  count($path_arr)-3;
            echo '<a href="'.$k_path_url.'"/><img src="'.$k_path_url.'/images/login2.gif" border="0" /></a>';
        ?>
        </textarea>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group"> 
        <label>API Code for Login Form</label>
        <textarea name="htmlcode" class="form-control">
        <?php
            if (isset($_SERVER['HTTP_HOST']) AND (!empty($_SERVER['HTTP_HOST']))) {
            if(isset($_SERVER['HTTPS']) AND (!empty($_SERVER['HTTPS'])) AND strtolower($_SERVER['HTTPS'])!='off') {
            $k_path_url = 'https://';
            } else {
            $k_path_url = 'http://';
            }
            $k_path_url .= $_SERVER['HTTP_HOST'];
            $k_path_url .= str_replace( '\\', '/', substr($_SERVER['PHP_SELF'], 0, -23));
            }
            $path_arr = explode('/', $_SERVER['PHP_SELF']);
            $cur_foldpath =  count($path_arr)-3;
            $k_path_url .="/index.php";
            echo '<iframe src="'.$k_path_url.'" height="200" width="280" scrolling="no" frameborder="0"></iframe>';
            ?>
        </textarea>
    </div>
</section>
<?php }?>

<?php  if($action=='managecurrency'){ ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

         <td height="3" colspan="3"></td>

	 </tr>

              <tr>

                <td height="25" colspan="3" class="bgcolor_02">&nbsp;&nbsp;<span class="admin">Manage Currency</span></td>

              </tr>			  

              <tr>

                <td width="1" class="bgcolor_02"></td>

                <td align="center" valign="top">

                    <form action="?pid=20&action=managecurrency" method="post">

                	<table width="100%" border="0" cellspacing="0" cellpadding="0">

                      <tr>

                        <td height="25" colspan="4" align="center" class="narmal">Note: Please provide the value of Rupees for 1 dollar</td>

                        

                      </tr>

                      <tr>

                        <td width="1%">&nbsp;</td>

                        <td width="38%" height="25" align="right" valign="middle">1USD($)</td>

                        <td width="1%" align="center" valign="middle">=</td>

                        <td width="60%" align="left" valign="middle">Rs

                        <input type="text" name="currency" value="<?php if(isset($currency) && $currency !=""){echo $currency; }?>" />(Rupees)</td>

                      </tr>

                      <tr>

                        <td>&nbsp;</td>

                        <td height="25">&nbsp;</td>

                        <td>&nbsp;</td>

                        <td >&nbsp;</td>

                      </tr>

                      <tr>

                        <td>&nbsp;</td>

                        <td>&nbsp;</td>

                        <td>&nbsp;</td>

                        <td align="left" valign="middle">

                        <input type="hidden" name="hiddenid" value="<?php echo $currency_det['id'];?>" />

                        <input type="submit" name="update_currency" value="Submit" class="bgcolor_02" /></td>

                      </tr>

                      <tr>

                       <td>&nbsp;</td>

                        <td>&nbsp;</td>

                        <td>&nbsp;</td>

                        <td >&nbsp;</td>

                      </tr>

                    </table>

                     </form>

                

                </td>

                <td width="1" class="bgcolor_02"></td>

              </tr>

              

              <tr>

                <td height="1" colspan="3" class="bgcolor_02"></td>

    </tr>

            </table>

<?php }?>
<script>
	document.getElementById('subjectList').scrollIntoView();
</script>

<script>
  function getClasses(group_id)
  {
    var xmlhttp;
    if (window.XMLHttpRequest)
      xmlhttp=new XMLHttpRequest();
    else
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      
    xmlhttp.onreadystatechange = function()
    {
      document.getElementById('sub_class').innerHTML = xmlhttp.responseText;
    }
    xmlhttp.open("GET", "?pid=20&group_id="+group_id, true);
    xmlhttp.send();
    document.getElementById('sub_class').innerHTML = "<option>Getting list...</option>";
  }
</script>

</body>
</html>