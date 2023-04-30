<? 

    require 'db.php';
    require 'fun.php';
    require 't.php';

    class core {
        public function __construct() {
            new db; new fun; new t;
            session_start();
            date_default_timezone_set('Asia/Almaty');
        }
    }

    // data
    $core = new core;

    // lang
    $lang = 'kz';
    if (isset($_GET['lang'])) if ($_GET['lang'] == 'kz' || $_GET['lang'] == 'ru') $_SESSION['lang'] = $_GET['lang'];
    if (isset($_SESSION['lang'])) $lang = $_SESSION['lang'];

    // setting
    $site = mysqli_fetch_array(db::query("select * from `site` where id = 1"));
    $ver = 1.89;
    $site_set = [
        'analitics' => true,
        'header' => true,
        'menu' => true,
        'footer' => true,
        'footer_t' => true,
		// 'swiper' => false,
        // 'plyr' => false,
        // 'aos' => false,
	];
    $scss = ['anim', 'norm', 'main'];
    $sjs = ['norm', 'main'];
    $css = [];
    $js = [];
    $code = rand(1000, 9999);

    // date - time
    $date = date("Y-m-d", time());
    $time = date("H:m:s", time());
    $datetime = date('Y-m-d H:i:s', time());

    // url
	$url = $url_full = $_SERVER['REQUEST_URI'];
	$url = explode('?', $url);
	$url = $url[0];