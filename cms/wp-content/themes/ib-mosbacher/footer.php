<footer class="site-footer">
    <div class="container">

        <!-- Partner-Logos Leiste -->
        <div class="site-footer__logos">
            <?php
            $logo = function_exists('get_field') ? get_field('logo_desktop', 'option') : null;
            if ( $logo && ! empty( $logo['url'] ) ) : ?>
                <a href="<?php echo esc_url( home_url('/') ); ?>" class="site-footer__logo-link">
                    <img
                        src="<?php echo esc_url( $logo['url'] ); ?>"
                        alt="<?php bloginfo('name'); ?>"
                        class="site-footer__logo"
                        loading="lazy"
                        width="160"
                    >
                </a>
            <?php endif; ?>
            <img
                src="<?php echo get_template_directory_uri(); ?>/assets/dist/images/partner-logo-leiste.svg"
                alt="Partner-Logos: Ziviltechniker Österreich, WISSEN WIE'S GELINGT, ÖWAV, Kleinwasserkraft Österreich"
                class="site-footer__partner-logos"
                loading="lazy"
                height="48"
            >
        </div><!-- .site-footer__logos -->

        <!-- Footer Hauptbereich -->
        <div class="site-footer__inner">

            <!-- Kontakt -->
            <div class="site-footer__contact">
                <h3 class="site-footer__contact-title">IB MOSBACHER GMBH</h3>
                <p>Ing. Jürgen Mosbacher</p>
                <p><a href="tel:+436769606287">+43 676 / 960 62 87</a></p>
                <p><a href="mailto:j.mosbacher@ib-mosbacher.at">j.mosbacher@ib-mosbacher.at</a></p>
            </div>

            <!-- Firmensitz -->
            <div class="site-footer__address">
                <h3 class="site-footer__address-title">FIRMENSITZ</h3>
                <p>Steingasse 8<br>2620 Loipersbach</p>
            </div>

            <!-- Bürostandort -->
            <div class="site-footer__address">
                <h3 class="site-footer__address-title">BÜROSTANDORT</h3>
                <p>Komzakgasse 8<br>2620 Neunkirchen</p>
            </div>

            <!-- Navigation -->
            <?php if ( has_nav_menu('primary') ) :
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'menu_class'     => 'site-footer__nav-list',
                    'container'      => 'nav',
                    'container_class'=> 'site-footer__nav',
                    'container_aria_label' => 'Footer Navigation',
                    'depth'          => 1,
                    'fallback_cb'    => false,
                ));
            endif; ?>

        </div><!-- .site-footer__inner -->

        <!-- Footer Bottom -->
        <div class="site-footer__bottom">

            <?php if ( has_nav_menu('footer') ) :
                wp_nav_menu([
                    'theme_location' => 'footer-legal',
                    'menu_class'     => 'site-footer__legal-list',
                    'container'      => 'nav',
                    'container_class'=> 'site-footer__legal',
                    'depth'          => 1,
                    'fallback_cb'    => false,
                ]);
            endif; ?>

            <p class="site-footer__copyright">
                Copyright &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>
            </p>

            <p class="site-footer__credit">
                <em>Webdesign &amp; Programmierung | <a href="https://www.media-lab.at" target="_blank" rel="noopener noreferrer">Media Lab Tritremmel GmbH</a></em>
            </p>

        </div><!-- .site-footer__bottom -->

    </div><!-- .container -->

    <!-- Farbige Trennlinie ganz unten -->
    <div class="site-footer__divider"></div>

</footer>

<?php
// ── Back-to-Top Button ────────────────────────────────────────────────────
if ( function_exists('get_field') && get_field('btt_enabled', 'option') ) : ?>
<button
    class="back-to-top"
    aria-label="<?php esc_attr_e('Zurück nach oben', 'ib-mosbacher'); ?>"
    type="button"
>
    <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
        <polyline points="18 15 12 9 6 15"></polyline>
    </svg>
</button>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
