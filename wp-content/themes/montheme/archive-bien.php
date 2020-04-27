<!--Partie entête généré par WP-->
<?php get_header() ?>

<h1>Voir tous les biens</h1>

<?php if (have_posts()) : ?>
    <div class="row">
        <!--parcours de la boucle-->
        <?php while (have_posts()) : the_post(); ?>
            <!--the_post déclare l'article-->
            <div class="col-sm-4">
                <?php get_template_part('parts/card', 'post'); ?>
            </div>
        <?php endwhile ?>
    </div>

    <?php montheme_pagination() ?>
    

<?php else : ?>
    <h1>Pas d'articles</h1>
<?php endif; ?>

<!--Partie footer généré par WP-->
<?php get_footer() ?>