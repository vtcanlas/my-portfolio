<?php

namespace PHPMaker2023\project1;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use Slim\Exception\HttpNotFoundException;

// Handle Routes
return function (App $app) {
    // pool
    $app->map(["GET","POST","OPTIONS"], '/PoolList[/{pool_id}]', PoolController::class . ':list')->add(PermissionMiddleware::class)->setName('PoolList-pool-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/PoolAdd[/{pool_id}]', PoolController::class . ':add')->add(PermissionMiddleware::class)->setName('PoolAdd-pool-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/PoolView[/{pool_id}]', PoolController::class . ':view')->add(PermissionMiddleware::class)->setName('PoolView-pool-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/PoolEdit[/{pool_id}]', PoolController::class . ':edit')->add(PermissionMiddleware::class)->setName('PoolEdit-pool-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/PoolDelete[/{pool_id}]', PoolController::class . ':delete')->add(PermissionMiddleware::class)->setName('PoolDelete-pool-delete'); // delete
    $app->group(
        '/pool',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{pool_id}]', PoolController::class . ':list')->add(PermissionMiddleware::class)->setName('pool/list-pool-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{pool_id}]', PoolController::class . ':add')->add(PermissionMiddleware::class)->setName('pool/add-pool-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{pool_id}]', PoolController::class . ':view')->add(PermissionMiddleware::class)->setName('pool/view-pool-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{pool_id}]', PoolController::class . ':edit')->add(PermissionMiddleware::class)->setName('pool/edit-pool-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{pool_id}]', PoolController::class . ':delete')->add(PermissionMiddleware::class)->setName('pool/delete-pool-delete-2'); // delete
        }
    );

    // users
    $app->map(["GET","POST","OPTIONS"], '/UsersList[/{idno}]', UsersController::class . ':list')->add(PermissionMiddleware::class)->setName('UsersList-users-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/UsersAdd[/{idno}]', UsersController::class . ':add')->add(PermissionMiddleware::class)->setName('UsersAdd-users-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/UsersView[/{idno}]', UsersController::class . ':view')->add(PermissionMiddleware::class)->setName('UsersView-users-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/UsersEdit[/{idno}]', UsersController::class . ':edit')->add(PermissionMiddleware::class)->setName('UsersEdit-users-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/UsersDelete[/{idno}]', UsersController::class . ':delete')->add(PermissionMiddleware::class)->setName('UsersDelete-users-delete'); // delete
    $app->group(
        '/users',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{idno}]', UsersController::class . ':list')->add(PermissionMiddleware::class)->setName('users/list-users-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{idno}]', UsersController::class . ':add')->add(PermissionMiddleware::class)->setName('users/add-users-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{idno}]', UsersController::class . ':view')->add(PermissionMiddleware::class)->setName('users/view-users-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{idno}]', UsersController::class . ':edit')->add(PermissionMiddleware::class)->setName('users/edit-users-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{idno}]', UsersController::class . ':delete')->add(PermissionMiddleware::class)->setName('users/delete-users-delete-2'); // delete
        }
    );

    // userlevels
    $app->map(["GET","POST","OPTIONS"], '/UserlevelsList[/{userlevelid}]', UserlevelsController::class . ':list')->add(PermissionMiddleware::class)->setName('UserlevelsList-userlevels-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/UserlevelsAdd[/{userlevelid}]', UserlevelsController::class . ':add')->add(PermissionMiddleware::class)->setName('UserlevelsAdd-userlevels-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/UserlevelsView[/{userlevelid}]', UserlevelsController::class . ':view')->add(PermissionMiddleware::class)->setName('UserlevelsView-userlevels-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/UserlevelsEdit[/{userlevelid}]', UserlevelsController::class . ':edit')->add(PermissionMiddleware::class)->setName('UserlevelsEdit-userlevels-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/UserlevelsDelete[/{userlevelid}]', UserlevelsController::class . ':delete')->add(PermissionMiddleware::class)->setName('UserlevelsDelete-userlevels-delete'); // delete
    $app->group(
        '/userlevels',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{userlevelid}]', UserlevelsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevels/list-userlevels-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{userlevelid}]', UserlevelsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevels/add-userlevels-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{userlevelid}]', UserlevelsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevels/view-userlevels-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{userlevelid}]', UserlevelsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevels/edit-userlevels-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{userlevelid}]', UserlevelsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevels/delete-userlevels-delete-2'); // delete
        }
    );

    // resdetails
    $app->map(["GET","POST","OPTIONS"], '/ResdetailsList[/{res_id}]', ResdetailsController::class . ':list')->add(PermissionMiddleware::class)->setName('ResdetailsList-resdetails-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/ResdetailsAdd[/{res_id}]', ResdetailsController::class . ':add')->add(PermissionMiddleware::class)->setName('ResdetailsAdd-resdetails-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/ResdetailsView[/{res_id}]', ResdetailsController::class . ':view')->add(PermissionMiddleware::class)->setName('ResdetailsView-resdetails-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/ResdetailsEdit[/{res_id}]', ResdetailsController::class . ':edit')->add(PermissionMiddleware::class)->setName('ResdetailsEdit-resdetails-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/ResdetailsDelete[/{res_id}]', ResdetailsController::class . ':delete')->add(PermissionMiddleware::class)->setName('ResdetailsDelete-resdetails-delete'); // delete
    $app->group(
        '/resdetails',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{res_id}]', ResdetailsController::class . ':list')->add(PermissionMiddleware::class)->setName('resdetails/list-resdetails-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{res_id}]', ResdetailsController::class . ':add')->add(PermissionMiddleware::class)->setName('resdetails/add-resdetails-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{res_id}]', ResdetailsController::class . ':view')->add(PermissionMiddleware::class)->setName('resdetails/view-resdetails-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{res_id}]', ResdetailsController::class . ':edit')->add(PermissionMiddleware::class)->setName('resdetails/edit-resdetails-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{res_id}]', ResdetailsController::class . ':delete')->add(PermissionMiddleware::class)->setName('resdetails/delete-resdetails-delete-2'); // delete
        }
    );

    // poolpics
    $app->map(["GET","POST","OPTIONS"], '/PoolpicsList[/{pic_id}]', PoolpicsController::class . ':list')->add(PermissionMiddleware::class)->setName('PoolpicsList-poolpics-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/PoolpicsAdd[/{pic_id}]', PoolpicsController::class . ':add')->add(PermissionMiddleware::class)->setName('PoolpicsAdd-poolpics-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/PoolpicsView[/{pic_id}]', PoolpicsController::class . ':view')->add(PermissionMiddleware::class)->setName('PoolpicsView-poolpics-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/PoolpicsEdit[/{pic_id}]', PoolpicsController::class . ':edit')->add(PermissionMiddleware::class)->setName('PoolpicsEdit-poolpics-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/PoolpicsDelete[/{pic_id}]', PoolpicsController::class . ':delete')->add(PermissionMiddleware::class)->setName('PoolpicsDelete-poolpics-delete'); // delete
    $app->group(
        '/poolpics',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{pic_id}]', PoolpicsController::class . ':list')->add(PermissionMiddleware::class)->setName('poolpics/list-poolpics-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{pic_id}]', PoolpicsController::class . ':add')->add(PermissionMiddleware::class)->setName('poolpics/add-poolpics-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{pic_id}]', PoolpicsController::class . ':view')->add(PermissionMiddleware::class)->setName('poolpics/view-poolpics-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{pic_id}]', PoolpicsController::class . ':edit')->add(PermissionMiddleware::class)->setName('poolpics/edit-poolpics-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{pic_id}]', PoolpicsController::class . ':delete')->add(PermissionMiddleware::class)->setName('poolpics/delete-poolpics-delete-2'); // delete
        }
    );

    // tbl_resort_details
    $app->map(["GET","POST","OPTIONS"], '/TblResortDetailsList[/{pool_id}]', TblResortDetailsController::class . ':list')->add(PermissionMiddleware::class)->setName('TblResortDetailsList-tbl_resort_details-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/TblResortDetailsAdd[/{pool_id}]', TblResortDetailsController::class . ':add')->add(PermissionMiddleware::class)->setName('TblResortDetailsAdd-tbl_resort_details-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/TblResortDetailsEdit[/{pool_id}]', TblResortDetailsController::class . ':edit')->add(PermissionMiddleware::class)->setName('TblResortDetailsEdit-tbl_resort_details-edit'); // edit
    $app->group(
        '/tbl_resort_details',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{pool_id}]', TblResortDetailsController::class . ':list')->add(PermissionMiddleware::class)->setName('tbl_resort_details/list-tbl_resort_details-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{pool_id}]', TblResortDetailsController::class . ':add')->add(PermissionMiddleware::class)->setName('tbl_resort_details/add-tbl_resort_details-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{pool_id}]', TblResortDetailsController::class . ':edit')->add(PermissionMiddleware::class)->setName('tbl_resort_details/edit-tbl_resort_details-edit-2'); // edit
        }
    );

    // poolrates
    $app->map(["GET","POST","OPTIONS"], '/PoolratesList[/{rateid}]', PoolratesController::class . ':list')->add(PermissionMiddleware::class)->setName('PoolratesList-poolrates-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/PoolratesAdd[/{rateid}]', PoolratesController::class . ':add')->add(PermissionMiddleware::class)->setName('PoolratesAdd-poolrates-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/PoolratesView[/{rateid}]', PoolratesController::class . ':view')->add(PermissionMiddleware::class)->setName('PoolratesView-poolrates-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/PoolratesEdit[/{rateid}]', PoolratesController::class . ':edit')->add(PermissionMiddleware::class)->setName('PoolratesEdit-poolrates-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/PoolratesDelete[/{rateid}]', PoolratesController::class . ':delete')->add(PermissionMiddleware::class)->setName('PoolratesDelete-poolrates-delete'); // delete
    $app->group(
        '/poolrates',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{rateid}]', PoolratesController::class . ':list')->add(PermissionMiddleware::class)->setName('poolrates/list-poolrates-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{rateid}]', PoolratesController::class . ':add')->add(PermissionMiddleware::class)->setName('poolrates/add-poolrates-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{rateid}]', PoolratesController::class . ':view')->add(PermissionMiddleware::class)->setName('poolrates/view-poolrates-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{rateid}]', PoolratesController::class . ':edit')->add(PermissionMiddleware::class)->setName('poolrates/edit-poolrates-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{rateid}]', PoolratesController::class . ':delete')->add(PermissionMiddleware::class)->setName('poolrates/delete-poolrates-delete-2'); // delete
        }
    );

    // resortslisting
    $app->map(["GET","POST","OPTIONS"], '/ResortslistingList[/{pool_id}]', ResortslistingController::class . ':list')->add(PermissionMiddleware::class)->setName('ResortslistingList-resortslisting-list'); // list
    $app->group(
        '/resortslisting',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{pool_id}]', ResortslistingController::class . ':list')->add(PermissionMiddleware::class)->setName('resortslisting/list-resortslisting-list-2'); // list
        }
    );

    // reservationdetails
    $app->map(["GET","POST","OPTIONS"], '/ReservationdetailsList[/{rateid}]', ReservationdetailsController::class . ':list')->add(PermissionMiddleware::class)->setName('ReservationdetailsList-reservationdetails-list'); // list
    $app->group(
        '/reservationdetails',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{rateid}]', ReservationdetailsController::class . ':list')->add(PermissionMiddleware::class)->setName('reservationdetails/list-reservationdetails-list-2'); // list
        }
    );

    // resdetails2
    $app->map(["GET","POST","OPTIONS"], '/Resdetails2List[/{res_id}]', Resdetails2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('Resdetails2List-resdetails2-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/Resdetails2View[/{res_id}]', Resdetails2Controller::class . ':view')->add(PermissionMiddleware::class)->setName('Resdetails2View-resdetails2-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/Resdetails2Delete[/{res_id}]', Resdetails2Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('Resdetails2Delete-resdetails2-delete'); // delete
    $app->group(
        '/resdetails2',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{res_id}]', Resdetails2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('resdetails2/list-resdetails2-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{res_id}]', Resdetails2Controller::class . ':view')->add(PermissionMiddleware::class)->setName('resdetails2/view-resdetails2-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{res_id}]', Resdetails2Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('resdetails2/delete-resdetails2-delete-2'); // delete
        }
    );

    // ApprovedReservations
    $app->map(["GET","POST","OPTIONS"], '/ApprovedReservationsList[/{res_id}]', ApprovedReservationsController::class . ':list')->add(PermissionMiddleware::class)->setName('ApprovedReservationsList-ApprovedReservations-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/ApprovedReservationsAdd[/{res_id}]', ApprovedReservationsController::class . ':add')->add(PermissionMiddleware::class)->setName('ApprovedReservationsAdd-ApprovedReservations-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/ApprovedReservationsView[/{res_id}]', ApprovedReservationsController::class . ':view')->add(PermissionMiddleware::class)->setName('ApprovedReservationsView-ApprovedReservations-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/ApprovedReservationsEdit[/{res_id}]', ApprovedReservationsController::class . ':edit')->add(PermissionMiddleware::class)->setName('ApprovedReservationsEdit-ApprovedReservations-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/ApprovedReservationsDelete[/{res_id}]', ApprovedReservationsController::class . ':delete')->add(PermissionMiddleware::class)->setName('ApprovedReservationsDelete-ApprovedReservations-delete'); // delete
    $app->group(
        '/ApprovedReservations',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{res_id}]', ApprovedReservationsController::class . ':list')->add(PermissionMiddleware::class)->setName('ApprovedReservations/list-ApprovedReservations-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{res_id}]', ApprovedReservationsController::class . ':add')->add(PermissionMiddleware::class)->setName('ApprovedReservations/add-ApprovedReservations-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{res_id}]', ApprovedReservationsController::class . ':view')->add(PermissionMiddleware::class)->setName('ApprovedReservations/view-ApprovedReservations-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{res_id}]', ApprovedReservationsController::class . ':edit')->add(PermissionMiddleware::class)->setName('ApprovedReservations/edit-ApprovedReservations-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{res_id}]', ApprovedReservationsController::class . ':delete')->add(PermissionMiddleware::class)->setName('ApprovedReservations/delete-ApprovedReservations-delete-2'); // delete
        }
    );

    // calendar
    $app->map(["GET","POST","OPTIONS"], '/CalendarList[/{Id}]', CalendarController::class . ':list')->add(PermissionMiddleware::class)->setName('CalendarList-calendar-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/CalendarAdd[/{Id}]', CalendarController::class . ':add')->add(PermissionMiddleware::class)->setName('CalendarAdd-calendar-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/CalendarView[/{Id}]', CalendarController::class . ':view')->add(PermissionMiddleware::class)->setName('CalendarView-calendar-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/CalendarEdit[/{Id}]', CalendarController::class . ':edit')->add(PermissionMiddleware::class)->setName('CalendarEdit-calendar-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/CalendarDelete[/{Id}]', CalendarController::class . ':delete')->add(PermissionMiddleware::class)->setName('CalendarDelete-calendar-delete'); // delete
    $app->group(
        '/calendar',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{Id}]', CalendarController::class . ':list')->add(PermissionMiddleware::class)->setName('calendar/list-calendar-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{Id}]', CalendarController::class . ':add')->add(PermissionMiddleware::class)->setName('calendar/add-calendar-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{Id}]', CalendarController::class . ':view')->add(PermissionMiddleware::class)->setName('calendar/view-calendar-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{Id}]', CalendarController::class . ':edit')->add(PermissionMiddleware::class)->setName('calendar/edit-calendar-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{Id}]', CalendarController::class . ':delete')->add(PermissionMiddleware::class)->setName('calendar/delete-calendar-delete-2'); // delete
        }
    );

    // res
    $app->map(["GET","POST","OPTIONS"], '/ResList[/{Id}]', ResController::class . ':list')->add(PermissionMiddleware::class)->setName('ResList-res-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/ResAdd[/{Id}]', ResController::class . ':add')->add(PermissionMiddleware::class)->setName('ResAdd-res-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/ResView[/{Id}]', ResController::class . ':view')->add(PermissionMiddleware::class)->setName('ResView-res-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/ResEdit[/{Id}]', ResController::class . ':edit')->add(PermissionMiddleware::class)->setName('ResEdit-res-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/ResDelete[/{Id}]', ResController::class . ':delete')->add(PermissionMiddleware::class)->setName('ResDelete-res-delete'); // delete
    $app->group(
        '/res',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{Id}]', ResController::class . ':list')->add(PermissionMiddleware::class)->setName('res/list-res-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{Id}]', ResController::class . ':add')->add(PermissionMiddleware::class)->setName('res/add-res-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{Id}]', ResController::class . ':view')->add(PermissionMiddleware::class)->setName('res/view-res-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{Id}]', ResController::class . ':edit')->add(PermissionMiddleware::class)->setName('res/edit-res-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{Id}]', ResController::class . ':delete')->add(PermissionMiddleware::class)->setName('res/delete-res-delete-2'); // delete
        }
    );

    // personal_data
    $app->map(["GET","POST","OPTIONS"], '/personaldata', OthersController::class . ':personaldata')->add(PermissionMiddleware::class)->setName('personaldata');

    // login
    $app->map(["GET","POST","OPTIONS"], '/login[/{provider}]', OthersController::class . ':login')->add(PermissionMiddleware::class)->setName('login');

    // change_password
    $app->map(["GET","POST","OPTIONS"], '/changepassword', OthersController::class . ':changepassword')->add(PermissionMiddleware::class)->setName('changepassword');

    // userpriv
    $app->map(["GET","POST","OPTIONS"], '/userpriv', OthersController::class . ':userpriv')->add(PermissionMiddleware::class)->setName('userpriv');

    // logout
    $app->map(["GET","POST","OPTIONS"], '/logout', OthersController::class . ':logout')->add(PermissionMiddleware::class)->setName('logout');

    // Swagger
    $app->get('/' . Config("SWAGGER_ACTION"), OthersController::class . ':swagger')->setName(Config("SWAGGER_ACTION")); // Swagger

    // Index
    $app->get('/[index]', OthersController::class . ':index')->add(PermissionMiddleware::class)->setName('index');

    // Route Action event
    if (function_exists(PROJECT_NAMESPACE . "Route_Action")) {
        if (Route_Action($app) === false) {
            return;
        }
    }

    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * NOTE: Make sure this route is defined last.
     */
    $app->map(
        ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        '/{routes:.+}',
        function ($request, $response, $params) {
            throw new HttpNotFoundException($request, str_replace("%p", $params["routes"], Container("language")->phrase("PageNotFound")));
        }
    );
};
