<?php 
 // Título de la página, keywords y descripción
 $title = 'Respuesta álbum';
 $keywords = 'pictures, images, imagen, imágenes, fotos, foto';
 $description = 'Página de confirmación de impresión de álbum.';
 
 // Declaración de DOCTYPE, <html>, <head>, <title>, <meta> y <link>. 
require_once("includes/cabecera.php");

function Coste($color_fotos, $color_album, $resolucion, $numero_copias) {
	#calcular precio
	$precio=0.10;		#una página por defecto
	if($color_fotos === "color")
		$precio+=0.03;	#una sóla foto
	if($color_album !== "#000000" )
		$precio+=0.51;
	if($resolucion > 450)
		$precio+=0.10;
	$precio*=$numero_copias;
	return $precio;
}

if (isset($_POST['solicitar_album'])){
	
	$nom = $_POST['nombre'] ." ". $_POST['apellidos'];
	
	if(!empty($_POST['area_texto'])&&$_POST['area_texto']!=" "){
		$area_texto = $_POST['area_texto'];
	} else {
		$area_texto=$_POST['titulo_album'];
	}
	
	$direccion = $_POST['calle'] .'|'. $_POST['numero_portal'] .'|'. $_POST['CP'] .'|'. $_POST['localidad'] .'|'. $_POST['provincia'] .'|'. $_POST['pais'];
	
	$coste = Coste($_POST['color_fotos'], $_POST['color_album'],
		$_POST['resolucion'], $_POST['numero_copias']);
		
	GuardarSolicitud($_POST['album'], $nom, $_POST['titulo_album'], $area_texto,
		$_POST['email'], $direccion, $_POST['color_album'], $_POST['numero_copias'], 
		$_POST['resolucion'], $_POST['fecha_recepcion'], $_POST['color_fotos'], $coste);
}
 ?>
 
 <body>
	<!-- HEADER -->
	<?php require_once("includes/header.php"); ?>
	
	<section id="respuesta_album">	
	
		<!--mostrar datos introducidos-->
		<h2>Solicitud de álbum registrada</h2>
		
		<h3>Tu álbum</h3>
		
		<h4>Datos personales</h4>
				
		<?php

			if(!empty($_POST['nombre'])){
				$nombre = $_POST['nombre'];
				echo "<p>Nombre: $nombre</p>";
			}
			if(!empty($_POST['apellidos'])){
				$apellidos = $_POST['apellidos'];
				echo "<p>Apellidos: $apellidos</p>";
			}
			if(!empty($_POST['email'])){
				$email = $_POST['email'];
				echo "<p>Email: $email</p>";
			}
			if(!empty($_POST['titulo_album'])){
				$titulo_album = $_POST['titulo_album'];
				echo "<p>Titulo: $titulo_album</p>";
			}
			if(!empty($_POST['area_texto'])&&$_POST['area_texto']!=" "){
				$area_texto = $_POST['area_texto'];
				echo "<p>Texto adicional: $area_texto</p>";
			}
		?>

		<h4>Dirección</h4>
		
		<?php
			if(!empty($_POST['calle'])){
				$calle = $_POST['calle'];
				echo "<p>Dirección de domicilio: $calle</p>";
			}
			if(!empty($_POST['numero_portal'])){
				$numero_portal = $_POST['numero_portal'];
				echo "<p>Numero: $numero_portal</p>";
			}
			
			if(!empty($_POST['CP'])){
				$CP = $_POST['CP'];
				echo "<p>Código postal: $CP</p>";
			}
			if(!empty($_POST['localidad'])){
				$localidad = $_POST['localidad'];
				echo "<p>Localidad: $localidad</p>";
			}
			if(!empty($_POST['provincia'])){
				$provincia = $_POST['provincia'];
				echo "<p>Provincia: $provincia</p>";
			}
			if(!empty($_POST['pais'])){
				echo '<p>Pais: '.CargarPais($_POST['pais']).'</p>';
			}
		?>
				
		<h4>Configuración de tu álbum</h4>
	
		<?php
			if(!empty($_POST['color_album'])){
				$color_album = $_POST['color_album'];
				echo "<p>Color de la portada del álbum: $color_album</p>";
			}
			if(!empty($_POST['numero_copias'])){
				$numero_copias = $_POST['numero_copias'];
				echo "<p>Numero de copias: $numero_copias</p>";
			}
			if(!empty($_POST['resolucion'])){
				$resolucion = $_POST['resolucion'];
				echo "<p>Resolucion de las fotos: $resolucion dpi</p>";
			}
			if(!empty($_POST['album'])){
				echo '<p>Album: '.CargarTituloAlbum($_POST['album']).'</p>';
			}
			if(!empty($_POST['fecha_recepcion'])){
				$fecha_recepcion = FormatearFechaBarras($_POST['fecha_recepcion']);
				echo "<p>Fecha de recepción: $fecha_recepcion</p>";
			}
			if(!empty($_POST['color_fotos'])){
				$color_fotos = $_POST['color_fotos'];
				if($color_fotos=="blanco_negro")
					echo "<p>Color de las fotos: blanco y negro</p>";
				else
					echo "<p>Color de las fotos: a color</p>";
			}
		?>
		<p>Precio: <?php echo number_format($coste, 2, '.','') ."€"?></p>
	</section>
	
	<!-- FOOTER con </body> y </html> -->
	<?php require_once("includes/footer.php"); ?>