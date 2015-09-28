<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package BionBB
 */
/*editar*/
get_header(); ?>



<section id="contenido-left-inferior">
<div style="padding:2em;">

<?php if ( have_posts() ) : ?>

<?php
the_archive_title( '<h1 class="page-title">', '</h1>' );
?>

<?php while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'content', get_post_format() ); ?>
<?php endwhile; ?>

<div align="center" style="padding:20px 0;">
<?php wp_pagenavi(); ?>
</div>


<?php else : ?>
<?php get_template_part( 'content', 'none' ); ?>
<?php endif; ?>

</div>
</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>