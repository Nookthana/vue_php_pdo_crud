<?php


require '../config.php';

$data = json_decode(file_get_contents("php://input"));


try {

if($_SERVER['REQUEST_METHOD'] !== "POST" ){

    echo json_encode(array("status" => "Bad Request",
                            "message" => "Only POST method is allowed"
    ));     
        http_response_code(400);
        die();



 }else if ($data->id == ""){

    echo json_encode(array("status" => "Bad Request",
                            "message" => "Missing fields (id)"
    )); 
       http_response_code(400);
       die();

 }else{

    
        $sql = $conn->prepare("SELECT `id` FROM `user` WHERE id=?");
        $sql->execute([$data->id]); 
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

    

        if (count($result) !== 0) {
        
            $sql = "DELETE FROM `user` WHERE id=?";
            $sql= $conn->prepare($sql);
        
            if($sql->execute([$data->id])){
                echo json_encode(array("status" => "ok",
                "message" => "Data has been deleted"
            ));         
                http_response_code(200);
                exit();
            }else{
                echo json_encode(array("status" => "Bad Request"));
                http_response_code(400);
                exit();
            }


        }else{
            echo json_encode(array("status" => "Not Found",
            "message" => "Data ID Not Found"
        ));         
            http_response_code(404);
            exit();
        }

 }


   

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}




?>