<?php
/**
 * Template: Einzelne Projekt-Detailseite
 *
 * @package ib-mosbacher
 */

get_header();

// Hero = Featured Image des Projekts
if (has_post_thumbnail()) {
    set_query_var('hero_args', ['post_id' => get_the_ID()]);
}
get_template_part('template-parts/hero-image');
?>

<main id="primary" class="site-main">
    <div class="container">

        <?php while (have_posts()) : the_post(); ?>

        <!-- Zurück zu Projekten (oben) -->
        <div class="project-detail__back project-detail__back--top">
            <a href="<?php echo esc_url(home_url('/projekte-referenzen/')); ?>" class="btn btn--outline">
                ← Zurück zu Projekte / Referenzen
            </a>
        </div>

        <!-- Seitenüberschrift: blauer Block + grüner Unterstrich -->
        <div class="page-title-block">
            <h1 class="page-title"><?php the_title(); ?></h1>
        </div>

        <!-- Projekteckdaten -->
        <section class="project-detail__eckdaten">
            <h2 class="section-heading">PROJEKTECKDATEN</h2>

            <?php
            $kunde       = get_field('projekt_kunde');
            $zeitraum    = get_field('projekt_zeitraum');
            $leistungen  = get_field('projekt_leistungen');
            $fachgebiete = get_the_terms(get_the_ID(), 'projekt_fachgebiet');
            ?>

            <div class="project-detail__meta-rows">

                <?php if ($kunde) : ?>
                <div class="project-detail__meta-row">
                    <span class="project-detail__meta-label">Auftraggeber</span>
                    <span class="project-detail__meta-value"><?php echo esc_html($kunde); ?></span>
                </div>
                <?php endif; ?>

                <?php if ($zeitraum) : ?>
                <div class="project-detail__meta-row">
                    <span class="project-detail__meta-label">Umsetzungszeitraum</span>
                    <span class="project-detail__meta-value"><?php echo esc_html($zeitraum); ?></span>
                </div>
                <?php endif; ?>

                <?php if ($fachgebiete && !is_wp_error($fachgebiete)) : ?>
                <div class="project-detail__meta-row">
                    <span class="project-detail__meta-label">Kategorie</span>
                    <span class="project-detail__meta-value">
                        <?php echo esc_html(implode(', ', wp_list_pluck($fachgebiete, 'name'))); ?>
                    </span>
                </div>
                <?php endif; ?>

                <?php if ($leistungen) : ?>
                <div class="project-detail__meta-row">
                    <span class="project-detail__meta-label">Leistungen</span>
                    <span class="project-detail__meta-value"><?php echo nl2br(esc_html($leistungen)); ?></span>
                </div>
                <?php endif; ?>

            </div>
        </section>

        <!-- Projektbeschreibung -->
        <?php if (get_the_content()) : ?>
        <section class="project-detail__content entry-content">
            <h2 class="section-heading">PROJEKTBESCHREIBUNG</h2>
            <?php the_content(); ?>
        </section>
        <?php endif; ?>

        <!-- Navigation: Voriges / Nächstes Projekt -->
        <nav class="project-detail__nav" aria-label="Projekt-Navigation">
            <?php
            $prev = get_previous_post(false, '', 'projekt_fachgebiet');
            $next = get_next_post(false, '', 'projekt_fachgebiet');
            ?>
            <div class="project-detail__nav-inner">
                <?php if ($prev) : ?>
                <a href="<?php echo esc_url(get_permalink($prev)); ?>" class="project-detail__nav-btn project-detail__nav-btn--prev">
                    <span class="project-detail__nav-arrow">←</span>
                    <span class="project-detail__nav-label">Voriges Projekt</span>
                    <span class="project-detail__nav-title"><?php echo esc_html(get_the_title($prev)); ?></span>
                </a>
                <?php else : ?>
                <span class="project-detail__nav-btn project-detail__nav-btn--disabled"></span>
                <?php endif; ?>

                <?php if ($next) : ?>
                <a href="<?php echo esc_url(get_permalink($next)); ?>" class="project-detail__nav-btn project-detail__nav-btn--next">
                    <span class="project-detail__nav-label">Nächstes Projekt</span>
                    <span class="project-detail__nav-title"><?php echo esc_html(get_the_title($next)); ?></span>
                    <span class="project-detail__nav-arrow">→</span>
                </a>
                <?php else : ?>
                <span class="project-detail__nav-btn project-detail__nav-btn--disabled"></span>
                <?php endif; ?>
            </div>
        </nav>

        <?php endwhile; ?>

    </div>
</main>

<?php get_footer(); ?>
