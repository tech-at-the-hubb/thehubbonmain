<?php
/**
 * The Hubb Theme — functions.php
 *
 * - Enqueues fonts and CSS
 * - Registers the `program` custom post type
 * - Registers nav menus
 * - Registers ACF Options page (global CTA + footer fields)
 * - Defines all ACF field groups via PHP so they are version-controlled
 */

/* ============================================================
   Theme setup
   ============================================================ */
function thehubb_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ] );

    register_nav_menus( [
        'primary' => __( 'Primary Navigation', 'thehubb-theme' ),
    ] );
}
add_action( 'after_setup_theme', 'thehubb_setup' );

/* ============================================================
   Enqueue styles and fonts
   ============================================================ */
function thehubb_enqueue_assets() {
    // Google Fonts — Rubik + Merriweather
    wp_enqueue_style(
        'thehubb-google-fonts',
        'https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;1,300;1,400&family=Rubik:wght@300;400;700&display=swap',
        [],
        null
    );

    // Design system CSS
    wp_enqueue_style( 'thehubb-colors',     get_template_directory_uri() . '/assets/css/colors.css',     [ 'thehubb-google-fonts' ], '1.0.0' );
    wp_enqueue_style( 'thehubb-typography', get_template_directory_uri() . '/assets/css/typography.css', [ 'thehubb-colors' ],       '1.0.0' );
    wp_enqueue_style( 'thehubb-grid',       get_template_directory_uri() . '/assets/css/grid.css',       [ 'thehubb-typography' ],   '1.0.0' );
    wp_enqueue_style( 'thehubb-theme',      get_template_directory_uri() . '/assets/css/theme.css',      [ 'thehubb-grid' ],         '1.0.0' );

    // Minimal JS (enqueue only if the file exists — it's a placeholder)
    if ( file_exists( get_template_directory() . '/assets/js/theme.js' ) ) {
        wp_enqueue_script( 'thehubb-theme-js', get_template_directory_uri() . '/assets/js/theme.js', [], '1.0.0', true );
    }
}
add_action( 'wp_enqueue_scripts', 'thehubb_enqueue_assets' );

/* ============================================================
   Register `program` Custom Post Type
   ============================================================ */
function thehubb_register_program_cpt() {
    $labels = [
        'name'               => __( 'Programs',          'thehubb-theme' ),
        'singular_name'      => __( 'Program',           'thehubb-theme' ),
        'add_new_item'       => __( 'Add New Program',   'thehubb-theme' ),
        'edit_item'          => __( 'Edit Program',      'thehubb-theme' ),
        'new_item'           => __( 'New Program',       'thehubb-theme' ),
        'view_item'          => __( 'View Program',      'thehubb-theme' ),
        'search_items'       => __( 'Search Programs',   'thehubb-theme' ),
        'not_found'          => __( 'No programs found', 'thehubb-theme' ),
        'menu_name'          => __( 'Programs',          'thehubb-theme' ),
    ];

    register_post_type( 'program', [
        'labels'              => $labels,
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_rest'        => false,
        'menu_icon'           => 'dashicons-groups',
        'supports'            => [ 'title' ],
        'has_archive'         => false,
        'rewrite'             => false,
        'exclude_from_search' => true,
    ] );
}
add_action( 'init', 'thehubb_register_program_cpt' );

/* ============================================================
   ACF: Options page (global fields — CTA + footer)
   ============================================================ */
function thehubb_register_options_page() {
    if ( ! function_exists( 'acf_add_options_page' ) ) {
        return;
    }

    acf_add_options_page( [
        'page_title' => 'Site Options',
        'menu_title' => 'Site Options',
        'menu_slug'  => 'thehubb-options',
        'capability' => 'edit_posts',
        'redirect'   => false,
    ] );
}
add_action( 'acf/init', 'thehubb_register_options_page' );

/* ============================================================
   ACF: Field group definitions (version-controlled via PHP)
   ============================================================ */
function thehubb_register_acf_field_groups() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    /* ----------------------------------------------------------
       1. Global Options — CTA + Footer (shown on Options page)
       ---------------------------------------------------------- */
    acf_add_local_field_group( [
        'key'    => 'group_thehubb_options',
        'title'  => 'Global Options',
        'fields' => [
            [
                'key'          => 'field_cta',
                'label'        => 'CTA Text',
                'name'         => 'cta',
                'type'         => 'wysiwyg',
                'instructions' => 'Short call-to-action text shown in the sticky banner next to the Donate button. Appears on every page.',
                'toolbar'      => 'basic',
                'media_upload' => 0,
            ],
            [
                'key'          => 'field_footer_left',
                'label'        => 'Footer — Left Column',
                'name'         => 'footer_left',
                'type'         => 'wysiwyg',
                'instructions' => 'Content for the left column of the footer (address, hours, etc.).',
                'toolbar'      => 'basic',
                'media_upload' => 0,
            ],
            [
                'key'          => 'field_footer_right',
                'label'        => 'Footer — Right Column',
                'name'         => 'footer_right',
                'type'         => 'wysiwyg',
                'instructions' => 'Content for the right column of the footer.',
                'toolbar'      => 'basic',
                'media_upload' => 0,
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'thehubb-options',
                ],
            ],
        ],
        'menu_order'            => 0,
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
    ] );

    /* ----------------------------------------------------------
       2. Home Page fields (attached to the page set as front page)
       ---------------------------------------------------------- */
    acf_add_local_field_group( [
        'key'    => 'group_thehubb_home',
        'title'  => 'Home Page Content',
        'fields' => [
            [
                'key'          => 'field_hero_header',
                'label'        => 'Hero Header',
                'name'         => 'hero_header',
                'type'         => 'wysiwyg',
                'instructions' => 'Large hero text at the top of the home page.',
                'toolbar'      => 'basic',
                'media_upload' => 0,
            ],
            [
                'key'          => 'field_hero_quote',
                'label'        => 'Hero Quote',
                'name'         => 'hero_quote',
                'type'         => 'wysiwyg',
                'instructions' => 'Pull-quote displayed below the hero header (shown with a left border accent).',
                'toolbar'      => 'basic',
                'media_upload' => 0,
            ],
            [
                'key'          => 'field_funding_note',
                'label'        => 'Funding Note',
                'name'         => 'funding_note',
                'type'         => 'wysiwyg',
                'instructions' => 'Short note about funding/grants, displayed below the tiles section.',
                'toolbar'      => 'basic',
                'media_upload' => 0,
            ],
            [
                'key'          => 'field_non_profit_note',
                'label'        => 'Non-Profit Note',
                'name'         => 'non_profit_note',
                'type'         => 'wysiwyg',
                'instructions' => 'Statement about The Hubb\'s non-profit status, displayed near the bottom of the home page.',
                'toolbar'      => 'basic',
                'media_upload' => 0,
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'page_type',
                    'operator' => '==',
                    'value'    => 'front_page',
                ],
            ],
        ],
        'menu_order'            => 0,
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
    ] );

    /* ----------------------------------------------------------
       3. Program CPT fields
       ---------------------------------------------------------- */
    acf_add_local_field_group( [
        'key'    => 'group_thehubb_program',
        'title'  => 'Program Details',
        'fields' => [
            [
                'key'          => 'field_program_agency',
                'label'        => 'Agency',
                'name'         => 'agency',
                'type'         => 'text',
                'instructions' => 'Name of the agency or organization running this program.',
                'required'     => 1,
            ],
            [
                'key'          => 'field_program_visible_date',
                'label'        => 'Date / Schedule',
                'name'         => 'visible_date',
                'type'         => 'text',
                'instructions' => 'Human-readable date or schedule (e.g. "Every Tuesday, 10am–12pm" or "March 2024").',
            ],
            [
                'key'          => 'field_program_representative',
                'label'        => 'Representative',
                'name'         => 'representative',
                'type'         => 'text',
                'instructions' => 'Name of the contact person or representative for this program.',
            ],
            [
                'key'          => 'field_program_description',
                'label'        => 'Description',
                'name'         => 'description',
                'type'         => 'wysiwyg',
                'instructions' => 'Brief description of what the program offers.',
                'toolbar'      => 'basic',
                'media_upload' => 0,
            ],
            [
                'key'          => 'field_program_contact',
                'label'        => 'Contact',
                'name'         => 'contact',
                'type'         => 'text',
                'instructions' => 'Phone number, email, or website for attendees to reach the program.',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'program',
                ],
            ],
        ],
        'menu_order'            => 0,
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
    ] );
}
add_action( 'acf/init', 'thehubb_register_acf_field_groups' );

/* ============================================================
   Helper: get ACF option field (with graceful fallback)
   ============================================================ */
function thehubb_get_option( string $field_name ): string {
    if ( function_exists( 'get_field' ) ) {
        return (string) get_field( $field_name, 'option' );
    }
    return '';
}
