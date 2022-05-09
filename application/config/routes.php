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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['admin'] = 'Admin/index';
$route['admin/pesanan'] = 'Admin/pesanan';
$route['default_controller'] = 'Home/index';
$route['home/(:num)'] = 'Home/home/$1';
$route['login'] = 'Auth/login';
$route['logout'] = 'Auth/logout';
$route['register'] = 'Auth/register';
$route['email/confirm'] = 'Auth/email_confirmation';
$route['email/confirm/(:any)'] = 'Auth/confirm_email/$1';
$route['register_process/(:any)'] = 'Auth/register_process/$1';
$route['debug/(:any)'] = 'Debug/index/$1';
$route['debug/(:any)/(:any)'] = 'Debug/index/$1/$2';
$route['debug/(:any)/(:any)/(:any)'] = 'Debug/index/$1/$2/$3';
$route['register/(:any)'] = 'Auth/register/$1';
$route['register'] = 'Auth/register';
$route['foto/(:num)/foto'] = 'Foto/show_foto/$1';
$route['foto/(:num)/thumb'] = 'Foto/show_thumb/$1';
$route['foto/(:num)'] = 'Foto/show_foto/$1';
$route['album/(:num)'] = 'Album/index/$1';
$route['album/(:num)/(:num)/edit'] = 'Album/edit_halaman/$1/$2';
$route['album/preview_halaman'] = 'Album/preview_halaman';
$route['album/(:num)/(:num)/delete'] = 'Album/delete_halaman/$1/$2';
$route['album/fetch_foto'] = 'Album/fetch_foto';
$route['album/fetch_halaman'] = 'Album/fetch_halaman';
$route['album/fetch_grup_template'] = 'Album/fetch_grup_template';
$route['album/fetch_template_saudara'] = 'Album/fetch_template_saudara';
$route['album/get_id_grup_template'] = 'Album/get_id_grup_template';
$route['album/fetch_template'] = 'Album/fetch_template/(:num)';
$route['album/set_foto_halaman'] = 'Album/set_foto_halaman';
$route['album/fetch_foto_halaman'] = 'Album/fetch_foto_halaman';
$route['travel'] = 'Travel/index';
$route['travel/anggota/(:num)'] = 'Travel/anggota_grup/$1';
$route['travel/anggota/(:num)/terima'] = 'Travel/terima_anggota_grup/$1';
$route['travel/anggota/(:num)/hapus'] = 'Travel/hapus_anggota_grup/$1';
$route['travel/paket/fetch'] = 'Travel/fetch_paket_travel';
$route['travel/paket/tambah'] = 'Travel/tambah_paket_travel';
$route['travel/paket/(:num)/album'] = 'Travel/admin/$1/album';
$route['travel/paket/(:num)/album/fetch'] = 'Travel/fetch_album_grup/$1';
$route['travel/paket/(:num)/anggota'] = 'Travel/admin/$1/anggota';
$route['travel/paket/(:num)/anggota/fetch'] = 'Travel/fetch_anggota_grup/$1';
$route['travel/paket/(:num)/foto'] = 'Travel/admin/$1/foto';
$route['travel/paket/(:num)/foto/upload'] = 'Travel/upload_foto/$1';
$route['travel/paket/(:num)/foto/fetch'] = 'Travel/fetch_foto/$1';
$route['customer'] = 'Customer/index';
$route['customer/paket'] = 'Customer/paket';
$route['customer/paket/(:num)'] = 'Customer/detail_paket/$1';
$route['customer/travel/(:num)'] = 'Customer/paket_travel_public/$1';
$route['customer/travel'] = 'Customer/travel';
$route['customer/paket/fetch'] = 'Customer/fetch_paket_travel';
$route['customer/paket/(:num)/album'] = 'Customer/admin_paket/$1/album';
$route['customer/paket/(:num)/album/fetch'] = 'Customer/fetch_album_anggota/$1';
$route['customer/paket/(:num)/foto'] = 'Customer/admin_paket/$1/foto';
$route['customer/paket/(:num)/foto/upload'] = 'Customer/upload_foto/$1';
$route['customer/paket/(:num)/foto/fetch'] = 'Customer/fetch_foto/$1';
$route['percetakan'] = 'Percetakan/index';
$route['percetakan/paket/fetch'] = 'Percetakan/fetch_paket_cetak';
$route['percetakan/paket/tambah'] = 'Percetakan/tambah_paket_cetak';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;