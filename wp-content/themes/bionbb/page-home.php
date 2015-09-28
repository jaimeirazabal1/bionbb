<?php
/**
 * Template Name: Home
 *
 */
get_header(); ?>

<section id="contenido-left">
<div id="slider" class="masked">
<?php echo do_shortcode("[sliderpro id=1]"); ?>
</div>

<section id="left">
<a href="http://www.bionbb.cl/comunidad-de-padres/"><img id="registro-bebe" src="http://www.bionbb.cl/wp-content/uploads/2015/04/padres1.png"></a>
<a href="http://www.bionbb.cl/calendario-de-vacunas-2015/"><img id="calendario-bebe" src="<?php echo get_template_directory_uri(); ?>/img/calendario-vacuna.png"></a>
						
<!--<a href="http://www.bionbb.cl/data/">-->
<form id="tabla-talla" action="/data/" method="POST">
<div class="input-talla">
<select name="hijo[sexo]" style="width:78%"  id="">
	<option value="f">Femenino</option>
	<option value="m">Masculino</option>
</select>
<input type="text" name="hijo[edad]" placeholder="Edad (meses)">
<input type="text" name="hijo[peso]" placeholder="Peso (kg)">
<input type="text" name="hijo[estatura]" placeholder="Estatura (Cm)">
<button class="btn-style">CALCULAR TALLA</button>
</div>
</form>
<!--</a>-->

</section>

<section id="right">
<?php $posts_query = new WP_Query('cat=2&posts_per_page=1');
while ($posts_query->have_posts()) : $posts_query->the_post();
?>
<a href="<?php the_permalink(); ?>"><div id="articulo">
<a href="<?php the_permalink(); ?>"><?php if ( has_post_thumbnail() ) {
the_post_thumbnail('medium');
} else { ?>
<img src="http://www.bionbb.cl/wp-content/uploads/2015/03/slider-dummy-150x150.jpg" alt="<?php the_title(); ?>" />
<?php } ?></a>
<a href="<?php the_permalink(); ?>"><div class="articulo-text"><p><?php the_title( '<b>', '</b>' ); ?></p></div></a>
</div></a>
<a class="leer-mas" href="<?php the_permalink(); ?>">Leer &#43;</a>
<?php endwhile; wp_reset_query(); ?>

<div id="producto">
<img class="producto-nube" src="<?php echo get_template_directory_uri(); ?>/img/nube-producto.png">
<img class="producto-bb" src="http://www.bionbb.cl/wp-content/uploads/2015/04/producto3.png">
</div>
</section>
</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>