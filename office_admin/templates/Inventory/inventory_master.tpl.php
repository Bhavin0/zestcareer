<?php 
/**
* Only Admin users can view the pages
*/
if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" ) {
header('location: ./?pid=1&unauth=0');
exit;
}
if($action == 'addinventory' || $action == 'edit_inventory' ||$action=='view_inventory') {
?>
<script type="text/javascript">

function newWindowOpen (href) {

window.open(href,null,  'width=900,height=900,scrollbars=yes,toolbar=no,directories=no,status=no,menubar=yes,left=140,top=30');
}
</script> 

<table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr>
<td height="3" colspan="3"></td>
</tr>
<tr>
<td height="25" colspan="3" class="bgcolor_02"><span class="admin">&nbsp;Create Inventory Type </span></td>
</tr>


<?php 
if (isset($viewinventory) && count($viewinventory)>0 && $action == 'addinventory' ||$action=='view_inventory') {
?>
<tr>
<td class="bgcolor_02" width="1"></td>
<td valign="top" align="left">
<table width="100%" border="0" cellspacing="3" cellpadding="0">

<tr>
<td width="26%" align="left" class="narmal">Inventory Type</td>
<td width="4%" align="left">:</td>
<td width="31%" align="left"><?php echo $viewinventory->in_inventory_name;?>							</td>
<td width="39%">&nbsp;</td>
</tr>
<tr>
<td width="26%" align="left" class="narmal">Short Name</td>
<td width="4%" align="left">:</td>
<td width="31%" align="left"><?php echo $viewinventory->in_short_name;?>							</td>
<td width="39%">&nbsp;</td>
</tr>
<tr>
<td width="26%" align="left" class="narmal">Description</td>
<td width="4%" align="left">:</td>
<td width="31%" align="left"><?php echo $viewinventory->in_description;?>							</td>
<td width="39%">&nbsp;</td>
</tr>
<tr>
<td align="right" class="narmal">&nbsp;</td>
<td align="center">&nbsp;</td>
<td><input type="submit" name="back" onclick="javascript:history.go(-1);" id="back" value="back" class="bgcolor_02"/></td>
<td>&nbsp;</td>
</tr>
</table>
</td>
<td class="bgcolor_02" width="1"></td>
</tr>


<?php 
} else{

?>
<tr>
<td width="1" class="bgcolor_02"></td>
<td align="left" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr>
<td height="10"><form name="Inventory_Master" action="" method="post"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="3" height="20" align="right"><font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif" size="2">Note :  * denotes mandatory&nbsp;</font></td>
</tr>
<tr>
<td width="30%" align="left" class="narmal">&nbsp;&nbsp;Inventory Type</td>
<td width="70%" colspan="2" align="left">
<select name="" >
<option value="1">Returnable Goods</option>
<option value="2">Non-returnable Goods</option>
</select>
<?php /*?><input type="text" name="in_inventory_name"  
value="<?php
if (isset($getinventory->in_inventory_name)){

echo htmlentities($getinventory->in_inventory_name);
}else{ 
echo stripslashes($_POST['in_inventory_name']);
} 
?>"	/><?php */?>
<span class="error_message">*</span> </td>
</tr>
<tr>
<td height="15" align="left"></td>
<td colspan="2" align="left" class="error_message"><?php 
if (isset($error_inventory_type)&&$error_inventory_type!=""){
echo $error_inventory_type;
}
?>
</td>
</tr>
<tr>
<td align="left" class="narmal">&nbsp; Short Name </td>
<td colspan="2" align="left"><input type="text" name="in_short_name" value="<?php
if (isset($getinventory->in_short_name)){

echo htmlentities($getinventory->in_short_name);
}else{ 
echo stripslashes($_POST['in_short_name']);
} 
?>" />
<span class="error_message">*</span> </td>
</tr>
<tr>
<td height="15" align="left"></td>
<td colspan="2" align="left" class="error_message"><?php 
if (isset($error_short_name)&&$error_short_name!=""){
echo $error_short_name;
}
?>
</td>
</tr>
<tr>
<td align="left" class="narmal">&nbsp; Description </td>
<td colspan="2" align="left"><textarea name="in_description" cols="16"><?php
if (isset($getinventory->in_description)){

echo $getinventory->in_description;
}else{ 
echo $_POST['in_description'];
} 
?>
</textarea>
<span class="error_message">*</span> </td>
</tr>
<tr>
<td height="15" align="left"></td>
<td colspan="2" align="left" class="error_message"><?php 
if (isset($error_description)&&$error_description!=""){
echo $error_description;
}
?>
</td>
</tr>
<tr>
<td align="left" class="narmal">&nbsp;&nbsp;</td>
<td colspan="2" align="left"><input type="hidden" name="edit_id" value="<?php echo $getinventory->es_inventoryId;?>" />
<input name="inventorysubmit" type="submit" class="bgcolor_02" value="Submit" />
</td>
</tr>

</table></form></td>
</tr>    
<tr>
<td></td>
</tr>
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td height="20" colspan="5" class="narmal">&nbsp;&nbsp;</td>
</tr>
<tr>
<td height="20" colspan="5" class="narmal"><table width="100%" border="0" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
<tr  class="bgcolor_02">
<td width="10%" height="25" align="center" valign="middle" class="admin" >S.No</td>
<td width="20%" align="left" valign="middle" class="admin">Inventory Type </td>
<td width="16%" align="center" class="admin">Short Name </td>
<td width="26%" align="left" valign="middle" class="admin">Description</td>
<td width="13%" align="center" valign="middle" class="admin">&nbsp;Action</td>
</tr>
<?php	
if(count($inventoryList) > 0 ){					
$rw = 1;
$slno = $start+1;

foreach ($inventoryList as $es_inventory)
{  
if($rw%2==0)
$rowclass = "even";
else
$rowclass = "odd";


?>

<tr class="<?php echo $rowclass;?>">
<td align="center" valign="middle" class="narmal"><?php echo $slno;?></td>
<td align="left" valign="middle" class="narmal"><?php echo $es_inventory->in_inventory_name; ?></td>
<td align="center" class="narmal"><?php echo $es_inventory->in_short_name; ?> </td>
<td align="left" valign="middle" class="narmal"><?php echo $es_inventory->in_description; ?> </td>
<td align="center" valign="middle" ><?php if (in_array("13_2", $admin_permissions)) {?>

<a title="Edit Inventory" href="<?php echo buildurl(array('pid'=>7, 'action'=>'edit_inventory', 'uid'=>$es_inventory->es_inventoryId));?>#editinventory"><?php echo editIcon(); ?></a>&nbsp;
<?php }else{ echo "-"; }?>
<?php if (in_array("13_3", $admin_permissions)) {?>
<a title="Delete Inventory" href="<?php  echo buildurl(array('pid'=>7, 'action'=>'delete', 'uid'=>$es_inventory->es_inventoryId));?>#deleteinventory" onclick="return confirm('<?php echo SM_CONFIRM_DELETE_MESSAGE;?>');"><?php echo deleteIcon(); ?></a>
<?php }else{ echo "-"; }?>
<!--<a title="View Inventory" href="<?php  //echo buildurl(array('pid'=>7, 'action'=>'view_inventory', 'uid'=>$es_inventory->es_inventoryId));?>#viewinventory" ><?php echo viewIcon(); ?></a>--> </td>

</tr>
<?php 
$rw++;
$slno++;

}
?>
<tr>
<td colspan="5" align="center"><?php paginateexte($start, $q_limit, $no_rows, "action=".$action."&column_name=".$orderby."&asds_order=".$asds_order) ?></td>
</tr>
<tr>
<?php if (in_array("13_17", $admin_permissions)) {?>
<td align="right" colspan="5"><input type="button"  name="print_inventory" value="Print" class="bgcolor_02"onclick="newWindowOpen('?pid=7&action=inventory_print')"></td><?php }?>
</tr>
<?php
}	

else {
echo "<tr >";
echo "<td align='center' colspan='5' class='narmal'>No Records Found</td>";
echo "</tr>";
} 
?>
</table></td>
</tr>
</table></td>
</tr>
</table>

</td>
<td width="1" class="bgcolor_02"></td>
</tr>
<?php } ?>
<tr>
<td height="1" colspan="3" class="bgcolor_02"></td>
</tr>
</table>
<?php  } ?>
<?php if ($action  == 'inventory_print') {


?>

<table width="100%" border="0" cellpadding="0" cellspacing="0" widht="100%" >					
<tr  class="bgcolor_02">
<td width="10%" height="25" align="center" class="admin" >S.No</td>
<td width="20%" align="center" class="admin">Inventory Type</td>
<td width="16%" align="center" class="admin">Short Name</td>
<td width="26%" align="center" class="admin">Description</td>
</tr>
<?php						
$rw = 1;
$slno = $start+1;

foreach ($inventoryListPrint as $es_inventory)
{  
if($rw%2==0)
$rowclass = "even";
else
$rowclass = "odd";
?>
<tr class="<?php echo $rowclass;?>">
<td align="center" class="narmal"><?php echo $slno;?></td>
<td align="center" class="narmal"><?php echo $es_inventory->in_inventory_name; ?></td>
<td align="center" class="narmal"><?php echo $es_inventory->in_short_name; ?> </td>
<td align="center" class="narmal"><?php echo $es_inventory->in_description; ?> </td>	

</tr>
<?php 
$rw++;
$slno++;

}
?>

</table>

<?php } ?>

<?php if( $action == 'addcategory'|| $action == 'edit_category' ||$action=='view_category' ) {

	include'addcategory.php';
}
?>
<?php if ($action == 'inv_category_print') { ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
<tr  class="bgcolor_02">
<td width="10%" height="23" align="center" class="admin">S No</td>
<td width="24%" align="left" class="admin">Category</td>
<td width="30%" align="left" class="admin">Description</td>
</tr>
<?php						
$rw = 1;
$slno = $start+1;
foreach ($categoryListPrint as $es_in_category)
{  
if($rw%2==0)
$rowclass = "even";
else
$rowclass = "odd";


?>

<tr class="<?php echo $rowclass;?>">
<td align="center" class="narmal"><?php echo $slno;?></td>
<td align="left" class="narmal"><?php echo $es_in_category->in_category_name; ?></td>
<td align="left" class="narmal"><?php echo $es_in_category->in_description; ?></td>

</tr>
<?php          
$rw++;
$slno++;

} ?> 
</table>				


<?php } ?>
<?php if($action == 'additem') {  

	include'additem.php';

 } ?>       

<?php if ( $action == "item_print" ) { ?>
<table border="0" cellpadding="0" cellspacing="0" >
<tr class="bgcolor_02">
<td width="10%" height="23"  align="center" class="admin">S.No</td>
<td width="17%" align="left" class="admin">Item&nbsp;Name</td>
<td width="8%" align="center" class="admin">Item&nbsp;Code</td>
<td width="22%" align="center" class="admin">Inventory&nbsp;Type</td>
<td width="12%" align="center" class="admin">&nbsp;Qty&nbsp;In&nbsp;hand</td>
<td width="12%" align="center" class="admin">Re-Order level </td>

</tr>
<?php						
$rw = 1;
$slno = $start+1;
foreach ($itemListPrint as $itl)
{  

if($rw%2==0)
$rowclass = "even";
else
$rowclass = "odd"; 
?>
<tr class="<?php echo $rowclass;?>">
<td align="center" class="narmal"><?php echo $slno;?></td>
<td align="left" class="narmal"><?php echo $itl['in_item_name']; ?></td>
<td align="center" class="narmal"><?php echo $itl['in_item_code']; ?></td>
<td align="center" class="narmal"><?php echo $inventory_type_arr[$itl['in_inventory_id']];?></td>
<td height="25" align="center" class="narmal"><?php echo $itl['in_qty_available']; ?></td>
<td align="center" class="narmal"><?php echo $itl['in_reorder_level']; ?></td>
</tr>
<?php 
$rw++;
$slno++;


} ?> 
</table>        

<?php } ?>

<?php  if($action == 'addsupply') {

	include'addsupply.php';
	
 } ?>
<?php if ($action == 'supplier_print') { ?>
<tr>

<td align="center" colspan="3">
<table width="776" border="0" cellpadding="0" cellspacing="0">
<tr class="bgcolor_02">
<td width="14%" height="25" align="center" valign="middle" class="admin">S.No</td>
<td width="31%"  align="left" valign="middle" class="admin" >Supplier&nbsp;Name</td>
<td width="28%"  align="left" valign="middle" class="admin">Address</td>
<td width="27%"  align="left" valign="middle" class="admin">Contact</td>
</tr>
<?php						
$rw = 1;
$slno = $start+1;
foreach ($supplyListPrint as $es_in_supplier_master)
{  
if($rw%2==0)
$rowclass = "even";
else
$rowclass = "odd";
?>

<tr class="<?php echo $rowclass;?>">
<td align="center" valign="middle" class="narmal"><?php echo $slno;?></td>
<td align="left" valign="middle" class="narmal"><?php echo $es_in_supplier_master->in_name; ?></td>
<td align="left" valign="middle" class="narmal"><?php echo $es_in_supplier_master->in_address; ?><br />
  <?php echo $es_in_supplier_master->in_city; ?>, <?php echo $es_in_supplier_master->in_state; ?>, <?php echo $es_in_supplier_master->in_country; ?></td> 

<td align="left" valign="middle" class="narmal"><?php	if($es_in_supplier_master->in_email!=""){ ?>

Email:<?php echo $es_in_supplier_master->in_email; ?><br />
<?php } ?>
Office No:<?php echo $es_in_supplier_master->in_office_no; ?><br/> 
<?php	if($es_in_supplier_master->in_mobile_no!=""){ ?>
Mobile No:<?php echo $es_in_supplier_master->in_mobile_no; ?><br/>
<?php } ?> 
<?php	if($es_in_supplier_master->in_fax!=""){ ?>
Fax:<?php echo $es_in_supplier_master->in_fax; ?>
<?php } ?>
</td>

</tr>

<?php 

$rw++;
$slno++;


} ?> 
</table> 
</td>
</tr>  

<?php } ?>

<?php
if($action=="purchase_orders")
{
	include'purchase_orders.php';
}
if($action=="add_order")
{
	include'add_order.php';
}
if($action=="goods_reciept")
{
	include'goods_reciept.php';
}
if($action=='stock_details'){
?>
<script type="text/javascript">
function SelectChkbox()
{
var oInputs = document.getElementsByTagName('input');
if(document.getElementById("checkall").checked == true) {
var ischked = true;
}else{
var ischked = false;
}
for ( i = 0; i < oInputs.length; i++ )
{
// loop through and find <input type="checkbox"/>
if (oInputs[i].type == 'checkbox')
{
var chk_box = oInputs[i].id;
document.getElementById(chk_box).checked = ischked;
}
}
activateOrderNow();
}

function activateOrderNow() {
var oInputs = document.getElementsByTagName('input');
var dis = "y";
for ( i = 0; i < oInputs.length; i++ )
{
if (oInputs[i].type == 'checkbox')
{
var chk_box = oInputs[i].id;
if(document.getElementById(chk_box).checked)
{
document.getElementById("OrderNow").disabled = false;
dis = "n"
}
}
}
if(dis=="y") {
document.getElementById("OrderNow").disabled = true;
//return false;
}
}

function validatesearch()
{
if(document.getElementById("selectview").value =="") {
document.getElementById("selectviewerror").innerHTML = "Please Select Report Type";
document.getElementById("selectview").focus();
return false;
}
}
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td height="3" colspan="3"></td>
</tr>
<tr>
<td height="25" colspan="3" class="bgcolor_02">&nbsp;&nbsp;<span>Stock Details</span></a></td>
</tr>
<tr>
<td width="1" class="bgcolor_02"></td>
<td  align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td height="10"></td>
</tr>
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="5" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
<form action="" method="post" name="inventory" id="inventory" >
<table width="100%">

<tr>
<td width="136" class="admin">Last&nbsp;Received&nbsp;Date</td>
<td width="249"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="44%" class="narmal">From:</td>
<td width="35%"><input class="plain" name="dc1" value="<?php
if (isset($dc1)){ 
echo $_POST['dc1'];
}
?>"  size="12" onfocus="this.blur()" readonly="readonly" /></td>
<td width="21%"><a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fStartPop(document.inventory.dc1,document.inventory.dc2);return false;" ><img class="PopcalTrigger" align="absmiddle" src="<?php echo JS_PATH ?>/DateRange/calbtn.gif" width="34" height="22" border="0" alt="" /></a></td>
</tr>
</table></td>


<td width="782"><table width="94%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="20%"  class="narmal">To:</td>
<td width="10%"><input class="plain" name="dc2" value="<?php
if (isset($dc2)){ 
echo $_POST['dc2'];
}
?>"size="12" onfocus="this.blur()" readonly="readonly" /></td>
<td width="70%"><a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fEndPop(document.inventory.dc1,document.inventory.dc2);return false;" ><img class="PopcalTrigger" align="absmiddle" src="<?php echo JS_PATH ?>/DateRange/calbtn.gif" width="34" height="22" border="0" alt="" /></a></td>
</tr>
</table></td>
<td width="25"><input type="submit" name="Search" value="Search" class="bgcolor_02" onclick="return validatesearch();" 
/></td>
</tr>
<?php /*?><tr>
<td class="admin">Reorder Level </td>
<td><select name="reorder">
<option value="">ALL</option>
<option value="1" <?php if($reorder=="1") echo "selected"; ?> >Below</option>
<option value="2" <?php if($reorder=="2") echo "selected"; ?> >Above</option>
</select></td>
<td></td>
<td>&nbsp;</td>
</tr><?php */?>
</table>
</form>
<iframe width=132 height=142 name="gToday:contrast:agenda.js" id="gToday:contrast:agenda.js" src="<?php echo JS_PATH ?>/DateRange/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe> </td>
</tr>
<tr>
<td><table width="100%" border="0" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
<form action="<?php echo "?pid=$pid&action=add_order";?>" method="post" name="orderitems" id="orderitems" >
<tr>
<td height="10" colspan="8"></td>
</tr>
<?php
if(count($in_itemsList) > 0) {
?>
<tr class="bgcolor_02">
<td width="5%"  height="20" align="center"><input type="checkbox" name="checkall" id="checkall" onclick="SelectChkbox();" /></td>
<td width="15%" align="center" class="admin">Item&nbsp;Code</td>
<td width="15%" align="left" class="admin">Item&nbsp;Name</td>
<td width="10%" align="center" class="admin">Units</td>
<td width="13%" align="center" class="admin">Qty&nbsp;in&nbsp;hand</td>
<td width="15%" align="center" class="admin">Last&nbsp;Recv&nbsp;Date</td>
<td width="15%" align="center" class="admin">Last&nbsp;Issue&nbsp;Date</td>
<td width="12%" align="center" class="admin">RE-Order&nbsp;Level</td>
</tr>
<?php
$bg=1;
foreach($in_itemsList as $item)
{
if($bg%2 == 0)
$class = "even";
else  $class = "odd";
?>
<tr class="<?php echo $class;?>">
<td align="center" ><input type="checkbox" name="checkitem[<?php echo $item->es_in_item_masterId;?>]" id="checkitem[<?php echo $item->es_in_item_masterId;?>]" value="<?php echo $item->es_in_item_masterId;?>" onclick="return activateOrderNow();" /></td>
<td align="center" class="narmal"><?php echo $item->in_item_code;?></td>
<td align="left" class="narmal"><?php echo $item->in_item_name;?></td>
<td align="center" class="narmal"><?php echo $item->in_units;?></td>
<td align="center" class="narmal"<?php if($item->in_qty_available < $item->in_reorder_level){?> style="color:#FF0000; font-weight:bold;"<?php } ?>><?php echo $item->in_qty_available;?></td>
<td align="center" class="narmal"><?php 

if($item->in_last_recieved_date!='0000-00-00 00:00:00'){echo displaydate($item->in_last_recieved_date);}?></td>
<td align="center" class="narmal"><?php if($item->in_last_issued_date!='0000-00-00 00:00:00'){echo displaydate($item->in_last_issued_date);}?></td>
<td align="center" class="narmal"><?php echo $item->in_reorder_level;?></td>
</tr>
<?php
$bg++;
}
?>
<tr>
<td colspan="8" align="center"><?php paginateexte($start, $q_limit, $no_rows, "action=".$action."&column_name=".$orderby."&asds_order=".$asds_order.$searchUrl) ?></td>
</tr>

<tr>
<td colspan="8"  align="left" valign="middle" height="30" style="padding-left:5px;"><input type="submit" name="OrderNow" class="bgcolor_02" id="OrderNow" value="Order Now" disabled /></td>
</tr>
<?php
} else {
?>
<tr>
<td colspan="8" align="center" class="narmal">No Records Found</td>
</tr>
<?php
}
?>
</form>
</table></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
</table></td>
<td width="1" class="bgcolor_02"></td>
</tr>
<tr>
<td height="1" colspan="3" class="bgcolor_02"></td>
</tr>
</table>
<?php
}
if($action=='goods_issue'){

	include'goods_issue.php';
}

if($action=='return_issue'){
?>
<script type="text/javascript">
function validateissue()
{
var i=10;
if(document.getElementById("return_date").value=="") {
alert("Please Select Reurn Date");
return false;
}

for ( idno=1; idno<=i; idno++ )
{

var qtyid = "quantity["+idno+"]";

var act_id='act_qty'+idno;

if(document.getElementById(qtyid).value == "") {
alert("Please Enter Quantity");
document.getElementById(qtyid).focus();
return false;
}
//alert(document.getElementById(qtyid).value);
if(!document.getElementById(qtyid).value.match(/^((\d+(\.\d*)?)|((\d*\.)?\d+))$/) || document.getElementById(qtyid).value<0)
{
alert("Invalid Quantity Format");
document.getElementById(qtyid).focus();
return false;
}
/*
 if(!document.getElementById(qtyid).value.match(/^((\d+(\.\d*)?)|((\d*\.)?\d+))$/) || document.getElementById(qtyid).value==0)
{
alert("Invalid Quantity Format");
document.getElementById(qtyid).focus();
return false;
}
*/




if(parseInt(document.getElementById(qtyid).value)>parseInt(document.getElementById(act_id).value))
{
alert("Exceeding the actual ordered quantity");
document.getElementById(qtyid).focus();
return false;
}
}
}




function showIssuedItems()
{
if(document.getElementById("es_in_goods_issueid").value != "")
{
document.return_issue.submit();
}
}
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td height="3" colspan="3"></td>
</tr>
<tr>
<td height="25" colspan="3" class="bgcolor_02">&nbsp;&nbsp;<span class="admin">Issue Return Note (IRN)</span></a></td>
</tr>
<tr>
<td width="1" class="bgcolor_02"></td>
<td align="left" valign="top">
<form name="return_issue" action="" method="post" >
<table width="100%" border="0" cellspacing="0" cellpadding="1">
<tr>
<td colspan="2" align="center" valign="top" >
<table width="98%" border="0" cellspacing="3" cellpadding="0">
<tr>
<td align="left" class="narmal">GIN No</td>
<td align="left" class="narmal">
<select name="es_in_goods_issueid" id="es_in_goods_issueid" onchange="showIssuedItems();">
<option value="0">.........select..........</option>
<?php
foreach($IssueList as $issue)
{
if($issue->es_in_goods_issueId == $IssueItemsList->es_in_goods_issueId) {
$sel = "selected";
} else {
$sel = "";
}
echo "<option value='$issue->es_in_goods_issueId' $sel >$issue->es_in_goods_issueId</option>";
}
?>
</select>
</td>
</tr>
<tr>
<td align="left" class="narmal">Issued to</td>
<td align="left" class="narmal"><input type="text" name="in_issue_to" id="in_issue_to" value="<?php if($IssueItemsList->in_issue_to!="") echo $IssueItemsList->in_issue_to;?>" readonly /></td>
</tr>
<!--<tr>
<td class="narmal">IRN Date</td>
<td class="narmal"><input type="text" name="return_date" id="return_date" value="" /></td>
</tr>-->
<tr>
<td align="left" class="narmal">IRN Date</td>
<td align="left" class="narmal"><input class="plain" name="return_date" id="return_date" value="" size="19"><a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.return_issue.return_date);return false;" ><img name="popcal" align="absmiddle" src="<?php echo JS_PATH ?>/DateTime/calbtn.gif" width="34" height="22" border="0" alt=""></a><iframe width=188 height=166 name="gToday:datetime:agenda.js:gfPop:plugins_time.js" id="gToday:datetime:agenda.js:gfPop:plugins_time.js" src="<?php echo JS_PATH ?>/DateTime/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>
<font color="#FF0000">*</font></td>
</tr>

</table>
</td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<?php
if($IssuedItems!="")
{
?>
<tr>
<td colspan="2">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="84%" height="20" colspan="3" class="narmal"><span class="admin">&nbsp;&nbsp;Issue Items List</span></td>
</tr>
<tr>
<td height="20" colspan="3" class="narmal">
<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
<tr class="bgcolor_02">
<td width="10%"  height="20" align="center" class="admin">S.No</td>
<td width="30%" align="center" class="admin">Item Code</td>
<td width="30%" align="left" class="admin">Item Name</td>
<td width="30%" align="center" class="admin">Quantity</td>
</tr>
<?php
$sl = 1;
foreach($IssuedItems as $isitm)
{
?>
<tr>
<td align="center" ><?php echo $sl;?></td>
<td align="center">
<?php
foreach($in_itemsList as $item)
{
if($item->es_in_item_masterId == $isitm['item_code']) {
?>
<input type="hidden" name="item_code[<?php echo $sl;?>]" id="item_code[<?php echo $sl;?>]" value="<?php echo $item->es_in_item_masterId;?>" ><?php echo $item->in_item_code;?>
<?php
}
}
?>
</td>
<td align="left">
<?php
foreach($in_itemsList as $item)
{
if($item->es_in_item_masterId == $isitm['item_code']) {
?>
<input type="hidden" name="item_name[<?php echo $sl;?>]" id="item_name[<?php echo $sl;?>]" value="<?php echo $item->es_in_item_masterId;?>" ><?php echo $item->in_item_name;?>
<?php
}
}
?>
</td>
<?php 
if($isitm['quantity']!="") {
$qty = $isitm['quantity'] - $isitm['returned'];
if($qty == 0) {
$read = "readonly";
} else{
$read = "";
}
}
?>
<td align="center"><input type="hidden" id="act_qty<?php echo $sl;?>" name="act_qty<?php echo $sl;?>" value="<?php echo $qty;?>" /><input name="quantity[<?php echo $sl;?>]" id="quantity[<?php echo $sl;?>]" value="<?php echo $qty;?>" <?php echo $read;?> style="width:97%;" /></td>
</tr>
<?php
$sl++;
}
?>
</table>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td width="15%" align="right">&nbsp;</td>
<td width="85%" align="left">&nbsp;</td>
</tr>
<tr>
<td colspan="2"  align="center" valign="middle" height="40"><input type="submit" name="Submit" id="Submit" class="bgcolor_02" value="Return Issued Goods" onclick="return validateissue();"/></td>
</tr>
<?php
}
?>
</table>
</form>
</td>
<td width="1" class="bgcolor_02"></td>
</tr>
<tr>
<td height="1" colspan="3" class="bgcolor_02"></td>
</tr>
</table>
<?php
}
if($action=='inventory_reports' ){
?>
<script type="text/javascript">
function validatesearch()
{
if(document.getElementById("selectview").value =="") {
document.getElementById("selectviewerror").innerHTML = "Please Select Report Type";
document.getElementById("selectview").focus();
return false;
}
}
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td height="3" colspan="3"></td>
</tr>
<tr>
<td height="25" colspan="3" class="bgcolor_02">&nbsp;&nbsp;<span class="admin">Inventory Reports</span></a></td>
</tr>
<tr>
<td width="1" class="bgcolor_02"></td>
<td  align="left" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td height="10"></td>
</tr>
<tr>
<td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="5" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
if($selectview!="orditems" && $selectview!="grnitems" && $selectview!="ginitems" && $selectview!="rinitems")
{
?>
<script language="javascript" type="text/javascript">
function display_menu(str){
                    
					if (str=='grnlist'){
						document.getElementById("status").style.display="none";
						document.getElementById("status1").style.display="none";
					}else if(str=='ginlist'){
						document.getElementById("status").style.display="none";
						document.getElementById("status1").style.display="inline";
					}else if(str=='pur_ord'){
					  document.getElementById("status").style.display="inline";
					  document.getElementById("status1").style.display="none";
					}
}
</script>
<tr>
<td height="10"></td>
</tr>
<tr>
<td>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
<form action="?pid=7&action=inventory_reports" method="post" name="inventory" id="inventory" >
<tr>
<td width="35%" align="center">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="narmal">Date From : </td>
<td align="right" ><input class="plain" name="dc1" value="<?php if($from!="") {
echo $from;
}?>" size="12" onfocus="this.blur()" readonly="readonly" /></td>
<td align="left" ><a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fStartPop(document.inventory.dc1,document.inventory.dc2);return false;" ><img class="PopcalTrigger" align="absmiddle" src="<?php echo JS_PATH ?>/DateRange/calbtn.gif" width="34" height="22" border="0" alt="" /></a></td>
</tr>
</table>
</td>
<td width="35%" align="center">
<table width="94%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="narmal">Date To : </td>
<td align="right"><input class="plain" name="dc2" value="<?php if($to!="") {
echo $to;
}?>" size="12" onfocus="this.blur()" readonly="readonly" /></td>
<td align="left"> <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fEndPop(document.inventory.dc1,document.inventory.dc2);return false;" ><img class="PopcalTrigger" align="absmiddle" src="<?php echo JS_PATH ?>/DateRange/calbtn.gif" width="34" height="22" border="0" alt="" /></a></td>
</tr>
</table>
</td>
<td align="center" width="30%" class="narmal">

</td>
</tr>
<tr>
<td id="selectviewerror" class="error_message" colspan="3" height="17" align="right" style="padding-right:10px;"></td>
</tr>
<tr>
<td align="left">&nbsp;&nbsp;<select name="selectview" id="selectview" onchange="display_menu(this.value)">
<option value="">--Select Report Type--</option>
<option value="pur_ord" <?php if($selectview=="pur_ord") {
echo "selected";
}?> >Purchase Order</option>
<option value="grnlist" <?php if($selectview=="grnlist") {
echo "selected";
}?> >Goods Receipt Note</option>
<option value="ginlist" <?php if($selectview=="ginlist") {
echo "selected";
}?> >Goods Issue Note</option>
</select></td>
<td align="left" ><select name="status" id="status" style=" <?php if(isset($selectview) && $selectview=='pur_ord'){echo 'display:block';}else{echo 'display:none';}?>"><option value="">--Select--</option><option value="complete" <?php if($status=="complete") {
echo "selected";
}?>>Completed</option><option value="pending" <?php if($status=="pending") {
echo "selected";
}?>>Pending</option></select>
<select name="status1" id="status1" style=" <?php if(isset($selectview) && $selectview=='ginlist'){echo 'display:block';}else{echo 'display:none';}?>">
<option value="">--Select--</option>
<option value="notreturned" <?php if($status1=="notreturned") {echo "selected";}?>>Not Returned</option>
<option value="partialreturned" <?php if($status1=="partialreturned") {echo "selected";}?>>Partial Returned</option>
<option value="returned" <?php if($status1=="returned") {echo "selected";}?>>Returned</option>
</select>
</td>
<td  align="left" style="padding-right:10px;"><input type="submit" name="Search" value="Search" class="bgcolor_02" onclick="return validatesearch();" /></td>
</tr>
</form>
</table>
<iframe width=132 height=142 name="gToday:contrast:agenda.js" id="gToday:contrast:agenda.js" src="<?php echo JS_PATH ?>/DateRange/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>
</td>
</tr>
<tr>
<td height="20"></td>
</tr>
<?php } ?>
<tr>
<td align="center" valign="top">
<?php
$Page_Url = "&Search=Search";
if($from!=""){$Page_Url .= "&from=$from";}
if($to!=""){$Page_Url .= "&to=$to";}
if($selectview!=""){$Page_Url .= "&selectview=$selectview";}
if(isset($Search_Results))
{
if($selectview=="pur_ord")
{
?>
<table width="100%" border="0" cellpadding="1" cellspacing="1">
<tr>
<td colspan="6" height="20" align="left"><?php echo $Disp_PageHead;?></td>
</tr>
<tr class="bgcolor_02">
<td width="10%"  height="20" align="center" class="admin">S.No</td>
<td width="11%" align="center" class="admin">Order No</td>
<td width="18%" align="center" class="admin">Order Date</td>
<td width="34%" align="left" class="admin">Supplier Name</td>
<td width="13%" align="center" class="admin">Order Status</td>
<td width="14%" align="center" class="admin">Action</td>
</tr>
<?php

$rw = 1;
$slno = $start+1;
if(count($Search_Results)>0)
{
foreach($Search_Results as $srchres)
{
if($rw%2==0)
$rowclass = "even";
else
$rowclass = "odd";
?>
<tr class="<?php echo $rowclass;?>">
<td align="center" class="narmal"><?php echo $slno;?></td>
<td align="center" class="narmal"><?php echo $srchres['es_in_ordersid'];?></td>
<td align="center" class="narmal"><?php echo displaydate($srchres['order_date']);?></td>
<td align="left" class="narmal"><?php echo $srchres['in_name'];?></td>
<td align="center" class="narmal"><?php echo ucfirst($srchres['in_ord_status']);?></td>
<td align="center" class="narmal">
<?php if (in_array("13_23", $admin_permissions)) {?>
<a title="View Items" href="<?php  echo buildurl(array('pid'=>$pid, 'action'=>$action, 'selectview'=>'orditems', 'item'=>$srchres['es_in_ordersid']));?>" ><?php echo viewIcon(); ?></a>
<?php }?><?php /*?><?php if (in_array("13_101", $admin_permissions)) {?>
<a title="Edit Items" href="?pid=7&action=edit_purchase_order&item=<?php echo $srchres['es_in_ordersid'].$Page_Url; ?>" ><?php echo editIcon(); ?></a><?php }?><?php */?>
&nbsp;<?php

if($srchres['in_ord_status']=='complete'){?>
<?php if (in_array("13_102", $admin_permissions)) {?>
<a href="?pid=7&action=purchase_goodsreceipt&item=<?php echo $srchres['es_in_ordersid'].$Page_Url; ?>"><img src="images/compare_16.png" border="0" title="Match with Goods Receipt" align="Match with Goods Receipt" /></a><?php }}?>                                                                                                                    </td>
</tr>
<?php
$rw++;
$slno++;
}
?>
<tr>
<td colspan="6" align="center"><?php paginateexte($start, $q_limit, $no_rows, "action=".$action."&column_name=".$orderby."&asds_order=".$asds_order.$searchUrl) ?></td>
</tr>

<tr>
<td colspan="6" align="right"><?php if (in_array("13_103", $admin_permissions)) {?><input type="button" style="display:block;cursor:pointer;" id="printfeedet_t" name="" value="Print Purchase Orders List" onclick="window.open('?pid=7&action=print_purchase_orders<?php echo $searchUrl;?>&item=<?php echo $srchres['es_in_ordersid']; ?>&status=<?php echo $status;?>',null,'width=700,height=500,scrollbars=yes,toolbar=no,directories=no,status=no,menubar=yes,left=140,top=30');"  class="bgcolor_02"  /><?php }?></td>
</tr>
<?php } ?>
</table>
<?php
}
if($selectview=="grnlist")
{
?>
<table width="100%" border="0" cellpadding="1" cellspacing="1">
<tr>
<td colspan="7" height="20" align="left"><?php echo $Disp_PageHead;?></td>
</tr>
<tr class="bgcolor_02">
<td width="10%"  height="20" align="center" class="admin">S.No</td>
<td width="12%" align="center" class="admin">Order No</td>
<td width="15%" align="center" class="admin">Received Date</td>
<td width="20%" align="left" class="admin">Supplier Name</td>
<td width="20%" align="center" class="admin">Bill No.</td>
<td width="13%" align="center" class="admin">Amount</td>
<td width="10%" align="center" class="admin">Action</td>
</tr>
<?php
$rw = 1;
$slno = $start+1;
if(count($Search_Results)>0)
{
foreach($Search_Results as $srchres)
{
if($rw%2==0)
$rowclass = "even";
else
$rowclass = "odd";
?>
<tr class="<?php echo $rowclass;?>">
<td align="center" class="narmal"><?php echo $slno;?></td>
<td align="center" class="narmal"><?php echo $srchres['es_in_ordersid'];?></td>
<td align="center" class="narmal"><?php echo displaydate($srchres['in_rec_date']);?></td>
<td align="left" class="narmal"><?php echo $srchres['in_name'];?></td>
<td align="center" class="narmal"><?php echo ucfirst($srchres['in_rec_bill_no']);?></td>
<td align="center" class="narmal"><?php echo $srchres['in_tot_amnt'];?></td>
<td align="center" class="narmal">
<?php if (in_array("13_23", $admin_permissions)) {?>
<a title="View Items" href="<?php  echo buildurl(array('pid'=>$pid, 'action'=>$action, 'selectview'=>'grnitems', 'item'=>$srchres['es_in_ordersid']));?>" ><?php echo viewIcon(); ?></a>
<?php }?><?php /*if (in_array("13_101", $admin_permissions)) {?>
<a title="Edit Items" href="?pid=7&action=edit_goodsreceipt_order&item=<?php echo $srchres['es_in_ordersid'].$Page_Url; ?>" ><?php echo editIcon(); ?></a><?php } */?>
<?php if (in_array("13_102", $admin_permissions)) {?>		   
<a href="?pid=7&action=purchase_goodsreceipt&item=<?php echo $srchres['es_in_ordersid'].$Page_Url; ?>"><img src="images/compare_16.png" border="0" title="Match with Goods Receipt" align="Match with Goods Receipt" /></a> <?php }?>
</td>
</tr>
<?php
$rw++;
$slno++;
}
?>
<tr>
<td colspan="7" align="center"><?php paginateexte($start, $q_limit, $no_rows, "action=".$action."&column_name=".$orderby."&asds_order=".$asds_order.$searchUrl) ?></td>
</tr>
<tr>
<td colspan="7" align="right"><?php if (in_array("13_103", $admin_permissions)) {?><input type="button" style="display:block;cursor:pointer;" id="printfeedet_t" name="" value="Print Goods Receipt List" onclick="window.open('?pid=7&action=print_purchase_orders<?php echo $searchUrl;?>',null,'width=700,height=500,scrollbars=yes,toolbar=no,directories=no,status=no,menubar=yes,left=140,top=30');"  class="bgcolor_02"  /><?php }?></td>
</tr>
<?php } ?>
</table>
<?php
}
if($selectview=="ginlist")
{
?>
<table width="100%" border="0" cellpadding="1" cellspacing="1">
<tr>
<td colspan="7" height="20" align="left"><?php echo $Disp_PageHead;?></td>
</tr>
<tr class="bgcolor_02">
<td width="10%"  height="20" align="center" class="admin">S.No</td>
<td width="15%" align="center" class="admin">Issued Date</td>
<td width="20%" align="left" class="admin">Issued To</td>
<!--<td width="15%" align="center">Department</td>-->
<td width="10%" align="center" class="admin">Issue Status</td>
<td width="15%" align="center" class="admin">Action</td>
</tr>
<?php
$rw = 1;
$slno = $start+1;
if(count($Search_Results)>0)
{
foreach($Search_Results as $srchres)
{
if($rw%2==0)
$rowclass = "even";
else
$rowclass = "odd";
?>
<tr class="<?php echo $rowclass;?>">
<td align="center" class="narmal"><?php echo $slno;?></td>
<td align="center" class="narmal"><?php echo displaydate($srchres->in_issue_date);?></td>
<td align="left" class="narmal"><?php echo $srchres->in_issue_to;?></td>
<?php /*?> <td align="center"><?php echo $srchres->in_department_id;?></td><?php */?>
<td align="center" class="narmal"><?php if($srchres->in_issue_status=='partialreturned'){echo 'Partial&nbsp;Returned';}
if($srchres->in_issue_status=='notreturned'){echo 'Not&nbsp;Returned';}
if($srchres->in_issue_status=='returned'){echo 'Returned';}
?></td>
<td align="center" class="narmal">
<?php if (in_array("13_23", $admin_permissions)) {?>
<a title="View Issued Items" href="<?php  echo buildurl(array('pid'=>$pid, 'action'=>$action, 'selectview'=>'ginitems', 'item'=>$srchres->es_in_goods_issueId));?>" ><?php echo "Issued Items"; //echo viewIcon(); ?></a> / <br />
<a title="View Returned Items" href="<?php  echo buildurl(array('pid'=>$pid, 'action'=>$action, 'selectview'=>'rinitems', 'item'=>$srchres->es_in_goods_issueId));?>" ><?php echo "Returned Items"; //echo viewIcon(); ?></a>
<?php }?>
</td>
</tr>
<?php
$rw++;
$slno++;
}
?>
<tr>
<td colspan="7" align="center"><?php paginateexte($start, $q_limit, $no_rows, "action=".$action."&column_name=".$orderby."&asds_order=".$asds_order.$searchUrl) ?></td>
</tr>
<tr>
<td colspan="6" align="right"><?php if (in_array("13_103", $admin_permissions)) {?><input type="button" style="display:block;cursor:pointer;" id="printfeedet_t" name="" value="Print Goods Issuenote List" onclick="window.open('?pid=7&action=print_purchase_orders<?php echo $searchUrl;?>',null,'width=700,height=500,scrollbars=yes,toolbar=no,directories=no,status=no,menubar=yes,left=140,top=30');"  class="bgcolor_02"  /><?php }?></td>
</tr>
<?php } ?>

</table>
<?php
}
if($selectview=="orditems")
{
?>
<table width="100%" border="0" cellpadding="1" cellspacing="1">
<tr>
<td colspan="4" height="20" align="left"><?php echo $Disp_PageHead;?></td>
</tr>
<tr>
<td colspan="4" align="left">
<table width="100%" border="0" cellpadding="2" cellspacing="0">
<tr>
<td align="left" width="20%">Ordered Date : </td>
<td align="left" width="80%"><?php echo displayDateAndTime($Search_item->order_date);?></td>
</tr>
<tr>
<td align="left" width="20%">Purchase Order No : </td>
<td align="left" width="80%"><?php echo $item;?></td>
</tr>
<tr>
<td align="left" width="20%">Status : </td>
<td align="left" width="80%"><?php echo $Search_item->in_ord_status;?></td>
</tr>
</table>
</td>
</tr>
<tr>
<td colspan="6" height="10"></td>
</tr>
<tr class="bgcolor_02">
<td width="15%"  height="20" align="center" class="admin">S.No</td>
<td width="30%" align="center" class="admin">Item Code</td>
<td width="30%" align="left" class="admin">Item Name</td>
<td width="25%" align="center" class="admin">Quantity</td>
</tr>
<?php
//array_print($Search_Results);
$rw = 1;
if(count($Search_Results)>0)
{
foreach($Search_Results as $srchres)
{
if($rw%2==0)
$rowclass = "even";
else
$rowclass = "odd";
?>
<tr class="<?php echo $rowclass;?>">
<td align="center" class="narmal"><?php echo $rw;?></td>
<td align="center" class="narmal"><?php echo $srchres['item_code'];?></td>
<td align="left" class="narmal"><?php echo $srchres['item_name'];?></td>
<td align="center" class="narmal"><?php echo $srchres['quantity'];?></td>
</tr>
<?php
$rw++;
}
?>
<tr>
<td colspan="4" height="10">
<input type="button" name="backbtn" value="Back" class="bgcolor_02" onclick="javascript:history.go(-1);" style="cursor:pointer;">&nbsp;&nbsp;&nbsp;<?php if (in_array("13_106", $admin_permissions)) {?><input type="button" style="cursor:pointer;" value="Print Details" onclick="window.open('?pid=7&action=print_purchase_orders<?php echo $searchUrl;?>&item=<?php echo $item; ?>',null,'width=700,height=500,scrollbars=yes,toolbar=no,directories=no,status=no,menubar=yes,left=140,top=30');"  class="bgcolor_02"  /><?php }?>
</td>
</tr>
<?php } ?>
</table>
<?php
}
if($selectview=="grnitems")
{
?>
<table width="100%" border="0" cellpadding="1" cellspacing="1">
<tr>
<td colspan="6" height="20" align="left"><?php echo $Disp_PageHead;?></td>
</tr>
<tr>
<td colspan="6" align="left">
<table width="100%" border="0" cellpadding="2" cellspacing="0">
<tr>
<td align="left" width="23%">Ordered Date : </td>
<td align="left" width="77%"><?php echo displayDateAndTime($Search_item->order_date);?></td>
</tr>
<tr>
<td align="left" width="23%">Goods Receipt Note  No : </td>
<td align="left" width="77%"><?php echo $item;?></td>
</tr>
<tr>
<td align="left" width="23%">Received Date : </td>
<td align="left" width="77%"><?php echo displayDateAndTime($Search_item->in_rec_date);?></td>
</tr>
<tr>
<td align="left" width="23%">Status : </td>
<td align="left" width="77%"><?php echo $Search_item->in_ord_status;?></td>
</tr>
</table>
</td>
</tr>
<tr>
<td colspan="6" height="10"></td>
</tr>
<tr class="bgcolor_02">
<td width="10%"  height="20" align="center" class="admin">S.No</td>
<td width="15%" align="center" class="admin" >Item Code</td>
<td width="20%" align="left" class="admin">Item Name</td>
<td width="15%" align="center" class="admin">Quantity</td>
<td width="20%" align="center" class="admin">Price</td>
<td width="20%" align="center" class="admin">Amount</td>
</tr>
<?php
$rw = 1;
if(count($Search_Results)>0)
{
foreach($Search_Results as $srchres)
{
if($rw%2==0)
$rowclass = "even";
else
$rowclass = "odd";
?>
<tr class="<?php echo $rowclass;?>">
<td align="center" class="narmal"><?php echo $rw;?></td>
<td align="center" class="narmal"><?php echo $srchres['item_code'];?></td>
<td align="left" class="narmal"><?php echo $srchres['item_name'];?></td>
<td align="center" class="narmal"><?php echo $srchres['quantity'];?></td>
<td align="center" class="narmal"><?php echo $srchres['price'];?></td>
<td align="center" class="narmal"><?php echo $srchres['amount'];?></td>
</tr>
<?php
$rw++;
}
?>
<tr class="<?php echo $rowclass;?>">
<td colspan="5" height="30" valign="middle" align="right" >Total Amount :</td>
<td valign="middle" align="center" ><?php echo $Search_item->in_tot_amnt;?></td>
</tr>
<tr>
<td colspan="6" height="10">
<input type="button" name="backbtn" value="Back" class="bgcolor_02" onclick="javascript:history.go(-1);">&nbsp;&nbsp;&nbsp;<?php if (in_array("13_106", $admin_permissions)) {?><input type="button" style="cursor:pointer;" value="Print Details" onclick="window.open('?pid=7&action=print_purchase_orders<?php echo $searchUrl;?>&item=<?php echo $item; ?>',null,'width=700,height=500,scrollbars=yes,toolbar=no,directories=no,status=no,menubar=yes,left=140,top=30');"  class="bgcolor_02"  /><?php }?>																										  </td>
</tr>
<?php } ?>
</table>
<?php
}
if($selectview=="ginitems")
{
?>
<table width="100%" border="0" cellpadding="1" cellspacing="1">
<tr>
<td colspan="7" height="20" align="left"><?php echo $Disp_PageHead;?></td>
</tr>
<tr>
<td colspan="7" align="left">
<table width="100%" border="0" cellpadding="2" cellspacing="0">
<tr>
<td align="left" width="20%">Issued Date : </td>
<td align="left" width="80%"><?php echo displayDateAndTime($Search_item->in_issue_date);?></td>
</tr>
<tr>
<td align="left" width="20%">Issue Note No : </td>
<td align="left" width="80%"><?php echo $item;?></td>
</tr>
<tr>
<td align="left" width="20%">Issued To : </td>
<td align="left" width="80%"><?php echo $Search_item->in_issue_to;?></td>
</tr>
<tr>
<td align="left" width="20%">Status : </td>
<td align="left" width="80%"><?php if($Search_item->in_issue_status=='partialreturned'){echo 'Partial&nbsp;Returned';}
if($Search_item->in_issue_status=='notreturned'){echo 'Not&nbsp;Returned';}
if($Search_item->in_issue_status=='returned'){echo 'Returned';}
?></td>
</tr>
</table>
</td>
</tr>
<tr>
<td colspan="7" height="10"></td>
</tr>
<tr class="bgcolor_02">
<td width="10%"  height="20" align="center" class="admin">S.No</td>
<td width="15%" align="center" class="admin">Item Code</td>
<td width="20%" align="left" class="admin">Item Name</td>
<td width="15%" align="center" class="admin">Quantity</td>
<td width="10%" align="center" class="admin">Returned Qty</td>
</tr>
<?php
$rw = 1;
if(count($Search_Results)>0)
{
foreach($Search_Results as $srchres)
{
if($rw%2==0)
$rowclass = "even";
else
$rowclass = "odd";
?>
<tr class="<?php echo $rowclass;?>">
<td align="center" class="narmal"><?php echo $rw;?></td>
<td align="center" class="narmal"><?php echo $srchres['item_code'];?></td>
<td align="left" class="narmal"><?php echo $srchres['item_name'];?></td>
<td align="center" class="narmal"><?php echo $srchres['quantity'];?></td>
<td align="center" class="narmal">
<?php if($srchres['returned'] > 0) {?>
	<a title="View Returned Items" href="<?php  echo buildurl(array('pid'=>$pid, 'action'=>$action, 'selectview'=>'rinitems', 'item'=>$item));?>" ><?php echo $srchres['returned'];?></a>
<?php } else {
	echo $srchres['returned'];
} ?>
</td>
</tr>
<?php
$rw++;
}
?>
<tr>
<td colspan="7" height="10">
<input type="button" name="backbtn" value="Back" class="bgcolor_02" onclick="javascript:history.go(-1);">&nbsp;&nbsp;&nbsp;<?php if (in_array("13_104", $admin_permissions)) {?><input type="button" style="cursor:pointer;" value="Print Details" onclick="window.open('?pid=7&action=print_purchase_orders<?php echo $searchUrl;?>&item=<?php echo $item; ?>',null,'width=700,height=500,scrollbars=yes,toolbar=no,directories=no,status=no,menubar=yes,left=140,top=30');"  class="bgcolor_02"  /><?php }?>
</td>
</tr>
<?php } ?>
</table>
<?php
}
if($selectview=="rinitems")
{
?>
<table width="100%" border="0" cellpadding="1" cellspacing="1">
<tr>
<td colspan="4" height="20" align="left"><?php echo $Disp_PageHead;?></td>
</tr>
<tr>
<td colspan="4" align="left">
<table width="100%" border="0" cellpadding="2" cellspacing="0">
<tr>
<td align="left" width="22%">Issued Date : </td>
<td align="left" width="78%"><?php echo displayDateAndTime($Search_item->in_issue_date);?></td>
</tr>
<tr>
<td align="left" width="22%">Issue Return Note No : </td>
<td align="left" width="78%"><?php echo $item;?></td>
</tr>
<tr>
<td align="left" width="22%">Issued To : </td>
<td align="left" width="78%"><?php echo $Search_item->in_issue_to;?></td>
</tr>
<tr>
<td align="left" width="22%">Status : </td>
<td align="left" width="78%"><?php echo $Search_item->in_issue_status;?></td>
</tr>
</table>
</td>
</tr>
<tr>
<td colspan="4" height="20"></td>
</tr>
<?php
if(count($Search_Results)>0)
{
foreach($Search_Results as $srchres)
{
?>
<tr>
<td colspan="4" align="left">
<table width="100%" border="0" cellpadding="2" cellspacing="0">
<tr>
	<td align="right" width="20%">Returned Date : </td>
	<td align="left" width="80%"><?php echo displayDateAndTime($srchres['return_date']);?></td>
</tr>
</table>
</td>
</tr>
<tr class="bgcolor_02">
<td width="15%"  height="20" align="center" class="admin">S.No</td>
<td width="30%" align="center" class="admin">Item Code</td>
<td width="30%" align="left" class="admin">Item Name</td>
<td width="25%" align="center" class="admin">Quantity</td>
</tr>
<?php
$srchitem = $srchres['items'];
if($srchitem!="" && count($srchitem) > 0)
{
$rw = 1;
foreach($srchitem as $srcitm)
{
if($rw%2==0)
$rowclass = "even";
else
$rowclass = "odd";
?>
<tr class="<?php echo $rowclass;?>">
<td align="center" class="narmal"><?php echo $rw;?></td>
<td align="center" class="narmal"><?php echo $srcitm['item_code'];?></td>
<td align="left" class="narmal"><?php echo $srcitm['item_name'];?></td>
<td align="center" class="narmal"><?php echo $srcitm['quantity'];?></td>
</tr>
<?php
$rw++;
}
}

}
?>
<tr>
<td colspan="4" height="10">
<input type="button" name="backbtn" value="Back" class="bgcolor_02" onclick="javascript:history.go(-1);">&nbsp;&nbsp;&nbsp;<?php if (in_array("13_105", $admin_permissions)) {?><input type="button" style="cursor:pointer;" value="Print Details" onclick="window.open('?pid=7&action=print_purchase_orders<?php echo $searchUrl;?>&item=<?php echo $item; ?>',null,'width=700,height=500,scrollbars=yes,toolbar=no,directories=no,status=no,menubar=yes,left=140,top=30');"  class="bgcolor_02"  /><?php }?>
</td>
</tr>
<?php } ?>
</table>
<?php
}
if(count($Search_Results)<=0) {
echo "<tr >";
echo "<td align='center' valign='top'><strong>No Data Found</strong></td>";
echo "</tr>";
echo "<tr >";
echo "<td align='center' valign='top'>&nbsp;</td>";
echo "</tr>";
echo "<tr height='20'>";
echo "<td align='center' valign='middle'><input type='button' name='backbtn' value='Back' class='bgcolor_02' onclick='javascript:history.go(-1);'></td>";
echo "</tr>";

}
}

?>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td colspan="4" align="center">&nbsp;</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
<td width="1" class="bgcolor_02"></td>
</tr>
<tr>
<td height="1" colspan="3" class="bgcolor_02"></td>
</tr>
</table>

<?php
}
?>
<?php if($action=='print_purchase_orders'){


?>
<table width="100%" border="0">
<tr>
<td>

</td>
</tr>
<tr>
<td><table width="100%">
<tr>
<td align="center" valign="top">
<?php
if(isset($Search_Results))
{
if($selectview=="pur_ord")
{
$log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,`module`,`submodule`,`record_id`,`action`,`ipaddress`,`posted_on`)
VALUES('".$_SESSION['eschools']['admin_id']."','es_in_orders','INVENTORY','Inventory Reports','','Print Purchase Orders','".$_SERVER['REMOTE_ADDR']."',NOW())";
$log_insert_exe=mysql_query($log_insert_sql);
?>
<table width="100%" border="0" cellpadding="1" cellspacing="1">
<tr>
<td colspan="6" height="20" align="left"><?php echo $Disp_PageHead;?></td>
</tr>
<tr class="bgcolor_02">
<td width="10%"  height="20" align="center" class="admin">S.No</td>
<td width="15%" align="center" class="admin">Order No</td>
<td width="20%" align="center" class="admin">Order Date</td>
<td width="30%" align="left" class="admin">Supplier Name</td>
<td width="15%" align="center" class="admin">Order Status</td>
</tr>
<?php
$rw = 1;
$slno = $start+1;
if(count($Search_Results)>0)
{
foreach($Search_Results as $srchres)
{
if($rw%2==0)
$rowclass = "even";
else
$rowclass = "odd";
?>
<tr class="<?php echo $rowclass;?>">
<td align="center" class="narmal"><?php echo $slno;?></td>
<td align="center" class="narmal"><?php echo $srchres['es_in_ordersid'];?></td>
<td align="center" class="narmal"><?php echo displaydate($srchres['order_date']);?></td>
<td align="left" class="narmal"><?php echo $srchres['in_name'];?></td>
<td align="center" class="narmal"><?php echo ucfirst($srchres['in_ord_status']);?></td>

</tr>
<?php
$rw++;
$slno++;
}
?>



<?php } ?>
</table>
<?php
}
if($selectview=="grnlist")
{
$log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,`module`,`submodule`,`record_id`,`action`,`ipaddress`,`posted_on`)
VALUES('".$_SESSION['eschools']['admin_id']."','es_in_orders','INVENTORY','Inventory Reports','','Print Goods Receipt Note','".$_SERVER['REMOTE_ADDR']."',NOW())";
$log_insert_exe=mysql_query($log_insert_sql);
?>
<table width="100%" border="0" cellpadding="1" cellspacing="1">
<tr>
<td colspan="7" height="20" align="left"><?php echo $Disp_PageHead;?></td>
</tr>
<tr class="bgcolor_02">
<td width="10%"  height="20" align="center" class="admin">S.No</td>
<td width="12%" align="center" class="admin">Order No</td>
<td width="15%" align="center" class="admin">Received Date</td>
<td width="20%" align="left" class="admin">Supplier Name</td>
<td width="20%" align="center" class="admin">Bill No.</td>
<td width="13%" align="center" class="admin">Amount</td>
<?php /*?><td width="10%" align="center" class="admin">Action</td><?php */?>
</tr>
<?php
$rw = 1;
$slno = $start+1;
if(count($Search_Results)>0)
{
foreach($Search_Results as $srchres)
{
if($rw%2==0)
$rowclass = "even";
else
$rowclass = "odd";
?>
<tr class="<?php echo $rowclass;?>">
<td align="center" class="narmal"><?php echo $slno;?></td>
<td align="center" class="narmal"><?php echo $srchres['es_in_ordersid'];?></td>
<td align="center" class="narmal"><?php echo displaydate($srchres['in_rec_date']);?></td>
<td align="left" class="narmal"><?php echo $srchres['in_name'];?></td>
<td align="center" class="narmal"><?php echo ucfirst($srchres['in_rec_bill_no']);?></td>
<td align="center" class="narmal"><?php echo $srchres['in_tot_amnt'];?></td>
<?php /*?><td align="center" class="narmal">
<?php if (in_array("13_23", $admin_permissions)) {?>
<a title="View Items" href="<?php  echo buildurl(array('pid'=>$pid, 'action'=>$action, 'selectview'=>'grnitems', 'item'=>$srchres['es_in_ordersid']));?>" ><?php echo viewIcon(); ?></a>
<?php }?>
</td><?php */?>
</tr>
<?php
$rw++;
$slno++;
}
?>
<tr>
<td colspan="7" align="center"><?php paginateexte($start, $q_limit, $no_rows, "action=".$action."&column_name=".$orderby."&asds_order=".$asds_order.$searchUrl) ?></td>
</tr>
<?php } ?>
</table>
<?php
}
if($selectview=="ginlist")
{
$log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,`module`,`submodule`,`record_id`,`action`,`ipaddress`,`posted_on`)
VALUES('".$_SESSION['eschools']['admin_id']."','es_in_goods_issue','INVENTORY','Inventory Reports','','Print Goods Issue Note','".$_SERVER['REMOTE_ADDR']."',NOW())";
$log_insert_exe=mysql_query($log_insert_sql);
?>
<table width="100%" border="0" cellpadding="1" cellspacing="1">
<tr>
<td colspan="4" height="20" align="left"><?php echo $Disp_PageHead;?></td>
</tr>
<tr class="bgcolor_02">
<td width="17%"  height="20" align="center" class="admin">S.No</td>
<td width="34%" align="center" class="admin">Issued Date</td>
<td width="29%" align="left" class="admin">Issued To</td>
<td width="20%" align="center" class="admin">Issue Status</td>

</tr>
<?php
$rw = 1;
$slno = $start+1;
if(count($Search_Results)>0)
{
foreach($Search_Results as $srchres)
{
if($rw%2==0)
$rowclass = "even";
else
$rowclass = "odd";
?>
<tr class="<?php echo $rowclass;?>">
<td align="center" class="narmal"><?php echo $slno;?></td>
<td align="center" class="narmal"><?php echo displaydate($srchres->in_issue_date);?></td>
<td align="left" class="narmal"><?php echo $srchres->in_issue_to;?></td>

<td align="center" class="narmal"><?php if($srchres->in_issue_status=='partialreturned'){echo 'Partial&nbsp;Returned';}
if($srchres->in_issue_status=='notreturned'){echo 'Not&nbsp;Returned';}
if($srchres->in_issue_status=='returned'){echo 'Returned';}
?></td>

</tr>
<?php
$rw++;
$slno++;
}
?>
<tr>
<td colspan="4" align="center"><?php paginateexte($start, $q_limit, $no_rows, "action=".$action."&column_name=".$orderby."&asds_order=".$asds_order.$searchUrl) ?></td>
</tr>


<?php } ?>
</table>
<?php
}
if($selectview=="orditems")
{
$log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,`module`,`submodule`,`record_id`,`action`,`ipaddress`,`posted_on`)
VALUES('".$_SESSION['eschools']['admin_id']."','es_in_orders','INVENTORY','Inventory Reports','','Print Purchase Order Details','".$_SERVER['REMOTE_ADDR']."',NOW())";
$log_insert_exe=mysql_query($log_insert_sql);
?>
<table width="100%" border="0" cellpadding="1" cellspacing="1">
<tr>
<td colspan="4" height="20" align="left"><?php echo $Disp_PageHead;?></td>
</tr>
<tr>
<td colspan="4" align="left">
<table width="100%" border="0" cellpadding="2" cellspacing="0">
<tr>
<td align="left" width="20%">Ordered Date : </td>
<td align="left" width="80%"><?php echo displayDateAndTime($Search_item->order_date);?></td>
</tr>
<tr>
<td align="left" width="22%">Purchase Order No : </td>
<td align="left" width="78%"><?php echo $item;?></td>
</tr>
<tr>
<td align="left" width="20%">Status : </td>
<td align="left" width="80%"><?php echo $Search_item->in_ord_status;?></td>
</tr>
</table>
</td>
</tr>
<tr>
<td colspan="6" height="10"></td>
</tr>
<tr class="bgcolor_02">
<td width="15%"  height="20" align="center" class="admin">S.No</td>
<td width="30%" align="center" class="admin">Item Code</td>
<td width="30%" align="left" class="admin">Item Name</td>
<td width="25%" align="center" class="admin">Quantity</td>
</tr>
<?php
//array_print($Search_Results);
$rw = 1;
if(count($Search_Results)>0)
{
foreach($Search_Results as $srchres)
{
if($rw%2==0)
$rowclass = "even";
else
$rowclass = "odd";
?>
<tr class="<?php echo $rowclass;?>">
<td align="center" class="narmal"><?php echo $rw;?></td>
<td align="center" class="narmal"><?php echo $srchres['item_code'];?></td>
<td align="left" class="narmal"><?php echo $srchres['item_name'];?></td>
<td align="center" class="narmal"><?php echo $srchres['quantity'];?></td>
</tr>
<?php
$rw++;
}
?>
<tr>
<td colspan="4" height="10">&nbsp;</td>
</tr>
<?php } ?>
</table>
<?php
}
if($selectview=="grnitems")
{
$log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,`module`,`submodule`,`record_id`,`action`,`ipaddress`,`posted_on`)
VALUES('".$_SESSION['eschools']['admin_id']."','es_in_orders','INVENTORY','Inventory Reports','','Print Goods Receipt Details','".$_SERVER['REMOTE_ADDR']."',NOW())";
$log_insert_exe=mysql_query($log_insert_sql);
?>
<table width="100%" border="0" cellpadding="1" cellspacing="1">
<tr>
<td colspan="6" height="20" align="left"><?php echo $Disp_PageHead;?></td>
</tr>
<tr>
<td colspan="6" align="left">
<table width="100%" border="0" cellpadding="2" cellspacing="0">
<tr>
<td align="left" width="24%">Ordered Date : </td>
<td align="left" width="76%"><?php echo displayDateAndTime($Search_item->order_date);?></td>
</tr>
<tr>
<td align="left" width="24%">Goods Receipt Note No : </td>
<td align="left" width="76%"><?php echo $item;?></td>
</tr>
<tr>
<td align="left" width="24%">Received Date : </td>
<td align="left" width="76%"><?php echo displayDateAndTime($Search_item->in_rec_date);?></td>
</tr>
<tr>
<td align="left" width="24%">Status : </td>
<td align="left" width="76%"><?php echo $Search_item->in_ord_status;?></td>
</tr>
</table>
</td>
</tr>
<tr>
<td colspan="6" height="10"></td>
</tr>
<tr class="bgcolor_02">
<td width="10%"  height="20" align="center" class="admin">S.No</td>
<td width="15%" align="center" class="admin" >Item Code</td>
<td width="20%" align="left" class="admin">Item Name</td>
<td width="15%" align="center" class="admin">Quantity</td>
<td width="20%" align="center" class="admin">Price</td>
<td width="20%" align="center" class="admin">Amount</td>
</tr>
<?php
$rw = 1;
if(count($Search_Results)>0)
{
foreach($Search_Results as $srchres)
{
if($rw%2==0)
$rowclass = "even";
else
$rowclass = "odd";
?>
<tr class="<?php echo $rowclass;?>">
<td align="center" class="narmal"><?php echo $rw;?></td>
<td align="center" class="narmal"><?php echo $srchres['item_code'];?></td>
<td align="left" class="narmal"><?php echo $srchres['item_name'];?></td>
<td align="center" class="narmal"><?php echo $srchres['quantity'];?></td>
<td align="center" class="narmal"><?php echo $srchres['price'];?></td>
<td align="center" class="narmal"><?php echo $srchres['amount'];?></td>
</tr>
<?php
$rw++;
}
?>
<tr class="<?php echo $rowclass;?>">
<td colspan="5" height="30" valign="middle" align="right" >Total Amount :</td>
<td valign="middle" align="center" ><?php echo $Search_item->in_tot_amnt;?></td>
</tr>
<tr>
<td colspan="6" height="10">&nbsp;</td>
</tr>
<?php } ?>
</table>
<?php
}
if($selectview=="ginitems")
{
$log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,`module`,`submodule`,`record_id`,`action`,`ipaddress`,`posted_on`)
VALUES('".$_SESSION['eschools']['admin_id']."','es_in_goods_issue','INVENTORY','Inventory Reports','','Print Goods Issue Note','".$_SERVER['REMOTE_ADDR']."',NOW())";
$log_insert_exe=mysql_query($log_insert_sql);
?>
<table width="100%" border="0" cellpadding="1" cellspacing="1">
<tr>
<td colspan="7" height="20" align="left"><?php echo $Disp_PageHead;?></td>
</tr>
<tr>
<td colspan="7" align="left">
<table width="100%" border="0" cellpadding="2" cellspacing="0">
<tr>
<td align="left" width="20%">Issued Date : </td>
<td align="left" width="80%"><?php echo displayDateAndTime($Search_item->in_issue_date);?></td>
</tr>
<tr>
<td align="left" width="22%">Issue Note No : </td>
<td align="left" width="78%"><?php echo $item;?></td>
</tr>
<tr>
<td align="left" width="20%">Issued To : </td>
<td align="left" width="80%"><?php echo $Search_item->in_issue_to;?></td>
</tr>
<tr>
<td align="left" width="20%">Status : </td>
<td align="left" width="80%"><?php if($Search_item->in_issue_status=='partialreturned'){echo 'Partial&nbsp;Returned';}
if($Search_item->in_issue_status=='notreturned'){echo 'Not&nbsp;Returned';}
if($Search_item->in_issue_status=='returned'){echo 'Returned';}
?></td>
</tr>
</table>
</td>
</tr>
<tr>
<td colspan="7" height="10"></td>
</tr>
<tr class="bgcolor_02">
<td width="10%"  height="20" align="center" class="admin">S.No</td>
<td width="15%" align="center" class="admin">Item Code</td>
<td width="20%" align="left" class="admin">Item Name</td>
<td width="15%" align="center" class="admin">Quantity</td>
<td width="10%" align="center" class="admin">Returned Qty</td>
</tr>
<?php
$rw = 1;
if(count($Search_Results)>0)
{
foreach($Search_Results as $srchres)
{
if($rw%2==0)
$rowclass = "even";
else
$rowclass = "odd";
?>
<tr class="<?php echo $rowclass;?>">
<td align="center" class="narmal"><?php echo $rw;?></td>
<td align="center" class="narmal"><?php echo $srchres['item_code'];?></td>
<td align="left" class="narmal"><?php echo $srchres['item_name'];?></td>
<td align="center" class="narmal"><?php echo $srchres['quantity'];?></td>
<td align="center" class="narmal">
<?php if($srchres['returned'] > 0) {?>
<a title="View Returned Items" href="<?php  echo buildurl(array('pid'=>$pid, 'action'=>$action, 'selectview'=>'rinitems', 'item'=>$item));?>" ><?php echo $srchres['returned'];?></a>
<?php } else {
echo $srchres['returned'];
} ?>
</td>
</tr>
<?php
$rw++;
}
?>
<tr>
<td colspan="7" height="10">&nbsp;</td>
</tr>
<?php } ?>
</table>
<?php
}
if($selectview=="rinitems")
{
$log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,`module`,`submodule`,`record_id`,`action`,`ipaddress`,`posted_on`)
VALUES('".$_SESSION['eschools']['admin_id']."','es_in_goods_issue','INVENTORY','Inventory Reports','','Print Goods Issue Return Note','".$_SERVER['REMOTE_ADDR']."',NOW())";
$log_insert_exe=mysql_query($log_insert_sql);
?>
<table width="100%" border="0" cellpadding="1" cellspacing="1">
<tr>
<td colspan="4" height="20" align="left"><?php echo $Disp_PageHead;?></td>
</tr>
<tr>
<td colspan="4" align="left">
<table width="100%" border="0" cellpadding="2" cellspacing="0">
<tr>
<td align="left" width="20%">Issued Date : </td>
<td align="left" width="80%"><?php echo displayDateAndTime($Search_item->in_issue_date);?></td>
</tr>
<tr>
<td align="left" width="22%">Issue Return Note No : </td>
<td align="left" width="78%"><?php echo $item;?></td>
</tr>
<tr>
<td align="left" width="20%">Issued To : </td>
<td align="left" width="80%"><?php echo $Search_item->in_issue_to;?></td>
</tr>
<tr>
<td align="left" width="20%">Status : </td>
<td align="left" width="80%"><?php echo $Search_item->in_issue_status;?></td>
</tr>
</table>
</td>
</tr>
<tr>
<td colspan="4" height="20"></td>
</tr>
<?php
if(count($Search_Results)>0)
{
foreach($Search_Results as $srchres)
{
?>
<tr>
<td colspan="4" align="left">
<table width="100%" border="0" cellpadding="2" cellspacing="0">
<tr>
<td align="right" width="20%">Returned Date : </td>
<td align="left" width="80%"><?php echo displayDateAndTime($srchres['return_date']);?></td>
</tr>
</table>
</td>
</tr>
<tr class="bgcolor_02">
<td width="15%"  height="20" align="center" class="admin">S.No</td>
<td width="30%" align="center" class="admin">Item Code</td>
<td width="30%" align="left" class="admin">Item Name</td>
<td width="25%" align="center" class="admin">Quantity</td>
</tr>
<?php
$srchitem = $srchres['items'];
if($srchitem!="" && count($srchitem) > 0)
{
$rw = 1;
foreach($srchitem as $srcitm)
{
if($rw%2==0)
$rowclass = "even";
else
$rowclass = "odd";
?>
<tr class="<?php echo $rowclass;?>">
<td align="center" class="narmal"><?php echo $rw;?></td>
<td align="center" class="narmal"><?php echo $srcitm['item_code'];?></td>
<td align="left" class="narmal"><?php echo $srcitm['item_name'];?></td>
<td align="center" class="narmal"><?php echo $srcitm['quantity'];?></td>
</tr>
<?php
$rw++;
}
}

}
?>
<tr>
<td colspan="4" height="10">&nbsp;</td>
</tr>
<?php } ?>
</table>
<?php
}
if(count($Search_Results)<=0) {
echo "<tr >";
echo "<td align='center' valign='top'><strong>No Data Found</strong></td>";
echo "</tr>";
echo "<tr >";
echo "<td align='center' valign='top'>&nbsp;</td>";
echo "</tr>";
echo "<tr height='20'>";
echo "<td align='center' valign='middle'><input type='button' name='backbtn' value='Back' class='bgcolor_02' onclick='javascript:history.go(-1);'></td>";
echo "</tr>";

}
}

?>
</td>
</tr>
</table>
</td>
</tr>
</table>


<?php }?>

<?php if($action=='edit_purchase_order'){?>
<script>
function validate()
{
var co=document.getElementsByTagName('input');
for(var i=0;i<co.length;i++)
{
if(co[i].type=='text')
{
if(parseInt(co[i].value)<=0)
{
alert('Enter Valid Number')
return false;
}
}
}
}
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">


<tr>
<td height="3" colspan="3"></td>
</tr>		  
<tr>
<td height="25" colspan="3" class="bgcolor_02">&nbsp;&nbsp;<span class="admin">Edit Purchase Order </span></td>
</tr>	
<tr>
<td width="1" class="bgcolor_02"></td>
<td align="center" valign="top"><form method="post" action="" onsubmit="return validate()">
<table width="100%" border="0">
<?php if(count($pdetails)>=1){
foreach($pdetails as $eachrecord){

$item_det = $db->getrow("SELECT * FROM `es_in_item_master` WHERE `es_in_item_masterid`=" . $eachrecord['item_name']);

?>
<tr>
<td width="34%" align="right"><?php echo $item_det['in_item_name'];?>[<?php echo $item_det['in_item_code'];?>]</td>

<td width="1%">:</td>
<td width="65%"><input type="text" name="item_<?php echo $eachrecord['slno'];?>" value="<?php if(!$_POST){echo $eachrecord['quantity']; }else{echo $_POST['item_'. $eachrecord['slno']];}?>" /></td>
</tr>
<?php }?>

<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input  type="submit" name="update_purchase" value="Update" class="bgcolor_02" style="cursor:pointer;" /></td>
</tr>
<?php }else{?>
<tr>
<td colspan="3" align="center"> No Records Found</td>
</tr>
<?php }?>
</table>

</form>	

</td>
<td width="1" class="bgcolor_02"></td>
</tr>      
<tr><td colspan="3" class="bgcolor_02" height="1"></td></tr>   
</table>
<?php }?>
<?php if($action=='edit_goodsreceipt_order'){?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">


<tr>
<td height="3" colspan="3"></td>
</tr>		  
<tr>
<td height="25" colspan="3" class="bgcolor_02">&nbsp;&nbsp;<span class="admin">Edit Goods Receipt Note </span></td>
</tr>	
<tr>
<td width="1" class="bgcolor_02"></td>
<td align="center" valign="top"><form method="post" action="">
<table width="100%" border="0">
<?php if(count($pdetails)>=1){
foreach($pdetails as $eachrecord){

$item_det = $db->getrow("SELECT * FROM `es_in_item_master` WHERE `es_in_item_masterid`=" . $eachrecord['item_name']);

?>
<tr>
<td width="24%" align="right"><?php echo $item_det['in_item_name'];?>[<?php echo $item_det['in_item_code'];?>]</td>

<td width="1%">:</td>
<td width="23%"><input type="text" name="item_<?php echo $eachrecord['slno'];?>" value="<?php if(!$_POST){echo $eachrecord['quantity']; }else{echo $_POST['item_'. $eachrecord['slno']];}?>" size="15" /></td>
<td width="52%"><input type="text" name="price_<?php echo $eachrecord['slno'];?>" value="<?php if(!$_POST){echo $eachrecord['price']; }else{echo $_POST['price_'. $eachrecord['slno']];}?>" size="15" /></td>
</tr>
<?php }?>

<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td colspan="2"><input  type="submit" name="update_goodsreceipt" value="Update" class="bgcolor_02" style="cursor:pointer;" /></td>
</tr>
<?php }else{?>
<tr>
<td colspan="4" align="center"> No Records Found</td>
</tr>
<?php }?>
</table>

</form>	

</td>
<td width="1" class="bgcolor_02"></td>
</tr>      
<tr><td colspan="3" class="bgcolor_02" height="1"></td></tr>   
</table>
<?php }?>
<?php if($action=='purchase_goodsreceipt' || $action=='print_purchase_goodsreceipt'){
if($action=='print_purchase_goodsreceipt'){ 
$log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,`module`,`submodule`,`record_id`,`action`,`ipaddress`,`posted_on`)
VALUES('".$_SESSION['eschools']['admin_id']."','es_in_orders','INVENTORY','Inventory Reports','','Print Compare','".$_SERVER['REMOTE_ADDR']."',NOW())";
$log_insert_exe=mysql_query($log_insert_sql);}

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">


<tr>
<td height="3" colspan="3"></td>
</tr>		  
<tr>
<td height="25" colspan="3" class="bgcolor_02">&nbsp;&nbsp;<span class="admin">Purchase Order and Goods Receipt Details </span></td>
</tr>	
<tr>
<td width="1" class="bgcolor_02"></td>
<td align="center" valign="top">
<table width="100%" border="0" cellpadding="1" cellspacing="1">

<tr>
<td colspan="5" align="left">
<table width="100%" border="0" cellpadding="2" cellspacing="0">
<tr>
<td align="left" width="284">Ordered Date : </td>
<td align="left" width="916"><?php echo func_date_conversion("Y-m-d","d/m/Y",$details['order_date']);?></td>
</tr>
<tr>
<td align="left" >Purchase Order No : </td>
<td align="left" width="916"><?php echo $item;?></td>
</tr>
<tr>
<td align="left" >Goods Receipt Note No : </td>
<td align="left" width="916"><?php echo $details['in_rec_note_no'];?></td>
</tr>
<tr>
<td align="left" >Received Date : </td>
<td align="left" width="916"><?php echo func_date_conversion("Y-m-d H:i:s","d/m/Y H:i:s",$details['in_rec_date']);?></td>
</tr>
<tr>
<td align="left" >Supplier Name: </td>
<td align="left" width="916"><?php 
$sname = $db->getone("SELECT in_name FROM es_in_supplier_master WHERE es_in_supplier_masterid=".$details['in_suplier_name']);
echo ucwords($sname) ;?></td>
</tr>


</table>
</td>
</tr>
<tr>
<td colspan="5" height="10"></td>
</tr>
<tr class="bgcolor_02">
<td width="12%"  height="20" align="center" class="admin">S.No</td>
<td width="15%" align="center" class="admin">Item Code</td>
<td width="28%" align="center" class="admin">Item Name</td>
<td width="19%" align="center" class="admin">Ordered Quantity</td>
<td width="26%" align="center" class="admin">Received Quantity</td>
</tr>
<?php
//array_print($Search_Results);
$rw = 1;
if(count($pdetails )>0)
{
foreach($pdetails  as $eachrecord)
{
if($rw%2==0)
$rowclass = "even";
else
$rowclass = "odd";
$item_det = $db->getrow("SELECT * FROM `es_in_item_master` WHERE `es_in_item_masterid`=" . $eachrecord['item_name']);
?>
<tr class="<?php echo $rowclass;?>">
<td align="center" class="narmal"><?php echo $rw;?></td>
<td align="center" class="narmal"><?php echo $item_det['in_item_code'];?></td>
<td align="center" class="narmal"><?php echo $item_det['in_item_name'];?></td>
<td align="center" class="narmal"><?php echo $eachrecord['quantity'];?></td>
<td align="center" class="narmal"><?php
if(count($gdetails)>=1){
foreach($gdetails  as $each){
if($each['item_name']==$eachrecord['item_name']){echo $each['quantity'];}
}
}
?></td>
</tr>
<?php
$rw++;
}
}
?>
<?php if($action!='print_purchase_goodsreceipt'){?>
<tr>
<td colspan="5" height="10">
<input type="button" name="backbtn" value="Back" class="bgcolor_02" onclick="javascript:history.go(-1);" style="cursor:pointer;">&nbsp;&nbsp;&nbsp;<input type="button" style="cursor:pointer;" value="Print Details" onclick="window.open('?pid=7&action=print_purchase_goodsreceipt<?php echo $searchUrl;?>&item=<?php echo $item; ?>',null,'width=700,height=500,scrollbars=yes,toolbar=no,directories=no,status=no,menubar=yes,left=140,top=30');"  class="bgcolor_02"  />
</td>
</tr>
<?php }?>

</table>	

</td>
<td width="1" class="bgcolor_02"></td>
</tr>      
<tr><td colspan="3" class="bgcolor_02" height="1"></td></tr>   
</table>
<?php }?>
<?php if($action=='goods_issue_requests')
{
	include'goods_issue_requests.php';
}
?>
<?php if($action=='view_request')
{
	include'view_request.php';
}
?>
<?php if($action=='ajax_grn')
{
	include'ajax_grn.php';
}
?>
<?php if($action=='editcategory')
{
	include'edit_category.php';
}
?>
<?php if($action=='quotation')
{
	include'quotation.php';
}
?>
<?php if($action=='quotation_request')
{
	include'quotation_request.php';
}
?>
<?php if($action=='goods_issue_note')
{
	include'goods_issue_note.php';
}
?>
<?php if($action=='reject_request')
{
	mysqli_query($mysqli_con, "UPDATE es_in_goods_issue_requests SET status = 'Rejected' WHERE es_in_goods_issueid =".$_GET['request_id']);
	header('Location: ?pid=7&action=goods_issue_requests');
}
?>
<?php if($action=='request_detail')
{
	include'request_detail.php';
}
?>
<?php if($action=='goods_issue_notes')
{
	include'goods_issue_notes.php';
}
?>
<?php if($action=='delete_gin')
{
	$request_id = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT request_id FROM es_in_goods_issue WHERE es_in_goods_issueid =".$_GET['gin_id']), MYSQLI_NUM);

	mysqli_query($mysqli_con,"UPDATE es_in_goods_issue_requests SET status='Rejected' WHERE es_in_goods_issueid=".$request_id[0]);

	$rows = mysqli_query($mysqli_con,"SELECT * FROM es_in_goods_issue_items WHERE es_in_goods_issue_id=".$_GET['gin_id']);
	while($row = mysqli_fetch_assoc($rows))
	{
		if($row['status'] == 'NOT RETURNED')
		{
			mysqli_query($mysqli_con, "UPDATE es_in_item_master SET in_qty_available = in_qty_available + ".$row['qty']." WHERE es_in_item_masterid=".$row['item_id']);
			echo "UPDATE es_in_item_master SET in_qty_available = in_qty_available + ".$row['qty']." WHERE es_in_item_masterid=".$row['item_id']."<br>";
		}
		mysqli_query($mysqli_con, "DELETE FROM es_in_goods_issue_items WHERE es_in_goods_issue_item_id=".$row['es_in_goods_issue_item_id']);
	}
	mysqli_query($mysqli_con, "DELETE FROM es_in_goods_issue WHERE es_in_goods_issueid =".$_GET['gin_id']);
	header('Location: ?pid=7&action=goods_issue_notes');
}
?>
<?php if($action=='purchase_orders_detail')
{
	include'purchase_orders_detail.php';
}
?>
<?php if($action=='edit_order')
{
	include'edit_order.php';
}
?>
<?php if($action=='make_grn')
{
	include'make_grn.php';
}
?>
<?php if($action=='goods_reciept_notes')
{
	include'goods_reciept_notes.php';
}
?>
<?php if($action=='supplier_payment')
{
	include'supplier_payment.php';
}
?>
<?php if($action=='supplier_payment_detail')
{
	include'supplier_payment_detail.php';
}
?>
<?php if($action=='supplier_payments')
{
	include'supplier_payments.php';
}
?>
<?php if($action=='edit_payment')
{
	include'edit_payment.php';
}
?>
<?php if($action=='edit_item')
{
	include'edit_item.php';
}
?>






