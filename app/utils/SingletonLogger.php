<?php

namespace app\utils;

use app\utils\SingletonConfigReader;

/**
 * A basic implementation of a logger for PHP
 * with Singleton pattern... not the best way probably
 * Should rewrite with a static class ??
 * Please see PSR-3 at https://www.php-fig.org/psr/psr-3/
 * and take a look to https://www.phpfacile.com/apprendre_le_php/logs_ou_traces_avec_monolog
 */
class SingletonLogger
{
    /** @var  SingletonLogger */
    private static $instance;
    private string $logFile;
    private bool $logOn; //Correct naming ???????
    /** @var resource */
    private $handle;

    /**
     * @throws \Exception
     */
    private function __construct()
    {
        $logFileName = SingletonConfigReader::getInstance()->getValue("logfile");
        if ($logFileName =="") {
            $logFileName="/storage/CurryLog.log" ;
        }
        //This works only in a server context... Should we use the PROJECT_ROOT constant defined in autoloader ?
        $this->logFile = $_SERVER["DOCUMENT_ROOT"] . "/../storage/" . $logFileName;
        $this->logOn = SingletonConfigReader::getInstance()->getValue("logger") ?? 1 ;
        $open = $this->handle = fopen($this->logFile, "a");
        if ($open==null) {
            print("Le fichier de log n'existe pas !");
        }
    }

    public static function getInstance(): SingletonLogger
    {
        if (is_null(self::$instance)) {
            self::$instance = new SingletonLogger();
        }
        return self::$instance;
    }

    public function log(string $message): void
    {
        //log message with timestamp...
        if ($this->logOn == true) {
             fwrite($this->handle, "[" . date('d-m-y h:i:s') . "] :\t" . $message . "\n");
        }
    }
}
