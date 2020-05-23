<?php
namespace Controller;

use App\DB;

class UserController {
    function captchaImage(){
        // # 캡챠 텍스트
        $captcha = "";
        $STRING = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890";
        $length = 5;
        for($i = 0; $i < $length; $i ++){
            $captcha .= $STRING[rand(0, strlen($STRING) - 1)];
        }   
        $_SESSION['captcha'] = $captcha;

        // # 변수 준비
        $fontFile = _PUB.DS."fonts".DS."NanumSquareR.ttf";
        $fontSize = 30;
        $width = 400;
        $height = 100;

        // # 이미지 만들기
        $img = imagecreatetruecolor($width, $height);
        $c_transparent = imagecolorallocatealpha($img, 255, 255, 255, 0);
        $c_black = imagecolorallocate($img, 64, 64, 64);
        
        imagealphablending($img, true);
        imagefill($img, 0, 0, $c_transparent);

        imagettftext($img, $fontSize, 0, $width / 2 - $fontSize * $length / 2, $height / 2, $c_black, $fontFile, $captcha);

        header("Content-Type", "image/png");
        imagepng($img);
        imagedestroy($img);
    }
    
    // # 회원가입
    function signUp(){
        checkInput();
        extract($_POST);
        
        $exist = DB::who($user_id);
        if($exist) back("중복되는 아이디입니다. 다른 아이디를 사용해주세요.");
        if($_SESSION['captcha'] !== $captcha) back("자동입력방지 문자를 잘못 입력하였습니다.");

        $photo = $_FILES['photo'];
        $uploadPath = _PUB.DS."upload".DS."user-image";
        $ext = substr($photo['name'], strrpos($photo['name'], "."));
        $fileName = time() . $ext;
        move_uploaded_file($photo['tmp_name'], $uploadPath . DS. $fileName);

        DB::query("INSERT INTO users(user_id, password, user_name, photo) VALUES (?, ?, ?, ?)", [$user_id, $password, $user_name, $fileName]);

        go("/", "회원가입 되었습니다.");
    }

    // # 로그인
    function signIn(){
        
    }
}