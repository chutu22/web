<?php
/**
 * Session Class
 */
class Session {

    // Phương thức khởi tạo phiên
    public static function init() {
        if (version_compare(phpversion(), '5.4.0', '<')) {
            if (session_id() == '') {
                session_start();
            }
        } else {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        }
    }

    // Phương thức đặt giá trị phiên
    public static function set($key, $val) {
        $_SESSION[$key] = $val;
    }

    // Phương thức lấy giá trị phiên
    public static function get($key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    // Phương thức kiểm tra phiên
    public static function checkSession() {
        self::init();
        if (self::get("login") == false) {
            self::destroy();
            header("Location:login.php");
        }
    }

    // Phương thức kiểm tra đăng nhập
    public static function checkLogin() {
        self::init();
        if (self::get("login") == true) {
            header("Location:index.php");
        }
    }

    // Phương thức huỷ phiên
    public static function destroy() {
        session_destroy();
        header("Location:login.php");
    }
}
?>