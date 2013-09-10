<?php

class block_quickfinder extends block_base{
    public function init(){
        $this->title=get_string('quickfinder','block_quickfinder');
    }
    
    public function get_content(){
        global $CFG, $OUTPUT;// global
        if($this->content!==null){
            return $this->content;
        }
        
        $this->content=new stdClass();
       // $this->content->text = 'The content of our SimpleHTML block!';
	if (! empty($this->config->text)) {
        	$this->content->text = $this->config->text;
	}
       // $this->content->footer='Footer here...';
     

        $strsearch  = get_string('search');
      //  $strgo      = get_string('find');

        $this->content->text  = '<div class="searchform">';
        $this->content->text .= '<form action="'.$CFG->wwwroot.'/mod/forum/search.php" style="display:inline"><fieldset class="invisiblefieldset">';
        $this->content->text .= '<legend class="accesshide">'.$strsearch.'</legend>';
        $this->content->text .= '<input name="id" type="hidden" value="'.$this->page->course->id.'" />';  // course
        $this->content->text .= '<label class="accesshide" for="searchform_search">'.$strsearch.'</label>'.//when mouse point goes here search appear
                                '<input id="searchform_search" name="search" type="text" size="16" />';
        $this->content->text .= '<input type="submit" value="Submit">';
      //  $this->content->text .= '<a href="'.$CFG->wwwroot.'/mod/forum/search.php?id='.$this->page->course->id.'">'.$advancedsearch.'</a>';
       // $this->content->text .= $OUTPUT->help_icon('search');
        $this->content->text .= '</fieldset></form></div>';
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
            
           if(get_config('quickfinder', 'Allow_HTML')=='1'){
               $data->text = strip_tags($data->text);
           }
           return parent::instance_config_save($data);
        }
        
         public function get_aria_role() {
        return 'search';
    }
}
?>
