<!--Partie entête généré par WP-->
<?php get_header() ?>

<!--boucle WP | Début avec une condition--> <!--parcours de la boucle-->
<?php if (have_posts()): while (have_posts()) : the_post(); ?>
        <!--the_post déclare l'article-->
        <h1><?php the_title() ?></h1>
        <p>
          <img src="<?php the_post_thumbnail_url(); ?>" alt="" style="width: 100%; height:auto;">
        </p>
        <?php the_content() ?>
   
<?php endwhile; endif; ?>

<!--Partie footer généré par WP-->
<?php get_footer() ?>