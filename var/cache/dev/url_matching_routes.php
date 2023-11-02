<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/xdebug' => [[['_route' => '_profiler_xdebug', '_controller' => 'web_profiler.controller.profiler::xdebugAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/admin/index' => [[['_route' => 'admin_index', '_controller' => 'App\\Controller\\AdminController::index'], null, null, null, false, false, null]],
        '/admin/user_roles' => [[['_route' => 'user-roles', '_controller' => 'App\\Controller\\AdminController::userRoles'], null, null, null, false, false, null]],
        '/index' => [[['_route' => 'index', '_controller' => 'App\\Controller\\DefaultController::index'], null, null, null, false, false, null]],
        '/reviews' => [[['_route' => 'reviews', '_controller' => 'App\\Controller\\DefaultController::reviews'], null, null, null, false, false, null]],
        '/movie/create' => [[['_route' => 'create-movie', '_controller' => 'App\\Controller\\DefaultController::createMovie'], null, null, null, false, false, null]],
        '/login' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\LoginController::index'], null, null, null, false, false, null]],
        '/logout' => [[['_route' => 'app_logout', '_controller' => 'App\\Controller\\LoginController::logout'], null, ['GET' => 0], null, false, false, null]],
        '/mod/index' => [[['_route' => 'mod_index', '_controller' => 'App\\Controller\\ModController::index'], null, null, null, false, false, null]],
        '/register' => [[['_route' => 'app_register', '_controller' => 'App\\Controller\\RegistrationController::register'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:102)'
                            .'|router(*:116)'
                            .'|exception(?'
                                .'|(*:136)'
                                .'|\\.css(*:149)'
                            .')'
                        .')'
                        .'|(*:159)'
                    .')'
                .')'
                .'|/movie/(?'
                    .'|review/(?'
                        .'|create/([^/]++)(*:204)'
                        .'|rate/create/([^/]++)(*:232)'
                    .')'
                    .'|view/([^/]++)(*:254)'
                .')'
                .'|/review/view(?'
                    .'|/([^/]++)(*:287)'
                    .'|_rating/([^/]++)(*:311)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        102 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        116 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        136 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        149 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        159 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        204 => [[['_route' => 'create-review', '_controller' => 'App\\Controller\\DefaultController::createReview'], ['id'], null, null, false, true, null]],
        232 => [[['_route' => 'create-review-review', '_controller' => 'App\\Controller\\DefaultController::createReviewReview'], ['id'], null, null, false, true, null]],
        254 => [[['_route' => 'view-movie', '_controller' => 'App\\Controller\\DefaultController::viewMovie'], ['id'], null, null, false, true, null]],
        287 => [[['_route' => 'view-review', '_controller' => 'App\\Controller\\DefaultController::viewReview'], ['id'], null, null, false, true, null]],
        311 => [
            [['_route' => 'view-review-review', '_controller' => 'App\\Controller\\DefaultController::viewReviewReview'], ['id'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
