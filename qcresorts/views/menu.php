<?php

namespace PHPMaker2023\project1;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
    $MenuRelativePath = "";
    $MenuLanguage = &$Language;
} else { // Compat reports
    $LANGUAGE_FOLDER = "../lang/";
    $MenuRelativePath = "../";
    $MenuLanguage = Container("language");
}

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(37, "mi_calendar", $MenuLanguage->MenuPhrase("37", "MenuText"), $MenuRelativePath . "CalendarList", -1, "", AllowListMenu('{CDC6DA58-50CB-4593-9422-D777552B8D32}calendar'), false, false, "", "", false, true);
$sideMenu->addMenuItem(38, "mi_res", $MenuLanguage->MenuPhrase("38", "MenuText"), $MenuRelativePath . "ResList", -1, "", AllowListMenu('{CDC6DA58-50CB-4593-9422-D777552B8D32}res'), false, false, "", "", false, true);
$sideMenu->addMenuItem(14, "mci_User_Settings", $MenuLanguage->MenuPhrase("14", "MenuText"), "", -1, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(4, "mi_users", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "UsersList", 14, "", AllowListMenu('{CDC6DA58-50CB-4593-9422-D777552B8D32}users'), false, false, "", "", false, true);
$sideMenu->addMenuItem(6, "mi_userlevels", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "UserlevelsList", 14, "", AllowListMenu('{CDC6DA58-50CB-4593-9422-D777552B8D32}userlevels'), false, false, "", "", false, true);
$sideMenu->addMenuItem(15, "mci_Resort_Settings", $MenuLanguage->MenuPhrase("15", "MenuText"), "", -1, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(1, "mi_pool", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "PoolList", 15, "", AllowListMenu('{CDC6DA58-50CB-4593-9422-D777552B8D32}pool'), false, false, "", "", false, true);
$sideMenu->addMenuItem(30, "mi_tbl_resort_details", $MenuLanguage->MenuPhrase("30", "MenuText"), $MenuRelativePath . "TblResortDetailsList", 15, "", AllowListMenu('{CDC6DA58-50CB-4593-9422-D777552B8D32}tbl_resort_details'), false, false, "", "", false, true);
$sideMenu->addMenuItem(16, "mci_Reservation_Settings", $MenuLanguage->MenuPhrase("16", "MenuText"), "", -1, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(35, "mi_resdetails2", $MenuLanguage->MenuPhrase("35", "MenuText"), $MenuRelativePath . "Resdetails2List", 16, "", AllowListMenu('{CDC6DA58-50CB-4593-9422-D777552B8D32}resdetails2'), false, false, "", "", false, true);
$sideMenu->addMenuItem(7, "mi_resdetails", $MenuLanguage->MenuPhrase("7", "MenuText"), $MenuRelativePath . "ResdetailsList", 16, "", AllowListMenu('{CDC6DA58-50CB-4593-9422-D777552B8D32}resdetails'), false, false, "", "", false, true);
$sideMenu->addMenuItem(36, "mi_ApprovedReservations", $MenuLanguage->MenuPhrase("36", "MenuText"), $MenuRelativePath . "ApprovedReservationsList", 16, "", AllowListMenu('{CDC6DA58-50CB-4593-9422-D777552B8D32}ApprovedReservations'), false, false, "", "", false, true);
echo $sideMenu->toScript();
