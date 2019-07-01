<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'Virgen de Itatí',

    'title_prefix' => '',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => '<b>Virgen</b>Itatí',

    'logo_mini' => '<b>V</b>I',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and c. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'blue',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'home',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => null,

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    
    'menu' => [

        'MENU PRINCIPAL',
        [
            'text' => 'Productos', // se cambia la descripcion a Productos para que se entiende mejor para los usuarios(se mantiene la url y el valor en articulo)
            'url'  => 'articulos',
            'icon' => 'archive',
        ],

       [
            'text' => 'Clientes',
            'url'  => 'clientes',
            'icon' => 'users',
        ],
        [
            'text' => 'Empleados',
            'url'  => 'empleados',
            'icon' => 'user',
        ],
        [
            'text' => 'Modelo_Contratos',
            'url'  => 'modelocontratos',
            'icon' => 'file',
        ],
        [
            'text'    => 'Stock',
            'icon'    => 'list-alt',
            'submenu' => [
                /*[
                    'text' => 'Usuarios',
                    'url'  => 'manageusers',
                ],*/
                 [
                    'text' => 'Stock y Ajustes',
                    'url'  => 'stocks',
                ],
                [
                    'text' => 'Asignar Stock',
                    'url'  => 'stockasignaciones',
                ]
            ]
        ],  
        [
            'text' => 'Hoja_Ruta',
            'url'  => 'hojarutas',
            'icon' => 'list-alt',
        ],     
        [
            'text'    => 'Complementos',
            'icon'    => 'cog',
            'submenu' => [
                    [
                    'text'    => 'Dirección',
                    'url'     => '#',
                       'submenu' => [
                            [
                                'text' => 'Provincias',
                                'url'  => 'provincias',
                            ],
                             [
                                'text' => 'Departamentos',
                                'url'  => 'departamentos',
                            ],
                            [
                                'text' => 'Localidades',
                                'url'  => 'localidades',
                            ],
                            [
                                'text' => 'Zonas',
                                'url'  => 'distritos',
                            ],
                            [
                                'text' => 'Barrios',
                                'url'  => 'barrios',
                            ],
                            [
                                'text' => 'Calles',
                                'url'  => 'calles',
                            ],
                        ],
                    ],
                    [
                    'text'    => 'Datos Personales',
                    'url'     => '#',
                       'submenu' => [
                             
                            [
                                'text' => 'Tipo Iva',
                                'url'  => 'tipoivas',
                            ],
                             
                            [
                                'text' => 'Vinculos',
                                'url'  => 'tipofamiliares',
                            ],
                            [
                                'text' => 'Proveedor Telefonico',
                                'url'  => 'companiatelefonicas',
                            ],
                            [
                                'text' => 'Tipo Empleado',
                                'url'  => 'tipoempleados',
                            ],
                            [
                                'text' => 'Sucursal',
                                'url'  => 'sucursales',
                            ]
                        ],
                    ],
               
                /*[
                    'text' => 'Tipo Empleado',
                    'url'  => 'tipoempleados',
                ]*/
            ]
        ],
        [
            'text'    => 'Seguridad',
            'icon'    => 'key',
            'submenu' => [
                /*[
                    'text' => 'Usuarios',
                    'url'  => 'manageusers',
                ],*/
                 [
                    'text' => 'Modulos',
                    'url'  => 'modulos',
                ],
                [
                    'text' => 'Perfiles',
                    'url'  => 'perfiles',
                ]
            ]
        ],  
        /*[
            'text' => 'Informes',
            'url'  => 'informes',
            'icon' => 'file-pdf-o',
        ],*/
        
        
    ],


    /*
    'menu' => [
        'Menu',
        [
            'text' => 'Menu',
            'url'  => 'admin/blog',
            'can'  => 'manage-blog',
        ],
        [
            'text'        => 'Empresa',
            'url'         => 'admin/pages',
            'icon'        => 'file',
            'label'       => 4,
            'label_color' => 'success',
        ],
        'ACCOUNT SETTINGS',
        [
            'text' => 'Profile',
            'url'  => 'admin/settings',
            'icon' => 'user',
        ],
        [
            'text' => 'Change Password',
            'url'  => 'admin/settings',
            'icon' => 'lock',
        ],
        [
            'text'    => 'Multilevel',
            'icon'    => 'share',
            'submenu' => [
                [
                    'text' => 'Level One',
                    'url'  => '#',
                ],
                [
                    'text'    => 'Level One',
                    'url'     => '#',
                       'submenu' => [
                        [
                            'text' => 'Level Two',
                            'url'  => '#',
                        ],
                        [
                            'text'    => 'Level Two',
                            'url'     => '#',
                            'submenu' => [
                                [
                                    'text' => 'Level Three',
                                    'url'  => '#',
                                ],
                                [
                                    'text' => 'Level Three',
                                    'url'  => '#',
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'text' => 'Level One',
                    'url'  => '#',
                ],
            ],
        ],
        'LABELS',
        [
            'text'       => 'Important',
            'icon_color' => 'red',
        ],
        [
            'text'       => 'Warning',
            'icon_color' => 'yellow',
        ],
        [
            'text'       => 'Information',
            'icon_color' => 'aqua',
        ],
    ],*/

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        //App\Providers\FilterServiceProvider::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => false,
        'select2'    => true,
        'chartjs'    => false,
    ],
];
