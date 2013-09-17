<?php

if (isset($_GET['search'])) {
    global $USER;

    require_once("../../config.php");
//  $filename = "CS3022-Project-1.pdf";
//   $table_files = "files";
//   $results = $DB->get_record($table_files, array('filename' => $filename, 'sortorder' => 1));
//   $baseurl = "$CFG->wwwroot/pluginfile.php/$results->contextid/$results->component/$results->filearea/$results->itemid/$filename";
//    echo $baseurl;
//$result = pdf2text ("http://localhost/moodle/pluginfile.php/////CS3022-Project-1.pdf");



    $userid = $USER->id;

    //  echo $_GET['id'];
    //  echo $userid;
    $keyword = $_GET['search'];
    $course = $_GET['id'];
    store_assignment_description($keyword, $userid, $course);
}

//  echo $result;
// require_once("../config.php");
//
//    $filename = "m";
//    $table_files = "files";
//    $results = $DB->get_record($table_files, array('filename' => $filename, 'sortorder' => 1));
//    $baseurl = "$CFG->wwwroot/pluginfile.php/$results->contextid/$results->component/$results->filearea/$results->itemid/$filename";
//    echo $baseurl;
//    class assignment_details {
//
//    // $keyword=$_Get("search");
//
//    public function cron() {
//        $this->store_assignment_description();
//
//        // do something
//        return true;
//    }
//
function store_assignment_description($keyword, $user, $course) {
    global $DB;
    $con = mysql_connect("localhost", "root", "");

    if (!$con) {
        die("no connection");
    } else {
        echo "you can connect";
    }
    mysql_select_db("moodle", $con);


    $result = mysql_query("select assignmentname from mdl_block_quickfinder where assignmenttext like '%$keyword%' and userid=$user and courseid=$course ");

    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }

    $rows = mysql_fetch_array($result);
    foreach ($rows as $value) {
        echo "$value <br>";
        // echo $rows['assignmentname'];
    }
}

?>
