<?php
/**
 * Front page template (Home)
 *
 * WordPress uses this file when Settings → Reading → "Front page displays"
 * is set to "A static page" and the Front page is assigned.
 *
 * ACF fields used (all attached to this page via the 'front_page' location rule):
 *   hero_header    — WYSIWYG
 *   hero_quote     — WYSIWYG
 *   funding_note   — WYSIWYG
 *   non_profit_note — WYSIWYG
 *
 * Global option fields (from Site Options ACF page):
 *   cta, footer_left, footer_right
 */

$hero_header     = function_exists( 'get_field' ) ? get_field( 'hero_header' )     : '';
$hero_quote      = function_exists( 'get_field' ) ? get_field( 'hero_quote' )      : '';
$funding_note    = function_exists( 'get_field' ) ? get_field( 'funding_note' )    : '';
$non_profit_note = function_exists( 'get_field' ) ? get_field( 'non_profit_note' ) : '';

get_template_part( 'template-parts/header' );
get_template_part( 'template-parts/cta' );
?>

<!-- Hero ------------------------------------------------------------------ -->
<section class="section section--hero">
    <div class="grid grid__fullplus">
        <div class="hero-inner">
            <div class="typography__hero">
                <?php echo wp_kses_post( $hero_header ); ?>
            </div>
            <div class="grid grid__two-thirds quote typography__alpha typography--light color--blue6">
                <?php echo wp_kses_post( $hero_quote ); ?>
            </div>
        </div>
    </div>
</section>

<!-- Funding note ---------------------------------------------------------- -->
<section class="section">
    <div class="grid grid__fullplus">
        <div class="typography__alpha color--neutral8">
            <?php echo wp_kses_post( $funding_note ); ?>
        </div>
    </div>
</section>

<!-- Tiles ----------------------------------------------------------------- -->
<section class="section section--tiles">
    <div class="grid grid__fullplus">
        <div class="tile-wrapper">
            <div class="tile bgcolor--blue8 span2">
                <p class="typography__charlie color--white">The Hubb includes programming for</p>
            </div>
            <div class="tile bgcolor--neutral4">
                <p class="typography__charlie color--orange10">Students</p>
            </div>
            <div class="tile bgcolor--neutral2 span2">
                <p class="typography__charlie color--blue6">Entrepreneurs</p>
            </div>
            <div class="tile bgcolor--orange2">
                <p class="typography__charlie color--blue8">Families</p>
            </div>
            <div class="tile bgcolor--neutral4">
                <p class="typography__charlie color--blue6">Senior Citizens</p>
            </div>
            <div class="tile bgcolor--orange2 span2">
                <p class="typography__charlie color--orange10">Small Business Owners</p>
            </div>
            <div class="tile bgcolor--neutral4 span2">
                <p class="typography__charlie color--orange10">Individuals in Recovery</p>
            </div>
            <div class="tile bgcolor--neutral2">
                <p class="typography__charlie color--neutral8">&amp; more</p>
            </div>
        </div>
    </div>
</section>

<!-- Non-profit note ------------------------------------------------------- -->
<section class="section">
    <div class="grid grid__fullplus">
        <div class="typography__delta color--neutral8">
            <?php echo wp_kses_post( $non_profit_note ); ?>
        </div>
    </div>
</section>

<?php get_template_part( 'template-parts/footer' ); ?>
