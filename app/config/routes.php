<?php

use app\controllers\HabitationController;
use app\controllers\HomeController;
use app\controllers\GiftController;
use app\controllers\UserController;
use app\controllers\AdminController; 
use app\Controllers\DepositsController;
use app\models\User;
use flight\Engine;
use flight\net\Router;
use app\Controllers\TestHabitationController;

/** 
 * @var Router $router 
 * @var Engine $app
 */
Flight::before('route', function () {
    $protectedRoutes = ['/home', '/addHabitation', '/lists', '/detail/@id'];
    $currentRoute = Flight::request()->url;

    if (in_array($currentRoute, $protectedRoutes) && !isset($_SESSION['user_id'])) {
        Flight::redirect('/user/loginForm');
        exit;
    }

    if ($currentRoute == '/admin' && (!isset($_SESSION['user_role'][0]) || $_SESSION['user_role'][0] !== 'admin')) {
        Flight::redirect('/home');
        exit;
    }
});

// Index
$HomeController = new HomeController();
Flight::route('/home', [$HomeController, 'index']);

// User
$UserController = new UserController();
Flight::route('/', [$UserController, 'registerForm']); // Création de nouvel utilisateur
Flight::route('POST /user/register', [$UserController, 'register']);
Flight::route('/user/loginForm', [$UserController, 'loginForm']);
Flight::route('POST /user/login', [$UserController, 'login']);

// Habitation
$HabitationController = new HabitationController();
Flight::route('/form/addHabitation', [$HabitationController, 'formulaireAddHabitation']);
Flight::route('/addHabitation', [$HabitationController, 'addHabitation']);
Flight::route('/lists', [$HabitationController, 'listHabitations']);
Flight::route('/detail/@id', [$HabitationController, 'detailsHabitation']);



$testHabitationController = new TestHabitationController();

Flight::route('/admin/form/add/habitation', [$testHabitationController, 'formulaireAddHabitation']);
Flight::route('/admin/addHabitation', [$testHabitationController, 'addHabitation']);
Flight::route('/admin/list/habitation', [$testHabitationController, 'listHabitationsAdmin']);
Flight::route('/admin/detail/photo/@id', [$testHabitationController, 'detailPhotos']);
Flight::route('/admin/add/photo/@id', [$testHabitationController, 'addPhoto']);
Flight::route('/admin/delete/photo/@id/@photoId', [$testHabitationController, 'deletePhoto']);
Flight::route('/admin/form/add/typeMaison', [$testHabitationController, 'formTypeMaison']);
Flight::route('/admin/add/type_maison', [$testHabitationController, 'addTypeMaison']);

Flight::route('/type', [$testHabitationController, 'type']);


// Flight::route('GET /Form', [$UserController, 'registerForm']);
// Flight::route('GET /lists', [$HomeController, 'lists']);
// Flight::route('GET /types', [$HomeController, 'types']);
// Flight::route('GET /testimonial', [$HomeController, 'testimonial']);
// Flight::route('GET /PageNotFound', [$HomeController, 'PageNotFound']);
