<?php

use App\Router;

// # 메인
Router::get("/", "MainController@indexPage");
Router::get("/store", "MainController@storePage");

Router::get("/online-housing", "MainController@housingPage");
Router::post("/knowhow", "MainController@writeKnowhow");

// # 유저
Router::get("/images/captcha.png", "UserController@captchaImage");
Router::post("/sign-in", "UserController@signIn");
Router::post("/sign-up", "UserController@signUp");
Router::get("/logout", "UserController@logout");

Router::connect();