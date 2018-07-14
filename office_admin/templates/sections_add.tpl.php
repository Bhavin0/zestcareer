<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
<header>
	<span>
		<b>CLASS SECTIONS</b>
	</span>
</header>
<section>
	<form action='' method='post'>
		<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<label>Class Section</label>
			<input type='text' name='section_name' class="form-control" value='<?php echo $section_name; ?>'  />
		</div>

		<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
			<label></label>
	 		<?php if($action!='edit'){ ?>
	 		<input type='submit' class="form-control btn btn-info" name='addsection' value='Submit' class="bgcolor_02"/>
	 		<?php } else {?>
	 		<input type='submit' class="form-control btn btn-info" name='addsection' value='Update' class="bgcolor_02"/>
	 		<?php } ?>
		</div>
	</form>

	<table class="table table-hover table-striped table-bordered">
		<thead>
			<tr>
	 			<th>S.No</th>
	 			<th>Section</th>
	 			<th>Created On</th>
	 			<th>Action</th>
	 		</tr>
		</thead>
		<tbody>
			<?php if(is_array($sections_array) && count($sections_array)>0){
	 		$i=1;
	 		foreach($sections_array as $each_section)
	 		{
	 			$class=($i%2==0)?'even':'odd';
	 		?>
	 		<tr>
	 			<td><?php echo $i; ?></td>
	 			<td><?php echo ucfirst($each_section['section_name']);?></td>
	 			<td><?php echo func_date_conversion('Y-m-d','d-m-Y',$each_section['created_on']);?></td>
	 			<td><a href="?pid=97&action=edit&section_id=<?php echo $each_section['section_id']; ?>">
	 				<img src="images/b_edit.png" border="0" /></a>
	 				<?php
	 				$count_student=$db->getOne("SELECT COUNT(*) FROM es_sections_student WHERE section_id=".$each_section['section_id']);
	 				if($count_student==0)
	 				{
	 				?>
      				<a href=" ?pid=97&action=delete&section_id=<?php echo $each_section['section_id']; ?>" onClick="return confirm('Are you sure you want to delete Section?')"><img src="images/b_drop.png" border="0" /></a>&nbsp;
	 				<?php } else { ?>
					<img src="images/b_drop.png" border="0" onclick='Javascript:alert("Sorry! It has some data");'/>
	 				<?php } ?>
	 			</td>
	 		</tr>
	 		<?php
	 		$i++; }} else {?>
			<tr>
	 			<td colspan="4" style="font-size:12px; color:#FF0000; font-weight:bold;"> No Records Found</td>
	 		</tr>
	 		<?php } ?>
		</tbody>
	</table>
</section>
</div>
     
