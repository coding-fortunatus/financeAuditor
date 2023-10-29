<?php

define('HOSTNAME', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DB_NAME', 'financial_auditor');

$conn = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DB_NAME);

if (!$conn) {
    die("Database Error: ".mysqli_connect_error());
}

?>