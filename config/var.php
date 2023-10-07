<? 

   // lang
   $lang = 'kz';
   if (isset($_GET['lang'])) if ($_GET['lang'] == 'kz' || $_GET['lang'] == 'ru') $_SESSION['lang'] = $_GET['lang'];
   if (isset($_SESSION['lang'])) $lang = $_SESSION['lang'];

   // 
   $ver = 2.112;

   // date - time
   $date = date("Y-m-d", time());
   $time = date("H:m:s", time());
   $datetime = date('Y-m-d H:i:s', time());

   // url
	$url = $url_full = $_SERVER['REQUEST_URI'];
	$url = explode('?', $url);
	$url = $url[0];



   // setting
   $site_set = [
      'analitics' => true,
      'header' => true,
      'menu' => true,
      'mheader' => false,

      'footer' => true,
      'footer_t' => true,
      'form' => true,
      'cl_wh' => true,
      
      'swiper' => false,
      'plyr' => false,
      'aos' => false,
      'autosize' => false,
   ];
   $scss = ['anim', 'norm', 'main'];
   $sjs = ['norm', 'main'];
   $css = [];
   $js = [];
   $code = rand(1000, 9999);