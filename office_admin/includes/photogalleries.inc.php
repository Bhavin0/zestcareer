<?php

sm_registerglobal('pid', 'action','emsg','addphoto','image_path','title','id','status','start','hiddenimage','updatephoto','actionedit','album_cover','new_album_cover','addalbum','addphototoalbm','addalbums','apid','backtoalbum','starttwo','back');

/**
* Only Admin users can view the pages
*/
if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" ) {
	header('location: ./?pid=1&unauth=0');
	exit;
}

if(isset($_POST['add_album']))
{
	$data = $_POST['data'];
	$data['photo_gallery_date'] = date('Y-m-d');
	$photo_galleryid = insert_into('photo_gallery', $data);

	if (!file_exists('../uploads/photo_gallery/'.$photo_galleryid)) {
    	mkdir('../uploads/photo_gallery/'.$photo_galleryid);
	}

	move_uploaded_file($_FILES["album_cover"]["tmp_name"], '../uploads/photo_gallery/'.$photo_galleryid.'/album_cover.jpg');

	header('Location: ?pid=54&action=upload_photos&album_id='.$photo_galleryid);
}

if(isset($_POST['upload']))
{
	$data = $_POST['data'];
	$data['photo_gallery_id'] = $_GET['album_id'];
	$data['image_date'] = date('Y-m-d');
	$photo_gallery_imageid = insert_into('photo_gallery_images', $data);

	if (!file_exists('../uploads/photo_gallery/'.$_GET['album_id'])) {
    	mkdir('../uploads/photo_gallery/'.$_GET['album_id']);
	}

	move_uploaded_file($_FILES["image"]["tmp_name"], '../uploads/photo_gallery/'.$_GET['album_id'].'/'.$photo_gallery_imageid.'.jpg');

	header('Location: ?pid=54&action=upload_photos&album_id='.$_GET['album_id']);
}

if($_GET['action'] == 'remove_img')
{
	delete_where('photo_gallery_images', array('photo_gallery_imageid' => $_GET['img_id']));
	if(file_exists('../uploads/photo_gallery/'.$_GET['album_id'].'/'.$_GET['img_id'].'.jpg'))
	{
		unlink('../uploads/photo_gallery/'.$_GET['album_id'].'/'.$_GET['img_id'].'.jpg');
	}
}

if(isset($_POST['update_album']))
{
	$data = $_POST['data'];
	update_where('photo_gallery', $data, array('photo_galleryid' => $_GET['album_id']));

	if(isset($_FILES["album_cover"]["tmp_name"]) && $_FILES["album_cover"]["tmp_name"] != '')
	{
		if(file_exists('../uploads/photo_gallery/'.$photo_galleryid.'/album_cover.jpg'))
		{
			unlink('../uploads/photo_gallery/'.$photo_galleryid.'/album_cover.jpg');
		}

		move_uploaded_file($_FILES["album_cover"]["tmp_name"], '../uploads/photo_gallery/'.$_GET['album_id'].'/album_cover.jpg');
	}

	for($i=0; $i<count($_POST['image_id']); $i++) {
		$image['image_name'] = $_POST['image']['image_name'][$i];
		$image['image_description'] = $_POST['image']['image_description'][$i];
		update_where('photo_gallery_images', $image, array('photo_gallery_imageid' => $_POST['image_id'][$i]));
	}

	header('Location: ?pid=54&action=upload_photos&album_id='.$_GET['album_id']);
	exit;
}

if($_GET['action'] == 'delete_album')
{
	delete_where('photo_gallery', array('photo_galleryid' => $_GET['album_id']));
	header('Location: ?pid=54&action=album_list');
	exit;
}
?>