<?php
/**
 * Template part: program-card.php
 *
 * Called inside a WP_Query loop on the Programming page.
 * Expects the global $post to be a 'program' CPT post.
 */
$agency         = function_exists( 'get_field' ) ? get_field( 'agency' )         : '';
$visible_date   = function_exists( 'get_field' ) ? get_field( 'visible_date' )   : '';
$representative = function_exists( 'get_field' ) ? get_field( 'representative' ) : '';
$description    = function_exists( 'get_field' ) ? get_field( 'description' )    : '';
$contact        = function_exists( 'get_field' ) ? get_field( 'contact' )        : '';
?>

<div class="grid__half program-wrapper">
    <?php if ( $agency ) : ?>
        <p class="typography__charlie color--blue8"><?php echo esc_html( $agency ); ?></p>
    <?php endif; ?>

    <?php if ( $visible_date ) : ?>
        <p class="typography__echo typography--caps color--blue8">
            <b><?php echo esc_html( $visible_date ); ?></b>
        </p>
    <?php endif; ?>

    <?php if ( $representative ) : ?>
        <p class="typography__alpha typography--light color--blue8">
            <?php echo esc_html( $representative ); ?>
        </p>
    <?php endif; ?>

    <?php if ( $description ) : ?>
        <div class="typography__alpha typography--light color--neutral8">
            <?php echo wp_kses_post( $description ); ?>
        </div>
    <?php endif; ?>

    <?php if ( $contact ) : ?>
        <p class="typography__alpha color--neutral8"><?php echo esc_html( $contact ); ?></p>
    <?php endif; ?>
</div>
