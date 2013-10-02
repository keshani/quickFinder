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


    $result1 = mysql_query("select * from mdl_block_quickfinder where assignmenttext like '%$keyword%' and userid=$user and courseid=$course ");

    if (!$result1) {
        die('Invalid query: ' . mysql_error());
    }

   // $rows = mysql_fetch_array($result);

     while($rows1 = mysql_fetch_array( $result1 )) 
 {
         $result2= mysql_query("select * from mdl_files where itemid=".$rows1['itemid']."");
         $rows2 = mysql_fetch_array($result2);
         $contextid=$rows2['contextid'];
         $component=$rows2['component'];
         $filearea=$rows2['filearea'];
         $itemid=$rows1['itemid'];
         $filename=$rows2['filename'];
         $url = moodle_url::make_pluginfile_url($contextid,$component,$filearea,$itemid, '/',$filename);
         echo $url;
         echo '<a href="'.$url.'">"'.$filename.'"</a>';
//test


$fs = get_file_storage();
 
// Prepare file record object
$fileinfo = array(
    'component' => $component,     // usually = table name
    'filearea' => $filearea,     // usually = table name
    'itemid' => $itemid,               // usually = ID of row in table
    'contextid' => $contextid, // ID of context
    'filepath' => '/',           // any path beginning and ending in /
    'filename' => $filename); // any filename
 
// Get file
$file = $fs->get_file($fileinfo['contextid'], $fileinfo['component'], $fileinfo['filearea'],
                      $fileinfo['itemid'], $fileinfo['filepath'], $fileinfo['filename']);
 
// Read contents
if ($file) {
    $contents = $file->get_content();
    echo $contents;
} else {
    echo 'no file';
    // file doesn't exist - do something
}



   }
}

?>
