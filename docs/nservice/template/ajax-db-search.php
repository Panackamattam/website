<?php
require_once "db.php";
if (isset($_GET['term'])) {
    
   $query = "SELECT * FROM gstvendor WHERE vname LIKE '{$_GET['term']}%' LIMIT 25";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
     while ($user = mysqli_fetch_array($result)) {
      $res[] = $user['vname'];
     }
    } else {
      $res = array();
    }
    //return json res
    echo json_encode($res);
}
?>