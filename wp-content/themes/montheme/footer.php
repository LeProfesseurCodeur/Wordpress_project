    </div>
    <footer>
    <?php wp_nav_menu([
        'theme_location' => 'footer',  
        'container'  => false,
        'menu_class'  => 'navbar-nav mr-auto'
        ]) ;
        the_widget(YoutubeWidget::class, ['youtube' => 'mbRXKb2i6BQ'], ['after_widget' => '', 'before_widget' => '']);
    ?>
    </footer>
    <div>
        <?= get_option('agence_horaire') ?>
    </div>
    <?php wp_footer() ?>
    </body>
</html>