<?php
require 'src/facebook.php';
$facebook = new Facebook(array(
	'appId'  => '486496254705333',
	'secret' => 'db8535ca654896f0da5539976034bacc',
));

$user = $facebook->getUser();
$user_profile = NULL;

echo "<pre>";
print_r($user);
echo "</pre>";


if($user){
	try {
#		$user_profile = $facebook->api('/me/likes/320413158025196');
		$user_profile = $facebook->api('/me');
	} catch (FacebookApiException $e) {
		echo '<pre>'.htmlspecialchars(print_r($e, true)).'</pre>';
		$user_profile = NULL;
	}
}


$profile_id 	= $user_profile['id'];
$profile_email 	= $user_profile['email'];

$app_id 		= $facebook->getAppID();
$app_secret 	= $facebook->getApiSecret();
$app_token 		= $facebook->getAccessToken();

?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="modal.css" >
<link rel="stylesheet" href="style.css" >
</head>
<body>
	<div id="fb-root"></div>
<?php
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
*/
ini_set('display_errors', 0);

include('include/debug.php');

require('libs/activation_generate.php');
require('libs/add_account.php');
require('libs/check_account.php');
require('libs/check_page.php');
require('libs/edit_page.php');

/* GET DATA #START */
require('libs/facebook.php');
require('libs/get_social.php');
require('libs/get_results.php');
require('libs/get_servidores.php');
require('libs/get_miembros.php');
require('libs/get_copyright.php');
require('libs/get_facebook_feeds.php'); # Entries publish
require('libs/get_youtube_feeds.php'); # Videos publish
/* GET DATA #END */

/* PRINT DATA #START */

require('include/print_miembros.php');
require('include/print_servidores.php');
require('include/print_news.php');
require('include/print_results.php');

#require('include/print_social.php');
require('include/print_youtube_feeds.php');
/* PRINT DATA #END */

#print_x($user_profile);

	$error['require'] 			= 'Ha ocurrido un error..! Te falta agregar un campo que es obligatorio, intenta nuevamente.';
	$error['404'] 				= 'El sitio agrego no existe, o ha sido deshabilitado por Facebook';

	$msg['editpage']['ok'] 		= 'Has cambiado el nombre de tu sitio';
	$msg['editpage']['exist'] 	= 'Ha ocurrido un Error.! Este nombre yá está en uso';

#	$get_page = 'teamske';
	$get_page 			= ($_GET['page']) ? $_GET['page'] : NULL;
	$go_site_default 	= true;
	$page_not_exists	= true;
	$show_register = true;
	
	if($get_page){
		$checkPage = checkPage($get_page);
		if($checkPage == true) $page_not_exists = false;
	}

	echo "<pre>";
	print_r($get_page);
	echo "</pre>";


	$facebook = fb_get_data("https://www.facebook.com/{$get_page}", 'name');

#	print_x($facebook);
	if(empty($facebook)){
		echo $error['404'];
	}
	else{
#		print_x($facebook);
#		$header_image 	= $facebook['cover']['source'];
		$about 			= $facebook['about'];
		$user_name 		= $facebook['name'];
		$user_id 		= $facebook['id'];
		$description 	= $facebook['description'];


		$get_social 	= get_social($description);
		$get_news 		= fb_get_feeds($user_id);
		$get_results 	= get_results($description);
		$get_servidores = get_servidores($description);
		$get_miembros 	= get_miembros($description);

		$news 			= print_news($user_id, $get_news);
		$miembros 		= print_miembros($get_miembros);
		$servidores 	= print_servidores($get_servidores);
		$results 		= print_results($user_name, $get_results);

		/* Redes Sociales #Start */
		$youtube_get_feeds 			= youtube_get_feeds($get_social);
		
		$youtube_print_last_feeds 	= youtube_print_feeds($youtube_get_feeds, 4); # ultimos 5 videos
		$youtube_print_all_feeds 	= youtube_print_feeds($youtube_get_feeds); # ultimos 5 videos
		/* Redes Sociales #End */
	}

if($checkPage == true){
	if($user_profile != null){
		echo "page: $checkPage - userprofile: $user_profile <br />";
		echo "$get_page, $user_id, $profile_email <br />";
		$check_account 	= check_account($get_page, $profile_id, $profile_email);
		var_dump($check_account);

		if($check_account == true){
			$show_register = false;
			echo "<h1>editar aca..!</h1>";
		}
	}
}
?>
<?php if($show_register == true){ ?>
	<h4 class='showModal-small showModal show-register'>CREAR WEB</h4>
<?php } ?>
<?php 
if($_POST['action'] == 'myapplication'){
	$user_id 	= $_POST['facebook']['user_id'];
	$page_name 	= $_POST['facebook']['page_name'];

	add_account($page_name, $user_id, $profile_email);
	echo "Correo enviado a $profile_email";
}
?>
<div id="myModal" class="reveal-modal">
	<a class="close-reveal-modal">&#215;</a>
	<div id="myModal-content"></div>
</div>
<div id="page">
<?php
if($page_not_exists == true){

}
else{
?>
	<div>
		
	</div>
	<header id="nav">
		<?php include('templates/nav.html'); ?>	
	</header>
		<?php include('templates/header.html'); ?>
		<div>
			<?php echo $youtube_print_last_feeds; ?>
		</div>
		<div id="main">
			<div id="content" class="align-left">
				<div id="section-home" class='block-section'>
					<?php echo $news; ?>
				</div>				
				<div id="section-videos" class='block-section'>
					<?php echo $youtube_print_all_feeds; ?>
				</div>				
			</div><!-- Content #End -->
			<div id="sidebar" class="align-left">
				<div class="widget" id="widget-about">
					<div class="block-content">
						<header>
							<h3 class="widget-title text-color-orange-dark text-size-big">Nosotros</h3>
						</header>
						<section>
						<span class="text-color-orange-dark text-size-medium">Nuestra historia en el Counter-Strike 1.6</span><br />
						<span class="text-color-gray text-size-medium"><?php echo $about; ?></span>
						<!--
						<span class="text-color-gray text-size-medium">Como organización fuimos de los mejores teams de CS de la historia y todos ellos han contribuido en esto.
							En el futuro próximo nos vamos a dedicar al CS:GO y vamos a tener jugadores si es que se hace un eSport ocmo lo fue en el 1.6.
							Es solo cuestión de esperar y ver que nos depara el futuro.</span>
						-->
						</section>
					</div>
				</div><!-- About #End -->
				<div class="widget" id="widget-servers">
					<div class="block-content">
						<header>
							<h3 class="widget-title text-color-orange-dark text-size-big">Servidores</h3>
						</header>
						<section>
						<span class="text-color-white text-size-medium">
							<?php echo $servidores; ?>
							<!--
							cs.sysgames.net:27015 [PUBLICO]<br />
							cs.sysgames.net:27016 [DEATHRUN] <br />
							cs.sysgames.net:27017 [SURF]<br />
							cs.sysgames.net:27018 [KZ]<br />
							cs.sysgames.net:27019 [ZOMBIEPLAGUE]<br />
							cs.sysgames.net:27020 [JAILBREAK]<br />
							-->
						</span>
						</section>
					</div>
				</div><!-- About #End -->
				<div class="widget" style="background:none; border-bottom:none;" id="widget-results">
						<header>
							<div>
								<img src="images/results-title.png" />
							</div>
						</header>					
						<section>
							<?php echo $results; ?>
						<!--
							<ul id="results-fields">
								<li class="results-item">
									<span class='results-date text-size-small text-color-white'>18 Nov, 2013</span>
									<span class='text-size-small text-color-white'>Team Ske vs Los5.Mejores</span>
								</li>
								<li class="results-item">
									<span class='results-date text-size-small text-color-white'>19 Nov, 2013</span>
									<span class='text-size-small text-color-white'>Team Ske vs fnatic</span>
								</li>
								<li class="results-item">
									<span class='results-date text-size-small text-color-white'>20 Nov, 2013</span>
									<span class='text-size-small text-color-white'>Team Ske vs xTremer7</span>
								</li>
								<li class="results-item">
									<span class='results-date text-size-small text-color-white'>25 Nov, 2013</span>
									<span class='text-size-small text-color-white'>Team Ske vs Sk1n</span>
								</li>
								<li class="results-item">
									<span class='results-date text-size-small text-color-white'>29 Nov, 2013</span>
									<span class='text-size-small text-color-white'>Team Ske vs f0rev3r</span>
								</li>
							</ul>
						-->
						</section>
				</div><!-- About #End -->
			</div><!-- Sidebar #End -->

			<div class="clear"></div>
		</div><!-- Main #End -->
	<div id="block-info">
		<?php if($_POST['action']){ ?>
		<div>
			<?php if($_POST['action'] == 'editpage') editpage($_POST['name'], $profile_id); ?>
			has cambiado el nombre de tu sitio
		</div>
		<?php } else{ ?>
		<div id="info-editpage" class='content'>
			<div>
				<div>Información Básica</div>
				<div>Ayuda</div>
			</div>

			<div>
				<form action="" method="post">
				<div>
				Nombre: <input type="text" name="name" />
				</div>
				<div>
					<input type="hidden" name="action" value="editpage" />
					<input type="submit" value="Guardar Cambios" />
				</div>
				</form>
			</div>
		</div>

		<div id="info-home" class="content">
			<div id="sidebar">
				<div class="content-small-blue">
					<h3 class='info-title text-type-big'>RESULTADOS</h3>
					<div class="spacer-small"></div>
					<?php echo $results; ?>
				</div>
			</div>
			<div>
				<?php echo $news; ?>
			</div>
			<div class='align-left block-video-medium'>
				<?php echo $youtube_print_last_feeds; ?>
			</div>
		</div>

		<div id="info-members" class='content'>
			<h3 class='info-title'>INTEGRANTES</h3>
			<div class="spacer"></div>
			<?php echo $miembros; ?>
		</div>

		<div id="info-servers" class='content'>
			<h3 class='info-title'>SERVIDORES</h3>
			<div class="spacer"></div>
			<?php echo $servidores; ?>
		</div>

		<div id="info-videos" class='content'>
			<?php echo $youtube_print_all_feeds; ?>
		</div>
		<?php } ?>
	</div>
<?php } ?>
</div>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="js/register.js"></script>
<script type="text/javascript" src="jquery.reveal.js"></script>
<script type="text/javascript">
window.fbAsyncInit = function(){
	FB.init({ appId: '<?php echo $app_id; ?>', cookie: true, xfbml: true, oauth: true});
	facebookLoaded();
};

(function() {
var e = document.createElement('script');
e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
e.async = true;
document.getElementById('fb-root').appendChild(e);
}());
</script>
<script type="text/javascript">
console.log('go');
function facebookProfile(){
	FB.api('/me' , function(response){
		if(response){
			console.log(response);
			$("#facebook_userid").val(response.id);
		}
	});
}

function facebookLogin(){
	FB.login(function(response){
		if(response.status == 'connected'){
			facebookProfile();
			go_step(2);
		}
	}, { scope: 'publish_stream, email' }); // publish_stream 
}

function facebookLoaded(){
	$("#app-miteamcs").live('click', function(){
		facebookLogin();
		console.log('test');
	});
}
</script>
<script type="text/javascript" src="js/content.js"></script>
<script type="text/javascript" src="js/myModal.js"></script>
</body>
</html>
