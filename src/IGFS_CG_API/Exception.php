<?php

namespace EchoWine\Unicredit\IGFS_CG_API;

class IgfsException extends Exception { }
class IgfsMissingParException extends Exception { }
class IOException extends Exception { }
class ConnectionException extends IOException {
    public function __construct($url, $message) {
        parent::__construct("[" . $url . "] " . $message);
    }
}
class ReadWriteException extends IOException {
    public function __construct($url, $message) {
        parent::__construct("[" . $url . "] " . $message);
    }
}
?>
