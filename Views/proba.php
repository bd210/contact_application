<?php

if (class_exists('Memcache')) {

    $cache = new Memcache();

    $cache->connect('localhost',11211);

    $cache_file = "cache/proba.cache.php";

    if (file_exists($cache_file)) {

        echo "From cache <br/>";

            include_once $cache_file;

    } else {

        echo "Created cache <br/>";
    $str = "<table border='1'>";
    $str .= "<tr><th>Username</th><th>Email</th><th>Role</th> </tr>";
    $str .= "<tr> <td>".$_SESSION['user']['user_name']."</td><td>".$_SESSION['user']['email']."</td><td>".$_SESSION['user']['role_name']."</td> </tr>";

    $str .= "</table>";

    $handle = fopen($cache_file, 'w');
    fwrite($handle, $str);
    fclose($handle);

        echo $str;
    }

} else {

    die("Error while connecting to cache server");
}
?>