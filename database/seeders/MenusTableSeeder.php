<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class MenusTableSeeder extends Seeder
{
    private $menuId = null;
    private $dropdownId = array();
    private $dropdown = false;
    private $sequence = 1;
    private $joinData = array();
    private $adminRole = null;
    private $userRole = null;
    private $subFolder = '';

    public function join($roles, $menusId){
        $roles = explode(',', $roles);
        foreach($roles as $role){
            array_push($this->joinData, array('role_name' => $role, 'menus_id' => $menusId));
        }
    }

    /*
        Function assigns menu elements to roles
        Must by use on end of this seeder
    */
    public function joinAllByTransaction(){
        DB::beginTransaction();
        foreach($this->joinData as $data){
            DB::table('menu_role')->insert([
                'role_name' => $data['role_name'],
                'menus_id' => $data['menus_id'],
            ]);
        }
        DB::commit();
    }

    public function insertLink($roles, $name, $href, $icon = null){
        $href = $this->subFolder . $href;
        if($this->dropdown === false){
            DB::table('menus')->insert([
                'slug' => 'link',
                'name' => $name,
                'icon' => $icon,
                'href' => $href,
                'menu_id' => $this->menuId,
                'sequence' => $this->sequence
            ]);
        }else{
            DB::table('menus')->insert([
                'slug' => 'link',
                'name' => $name,
                'icon' => $icon,
                'href' => $href,
                'menu_id' => $this->menuId,
                'parent_id' => $this->dropdownId[count($this->dropdownId) - 1],
                'sequence' => $this->sequence
            ]);
        }
        $this->sequence++;
        $lastId = DB::getPdo()->lastInsertId();
        $this->join($roles, $lastId);
        $permission = Permission::where('name', '=', $name)->get();
        if(empty($permission)){
            $permission = Permission::create(['name' => 'visit ' . $name]);
        }
        $roles = explode(',', $roles);
        if(in_array('user', $roles)){
            $this->userRole->givePermissionTo($permission);
        }
        if(in_array('admin', $roles)){
            $this->adminRole->givePermissionTo($permission);
        }
        return $lastId;
    }

    public function insertTitle($roles, $name){
        DB::table('menus')->insert([
            'slug' => 'title',
            'name' => $name,
            'menu_id' => $this->menuId,
            'sequence' => $this->sequence
        ]);
        $this->sequence++;
        $lastId = DB::getPdo()->lastInsertId();
        $this->join($roles, $lastId);
        return $lastId;
    }

    public function beginDropdown($roles, $name, $icon = ''){
        if(count($this->dropdownId)){
            $parentId = $this->dropdownId[count($this->dropdownId) - 1];
        }else{
            $parentId = null;
        }
        DB::table('menus')->insert([
            'slug' => 'dropdown',
            'name' => $name,
            'icon' => $icon,
            'menu_id' => $this->menuId,
            'sequence' => $this->sequence,
            'parent_id' => $parentId
        ]);
        $lastId = DB::getPdo()->lastInsertId();
        array_push($this->dropdownId, $lastId);
        $this->dropdown = true;
        $this->sequence++;
        $this->join($roles, $lastId);
        return $lastId;
    }

    public function endDropdown(){
        $this->dropdown = false;
        array_pop( $this->dropdownId );
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        /* Get roles */
        $this->adminRole = Role::where('name' , '=' , 'admin' )->first();
        $this->userRole = Role::where('name', '=', 'user' )->first();
        /* Create Sidebar menu */
        DB::table('menulist')->insert([
            'name' => 'sidebar menu'
        ]);
        $this->menuId = DB::getPdo()->lastInsertId();  //set menuId
        $this->insertLink('admin', 'Dashboard', '/', 'cil-speedometer');
        $this->beginDropdown('admin', 'Settings', 'cil-calculator');
            $this->insertLink('admin', 'Notes',                   '/notes');
            $this->insertLink('admin', 'Users',                   '/users');
            $this->insertLink('admin', 'Edit menu',               '/menu/menu');
            $this->insertLink('admin', 'Edit menu elements',      '/menu/element');
            $this->insertLink('admin', 'Edit roles',              '/roles');
            $this->insertLink('admin', 'Media',                   '/media');
            $this->insertLink('admin', 'BREAD',                   '/bread');
            $this->insertLink('admin', 'Email',                   '/mail');
        $this->endDropdown();
        $this->insertLink('guest', 'Login', '/login', 'cil-account-logout');
        // $this->insertLink('guest', 'Register', '/register', 'cil-account-logout');
        // $this->insertTitle('admin', 'Theme');
        // $this->insertLink('admin', 'Colors', '/colors', 'cil-drop1');
        // $this->insertLink('admin', 'Typography', '/typography', 'cil-pencil');
        // $this->beginDropdown('admin', 'Base', 'cil-puzzle');
        //     $this->insertLink('admin', 'Breadcrumb',    '/base/breadcrumb');
        //     $this->insertLink('admin', 'Cards',         '/base/cards');
        //     $this->insertLink('admin', 'Carousel',      '/base/carousel');
        //     $this->insertLink('admin', 'Collapse',      '/base/collapse');
        //     $this->insertLink('admin', 'Forms',         '/base/forms');
        //     $this->insertLink('admin', 'Jumbotron',     '/base/jumbotron');
        //     $this->insertLink('admin', 'List group',    '/base/list-group');
        //     $this->insertLink('admin', 'Navs',          '/base/navs');
        //     $this->insertLink('admin', 'Pagination',    '/base/pagination');
        //     $this->insertLink('admin', 'Popovers',      '/base/popovers');
        //     $this->insertLink('admin', 'Progress',      '/base/progress');
        //     $this->insertLink('admin', 'Scrollspy',     '/base/scrollspy');
        //     $this->insertLink('admin', 'Switches',      '/base/switches');
        //     $this->insertLink('admin', 'Tables',        '/base/tables');
        //     $this->insertLink('admin', 'Tabs',          '/base/tabs');
        //     $this->insertLink('admin', 'Tooltips',      '/base/tooltips');
        // $this->endDropdown();
        // $this->beginDropdown('admin', 'Buttons', 'cil-cursor');
            // $this->insertLink('admin', 'Buttons',           '/buttons/buttons');
            // $this->insertLink('admin', 'Buttons Group',     '/buttons/button-group');
            // $this->insertLink('admin', 'Dropdowns',         '/buttons/dropdowns');
            // $this->insertLink('admin', 'Brand Buttons',     '/buttons/brand-buttons');
        // $this->endDropdown();
        // $this->insertLink('admin', 'Charts', '/charts', 'cil-chart-pie');
        // $this->beginDropdown('admin', 'Icons', 'cil-star');
        //     $this->insertLink('admin', 'CoreUI Icons',      '/icon/coreui-icons');
        //     $this->insertLink('admin', 'Flags',             '/icon/flags');
        //     $this->insertLink('admin', 'Brands',            '/icon/brands');
        // $this->endDropdown();
        // $this->beginDropdown('admin', 'Notifications', 'cil-bell');
        //     $this->insertLink('admin', 'Alerts',     '/notifications/alerts');
        //     $this->insertLink('admin', 'Badge',      '/notifications/badge');
        //     $this->insertLink('admin', 'Modals',     '/notifications/modals');
        // $this->endDropdown();
        // $this->insertLink('admin', 'Widgets', '/widgets', 'cil-calculator');
        // $this->insertTitle('admin', 'Extras');
        // $this->beginDropdown('admin', 'Pages', 'cil-star');
        //     $this->insertLink('admin', 'Login',         '/login');
            // $this->insertLink('admin', 'Register',      '/register');
            // $this->insertLink('admin', 'Error 404',     '/404');
            // $this->insertLink('admin', 'Error 500',     '/500');
        // $this->endDropdown();
        // $this->insertLink('admin', 'Download CoreUI', 'https://coreui.io', 'cil-cloud-download');
        // $this->insertLink('admin', 'Try CoreUI PRO', 'https://coreui.io/pro/', 'cil-layers');

        // Huy: add menu BVTH
        $this->insertTitle('admin', 'BVTH');
        $this->beginDropdown('admin', 'Banner', 'cil-swap-horizontal');
            $this->insertLink('admin', 'Trang chủ',         '/ad-banner-main');
            $this->insertLink('admin', 'Footer',         '/ad-banner-footer');
            $this->insertLink('admin', 'Giới thiệu',         '/ad-banner-about');
            $this->insertLink('admin', 'Chuyên khoa',         '/ad-banner-chuyenkhoa');
            $this->insertLink('admin', 'Dịch vụ',         '/ad-banner-service');
            $this->insertLink('admin', 'Bảng giá',         '/ad-banner-banggia');
            $this->insertLink('admin', 'Tin tức',         '/ad-banner-news');
            $this->insertLink('admin', 'Tuyển dụng',         '/ad-banner-tuyendung');
        $this->endDropdown();

        $this->insertLink('admin', 'Thông báo', '/notifications', 'cil-bell');

        $this->beginDropdown('admin', 'Giới thiệu', 'cil-pencil');
            $this->insertLink('admin', 'Về chúng tôi',         '/aboutBVTH');
            $this->insertLink('admin', 'Phòng ban',         '/departmentBVTH');
            $this->insertLink('admin', 'Bác sĩ',         '/doctorBVTH');
            $this->insertLink('admin', 'Danh mục thư viện ảnh',         '/photoCatalogBVTH');
            $this->insertLink('admin', 'Album ảnh',         '/albumsBVTH');
            $this->insertLink('admin', 'Video',         '/videoBVTH');
            $this->insertLink('admin', 'Cơ sở vật chất',         '/infrastructureBVTH');
        $this->endDropdown();

        $this->beginDropdown('admin', 'Dịch vụ', 'cil-star');
            $this->insertLink('admin', 'Khám chữa bệnh',         '/healthcare');
            $this->insertLink('admin', 'Gói khám chữa bệnh',         '/package-healthcare');
        $this->endDropdown();

        $this->insertLink('admin', 'Các khoa phòng', '/catalog-departments', 'cil-room');

        $this->beginDropdown('admin', 'Tin tức', 'cil-newspaper');
            $this->insertLink('admin', 'Danh mục',         '/catalog-newspaper');
            $this->insertLink('admin', 'Bài viết',         '/newspaper');
        $this->endDropdown();

        $this->insertLink('admin', 'Đặt lịch khám', '/medical-appointment', 'cil-medical-cross');
        $this->insertLink('admin', 'Cảm nhận bệnh nhân', '/write-comments', 'cil-comment-bubble');

        /* Create top menu */
        DB::table('menulist')->insert([
            'name' => 'top menu'
        ]);
        $this->menuId = DB::getPdo()->lastInsertId();  //set menuId
        // $this->beginDropdown('admin', 'Pages');
        // $id = $this->insertLink('admin', 'Dashboard',    '/');
        // $id = $this->insertLink('admin', 'Notes',              '/notes');
        // $id = $this->insertLink('admin', 'Users',                   '/users');
        // $this->endDropdown();
        $id = $this->beginDropdown('admin', 'Settings');
        $id = $this->insertLink('admin', 'Edit menu',               '/menu/menu');
        $id = $this->insertLink('admin', 'Edit menu elements',      '/menu/element');
        $id = $this->insertLink('admin', 'Edit roles',              '/roles');
        $id = $this->insertLink('admin', 'Media',                   '/media');
        $id = $this->insertLink('admin', 'BREAD',                   '/bread');
        $this->endDropdown();

        $this->joinAllByTransaction(); ///   <===== Must by use on end of this seeder
    }
}
