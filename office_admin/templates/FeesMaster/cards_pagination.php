<?php
	$query = $_POST['query'];
	$results = ($_POST['page_number'] * 10) - 10;
	$query .= " LIMIT ".$results.", 10";
	$cards = mysqli_query($mysqli_con, $query);

    while($row = mysqli_fetch_assoc($cards))
    {
        ?>
       	<tr class="<?php echo ($row['receipt_id']!='')?'success':''; ?>">
            <td><?php echo $row['card_id']; ?></td>
            <td><?php echo $row['slip_no']; ?></td>
            <td><?php echo date_format(date_create($row['card_date']),'d/m/Y'); ?></td>
            <td><?php echo $row['pre_name']." ".$row['middle_name']." ".$row['pre_lastname']; ?></td>
            <td><?php echo $row['es_classname']; ?> - <?php echo $row['division_name']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['grand_total']; ?></td>
            <td>
            <?php if($row['receipt_id']=='') { ?>
             	<button type="button" class="editcard btn btn-info btn-xs" data-toggle="modal" data-target="#EditCard" value="<?php echo $row['card_id']; ?>" title="Edit Card">
               	&nbsp;<i class="fa fa-pencil-square-o"></i>
             	</button>
             	<a href="?pid=17&action=fee_card_print&card_id=<?php echo $row['card_id']; ?>" class="btn btn-warning btn-xs" target="_blank" title="Print Fee Card">
               	&nbsp;<i class="fa fa-file-pdf-o"></i>
             	</a>
             	<a href="?pid=17&action=delete_card&card_id=<?php echo $row['card_id']; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to cancel this card?')" title="Delete Card">
               	&nbsp;<i class="fa fa-trash-o"></i>
             	</a>
            <?php } else { echo 'Receipt Generated'; } ?>
            <?php if($row['receipt_id']=='' && $row['es_preadmissionid'])
            {
              ?>
              <a href="?pid=17&action=generate_receipt&card_id=<?php echo $row['card_id']; ?>" class="btn btn-success btn-xs" target="_blank" title="Generate Receipt">
                &nbsp;<i class="fa fa-print"></i>
              </a>
              <?php
            }
            ?>
           	</td>
        </tr>
    <?php
    }
?>