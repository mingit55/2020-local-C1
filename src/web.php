<?php

use App\Router;

// # 메인
Router::get("/", "MainController@indexPage");
Router::get("/store", "MainController@storePage");

Router::get("/online-housing", "MainController@housingPage", "user");
Router::post("/knowhows", "MainController@writeKnowhow", "user");
Router::post("/knowhows/score", "MainController@giveScore", "user");

// # 시공사
Router::get("/professional-builder", "BuilderController@builderPage", "user");
Router::post("/reviews", "BuilderController@writeReview", "user");

// # 견적
Router::get("/estimate", "BuilderController@estimatePage", "user");
Router::post("/estimate/request", "BuilderController@requestEstimate", "user");
Router::post("/estimate/response", "BuilderController@responseEstimate", "user");
Router::get("/estimate/response", "BuilderController@showEstimate", "user");
Router::post("/estimate/select", "BuilderController@selectEstimate", "user");

// # 유저
Router::get("/images/captcha.png", "UserController@captchaImage");
Router::post("/sign-in", "UserController@signIn");
Router::post("/sign-up", "UserController@signUp");
Router::get("/logout", "UserController@logout");

Router::connect();