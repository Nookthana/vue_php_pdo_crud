<?php

 require_once '../config.php';

try {

    if($_SERVER['REQUEST_METHOD'] !== "GET" ){

        echo json_encode(array("status" => "Bad Request",
                                "message" => "Only GET method is allowed"
        ));     
            http_response_code(400);
            die();
    
    
    
     }else{

        $sql = "SELECT * FROM user";
        $statement = $conn->query($sql);
        $statement->execute(); 
        $result =  $statement->fetchAll(PDO::FETCH_ASSOC);

    if (count($result)) {

        $users = [
            "status" => 200,
            "message" => "ok",
            "data" => $result
        ];
        
        echo json_encode($users);
        http_response_code(200);
        
    }else{

        $users = [
            "status" => 404,
            "message" => "Not Found",
        ];
        
        echo json_encode($users);
        http_response_code(404);
    }

     }

   

} catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
}
 





?>