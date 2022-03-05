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

 }else if ($data->id =='' || $data->fname == '' || $data->lname == '' || $data->email == '' || $data->avatar == ''){

    echo json_encode(array("status" => "Bad Request",
                            "message" => "Missing fields (id,fname, lname, username, email, and/or avatar)"
    )); 
       http_response_code(400);
       die();

 }else{

    
            $sql = $conn->prepare("SELECT * FROM `user` WHERE id=?");
            $sql->execute([$data->id]); 
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);

                if (count($result) !== 0) {


                    $data_update = [
                        'fname' =>  $data->fname,
                        'lname' =>  $data->lname,
                        'email' =>  $data->email,
                        'avatar' => $data->avatar,
                        'id' =>     $data->id,
                    ];
      
                     $sql = "UPDATE user SET fname=:fname, lname=:lname, email=:email,avatar=:avatar WHERE id=:id";
                     $res= $conn->prepare($sql);
  
                                if($res->execute($data_update)){

                                      $users = [
                                          "status" => "ok",
                                          "message" => "Update successfully"  
                                        ];
                                    
                                      echo json_encode($users);
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
 
 
 
 
 


}catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}




?>