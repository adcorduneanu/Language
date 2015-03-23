<?php

/**
 * Language short summary.
 *
 * Language description.
 *
 * @version 1.0
 * @author adrianfirmauser
 */
class Language
{
    var $language;
    var $storage = array();

    public function __construct($language='EN')
    {
        $this->language = $language;
        $this->Load();
    }

     public function __get($root)
    {
        if (is_array($this->storage)) //You re-assign $storage in a condition so it may be array.
            return isset($this->storage[$root]) ? $this->storage[$root] : null;
        else
            return isset($this->storage->{$root}) ? $this->storage->{$root} : null;
    }
    
    private function Load()
    {   
        $location = $this->language . '.php';
       
        require_once $location;
        if(isset($lang))
        {
            $this->storage = $this->ArrayToObject($lang);
            unset($lang);
        }      
    }
    
    private function ArrayToObject($array) {
        $obj = new stdClass;
        foreach($array as $k => $v) {
            if(strlen($k)) {
                if(is_array($v)) {
                    $obj->{$k} = $this->ArrayToObject($v); 
                } else {
                    $obj->{$k} = $v;
                }
            }
        }
        return $obj;
    } 
}
