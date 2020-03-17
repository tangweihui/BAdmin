<?php

namespace App\Http\Controllers\Admin;

use App\Model\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    /**
     * 分类列表
     * 2020/3/16
     * beeno.tang
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function list(Request $request)
    {
        $wd   = $request->input('wd');
        $list = Categories::where('pid', 0)->filter(['keyword' => $wd])->paginate(10);
        return view('admin.category', ['list' => $list, 'wd' => $wd]);
    }

    /**
     * 添加分类视图
     * 2020/3/16
     * beeno.tang
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function addView(Request $request)
    {
        $categories = Categories::where('pid', 0)->get();
        return view('admin.category_add', ['categories' => $categories]);
    }


    /**
     * @Desc: 添加分类
     * @Date: 2020/3/16
     * @Author: beeno.tang
     * @param Request $request
     * @return mixed
     */
    public function add(Request $request)
    {
        $cate = new Categories();
        $cate->fill($request->all());
        if($cate->save())
            return $this->json(200, '添加成功');
        return $this->json(9999, '添加失败');
    }


    /**
     * @Desc: 修改分类视图
     * @Date: 2020/3/16
     * @Author: beeno.tang
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function updateView(Request $request, $id)
    {
        return view('admin.category_update', ['categories' => Categories::where('pid', 0)->get(), 'data' => Categories::find($id)]);
    }

    /**
     * @Desc: 编辑分类
     * @Date: 2020/3/16
     * @Author: beeno.tang
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $config = Categories::findOrFail($id);
        $data   = $request->post();
        $config->fill($data);
        if($config->save())
            return $this->json(200, '修改成功');
        return $this->json(9999, '修改失败');
    }

    /**
     * @Desc: 删除分类
     * @Date: 2020/3/16
     * @Author: beeno.tang
     * @param $id
     * @return mixed
     */
    public function del($id)
    {
        $categories = Categories::find($id);
        if(count($categories->children))
            return $this->json(9998, '有子级分类不可删除');

        if($categories->delete())
            return $this->json(200, '删除成功');
        return $this->json(9999, '删除失败');

    }
}
