<?php
    session_start();
    
    include_once "requestAPI.php";

    if (isset($_POST['login'])){
        $user = isset($_POST['user']) ? $_POST['user'] : null;
        $pwd = isset($_POST['password']) ? $_POST['password'] : null;

        $postData = array (
            "userId" => $user,
            "password" => $pwd
        );

        $response = requestApi('POST', 'http:/localhost:8080/login', $postData);

        if (strcmp($response, "OK")){
            // session_cache_limiter('private');
            // session_cache_expire(60);
            
            $_SESSION['token'] = $response;
            $_SESSION['name'] = json_decode(requestApi('GET', 'http:/localhost:8080/dentists/' . $user, false, $_SESSION['token']))->name;
            echo "<script> window.location = '../index.php' </script>";
        } else {
            echo "<script> window.location = '../login.php?response=unauthorized' </script>";
        }

    } else {
        if (isset($_POST['registerProcedure'])){
            $procedureTitle = isset($_POST['title']) ? $_POST['title'] : null;
            $procedureDescription = isset($_POST['description']) ? $_POST['description'] : null;
    
            $postData = array (
                "title" => $procedureTitle,
                "description" => $procedureDescription
            );
    
            $response = requestApi('POST', 'http:/localhost:8080/procedures/', $postData, $_SESSION['token']);

            echo "<script> window.location = '../procedure-list.php?response=" . $response . "' </script>";
        } else {
            if (isset($_POST['updateProcedure'])){
                $procedureId = isset($_POST['id']) ? $_POST['id'] : null;
                $procedureTitle = isset($_POST['title']) ? $_POST['title'] : null;
                $procedureDescription = isset($_POST['description']) ? $_POST['description'] : null;
        
                $postData = array (
                    "id" => $procedureId,
                    "title" => $procedureTitle,
                    "description" => $procedureDescription
                );
        
                $response = requestApi('POST', 'http:/localhost:8080/procedures/', $postData, $_SESSION['token']);
    
                echo "<script> window.location = '../procedure-list.php?response=" . $response . "' </script>";
            } else {
                if (isset($_POST['registerEmployee']) || isset($_POST['updateEmployee'])){
                    $employeeName = isset($_POST['name']) ? $_POST['name'] : null;
                    $employeeSurname = isset($_POST['surname']) ? $_POST['surname'] : null;
                    $employeeDocument = isset($_POST['document']) ? $_POST['document'] : null;
                    $employeeEmail = isset($_POST['email']) ? $_POST['email'] : null;
                    $employeeTelephone = isset($_POST['telephone']) ? $_POST['telephone'] : null;
                    $employeeCellphone = isset($_POST['cellphone']) ? $_POST['cellphone'] : null;
                    $employeePwd = isset($_POST['password']) ? $_POST['password'] : null;

                    $postData = array (
                        "document" => $employeeDocument,
                        "name" => $employeeName,
                        "surname" => $employeeSurname,
                        "email" => $employeeEmail,
                        "telephone" => $employeeTelephone,
                        "cellphone" => $employeeCellphone,
                        "password" => $employeePwd
                    );

                    $response = requestApi('POST', 'http:/localhost:8080/employees/', $postData, $_SESSION['token']);
    
                    echo "<script> window.location = '../employee-list.php?response=" . $response . "' </script>";
                } else {
                    if (isset($_POST['registerDentist']) || isset($_POST['updateDentist'])){
                        $dentistName = isset($_POST['name']) ? $_POST['name'] : null;
                        $dentistSurname = isset($_POST['surname']) ? $_POST['surname'] : null;
                        $dentistDocument = isset($_POST['document']) ? $_POST['document'] : null;
                        $dentistEmail = isset($_POST['email']) ? $_POST['email'] : null;
                        $dentistTelephone = isset($_POST['telephone']) ? $_POST['telephone'] : null;
                        $dentistCellphone = isset($_POST['cellphone']) ? $_POST['cellphone'] : null;
                        $dentistExpertise = isset($_POST['expertise']) ? $_POST['expertise'] : null;
                        $dentistPwd = isset($_POST['password']) ? $_POST['password'] : null;
    
                        $postData = array (
                            "document" => $dentistDocument,
                            "name" => $dentistName,
                            "surname" => $dentistSurname,
                            "email" => $dentistEmail,
                            "telephone" => $dentistTelephone,
                            "cellphone" => $dentistCellphone,
                            "expertise" => $dentistExpertise,
                            "password" => $dentistPwd
                        );
    
                        $response = requestApi('POST', 'http:/localhost:8080/dentists/', $postData, $_SESSION['token']);
        
                        echo "<script> window.location = '../dentist-list.php?response=" . $response . "' </script>";
                    } else {
                        if (isset($_POST['registerPatient']) || isset($_POST['updatePatient'])){
                            $patientName = isset($_POST['name']) ? $_POST['name'] : null;
                            $patientSurname = isset($_POST['surname']) ? $_POST['surname'] : null;
                            $patientNickname = isset($_POST['nickname']) ? $_POST['nickname'] : null;
                            $patientCPF = isset($_POST['cpf']) ? $_POST['cpf'] : null;
                            $patientRG = isset($_POST['rg']) ? $_POST['rg'] : null;
                            $patientBirthDate = isset($_POST['birthDate']) ? $_POST['birthDate'] : null;
                            $patientHeight = isset($_POST['height']) ? $_POST['height'] : null;
                            $patientWeight = isset($_POST['weight']) ? $_POST['weight'] : null;
                            $patientEmail = isset($_POST['email']) ? $_POST['email'] : null;
                            $patientTelephone = isset($_POST['telephone']) ? $_POST['telephone'] : null;
                            $patientCellphone = isset($_POST['cellphone']) ? $_POST['cellphone'] : null;
                            $patientStreet = isset($_POST['street']) ? $_POST['street'] : null;
                            $patientNumber = isset($_POST['number']) ? $_POST['number'] : null;
                            $patientCEP = isset($_POST['cep']) ? $_POST['cep'] : null;
                            $patientNeighborhood = isset($_POST['neighborhood']) ? $_POST['neighborhood'] : null;
                            $patientCity = isset($_POST['city']) ? $_POST['city'] : null;
                            $patientDistrict = isset($_POST['district']) ? $_POST['district'] : null;
                            $patientComplement = isset($_POST['complement']) ? $_POST['complement'] : null;

                            $postData = array (
                                "cpf" => $patientCPF,
                                "rg" => $patientRG,
                                "name" => $patientName,
                                "surname" => $patientSurname,
                                "nickname" => $patientNickname,
                                "birthDate" => $patientBirthDate,
                                "height" => $patientHeight,
                                "weigth" => $patientWeight,
                                "email" => $patientEmail,
                                "telephone" => $patientTelephone,
                                "cellphone" => $patientCellphone,
                                "street" => $patientStreet,
                                "neighborhood" => $patientNumber,
                                "city" => $patientCity,
                                "district" => $patientDistrict,
                                "cep" => $patientCEP,
                                "number" => $patientNumber,
                                "compliment" => $patientComplement,
                            );
        
                            $response = requestApi('POST', 'http:/localhost:8080/patients/', $postData, $_SESSION['token']);
            
                            echo "<script> window.location = '../patient-list.php?response=" . $response . "' </script>";
                        }
                    }
                }
            }
        }
    }
?>