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



 }else if($data == null){

    echo json_encode(array("status" => "Bad Request",
                            "message" => "Missing fields (fname, lname, username, email, and/or avatar)"
    )); 
      http_response_code(400);
      die();

 }else if ($data->fname == '' || $data->lname == '' || $data->email == '' || $data->avatar == ''){

    echo json_encode(array("status" => "Bad Request",
                            "message" => "Missing fields (fname, lname, username, email, and/or avatar)"
    )); 
       http_response_code(400);
       die();

 }else{ 

    $sql = "INSERT INTO `user`( `fname`, `lname`, `email`, `avatar`)  VALUES (?,?,?,?)";
    $sql= $conn->prepare($sql);

    if($sql->execute([$data->fname,$data->lname,$data->email,$data->avatar])){
        echo json_encode(array("status" => "ok",
                               "message" => "Data created successfully"
    ));
        http_response_code(200);
        exit();

    }else{
        echo json_encode(array("status" => "Bad Request",
                               "message" => $e->getMessage()
    ));
        http_response_code(400);
        die();
    }

      }   

}catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
}




?>