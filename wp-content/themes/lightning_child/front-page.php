<?php get_header(); ?>

<div class="section siteContent">
    <div class="container">
      <div class="row">
        <div class="col-xs-4">
          <div class="yamsys_lp_news">NEWS</div>
        </div>
        <div class="col-xs-8">
          <?php
            $paged = get_query_var('paged');
            query_posts("cat=3&posts_per_page=3&paged=$paged");
          ?>
          <?php if (have_posts()) : while(have_posts()) : the_post(); ?>
            <a href="<?php the_permalink(); ?>" class="yamsys_lp_news_title">
              <?php the_title(); ?>
            </a>
            <hr class="yamsys_lp_news_hr">
          <?php endwhile; ?>
          <?php else: ?>
          <?php endif; ?>
        </div>
      </div>
      <hr class="yamsys_lp_hr">
      <div class="row">
        <div class="col-xs-4">
          <div class="yamsys_lp_news">
            PRESS<br />
            RELEASE
          </div>
        </div>
        <div class="col-xs-8">
          <?php
            $paged = get_query_var('paged');
            query_posts("cat=4&posts_per_page=3&paged=$paged");
          ?>
          <?php if (have_posts()) : while(have_posts()) : the_post(); ?>
            <a href="<?php the_permalink(); ?>" class="yamsys_lp_news_title">
              <?php the_title(); ?>
            </a>
            <hr class="yamsys_lp_news_hr">
          <?php endwhile; ?>
          <?php else: ?>
          <?php endif; ?>
        </div>
      </div>
    </div><!-- [ /.container ] -->
</div><!-- [ /.siteContent ] -->
 <?php get_footer(); ?>
