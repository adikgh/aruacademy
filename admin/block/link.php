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