<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 *
 * MIT License
 *
 * Copyright (c) 2020 Ronald M. Marasigan
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package LavaLust
 * @author Ronald M. Marasigan <ronald.marasigan@yahoo.com>
 * @since Version 1
 * @link https://github.com/ronmarasigan/LavaLust
 * @license https://opensource.org/licenses/MIT MIT License
 */

/*
| -------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------
| Here is where you can register web routes for your application.
|
|
*/

$router->get('/', 'UserAuth');
$router->get('/admin', 'AdminDashboard');
$router->get('/admin/dashboard', 'AdminDashboard');

$router->get('/admin/bookings', 'AdminDashboard::manage_bookings');
$router->post('/admin/update_booking_status', 'AdminDashboard::update_booking_status');
$router->get('/admin/delete_booking/{id}', 'AdminDashboard::delete_booking');

$router->group('/auth', function() use ($router){
    $router->match('/register', 'Auth::register', ['POST', 'GET']);
    $router->match('/login', 'Auth::login', ['POST', 'GET']);
    $router->get('/logout', 'Auth::logout');
    $router->match('/password-reset', 'Auth::password_reset', ['POST', 'GET']);
    $router->match('/set-new-password', 'Auth::set_new_password', ['POST', 'GET']);

    $router->group('/terms', function() use ($router){
        $router->get('/display', 'TermsController::read');
        $router->match('/create', 'TermsController::create', 'GET|POST');
        $router->match('/update', 'TermsController::update', 'GET|POST');
        $router->match('/update/{TermID}', 'TermsController::update', 'GET|POST');
        $router->get('/delete/{TermID}', 'TermsController::delete', );

    });
    $router->group('/memberships', function() use ($router){
        $router->get('/display', 'MembershipsController::read');
        $router->match('/apply', 'MembershipsController::apply', 'GET|POST');
        $router->match('/update', 'MembershipsController::update', 'GET|POST');
        $router->match('/update/{MembershipID}', 'MembershipsController::update', 'GET|POST');
        $router->get('/delete/{MembershipID}', 'MembershipsController::delete', );
    });
    $router->group('/class', function() use ($router){
        $router->get('/display', 'ClassesController::class_read');
        $router->match('/add', 'ClassesController::create', 'GET|POST');
        $router->match('/update', 'ClassesController::update', 'GET|POST');
        $router->match('/update/{ClassID}', 'ClassesController::update', 'GET|POST');
        $router->get('/delete/{ClassID}', 'ClassesController::delete', );
    });
    $router->group('/user', function() use ($router){
        $router->get('/manage', 'UserController::user_read');
        $router->get('/delete/{id}', 'UserController::user_delete', );
        $router->group('/applications', function() use ($router){
            $router->get('/manage', 'MembershipsController::mem_manage');
            $router->get('/view_mem', 'MembershipsController::user_mem');//users
            $router->get('/delete/{MembershipID}', 'MembershipsController::mem_delete', );
        });
        $router->group('/class', function() use ($router){
            $router->get('/manage', 'ClassesController::class_manage');
            $router->get('/delete/{ClassID}', 'ClassesController::class_delete', );
        });
    });
});

$router->get('/user', 'UserAuth');
$router->get('/dashboard', 'UserDashboard');
$router->group('/user', function() use ($router){
    $router->match('/user_register', 'UserAuth::user_register', ['POST', 'GET']);
    $router->match('/profile', 'UserController::profile', ['POST', 'GET']);
    $router->match('/update_profile', 'UserController::update_profile', ['POST', 'GET']);
    $router->match('/user_login', 'UserAuth::user_login', ['POST', 'GET']);
    $router->get('/user_logout', 'UserAuth::User_logout');
    $router->match('/user_password-reset', 'UserAuth::password_reset', ['POST', 'GET']);
    $router->match('/user_set-new-password', 'UserAuth::set_new_password', ['POST', 'GET']);

    $router->get('/booked_classes', 'ClassesController::class_manage');
    $router->get('/cancel_booking/{id}', 'ClassesController::cancel_booking');
    
    $router->group('/memberships', function() use ($router){
        $router->get('/display', 'MembershipsController::mem_read');
        $router->match('/avail', 'MembershipsController::avail', ['POST', 'GET']);
    });
    $router->group('/class', function() use ($router){
        $router->get('/display', 'ClassesController::read');
        $router->match('/avail', 'ClassesController::avail', ['POST', 'GET']);
    });
});
//user/class/display for managing class