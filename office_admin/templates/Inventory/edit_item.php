<?php
	$item = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_in_item_master WHERE es_in_item_masterid = ".$_GET['q']), MYSQLI_ASSOC);
?>

<input type="hidden" name="item_id" value="<?php echo $_GET['q']; ?>">
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
	<label><b>Item Code.</b></label>
	<input class="form-control" type="text" name="in_item_code" value="<?php echo $item['in_item_code']; ?>">
</div>

<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 form-group">
	<label><b>Item Name</b></label>
	<input type="text" name="in_item_name" class="form-control" value="<?php echo $item['in_item_name']; ?>">
</div>

<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
	<label><b>Inventory Type</b></label>
	<select name="in_inventory_id" class="form-control">
		<option value="Returnable Goods">Returnable Goods</option>
		<option value="Non-returnable Goods" <?php echo ($item['in_inventory_id']=='Non-returnable Goods')?'selected':''; ?>>Non-returnable Goods</option>
	</select>
</div>

<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
	<label><b> Category </b></label>
	<select name="in_category_id" class="form-control">
		<option value="">Select Category</option>
		<?php if (count($category_json)>0){		
		for($i = 0; $i < count($category_json); $i++){
			$selected = ($item['in_category_id']==$category_json[$i]['es_in_categoryid'])?'selected':'';
		 ?>                               
		<option value="<?php  echo $category_json[$i]['es_in_categoryid']; ?>" <?php echo $selected; ?>>
			<?php echo $category_json[$i]['in_category_name']; ?>
		</option>
		<?php }
		} ?>										
	</select>
</div>

<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
	<label><b> Unit </b></label>
	<input type="text" name="in_units" value="<?php echo $item['in_units']; ?>" class="form-control" />
</div>

<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
	<label><b> Sales Price </b></label>
	<input type="number" name="cost" value="<?php echo $item['cost']; ?>" class="form-control" min="0" />
</div>

<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
	<label><b> Qty in hand </b></label>
	<input type="number" name="in_qty_available" value="<?php echo $item['in_qty_available']; ?>" class="form-control" min="0" />
</div>

<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
	<label><b> Re-order level </b></label>
	<input type="number" name="in_reorder_level" value="<?php echo $item['in_reorder_level']; ?>" class="form-control" />
</div>