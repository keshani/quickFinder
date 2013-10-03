<?php

class block_quickfinder extends block_base {

    public function init() {
        $this->title = get_string('quickfinder', 'block_quickfinder'); //this method give values to any class member variables that need instantiating
    }

    public function get_content() {
        global $CFG; // global
        if ($this->content !== null) {// check whether the content of the block is null or not
            return $this->content;
        }

        $this->content = new stdClass();

        if (!empty($this->config->text)) {
            $this->content->text = $this->config->text;
        }



        $strsearch = get_string('search');
        //  $strgo      = get_string('find');

        $this->content->text = '<div class="searchform">';
        $this->content->text .= '<form action="' . $CFG->wwwroot . '/blocks/quickfinder/search.php" style="display:inline"><fieldset class="invisiblefieldset">';
        $this->content->text .= '<legend class="accesshide">' . $strsearch . '</legend>';
        $this->content->text .= '<input name="id" type="hidden" value="' . $this->page->course->id . '" />';  // course
        $this->content->text .= '<label class="accesshide" for="searchform_search">' . $strsearch . '</label>' . //when mouse point goes here search appear
                '<input id="searchform_search" name="search" type="text" size="16" />';
        $this->content->text .= '<input type="submit" value="Search">'; // add a submit button to the form
        $this->content->text .= '</fieldset></form></div>';

        return $this->content;
    }

    public function specialization() {
        if (!empty($this->config->title)) {
            $this->title = $this->config->title;
        } else {
            $this->config->title = 'Default title...';
        }

        if (empty($this->config->text)) {
            $this->config->text = 'Default text...';
        }
    }

    function has_config() {
        return true;
    }

    public function instance_config_save($data) {

        if (get_config('quickfinder', 'Allow_HTML') == '1') {
            $data->text = strip_tags($data->text);
        }
        return parent::instance_config_save($data);
    }

    public function get_aria_role() {
        return 'search';
    }

    public function cron() {
        include 'data_enter.php';


   store_assignment_description();

//        global $DB;
//        $con = mysql_connect("localhost", "root", "");
//
//        if (!$con) {
//            die("no connection");
//        } else {
//            echo "you can connect";
//        }
//        mysql_select_db("moodle", $con);
//
//        $result1= mysql_query("select distinct userid from mdl_assign_submission "); //get array of user ids who submit assignments
//        if (!$result1) {
//           die('Invalid query: ' . mysql_error());
//        }
//        $sub = new stdClass();
//
//     while ($rows1 = mysql_fetch_array($result1)) {
//           // get assignment files for each user
//
//           $assignmentfiles = mysql_query("select * from mdl_files where userid=" . $rows1['userid'] . " and component='assignsubmission_file'and filearea='submission_files'and mimetype='application/pdf'");
//           // $assignment = mysql_fetch_array($assignmentfiles);
//
//           //foreach ($assignment['itemid'] as $value1 ) 
//           while ($assignment = mysql_fetch_array($assignmentfiles)) {
//              // get assignment id number relevent to the submission
//               $assignmentid = mysql_query("select assignment from mdl_assignsubmission_file where submission=" . $assignment['itemid'] . "");
//               $assign = mysql_fetch_array($assignmentid);
//
//               // get course id number relevent to the assignment id
//               $courseid = mysql_query("select course from mdl_course_modules where module=1 and instance=" . $assign['assignment'] . "");                $course = mysql_fetch_array($courseid);
//
//                //insert data into plugin table
//                
//
//                $sub->itemid = $assignment['itemid'];
//                $sub->userid = $rows1['userid'];
//                $sub->courseid = $course['course'];
//                $sub->assignmentname = $assignment['filename'];
//                $sub->assignmenttext = 'fagasjaal';
//
//                $result = $DB->insert_record('block_quickfinder', $sub);
//           }
//     }


        return true;
    }

}

?>
