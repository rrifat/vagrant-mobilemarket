<?php
class Session{

    public static function set($key, $val){
        $_SESSION[$key] = $val;
    }

    public static function get($key){
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    public static function check_session(){
        session_start();
        if (self::get("admin_login") == false) {
            self::destroy();
            header("Location:/SP-2/mobilemarket/login.php");
        }
    }

    public static function check_login(){
        session_start();
        if (self::get("admin_login")== true) {
            header("Location:dashboard.php");
        }
    }

    public static function destroy(){
        session_destroy();
        //header("Location:login.php");
        echo "<script>window.location='/SP-2/mobilemarket/login.php'</script>";
    }
}