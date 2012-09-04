<?php

class Form extends \Laravel\Form {

    /**
    * Value
    *
    * Set the value of a form field
    *
    * @param  string $name
    * @param  object $object
    * @param  mixed  $field
    * @param  mixed  $default
    * @return string
    */
    public static function value($name, &$object = null, $default = null, $field = null)
    {
        $field = ($field ?: $name);
        
        if (is_object($object))
        {
            $value = isset($object->$field) ? $object->$field : $default;
        }
        elseif(is_array($object))
        {
            $value = isset($object[$field]) ? $object[$field] : $default;
        }
        else
        {
            $value = '';
        }
      
        return Input::old($name, $value);
    }
    
    /**
     * Error
     * 
     * @param   string  $name
     * @return  string
     */
    public static function error($name)
    {
        $errors = Session::get('errors');
        
        if ($errors and $errors->has($name))
        {
            return '<div class="error">'. $errors->first($name) .'</div>';
        }
        
        return;
    }
}    