<?php
namespace app\utils;

/**
 * SingletonLogger class
 * Singleton using lazy instantiation
 */
class SingletonLogger
{
    private static $instance = NULL;
    private $logs;

    private function __construct() {
        $logs = array();
    }

    /**
     * Gets instance of the SingletonLogger
     * @return SingletonLogger instance
     * @access public
     */
    public function getInstance() {
        if(self::$instance === NULL) {
            self::$instance = new SingletonLogger();
        }
        return self::$instance;
    }

    /**
     * Adds a message to the log
     * @param String $message Message to be logged
     * @access public
     */
    public function log($message) {
        $this->logs[] = $message;
    }

    /**
     * Returns array of logs
     * @return array Array of log messages
     * @access public
     */
    public function get_logs() {
        return $this->logs;
    }
}
//class unique qui envoie les message derreur dans un fichier de log

?>