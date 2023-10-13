<?php

function input_validator($data) {
    trim($data);
    stripslashes($data);
    htmlspecialchars($data);
    return $data;
}

?>