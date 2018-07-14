<?php 
    if($_GET['class_id']=='ALL')
    {
        $all_classlist = mysqli_query($mysqli_con, "SELECT * FROM es_classes ORDER BY es_orderby");
        ?>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="15%">Class ID</th>
                    <th width="50%">Class Name</th>
                    <th width="35%">Fees Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($class = mysqli_fetch_assoc($all_classlist))
                {
                    $cumplsory_fees = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT SUM(fee_amount) FROM es_feemaster WHERE optional = 'NO' AND academy_year_id = ".$_GET['ac_year']." AND fee_class=".$class['es_classesid']), MYSQLI_NUM);

                    $optional_fees = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT SUM(fee_amount) FROM es_feemaster WHERE optional = 'YES' AND academy_year_id = ".$_GET['ac_year']." AND fee_class=".$class['es_classesid']), MYSQLI_NUM);
                ?>
                <tr>
                    <td><?php echo $class['es_classesid']; ?></td>
                    <td><?php echo $class['es_classname']; ?></td>
                    <td>
                        <?php echo $cumplsory_fees[0]; ?>
                        <?php echo ($optional_fees[0]>0)?' + '.$optional_fees[0].' (optional fee)':''; ?> 
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    }
    else
    {
        $section = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT es_groupid FROM es_classes WHERE es_classesid=".$_GET['class_id']), MYSQLI_NUM);
        $all_sem = mysqli_query($mysqli_con, "SELECT * FROM new_semesters WHERE department_id=".$section[0]." AND academic_year_id=".$_GET['ac_year']);
        ?>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>SR No.</th>
                    <th>Fee Type</th>
                    <th>Amount</th>
                    <th>Ledger</th>
                    <th>Action</th>
                </tr>
            </thead>

        <?php
        while($sem = mysqli_fetch_assoc($all_sem))
        {
            ?>
            <tr class="info">
                <th colspan="5"><?php echo $sem['name']; ?></th>
            </tr>
            <?php
            $i = 1;
            $fees = mysqli_query($mysqli_con, "SELECT es_feemaster.*, es_ledger.lg_name FROM es_feemaster INNER JOIN es_ledger ON es_ledger.es_ledgerid = es_feemaster.ledger_id WHERE semester_id=".$sem['semester_id']." AND fee_class=".$_GET['class_id']);
            while ($fee = mysqli_fetch_assoc($fees))
            {
               ?>
               <tr>
                   <td><?php echo $i++; ?>
                       <input type="hidden" class="particular_id" value="<?php echo $fee['es_feemasterid']; ?>">
                   </td>
                   <td class="fee_particular"><?php echo $fee['fee_particular']; ?></td>
                   <td class="fee_amount"><?php echo $fee['fee_amount']; ?></td>
                   <td><span class="ledger_span"><?php echo $fee['lg_name']; ?></span>
                       <select class="form-control ledger_dropdown" style="display: none;">
                        <?php for($j=0; $j < count($ledgers); $j++)
                        {
                            $selected = ($ledgers[$j]['es_ledgerid']==$fee['ledger_id'])?'selected':'';
                            echo"<option value='".$ledgers[$j]['es_ledgerid']."' ".$selected.">".$ledgers[$j]['lg_name']."</option>";
                        }
                        ?>
                       </select>
                   </td>
                   <td>
                       <button class="btn btn-warning btn-xs edit-fees">
                           &nbsp;<i class="fa fa-pencil-square-o"></i>
                       </button>
                       <button class="btn btn-success btn-xs save-fees" style="display: none;">
                           &nbsp;<i class="fa fa-floppy-o"></i>
                       </button>
                       <button class="btn btn-danger btn-xs delete-fee">
                           &nbsp;<i class="fa fa-trash-o"></i>
                       </button>
                   </td>
               </tr>
               <?php
            }
        }
        ?>
        </table>
        <?php
    }