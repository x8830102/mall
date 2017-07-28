<?php
session_start();
$this_page = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
// assigment encode session from url to local
if(isset($_GET['sso'])){
	$sesi = json_decode(base64_decode($_GET['sso']),true);
	
	foreach($sesi as $key=>$val){
		$_SESSION[$key]=$val;
	}
	//header("location:".$GLOBALS['this_page']);
}

function sso_login($url=''){
	// if logout
	
	if(isset($_GET['o'])){
		$host_login = "http://".parse_url($url,PHP_URL_HOST);
		$host_web = "http://".$_SERVER['HTTP_HOST'];
		if($host_login != $host_web){
			// destroy session
			session_destroy();
		}
		header("location:".$url."?o=l");
		echo 'Please Wait...<meta http-equiv="refresh" content="0;url='.$url.'?o=l&u='.$this_page.'">';
		exit;
	}else{
		if(empty($_SESSION)){
			//echo "location:".$url."?u=".$GLOBALS['this_page'];
			header("location:".$url."?u=".$GLOBALS['this_page']);
		}else{
			if(isset($_SESSION['url'])){
				$this_page =  "http://".$_SERVER['HTTP_HOST'];
				$pattern = preg_quote($this_page);
				if(!preg_grep('#' . $pattern . '#', $_SESSION['url'])){
					header("location:".$url."?u=".$GLOBALS['this_page']);
				}
			}
		}
	}
}

//print_r($_SESSION);
?>
