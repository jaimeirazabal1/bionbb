<?php
/**
 * The template for displaying all single posts.
 *
 * @package BionBB
 */

get_header(); ?>

<section id="contenido-left">
<div style="padding:2em;">

<?php while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'content', 'single' ); ?>
<?php endwhile; // end of the loop. ?>

</div>
</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>