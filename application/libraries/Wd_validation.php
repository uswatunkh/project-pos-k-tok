<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Wd_validation {
    private $rules;    // json rules for jQuery validator
    private $messages; // custom error messages for jQuery validator
	private $form_name; // set form id
	private $container; // set container id
    private $js_rules = array(  'required'       => 'required',
                                'matches'        => 'equalTo',
                                'min_length'     => 'minlength',
                                'max_length'     => 'maxlength',
                                'greater_than'   => 'min',
                                'less_than'      => 'max',
                                'numeric'        => 'digits',
                                'valid_email'    => 'email'
                             ); // CI rule names to jQuery validator rules
    /**
    * Build and return jQuery validation code
    *
    * @access public
    * @param  string
    * @return string
    */
    public function run()
    {
        return $this->build_js_script();
    }
    
    /**
    * Build jQuery validationcode
    *
    * @access private
    * @param  string
    * @return string
    */
    private function build_js_script() 
    {
		$script = '';
		if($this->container!=''){
			$script = '$(document).ready(function() { $("'.$this->form_name.'").validate({rules: %s,messages: %s,errorLabelContainer: $("'.$this->container.'"),wrapper: "li"});});';
        }else{
			$script = '$(document).ready(function() { $("'.$this->form_name.'").validate({rules: %s,messages: %s});});';
        }
		
		return sprintf($script, $this->rules, ($this->messages ? $this->messages : '{}'));
    }
	
    /**
    * Set validation rules
    * 
    * @access public
    * @param  array
    * @return string json formatted string
    */
    public function set_rules($rules) 
    {
		if(count($rules)==0){
			return NULL;
		}
		
        foreach ($rules as $k => $v) 
        {
            // CI uses "|" delimiter to apply different rules. Let's split it ... 
            $expl_rules = explode('|', $v['rules']);
			
            foreach ($expl_rules as $index => $rule) 
            {   
				
                // check and parse rule if it has parameter. eg. min_length[2]
                if (preg_match("/(.*?)\[(.*)\]/", $rule, $match))
                {
                    // Check if we have similar rule in jQuery plugin
                    if($this->is_js_rule($match[1])) 
                    {
						if($match[1]=='matches'){
							$match[2] = '#'.$match[2];
						}	
							
                        // If so, let's use jQuery rule name instead of CI's one
                        $json[$v['field']][$this->get_js_rule($match[1])] = $match[2];	
                    }
                }
                // jQuery plugin doesn't support callback like CI, so we'll ignore it and convert everything else 
                elseif (!preg_match("/callback\_/",$rule))
                {
                    if($this->is_js_rule($rule)) 
                    {
                        $json[$v['field']][$this->get_js_rule($rule)] = TRUE;	
                    }
                }
            }
        }
        $this->rules = json_encode($json);
        return $this->rules;
    }
    
    /**
    * check if we have alternative rule of CI in jQuery
    *
    * @access private
    * @param  string
    * @return bool
    */
    private function is_js_rule($filter) 
    {
        if (in_array($filter,array_keys($this->js_rules)))
        {
            return TRUE;
        } 
        else 
        {
            return FALSE;
        }
    }
    
    /**
    * Get rule name
    *
    * get jQuery rule name by CI rule name
    *
    * @access private
    * @param  string
    * @return string
    */
    private function get_js_rule($filter)
    {
        return $this->js_rules[$filter];
    }
    
    /**
    * Set messages
    *
    * set custom error messages on each rule for jQuery validation
    * 
    * @access public
    * @param  array
    * @return string json formated string
    */
    public function set_messages($messages) 
    {
        // We do same as above in set_rules function  check and convert CI to jQuery rules
        foreach ($messages as $k=>$v) 
        {
            foreach ($v as $a=>$v) 
            {
                if ($this->is_js_rule($a)) 
                {
                    // Remove CI rule name ...
                    unset($messages[$k][$a]);
                    // and insert jQuery's one 
                    $messages[$k][$this->get_js_rule($a)] = $v;
                }
            }
        }
        $this->messages = json_encode($messages);
        return $this->messages;
    }
	
	public function set_form($form_name='') 
    { 
		$this->form_name = $form_name;
        return $this->form_name;
    }
	
	public function set_container($container='') 
    { 
		$this->container = $container;
        return $this->container;
    }
	
	//
	public function run_validate_js($rule,$messages,$form_name,$container='') 
	{
		if(count($rule)==0){
			return false;
		}
		
		$this->set_rules($rule);
		$this->set_messages($messages);
		$this->set_form($form_name);
		$this->set_container($container);
		
		$ci = &get_instance();
		
		$ci->layout->set_include('js', 'AdminLTE/js/jquery.validate.js');
		$ci->layout->set_include('inline',getview('general_view/validate_js'));
	}
}
// END Jquery_validation class

/* End of file Jquery_validation.php */
/* Location: ./application/libraries/Jquery_validation.php */
