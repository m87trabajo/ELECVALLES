<?php

function ErrPDOCatch($ubication, $message, $code) {
    date_default_timezone_set('Europe/Madrid');
    $error = '<u>' . $ubication . '</u><br/>Time:' . date('Y-m-d H:i:s') . '<br/>Message:' . $message . '<br/>Code:' . $code . '<br/>';
    echo $error;
    file_put_contents('Logs/PDOErrors.html', $error, FILE_APPEND);  // write some details to an error-log outside public_html  
}
