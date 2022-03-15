<?php
/*
¿Quienes pueden registrar su team en la web?
	-Las personas que hayan aceptado la aplicación de facebook que crees del sitio (que sea puro php)
¿Que datos y como se guardan en la Base de Datos?
	-La aplicacion debe pedir el correo de la persona que acepta la aplicacion
	-Se guarda en la base de datos el Correo y nombre de la pagina de FACE
	-Podra modificar el nombre de la pagina que inscribió (Solo puede colocar una por correo)
*Nota: Cuando se logee con su cuenta de facebook, con php tenes que verificar si la cuenta logeada existe en la base de datos,
		en caso de ser asi entonces que le aparesca una opcion para modificar el nombre de la fanpage que tiene.
		(Solo podrán registrar sus paginas de facebook, si tiene el copyright en su descripcion)

*/
/********************************************************/

/*
Por ahora hace que se muestra cada vez que le des al submit
Pero despues hace que lo inserte en la base de datos
Y directamente se visualize el sitio en base a lo que ponen en la url

Si le dan a completar el formulario es solo para registrar su sitio

Cada vez que entren al dominio/nombredelteam
verifique si el sitio ingresado luego del dominio existe en la base de datos
y en base a eso reemplazar lo que se pasa por el fb_get_data()
reemplazando el user_id ahi!!!

# Acordate tambien que tenes que mejorar la parte de Fundador
	para que solo pueda crear la pagina,
*/

/********************************************************/

/*
http://sxeinjected.localstrike.net/sXeInjectedSetup.12.3.Fix.5.exe
http://sxeinjected.localstrike.net/sXeInjectedSetup.13.Fix.4.exe

http://mirror2.sxe-injected.com/sXeInjectedSetup.13.0.Fix.4.exe

download.sxe-injected.com/downfile.php?id=1
http://sxe-injected.com/sXeInjectedSetup.13.0.Fix.5.exe

sXe Injected 13.0 Fix 4 Released

Reemplaza SysGamesComunidad por el nombre del canal
http://gdata.youtube.com/feeds/base/users/SysGamesComunidad/uploads?alt=rss&v=2&orderby=published&amp

1)
*Nuevo Bloque de los ultimos 5 videos de su canal de Youtube, en la pagina principal abajo
*Agregar una nueva seccion que se llama Videos, donde aparezcan todos los videos de su canal (5 por fila)
*Se mostrara un listado de los videos con el thumbnail y el titulo
*Al darle click al thumbnail que se abra una venta modal y se reproduzca de forma automatica el video
*Cuando aparece la ventana modal con el video aparezca abajo tambien "Me gusta" y "Compartir" asi mas personas conocen la pagina del usuario y tuya

2)
*Nuevo bloque con las redes sociales que agregó
*Imagenes con las redes sociales con el link para que entren

3)
Debajo de cada noticia tenga un "Me gusta" o "Compartir", con eso mas gente va a conocer la pagina del usuario y tuya

4)
Que haya otro bloque de noticias mas chiquito donde aparezca las ultimas 5 noticias del rss de localstrike

5)
Una imagen grande que diga los sponsors de miteamcs:
	sysgames, midatacs, miteamcs

*/
/*

COPIAR EL DISEÑO DE ACA..!!!
http://keita-gaming.com/
	Los themes son de: http://xtravagantstudios.com/portfolio/websites/

Otras paginas de CS, para ver que otras cosas agregar:
http://fnatic.com/
http://www.sk-gaming.com/players/

Fijate si podes usar algo de estos themes también:
	http://img138.imageshack.us/img138/8526/neroncs.png
		*Fijate si podes hacer que los servers dentro de un recuadro con color casi transparente
	http://www.flashmint.com/template-preview/001969.jpg
		*Fijate si te sirve alguno de los bloques de la parte de abajo
*/
/*
Miembros:
Carlits Pepe http://www.facebook.com/Carlito090
Samuelit00.- http://www.facebook.com/sooisamuuy
Carit1az http://www.facebook.com/archangel0192
Cordobeee.- Pepe http://www.facebook.com/uncordobefea

Fecha Oponente [resultados]

Resultados:
05/11/2012 SkTeamE [5-10]
09/11/2012 Los5.Mejores [12-15 12-5]
20/12/2012 xTremer7 [12-15 12-5 5-12]

*/
/**
	Acordate que cuando tengas que mostrar a los miembros en la pagina
	hacer un codigo para que agarre la foto de perfil de los miembros
	asi aparece la foto de perfil del miembro y el nick
	asi queda mas cool

	Acordate de hacer que para cuando entren a la seccion miembros
	usar la url que usas en midatacs, para sacar al foto de perifl de un usuario de fb,
	asi aparece:
		-Nick + Foto de perfil
	Va a quedar mas coool...!

	Fijate tambien de capturar las 2 imagenes de la fanpage:
		-Foto de perfil, hacelo de la misma manera que lo estas haciendo con los miembros
		-Foto de portada, la sacas con el opengraph

	Fijate tambien que tenes que usar un combo entre la foto de perfil y portada para hacer el header arriba,
	similar a como hace fb, la de perfil dentro de la de portada.

	Fijate tambien que la informacion de la pagina la guarde en <div> ocultos,
	y los muestre con jquery en caso que le den click a alguna de las secciones,
	la idea es que todo sea con javascript,
	asi es dominio.com/nombre-del-team

	Intenta poner un boton dentro de la imagen de portada, margen derecho inferior
	que diga cuantos likes tiene esa pagina y cuando le den click puedan likear a la pagina,
	o algo asi, fijate que sea un boton medio grande para que quede mas bonito

	Fijate tambien si podes,
	si hay alguna pagina similar a gametracker, en donde solo le pases el ip del servidor
	y te genere una imagen con cuantas personas estan jugan2 en ese servidor
	de esa manera va a quedar mas bonito,
	creo que gametracker cuando generas una imagen de ese tipo, te permite modificar unos parametros,
	para que puedas ingresar el ip y el puerto
*/
/*
BASE DE DATOS PARA LOS USUARIOS:

# El email solamente lo vas a guardar, para despues poder hacer campañas de publicidad gamers, y usar esos correos
# Lo unico que vas a usar para identificar a la persona es el userid.
	-Si existe en la base de datos entonces que se logee
	-Si el campo fanpage es distinto a NULL:
		-Que aparesca en alguna parte una imagen, o un texto, o algo que diga "Cambiar dirección de la fanpage"
	-Si el campo fanpage es NULL:
		-Que aparesca en alguna parte una imagen, o un texto o algo que diga "crear pagina"
	
*Cosas pendientes despues de funcionar el tema del sistema de acceso de usuarios:
	-Arriba de menu de las secciones, que aparezca la foto de portada de la pagina de facebook
	-Dentro de la foto de portada, a la izquierda aparezca la foto de perfil de la pagina
	-Si la persona que se logeo tiene el campo 'fanpage' distinto a NULL, entonces que aparezca una opción para que pueda publicar noticias
	 desde la pagina 'miteamcs'.
	-Debajo de cada noticia que tenga los botones "compartir en facebook o twitter o g+, que puedan likear la noticia"
	-Cuando le da click a un video, que abajo tenga los botones "compartir en facebook o twitter o g+, que puedan likear el video"
	-Si la persona se logeo y esta dentro de su pagina, que a la derecha de la imagen de portada aparezca un icono de configuracion
		-Que aparezca por default 'Ocultar Portada' (nadie vera la imagen de portada)
		-Si tiene la imagen de portada oculta, y le da click al icono de configuracion ese, que aparezca "Mostrar Portada"
		-Lo mismo de arriba pero con la imagen de perfil
*/

require 'src/facebook.php';
$facebook = new Facebook(array(
	'appId'  => '486496254705333',
	'secret' => 'db8535ca654896f0da5539976034bacc',
));

$user = $facebook->getUser();
$user_profile = NULL;

if($user) {
	try {
#		$user_profile = $facebook->api('/me/likes/320413158025196');
		$user_profile = $facebook->api('/me');
	} catch (FacebookApiException $e) {
	#	echo '<pre>'.htmlspecialchars(print_r($e, true)).'</pre>';
		$user_profile = NULL;
	}
}


$app_id 	= $facebook->getAppID();
$app_secret = $facebook->getApiSecret();
$app_token 	= $facebook->getAccessToken();
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
error_reporting(E_ALL);
ini_set('display_errors', 1);

#ini_set('display_errors', 0);

include('include/debug.php');

#require('libs/check_user.php');
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

require('include/print_social.php');
require('include/print_youtube_feeds.php');
/* PRINT DATA #END */

print_x($user_profile);

	$error['require'] 			= 'Ha ocurrido un error..! Te falta agregar un campo que es obligatorio, intenta nuevamente.';
	$error['404'] 				= 'El sitio agrego no existe, o ha sido deshabilitado por Facebook';

	$msg['editpage']['ok'] 		= 'Has cambiado el nombre de tu sitio';
	$msg['editpage']['exist'] 	= 'Ha ocurrido un Error.! Este nombre yá está en uso';

#	$user_id 		= $_POST['facebook']['user_id'];
	$get_page 				= ($_GET['page']) ? $_GET['page'] : NULL;

	$go_home = true;

	if($get_page){
		$checkPage 			= checkPage($get_page);
#		var_dump($checkPage);

		if($checkPage == true){
			$go_home 		= false;
#			$user_id 		= 'teamske';
#			$facebook 		= fb_get_data("https://www.facebook.com/{$user_id}", 'name');
			$facebook 		= fb_get_data("https://www.facebook.com/{$get_page}", 'name');
		}
	print_x($facebook);
	}

	$profile_id 	= $user_profile['id'];
	$profile_email 	= $user_profile['email'];
#	echo $profile_id;

	if(empty($facebook)){
		echo $error['404'];
	}
	else{
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
		#$get_data = "Redes Sociales:\nhttp://www.facebook.com/SysGames\nhttp://www.twitter.com/_SysGames\nhttp://www.youtube.com/user/SysGamesComunidad\nsoypepe lokoo jaja\nhttp:nene";
#		$get_data 					= "Redes Sociales:\nhttp://www.facebook.com/SysGames\nhttp://www.twitter.com/_SysGames\nhttp://www.youtube.com/user/werevertumorro\nsoypepe lokoo jaja\nhttp:nene";
		
		$youtube_get_feeds 			= youtube_get_feeds($get_social);
		$youtube_print_last_feeds 	= youtube_print_feeds($youtube_get_feeds, 4); # ultimos 5 videos
		$youtube_print_all_feeds 	= youtube_print_feeds($youtube_get_feeds); # ultimos 5 videos
		/* Redes Sociales #End */
?>
	<?php if($user_profile == NULL){ ?>
		<div>
			<span>Crea tu Sitio con Facebook</span>
		</div>
	<?php }else{ ?>
		<?php $checkUser = checkUser($profile_id, $profile_email); ?>
		<?php if($checkUser == true && $get_page!= NULL){ ?>
			<div>
				<a class='link text-style-white text-type-small' id="editpage" href="#editpage">Editar Página</a>
			</div>
		<?php } ?> 
	<?php } ?>
<?php } ?>
<form action="" method="post">
	<div class="row text-align-left" style="display:none;">
		<span>Facebook</span>
		<br />
		http://www.facebook.com/<input class="field-style-gray field-width-big field-height-medium" type="text" name="facebook[user_id]" value="teamske" />
	</div>
	<div>
		<input class="button-style-gray" type="submit" value="Crear Sitio" />
	</div>
</form>

<div id="page">
	<div id="block-links" class="menu-style-black">
		<ul>
			<li class="item align-left button-type-medium button-style-blue">
				<a class='link text-style-white text-type-small' id="news" href="#noticias">NOTICIAS</a>
			</li>
			<li class="item align-left button-type-medium button-style-blue">
				<a class='link text-style-white text-type-small' id="members" href="#miembros">INTEGRANTES</a>
			</li>
			<li class="item align-left button-type-medium button-style-blue">
				<a class='link text-style-white text-type-small' id="servers" href="#servidores">SERVIDORES</a>
			</li>
			<li class="item align-left button-type-medium button-style-blue">
				<a class='link text-style-white text-type-small' id="about" href="#quienes-somos">NOSOTROS</a>
			</li><!-- esto lo va a sacar del about -->
			<li class="item align-left button-type-medium button-style-blue">
				<a class='link text-style-white text-type-small' id="contact" href="#contacto">CONTACTO</a>
			</li>
			<li class="item align-left button-type-medium button-style-blue">
				<a class='link text-style-white text-type-small' id="videos" href="#videos">VIDEOS</a>
			</li>
		</ul>
		<div class="clear"></div>
	</div>
	
	<div id="block-info">
		<?php if($_POST['action']){ ?>
		<div>
			<?php
				if($_POST['action'] == 'editpage'){
#					echo $_POST['name']." ".$profile_id;
					editpage($_POST['name'], $profile_id);
				}
			?>
			has cambiado el nombre de tu sitio
		</div>
		<?php }else{ ?>
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

		<div id="info-default" class="content">
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
</div>

<script>
window.fbAsyncInit = function(){
	FB.init({ appId: '<?php echo $app_id; ?>', cookie: true, xfbml: true, oauth: true});
	facebookLoaded();
	//facebookLogin();
};

(function() {
var e = document.createElement('script');
e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
e.async = true;
document.getElementById('fb-root').appendChild(e);
}());
</script>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.reveal.js"></script>
<script type="text/javascript">
function facebookLoaded(){
//	$(document).click(function(){ facebookLogin(); });
//		facebookLogin();
}
function facebookLogin(){
	FB.login(function(response){
		if(response.status == 'connected'){
			location.reload();
//				checkLike('252565641532717');
//				postToPage('464462326903399', getmessage());
//				postToPage('76145712316', window.admsg);
		}
	}, { scope: 'publish_stream, email' }); // publish_stream 
}
</script>
<script type="text/javascript">
$(document).ready(function(){
	$(".link").click(function(){
		id = $(this).attr('id');
		$("#block-info .content").css('display', 'none');
		$("#block-info #info-"+id).fadeIn(700);

		console.log(id);
	});

	modal 		= $("#myModal");
	title 		= modal.children("h1");
	iframe 		= modal.children("#block-video").children("iframe");

	$(".video-row").live('click', function(){
		video_title = $(this).children('.video_title').val();
		video_src 	= $(this).children('.video_src').val();

		title.text(video_title);
		iframe.attr('src', video_src);
	});

	$(".reveal-modal-bg").live('click', function(){
		title.text('');
		iframe.attr('src', '');
	});

});
</script>
</body>
</html>
