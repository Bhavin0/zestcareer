<?php
	/**
* Only Admin users can view the pages
*/
if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" ) {
	header('location: ./?pid=1&unauth=0');
	exit;
}
	
	if($action = "change_password") {
?>
<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
  <div class="panel panel-default">
    <div class="panel-heading">
      <span class="elipsis title">
        <strong>Change Password</strong>
      </span>
    </div>
    <div class="panel-body">

      <form action="" method="post" name="password_change">
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-offset-3 col-md-offset-3">
					<?php  
						if (isset($notValid) && $notValid!=""){
						?>
							<div class="alert alert-danger">
								<strong><?php echo $notValid; ?></strong>
              </div>
							 <?php
							}
						?>
            <div class="form-group">
              <label><b>Old Password</b></label>
              <input type="password" name="ch_old_password" id="ch_old_password" class="form-control input-sm">
            </div>

            <div class="form-group">
              <label><b>New Password</b></label>
              <input type="password" name="ch_new_password" id="ch_new_password" class="form-control">
            </div>

            <div class="form-group">
              <label><b>Rewrite Password</b></label>
              <input type="password" name="ch_rew_password" id="ch_rew_password" class="form-control">
            </div>

            <div class="form-group">
              <input name="passwordSubmit" type="submit" class="btn btn-info pull-right" value="Submit">
            </div>
      </div>
      </form>
      </div>
  </div>
</div>
<?php } ?>	