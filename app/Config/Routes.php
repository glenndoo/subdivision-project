<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Users');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Users::index', ['filter' => 'noauth']);
$routes->get('register', 'Users::register');
$routes->get('Dashboard', 'Dashboard::index', ['filter' => 'auth']);
$routes->get('profile', 'Users::profile', ['filter' => 'auth']);
$routes->get('logout', 'Users::logout');
$routes->get('inventory', "inventory/Inventory::index", ['filter' => 'auth']);
$routes->get('jsonData', "inventory/Inventory::jsonData", ['filter' => 'auth']);
$routes->add('addItem', "inventory/Inventory::addItem", ['filter' => 'auth']);
$routes->add('updateItem', "inventory/Inventory::updateItem", ['filter' => 'auth']);
$routes->add('removeItem', "inventory/Inventory::removeItem", ['filter' => 'auth']);
$routes->get('clerk', "clerk/Clerk::index", ['filter' => 'auth']);
$routes->add('order', "clerk/Clerk::order", ['filter' => 'auth']);
$routes->add('purchase', "clerk/Clerk::purchase", ['filter' => 'auth']);
$routes->get('sales', "sales/Sales::index", ['filter' => 'auth']);
$routes->get('memberPurchases', "sales/Sales::memberPurchases", ['filter' => 'auth']);
$routes->get('jsonSales', "sales/Sales::jsonSales", ['filter' => 'auth']);
$routes->get('searchSales', "sales/Sales::searchSales", ['filter' => 'auth']);
$routes->get('datatable', "Users::datatable", ['filter' => 'auth']);
$routes->add('searchByMonth', "sales/Sales::searchByMonth", ['filter' => 'auth']);
$routes->add('showMembers', "sales/Sales::showMembers", ['filter' => 'auth']);
$routes->add('memberPurchases', "sales/Sales::memberPurchases", ['filter' => 'auth']);
$routes->add('clerkView', "sales/Sales::index", ['filter' => 'auth']);
$routes->add('memberCredit', "sales/Sales::showMembers", ['filter' => 'auth']);
$routes->add('payment', "sales/Sales::makePayment", ['filter' => 'auth']);
$routes->add('inventorySummary', "inventory/Inventory::inventorySummary", ['filter' => 'auth']);
$routes->add('jsonInventory', "inventory/Inventory::jsonInventory", ['filter' => 'auth']);
$routes->add('replenishItem', "inventory/Inventory::replenish", ['filter' => 'auth']);
$routes->add('cart', "clerk/clerk::cart", ['filter' => 'auth']);
$routes->add('jsonCart', "clerk/clerk::cartDetails", ['filter' => 'auth']);
$routes->add('placeOrder', "clerk/clerk::placeOrder", ['filter' => 'auth']);
$routes->add('jsonCredit', "sales/Sales::jsonCredit", ['filter' => 'auth']);
$routes->add('globeLoad', "clerk/Clerk::globeLoad", ['filter' => 'auth']);
$routes->add('smartLoad', "clerk/Clerk::smartLoad", ['filter' => 'auth']);
$routes->add('removeSales', "sales/Sales::removeSalesEntry", ['filter' => 'auth']);
$routes->add('showSummary', "inventory/Inventory::showSummary", ['filter' => 'auth']);
$routes->add('invDetails', "inventory/Inventory::invDetails", ['filter' => 'auth']);
$routes->add('stamp', "inventory/Inventory::stampInventory", ['filter' => 'auth']);
$routes->add('jsonShowMembers', "sales/Sales::jsonShowMembers", ['filter' => 'auth']);
$routes->add('addMember', "inventory/Inventory::addMember", ['filter' => 'auth']);
/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
