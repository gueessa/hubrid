<?php namespace Hybrid;

use Exception;

class Installer {
    /**
     * Installation status
     *
     * @var boolean
     */
    public static $status = false;

    /**
     * Return whether Hybrid is installed
     *
     * @return  bool
     */
    public static function installed()
    {
        return static::$status;
    }

    /**
     * Check database connection
     *
     * @return  bool return true if database successfully connected
     */
    public static function check_database()
    {
        try
        {
            \DB::connection(\Config::get('database.default'))->pdo;
            
            return true;
        }
        catch (Exception $e)
        {
            return false;
        }
    }
}