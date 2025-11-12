<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'Sistema de Inventario',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>Sistema</b>_Inventario',
    'logo_img' => 'vendor/adminlte/dist/img/logo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Admin Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/logo.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration. Currently, two
    | modes are supported: 'fullscreen' for a fullscreen preloader animation
    | and 'cwrapper' to attach the preloader animation into the content-wrapper
    | element and avoid overlapping it with the sidebars and the top navbar.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => true,
        'mode' => 'fullscreen',
        'img' => [
            'path' => 'vendor/adminlte/dist/img/logo.png',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => 'perfil',
    'disable_darkmode_routes' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Asset Bundling
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Asset Bundling option for the admin panel.
    | Currently, the next modes are supported: 'mix', 'vite' and 'vite_js_only'.
    | When using 'vite_js_only', it's expected that your CSS is imported using
    | JavaScript. Typically, in your application's 'resources/js/app.js' file.
    | If you are not using any of these, leave it as 'false'.
    |
    | For detailed instructions you can look the asset bundling section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'laravel_asset_bundling' => false,
    'laravel_css_path' => 'css/app.css',
    'laravel_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [

        // 🔹 Barra superior
        [
            'type' => 'fullscreen-widget',
            'topnav_right' => true,
        ],
        [
            'text' => 'Inicio',
            'url' => 'admin',
            'icon' => 'fas fa-fw fa-home',
            'classes' => 'bg-blue text-white',
        ],

        // 🔹 Inventario
        ['header' => 'INVENTARIO'],

        [
            'can' => 'bienes.index',
            'text' => 'Bienes',
            'url' => 'admin/bienes',
            'icon' => 'fas fa-boxes',
            'classes' => 'bg-blue text-white',
            'active' => ['admin/bienes*'],
        ],
        [
            'can' => 'areas.index',
            'text' => 'Área - Ubicacion del Bien',
            'url' => 'admin/areas',
            'icon' => 'fas fa-school',
            'classes' => 'bg-blue text-white',
            'active' => ['admin/areas*'],
        ],
        [
            'can' => 'estados.index',
            'text' => 'Estados',
            'url' => 'admin/estados',
            'icon' => 'fas fa-check-circle',
            'classes' => 'bg-blue text-white',
            'active' => ['admin/estados*'],
        ],
        [
            'can' => 'categorias.porNombre',
            'text' => 'Categorías',
            'icon' => 'fas fa-tags',
            'classes' => 'bg-blue text-white',
            'submenu' => [

                // 🔹 Bienes Muebles
                [
                    'text' => 'Bienes Muebles',
                    'icon' => 'fas fa-couch',
                    'submenu' => [
                        ['text' => 'Mobiliario Escolar', 'url' => '/admin/categorias/Mobiliario%20Escolar', 'icon' => 'fas fa-chair'],
                        ['text' => 'Sillas', 'url' => 'admin/categorias/Sillas', 'icon' => 'fas fa-chair'],
                        ['text' => 'Mesas', 'url' => 'admin/categorias/Mesas', 'icon' => 'fas fa-th-large'],
                        ['text' => 'Escritorios', 'url' => 'admin/categorias/Escritorios', 'icon' => 'fas fa-table'],
                        ['text' => 'Pizarras', 'url' => 'admin/categorias/Pizarras', 'icon' => 'fas fa-chalkboard'],
                        ['text' => 'Estantes', 'url' => 'admin/categorias/Estantes', 'icon' => 'fas fa-archive'],
                        ['text' => 'Pupitres', 'url' => 'admin/categorias/Pupitres', 'icon' => 'fas fa-school'],
                        ['text' => 'Armarios', 'url' => 'admin/categorias/Armarios', 'icon' => 'fas fa-door-closed'],
                    ],
                ],

                // 🔹 Bienes Tecnológicos
                [
                    'text' => 'Bienes Tecnológicos',
                    'icon' => 'fas fa-laptop',
                    'submenu' => [
                        ['text' => 'Computadoras', 'url' => 'admin/categorias/Computadoras', 'icon' => 'fas fa-desktop'],
                        ['text' => 'Laptops', 'url' => 'admin/categorias/Laptops', 'icon' => 'fas fa-laptop'],
                        ['text' => 'Tablets', 'url' => 'admin/categorias/Tablets', 'icon' => 'fas fa-tablet-alt'],
                        ['text' => 'Proyectores', 'url' => 'admin/categorias/Proyectores', 'icon' => 'fas fa-video'],
                        ['text' => 'Televisores', 'url' => 'admin/categorias/Televisores', 'icon' => 'fas fa-tv'],
                        ['text' => 'Pizarras Interactivas', 'url' => '/admin/categorias/Pizarras%20Interactivas', 'icon' => 'fas fa-chalkboard'],
                        ['text' => 'Impresoras', 'url' => 'admin/categorias/Impresoras', 'icon' => 'fas fa-print'],
                        ['text' => 'Switches y Routers', 'url' => '/admin/categorias/Switches%20y%20Routers', 'icon' => 'fas fa-network-wired'],
                        ['text' => 'Servidores', 'url' => 'admin/categorias/Servidores', 'icon' => 'fas fa-server'],
                        ['text' => 'Otros', 'url' => 'admin/categorias/Otros', 'icon' => 'fas fa-ellipsis-h'],
                    ],
                ],

                // 🔹 Bienes Inmuebles
                [
                    'text' => 'Bienes Inmuebles',
                    'icon' => 'fas fa-building',
                    'submenu' => [
                        ['text' => 'Aulas', 'url' => 'admin/categorias/Aulas', 'icon' => 'fas fa-door-open'],
                        ['text' => 'Laboratorios', 'url' => 'admin/categorias/Laboratorios', 'icon' => 'fas fa-flask'],
                        ['text' => 'Biblioteca', 'url' => 'admin/categorias/Biblioteca', 'icon' => 'fas fa-book'],
                        ['text' => 'Áreas Administrativas', 'url' => '/admin/categorias/%C3%81reas%20Administrativas', 'icon' => 'fas fa-users-cog'],
                        ['text' => 'Áreas Pedagógicas', 'url' => 'admin/categorias/Áreas%20Pedagógicas', 'icon' => 'fas fa-book-open'],
                        ['text' => 'Patios', 'url' => 'admin/categorias/Patios', 'icon' => 'fas fa-tree'],
                        ['text' => 'Servicios Higiénicos', 'url' => '/admin/categorias/Servicios%20Higi%C3%A9nicos', 'icon' => 'fas fa-restroom'],
                    ],
                ],

                // 🔹 Terrenos
                [
                    'text' => 'Terrenos',
                    'icon' => 'fas fa-map',
                    'submenu' => [
                        ['text' => 'Terreno Urbano', 'url' => '/admin/categorias/Terreno%20Urbano', 'icon' => 'fas fa-city'],
                        ['text' => 'Terreno Rústico', 'url' => '/admin/categorias/Terreno%20R%C3%BAstico', 'icon' => 'fas fa-tractor'],
                        ['text' => 'Área Verde', 'url' => '/admin/categorias/%C3%81rea%20Verde', 'icon' => 'fas fa-seedling'],
                    ],
                ],
            ],
        ],


        // 🔹 Operaciones
        ['header' => 'OPERACIONES'],

        [
            'can' => 'ingresos.index',
            'text' => 'Ingreso de Bienes',
            'url' => 'admin/ingresos',
            'icon' => 'fas fa-plus-circle',
            'classes' => 'bg-green text-white',
            'active' => ['admin/ingresos*'],
        ],
        [
            'can' => 'bajas.index',
            'text' => 'Bajas',
            'url' => 'admin/bajas',
            'icon' => 'fas fa-trash-alt',
            'classes' => 'bg-red text-white',
            'active' => ['admin/bajas*'],
        ],
        [
            'can' => 'movimientos.index',
            'text' => 'Rotacion de Bienes ',
            'url' => 'admin/movimientos',
            'icon' => 'fas fa-exchange-alt',
            'classes' => 'bg-yellow text-white',
            'active' => ['admin/movimientos*'],
        ],

        // 🔹 Reportes
        ['header' => 'REPORTES'],

        [
            'text' => 'Reportes',
            'icon' => 'fas fa-chart-bar',
            'submenu' => [
                [
                    'can' => 'reportes.bajas',
                    'text' => 'Bienes dados de baja',
                    'url'  => 'admin/reportes/bajas',
                ],
                [
                    'can' => 'reportes.sin_codigo',
                    'text' => 'Bienes sin código patrimonial',
                    'url'  => 'admin/reportes/sin_codigo',
                ],
                [
                    'can' => 'reportes.areas',
                    'text' => 'bienes por area-ubicacion',
                    'url'  => 'admin/reportes/areas',

                ],

            ],
        ],


        // 🔹 Administración
        ['header' => 'ADMINISTRACIÓN'],

        [
            'can' => 'usuarios.index',
            'text' => 'Usuarios',
            'url' => 'admin/usuarios',
            'icon' => 'fas fa-users-cog',
            'classes' => 'bg-purple text-white',
            'active' => ['admin/usuarios*'],
        ],
        [
            'can' => 'roles.index',
            'text' => 'Roles',
            'url' => 'admin/roles',
            'icon' => 'fas fa-user-tag',
            'classes' => 'bg-purple text-white',
            'active' => ['admin/roles*'],
        ],

        [
            'can' => 'directores.index',
            'text' => 'Directores',
            'url' => 'admin/directores',
            'icon' => 'fas fa-user-tie',
            'classes' => 'bg-purple text-white',
            'active' => ['admin/directores*'],
        ],
    ],


    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/buttons/2.4.0/js/dataTables.buttons.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/buttons/2.4.0/js/buttons.bootstrap4.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/buttons/2.4.0/js/buttons.html5.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/buttons/2.4.0/js/buttons.print.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/buttons/2.4.0/js/buttons.colVis.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/buttons/2.4.0/css/buttons.bootstrap4.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => 'https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js',
                ],
            ],
        ],
        'Select2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],


    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
