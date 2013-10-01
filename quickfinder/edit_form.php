<?php

class block_quickfinder_edit_form extends block_edit_form{
    protected function specific_definition($mform){
        // Section header title according to language file.
        $mform->addElement('header','configheader',get_string('blocksettings','block'));
         // A sample string variable with a default value.
        $mform->addElement('text','config_text',get_string('blockstring','block_quickfinder'));
        $mform->setDefault('config_text','default value');//field names should start with "config_", otherwise they will not be saved and will not be available within the block via $this->config.
        $mform->addElement('select', 'type', get_string('forumtype', 'forum'), array('red', 'blue', 'green'), $attributes);
        
        $mform->setType('config_text',PARAM_MULTILANG);

	$mform->addelement('text','config_title',get_string('blocktitle','block_quickfinder'));
	$mform->setDefault('config_title','default value');
	$mform->setType('config_title',PARAM_MULTILANG);
    }
}
?>
