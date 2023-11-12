<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)
return [
    '' => ['HomeController', 'index',],
    'service' => ['ServiceController', 'index',],
    'service/show' => ['ServiceController', 'show', ['id']],
    'register' => ['UserController', 'register',],
    'reservation' => ['ReservationController', 'insert',],
    'items' => ['ItemController', 'index',],
    'items/edit' => ['ItemController', 'edit', ['id']],
    'items/show' => ['ItemController', 'show', ['id']],
    'items/add' => ['ItemController', 'add',],
    'items/delete' => ['ItemController', 'delete',],
    'connexion' => ['SecurityController', 'login',],
    'logout' => ['SecurityController', 'logout',],
    'admin/dashboard' => ['DashboardController', 'index',],
    'admin/prestations' => ['PrestationsController', 'index',],
    'admin/prestations/new' => ['PrestationsController', 'new',],
    'admin/prestations/edit' => ['PrestationsController', 'edit', ['id']],
    'admin/prestations/delete' => ['PrestationsController', 'delete', ['id']],
    'admin/reservations' => ['ReservationController', 'index',],

];
