<?php
/**
 * The template for displaying home
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_Comuni_Italia
 */

get_header();
?>
    <main id="main-container" class="main-container redbrown">
        <section id="head-section">
            <?php get_template_part("template-parts/home/notizie"); ?>
            <?php get_template_part("template-parts/home/calendario"); ?>
        </section>
        <section id="evidenza">
            <div class="section section-background-header py-5" style="background-image: url('<?php echo esc_url( get_template_directory_uri()); ?>/assets/img/evidenza-header.png')">
                <?php get_template_part("template-parts/home/argomenti"); ?>
                <?php get_template_part("template-parts/home/siti","tematici"); ?>
            </div>
        </section>
        <?php get_template_part("template-parts/home/ricerca"); ?>
    </main>
<?php
get_footer();
