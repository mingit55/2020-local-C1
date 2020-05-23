<?php

require __DIR__."/App/DB.php";

use App\DB;


$userList = [
    [ "specialist1", hash("sha256", "1234"), "전문가1", "specialist1.jpg", "BUILDER" ],
    [ "specialist2", hash("sha256", "1234"), "전문가2", "specialist2.jpg", "BUILDER" ],
    [ "specialist3", hash("sha256", "1234"), "전문가3", "specialist3.jpg", "BUILDER" ],
    [ "specialist4", hash("sha256", "1234"), "전문가4", "specialist4.jpg", "BUILDER" ]
];

foreach($userList as $user) {
    DB::query("INSERT INTO users(user_id, password, user_name, photo, type) VALUES (?, ?, ?, ?, ?)", $user);
}