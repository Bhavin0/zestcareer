
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <span class="elipsis title">
        <strong>This Month Student's Birthday List</strong>
      </span>
    </div>
    <div class="panel-body">

      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>&nbsp;S No</th>
            <th>&nbsp;Student Name</th>
            <th>&nbsp;Class</th>
            <th>&nbsp;DOB</th>
          </tr>
        </thead>
        <tbody>
        <?php 
          if(count($students_det)>=1)
          {
            $i=0;
            foreach($students_det as $each)
            {
              list($year, $month) = explode('-', date('Y-n'));
              $date = getdate();
              $year = $date['year'];
              $month = $date['mon'];
              if(substr($each['pre_dateofbirth'],5,2)==$month)
              {
                $i++;
                ?>
                <tr>
                    <td>&nbsp;<?php echo $i;?></td>
                    <td>&nbsp;<?php echo $each['pre_name']." ".$each['middle_name']." ".$each['pre_lastname'];?></td>
                    <td>&nbsp;<?php echo classname($each['pre_class']);?></td>
                    <td>&nbsp;<?php echo displaydate($each['pre_dateofbirth']);?></td>
                </tr>
                <?php
              }
            }// End of foreach($students_det as $each)
          }// End of if(count($students_det)>=1)
        else
          { ?>
        <tr>
          <td colspan="6" align="center">No Students Found</td>
        </tr>
        <?php
        } ?>
      </table>
</div>