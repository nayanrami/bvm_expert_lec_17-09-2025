<?php
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');


    try{
        include 'db.php';
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == 'GET'){
           $query = "select * from students";
           $result = mysqli_query($conn, $query);
           echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));  


        }

    }catch(Exception $e){
        echo "Error: ".$e->getMessage();
    }
?>