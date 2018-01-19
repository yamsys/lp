<?php get_header(); ?>
<?php get_template_part('module_pageTit'); ?>
<?php get_template_part('module_panList'); ?>

<div class="section siteContent">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mainSection" id="main" role="main">
        <?php
          if( apply_filters( 'is_lightning_extend_single' , false ) ):
              do_action( 'lightning_extend_single' );
          else:
          if (have_posts()) : while ( have_posts() ) : the_post();
        ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header>
	<?php get_template_part('module_loop_post_meta');?>
	<h1 class="entry-title"><?php the_title(); ?></h1>
	</header>
	<div class="entry-body">
	<?php the_content();?>
	</div><!-- [ /.entry-body ] -->
</article>
<?php endwhile;endif;
endif;
?>

<nav>
  <ul class="pager">
    <div class="row">
      <div class="col-md-6">
        <li class="previous"><?php previous_post_link( '%link', '%title' ); ?></li>
      </div>
      <div class="col-md-6">
        <li class="next"><?php next_post_link( '%link', '%title' ); ?></li>
      </div>
    </div>
  </ul>
</nav>

</div><!-- [ /.mainSection ] -->


</div><!-- [ /.row ] -->
</div><!-- [ /.container ] -->
</div><!-- [ /.siteContent ] -->
<?php get_footer(); ?>
