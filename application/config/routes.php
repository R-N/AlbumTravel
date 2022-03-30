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
$route['admin'] = 'admin/index';
$route['admin/pesanan'] = 'admin/pesanan';
$route['default_controller'] = 'home/home';
$route['home/(:num)'] = 'home/home/$1';
$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';
$route['register'] = 'auth/register';
$route['email/confirm'] = 'auth/email_confirmation';
$route['email/confirm/(:any)'] = 'auth/confirm_email/$1';
$route['register_process/(:any)'] = 'auth/register_process/$1';
$route['debug/(:any)'] = 'debug/index/$1';
$route['debug/(:any)/(:any)'] = 'debug/index/$1/$2';
$route['debug/(:any)/(:any)/(:any)'] = 'debug/index/$1/$2/$3';
$route['register/(:any)'] = 'auth/register/$1';
$route['register'] = 'auth/register';
$route['foto/(:num)/foto'] = 'foto/show_foto/$1';
$route['foto/(:num)/thumb'] = 'foto/show_thumb/$1';
$route['foto/(:num)'] = 'foto/show_foto/$1';
$route['album/(:num)'] = 'album/index/$1';
$route['album/(:num)/(:num)/edit'] = 'album/edit_halaman/$1/$2';
$route['album/preview_halaman'] = 'album/preview_halaman';
$route['album/(:num)/(:num)/delete'] = 'album/delete_halaman/$1/$2';
$route['album/fetch_foto'] = 'album/fetch_foto';
$route['album/fetch_halaman'] = 'album/fetch_halaman';
$route['album/fetch_grup_template'] = 'album/fetch_grup_template';
$route['album/fetch_template_saudara'] = 'album/fetch_template_saudara';
$route['album/get_id_grup_template'] = 'album/get_id_grup_template';
$route['album/fetch_template'] = 'album/fetch_template/(:num)';
$route['album/set_foto_halaman'] = 'album/set_foto_halaman';
$route['album/fetch_foto_halaman'] = 'album/fetch_foto_halaman';
$route['travel'] = 'travel/index';
$route['travel/anggota/(:num)'] = 'travel/anggota_grup/$1';
$route['travel/anggota/(:num)/terima'] = 'travel/terima_anggota_grup/$1';
$route['travel/anggota/(:num)/hapus'] = 'travel/hapus_anggota_grup/$1';
$route['travel/paket/fetch'] = 'travel/fetch_paket_travel';
$route['travel/paket/tambah'] = 'travel/tambah_paket_travel';
$route['travel/paket/(:num)/album'] = 'travel/admin/$1/album';
$route['travel/paket/(:num)/album/fetch'] = 'travel/fetch_album_grup/$1';
$route['travel/paket/(:num)/anggota'] = 'travel/admin/$1/anggota';
$route['travel/paket/(:num)/anggota/fetch'] = 'travel/fetch_anggota_grup/$1';
$route['travel/paket/(:num)/foto'] = 'travel/admin/$1/foto';
$route['travel/paket/(:num)/foto/upload'] = 'travel/upload_foto/$1';
$route['travel/paket/(:num)/foto/fetch'] = 'travel/fetch_foto/$1';
$route['customer'] = 'customer/index';
$route['customer/paket'] = 'customer/paket';
$route['customer/paket/(:num)'] = 'customer/detail_paket/$1';
$route['customer/travel/(:num)'] = 'customer/paket_travel_public/$1';
$route['customer/travel'] = 'customer/travel';
$route['customer/paket/fetch'] = 'customer/fetch_paket_travel';
$route['customer/paket/(:num)/album'] = 'customer/admin_paket/$1/album';
$route['customer/paket/(:num)/album/fetch'] = 'customer/fetch_album_anggota/$1';
$route['customer/paket/(:num)/foto'] = 'customer/admin_paket/$1/foto';
$route['customer/paket/(:num)/foto/upload'] = 'customer/upload_foto/$1';
$route['customer/paket/(:num)/foto/fetch'] = 'customer/fetch_foto/$1';
$route['percetakan'] = 'percetakan/index';
$route['percetakan/paket/fetch'] = 'percetakan/fetch_paket_cetak';
$route['percetakan/paket/tambah'] = 'percetakan/tambah_paket_cetak';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;