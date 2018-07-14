<?php
	if(isset($_POST['categoryupdate']))
	{
		mysqli_query($mysqli_con, "UPDATE `es_in_category` SET `in_category_name`='".$_POST['in_category_name']."',`in_description`='".$_POST['in_description']."' WHERE `es_in_categoryid`=".$_POST['category_id']);
		header('Location: ?pid=7&action=addcategory');
		exit;
	}

	if(isset($_GET['delete']))
	{
		mysqli_query($mysqli_con, "UPDATE `es_in_category` SET `status`='deleted' WHERE `es_in_categoryid`=".$_GET['delete']);
		header('Location: ?pid=7&action=addcategory');
		exit;
	}


	$category = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_in_category WHERE es_in_categoryid".$_GET['q']), MYSQLI_ASSOC)
?>
				
													<input type="hidden" name="category_id" value="<?php echo $category['es_in_categoryid']; ?>">
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
														<label><b>Category Name</b></label>
														<input type="text" name="in_category_name" class="form-control" required="required" value="<?php echo $category['in_category_name']; ?>" />
													</div>

													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
														<label><b>Description</b></label>
														<textarea class="form-control" name="in_description" required="required"><?php echo $category['in_description']; ?></textarea>
													</div>