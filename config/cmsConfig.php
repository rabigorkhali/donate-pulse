<?php

$getMethod = 'get';
$postMethod = 'post';
$putMethod = 'put';
$deleteMethod = 'delete';

$homeBaseUrl = '/home';
$userBaseUrl = '/users';
$roleBaseUrl = '/roles';
$configBaseUrl = '/configs';
$pageBaseUrl = '/pages';
$postCategoryUrl = '/post-categories';
$postUrl = '/posts';
$sliderUrl = '/sliders';
$contactUsUrl = '/contact-us';
$testimonialUrl = '/testimonials';
$partnerUrl = '/partners';
$campaignCategoryUrl = '/campaign-categories';
$campaignUrl = '/campaigns';
$paymentGatewayUrl = '/payment-gateways';
$donationUrl = '/donations';
$withdrawalUrl = '/withdrawals';

return [
    // routes entered in this array are accessible by any user no matter what role is given
    'permissionGrantedbyDefaultRoutes' => [
        [
            'url' => $homeBaseUrl,
            'method' => $getMethod,
        ],
        [
            'url' => '/logout',
            'method' => $getMethod,
        ],
        [
            'url' => '/dashboard',
            'method' => $getMethod,
        ],
        [
            'url' => '/profile',
            'method' => $getMethod,
        ],
        [
            'url' => '/profile/*',
            'method' => $putMethod,
        ],
        [
            'url' => '/change-password',
            'method' => $getMethod,
        ],
        [
            'url' => '/change-password',
            'method' => $putMethod,
        ],
        [
            'url' => '/login',
            'method' => $getMethod,
        ],

    ],

    // All the routes are accessible by super user by default
    // routes entered in this array are not accessible by super user
    'permissionDeniedToSuperUserRoutes' => [],

    'modules' => [
        [
            'name' => 'Dashboard',
            'icon' => "<i class='fa fa-home'></i>",
            'hasSubmodules' => false,
            'route' => $homeBaseUrl,
            'routeIndexName' => 'home.index',
            'routeName' => 'home',
            'permissions' => [
                [
                    'name' => 'View Dashboard',
                    'route' => [
                        'url' => $homeBaseUrl,
                        'method' => $getMethod,
                    ],
                ]
            ],
        ],
        [
            'name' => 'Campaign',
            'icon' => "<i class='fa fa-file-clipboard' aria-hidden='true'></i>",
            'hasSubmodules' => true,
            'routeIndexNameMultipleSubMenu' => ['campaign-categories.index','campaigns.index'],
            'submodules' => [
                [
                    'name' => 'Category',
                    'icon' => '<i class="fa fa-cog" aria-hidden="true"></i>',
                    'route' => $campaignCategoryUrl,
                    'routeIndexName' => 'campaign-categories.index',
                    'routeName' => 'campaign-categories',
                    'hasSubmodules' => false,
                    'permissions' => [
                        [
                            'name' => 'View Category',
                            'route' => [
                                'url' => $campaignCategoryUrl,
                                'method' => $getMethod,
                            ],
                        ],
                        [
                            'name' => 'Create Category',
                            'route' => [
                                [
                                    'url' => $campaignCategoryUrl . '/create',
                                    'method' => $getMethod,
                                ],
                                [
                                    'url' => $campaignCategoryUrl,
                                    'method' => $postMethod,
                                ],
                            ],
                        ],
                        [
                            'name' => 'Edit Category',
                            'route' => [
                                [
                                    'url' => $campaignCategoryUrl . '/*/edit',
                                    'method' => $getMethod,
                                ],
                                [
                                    'url' => $campaignCategoryUrl . '/*',
                                    'method' => $putMethod,
                                ],
                            ],
                        ],
                        [
                            'name' => 'Delete Category',
                            'route' => [
                                'url' => $campaignCategoryUrl . '/*',
                                'method' => $deleteMethod,
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'Campaign',
                    'icon' => '<i class="fa fa-cog" aria-hidden="true"></i>',
                    'route' => $campaignUrl,
                    'routeIndexName' => 'campaigns.index',
                    'routeName' => 'campaigns',
                    'hasSubmodules' => false,
                    'permissions' => [
                        [
                            'name' => 'View Campaign',
                            'route' => [
                                'url' => $campaignUrl,
                                'method' => $getMethod,
                            ],
                        ],
                        [
                            'name' => 'Create Campaign',
                            'route' => [
                                [
                                    'url' => $campaignUrl . '/create',
                                    'method' => $getMethod,
                                ],
                                [
                                    'url' => $campaignUrl,
                                    'method' => $postMethod,
                                ],
                            ],
                        ],
                        [
                            'name' => 'Edit Campaign',
                            'route' => [
                                [
                                    'url' => $campaignUrl . '/*/edit',
                                    'method' => $getMethod,
                                ],
                                [
                                    'url' => $campaignUrl . '/*',
                                    'method' => $putMethod,
                                ],
                            ],
                        ],
                        [
                            'name' => 'Delete Campaign',
                            'route' => [
                                'url' => $campaignUrl . '/*',
                                'method' => $deleteMethod,
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'name' => 'Donations',
            'icon' => "<i class='fa fa-donate'></i>",
            'hasSubmodules' => false,
            'route' => $donationUrl,
            'routeIndexName' => 'donations.index',
            'routeName' => 'donations',
            'permissions' => [
                [
                    'name' => 'View Donation',
                    'route' => [
                        'url' => $donationUrl,
                        'method' => $getMethod,
                    ],
                ],

            ],

        ],
        [
            'name' => 'Withdrawals',
            'icon' => "<i class='fa fa-piggy-bank'></i>",
            'hasSubmodules' => false,
            'route' => $withdrawalUrl,
            'routeIndexName' => 'withdrawals.index',
            'routeName' => 'withdrawals',
            'permissions' => [
                [
                    'name' => 'View Withdrawal',
                    'route' => [
                        'url' => $withdrawalUrl,
                        'method' => $getMethod,
                    ],
                ],
                [
                    'name' => 'Create Withdrawal',
                    'route' => [
                        [
                            'url' => $withdrawalUrl . '/create',
                            'method' => $getMethod,
                        ],
                        [
                            'url' => $withdrawalUrl,
                            'method' => $postMethod,
                        ],
                    ],
                ],
                [
                    'name' => 'Edit Withdrawal',
                    'route' => [
                        [
                            'url' => $withdrawalUrl . '/*/edit',
                            'method' => $getMethod,
                        ],
                        [
                            'url' => $withdrawalUrl . '/*',
                            'method' => $putMethod,
                        ],
                    ],
                ],
                [
                    'name' => 'Delete Withdrawal',
                    'route' => [
                        'url' => $withdrawalUrl . '/*',
                        'method' => $deleteMethod,
                    ],
                ]

            ],

        ],

        [
            'name' => 'User Management',
            'icon' => "<i class='fa fa-user'></i>",
            'hasSubmodules' => true,
            'routeIndexNameMultipleSubMenu' => ['users.index', 'roles.index'], //use for opening sidenav menu only
            'submodules' => [
                [
                    'name' => 'Users',
                    'icon' => "<i class='fa fa-users'></i>",
                    'hasSubmodules' => false,
                    'route' => $userBaseUrl,
                    'routeIndexName' => 'users.index',
                    'routeName' => 'users',
                    'permissions' => [
                        [
                            'name' => 'View Users',
                            'route' => [
                                'url' => $userBaseUrl,
                                'method' => $getMethod,
                            ],
                        ],
                        [
                            'name' => 'Create Users',
                            'route' => [
                                [
                                    'url' => $userBaseUrl . '/create',
                                    'method' => $getMethod,
                                ],
                                [
                                    'url' => $userBaseUrl,
                                    'method' => $postMethod,
                                ],
                            ],
                        ],
                        [
                            'name' => 'Edit Users',
                            'route' => [
                                [
                                    'url' => $userBaseUrl . '/*/edit',
                                    'method' => $getMethod,
                                ],
                                [
                                    'url' => $userBaseUrl . '/*',
                                    'method' => $putMethod,
                                ],
                            ],
                        ],
                        [
                            'name' => 'Delete Users',
                            'route' => [
                                'url' => $userBaseUrl . '/*',
                                'method' => $deleteMethod,
                            ],
                        ]
                    ],
                ],
                [
                    'name' => 'Roles',
                    'icon' => "<i class='fa fa-tags'></i>",
                    'hasSubmodules' => false,
                    'route' => $roleBaseUrl,
                    'routeIndexName' => 'roles.index',
                    'routeName' => 'roles',
                    'permissions' => [
                        [
                            'name' => 'View Roles',
                            'route' => [
                                'url' => $roleBaseUrl,
                                'method' => $getMethod,
                            ],
                        ],
                        [
                            'name' => 'Create Roles',
                            'route' => [
                                [
                                    'url' => $roleBaseUrl . '/create',
                                    'method' => $getMethod,
                                ],
                                [
                                    'url' => $roleBaseUrl,
                                    'method' => $postMethod,
                                ],
                            ],
                        ],
                        [
                            'name' => 'Edit Roles',
                            'route' => [
                                [
                                    'url' => $roleBaseUrl . '/*/edit',
                                    'method' => $getMethod,
                                ],
                                [
                                    'url' => $roleBaseUrl . '/*',
                                    'method' => $putMethod,
                                ],
                            ],
                        ],
                        [
                            'name' => 'Delete Roles',
                            'route' => [
                                'url' => $roleBaseUrl . '/*',
                                'method' => $deleteMethod,
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'name' => 'Settings',
            'icon' => "<i class='fa fa-cogs' aria-hidden='true'></i>",
            'hasSubmodules' => true,
            'routeIndexNameMultipleSubMenu' => ['configs.index'],
            'submodules' => [
                [
                    'name' => 'Configs',
                    'icon' => '<i class="fa fa-cog" aria-hidden="true"></i>',
                    'route' => $configBaseUrl,
                    'routeIndexName' => 'configs.index',
                    'routeName' => 'configs',
                    'hasSubmodules' => false,
                    'permissions' => [
                        [
                            'name' => 'View Configs',
                            'route' => [
                                'url' => $configBaseUrl,
                                'method' => $getMethod,
                            ],
                        ],
                        [
                            'name' => 'Create Config',
                            'route' => [
                                'url' => $configBaseUrl,
                                'method' => $postMethod,
                            ],
                        ],
                        [
                            'name' => 'Edit Config',
                            'route' => [
                                'url' => $configBaseUrl . '/*',
                                'method' => $putMethod,
                            ],
                        ],
                        [
                            'name' => 'Delete Config',
                            'route' => [
                                'url' => $configBaseUrl . '/*',
                                'method' => $deleteMethod,
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'name' => 'Post',
            'icon' => "<i class='fa fa-file-clipboard' aria-hidden='true'></i>",
            'hasSubmodules' => true,
            'routeIndexNameMultipleSubMenu' => ['post-categories.index', 'posts.index'],
            'submodules' => [
                [
                    'name' => 'Category',
                    'icon' => '<i class="fa fa-cog" aria-hidden="true"></i>',
                    'route' => $postCategoryUrl,
                    'routeIndexName' => 'post-categories.index',
                    'routeName' => 'post-categories',
                    'hasSubmodules' => false,
                    'permissions' => [
                        [
                            'name' => 'View Category',
                            'route' => [
                                'url' => $postCategoryUrl,
                                'method' => $getMethod,
                            ],
                        ],
                        [
                            'name' => 'Create Category',
                            'route' => [
                                'url' => $postCategoryUrl,
                                'method' => $postMethod,
                            ],
                        ],
                        [
                            'name' => 'Edit Category',
                            'route' => [
                                'url' => $postCategoryUrl . '/*',
                                'method' => $putMethod,
                            ],
                        ],
                        [
                            'name' => 'Delete Category',
                            'route' => [
                                'url' => $postCategoryUrl . '/*',
                                'method' => $deleteMethod,
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'Post',
                    'icon' => '<i class="fa fa-cog" aria-hidden="true"></i>',
                    'route' => $configBaseUrl,
                    'routeIndexName' => 'posts.index',
                    'routeName' => 'posts',
                    'hasSubmodules' => false,
                    'permissions' => [
                        [
                            'name' => 'View Post',
                            'route' => [
                                'url' => $postUrl,
                                'method' => $getMethod,
                            ],
                        ],
                        [
                            'name' => 'Create Post',
                            'route' => [
                                'url' => $postUrl,
                                'method' => $postMethod,
                            ],
                        ],
                        [
                            'name' => 'Edit Post',
                            'route' => [
                                'url' => $postUrl . '/*',
                                'method' => $putMethod,
                            ],
                        ],
                        [
                            'name' => 'Delete Post',
                            'route' => [
                                'url' => $postUrl . '/*',
                                'method' => $deleteMethod,
                            ],
                        ],
                    ],
                ],

            ],
        ],
        [
            'name' => 'Pages',
            'icon' => "<i class='fa fa-file'></i>",
            'hasSubmodules' => false,
            'route' => $pageBaseUrl,
            'routeIndexName' => 'pages.index',
            'routeName' => 'pages',
            'permissions' => [
                [
                    'name' => 'View Page',
                    'route' => [
                        'url' => $pageBaseUrl,
                        'method' => $getMethod,
                    ],
                ],
                [
                    'name' => 'Create Page',
                    'route' => [
                        [
                            'url' => $pageBaseUrl . '/create',
                            'method' => $getMethod,
                        ],
                        [
                            'url' => $pageBaseUrl,
                            'method' => $postMethod,
                        ],
                    ],
                ],
                [
                    'name' => 'Edit Page',
                    'route' => [
                        [
                            'url' => $pageBaseUrl . '/*/edit',
                            'method' => $getMethod,
                        ],
                        [
                            'url' => $pageBaseUrl . '/*',
                            'method' => $putMethod,
                        ],
                    ],
                ],
                [
                    'name' => 'Delete Page',
                    'route' => [
                        'url' => $pageBaseUrl . '/*',
                        'method' => $deleteMethod,
                    ],
                ]
            ],

        ],
        [
            'name' => 'Payment Gateway',
            'icon' => "<i class='fa fa-credit-card-alt'></i>",
            'hasSubmodules' => false,
            'route' => $paymentGatewayUrl,
            'routeIndexName' => 'payment-gateways.index',
            'routeName' => 'payment-gateways',
            'permissions' => [
                [
                    'name' => 'View Payment Gateway',
                    'route' => [
                        'url' => $paymentGatewayUrl,
                        'method' => $getMethod,
                    ],
                ],
                [
                    'name' => 'Create Payment Gateway',
                    'route' => [
                        [
                            'url' => $paymentGatewayUrl . '/create',
                            'method' => $getMethod,
                        ],
                        [
                            'url' => $paymentGatewayUrl,
                            'method' => $postMethod,
                        ],
                    ],
                ],

                [
                    'name' => 'Delete Payment Gateway',
                    'route' => [
                        'url' => $paymentGatewayUrl . '/*',
                        'method' => $deleteMethod,
                    ],
                ]
            ],

        ],
        [
            'name' => 'Contact Us',
            'icon' => "<i class='fa fa-phone'></i>",
            'hasSubmodules' => false,
            'route' => $contactUsUrl,
            'routeIndexName' => 'contact-us.index',
            'routeName' => 'contact-us',
            'permissions' => [
                [
                    'name' => 'View Contact Us',
                    'route' => [
                        'url' => $contactUsUrl,
                        'method' => $getMethod,
                    ],
                ],
                [
                    'name' => 'Delete Contact Us',
                    'route' => [
                        'url' => $contactUsUrl . '/*',
                        'method' => $deleteMethod,
                    ],
                ]
            ],

        ],
        [
            'name' => 'Sliders',
            'icon' => "<i class='fa fa-sliders'></i>",
            'hasSubmodules' => false,
            'route' => $pageBaseUrl,
            'routeIndexName' => 'sliders.index',
            'routeName' => 'sliders',
            'permissions' => [
                [
                    'name' => 'View Slider',
                    'route' => [
                        'url' => $sliderUrl,
                        'method' => $getMethod,
                    ],
                ],
                [
                    'name' => 'Create Slider',
                    'route' => [
                        [
                            'url' => $sliderUrl . '/create',
                            'method' => $getMethod,
                        ],
                        [
                            'url' => $sliderUrl,
                            'method' => $postMethod,
                        ],
                    ],
                ],
                [
                    'name' => 'Edit Slider',
                    'route' => [
                        [
                            'url' => $sliderUrl . '/*/edit',
                            'method' => $getMethod,
                        ],
                        [
                            'url' => $sliderUrl . '/*',
                            'method' => $putMethod,
                        ],
                    ],
                ],
                [
                    'name' => 'Delete Slider',
                    'route' => [
                        'url' => $sliderUrl . '/*',
                        'method' => $deleteMethod,
                    ],
                ]
            ],

        ],
        [
            'name' => 'Testimonials',
            'icon' => "<i class='fa fa-user-circle'></i>",
            'hasSubmodules' => false,
            'route' => $testimonialUrl,
            'routeIndexName' => 'testimonials.index',
            'routeName' => 'testimonials',
            'permissions' => [
                [
                    'name' => 'View Testimonial',
                    'route' => [
                        'url' => $testimonialUrl,
                        'method' => $getMethod,
                    ],
                ],
                [
                    'name' => 'Create Testimonial',
                    'route' => [
                        [
                            'url' => $testimonialUrl . '/create',
                            'method' => $getMethod,
                        ],
                        [
                            'url' => $testimonialUrl,
                            'method' => $postMethod,
                        ],
                    ],
                ],
                [
                    'name' => 'Edit Testimonial',
                    'route' => [
                        [
                            'url' => $testimonialUrl . '/*/edit',
                            'method' => $getMethod,
                        ],
                        [
                            'url' => $testimonialUrl . '/*',
                            'method' => $putMethod,
                        ],
                    ],
                ],
                [
                    'name' => 'Delete Testimonial',
                    'route' => [
                        'url' => $testimonialUrl . '/*',
                        'method' => $deleteMethod,
                    ],
                ]
            ],

        ],
        [
            'name' => 'Partners',
            'icon' => "<i class='fa fa-user-friends'></i>",
            'hasSubmodules' => false,
            'route' => $partnerUrl,
            'routeIndexName' => 'partners.index',
            'routeName' => 'partners',
            'permissions' => [
                [
                    'name' => 'View Partner',
                    'route' => [
                        'url' => $partnerUrl,
                        'method' => $getMethod,
                    ],
                ],
                [
                    'name' => 'Create Partner',
                    'route' => [
                        [
                            'url' => $partnerUrl . '/create',
                            'method' => $getMethod,
                        ],
                        [
                            'url' => $partnerUrl,
                            'method' => $postMethod,
                        ],
                    ],
                ],
                [
                    'name' => 'Edit Partner',
                    'route' => [
                        [
                            'url' => $partnerUrl . '/*/edit',
                            'method' => $getMethod,
                        ],
                        [
                            'url' => $partnerUrl . '/*',
                            'method' => $putMethod,
                        ],
                    ],
                ],
                [
                    'name' => 'Delete Partner',
                    'route' => [
                        'url' => $partnerUrl . '/*',
                        'method' => $deleteMethod,
                    ],
                ]
            ],

        ],

    ],
];
