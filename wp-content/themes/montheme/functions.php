<?php 


function montheme_supports () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    register_nav_menu('header', 'En tête du menu');//Créer son menu depuis WP
    register_nav_menu('footer', 'Pied de page');

    add_image_size('post-thumbnail', 350, 215, true);
    //remove_image_size('medium');
    //add_image_size('medium', 500, 500);

}

function montheme_register_assets () {

    wp_register_style('bootstrap',  'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css', []);
    wp_register_script('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', ['popper', 'jquery'], false, true);
    wp_register_script('popper',    'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', [], false, true);
    wp_deregister_script('jquery');
    wp_register_script('jquery',    'https://code.jquery.com/jquery-3.4.1.slim.min.js', [], false, true);
    wp_enqueue_style('bootstrap');
    wp_enqueue_script('bootstrap');
}

function montheme_title_separator() {
    return '|';
}

//Déclarer une classe différente
function montheme_menu_class($classes) {
    $classes[] = 'nav-item';
    return $classes;
}

function montheme_menu_link_class($attrs) {
    $attrs['class'] = 'nav-link';
    return $attrs;
}

function montheme_pagination() {
    $pages = paginate_links(['type' => 'array']);
    if($pages === null) {
        return;
    }
    echo '<nav aria-label="Pagination" class="my-4">';
    echo '<ul class="pagination">';
    foreach($pages as $page){
        // page active avec fond bleu 
        $active = strpos($page, 'current') !== false; 
        $class = 'page-item';
        if($active) {
            $class .= ' active';
        }
        echo '<li class="' . $class .'">';
        echo str_replace('page-numbers', 'page-link', $page);
        echo '</li>';
    }
    echo '</ul>';
    echo '</nav>';
}

/**
 * 
 * Prend en premier le nom de la taxonomy 
 * En second, le post type qui lui sera associée
 * En troisième, prend différent élément
 */
function montheme_init() {
    register_taxonomy('sport', 'post', [
        'labels' => [
            'name'          => 'Sport',
            'singular_name' => 'Sports',
            'plural_name'   => 'Recherche des sports',
            'search_items'  => 'Rechercher des sports',
            'all_item'      => 'Tous les sports',
            'edit_item'     => 'Editer le sport',
            'update_item'   => 'Mettre à jour le sport',
            'add_new_item'  => 'Ajouter un nouveau sport',
            'new_item_name' => 'Ajouter un nouveau sport',
            'nemu_name'     => 'Sport',
        ],
        'show_in_rest'      => 'true', // ajout de la catégorie dans l'article que nous souhaitons modifier
        'hierarchical'      => 'true', // Permet d'afficher en checkbox en lieu de les taper 
        'show_admin_column' => 'true' // Permet d'afficher direcrtement le sport dans la colonne attribué
    ]);

    register_post_type('bien', [
        'label' => 'Bien',
        'public' => true,
        'menu_position' => 3,
        'menu_icon' => 'dashicons-building',
        'supports' => ['title', 'editor', 'thumbnail'],
        'show_in_rest' => true,
        'has_archives' => true,
    ]);
}

add_action('init', 'montheme_init');
add_action('after_setup_theme', 'montheme_supports');
add_action('wp_enqueue_scripts', 'montheme_register_assets'); // Quand A est appelé alors il appelle ma function

add_filter('document_title_separator', 'montheme_title_separator');
add_filter('nav_menu_css_class', 'montheme_menu_class');
add_filter('nav_menu_link_attributes', 'montheme_menu_link_class');

require_once('metaboxes/sponso.php');
require_once('options/agence.php');

SponsoMetaBox::register();
AgenceMenuPage::register();

add_filter('manage_bien_posts_columns', function($columns){
    return [
        'cb' => $columns['cb'],
        'thumbnail' => 'Miniature',
        'title' => $columns['title'],
        'date' => $columns['date']
    ];
});

add_filter('manage_bien_posts_custom_column', function($column, $postId) {
    if($column === 'thumbnail') {
        the_post_thumbnail('thumbnail', $postId);
    }
}, 10, 2);

add_action('admin_enqueue_scripts', function() {
    wp_enqueue_style('admin_montheme', get_template_directory_uri() . '/assets/admin.css');
});

add_filter('manage_post_posts_columns', function($columns){
    $newColumns = [];
    foreach($columns as $k => $v) {
        if($k === 'date') {
            $newColumns['sponso'] = 'Article sponsorisé ?';
        }
        $newColumns[$k] = $v;
    }
    return $newColumns;
});

add_filter('manage_post_posts_custom_column', function($column, $postId) {
    if($column === 'sponso') {
        if(!empty(get_post_meta($postId, SponsoMetaBox::META_KEY, true))) {
            $class = 'yes';
        } else {
            $class = 'no';
        }
        echo '<div class="bullet bullet-' . $class . '"></div>';
    }
}, 10, 2);

function montheme_pre_get_posts(WP_Query $query) {
    if(is_admin() || !is_search() || !$query->is_main_query()) {
        return;
    }
    if(get_query_var('sponso') === '1') {
        $meta_query = $query->get('meta_query', []);
        $meta_query[] = [
            'key' => SponsoMetaBox::META_KEY,
            'compare' => 'EXISTS',
        ];
        $query->set('meta_query', $meta_query);
    }
}

function montheme_query_vars($params){
    $params[] = 'sponso';
    return $params;
}

add_action('pre_get_posts', 'montheme_pre_get_posts');
add_filter('query_vars', 'montheme_query_vars');
?> 