<?php

/*
|--------------------------------------------------------------------------
| 后台管理系统路由配置
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'backend','namespace' => 'backend','middleware' => ['backend']], function()
{
    //Index 控制器路由配置
    Route::get('/', 'IndexController@main')->name('b_index_main');
    Route::get('index/index', 'IndexController@index')->name('b_index_index');
    
    //Admin 控制器路由配置
    Route::get('/admin/index', 'AdminController@index')->name('b_admin_index')->middleware('authority');
    Route::get('/admin/adminpermissionsview', 'AdminController@adminpermissionsview')->name('b_admin_adminpermissionsview')->middleware('authority');
    Route::get('/admin/getadminListdata', 'AdminController@getadminListdata')->name('b_admin_getadminListdata')->middleware('authority');
    Route::post('/admin/updateadminrole', 'AdminController@updateadminrole')->name('b_admin_updateadminrole')->middleware('authority');
    Route::post('/admin/createadmin', 'AdminController@createadmin')->name('b_admin_createadmin')->middleware('authority');
    Route::post('/admin/updateadminstatus', 'AdminController@updateadminstatus')->name('b_admin_updateadminstatus')->middleware('authority');


    //用户个人信息操作(不需要权限控制)
    Route::get('/admin/profile', 'AdminController@profile')->name('b_admin_profile');
    Route::get('/admin/changepwdview', 'AdminController@changepwdview')->name('b_admin_changepwdview');
    Route::post('/admin/changepwd', 'AdminController@changepwd')->name('b_admin_changepwd');
    Route::post('/admin/uploadportrait', 'AdminController@uploadportrait')->name('b_admin_uploadportrait');
    Route::post('/admin/changeprofile', 'AdminController@changeprofile')->name('b_admin_changeprofile');

    //任务管理
    Route::get('/admin/task', 'AdminController@task')->name('b_admin_task');
    Route::get('/admin/gettasklistdata', 'AdminController@gettasklistdata')->name('b_admin_gettasklistdata');
    Route::get('/admin/createtaskbox', 'AdminController@createtaskbox')->name('b_admin_createtaskbox');
    Route::post('/admin/createtask', 'AdminController@createtask')->name('b_admin_createtask');
    Route::post('/admin/deletetask', 'AdminController@deletetask')->name('b_admin_deletetask');
    Route::post('/admin/updatetaskstatus', 'AdminController@updatetaskstatus')->name('b_admin_updatetaskstatus');


    //Auth    控制器路由配置
    Route::get('auth/login', 'AuthController@login')->name('b_auth_tologin');
    Route::post('auth/ptlogin', 'AuthController@ptlogin')->name('b_auth_ptlogin');
    Route::get('auth/logout', 'AuthController@logout')->name('b_auth_logout');
    Route::get('auth/code', function(){
        return json_encode(['img_url'=>Captcha::src()]);
    })->name('b_auth_code');
    Route::post('auth/sendemail', 'AuthController@sendemail')->name('b_auth_sendemail');
    Route::get('auth/checkforgotpwd', 'AuthController@checkforgotpwd')->name('b_auth_checkforgotpwd');
    Route::post('/auth/resetpwd', 'AuthController@resetpwd')->name('b_auth_resetpwd');
    
    //Menus 控制器路由配置 导航栏目
    Route::get('/menus/menuview', 'MenusController@menuview')->name('b_menus_menuview')->middleware('authority');
    Route::get('/menus/getmenutreelist', 'MenusController@getmenutreelist')->name('b_menus_getmenutreelist');
    Route::get('/menus/getmenulist', 'MenusController@getmenulist')->name('b_menus_getmenulist')->middleware('authority');
    Route::post('/menus/addmenu', 'MenusController@addmenu')->name('b_menus_addmenu')->middleware('authority');
    Route::post('/menus/updatemenu', 'MenusController@updatemenu')->name('b_menus_updatemenu')->middleware('authority');
    
    //Roles 控制器路由配置 角色管理
    Route::get('/roles/roleview', 'RolesController@roleview')->name('b_role_menuview')->middleware('authority');
    Route::get('/roles/getroleslist', 'RolesController@getroleslist')->name('b_role_getroleslist')->middleware('authority');
    Route::post('/roles/addrole', 'RolesController@addrole')->name('b_role_addrole')->middleware('authority');
    Route::post('/roles/updaterole', 'RolesController@updaterole')->name('b_role_updaterole')->middleware('authority');
    Route::post('/roles/deleterole', 'RolesController@deleterole')->name('b_role_deleterole')->middleware('authority');
    Route::get('/roles/rolepermissionsview', 'RolesController@rolepermissionsview')->name('b_role_rolepermissionsview')->middleware('authority');
    Route::post('/roles/updaterolepermissions', 'RolesController@updaterolepermissions')->name('b_role_updaterolepermissions')->middleware('authority');
    
    //Permissions 控制器路由配置 权限管理
    Route::get('/permissions/permissionsview', 'PermissionsController@permissionsview')->name('b_permissions_permissionsview')->middleware('authority');
    Route::get('/permissions/getpermissionslist', 'PermissionsController@getpermissionslist')->name('b_permissions_getpermissionslist')->middleware('authority');
    Route::post('/permissions/addpermissions', 'PermissionsController@addpermissions')->name('b_permissions_addpermissions')->middleware('authority');
    Route::post('/permissions/updatepermissions', 'PermissionsController@updatepermissions')->name('b_permissions_updatepermissions')->middleware('authority');
    Route::post('/permissions/deletepermissions', 'PermissionsController@deletepermissions')->name('b_permissions_deletepermissions')->middleware('authority');
    Route::get('/permissions/getmodulename', 'PermissionsController@getmodulename')->name('b_permissions_getmodulename');
    
    
    //FileManage 控制器路由配置 文件管理  ok
    Route::get('/filemanage/index', 'FileManageController@index')->name('b_filemanage_index')->middleware('authority');
    Route::get('/filemanage/getlogfilelist', 'FileManageController@getlogfilelist')->name('b_filemanage_getlogfilelist')->middleware('authority');
    Route::get('/filemanage/readlogfile', 'FileManageController@readlogfile')->name('b_filemanage_readlogfile')->middleware('authority');
    Route::get('/filemanage/deletelogfile', 'FileManageController@deletelogfile')->name('b_filemanage_deletelogfile')->middleware('authority');
    Route::get('/filemanage/downloadlogfile', 'FileManageController@downloadlogfile')->name('b_filemanage_downloadlogfile')->middleware('authority');
    
    //System 控制器路由配置 系统设置
    Route::get('/system/index', 'SystemController@index')->name('b_system_index')->middleware('authority');
    Route::get('/system/clearviewcache', 'SystemController@clearviewcache')->name('b_system_clearviewcache')->middleware('authority');


    Route::get('/system/record', 'SystemController@record')->name('b_system_record')->middleware('authority');
    Route::get('/system/getrecordlist', 'SystemController@getrecordlist')->name('b_system_getrecordlist')->middleware('authority');



    //wechat
    Route::get('/wechat/wexitokenview', 'WechatController@wexitokenview')->name('b_wechat_wexitokenview')->middleware('authority');
    Route::get('/wechat/wexitokendata', 'WechatController@wexitokendata')->name('b_wechat_wexitokendata')->middleware('authority');
    Route::get('/wechat/wechatmenu', 'WechatController@wechatmenu')->name('b_wechat_wechatmenu')->middleware('authority');
    Route::get('/wechat/createmenubox', 'WechatController@createmenubox')->name('b_wechat_createmenubox');
    Route::post('/wechat/createmenu', 'WechatController@createmenu')->name('b_wechat_createmenu')->middleware('authority');
    Route::get('/wechat/updatemenu', 'WechatController@updatemenu')->name('b_wechat_updatemenu')->middleware('authority');
    Route::get('/wechat/wechatmenudata', 'WechatController@wechatmenudata')->name('b_wechat_wechatmenudata')->middleware('authority');
    

    //goods category
    Route::get('/goods/category', 'GoodsController@index')->name('b_goods_category')->middleware('authority');
    Route::post('/goods/createcategory', 'GoodsController@createcategory')->name('b_goods_createcategory')->middleware('authority');
    Route::get('/goods/searchcategory', 'GoodsController@searchcategory')->name('b_goods_searchcategory');

    Route::get('/goods/brand', 'GoodsController@brand')->name('b_goods_brand')->middleware('authority');
    Route::get('/goods/getbrandlist', 'GoodsController@getbrandlist')->name('b_goods_getbrandlist');

    
    Route::post('/goods/createbrand', 'GoodsController@createbrand')->name('b_goods_createbrand')->middleware('authority');
    Route::post('/goods/updatebrand', 'GoodsController@updatebrand')->name('b_goods_updatebrand')->middleware('authority');
    Route::post('/goods/uploadbrandlogo', 'GoodsController@uploadbrandlogo')->name('b_goods_uploadbrandlogo');


    //调试控制器路由
    Route::get('/test/index', 'TestController@index')->name('b_test_index');
    Route::get('/test/easyuitable', 'TestController@easyuitable')->name('b_test_easyuitable');
    Route::get('/test/easyuitablelist', 'TestController@easyuitablelist')->name('b_test_easyuitablelist');
    
    Route::get('/test/datatables', 'TestController@datatables')->name('b_test_datatables');
    Route::get('/test/datatableslist', 'TestController@datatableslist')->name('b_test_datatableslist');
    
    Route::get('/test/jqgridtables', 'TestController@jqgridtables')->name('b_test_jqgridtables');
    Route::get('/test/jqgridtableslist', 'TestController@jqgridtableslist')->name('b_test_jqgridtableslist');
    
    Route::get('/test/test2', 'TestController@test2')->name('b_test_test2');
    Route::get('/test/test', 'TestController@test')->name('b_test_test');
    Route::get('/test/cosupload', 'TestController@cosUpload')->name('b_test_cosUpload');
});