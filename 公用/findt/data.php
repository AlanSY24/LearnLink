<?php

    // 底下範例程式碼針對上課使用，請在實際開發時進行調整

    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header("Content-type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Headers: Content-Type");

    $mydb = new mysqli('localhost','root','', 'learn');
    $mydb->set_charset('utf8');
   


            $sql = 'SELECT * FROM events';
            $result = $mydb->query($sql);
            $data = [];
            while($row = $result->fetch_object()){
                $data[] = $row;
            }

            $myJSON_data = json_encode($data, JSON_UNESCAPED_UNICODE);
            echo $myJSON_data;


 
?>