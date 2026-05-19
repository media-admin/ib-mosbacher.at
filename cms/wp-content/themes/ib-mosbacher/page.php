<?php get_header(); ?>

<?php get_template_part('template-parts/hero-image'); ?>

<main id="primary" class="site-main">
    <div class="container">

        <?php while (have_posts()) : the_post(); ?>

            <!-- Seitenüberschrift: blauer Block + grüner Unterstrich -->
            <div class="page-title-block">
                <h1 class="page-title"><?php the_title(); ?></h1>
            </div>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>

        <?php endwhile; ?>

    </div>
</main>

<?php get_footer(); ?>
