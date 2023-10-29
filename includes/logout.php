<?php

session_start();

session_reset();
session_unset();
session_destroy();
header("Location: ../login.php");