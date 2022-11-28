<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestRequest;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class TestController extends Controller
{
    private $v;
    public function __construct()
    {
        $this->v =[];
    }
    //danh sách người dùng
    public function index(Request $request) {
        //echo "hello wolrd";
        $test = new Test();
       $this->v['title'] = "ABC";
       $this->v['extParams'] = $request->all();
       $this->v['list'] = $test->loadListWithPager($this->v['extParams']);
        return view("test.index",$this->v);
    }
    // tao 1 phuong thuc bat ky hien thi len ten cua minh
    // tao url o route goi den phuong thuc
    public function add(TestRequest $request) {
        //tạo ra 1 file request viết validate mọi thứ trong đayá
        // php artisan make:request NameRequest
        $method_route = "route_BackEnd_Test_add";
        $this->v['_title'] = "Thêm người dùng";
        if ($request->isMethod('post')) {
          //  dd($request->post());//đống data post gửi sang
            $params = [];
            $params['cols'] = $request->post();
            unset( $params['cols']['_token']);
         //   dd($params['cols']);
            if ($request->hasFile('cmt_mat_truoc') && $request->file('cmt_mat_truoc')->isValid())
            {
                $params['cols']['hinh'] = $this->uploadFile($request->file('cmt_mat_truoc'));
            }
            $modelTes = new Test();
            $res = $modelTes->saveNew($params);
            if ($res == null) {
                return  redirect()->route($method_route);
            } elseif ($res > 0) {
                Session::flash('success','Thêm mới thành công người dùng');
            } else {
                Session::flash('error','Lỗi thêm mới người dùng ');
            }
        }
        return view('test.add',$this->v);
    }
    public function detail($id, Request $request) {
        $this->v['_title'] = "Chi tiết người dùng";
        $modelNguoiDung = new Test();
        $objItem = $modelNguoiDung->loadOne($id);
        $this->v['objItem'] = $objItem;
        return view('test.detail',$this->v);
    }
    public function update($id, TestRequest $request) {

        $method_route = 'route_BackEnd_Test_Detail';
        $params = [];

        $params['cols'] = $request->post();


        unset( $params['cols']['_token']);
        $params['cols']['id'] = $id;
        if (!is_null( $params['cols']['password'])) {
            $params['cols']['password'] = Hash::make($params['cols']['id']);
        }

        $modelNguoiDung = new Test();
        $res = $modelNguoiDung->saveUpdate($params);
        if ($res == null) {
            return redirect()->route($method_route,['id'=>$id]);
        } elseif ($res == 1) {
            Session::flash('success','Cập nhât bản ghi'.$id."Thành công");
            return redirect()->route($method_route,['id'=>$id]);
        } else {
            Session::flash('error','Lỗi cập nhât bản ghi'.$id);
            return redirect()->route($method_route,['id'=>$id]);
        }
    }
    public function uploadFile($file) {
        $fileName = time().'_'.$file->getClientOriginalName();
        return $file->storeAs('cmnd',$fileName,'public');
    }
}

