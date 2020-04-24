<?php 


function montheme_supports () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    register_nav_menu('header', 'En tête du menu');//Créer son menu depuis WP
    register_nav_menu('footer', 'Pied de page');

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

add_action('after_setup_theme', 'montheme_supports');
add_action('wp_enqueue_scripts', 'montheme_register_assets'); // Quand A est appelé alors il appelle ma function

add_filter('document_title_separator', 'montheme_title_separator');
add_filter('nav_menu_css_class', 'montheme_menu_class');
add_filter('nav_menu_link_attributes', 'montheme_menu_link_class');

?> 