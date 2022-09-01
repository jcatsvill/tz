<?php
require_once ('dbconfig.php');

$db_link =  mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$db_link ) {
    echo 'не могу подключиться к базе';
    exit;
}


function insert_posts($db_link, $url) {
    $json = file_get_contents($url);
    $data = json_decode($json, true);
    foreach ($data as $line) {
        $userid = $line['userId'];
        $title = $line['title'];
        $body = $line['body'];
        $sql = "INSERT INTO posts (userId, title,body) VALUES ($userid, '{$title}', '{$body}')";
        mysqli_query($db_link, $sql);
    }
}


function insert_comments($db_link, $url) {
    $json = file_get_contents($url);
    $data = json_decode($json, true);
    foreach ($data as $line) {
        $postid = $line['postId'];
        $name = $line['name'];
        $email = $line['email'];
        $body = $line['body'];
        $sql = "INSERT INTO comments (postId, name, email, body) VALUES ($postid, '{$name}', '{$email}', '{$body}')";
        mysqli_query($db_link, $sql);
    }
}


$post_json_link = "https://jsonplaceholder.typicode.com/posts";
$comments_json_link = "https://jsonplaceholder.typicode.com/comments";

insert_posts($db_link, $post_json_link);
insert_comments($db_link, $comments_json_link);

mysqli_close($db_link);