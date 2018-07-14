<?php

$abc = $_GET['card_id'];

$qry = mysqli_query($mysqli_con, "DELETE FROM `fm_fee_cards` WHERE `card_id` =".$abc) or die(MYSQLI_ERROR($mysqli_con));

header('location: ?pid=17&action=fee_cards_list')





?>