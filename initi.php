<?php 
    ob_start();
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
        ini_set('session.save_path', 'tmp');    
    }

    if($_SERVER['HTTP_HOST'] == "localhost"){
        $conn = new mysqli("localhost",'root','','shanta');
        $_SESSION['de'] = $_SERVER['REQUEST_URI'];
        $str = $_SESSION['de'];
        $l=0;$j=0;
        for($i=0;$i<strlen($str);$i++){
            if($str[$i] == "/"){
                if($j == 0){
                    $j=1;
                }
                else if($j == 1){
                    $l = $i;
                    $j = 2;
                }
            }
        }
        $_SESSION['de'] = substr($str,0,$l);
    }
    else if($_SERVER['HTTP_HOST'] == "shanta.unaux.com"){
        $conn = new mysqli("sql105.unaux.com","unaux_20494669","iaminlovewithshanta","unaux_20494669_shanta");
        $_SESSION['de'] = "http://$_SERVER[HTTP_HOST]";
    }

    if(!isset($_SESSION['market_build_error']))
        $_SESSION['market_build_error'] = "";
    $_SESSION['sign_error'] = "";
    if(isset($_COOKIE['user_name']))
        {
            $_SESSION['user_name'] = $_COOKIE['user_name'];
            $_SESSION['user_email'] = $_COOKIE['user_email'];
            $_SESSION['user_id'] = $_COOKIE['user_id'];
            $_SESSION['major'] = $_COOKIE['major'];

    }

    // if(!isset($_COOKIE['view'])){
    //     setcookie("view","1",time()+(30*24*60*60),"/");
        
    //     $conn->query("UPDATE views SET num=num+1,last_time='".gmdate("Y/m/d")."' WHERE name='shanta'");
    //     // echo $conn->error;
    // }

