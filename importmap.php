<?php

/**
 * Returns the importmap for this application.
 *
 * - "path" is a path inside the asset mapper system. Use the
 *     "debug:asset-map" command to see the full list of paths.
 *
 * - "entrypoint" (JavaScript only) set to true for any module that will
 *     be used as an "entrypoint" (and passed to the importmap() Twig function).
 *
 * The "importmap:require" command can be used to add new entries to this file.
 */
return [
    'app' => [
        'path' => './assets/app.js',
        'entrypoint' => true,
    ],
    '@hotwired/stimulus' => [
        'version' => '3.2.2',
    ],
    '@symfony/stimulus-bundle' => [
        'path' => './vendor/symfony/stimulus-bundle/assets/dist/loader.js',
    ],
    '@hotwired/turbo' => [
        'version' => '7.3.0',
    ],
    'bootstrap' => [
        'version' => '5.3.8',
    ],
    '@popperjs/core' => [
        'version' => '2.11.8',
    ],
    'bootstrap/dist/css/bootstrap.min.css' => [
        'version' => '5.3.8',
        'type' => 'css',
    ],
    'bootstrap/dist/js/bootstrap.bundle.min.js' => [
        'version' => '5.3.8',
    ],
    'jquery' => [
        'version' => '3.7.1',
    ],
    'datatables.net-bs5' => [
        'version' => '2.3.4',
    ],
    'datatables.net-colreorder-bs5' => [
        'version' => '2.1.2',
    ],
    'datatables.net-fixedheader-bs5' => [
        'version' => '4.0.5',
    ],
    'datatables.net-responsive-bs5' => [
        'version' => '3.0.7',
    ],
    'datatables.net-rowreorder-bs5' => [
        'version' => '1.5.0',
    ],
    'datatables.net-searchpanes-bs5' => [
        'version' => '2.3.5',
    ],
    'datatables.net-datetime' => [
        'version' => '1.6.1',
    ],
    'datatables.net' => [
        'version' => '2.3.4',
    ],
    'datatables.net-colreorder' => [
        'version' => '2.1.2',
    ],
    'datatables.net-fixedheader' => [
        'version' => '4.0.5',
    ],
    'datatables.net-responsive' => [
        'version' => '3.0.7',
    ],
    'datatables.net-rowreorder' => [
        'version' => '1.5.0',
    ],
    'datatables.net-searchpanes' => [
        'version' => '2.3.5',
    ],
    'datatables.net-bs5/css/dataTables.bootstrap5.min.css' => [
        'version' => '2.3.4',
        'type' => 'css',
    ],
    'datatables.net-colreorder-bs5/css/colReorder.bootstrap5.min.css' => [
        'version' => '2.1.2',
        'type' => 'css',
    ],
    'datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css' => [
        'version' => '4.0.5',
        'type' => 'css',
    ],
    'datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css' => [
        'version' => '3.0.7',
        'type' => 'css',
    ],
    'datatables.net-rowreorder-bs5/css/rowReorder.bootstrap5.min.css' => [
        'version' => '1.5.0',
        'type' => 'css',
    ],
    'datatables.net-searchpanes-bs5/css/searchPanes.bootstrap5.min.css' => [
        'version' => '2.3.5',
        'type' => 'css',
    ],
    'datatables.net-datetime/dist/dataTables.dateTime.min.css' => [
        'version' => '1.6.1',
        'type' => 'css',
    ],
    'datatables.net-select-bs5' => [
        'version' => '3.1.3',
    ],
    'datatables.net-select' => [
        'version' => '3.1.3',
    ],
    'datatables.net-select-bs5/css/select.bootstrap5.min.css' => [
        'version' => '3.1.3',
        'type' => 'css',
    ],
];
