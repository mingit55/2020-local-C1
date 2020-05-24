<?php

function dump(){
    foreach(func_get_args() as $arg){ 
        echo "<pre>";
        var_dump($arg);
        echo "</pre>";
    }
}

function dd(){
    dump(...func_get_args());
    exit;
}


function back($message = ""){
    echo "<script>";
    echo "history.back();";
    if($message !== "") echo "alert('$message');";
    echo "</script>";
    exit;
}

function go($url, $message = ""){
    echo "<script>";
    echo "location.href = '$url';";
    if($message !== "") echo "alert('$message');";
    echo "</script>";
    exit;
}

function user(){
    return isset($_SESSION['user']) ? $_SESSION['user'] : false;
}


function view($pageName, $data = [], $import = ""){
    extract($data);

    $pageName = str_replace(".", DS, $pageName);
    $filePath = _VIEW.DS.$pageName . ".php";
    
    if(is_file($filePath)) {
        require _VIEW.DS."layouts".DS."header.php";
        require $filePath;
        require _VIEW.DS."layouts".DS."footer.php";
    }
}

function checkInput($resJSON = false){
    foreach($_POST as $input) {
        if(trim($input) === "") {
            if($resJSON) json_response("모든 정보를 기입해 주세요", false);
            else back("모든 정보를 기입해 주세요");
        }
    }
}

function json_response($message, $result = true, $extend = []){
    header("Content-Type: application/json");
    echo json_encode(array_merge($extend, ["message" => $message, "result" => $result]));
    exit;
}