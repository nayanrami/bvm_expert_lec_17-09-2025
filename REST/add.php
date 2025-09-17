<?php
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');

    try{
        include 'db.php';
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == 'POST'){
                $data = json_decode(file_get_contents('php://input'), true);
                echo "data: " . json_encode($data)  ;
                $name = $data['name'];
                $email = $data['email'];

                $query = "insert into students (name, email) values ('$name', '$email')";
                if(mysqli_query($conn, $query)){
                    echo json_encode(["message" => "Record added successfully"]);
                } else {
                    echo json_encode(["message" => "Error adding record: " . mysqli_error($conn)]);
                }
             

        }else{
            echo json_encode(["message" => "Only POST method is allowed"]);
        }

    }catch(Exception $e){
        echo "Error: ".$e->getMessage();
    }
?>