<?php
/*********************************************************************
 * contracts.php
 *
 * Connect's contracts page
 *
 * Copyright (c)  2017-2022 SINCE TECH
 * http://www.sincetech.co.uk/
 *
 * Released under the GNU General Public License WITHOUT ANY WARRANTY.
 **********************************************************************/

require_once('../config/config.php');
require_once('../config/inc/func.inc.php');

$t = strtolower($_REQUEST['t'] ?? '');

$user_role = '';
$title = 'Contracts';
$pgCss = '';
$pgJs = '';
$page = 'contract.page.php';

// Common assets
$commonCss = [
    ASSETS_URL . 'lib/DataTables/datatables.min.css',
];
$commonJs = [
    'https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js',
    ASSETS_URL . 'lib/DataTables/datatables.min.js',
    VIEWS_URL . 'contracts/js/contract.handler.js',
];

// Define configurations for each page type
$pageConfigs = [
    'view-assets' => [
        'title' => 'Contracts',
        'css' => array_merge($commonCss, [
            ASSETS_URL . 'lib/ion.rangeSlider/css/ion.rangeSlider.css',
            ASSETS_URL . 'lib/ion.rangeSlider/css/ion.rangeSlider.skinModern.css',
            ASSETS_URL . 'lib/css/smart_wizard_all.min.css',
            ASSETS_URL . '/css/ecnis_x_smart_wiz.css',
        ]),
        'js' => array_merge($commonJs, [
            ASSETS_URL . 'lib/js/jquery.smartWizard.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js',
            ASSETS_URL . 'lib/jquery.postcodes-master/src/jquery.postcodes.js',
            ASSETS_URL . 'js/select2.full.min.js',
        ]),
        'page' => 'contract-asset-list.page.php',
    ],
    'view-asset' => [
        'title' => 'Contracts Summary',
        'css' => array_merge($commonCss, [
            ASSETS_URL . '/css/jquery.filer-dragdropbox-theme.css',
        ]),
        'js' => $commonJs,
        'page' => 'contract-asset-view.page.php',
    ],
    'record-a' => [
        'title' => 'Create Client Record',
        'css' => [
            ASSETS_URL . 'lib/ion.rangeSlider/css/ion.rangeSlider.css',
            ASSETS_URL . 'lib/ion.rangeSlider/css/ion.rangeSlider.skinModern.css',
            ASSETS_URL . 'lib/css/smart_wizard_all.min.css',
            ASSETS_URL . '/css/ecnis_x_smart_wiz.css',
        ],
        'js' => array_merge($commonJs, [
            ASSETS_URL . 'lib/js/jquery.smartWizard.min.js',
            ASSETS_URL . 'lib/jquery.postcodes-master/src/jquery.postcodes.js',
        ]),
        'page' => 'contract-record-a.page.php',
    ],
    // Add other cases in similar structure...
    'default' => [
        'title' => 'Contracts',
        'page' => 'contract.page.php',
    ],
];

// Apply configurations based on the page type
$config = $pageConfigs[$t] ?? $pageConfigs['default'];
$title = $config['title'];
$pgCss = implode("\n", array_map(fn($css) => "<link rel=\"stylesheet\" href=\"$css\">", $config['css'] ?? []));
$pgJs = implode("\n", array_map(fn($js) => "<script src=\"$js\"></script>", $config['js'] ?? []));
$page = $config['page'];

// Render the page
include PARTIALS_DIR . 'header.page.php';
include PARTIALS_DIR . $page;
include PARTIALS_DIR . 'footer.page.php';
