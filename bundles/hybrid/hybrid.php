<?php

class Hybrid {

    /**
     * Shorthand for calling Hybrid\Core methods.
     *
     * @param   string  $method
     * @param   array   $parameters
     * @return  Hybrid\Core
     */
    public static function __callStatic($method, $parameters)
    {
        return forward_static_call_array(array("Hybrid\Core", $method), $parameters);
    }
}