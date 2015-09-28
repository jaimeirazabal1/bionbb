<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package BionBB
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>

<?php if ( has_post_thumbnail() ) { ?>
<div class="page-thumb">
<?php the_post_thumbnail(); ?>
</div>
<?php }  ?>


<?php the_content(); ?>
</article><!-- #post-## -->