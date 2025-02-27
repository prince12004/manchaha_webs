<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['api/test'] = 'Api/ApiController/index';
$route['api/login'] = 'Api/ApiController/login';
$route['api/verify-otp'] = 'Api/ApiController/verifyotp';
$route['api/login-email'] = 'Api/ApiController/loginemail';
$route['api/verify-email'] = 'Api/ApiController/verifyemail';
$route['api/home'] = 'Api/ApiController/home';
$route['api/product-list'] = 'Api/ApiController/productlist';
$route['api/product-details'] = 'Api/ApiController/productdetails';

$route['api/product-rating'] = 'Api/ApiController/productRating';
$route['api/add-review'] = 'Api/ApiController/addReview';
$route['api/user-address'] = 'Api/ApiController/userAddress';
$route['api/search-products'] = 'Api/ApiController/search';
$route['api/update-address'] = 'Api/ApiController/updateAddress';

$route['api/filter-list'] = 'Api/ApiController/filterlist';

$route['api/delete-address'] = 'Api/ApiController/deleteAddress';

$route['api/categories'] = 'Api/ApiController/categories';
$route['api/update-profile'] = 'Api/ApiController/updateProfile';
$route['api/user-wishlist'] = 'Api/ApiController/wishlist';
$route['api/user-cart'] = 'Api/ApiController/cart';
$route['api/add-cart'] = 'Api/ApiController/addCart';
$route['api/add-wishlist'] = 'Api/ApiController/addWishlist';
$route['api/create-order'] = 'Api/ApiController/createorder';
$route['api/remove-cart'] = 'Api/ApiController/removeCart';
$route['api/remove-wishlist'] = 'Api/ApiController/removeWishlist';
$route['api/orders'] = 'Api/ApiController/myOrders';
$route['api/add-address'] = 'Api/ApiController/addAddress';
$route['api/track-order'] = 'Api/ApiController/trackorder';
$route['api/cancel-order'] = 'Api/ApiController/cancelorder';
$route['api/return-order'] = 'Api/ApiController/returnorder';
$route['api/order-details'] = 'Api/ApiController/orderdetails';
$route['api/invoice'] = 'Api/ApiController/invoice';
$route['admin/orders'] = 'Admin/AdminController/Orders';

$route['admin/customers'] = 'Admin/AdminController/Customers';
$route['Web/Web/page/about'] = 'Web/Web/page/about';


$route['admin-login'] = 'Welcome/admin_login';
$route['admin'] = 'Welcome/admin_login';


$route['savecategory'] = 'Web/Admin/Admin/savecategory';
$route['deletecategory'] = 'Web/Admin/Admin/deletecategory';
$route['getimagesbycolor'] = 'Welcome/getimagesbycolor';
$route['logout'] = 'Web/Admin/Admin/adminlogout';
$route['deletejwellary'] = 'Web/Admin/Admin/deletejwellary';
$route['editJwellary/(:num)'] = 'Web/Admin/Admin/editJwellary/$1';
$route['updateImage'] = 'Web/Admin/Admin/updateImage';
$route['updateVarient'] = 'Web/Admin/Admin/updateVarient';
$route['updateProductDetails'] = 'Web/Admin/Admin/updateProductDetails';
$route['getChildCategories/(:num)'] = 'Web/Admin/Admin/getChildCategories/$1';
$route['privacy'] = 'Welcome/privacy';
$route['saveBanner'] = 'Web/Admin/Admin/saveBanner';
$route['login'] = 'Welcome/loginpage';
$route['auth'] = 'Welcome/login';
$route['verifyOTP'] = 'Welcome/verifyOTP';
$route['shipping'] = 'Welcome/shipping';
$route['Wishlist'] = 'Web/User/User/Wishlist';
$route['addNewVarient'] = 'Web/Admin/Admin/addNewVarient';
$route['addToWishlist'] = 'Web/User/User/addToWishlist';
$route['saveCartData'] = 'Web/User/User/saveCartData';
$route['checkout'] = 'Web/User/User/paymentpage';
$route['cart'] = 'Web/User/User/cart';
$route['addNewImage'] = 'Web/Admin/Admin/addNewImage';
$route['saveAddress'] = 'Web/User/User/Address';
$route['makereturn'] = 'Web/User/User/makereturn';
$route['payment'] = 'Web/User/User/payment';
$route['vender'] = 'Web/Admin/Admin/vender';
$route['bannerHeroSection'] = 'Web/Admin/Admin/bannerHeroSection';
$route['addvender'] = 'Web/Admin/Admin/addvender';
$route['editvender'] = 'Web/Admin/Admin/editvender';
$route['venderDetails'] = 'Web/Admin/Admin/venderDetails';
$route['transition'] = 'Web/Admin/Admin/transition';
$route['checkDelivery'] = 'Ship/checkDelivery';
$route['homeSearch/(:any)'] = 'Welcome/homeSearch/$1';
$route['subscribeEmail'] = 'Welcome/subscribeEmail';
$route['deleteFromCart'] = 'Web/User/User/deleteFromCart';
$route['cancelOrder'] = 'Web/User/User/cancelOrder';
$route['addjwellary'] = 'Web/Admin/Admin/addjwellary';
$route['addToCart'] = 'Web/User/User/addCart';
$route['deleteAddress'] = 'Web/User/User/deleteAddress';
$route['editAddress'] = 'Web/User/User/editAddress';
$route['updateAddress'] = 'Web/User/User/updateAddress';
$route['deleteVarient'] = 'Web/Admin/Admin/deleteVarient';
$route['updateThumbnail'] = 'Web/Admin/Admin/updatethumbnail';
$route['seller-form'] = 'Vendor/seller';
$route['saveVendor'] = 'Vendor/save_vendor';
$route['saveBank'] = 'Vendor/saveBank';
$route['save-signature'] = 'Vendor/saveSignature';
$route['checkPhone'] = 'Welcome/checkPhone';
$route['getStates'] = 'Welcome/getStates';
$route['assignAWB'] = 'Ship/assignAWB';
$route['generateLabel'] = 'Ship/generateLabel';
$route['generateInvoice'] = 'Ship/generateInvoice';
$route['SchedulePickup'] = 'Ship/SchedulePickup';
$route['returnpolicy'] = 'Welcome/returnpolicy';
$route['mobileLogin'] = 'Welcome/mobileLogin';
$route['sendOtp'] = 'Welcome/sendOtp';
$route['removeWishlist'] = 'Web/User/User/removeWishlist';
$route['order-status/(:num)'] = 'Web/User/User/orderstatus/$1';
$route['get-categories'] = 'Welcome/getCategories';
$route['get-child-categories'] = 'Welcome/getChildCategories';
$route['support'] = 'Welcome/support';
$route['freedelivery'] = 'Welcome/freedelivery';
$route['securepayment'] = 'Welcome/securepayment';
$route['getProductsByCategory'] = 'Welcome/getProductsByCategory';
$route['readytoship/(:num)'] = 'Web/Admin/Admin/readytoship/$1';
$route['shipped/(:num)'] = 'Web/Admin/Admin/shipped/$1';
$route['cancelled/(:num)'] = 'Web/Admin/Admin/cancelled/$1';
$route['orderHistory/(:num)'] = 'Web/Admin/Admin/orderHistory/$1';
$route['cancel-order'] = 'Web/Admin/Admin/cancel_order';
$route['returnorder'] = 'Web/Admin/Admin/returnorder';
$route['returntracking/(:any)'] = 'Web/Admin/Admin/returntracking/$1';
$route['deletVarientImage'] = 'Web/Admin/Admin/deletVarientImage';
$route['order-invoice/(:num)'] = 'Web/User/User/generate_invoice/$1';
$route['return-order'] = 'Web/User/User/return';
$route['submitreturn'] = 'Web/User/User/submitreturn';
$route['accept-return'] = 'Web/Admin/Admin/accept_return';
$route['viewdetails'] = 'Web/Admin/Admin/viewdetails';

$route['replace-order'] = 'Web/User/User/replace';
$route['viewdetails/(:any)'] = 'Web/Admin/Admin/viewdetails/$1';

$route['add-review'] = 'Web/User/User/addReview';
$route['review-page'] = 'Web/User/User/reviewPage';
$route['review/save'] = 'Web/User/User/saveReview';
$route['allreview/(:num)'] = 'Welcome/allreview/$1';
$route['delete-account-request'] = 'Welcome/deleteaccount';
