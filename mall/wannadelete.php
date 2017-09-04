<form method="POST" action="wannadelete.php">
	<input type="text" id="user_login" name="user_login" placeholder="byebye-username" ">
</form>
<style>
    input {
			padding:5px 15px; background:#ccc; border:0 none;
			-webkit-border-radius: 5px;
			border-radius: 5px;
			margin-left: auto;
			margin-right: auto; }
</style>

<?php
	$user_login = $_POST['user_login'];
	if($_POST['user_login']){
		$pdo_cmg = new PDO("mysql:host=localhost;dbname=cmg58891_a;charset=utf8","cmg58891","rgn26842",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
		$pdo_cc = new PDO("mysql:host=localhost;dbname=lifelink_cc_fans;charset=utf8","lifelinkcc","rgn26842",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
		$pdo_f = new PDO("mysql:host=localhost;dbname=twlifeli_storedata;charset=utf8","twlifelinkcom","rgn26842",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );

		//for cc
		$ccuser = $user_login;

		$cuser_id = $pdo_cc->query("SELECT ID FROM wp_users WHERE user_login = '".$user_login."'");
		$cuser_id = $cuser_id->fetch();
		$cuid = $cuser_id['ID'];

		$cblog_id = $pdo_cc->query("SELECT meta_value FROM wp_usermeta WHERE user_id = '".$cuid."' and meta_key = 'primary_blog'");
		$cblog_id = $cblog_id->fetch();
		$cbid = $cblog_id['meta_value'];

		echo 'CC<br>username:'.$ccuser.'<br>blog_id:'.$cbid.'<br>------------------------<br>';

		//Drop cc table
		$cblog_id = $pdo_cc->query("DROP table wp_".$cbid."_ai1ec_events");
		$cblog_id = $pdo_cc->query("DROP table wp_".$cbid."_ai1ec_event_category_meta");
		$cblog_id = $pdo_cc->query("DROP table wp_".$cbid."_ai1ec_event_instances");
		$cblog_id = $pdo_cc->query("DROP table wp_".$cbid."_commentmeta");
		$cblog_id = $pdo_cc->query("DROP table wp_".$cbid."_comments");
		$cblog_id = $pdo_cc->query("DROP table wp_".$cbid."_forum_forums");
		$cblog_id = $pdo_cc->query("DROP table wp_".$cbid."_forum_posts");
		$cblog_id = $pdo_cc->query("DROP table wp_".$cbid."_forum_threads");
		$cblog_id = $pdo_cc->query("DROP table wp_".$cbid."_links");
		$cblog_id = $pdo_cc->query("DROP table wp_".$cbid."_options");
		$cblog_id = $pdo_cc->query("DROP table wp_".$cbid."_postmeta");
		$cblog_id = $pdo_cc->query("DROP table wp_".$cbid."_posts");
		$cblog_id = $pdo_cc->query("DROP table wp_".$cbid."_termmeta");
		$cblog_id = $pdo_cc->query("DROP table wp_".$cbid."_terms");
		$cblog_id = $pdo_cc->query("DROP table wp_".$cbid."_term_relationships");
		$cblog_id = $pdo_cc->query("DROP table wp_".$cbid."_term_taxonomy");
		$cblog_id = $pdo_cc->query("DROP table wp_".$cbid."_yasr_log");
		$cblog_id = $pdo_cc->query("DROP table wp_".$cbid."_yasr_multi_set");
		$cblog_id = $pdo_cc->query("DROP table wp_".$cbid."_yasr_multi_set_fields");
		$cblog_id = $pdo_cc->query("DROP table wp_".$cbid."_yasr_multi_values");
		$cblog_id = $pdo_cc->query("DELETE FROM wp_users WHERE ID = '".$cuid."'");
		$cblog_id = $pdo_cc->query("DELETE FROM wp_usermeta WHERE user_id = '".$cuid."'");
		$cblog_id = $pdo_cc->query("DELETE FROM wp_registration_log WHERE blog_id = '".$cbid."'");
		$cblog_id = $pdo_cc->query("DELETE FROM wp_blogs WHERE blog_id = '".$cbid."'");
		$cblog_id = $pdo_cc->query("DELETE FROM wp_signups WHERE user_login = '".$ccuser."'");

		//for f
		$fuser = $user_login;
		$fuser_id = $pdo_f->query("SELECT ID FROM wp_users WHERE user_login = '".$user_login."'");
		$fuser_id = $fuser_id->fetch();
		$fuid = $fuser_id['ID'];

		$fblog_id = $pdo_f->query("SELECT meta_value FROM wp_usermeta WHERE user_id = '".$fuid."' and meta_key = 'primary_blog'");
		$fblog_id = $fblog_id->fetch();
		$fbid = $fblog_id['meta_value'];

		echo 'F<br>username:'.$fuser.'<br>blog_id:'.$fbid.'<br>------------------------<br>';

		if($fbid){
			$fblog_id = $pdo_f->query("DROP table wp_".$fbid."_ai1ec_events");
			$fblog_id = $pdo_f->query("DROP table wp_".$fbid."_ai1ec_event_category_meta");
			$fblog_id = $pdo_f->query("DROP table wp_".$fbid."_ai1ec_event_instances");
			$fblog_id = $pdo_f->query("DROP table wp_".$fbid."_commentmeta");
			$fblog_id = $pdo_f->query("DROP table wp_".$fbid."_comments");
			$fblog_id = $pdo_f->query("DROP table wp_".$fbid."_forum_forums");
			$fblog_id = $pdo_f->query("DROP table wp_".$fbid."_forum_posts");
			$fblog_id = $pdo_f->query("DROP table wp_".$fbid."_forum_threads");
			$fblog_id = $pdo_f->query("DROP table wp_".$fbid."_links");
			$fblog_id = $pdo_f->query("DROP table wp_".$fbid."_options");
			$fblog_id = $pdo_f->query("DROP table wp_".$fbid."_postmeta");
			$fblog_id = $pdo_f->query("DROP table wp_".$fbid."_posts");
			$fblog_id = $pdo_f->query("DROP table wp_".$fbid."_termmeta");
			$fblog_id = $pdo_f->query("DROP table wp_".$fbid."_terms");
			$fblog_id = $pdo_f->query("DROP table wp_".$fbid."_term_relationships");
			$fblog_id = $pdo_f->query("DROP table wp_".$fbid."_term_taxonomy");
			$fblog_id = $pdo_f->query("DROP table wp_".$fbid."_yasr_log");
			$fblog_id = $pdo_f->query("DROP table wp_".$fbid."_yasr_multi_set");
			$fblog_id = $pdo_f->query("DROP table wp_".$fbid."_yasr_multi_set_fields");
			$fblog_id = $pdo_f->query("DROP table wp_".$fbid."_yasr_multi_values");
			$fblog_id = $pdo_f->query("DELETE FROM wp_usermeta WHERE user_id = '".$fuid."'");
			$fblog_id = $pdo_f->query("DELETE FROM wp_registration_log WHERE blog_id = '".$fbid."'");
			$fblog_id = $pdo_f->query("DELETE FROM wp_blogs WHERE blog_id = '".$fbid."'");
			$fblog_id = $pdo_f->query("DELETE FROM wp_signups WHERE user_login = '".$fuser."'");

		}
		$fblog_id = $pdo_f->query("DELETE FROM wp_users WHERE  ID = '".$fuid."'");

		//for cmg
		$decmg = $pdo_cmg->query("DELETE FROM memberdata WHERE m_username = '".$user_login."' ");
		echo 'We already delete '.$user_login.' from F/CC/CMG.<br>';
		echo 'Remember to delete the site folder if it has blog_id!!<br>';
		echo 'code by Vege.';
		$pdo_f = NULL;
		$pdo_cc = NULL;
		$pdo_cmg = NULL;
	}
?>