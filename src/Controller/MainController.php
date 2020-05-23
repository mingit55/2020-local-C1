<?php
namespace Controller;

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
        view("online-housing");
    }
}