<?php
include_once("dbObject.php");
$db = new dbObject();
$db->connect();

$request = $_POST['request'];
$content = '{';
$username = $_POST['username'];
$uid = $_POST['uid'];
if($request == 'delete'){
    $db->deleteResumesByRid($_POST['resumes'], $uid);
    $resumes = $db->getResumesByUid($uid);
    foreach($resumes as $resume){
        $content .= '\'<tr>';
        $content .= '<td>';
        $content .= '<div class="btn-checkbox btn-item-label" rid-label="' . $resume->rid . '"></div>';
        $content .= '</td>';
             
        $content .= '<td>';
                            
        $content .= '<a href="../rmks/' . $username . '/' . $resume->rid . '">';

        $content .= $resume->name;
                            
        $content .= '</a>';
        $content .= '</td>';
        $content .= '<td>';
                            
        $content .= 'Created On ' . date('F j, Y', $resume->date_created);
        $content .= '</td>';
        $content .= '</tr>';
        $content .= '}\',';
    }
    $result = substr($content, 0, -1);
    echo $result;
}

?>