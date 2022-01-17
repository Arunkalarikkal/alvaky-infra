<?php

    $servername = "localhost";
    $username = "myuser";
    $password = "mypass";
    $dbname = "mt5";

    $conn = new mysqli($servername, $username, $password, $dbname);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM meta_trade_values";
    $result = $conn->query($sql);

    $result_arr = [];
    $gold_value = [];
    $silver_value = [];

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row['name'] == 'Gold'){
                $gold_value['value'] = $row['value'];
                $gold_value['diff'] = $row['diff'];
                $gold_value['percent'] = $row['percent'];
                $gold_value['status'] = $row['status'];
            }   else if($row['name'] == 'Silver'){
                $silver_value['value'] = $row['value'];
                $silver_value['diff'] = $row['diff'];
                $silver_value['percent'] = $row['percent'];
                $silver_value['status'] = $row['status'];
            }
        }
    } else {
        echo "0 results";
    }
    $conn->close();

    $result_arr['gold'] = $gold_value;
    $result_arr['silver'] = $silver_value;

    echo $_GET['callback']."(".json_encode($result_arr).");";
?>