<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package BionBB
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<meta name="google-site-verification" content="9UwyJAfgXjfOnkzcFHZoq3EPV29QhHriLT6lUHPVBik" />

<link rel="shortcut icon" href="http://www.bionbb.cl/wp-content/uploads/2015/07/favicon.ico" type="image/x-icon">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<img id="imagen-footer" src="<?php echo get_template_directory_uri(); ?>/img/footer.png">
<img id="imagen-helicoptero" src="<?php echo get_template_directory_uri(); ?>/img/helicoptero.png">

<div id="contenedor-top">
<header>
<h1><a href="http://www.bionbb.cl/"><img class="logo-web" src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="logo"></a></h1>

<nav class="nav">
<img src="<?php echo get_template_directory_uri(); ?>/img/img-menu1.png">
<ul>
<li><a href="http://www.bionbb.cl/bion-bb/">QU&#201; ES BION BB</a></li>
<li><a href="http://www.bionbb.cl/seccion/consejos/">CONSEJOS PARA TI</a></li>
<li><a href="http://www.bionbb.cl/calendario-de-vacunas-2015/">CALENDARIO DE VACUNAS</a></li>
<li><a href="http://www.bionbb.cl/seccion/recetas/">RECETAS PARA TU HIJ@</a></li>
<li><a href="http://www.bionbb.cl/donde-comprar/">D&#211;NDE COMPRAR</a></li>
<li><a href="http://www.bionbb.cl/contacto/">CONTACTO</a></li>
</ul>
</nav>

<div id="header">
<a href="http://www.bionbb.cl/" id="logo"><img src="<?php echo get_template_directory_uri(); ?>/img/logo-mobile.png"></a>
<div id="menu">
<a href="#" class="nav-mobile" id="nav-mobile"></a>

<ul>
<li><a href="http://www.bionbb.cl/bion-bb/">QU&#201; ES BION BB</a></li>
<li><a href="http://www.bionbb.cl/seccion/consejos/">CONSEJOS PARA TI</a></li>
<li><a href="http://www.bionbb.cl/calendario-de-vacunas-2015/">CALENDARIO DE VACUNAS</a></li>
<li><a href="http://www.bionbb.cl/seccion/recetas/">RECETAS PARA TU HIJ@</a></li>
<li><a href="http://www.bionbb.cl/donde-comprar/">D&#211;NDE COMPRAR</a></li>
<li><a href="http://www.bionbb.cl/contacto/">CONTACTO</a></li>
</ul>

</div>
</div>

</header>
</div>

<div id="contenedor">
<div id="contenido">