<?php
/**
 * Plugin Name: IB Mosbacher – Projekt-Starter
 * Description: Custom Post Types und ACF-Felder für IB Mosbacher GmbH (Projekte, Partner, Referenzkunden)
 * Version: 1.0.0
 * Author: Media Lab Tritremmel GmbH
 * Text Domain: ib-mosbacher
 */

if ( ! defined( 'ABSPATH' ) ) exit;


// ─────────────────────────────────────────────────────────────────
// PROJEKTE CPT (nutzt bestehenden „project" CPT aus agency-core)
// Zusätzliche Taxonomie: Projekt-Fachgebiet (für Filter-Tabs)
// ─────────────────────────────────────────────────────────────────

/**
 * Projekt-Fachgebiet Taxonomie
 * Filter-Tabs auf der Referenzen-Seite:
 *   - Hochwasserschutz und Wasserwirtschaft
 *   - Fischaufstieg und Bewässerungsanlagen
 *   - Entwässerung und Versickerung
 *   - Wasserkraft und Fischabstiegshilfen
 */
function ibm_register_projekt_fachgebiet_taxonomy() {
    $labels = array(
        'name'              => __( 'Fachgebiete', 'ib-mosbacher' ),
        'singular_name'     => __( 'Fachgebiet', 'ib-mosbacher' ),
        'search_items'      => __( 'Fachgebiete durchsuchen', 'ib-mosbacher' ),
        'all_items'         => __( 'Alle Fachgebiete', 'ib-mosbacher' ),
        'edit_item'         => __( 'Fachgebiet bearbeiten', 'ib-mosbacher' ),
        'update_item'       => __( 'Fachgebiet aktualisieren', 'ib-mosbacher' ),
        'add_new_item'      => __( 'Neues Fachgebiet hinzufügen', 'ib-mosbacher' ),
        'new_item_name'     => __( 'Neues Fachgebiet', 'ib-mosbacher' ),
        'menu_name'         => __( 'Fachgebiete', 'ib-mosbacher' ),
    );

    register_taxonomy( 'projekt_fachgebiet', array( 'project' ), array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'rewrite'           => array( 'slug' => 'fachgebiet' ),
    ) );
}
add_action( 'init', 'ibm_register_projekt_fachgebiet_taxonomy' );


/**
 * Standard-Fachgebiete beim ersten Aktivieren anlegen
 */
function ibm_create_default_fachgebiete() {
    if ( get_option( 'ibm_fachgebiete_created' ) ) return;

    $fachgebiete = array(
        'Hochwasserschutz und Wasserwirtschaft',
        'Fischaufstieg und Bewässerungsanlagen',
        'Entwässerung und Versickerung',
        'Wasserkraft und Fischabstiegshilfen',
    );

    foreach ( $fachgebiete as $name ) {
        if ( ! term_exists( $name, 'projekt_fachgebiet' ) ) {
            wp_insert_term( $name, 'projekt_fachgebiet' );
        }
    }

    update_option( 'ibm_fachgebiete_created', true );
}
add_action( 'init', 'ibm_create_default_fachgebiete' );


// Referenzkunden: via medialab_logo CPT + logo_kategorie Taxonomie abgedeckt


// Partner: via medialab_logo CPT + logo_kategorie Taxonomie abgedeckt


// ─────────────────────────────────────────────────────────────────
// ACF FELDER (nur wenn ACF PRO aktiv)
// ─────────────────────────────────────────────────────────────────

add_action( 'acf/init', 'ibm_register_acf_fields' );

function ibm_register_acf_fields() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

    // ── Projekt Felder ──────────────────────────────────────────
    acf_add_local_field_group( array(
        'key'      => 'group_ibm_projekt',
        'title'    => 'Projekt-Eckdaten',
        'fields'   => array(
            array(
                'key'   => 'field_ibm_projekt_kunde',
                'label' => 'Kunde',
                'name'  => 'projekt_kunde',
                'type'  => 'text',
            ),
            array(
                'key'   => 'field_ibm_projekt_zeitraum',
                'label' => 'Umsetzungszeitraum',
                'name'  => 'projekt_zeitraum',
                'type'  => 'text',
                'placeholder' => 'z.B. 2022–2023',
            ),
            array(
                'key'   => 'field_ibm_projekt_leistungen',
                'label' => 'Erbrachte Leistungen',
                'name'  => 'projekt_leistungen',
                'type'  => 'textarea',
                'rows'  => 4,
            ),
        ),
        'location' => array( array( array(
            'param'    => 'post_type',
            'operator' => '==',
            'value'    => 'project',
        ) ) ),
        'menu_order' => 10,
    ) );

    // ── Referenzkunde Felder ─────────────────────────────────────
    acf_add_local_field_group( array(
        'key'      => 'group_ibm_referenzkunde',
        'title'    => 'Referenzkunden-Daten',
        'fields'   => array(
            array(
                'key'   => 'field_ibm_rk_url',
                'label' => 'Website-URL',
                'name'  => 'referenzkunde_url',
                'type'  => 'url',
                'placeholder' => 'https://',
            ),
        ),
        'location' => array( array( array(
            'param'    => 'post_type',
            'operator' => '==',
            'value'    => 'referenzkunde',
        ) ) ),
    ) );

    // ── Partner Felder ───────────────────────────────────────────
    acf_add_local_field_group( array(
        'key'      => 'group_ibm_partner',
        'title'    => 'Partner-Daten',
        'fields'   => array(
            array(
                'key'   => 'field_ibm_partner_beschreibung',
                'label' => 'Kurzbeschreibung',
                'name'  => 'partner_beschreibung',
                'type'  => 'textarea',
                'rows'  => 3,
            ),
            array(
                'key'   => 'field_ibm_partner_url',
                'label' => 'Website-URL',
                'name'  => 'partner_url',
                'type'  => 'url',
                'placeholder' => 'https://',
            ),
        ),
        'location' => array( array( array(
            'param'    => 'post_type',
            'operator' => '==',
            'value'    => 'partner',
        ) ) ),
    ) );
}


// ─────────────────────────────────────────────────────────────────
// FLOATING CTA BUTTONS (Telefon + E-Mail, rechts fixiert)
// ─────────────────────────────────────────────────────────────────

function ibm_floating_cta_buttons() {
    ?>
    <div class="floating-cta">
        <a href="tel:+436769606287" class="cta-phone" title="Jetzt anrufen" aria-label="Telefon: +43 676 960 62 87">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="22" height="22">
                <path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1-9.4 0-17-7.6-17-17 0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1L6.6 10.8z"/>
            </svg>
        </a>
        <a href="mailto:j.mosbacher@ib-mosbacher.at" class="cta-email" title="E-Mail senden" aria-label="E-Mail: j.mosbacher@ib-mosbacher.at">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="22" height="22">
                <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
            </svg>
        </a>
    </div>
    <?php
}
add_action( 'wp_footer', 'ibm_floating_cta_buttons' );

// Admin-Liste: medialab_logo nach menu_order sortieren
add_filter( 'request', function( $vars ) {
    if ( is_admin() && isset( $vars['post_type'] ) && $vars['post_type'] === 'medialab_logo' ) {
        if ( empty( $vars['orderby'] ) ) {
            $vars['orderby'] = 'menu_order';
            $vars['order']   = 'ASC';
        }
    }
    return $vars;
} );


// =============================================================================
// SHORTCODES – Logo-Grids nach Kategorie
// Verwendung: [ibm_logos kategorie="referenzkunden"]
//             [ibm_logos kategorie="partner-netzwerk"]
// =============================================================================

function ibm_logos_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'kategorie' => '',
        'columns'   => 4,
    ), $atts, 'ibm_logos' );

    $query_args = array(
        'post_type'      => 'medialab_logo',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    );

    if ( ! empty( $atts['kategorie'] ) ) {
        $query_args['tax_query'] = array(
            array(
                'taxonomy' => 'logo_kategorie',
                'field'    => 'slug',
                'terms'    => sanitize_title( $atts['kategorie'] ),
            ),
        );
    }

    $logos = get_posts( $query_args );
    if ( empty( $logos ) ) return '';

    $columns = intval( $atts['columns'] );
    $class   = 'ibm-logos-grid ibm-logos-grid--cols-' . $columns;

    ob_start();
    echo '<div class="' . esc_attr( $class ) . '">';

    foreach ( $logos as $logo ) {
        $image = get_field( 'logo_cpt_image', $logo->ID );
        $name  = get_field( 'logo_cpt_name',  $logo->ID ) ?: get_the_title( $logo );
        $url   = get_field( 'logo_cpt_url',   $logo->ID ) ?: '';

        if ( ! $image ) continue;

        echo '<div class="ibm-logo-card">';

        if ( $url ) echo '<a href="' . esc_url( $url ) . '" target="_blank" rel="noopener noreferrer">';

        echo '<div class="ibm-logo-card__image">';
        echo '<img src="' . esc_url( $image['url'] ) . '" alt="' . esc_attr( $name ) . '" loading="lazy">';
        echo '</div>';

        echo '<div class="ibm-logo-card__divider ibm-logo-card__divider--green"></div><div class="ibm-logo-card__divider ibm-logo-card__divider--blue"></div>';
        echo '<p class="ibm-logo-card__name">' . esc_html( $name ) . '</p>';

        if ( $url ) {
            echo '<p class="ibm-logo-card__url">' . esc_html( $url ) . '</p>';
            echo '</a>';
        }

        echo '</div>';
    }

    echo '</div>';
    return ob_get_clean();
}
add_shortcode( 'ibm_logos', 'ibm_logos_shortcode' );



// =============================================================================
// PROJEKTE CPT + TAXONOMIEN
// =============================================================================

function ibm_register_project_cpt() {
    register_post_type( 'project', array(
        'labels' => array(
            'name'               => __( 'Projekte', 'ib-mosbacher' ),
            'singular_name'      => __( 'Projekt', 'ib-mosbacher' ),
            'menu_name'          => __( 'Projekte', 'ib-mosbacher' ),
            'add_new'            => __( 'Neu hinzufügen', 'ib-mosbacher' ),
            'add_new_item'       => __( 'Neues Projekt', 'ib-mosbacher' ),
            'edit_item'          => __( 'Projekt bearbeiten', 'ib-mosbacher' ),
            'not_found'          => __( 'Keine Projekte gefunden', 'ib-mosbacher' ),
            'not_found_in_trash' => __( 'Keine Projekte im Papierkorb', 'ib-mosbacher' ),
        ),
        'public'       => true,
        'has_archive'  => true,
        'show_in_rest' => true,
        'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
        'menu_icon'    => 'dashicons-portfolio',
        'menu_position'=> 21,
        'rewrite'      => array( 'slug' => 'projekte' ),
        'taxonomies'   => array( 'project_category', 'projekt_fachgebiet' ),
    ) );
}
add_action( 'init', 'ibm_register_project_cpt' );


function ibm_register_project_category_taxonomy() {
    register_taxonomy( 'project_category', array( 'project' ), array(
        'labels' => array(
            'name'          => __( 'Projekt Kategorien', 'ib-mosbacher' ),
            'singular_name' => __( 'Projekt Kategorie', 'ib-mosbacher' ),
            'menu_name'     => __( 'Kategorien', 'ib-mosbacher' ),
        ),
        'hierarchical'      => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'rewrite'           => array( 'slug' => 'projekt-kategorie' ),
    ) );
}
add_action( 'init', 'ibm_register_project_category_taxonomy' );


// ACF Felder für Projekte
add_action( 'acf/init', 'ibm_register_project_acf_fields' );

function ibm_register_project_acf_fields() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

    acf_add_local_field_group( array(
        'key'    => 'group_ibm_projekt',
        'title'  => 'Projekt-Eckdaten',
        'fields' => array(
            array(
                'key'   => 'field_ibm_projekt_kunde',
                'label' => 'Kunde',
                'name'  => 'projekt_kunde',
                'type'  => 'text',
            ),
            array(
                'key'         => 'field_ibm_projekt_zeitraum',
                'label'       => 'Umsetzungszeitraum',
                'name'        => 'projekt_zeitraum',
                'type'        => 'text',
                'placeholder' => 'z.B. 2022–2023',
            ),
            array(
                'key'   => 'field_ibm_projekt_leistungen',
                'label' => 'Erbrachte Leistungen',
                'name'  => 'projekt_leistungen',
                'type'  => 'textarea',
                'rows'  => 4,
            ),
        ),
        'location' => array( array( array(
            'param'    => 'post_type',
            'operator' => '==',
            'value'    => 'project',
        ) ) ),
        'menu_order' => 10,
    ) );
}

// =============================================================================
// LOGO-KATEGORIE TAXONOMIE (für medialab_logo CPT)
// Partner-Netzwerk + Referenzkunden in einem CPT, getrennt via Kategorie
// =============================================================================

function ibm_register_logo_kategorie_taxonomy() {
    $labels = array(
        'name'          => __( 'Logo-Kategorien', 'ib-mosbacher' ),
        'singular_name' => __( 'Logo-Kategorie', 'ib-mosbacher' ),
        'menu_name'     => __( 'Kategorien', 'ib-mosbacher' ),
        'all_items'     => __( 'Alle Kategorien', 'ib-mosbacher' ),
        'add_new_item'  => __( 'Neue Kategorie', 'ib-mosbacher' ),
    );

    register_taxonomy( 'logo_kategorie', array( 'medialab_logo' ), array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'rewrite'           => false,
    ) );
}
add_action( 'init', 'ibm_register_logo_kategorie_taxonomy' );

function ibm_create_default_logo_kategorien() {
    if ( get_option( 'ibm_logo_kategorien_created' ) ) return;
    $kategorien = array( 'Partner-Netzwerk', 'Referenzkunden' );
    foreach ( $kategorien as $name ) {
        if ( ! term_exists( $name, 'logo_kategorie' ) ) {
            wp_insert_term( $name, 'logo_kategorie' );
        }
    }
    update_option( 'ibm_logo_kategorien_created', true );
}
add_action( 'init', 'ibm_create_default_logo_kategorien' );

