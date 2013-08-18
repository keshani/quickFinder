<?php

class block_simplehtml extends block_base{
    public function init(){
        $this->title=get_string('simplehtml','block_simplehtml');
    }
    
    public function get_content(){
        if($this->content!==null){
            return $this->content;
        }
        
        $this->content=new stdClass();
       // $this->content->text = 'The content of our SimpleHTML block!';
	if (! empty($this->config->text)) {
        	$this->content->text = $this->config->text;
	}
        $this->content->footer='Footer here...';
        
        return $this->content;
    }

	public function specialization(){
		if(!empty($this->config->title)){
			$this->title = $this->config->title;
		}
		else{
			$this->config->title = 'Default title...';
		}

		if(empty($this->config->text)){
			$this->config->text = 'Default text...';
		}
	}

	 function has_config() {
		return true;
	}
        
        public function instance_config_save($data) {
            
           if(get_config('simplehtml', 'Allow_HTML')=='1'){
               $data->text = strip_tags($data->text);
           }
           return parent::instance_config_save($data);
        }
        
}
?>
