<?php

$settings->add(new admin_setting_heading(
        'headerconfig',
        get_string('headerconfig','block_quickfinder'),
        get_string('descconfig','block_quickfinder')
        ));

$settings->add(new admin_setting_configcheckbox(
        'simplehtml/Allow_HTML',
        get_string('labelallowhtml','block_quickfinder'),
        get_string('descallowhtml','block_quickfinder'),
        '0'
        ));
?>
