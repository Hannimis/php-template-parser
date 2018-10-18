<?php
/* 
 * Project : template_parser_php
 * Author  : Rasmus Wissing Kallehauge
 * Tele    : +45 42 46 98 18
 * Email   : rkallehauge@gmail.com
 * Created : 15-10-2018 09:24:37
 */


class templateParser{
    /**
     * 
     * @param string $template
     * @param mixed $data Array or object, data which placeholders will be replaced with.
     */
    public function __construct($template = null, $data = null) {
        
        // If the argument, template is not null, set the object variable to it.
        if($template !== null){
            $this->setTemplate($template);
        }
        // If the argument, data is not null, set the object variable to it.
        if($data !== null){
            $this->setData($data);
        }
        
    }
    /**
     * 
     * @param mixed $data Object or array of key-value
     * @throws Exception 
     */
    public function setData($data){
        
        if($data === null){
            Throw new Exception('Cannot set data to null value.');
        }
        $this->data = $data;
    }
    /**
     * 
     * @param string $template HTML string
     */
    public function setTemplate($template){
        
        if($template === null){
            Throw new Exception('Cannot set template to null value.'); 
        }
        $this->template = $template;
    }
    
    /**
     * 
     * @return string Returns template with the new data.
     * @throws Exception
     */
    public function parse(){
        
        // Throw a fatal error if $this->template isn't prepared
        if(!isset($this->template) || $this->template == null){
            Throw new Exception("Template hasn't been set.");
        }
        // Throw a fatal error if $this->data isn't prepared
        if(!isset($this->data) || $this->data == null){
            Throw new Exception("Data hasn't been set.");
        }
        
        // 
        $template = $this->template;
        
        // Iterate over all key-value pairs inside $this->data
        foreach($this->data as $key=>$value){
            
            
            // Escapes all characters that are part of the RegEx 
            // Similiar to a real_escape_string from the mysqli object
            $key = preg_quote($key);
            
            // Create a regular expression that finds all instances $key
            $filter = '/' . $key . '/';
            
            // Replace all instances of $key with $value inside $template
            $template = preg_replace($filter, $value, $template);
            
        }
        
        // Return $template that now has it's real data
        return $template;
    }
    
}