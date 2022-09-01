<?php
require_once ('dbconfig.php');

$db_link =  mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$db_link ) {
    echo 'не могу подключиться к базе';
    exit;
}


$q = trim($_REQUEST['qstring']);

if (isset($q) && strlen($q) >=3 ) {
   $q = trim($_REQUEST['qstring']);

   $sql = "SELECT p.title as title, c.body as body FROM posts as p, comments as c WHERE p.id = c.postId AND c.body LIKE '%{$q}%';";
   $result = mysqli_query($db_link, $sql);

   while ($row = mysqli_fetch_array($result)) {
     $title = $row['title'];
     $body = str_replace($q, "<b>$q</b>", $row['body']);
     echo "<div>
     <h4>$title</h4>
     <p>$body</p>
     </div><hr>";
   }
}
mysqli_close($db_link);
