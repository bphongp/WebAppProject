
<?php

    header('Access-Control-Allow-Origin: http://localhost:4200');//if request coming from this domain then accept
    header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");

    header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');
    
    session_start();
    include('conn.php');
    //require('conn.php');
    // retrieve data from the request
    $postdata = file_get_contents("php://input");
    if(isset($postdata) && !empty($postdata))
    {
        // Extract the data.
        $request = json_decode($postdata);
        
        
        // Validate.
        if(trim($request->first_name) === ''|| trim($request->last_name) === ''||
            trim($request->userName) === ''|| trim($request->userEmail)==='' ||
            trim($request->password) === '')
        {
            return http_response_code(400);
        }
        
        // Sanitize.
        $first_name = mysqli_real_escape_string($conn, trim($request->first_name));
        $last_name = mysqli_real_escape_string($conn, trim($request->last_name));
        $username = mysqli_real_escape_string($conn, trim($request->userName));
        $email = mysqli_real_escape_string($conn, trim($request->userEmail));
        $pw = mysqli_real_escape_string($conn, trim($request->password));
        $gender = mysqli_real_escape_string($conn, trim($request->gender));

        
        // Create.
        $sql = "INSERT INTO user(firstname, lastname, username, email, password, gender) 
        VALUES ('$first_name','$last_name','$username','$email','$pw','$gender');";
        if(mysqli_query($conn,$sql))
        {
          http_response_code(201);
          $policy = [
            'number' => $first_name,
            'amount' => $last_name,
            'id'    => mysqli_insert_id($conn)
          ];
          echo json_encode($policy);
        }
        else
        {
          http_response_code(422);
        }
        // process data 
        // (this example simply extracts the data and restructures them back) 

        $data = [];
        foreach ($request as $k => $v)
        {
        $data[0][$k] = $v;
        }

        // sent response (in json format) back to the front end
        echo json_encode(['content'=>$data]);
    }
?>