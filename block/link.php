<!-- css -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700;800;900&display=swap" />
<link rel="stylesheet" href="/assets/pl/fontawesome/css/all.min.css" />
<? if ($site_set['swiper']): ?> <link rel="stylesheet" href="/assets/pl/swiper-bundle.min.css" /> <? endif ?>
<? if ($site_set['plyr']): ?> <link rel="stylesheet" href="/assets/pl/plyr.css" /> <? endif ?>

<!-- main css -->
<? foreach ($scss as $i): ?> <link rel="stylesheet" type="text/css" href="/assets/css/<?=$i?>.css?v=<?=$ver?>" /> <? endforeach ?>
<? foreach ($css as $i): ?> <link rel="stylesheet" type="text/css" href="/assets/css/<?=$i?>.css?v=<?=$ver?>" /> <? endforeach ?>

<!-- js -->
<script src="/assets/pl/jquery.min.js"></script>
<script src="/assets/pl/jquery.lazy.min.js"></script>
<script src="/assets/pl/jquery.lazy.plugins.min.js"></script>
<script src="/assets/pl/jquery.mask.min.js"></script>
<script src="/assets/js/fun.js?v=<?=$ver?>"></script>
<? if ($site_set['swiper']): ?> <script src="/assets/pl/swiper-bundle.min.js"></script> <? endif ?>
<? if ($site_set['plyr']): ?> <script src="/assets/pl/plyr.polyfilled.js"></script> <? endif ?>
<? if ($site_set['aos']): ?> <script src="/assets/pl/aos.js"></script> <? endif ?>
<? if ($site_set['autosize']): ?> <script src="/assets/pl/autosize.min.js"></script> <? endif ?>


<? if ($site_set['analitics']): ?>
   <? if ($site['metrika'] != null): ?>
      <script type='text/javascript'>
         (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
         m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
         (window, document, 'script', 'https://mc.yandex.ru/metrika/tag.js', 'ym');
         ym(<?=$site['metrika']?>, 'init', {clickmap:true,trackLinks:true,accurateTrackBounce:true,webvisor:true});
      </script>
   <? endif ?>
   <? if ($site['analitics'] != null): ?>
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-168445294-3"></script>
      <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){ dataLayer.push(arguments); }
      gtag('js', new Date());
      gtag('config', '<?=$site['analitics']?>');
      </script>
   <? endif ?>
   <? if ($site['pixel'] != null): ?>
      <script>
         !function(f,b,e,v,n,t,s)
         {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
         n.callMethod.apply(n,arguments):n.queue.push(arguments)};
         if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
         n.queue=[];t=b.createElement(e);t.async=!0;
         t.src=v;s=b.getElementsByTagName(e)[0];
         s.parentNode.insertBefore(t,s)}(window, document,'script',
         'https://connect.facebook.net/en_US/fbevents.js');
         fbq('init', '<?=$site['pixel']?>');
         fbq('track', 'PageView');
      </script>
   <? endif ?>
<? endif ?>