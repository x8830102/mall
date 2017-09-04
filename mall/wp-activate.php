<?php
//session_start();

/**
 * Confirms that the activation key that is sent in an email after a user signs
 * up for a new site matches the key for that user and then displays confirmation.
 *
 * @package WordPress
 */

define( 'WP_INSTALLING', true );

/** Sets up the WordPress Environment. */
require( dirname(__FILE__) . '/wp-load.php' );

require( dirname( __FILE__ ) . '/wp-blog-header.php' );

if ( !is_multisite() ) {
	wp_redirect( wp_registration_url() );
	die();
}

if ( is_object( $wp_object_cache ) )
	$wp_object_cache->cache_enabled = false;

// Fix for page title
$wp_query->is_404 = false;

/**
 * Fires before the Site Activation page is loaded.
 *
 * @since 3.0.0
 */
//do_action( 'activate_header' );

/**
 * Adds an action hook specific to this page.
 *
 * Fires on {@see 'wp_head'}.
 *
 * @since MU
 */
function do_activate_header() {
	/**
	 * Fires before the Site Activation page is loaded.
	 *
	 * Fires on the {@see 'wp_head'} action.
     *
     * @since 3.0.0
     */
    do_action( 'activate_wp_head' );
}
add_action( 'wp_head', 'do_activate_header' );

/**
 * Loads styles specific to this page.
 *
 * @since MU
 */
function wpmu_activate_stylesheet() {
	?>
	<style type="text/css">
		form { margin-top: 2em; }
		#submit, #key { width: 90%; font-size: 24px; }
		#language { margin-top: .5em; }
		.error { background: #f66; }
		span.h3 { padding: 0 8px; font-size: 1.3em; font-weight: bold; }
	</style>
	<?php
}
add_action( 'wp_head', 'wpmu_activate_stylesheet' );

get_header( 'wp-activate' );
?>
<script src="wp-includes/js/jquery/jquery-3.1.1.min.js"></script>
<div id="signup-content" class="widecolumn" >
	<div class="wp-activate-container">
	<?php if ( empty($_GET['key']) && empty($_POST['key']) ) { ?>

		<h2><?php echo "請至電子信箱收取串門子「開通帳號通知」";//_e('Activation Key Required') ?></h2>
		<!--<form name="activateform" id="activateform" method="post" action="<?php //echo network_site_url('wp-activate.php'); ?>">
			<p>
			    <label for="key"><?php //_e('Activation Key:') ?></label>
			    <br /><input type="text" name="key" id="key" value="" size="50" />
			</p>
			<p class="submit">
			    <input id="submit" type="submit" name="Submit" class="submit" value="<?php //esc_attr_e('Activate') ?>" />
			</p>
		</form>
-->
		
	<?php } else {

		$key = !empty($_GET['key']) ? $_GET['key'] : $_POST['key'];
		$result = wpmu_activate_signup( $key );
		//$_SESSION['bd']=$result['blog_id'];require_once('rd_data.php');
		if ( is_wp_error($result) ) {
			if ( 'already_active' == $result->get_error_code() || 'blog_taken' == $result->get_error_code() ) {
				$signup = $result->get_error_data();
				?>
				
				<?php 
				echo '<p class="lead-in">';
				
					?>
				<h2><?php _e( 'An error occurred during the activation' ); ?></h2>
				<p><?php echo '該金鑰已經啟用過！'; ?></p>				
				<?php echo '</p>';
				
			}
		} else {
			$url = isset( $result['blog_id'] ) ? get_blogaddress_by_id( (int) $result['blog_id'] ) : '';
			$user = get_userdata( (int) $result['user_id'] );
			?>
			<div style="text-align: center;margin-left: auto;margin-right: auto;">
			<h2><?php _e('您的帳號啟用了！'); ?></h2>

			<div id="signup-welcome">
			<?php 
				//
				$btc = $_POST["btc"];
				$fn = $_POST["fn"];
				if(!empty($btc)){
					$src = "http://$fn.lifelink.cc/BtoC-signup.php";
				}else{
					$src="http://lifelink.cc/entrance/login.php?u=http://linkcat.lifelink.cc/sso/";
				}
				
			?>
			<form id="check_passwordword" action="<?php echo $src;?>" method="post">
				<p><span class="h3"><?php _e('登入帳號:'); ?></span>  
				<?php echo $user->user_login ?></p>
				<input type="hidden" name="user_name" value="<?php echo $user->user_login;?>" >
				<p><span class="h3"><?php _e('Password:'); ?></span> <?php //echo $result['password'];抓隨機的密碼 ?>
				<!--<input type="hidden" name="user_password" value="<?php// echo $result['password'];?>" >-->
				<?php echo "123456"; ?></p></br>
			
					<input type="submit" name="login" value="下一步"  style="display:block;margin-top: 10px;width: 250px;margin-left: auto;margin-right: auto;" />
					<input type="hidden" name="fn" value="<?php echo $fn;?>" >
					<input type="hidden" name="user_email" value="<?php echo $user->user_email;?>" >
					<input type="hidden" name="user_title" value="<?php echo $result["title"];?>" >

			</form>
		

            </div></div>

			<?php 
		}
	}
	require_once("rd_data.php");
	?>
	</div>
</div>
<script type="text/javascript">
	var key_input = document.getElementById('key');
	key_input && key_input.focus();
</script>
<?php get_footer( 'wp-activate' );
