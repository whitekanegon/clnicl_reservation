<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#61-title
    |
    */

    'title' => 'カンタン予約フォーム',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#62-favicon
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#63-logo
    |
    */

    'logo' => '',
    'logo_img' => 'vendor/adminlte/dist/img/logo.png',
    'logo_img_class' => '',
    'logo_img_xl' => false,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => '',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#64-user-menu
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#65-layout
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => true,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,

    /*
    |--------------------------------------------------------------------------
    | Extra Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#66-classes
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_header' => 'container-fluid',
    'classes_content' => 'container-fluid',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand-md',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#67-sidebar
    |
    */

    'sidebar_mini' => true,
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
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#68-control-sidebar-right-sidebar
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
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#69-urls
    |
    */

    'use_route_url' => false,

    'dashboard_url' => 'admin',

    'logout_url' => 'admin/logout',

    'login_url' => 'admin/login',

    'register_url' => 'admin/register',

    'password_reset_url' => 'admin/password/reset',

    'password_email_url' => 'admin/password/email',

    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#610-laravel-mix
    |
    */

    'enabled_laravel_mix' => false,

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#611-menu
    |
    */

    'menu' => [
        [
         'text' => 'ダッシュボード',
         'icon' => 'fas fa-tachometer-alt',
                  'url' => 'admin'
        ],
        [
         'text' => '診療カレンダー',
         'icon' => 'fa fa-calendar',
                  'url' => 'admin/reserve_calendar',
         'active' => ['admin/reserve_calendar*'],
        ],
        [
         'text' => '診療項目',
         'icon' => 'fa fa-file-alt',
         'submenu' => [
          [
           'text' => '一覧・編集',
           'url' => 'admin/clinical_item',
           'active' => ['admin/clinical_item','admin/clinical_item?*','admin/clinical_item/add_holiday*','admin/clinical_item/edit_holiday*','admin/clinical_item/add_week*','admin/clinical_item/edit_week*'],
          ],
          [
           'text' => '新規作成',
           'url' => 'admin/clinical_item/add',
          ],
         ],
        ],
        [
         'text' => '予約ステータス',
         'icon' => 'fa fa-tags',
         'submenu' => [
          [
           'text' => '一覧・編集',
           'url' => 'admin/reserve_status',
           'active' => ['admin/reserve_status','admin/reserve_status?*'],
          ],
          [
           'text' => '新規作成',
           'url' => 'admin/reserve_status/add',
          ],
         ],
        ],
        [
         'text' => '予約時間帯',
         'icon' => 'fa fa-clock',
         'submenu' => [
          [
           'text' => '一覧・編集',
           'url' => 'admin/reserve_time',
           'active' => ['admin/reserve_time','admin/reserve_time?*'],
          ],
          [
           'text' => '新規作成',
           'url' => 'admin/reserve_time/add',
          ],
          [
           'text' => 'セット一覧',
           'url' => 'admin/reserve_times_set',
           'active' => ['admin/reserve_times_set','admin/reserve_times_set?*','admin/reserve_times_set/edit*'],
          ],
          [
           'text' => 'セット新規作成',
           'url' => 'admin/reserve_times_set/add',
          ],
         ],
        ],
        [
         'text' => '受診者入力項目',
         'icon' => 'fa fa-user',
         'submenu' => [
          [
           'text' => '一覧・編集',
           'url' => 'admin/input_item',
           'active' => ['admin/input_item','admin/input_item?*','admin/input_item/edit*'],
          ],
          [
           'text' => '新規作成',
           'url' => 'admin/input_item/add',
           'active' => ['admin/input_item/add*'],
          ],
         ],
        ],
        [
         'text' => 'メール設定',
         'icon' => 'fa fa-envelope',
         'url' => 'admin/mail_setting',
         'active' => ['admin/mail_setting*'],
        ],
       ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#612-menu-filters
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
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
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#613-plugins
    |
    */
    'plugins' => [
        [
         'name' => 'JqueryUI',
         'active' => true,
         'files' => [
          [
           'type' => 'css',
           'asset' => true,
           'location' => 'vendor/jquery/css/jquery-ui.css',
          ],
          [
           'type' => 'js',
           'asset' => true,
           'location' => 'vendor/jquery/jquery-ui.min.js',
          ],
         ],
        ],
        [
         'name' => 'Toastr',
         'active' => true,
         'files' => [
          [
           'type' => 'css',
           'asset' => true,
           'location' => 'vendor/toastr/css/toastr.min.css',
          ],
          [
           'type' => 'js',
           'asset' => true,
           'location' => 'vendor/toastr/js/toastr.min.js',
          ],
         ],
        ],
       ],

];
