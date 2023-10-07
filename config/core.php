<? 

    require 'db.php';
    require 'fun.php';
    require 't.php';
    require 'var.php';

    class core {
        public function __construct() {
            new db; new fun; new t;
            session_start();
            date_default_timezone_set('Asia/Almaty');
        }
    }

    // data
    $core = new core;

    // setting
    $site = mysqli_fetch_array(db::query("select * from `site` where id = 1"));