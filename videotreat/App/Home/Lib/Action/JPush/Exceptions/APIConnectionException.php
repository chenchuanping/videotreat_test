<?php
namespace JPush\Exceptions;
include_once 'JPushException.php';
class APIConnectionException extends JPushException {

    function __toString() {
        return "\n" . __CLASS__ . " -- {$message} \n";
    }
}
