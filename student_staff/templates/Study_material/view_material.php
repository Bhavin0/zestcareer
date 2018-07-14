<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>View Material</title>
        <meta name="description" content="" />
        <meta name="Author" content="" />

        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
        <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
		
		<!-- THEME CSS -->
		<link href="<?php echo base_url('assets/css/essentials.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/layout.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/color_scheme/green.css'); ?>" rel="stylesheet" type="text/css" />

		<!-- FOOTABLE TABLE -->
		<link href="<?php echo base_url('assets/plugins/footable/css/footable.core.min.css'); ?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/plugins/footable/css/footable.standalone.css'); ?>" rel="stylesheet" type="text/css" />
		<!--
			Minimal footable skin 
			1. remove footable.standalone.css skin first
			2. add .fooMinimal to the footable table
			<link href="assets/css/layout-footable-minimal.css" rel="stylesheet" type="text/css" /> 
		-->
	</head>
	<!--
		.boxed = boxed version
	-->
	<body><?php
        include(TEMPLATES_PATH . DS . 'leftmenu.tpl.php');
        include(TEMPLATES_PATH . DS . 'header_new.tpl.php');
        ?>


			<!-- 
				MIDDLE 
			-->
			<section id="middle">


				<header id="page-header">
                    <ol class="breadcrumb">
                        <li>
                            <b> Academic Year : </b>
                            <?php if($res_year['fi_ac_startdate']!=""){ echo displaydate($res_year['fi_ac_startdate']);?> to <?php echo displaydate($res_year['fi_ac_enddate']); } else { echo "---"; }?>
                        </li>
                    </ol>
                </header>


				<div id="content" class="padding-20">

					<!-- 
						PANEL CLASSES:
							panel-default
							panel-danger
							panel-warning
							panel-info
							panel-success

						INFO: 	panel collapse - stored on user localStorage (handled by app.js _panels() function).
								All pannels should have an unique ID or the panel collapse status will not be stored!
					-->
					<div id="panel-1" class="panel panel-primary">
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>Material</strong> <!-- panel title -->
							</span>

							<!-- right options -->
							<ul class="options pull-right list-inline">
								<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
								<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
								<li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
							</ul>
							<!-- /right options -->

						</div>

						<!-- panel content -->
						<div class="panel-body">

							<label><!-- PER PAGE SELECTOR . you can move it to panel-heading -->
								<select class="form-control pointer" id="change-page-size">
									<option value="2">2 / page</option>
									<option value="3">3 / page</option>
									<option value="5">5 / page</option>
									<option value="10" selected="selected">10 / page</option>
									<option value="15">15 / page</option>
									<option value="20">20 / page</option>
								</select>
							</label><!-- /PER PAGE SELECTOR -->

							<table class="fooTableInit"><!-- add .fooMinimal for minimal skin and remove foo css theme (footable.standalone.css) -->
								<thead>
								  <tr>
								  	<th data-hide = "s300">SR.</th>
								  	<th data-hide = "s300">DATE</th>
								  	<th data-hide = "s300">CLASS</th>
								  	<th data-hide = "s300">SUBJECT</th>
								  	<th class="foo-cell">TITLE</th>
								  	<th data-hide = "s300">CREATED BY</th>
								  	<th data-hide = "s300">ACTION</th>
								  </tr>
								</thead>

								<tbody>
								<?php $i = 1; while($material = mysqli_fetch_assoc($materials)) { ?>
									<tr>
										<td><?php echo $i++; ?></td>
										<td class="foo-cell"> <?php echo YMDtoDMY($material['sm_createdon']); ?> </td>
										<td><?php echo $material['es_classname']; ?></td>
										<td><?php echo $material['es_subjectname']; ?></td>
										<td><?php echo $material['sm_name']; ?></td>
										<td><?php echo $material['person_created']; ?></td>
										<td>
											<a href="?pid=36&action=view_material_detail&studymaterialid=<?php echo $material['es_studymaterialid']; ?>" class="btn btn-info btn-xs">&nbsp;<i class="fa fa-eye"></i></a>
											<a href="?pid=36&action=edit_material&studymaterialid=<?php echo $material['es_studymaterialid']; ?>" class="btn btn-warning btn-xs">&nbsp;<i class="fa fa-pencil-square-o"></i></a>
											<a href="?pid=36&action=delete_material&studymaterialid=<?php echo $material['es_studymaterialid']; ?>" onclick="return confirm('are you sure? you want to delete it?')" class="btn btn-danger btn-xs">&nbsp;<i class="fa fa-trash-o"></i></a>
										</td>
									</tr>
								<?php } ?>
								</tbody>
								<tfoot class="hide-if-no-paging">
								  	<tr>
								    <td colspan="7" class="text-center">
								        <ul class="pagination pull-right">
								        </ul>
								    </td>
								  </tr>
								</tfoot>

							</table>


						</div>
						<!-- /panel content -->

						<!-- panel footer -->
						<div class="panel-footer">

<!-- pre code -->



						</div>
						<!-- /panel footer -->

					</div>
					<!-- /PANEL -->

				</div>
			</section>
			<!-- /MIDDLE -->

		</div>



	
		<!-- JAVASCRIPT FILES -->
		<script type="text/javascript">var plugin_path = "<?php echo base_url('assets/plugins/'); ?>";</script>
		<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>

		<!-- PAGE LEVEL SCRIPTS -->
		<script type="text/javascript">
			loadScript(plugin_path + "footable/dist/footable.min.js", function(){
				loadScript(plugin_path + "footable/dist/footable.sort.min.js", function(){
					loadScript(plugin_path + "footable/dist/footable.paginate.min.js", function(){ /** remove if pagination not needed **/

						// footable
						var $ftable = jQuery('.fooTableInit');


						/** 01. FOOTABLE INIT
						******************************************* **/
						$ftable.footable({
							breakpoints: {
								s300: 300,
								s600: 600
							}
						});


						/** 01. PER PAGE SWITCH
						******************************************* **/
						jQuery('#change-page-size').change(function (e) {
							e.preventDefault();
							var pageSize = jQuery(this).val();
							$ftable.data('page-size', pageSize);
							$ftable.trigger('footable_initialized');
						});

						jQuery('#change-nav-size').change(function (e) {
							e.preventDefault();
							var navSize = jQuery(this).val();
							$ftable.data('limit-navigation', navSize);
							$ftable.trigger('footable_initialized');
						});


						/** 02. BOOTSTRAP 3.x PAGINATION FIX
						******************************************* **/
						jQuery("div.pagination").each(function() {
							jQuery("div.pagination ul").addClass('pagination');
							jQuery("div.pagination").removeClass('pagination');
						});

					});
				});
			});
		</script>

	</body>
</html>