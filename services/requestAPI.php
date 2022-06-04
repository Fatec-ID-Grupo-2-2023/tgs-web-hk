<?php
    function requestApi($method, $apiUrl, $data, $token = false){
        $curl = curl_init();

        if($token){ //Add Bearer Token header in the request
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token
            ));
        }

        switch ($method){
            case "POST":
                curl_setopt($curl, CURLOPT_POST, true);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            break;

            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
            break;

            default:
                if ($data)
                    $apiUrl = sprintf("%s?%s", $apiUrl, http_build_query($data));
        }

        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);        
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        
        $resultData = curl_exec($curl);

        curl_close($curl);

        return $resultData;
    }
?>