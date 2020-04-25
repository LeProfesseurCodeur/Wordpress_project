<!--Partie entête généré par WP-->
<?php get_header() ?>

<!--boucle WP | Début avec une condition--> <!--parcours de la boucle-->
<?php if (have_posts()): while (have_posts()) : the_post(); ?>
        <!--the_post déclare l'article-->
        <h1><?php the_title() ?></h1>

        <?php if(get_post_meta(get_the_ID(), SponsoMetaBox::META_KEY, true) === '1'): ?>
          <div class="alert alert-info">
            Cet article est sponsorisé
          </div>
        <?php endif ?>  

        <p>
          <img src="<?php the_post_thumbnail_url(); ?>" alt="" style="width: 100%; height:auto;">
        </p>
        <?php the_content() ?>
   
<?php endwhile; endif; ?>

<!--Partie footer généré par WP-->
<?php get_footer() ?>