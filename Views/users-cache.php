<?php
if (class_exists('Memcache')) {

    $cache = new Memcache();

    $cache->connect('localhost',11211);


        $query = "SELECT u.id as userID,user_name , 
                (SELECT count(m.user_from)  FROM messages m WHERE u.id = m.user_from) as userFrom,
                (SELECT count(m.user_to)  FROM messages m WHERE u.id = m.user_to) as userTo
                FROM users u ";

        $db = new DB();
        $result = $db->queryFetchAll($query);

        $queryKey = "KEY" . md5($query);

        $cache->set($queryKey, $result, 0, 10);

        $result2 = $cache->get($queryKey);

        if ($result2) {

            $str = "<table>";
            $str .= "<tr><th>Username</th><th>Sent</th><th>Received</th></tr>";

            foreach ($result2 as $res) {

                $str.= "<tr><td>".$res['user_name']."</td> <td>".$res['userFrom']."</td> <td>".$res['userTo']."</td> </tr>";

            }
            $str .= "</table>";
            echo $str;

        } else {

            echo "Error with query";
        }


} else {

    die("Error while connecting to cache server");
}
?>