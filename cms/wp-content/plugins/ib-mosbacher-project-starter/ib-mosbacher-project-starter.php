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


// ─────────────────────────────────────────────────────────────────
// REFERENZKUNDEN CPT
// Firmen-Logos mit Name + URL auf der Referenzen-Seite
// ─────────────────────────────────────────────────────────────────

function ibm_register_referenzkunden_cpt() {
    $labels = array(
        'name'               => __( 'Referenzkunden', 'ib-mosbacher' ),
        'singular_name'      => __( 'Referenzkunde', 'ib-mosbacher' ),
        'menu_name'          => __( 'Referenzkunden', 'ib-mosbacher' ),
        'add_new'            => __( 'Neu hinzufügen', 'ib-mosbacher' ),
        'add_new_item'       => __( 'Neuen Referenzkunden hinzufügen', 'ib-mosbacher' ),
        'edit_item'          => __( 'Referenzkunden bearbeiten', 'ib-mosbacher' ),
        'not_found'          => __( 'Keine Referenzkunden gefunden', 'ib-mosbacher' ),
        'not_found_in_trash' => __( 'Keine Referenzkunden im Papierkorb', 'ib-mosbacher' ),
    );

    $args = array(
        'labels'        => $labels,
        'public'        => false,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'show_in_rest'  => true,
        'menu_icon'     => 'dashicons-building',
        'menu_position' => 30,
        'supports'      => array( 'title', 'thumbnail', 'page-attributes' ),
        'has_archive'   => false,
        'rewrite'       => false,
    );

    register_post_type( 'referenzkunde', $args );
}
add_action( 'init', 'ibm_register_referenzkunden_cpt' );


// ─────────────────────────────────────────────────────────────────
// PARTNER CPT
// Partnernetzwerk auf der „Über uns"-Seite
// ─────────────────────────────────────────────────────────────────

function ibm_register_partner_cpt() {
    $labels = array(
        'name'               => __( 'Partner', 'ib-mosbacher' ),
        'singular_name'      => __( 'Partner', 'ib-mosbacher' ),
        'menu_name'          => __( 'Partner', 'ib-mosbacher' ),
        'add_new'            => __( 'Neu hinzufügen', 'ib-mosbacher' ),
        'add_new_item'       => __( 'Neuen Partner hinzufügen', 'ib-mosbacher' ),
        'edit_item'          => __( 'Partner bearbeiten', 'ib-mosbacher' ),
        'not_found'          => __( 'Keine Partner gefunden', 'ib-mosbacher' ),
        'not_found_in_trash' => __( 'Keine Partner im Papierkorb', 'ib-mosbacher' ),
    );

    $args = array(
        'labels'        => $labels,
        'public'        => false,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'show_in_rest'  => true,
        'menu_icon'     => 'dashicons-networking',
        'menu_position' => 31,
        'supports'      => array( 'title', 'thumbnail', 'editor', 'page-attributes' ),
        'has_archive'   => false,
        'rewrite'       => false,
    );

    register_post_type( 'partner', $args );
}
add_action( 'init', 'ibm_register_partner_cpt' );


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
