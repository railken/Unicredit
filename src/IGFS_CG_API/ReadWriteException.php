<?php

namespace EchoWine\Unicredit\IGFS_CG_API;

class ReadWriteException extends IOException
{
    public function __construct($url, $message)
    {
        parent::__construct("[" . $url . "] " . $message);
    }
}
