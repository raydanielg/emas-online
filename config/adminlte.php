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

    'title' => 'eMaS',
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

    'use_ico_only' => true,
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

    'logo' => '<b>e</b>Mas',
    'logo_img' => 'prem.icon.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'eMas Logo',

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
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
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
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
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
    'dashboard_url' => '/',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,
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
        // Navbar items:
        [
            'type' => 'navbar-search',
            'text' => 'search',
            'topnav_right' => true,
        ],
        [
            'type' => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        [
            'type' => 'sidebar-menu-search',
            'text' => 'search',
        ],
        
        [
            'text' => 'Dashboard',
            'url'  => 'dashboard',
            'icon' => 'fas fa-fw fa-tachometer-alt',
            'can'  => 'role:admin',
        ],

        // 🏫 SCHOOLS MANAGEMENT
        [
            'header' => 'SCHOOLS MANAGEMENT',
            'can'    => 'role:admin',
        ],
        [
            'text'    => 'Schools',
            'icon'    => 'fas fa-fw fa-school',
            'can'     => 'role:admin',
            'submenu' => [
                ['text' => 'All Schools', 'url' => 'admin/schools'],
                ['text' => 'Pending Approvals', 'url' => 'admin/schools/pending'],
                ['text' => 'Approved Schools', 'url' => 'admin/schools/approved'],
                ['text' => 'Rejected Schools', 'url' => 'admin/schools/rejected'],
                ['text' => 'Manage Classes', 'url' => 'admin/classes'],
                ['text' => 'School Categories', 'url' => 'admin/schools/categories-list'],
                ['text' => 'School Levels', 'url' => 'admin/schools/levels-list'],
                ['text' => 'Performance Ranking', 'url' => 'admin/schools/rankings'],
            ],
        ],

        // USERS MANAGEMENT
        [
            'header' => 'USERS MANAGEMENT',
            'can'    => 'role:admin',
        ],
        [
            'text'    => 'Users Control',
            'icon'    => 'fas fa-fw fa-users-cog',
            'can'     => 'role:admin',
            'submenu' => [
                ['text' => 'All Users', 'url' => 'admin/users'],
                ['text' => 'School Users', 'url' => 'admin/users/school'],
                ['text' => 'Active Users', 'url' => 'admin/users/active'],
                ['text' => 'Suspended Users', 'url' => 'admin/users/suspended'],
                ['text' => 'Login History', 'url' => 'admin/users/logs'],
            ],
        ],

        // 📊 RESULTS MANAGEMENT
        [
            'header' => 'RESULTS MANAGEMENT',
            'can'    => 'role:admin',
        ],
        [
            'text'    => 'Exam Results',
            'icon'    => 'fas fa-fw fa-poll',
            'can'     => 'role:admin',
            'submenu' => [
                ['text' => 'All Results', 'url' => 'admin/results'],
                ['text' => 'Results by School', 'url' => 'admin/results/school'],
                ['text' => 'Results by Region', 'url' => 'admin/results/region'],
                ['text' => 'Approval Requests', 'url' => 'admin/results/approvals'],
            ],
        ],

        // 🎓 STUDENTS MANAGEMENT
        [
            'header' => 'STUDENTS MANAGEMENT',
            'can'    => 'role:admin',
        ],
        [
            'text'    => 'Students List',
            'icon'    => 'fas fa-fw fa-user-graduate',
            'can'     => 'role:admin',
            'submenu' => [
                ['text' => 'All Students', 'url' => 'admin/students'],
                ['text' => 'Promote Students', 'url' => 'admin/students/promote'],
                ['text' => 'Import (Excel)', 'url' => 'admin/students/import'],
            ],
        ],

        // 📚 SUBJECTS MANAGEMENT
        [
            'header' => 'SUBJECTS MANAGEMENT',
            'can'    => 'role:admin',
        ],
        [
            'text'    => 'Subjects',
            'icon'    => 'fas fa-fw fa-book',
            'can'     => 'role:admin',
            'submenu' => [
                ['text' => 'All Subjects', 'url' => 'admin/subjects'],
                ['text' => 'Subject Categories', 'url' => 'admin/subjects/categories'],
            ],
        ],

        // 📈 ANALYTICS & REPORTS
        [
            'header' => 'ANALYTICS & REPORTS',
            'can'    => 'role:admin',
        ],
        [
            'text'    => 'Reports',
            'icon'    => 'fas fa-fw fa-chart-line',
            'can'     => 'role:admin',
            'submenu' => [
                ['text' => 'National Overview', 'url' => 'admin/reports/national'],
                ['text' => 'Regional Performance', 'url' => 'admin/reports/regional'],
                ['text' => 'Top 10 Rankings', 'url' => 'admin/reports/rankings'],
            ],
        ],

        // 💰 PAYMENTS & SUBSCRIPTIONS
        [
            'header' => 'PAYMENTS & BILLING',
            'can'    => 'role:admin',
        ],
        [
            'text'    => 'Finances',
            'icon'    => 'fas fa-fw fa-money-bill-wave',
            'can'     => 'role:admin',
            'submenu' => [
                ['text' => 'All Payments', 'url' => 'admin/payments'],
                ['text' => 'Subscriptions', 'url' => 'admin/payments/subscriptions'],
                ['text' => 'Manual Approvals', 'url' => 'admin/payments/approvals'],
            ],
        ],

        // 📩 COMMUNICATION
        [
            'header' => 'COMMUNICATION',
            'can'    => 'role:admin',
        ],
        [
            'text'    => 'Messaging',
            'icon'    => 'fas fa-fw fa-envelope',
            'can'     => 'role:admin',
            'submenu' => [
                ['text' => 'Send SMS', 'url' => 'admin/communication/sms'],
                ['text' => 'Send Email', 'url' => 'admin/communication/email'],
                ['text' => 'Announcements', 'url' => 'admin/communication/announcements'],
            ],
        ],

        // ⚙️ SYSTEM SETTINGS
        [
            'header' => 'SYSTEM SETTINGS',
            'can'    => 'role:admin',
        ],
        [
            'text'    => 'Settings',
            'icon'    => 'fas fa-fw fa-tools',
            'can'     => 'role:admin',
            'submenu' => [
                ['text' => 'General Settings', 'url' => 'admin/settings/general'],
                ['text' => 'SMTP & SMS Gateway', 'url' => 'admin/settings/gateways'],
                ['text' => 'Backup & Restore', 'url' => 'admin/settings/backup'],
            ],
        ],

        // 🔐 SECURITY & LOGS
        [
            'header' => 'SECURITY & ACCESS',
            'can'    => 'role:admin',
        ],
        [
            'text'    => 'Access Control',
            'icon'    => 'fas fa-fw fa-shield-alt',
            'can'     => 'role:admin',
            'submenu' => [
                ['text' => 'Manage Roles', 'url' => 'admin/roles'],
                ['text' => 'Manage Permissions', 'url' => 'admin/permissions'],
                ['text' => 'Activity Logs', 'url' => 'admin/logs'],
            ],
        ],

        // � BLOG & NEWS
        [
            'header' => 'BLOG & NEWS',
            'can'    => 'role:admin',
        ],
        [
            'text'    => 'News & Updates',
            'icon'    => 'fas fa-fw fa-newspaper',
            'can'     => 'role:admin',
            'submenu' => [
                ['text' => 'All Posts', 'url' => 'admin/news'],
                ['text' => 'Add New Post', 'url' => 'admin/news/create'],
            ],
        ],

        // � DATA MANAGEMENT
        [
            'header' => 'MAINTENANCE',
            'can'    => 'role:admin',
        ],
        [
            'text' => 'System Data',
            'url'  => 'admin/data',
            'icon' => 'fas fa-fw fa-database',
            'can'  => 'role:admin',
        ],

        // USER ONLY SECTION
        [
            'header' => 'USER PANEL',
            'can'    => 'role:user',
        ],

        [
            'text' => 'Dashboard',
            'icon' => 'fas fa-fw fa-tachometer-alt',
            'can'  => 'role:user',
            'submenu' => [
                ['text' => 'School Overview', 'url' => 'user/dashboard'],
                ['text' => 'Total Students', 'url' => 'user/students'],
                ['text' => 'Total Teachers', 'url' => 'user/teachers'],
                ['text' => 'Total Subjects', 'url' => 'user/subjects'],
                ['text' => 'Latest Uploaded Results', 'url' => 'user/results/latest'],
                ['text' => 'Pending Result Drafts', 'url' => 'user/results/drafts'],
                ['text' => 'Academic Calendar', 'url' => 'user/academic/settings'],
                ['text' => 'Recent Activities', 'url' => 'user/activities'],
            ],
        ],


        [
            'text'    => 'Subjects Management',
            'icon'    => 'fas fa-fw fa-book',
            'can'     => 'role:user',
            'submenu' => [
                ['text' => 'All Subjects', 'url' => 'user/subjects'],
                ['text' => 'Import Subjects', 'url' => 'user/subjects/import'],
                ['text' => 'Assign Subjects to Class', 'url' => 'user/subjects/assign'],
                ['text' => 'Subject Teachers', 'url' => 'user/subjects/teachers'],
                ['text' => 'Subject Combination', 'url' => '#', 'classes' => 'disabled'],
            ],
        ],

        [
            'text'    => 'Students Management',
            'icon'    => 'fas fa-fw fa-user-graduate',
            'can'     => 'role:user',
            'submenu' => [
                ['text' => 'Manage Students', 'url' => 'user/students/manage'],
                ['text' => 'Add New Student', 'url' => 'user/students/create'],
                ['text' => 'Promote Students', 'url' => 'user/students/promote'],
                ['text' => 'Import Students', 'url' => 'user/students/import'],
            ],
        ],

        [
            'text'    => 'Marks Entry',
            'icon'    => 'fas fa-fw fa-edit',
            'can'     => 'role:user',
            'submenu' => [
                ['text' => 'Select Academic Year', 'url' => 'user/academic/settings'],
                ['text' => 'Select Term', 'url' => 'user/academic/settings'],
                ['text' => 'Select Class', 'url' => 'user/classes'],
                ['text' => 'Enter Marks per Subject', 'url' => 'user/marks/entry'],
                ['text' => 'Bulk Upload Marks (Excel)', 'url' => 'user/marks/import'],
                ['text' => 'Edit Entered Marks', 'url' => '#', 'classes' => 'disabled'],
                ['text' => 'Lock Marks', 'url' => '#', 'classes' => 'disabled'],
                ['text' => 'Submit for Approval', 'url' => '#', 'classes' => 'disabled'],
            ],
        ],

        [
            'text'    => 'Results Management',
            'icon'    => 'fas fa-fw fa-poll',
            'can'     => 'role:user',
            'submenu' => [
                ['text' => 'Generate Results', 'url' => '#', 'classes' => 'disabled'],
                ['text' => 'Preview Results', 'url' => '#', 'classes' => 'disabled'],
                ['text' => 'Publish Results', 'url' => '#', 'classes' => 'disabled'],
                ['text' => 'Unpublish Results', 'url' => '#', 'classes' => 'disabled'],
                ['text' => 'Class Position Ranking', 'url' => 'user/marks/rankings'],
                ['text' => 'Subject Performance Analysis', 'url' => '#', 'classes' => 'disabled'],
                ['text' => 'Grade Distribution', 'url' => '#', 'classes' => 'disabled'],
            ],
        ],

        [
            'text'    => 'Report Cards',
            'icon'    => 'fas fa-fw fa-print',
            'can'     => 'role:user',
            'submenu' => [
                ['text' => 'Generate Report Cards', 'url' => 'user/reports/cards'],
                ['text' => 'Print Single Student Report', 'url' => '#', 'classes' => 'disabled'],
                ['text' => 'Print Class Report', 'url' => 'user/reports/class'],
                ['text' => 'Print Broadsheet', 'url' => '#', 'classes' => 'disabled'],
                ['text' => 'Download PDF', 'url' => '#', 'classes' => 'disabled'],
                ['text' => 'Customize Report Template', 'url' => '#', 'classes' => 'disabled'],
            ],
        ],

        [
            'text'    => 'School Analytics',
            'icon'    => 'fas fa-fw fa-chart-line',
            'can'     => 'role:user',
            'submenu' => [
                ['text' => 'Class Performance', 'url' => '#', 'classes' => 'disabled'],
                ['text' => 'Subject Performance', 'url' => '#', 'classes' => 'disabled'],
                ['text' => 'Top 10 Students', 'url' => '#', 'classes' => 'disabled'],
                ['text' => 'Weak Students List', 'url' => '#', 'classes' => 'disabled'],
                ['text' => 'Pass/Fail Summary', 'url' => '#', 'classes' => 'disabled'],
                ['text' => 'Performance Comparison', 'url' => '#', 'classes' => 'disabled'],
            ],
        ],

        [
            'text'    => 'Academic Management',
            'icon'    => 'fas fa-fw fa-calendar-alt',
            'can'     => 'role:user',
            'submenu' => [
                ['text' => 'Academic Years', 'url' => 'user/academic/settings'],
                ['text' => 'Terms', 'url' => 'user/academic/settings'],
                ['text' => 'Classes', 'url' => 'user/classes'],
                ['text' => 'Streams', 'url' => '#', 'classes' => 'disabled'],
                ['text' => 'Grading System', 'url' => 'user/grades'],
            ],
        ],

        [
            'text'    => 'Teachers Management',
            'icon'    => 'fas fa-fw fa-chalkboard-teacher',
            'can'     => 'role:user',
            'submenu' => [
                ['text' => 'All Teachers', 'url' => 'user/subjects/teachers'],
                ['text' => 'Assign Subject to Teacher', 'url' => 'user/teachers/assign-subjects'],
                ['text' => 'Teacher Assign Class', 'url' => 'user/teachers/assign-classes'],
                ['text' => 'Teacher Performance', 'url' => 'user/teachers/performance'],
            ],
        ],

        [
            'text'    => 'Subscription & Payments',
            'icon'    => 'fas fa-fw fa-money-bill-wave',
            'can'     => 'role:user',
            'submenu' => [
                ['text' => 'My Subscription Status', 'url' => '#', 'classes' => 'disabled'],
                ['text' => 'Payment History', 'url' => '#', 'classes' => 'disabled'],
                ['text' => 'Renew Subscription', 'url' => '#', 'classes' => 'disabled'],
                ['text' => 'Download Invoice', 'url' => '#', 'classes' => 'disabled'],
            ],
        ],

        [
            'text'    => 'Communication',
            'icon'    => 'fas fa-fw fa-envelope',
            'can'     => 'role:user',
            'submenu' => [
                ['text' => 'Send SMS to Parents', 'url' => '#', 'classes' => 'disabled'],
                ['text' => 'Send Results via Email', 'url' => '#', 'classes' => 'disabled'],
                ['text' => 'Announcements', 'url' => '#', 'classes' => 'disabled'],
                ['text' => 'Internal Messages', 'url' => '#', 'classes' => 'disabled'],
            ],
        ],

        [
            'text'    => 'School Settings',
            'icon'    => 'fas fa-fw fa-tools',
            'can'     => 'role:user',
            'submenu' => [
                ['text' => 'School Profile', 'url' => 'user/academic/school-info'],
                ['text' => 'Upload Logo', 'url' => 'user/academic/school-info/edit'],
                ['text' => 'Headmaster Signature', 'url' => '#', 'classes' => 'disabled'],
                ['text' => 'Stamp Upload', 'url' => '#', 'classes' => 'disabled'],
                ['text' => 'Grading System Setup', 'url' => 'user/grades'],
                ['text' => 'Change Password', 'url' => 'profile', 'classes' => 'disabled'],
            ],
        ],

        [
            'text'    => 'Account & Activity',
            'icon'    => 'fas fa-fw fa-shield-alt',
            'can'     => 'role:user',
            'submenu' => [
                ['text' => 'Login History', 'url' => '#', 'classes' => 'disabled'],
                ['text' => 'Activity Logs', 'url' => '#', 'classes' => 'disabled'],
                ['text' => 'Two Factor Authentication', 'url' => '#', 'classes' => 'disabled'],
            ],
        ],

        // SHARED SECTION
        ['header' => 'ACCOUNT SETTINGS'],
        [
            'text' => 'Profile',
            'url'  => 'admin/profile',
            'icon' => 'fas fa-fw fa-user',
            'can'  => 'role:admin',
        ],
        [
            'text' => 'Profile',
            'url'  => 'profile',
            'icon' => 'fas fa-fw fa-user',
            'can'  => 'role:user',
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
            'active' => false,
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
            ],
        ],
        'Select2' => [
            'active' => false,
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
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
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
