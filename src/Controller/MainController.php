<?php
namespace Controller;

use App\DB;

class MainController {
    function indexPage(){
        view("index");
    }

    function storePage(){
        $import = "<script src=\"js/PurchaseList.js\"></script>
        <script src=\"js/Product.js\"></script>
        <script src=\"js/App.js\"></script>
        <script>
            window.onload = () => {
                let store = new App();
            };
        </script>";

        view("store", [], $import);
    }

    function housingPage(){
        $knowhows = DB::fetchAll("SELECT K.*, U.user_name, U.user_id FROM knowhows K, users U WHERE K.uid = U.id");

        view("online-housing", ["knowhows" => $knowhows]);
    }

    function writeKnowhow(){
        checkInput();
        $content = $_POST['content'];
        $beforeImg = $_FILES['before_img'];
        $afterImg = $_FILES['after_img'];

        $date = time();
        $savePath = _PUB.DS."upload".DS."knowhow";

        $beforeExt = substr($beforeImg['name'], strrpos($beforeImg['name'], '.'));
        $afterExt = substr($afterImg['name'], strrpos($afterImg['name'], '.'));

        $beforeFileName = $date ."-before" . $beforeExt;
        $afterFileName = $date. "-after" . $afterExt;

        move_uploaded_file($beforeImg['tmp_name'], $savePath.DS.$beforeFileName);
        move_uploaded_file($afterImg['tmp_name'], $savePath.DS.$afterFileName);

        $params = [user()->id, $content, $beforeFileName, $afterFileName];

        DB::query("INSERT INTO knowhows(uid, content, before_img, after_img) VALUES (?, ?, ?, ?)", $params);
        
        go("/online-housing", "작성이 완료되었습니다.");
    }

    function giveScore(){
        checkInput();
        extract($_POST);

        $find = DB::find("knowhows", $kid);
        if(!$find) json_response("게시글을 찾을 수 없습니다.", false);

        if(!is_numeric($score) || $score < 1 || $score > 5){
            json_response("올바른 값을 입력하세요", false);
        }

        $total = $find->scoreTotal + $score;
        $count = $find->scoreCount + 1;

        DB::query("UPDATE knowhows SET scoreCount = ?, scoreTotal = ? WHERE id = ?", [$count, $total, $find->id]);

        json_response("평점이 갱신되었습니다.", true, ["total" => $total, "count" => $count]);
    }
}