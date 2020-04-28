<!--Partie entête généré par WP-->
<?php get_header() ?>

<form class="form-inline">
  <input type="search" name="s" class="form-control mb-2 mr-sm-2" value="<?= get_search_query() ?>" placeholder="Votre Recherche">
  <div class="form-check mb-2 mr-sm-2">
    <input class="form-check-input" type="checkbox" value="1" name="sponso" id="inlineFormCheck" <?= checked('1', get_query_var('sponso')) ?>>
    <label class="form-check-label" for="inlineFormCheck">
       Article sponsorisé
    </label>
  </div>

</button>
</form>

<h1 class="mb-4">Résultat pour votre recherche "<?= get_search_query() ?>"</h1>
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