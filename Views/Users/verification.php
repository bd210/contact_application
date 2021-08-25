<?php

    if (isset($_GET['v_key'])) {

        $v_key = $_GET['v_key'];

            echo "<h2>You are succsessfully confirmed</h2>";

    } else {

        echo "<h2>This account invalid or already verified!</h2>";
    }
