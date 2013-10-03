<?php

if (isset($_GET['search'])) {
    global $USER;

    require_once("../../config.php");
    $userid = $USER->id;
    $keyword = $_GET['search'];
    $course = $_GET['id'];
    retrive_assignment($keyword, $userid, $course);
}

function retrive_assignment($keyword, $user, $course) {
    global $DB;
    $con = mysql_connect("localhost", "root", "");

    if (!$con) {
        die("no connection");
    } else {
        echo "you can connect";
    }
    mysql_select_db("moodle", $con);

    if (ctype_space($keyword) || $keyword == '') {
        echo "Please enter your search keyword";
    } else {

        $result1 = mysql_query("select * from mdl_block_quickfinder where assignmenttext like '%$keyword%' and userid=$user and courseid=$course ");
        if (!$result1) {
            die('Invalid query: ' . mysql_error());
        }


        $num_results = mysql_num_rows($result1);
        if ($num_results > 0) {

            while ($rows1 = mysql_fetch_array($result1)) {

                $result2 = mysql_query("select * from mdl_files where itemid=" . $rows1['itemid'] . "");
                $rows2 = mysql_fetch_array($result2);
                $contextid = $rows2['contextid'];
                $component = $rows2['component'];
                $filearea = $rows2['filearea'];
                $itemid = $rows1['itemid'];
                $filename = $rows2['filename'];
                $url = moodle_url::make_pluginfile_url($contextid, $component, $filearea, $itemid, '/', $filename);
                echo '<a href="' . $url . '">"' . $filename . '"</a>';
                echo "<br>";
            }
        } else {
            echo "Sorry! There is no any assignment match with your keyword";
        }
    }
}

?>
