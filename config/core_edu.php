<? 

    require 'db.php';
    require 'fun.php';
    require 't.php';
    require 'smsc_api.php';
    require 'var.php';

    class core {
        public static $user_ph = false;
        public static $user_pm = false;
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
            $user_pm = false;
            $user_ps = false;

            if ((isset($_SESSION['uph']) && isset($_SESSION['ups'])) || (isset($_SESSION['upm']) && isset($_SESSION['ups']))) {
                if (isset($_SESSION['uph'])) $user_ph = $_SESSION['uph'];
                else $user_pm = $_SESSION['upm'];
                $user_ps = $_SESSION['ups'];
            } else if ((isset($_COOKIE['uph']) && isset($_COOKIE['ups'])) || (isset($_COOKIE['upm']) && isset($_COOKIE['ups']))) {
                $user_ph = $_COOKIE['uph'];
                $user_pm = $_COOKIE['upm'];
                $user_ps = $_COOKIE['ups'];
            }
            if (($user_ph && $user_ps) || ($user_pm && $user_ps)) {
                $user = db::query("SELECT * FROM user WHERE phone = '$user_ph' and phone is not null and phone != ''");
                $user2 = db::query("SELECT * FROM user WHERE mail = '$user_pm' and mail is not null and mail != ''");
                if (mysqli_num_rows($user)) {
                    $user_data = mysqli_fetch_assoc($user);
                    if ($user_ps == $user_data['password']) {
                        self::$user_ph = $user_ph;
                        self::$user_data = $user_data;
                    } else $this->user_unset();
                } elseif (mysqli_num_rows($user2)) {
                    $user_data = mysqli_fetch_assoc($user2);
                    if ($user_ps == $user_data['password']) {
                        self::$user_pm = $user_pm;
                        self::$user_data = $user_data;
                    } else $this->user_unset();
                } else $this->user_unset();
            }
        }
    
        public function user_unset() {
            self::$user_ph = false;
            self::$user_pm = false;
            self::$user_data = array();
            unset($_SESSION['uph']);
            unset($_SESSION['upm']);
            unset($_SESSION['ups']);
            setcookie('uph', '', time(), '/');
            setcookie('upm', '', time(), '/');
            setcookie('ups', '', time(), '/');
        }
        
    }

    // data
    $core = new core;
    $user = core::$user_data;
    $user_id = $user_right = false;
    if ($user) {
        $user_id = $user['id'];
        $user_right = $user['right'];
        $user_super_right = $user['super_right'];
    }



    // setting
    $site = mysqli_fetch_array(db::query("select * from `site` where id = 1"));
    $scss = ['anim', 'norm', 'education/main'];
    $sjs = ['norm', 'education/main'];

    $site_set['cl_wh'] = false;
    $site_set['form'] = false;