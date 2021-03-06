<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;


class AdminController extends Controller{
    
    public $menuModel = null;
    
    public function __construct() {
        $this->menuModel = new \App\Model\Menus();
        
        $path   = request()->path();
        $method = request()->method();
        $authManage = new \App\Model\FunctionClass\AuthManage(3);
        $authManage->verify($path,$method);
    }
    
    public function MenuView(){
        return view('admin.menu-view');
    }
    
    public function RoleView(){
        return view('admin.role-view');
    }
    
    
    public function menuViewTest(){
        return view('admin.menu-viewtest');
    }
    
    /**
     * 获取菜单列表数据
     */
    public function getMenusListData2(){
        
        $aa = [
            ['id'=>'1','name'=>'台式电脑','note'=>'note','stock'=>'是','ship'=>'TNT','sdate'=>'2018-01-01'],
            ['id'=>'2','name'=>'笔记本电脑','note'=>'note','stock'=>'是','ship'=>'TNT','sdate'=>'2018-01-01'],
            ['id'=>'3','name'=>'液晶显示器','note'=>'note','stock'=>'是','ship'=>'TNT','sdate'=>'2018-01-01'],
            ['id'=>'4','name'=>'音箱','note'=>'note','stock'=>'是','ship'=>'TNT','sdate'=>'2018-01-01'],
            ['id'=>'5','name'=>'游戏机','note'=>'note','stock'=>'是','ship'=>'TNT','sdate'=>'2018-01-01'],
            ['id'=>'6','name'=>'移动电话','note'=>'note','stock'=>'是','ship'=>'TNT','sdate'=>'2018-01-01'],
            ['id'=>'7','name'=>'台式电脑','note'=>'note','stock'=>'是','ship'=>'TNT','sdate'=>'2018-01-01'],
            ['id'=>'8','name'=>'点阵式打印机','note'=>'note','stock'=>'是','ship'=>'TNT','sdate'=>'2018-01-01'],
            ['id'=>'9','name'=>'台式电脑','note'=>'note','stock'=>'是','ship'=>'TNT','sdate'=>'2018-01-01'],
            ['id'=>'10','name'=>'笔记本电脑','note'=>'note','stock'=>'是','ship'=>'TNT','sdate'=>'2018-01-01'],
            ['id'=>'11','name'=>'液晶显示器','note'=>'note','stock'=>'是','ship'=>'TNT','sdate'=>'2018-01-01'],
            ['id'=>'12','name'=>'音箱','note'=>'note','stock'=>'是','ship'=>'TNT','sdate'=>'2018-01-01'],
            ['id'=>'13','name'=>'液晶显示器','note'=>'note','stock'=>'是','ship'=>'TNT','sdate'=>'2018-01-01'],
            ['id'=>'14','name'=>'液晶显示器','note'=>'note','stock'=>'是','ship'=>'TNT','sdate'=>'2018-01-01'],
            ['id'=>'15','name'=>'液晶显示器','note'=>'note','stock'=>'是','ship'=>'TNT','sdate'=>'2018-01-01'],
            ['id'=>'16','name'=>'液晶显示器','note'=>'note','stock'=>'是','ship'=>'TNT','sdate'=>'2018-01-01']
        ];
        
        return response()->json(['draw'=>$_REQUEST['draw'],'recordsTotal'=>1000,'recordsFiltered'=>16,'data'=>$aa]);
//        return response()->json(['data'=>$aa,'page'=>$_REQUEST['page'],'totalPage'=>1000,'totalCount'=>16,'repeatitems'=>time(),'test'=>1000]);
    }

    public function getMenusListData(){
        $menu_list = $this->menuModel->findMenuList();
        return response()->json(['total'=>$menu_list['total'],'rows'=>$menu_list['data']]);
    }
    
    public function profile(){
        return view('admin.profile-view');
    }
    
    public function getMenuTreeList(){
        $res = $this->menuModel->getMenuSelect();
        return response()->json($res);
    }
}
