<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package BionBB
 */

get_header(); ?>

<section id="contenido-left">
<div style="padding:2em;">

<?php while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'content', 'page' ); ?>
<?php endwhile; // end of the loop. ?>

</div>
</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>