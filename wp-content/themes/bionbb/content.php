<?php
/**
 * @package BionBB
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<div class="archive-wrap">
<div class="archive-left"><a href="<?php the_permalink() ?>"><?php if ( has_post_thumbnail() ) { the_post_thumbnail(thumbnail); } ?></a></div>
<div class="archive-right"><a href="<?php the_permalink(); ?>"><?php the_title( '<h1 class="archive-title">', '</h1>' ); ?></a><?php the_excerpt(); ?></div>
</div>

<?php
wp_link_pages( array(
'before' => '<div class="page-links">' . __( 'Pages:', 'bionbb' ),
'after'  => '</div>',
) );
?>

</article><!-- #post-## -->