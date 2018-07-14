<?php
sm_registerglobal('pid','action','update','emsg','start','column_name','asds_order','uid','sid','admin',
'Submit','blogDesc','title','es_date','subject', 'update','nid');
/**
* Only Admin users can view the pages
*/

$notice_view = get_all_results('es_notice',$order_by ='es_date', $order ='desc');	

if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" ) {
	header('location: ./?pid=1&unauth=0');
	exit;
}

if(isset($_POST['submit']))
{
	$data = $_POST['data'];

	insert_into('es_notice',$data);
	header('location: ./?pid=37&action=noticeboard');
	exit;

}
if($_GET['deletnoticeid'])
{
	 $notice_id = $_GET['deletnoticeid'];
	$del_not ="delete from es_notice where es_noticeid='".$notice_id."'";
	mysqli_query($mysqli_con, $del_not);
	header('location: ./?pid=37&action=noticeboard');
	exit;
}
if(isset($_POST['updatesubmit']))
{
	$notice_id = $_GET['editnotice'];
	$data=$_POST['data'];
	$update = update_where('es_notice', $data,$arrayName = array('es_noticeid' =>$notice_id ));
	header('location: ./?pid=37&action=noticeboard');
	exit;
}

 ?>
 	

