<?php
/**
 * Template Name: Calendar Page
 *
 * Assign this template to the "Calendar" page in WordPress admin
 * (Page → Page Attributes → Template → Calendar Page), or simply
 * create a page with the slug "calendar" and WordPress will pick
 * this file up automatically via the page-{slug}.php hierarchy.
 */

get_template_part( 'template-parts/header' );
get_template_part( 'template-parts/cta' );
?>

<section class="section">
    <div class="grid grid__fullplus">
        <iframe
            title="Google Calendar — The Hubb on Main"
            src="https://calendar.google.com/calendar/embed?src=info%40thehubbonmain.org&amp;ctz=America%2FNew_York"
            style="border: 0; width: 100%; height: 500px;"
            loading="lazy"
            allowfullscreen>
        </iframe>
    </div>
</section>

<?php get_template_part( 'template-parts/footer' ); ?>
