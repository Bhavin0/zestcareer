<?php
	$query = $_POST['query'];
	$results = ($_POST['page_number'] * 10) - 10;
	$query .= " LIMIT ".$results.", 10";
	$receipts = mysqli_query($mysqli_con, $query);

    while($row = mysqli_fetch_assoc($receipts))
    {
        ?>
       	<tr class="<?php echo ($row['status']=='active')?'':'danger'; ?>">
            <td><?php echo $row['fid']; ?></td>
            <td><?php echo $row['receipt_no']; ?></td>
            <td><?php echo date_format(date_create($row['receipt_date']),'Y-m-d'); ?></td>
            <td><?php echo $row['pre_name']." ".$row['middle_name']." ".$row['pre_lastname']; ?></td>
            <td><?php echo $row['es_classname']; ?> - <?php echo $row['division_name']; ?></td>
            <td><?php echo $row['grand_total']; ?></td>
            <td align="center">
              <?php if($row['status']=='active'){ ?>
             	<button type="button" class="editreceipt btn btn-info btn-xs" data-toggle="modal" data-target="#EditReceipt" value="<?php echo $row['fid']; ?>">
               	&nbsp;<i class="fa fa-pencil-square-o"></i>
             	</button>
             	<a href="?pid=40&action=print_receipt&receipt_id=<?php echo $row['fid']; ?>" class="btn btn-warning btn-xs" target="_blank">
               	&nbsp;<i class="fa fa-print"></i>
             	</a>
             	<a href="?pid=40&action=delete_receipt&receipt_id=<?php echo $row['fid']; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to cancel this receipt?')">
               	&nbsp;<i class="fa fa-trash-o"></i>
             	</a>
              <?php } else { echo "cancelled"; } ?>
           	</td>
        </tr>
    <?php
    }
?>