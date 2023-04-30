<?php 

    require 'db.php';
    require 'smsc_api.php';
    require 'fun.php';
    require 't.php';

    class core {
        public static $user_ph = false;
        public static $user_data = array();

        public function __construct() {
            new db; new fun; new t;
            $lifetime = 3600 * 24 * 30;
            session_start();
            setcookie(session_name(), session_id(), time() + $lifetime);
            date_default_timezone_set('Asia/Almaty');
            $this->authorize();
        }

        private function authorize() {
            $user_ph = false;
            $user_ps = false;
            
            if (isset($_SESSION['uph']) && isset($_SESSION['ups'])) {
                $user_ph = $_SESSION['uph'];
                $user_ps = $_SESSION['ups'];
            }

            if ($user_ph && $user_ps) {
                $user = db::query("SELECT * FROM user WHERE phone = '$user_ph' and phone is not null and phone != ''");
                if (mysqli_num_rows($user)) {
                    $user_data = mysqli_fetch_assoc($user);
                    if ($user_ps == $user_data['password'] && $user_data['right']) {
                        self::$user_ph = $user_ph;
                        self::$user_data = $user_data;
                    } else $this->user_unset();
                } else $this->user_unset();
            }
        }
    
        public function user_unset() {
            self::$user_ph = false;
            self::$user_data = array();
            unset($_SESSION['uph']);
            unset($_SESSION['ups']);
        }
    }

    // data
    $core = new core;
    $user = core::$user_data;
    $user_id = $user['id'];
    $user_right = $user['right'];
    $user_super_right = $user['super_right'];

    // lang
    $lang = 'kz';
    if (isset($_GET['lang'])) if ($_GET['lang'] == 'kz' || $_GET['lang'] == 'ru') $_SESSION['lang'] = $_GET['lang'];
    if (isset($_SESSION['lang'])) $lang = $_SESSION['lang'];

    // setting
    $site = mysqli_fetch_array(db::query("select * from `site` where id = 1"));
    $ver = 1.991;
    $site_set = [
        'analitics' => true,
        'header' => true,
        'menu' => true,
        'utop' => true,
		// 'swiper' => false,
        // 'plyr' => false,
        // 'aos' => false,
	];
    $scss = ['norm', 'admin/main'];
    $sjs = ['norm', 'admin/main'];
    $css = []; $js = [];
    $code = rand(1000, 9999);

    // date - time
    $date = date("Y-m-d", time());
    $time = date("H:m:s", time());
    $datetime = date('Y-m-d H:i:s', time());

    // url
	$url = $url_full = $_SERVER['REQUEST_URI'];
	$url = explode('?', $url);
	$url = $url[0];