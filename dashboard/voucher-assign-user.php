<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

$update = DB::query("UPDATE voucher_codes set single_user_id=%i where id=%i", $_GET['assign_to'], $_GET['voucher_id']);

echo "
        <script language='javascript'>
		alert('Data successfully updated');
        window.location.href='vouchers-codes.php?uuidx=".$_GET['voucher_uuid']."';
        </script>
      ";

?>