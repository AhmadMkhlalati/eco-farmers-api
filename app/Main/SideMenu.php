<?php

namespace App\Main;

class SideMenu
{
    /**
     * List of side menu items.
     *
     * @param \Illuminate\Http\Request $request
     * @return array[]
     */
    public static function menu()
    {
        return [

            'news' => [
                'icon' => 'file-text',
                'title' => 'News',
                'route_name' => 'admin.blog',
                'params' => [
                    'layout' => 'side-menu',
                ],
            ],
            'services' => [
                'icon' => 'link',
                'title' => 'Services',
                'route_name' => 'admin.service',
                'params' => [
                    'layout' => 'side-menu',
                ],
            ],

            'projects' => [
                'icon' => 'layers',
                'title' => 'Projects',
                'route_name' => 'admin.projects',
                'params' => [
                    'layout' => 'side-menu',
                ],
            ],
            'leads' => [
                'icon' => 'mail',
                'title' => 'Leads',
                'route_name' => 'admin.contact_us',
                'params' => [
                    'layout' => 'side-menu',
                ],
            ],
            'shipping' => [
                'icon' => 'briefcase',
                'title' => 'Shipping',
                'route_name' => 'admin.shipping',
                'params' => [
                    'layout' => 'side-menu',
                ],
            ],
            'category' => [
                'icon' => 'git-branch',
                'title' => 'Categories',
                'route_name' => 'admin.category',
                'params' => [
                    'layout' => 'side-menu',
                ],
            ],
            'products' => [
                'icon' => 'database',
                'title' => 'Products',
                'route_name' => 'admin.product',
                'params' => [
                    'layout' => 'side-menu',
                ],
            ],

            'settings' => [
                'icon' => 'settings',
                'title' => 'Socail Media',
                'route_name' => 'admin.settings',
                'params' => [
                    'layout' => 'side-menu',
                ],
            ],
            'gallery' => [
                'icon' => 'image',
                'title' => 'Gallery',
                'route_name' => 'admin.gallery',
                'params' => [
                    'layout' => 'side-menu',
                ],
            ],

//            'users' => [
//                'icon' => 'users',
//                'title' => 'Users',
//                'sub_menu' => [
//                    'users.all' => [
//                        'icon' => 'config',
//                        'title' => 'All Users',
//                        'route_name' => 'admin.users',
//                        'params' => [
//                            'layout' => 'side-menu',
//                        ],
//                    ],
//
//                ]
//            ],

        ];
    }
}
