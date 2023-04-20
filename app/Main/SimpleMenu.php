<?php

namespace App\Main;

class SimpleMenu
{
    /**
     * List of simple menu items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array[]
     */
    public static function menu()
    {
        return [
            'dashboard' => [
                'icon' => 'home',
                'title' => 'Dashboard',
                'route_name' => 'dashboard-overview-1',
                'params' => [
                    'layout' => 'side-menu',
                ],
            ],
//                'sub_menu' => [
//                    'dashboard-overview-1' => [
//                        'icon' => '',
//                        'params' => [
//                            'layout' => 'side-menu',
//                        ],
//                        'title' => 'Overview 1'
//                    ],
//                    'dashboard-overview-2' => [
//                        'icon' => '',
//                        'route_name' => 'dashboard-overview-2',
//                        'params' => [
//                            'layout' => 'side-menu',
//                        ],
//                        'title' => 'Overview 2'
//                    ],
//                    'dashboard-overview-3' => [
//                        'icon' => '',
//                        'route_name' => 'dashboard-overview-3',
//                        'params' => [
//                            'layout' => 'side-menu',
//                        ],
//                        'title' => 'Overview 3'
//                    ]
//                ]

            'customers' => [
                'icon' => 'book',
                'title' => 'Customers',
                'route_name' => 'customers',
                'params' => [
                    'layout' => 'side-menu',
                ],],
            'users' => [
                'icon' => 'users',
                'title' => 'Users',
                'route_name' => 'users',
                'params' => [
                    'layout' => 'side-menu',
                ],],

            'Settings' => [
                'icon' => 'settings',
                'title' => 'Settings',


                'sub_menu' => [
                    'Service Settings' => [
                        'icon' => 'settings',
                        'route_name' => 'settings',

                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Service Settings'
                    ],

                ]]

        ];
    }
}
