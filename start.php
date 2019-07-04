<?php
require('class.php');
@set_time_limit(0);
@clearstatcache();
@ini_set('max_execution_time',0);
@ini_set('output_buffering',0);

echo "TurkHackTeam.Org - Quiec Gururla Sunar!\n";

echo "Kardeşim Kullanıyorsun Bir Teşekkürü Eksik Etmezsin :)\n";

echo " -----------------------------\n";

echo "Kaç adet hesap istiyorsunuz [Fazla Yapmak Sunucuzu Yorar][?]:";
$count = 1;
echo "Kaç saniyede bir üretilsin [10 yapmanız önerilir] [?]:";
$sleep = 10;
echo "[!] Hesaplar oluşuyor. . .\n\n";
$i = new instaCreator();
$i->userCreate($count,$sleep);
