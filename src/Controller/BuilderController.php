<?php
namespace Controller;

use App\DB;

class BuilderController {
    // # 전문가

    function builderPage(){
        // # 전문가 리스트
        $builder_scores = "SELECT COUNT(*) scoreCount, SUM(score) scoreTotal, bid FROM reviews GROUP BY bid";
        $sql = "SELECT U.*, ifnull(B.scoreCount, 0) scoreCount, ifnull(B.scoreTotal, 0) scoreTotal 
                FROM users U LEFT JOIN ($builder_scores) B ON B.bid = U.id 
                WHERE U.type = 'BUILDER'";
        $builders = DB::fetchAll($sql);

        // # 리뷰 리스트
        $userSQL = "SELECT DISTINCT user_id, user_name, U.id uid FROM reviews R, users U WHERE R.uid = U.id";
        $builderSQL = "SELECT DISTINCT user_id builder_id, user_name builder_name, photo b_photo, U.id bid FROM reviews R, users U WHERE R.bid = U.id";
        $sql = "SELECT R.*, U.*, B.*
                FROM reviews R
                LEFT JOIN ($userSQL) U ON U.uid = R.uid
                LEFT JOIN ($builderSQL) B ON B.bid = R.bid";

        $reviews = DB::fetchAll($sql); 
        view("professional-builder", ["builders" => $builders, "reviews" => $reviews]);
    }

    function writeReview(){
        checkInput();
        extract($_POST);

        $builder = DB::find("users", $builder_id);
        if(!$builder) {
            back("리뷰를 작성할 전문가를 찾을 수 없습니다.");
        }        
        if(!is_numeric($price)) {
            back("정확한 비용을 입력해 주세요.");
        }
        
        $params = [user()->id, $builder_id, $content, (int)$price, $score];
        DB::query("INSERT INTO reviews(uid, bid, content, price, score) VALUES(?, ?, ?, ?, ?)", $params);
        go("/professional-builder", "리뷰가 작성되었습니다.");
    }


    // # 시공 견적
    function estimatePage(){
        // # 모든 요청 목록
        $sql = "SELECT req.*, U.user_id, U.user_name, ifnull(res.count, 0) count  
                FROM request req 
                LEFT JOIN users U ON U.id = req.uid
                LEFT JOIN (SELECT COUNT(*) count, rid FROM response GROUP BY rid) res ON res.rid = req.id";
        $requests = DB::fetchAll($sql);

        // # 요청 목록 중 자신이 응답한 요청 ID 배열
        $_myResponse = DB::fetchAll("SELECT rid FROM response WHERE bid = ?", [user()->id]);
        $myResponse = [];
        foreach($_myResponse as $res) {
            $myResponse[] = $res->rid;
        }

        // # 자신이 응답한 목록
        $sql = "SELECT res.*, req.start_date, req.content, U.user_id, U.user_name 
                FROM response res 
                INNER JOIN request req ON res.rid = req.id
                INNER JOIN users U ON U.id = req.uid
                WHERE res.bid = ?";
        $response = DB::fetchAll($sql, [user()->id]);

        view("estimate", ["requests" => $requests, "myResponse" => $myResponse, "response" => $response]);
    }

    function requestEstimate(){
        checkInput();
        extract($_POST);
        
        DB::query("INSERT INTO request(uid, start_date, content) VALUES (?, ?, ?)", [user()->id, $start_date, $content]);
        go("/estimate", "견적 요청이 완료되었습니다.");
    }

    function responseEstimate(){
        checkInput();
        extract($_POST);

        $find = DB::find("request", $rid);
        if(!$find) back("해당 요청이 존재하지 않습니다.");
        if(!is_numeric($price)) back("정확한 금액을 입력해 주세요");
        
        DB::query("INSERT INTO response(rid, bid, price) VALUES (?, ?, ?)", [$rid, user()->id, $price]);
        go("/estimate", "견적 보내기가 완료되었습니다.");
    }

    function showEstimate(){
        if(isset($_GET['id']) && is_numeric($_GET['id'])){
            $req = DB::find("request", $_GET['id']);

            if(!$req) json_response("견적 요청을 찾을 수 없습니다", false, ["id" => $_GET['id']]);

            $sql = "SELECT res.*, U.user_name, U.user_id FROM response res LEFT JOIN users U ON U.id = res.bid WHERE res.rid = ?";
            $estimates = DB::fetchAll($sql, [$req->id]);

            json_response("해당 요청에 대한 견적 목록입니다.", true, ["request" => $req, "estimates" => $estimates]);
        }
        http_response_code(404);
    }

    function selectEstimate(){
        checkInput(true);  
        extract($_POST);
        
        $request = DB::find("request", $req);
        $response = DB::find("response", $res);
        
        if(!$request || !$response) json_response("대상이 존재하지 않습니다.", false);
        
        DB::query("UPDATE request SET sid = ? WHERE id = ?", [$response->id, $request->id]);
        DB::query("UPDATE response SET status = '선택' WHERE id = ?", [$response->id]);
        DB::query("UPDATE response SET status = '미선택' WHERE id <> ? AND rid = ?", [$response->id, $request->id]);

        json_response("견적이 선택되었습니다.");
    }
}