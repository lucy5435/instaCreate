<?php
class instaCreator {
// Buraları Düzenleyin !
protected $trProxy = "88.255.182.170"; // TR olması zorunludur.
protected $trProxy_Port = "8080";
protected $trProxy_Tur = "HTTPS";
	protected $csrf_token = '8T1YSTEUhZm0D13VLpqncYF0eaHxwfmf';
	protected $mid_token = 'XMby6wABAAHpx_WQyBTy4tSCj7Bl';

	private function connectInstagram($username, $password, $email, $full_name, $proxy){

		$channel = curl_init();
		curl_setopt($channel, CURLOPT_URL, "https://www.instagram.com/accounts/web_create_ajax/");
		curl_setopt($channel, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($channel, CURLOPT_POSTFIELDS, "email=".$email."&password=".$password."&username=".$username."&first_name=".$full_name."&seamless_login_enabled=1&tos_version=row");
		curl_setopt($channel, CURLOPT_POST, 1);
		curl_setopt($channel, CURLOPT_ENCODING, 'gzip, deflate');
		/*if($proxy){
			curl_setopt($channel, CURLOPT_PROXY, $proxy);
			curl_setopt($channel, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS4);
		}*/

		$headers = array();
		$headers[] = "Host: www.instagram.com";
		$headers[] = "Cookie: fbm_124024574287414=base_domain=.instagram.com; rur=PRN; csrftoken={$this->csrf_token}; mid={$this->mid_token}; fbm_124024574287414=\"base_domain=.instagram.com\"; mcd=1";
		$headers[] = "User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.124 Safari/537.36";
		$headers[] = "Origin: https://www.instagram.com";
		$headers[] = "X-Instagram-Ajax: 8958fe1e75ab";
		$headers[] = "Content-Type: application/x-www-form-urlencoded";
		$headers[] = "Accept: */*";
		$headers[] = "X-Requested-With: XMLHttpRequest";
		$headers[] = "Save-Data: on";
		$headers[] = "X-Csrftoken: {$this->csrf_token}";
		$headers[] = "Referer: https://www.instagram.com/";
		$headers[] = "Accept-Language: tr-TR,en-US,en;q=0.8,id;q=0.6";

		curl_setopt($channel, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($channel, CURLOPT_COOKIEJAR, 'cookies/'.$username.'.txt');
		$result = curl_exec($channel);
		if(curl_errno($channel)){
			echo 'Error:' . curl_error($channel);
		}
		curl_close($channel);
		return $result;
	}
public function bio($username, $id){
		$channel1 = curl_init();
		curl_setopt($channel1, CURLOPT_URL, "https://www.instagram.com/web/friendships/$id/follow/");
		curl_setopt($channel1, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($channel1, CURLOPT_POST, 1);
		curl_setopt($channel1, CURLOPT_COOKIEFILE, 'cookies/'.$username.'.txt');
		curl_setopt($channel1, CURLOPT_ENCODING, 'gzip, deflate');
		$headers = array();
		$headers[] = "Host: www.instagram.com";
		$headers[] = "Cookie: fbm_124024574287414=base_domain=.instagram.com; rur=PRN; csrftoken={$this->csrf_token}; mid={$this->mid_token}; fbm_124024574287414=\"base_domain=.instagram.com\"; mcd=1";
		$headers[] = "User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.124 Safari/537.36";
		$headers[] = "Origin: https://www.instagram.com";
		$headers[] = "X-Instagram-Ajax: 8958fe1e75ab";
		$headers[] = "Content-Type: application/x-www-form-urlencoded";
		$headers[] = "Accept: */*";
		$headers[] = "X-Requested-With: XMLHttpRequest";
		$headers[] = "Save-Data: on";
		$headers[] = "X-Csrftoken: {$this->csrf_token}";
		$headers[] = "Referer: https://www.instagram.com/accounts/login";
		$headers[] = "Accept-Language: tr-TR,en-US,en;q=0.8,id;q=0.6";

		curl_setopt($channel1, CURLOPT_HTTPHEADER, $headers);
/*curl_setopt($channel1, CURLOPT_PROXYPORT, $this->trProxy_Port);
curl_setopt($channel1, CURLOPT_PROXYTYPE, $this->trProxy_Tur); // HTTP/HTTPS türü proxy kullanacağız.
curl_setopt($channel1, CURLOPT_PROXY, $this->trProxy);*/
		$result = curl_exec($channel1);
		curl_close($channel1);
		}


	private function getUser(){
		$channel = curl_init();
		curl_setopt($channel, CURLOPT_URL,"http://api.randomuser.me/?nat=tr");
		curl_setopt($channel, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0");
		curl_setopt($channel, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($channel, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($channel, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($channel, CURLOPT_FOLLOWLOCATION, true);
		$result = curl_exec($channel);
		curl_close($channel);
		return $result;
	}

	private function replaceTurkish($text){
		$text = trim($text);
		$search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü',' ');
		$replace = array('c','c','g','g','i','i','o','o','s','s','u','u','-');
		$new_text = str_replace($search,$replace,$text);
		return $new_text;
	}

	private function generateNumbers($char, $length = 3){
		$characters = $char;
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
	}

    private function getProxy(){
        $proxyFile = @fopen('proxylist.txt', 'r');
        if($proxyFile){
            $getProxies = explode(PHP_EOL, fread($proxyFile, filesize('proxylist.txt')));
        }
        $getRandom = (count($getProxies) > 0) ? $getProxies[rand(0, (count($getProxies) - 1))] : NULL;
        return $getRandom;
    }

	public function userCreate($count = 1, $sleep = 10){
		do {
			for($i = 1; $i < $count; $i++){
				$randomUser = $this->getUser();
				$randomUser = json_decode($randomUser);
				$randomUser_First_Name = $randomUser->results[0]->name->first;
				$randomUser_Last_Name = $randomUser->results[0]->name->last;
				$randomUser_Full_Name = $this->replaceTurkish("{$randomUser_First_Name} {$randomUser_Last_Name}");
				$randomUser_User_Name = $this->replaceTurkish("{$randomUser_First_Name}{$randomUser_Last_Name}".$this->generateNumbers('1234567890'));
				$randomUser_Email_Domain = array('yandex.com', 'hotmail.com','gmail.com','icloud.com','outlook.com');
				$randomUser_Email_Adress = "{$randomUser_User_Name}@".$randomUser_Email_Domain[mt_rand(0, count($randomUser_Email_Domain) - 1)];
				$randomUser_Password = "Quiec123";
				$randomUser_Bio = "Yeni+Hesap";
				$randomUser_Proxy = $this->getProxy();
				$randomUser_Save_Docs = "users.txt";

				echo $randomUser_User_Name;
$randomUser_id = "5886592160";
echo "[!] $i Hesap oluşturuluyor!..\n";
				$userCreate = $this->connectInstagram($randomUser_User_Name, $randomUser_Password, $randomUser_Email_Adress, $randomUser_Full_Name, $randomUser_Proxy);
								$userCreate = json_decode($userCreate);
				if($userCreate->account_created == "true"){
fwrite(fopen($randomUser_Save_Docs,"a+") ,"$randomUser_User_Name:$randomUser_Password \n");

						$kadi = json_decode(file_get_contents('http://insta-node.herokuapp.com/_validate_username?username='.$randomUser_User_Name.''), true)['valid'];
					if($kadi == false){
							echo "[!] ".$i.". Açılan hesap: ".$randomUser_User_Name.":".$randomUser_Password."\n";
							echo "[!] Seçtiğiniz hesapa takip ettiriliyor!\n";
$this->bio($randomUser_User_Name, $randomUser_id);
echo "[•] Takip Başarılı\n";
																	}

				}else{
					echo "[!] ".$i.". Açılamıyan hesap: ".$randomUser_User_Name.":".$randomUser_Password."\n";
					print_r($userCreate);
				}
				sleep($sleep);
			}

		}while($count == 'false');
	}
}


