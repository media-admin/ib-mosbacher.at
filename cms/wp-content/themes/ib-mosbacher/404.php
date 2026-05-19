<?php
/**
 * 404 – Seite nicht gefunden
 *
 * @package CustomTheme
 */

get_header();
?>

<main id="primary" class="site-main">
    <section class="error-404">
        <div class="container">

            <div class="error-404__inner">

                <div class="error-404__code" aria-hidden="true">404</div>

                <h1 class="error-404__title">
                    <?php esc_html_e( 'Seite nicht gefunden', 'ib-mosbacher' ); ?>
                </h1>

                <p class="error-404__message">
                    <?php esc_html_e(
                        'Die gesuchte Seite existiert leider nicht (mehr). Möglicherweise wurde sie verschoben oder gelöscht.',
                        'ib-mosbacher'
                    ); ?>
                </p>

                <div class="error-404__actions">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary">
                        <?php esc_html_e( 'Zur Startseite', 'ib-mosbacher' ); ?>
                    </a>
                    <a href="javascript:history.back()" class="btn btn--outline">
                        <?php esc_html_e( 'Zurück', 'ib-mosbacher' ); ?>
                    </a>
                </div>

                <?php
                // Suchformular
                get_search_form();
                ?>

                <?php
                // Hilfreiche Links aus dem Hauptmenü
                $menu_items = wp_get_nav_menu_items( 'primary' );
                if ( $menu_items && count( $menu_items ) ) :
                    // Nur Top-Level Items (parent = 0), max. 6
                    $top_items = array_filter( $menu_items, fn( $item ) => $item->menu_item_parent == 0 );
                    $top_items = array_slice( $top_items, 0, 6 );
                ?>
                <div class="error-404__links">
                    <p class="error-404__links-label">
                        <?php esc_html_e( 'Vielleicht suchen Sie:', 'ib-mosbacher' ); ?>
                    </p>
                    <ul class="error-404__links-list">
                        <?php foreach ( $top_items as $item ) : ?>
                            <li>
                                <a href="<?php echo esc_url( $item->url ); ?>">
                                    <?php echo esc_html( $item->title ); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

            </div><!-- .error-404__inner -->

        </div><!-- .container -->
    </section><!-- .error-404 -->
</main>

<?php get_footer(); ?>
