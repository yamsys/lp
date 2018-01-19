<?php get_header(); ?>

<div class="section siteContent">
    <div class="container">
        <div class="row">
          <div class="col-xs-4">
            <div class="yamsys_lp_news">
              NEWS
            </div>
          </div>
          <div class="col-xs-8">
              <div class="row">
                <?php
                  $args = array(
                    'posts_per_page' => 3, // 表示件数の指定
                    'category' => 3
                  );
                  $posts = get_posts( $args );
                  foreach ( $posts as $post ): // ループの開始
                    setup_postdata( $post ); // 記事データの取得
                ?>
                <a href="<?php the_permalink(); ?>">
                <div class="col-xs-8">
                  <div class="yamsys_lp_news_date">
                    <?php the_date(); ?>
                  </div>
                </div>
                <div class="col-xs-4">
                  <div class="yamsys_lp_news_title">
                    <?php the_title(); ?>
                  </div>
                </div>
                </a>
                <hr class="yamsys_lp_news_hr">
                <?php
                  endforeach; // ループの終了
                  wp_reset_postdata(); // 直前のクエリを復元する
                ?>
              </div>
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
              <div class="row">
                <?php
                  $args = array(
                    'posts_per_page' => 3, // 表示件数の指定
                    'category' => 4
                  );
                  $posts = get_posts( $args );
                  foreach ( $posts as $post ): // ループの開始
                    setup_postdata( $post ); // 記事データの取得
                ?>
                <a href="<?php the_permalink(); ?>">
                <div class="col-xs-8">
                  <div class="yamsys_lp_news_date">
                    <?php the_date(); ?>
                  </div>
                </div>
                <div class="col-xs-4">
                  <div class="yamsys_lp_news_title">
                    <?php the_title(); ?>
                  </div>
                </div>
                </a>
                <hr class="yamsys_lp_news_hr">
                <?php
                  endforeach; // ループの終了
                  wp_reset_postdata(); // 直前のクエリを復元する
                ?>
              </div>
          </div>
        </div>
        <hr class="yamsys_lp_hr">
    </div><!-- [ /.container ] -->
</div><!-- [ /.siteContent ] -->
 <?php get_footer(); ?>
