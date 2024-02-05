<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Interfaces\MenuInterface;
use App\Http\Controllers\Controller;
use App\Interfaces\CategoryInterface;
use Intervention\Image\Facades\Image;
use App\Http\Requests\Backend\AddMenuRequest;
use App\Http\Requests\Backend\UpdateMenuRequest;

class MenuController extends Controller
{
    use ResponseTrait;
    protected $menu;
    protected $category;
    public function __construct(
        MenuInterface $menuInterface,
        CategoryInterface $categoryInterface
        )
    {
        $this->menu=$menuInterface;
        $this->category=$categoryInterface;
    }

    //---------------------api------------------//
    public function ShowAllMenus()
    {
        try{
            $menus=$this->menu->getAllMenus();
            return $this->responseSuccess($menus,'All menus fetched',201);
        }catch(\Exception $e){
            return $this->responseError($e->getMessage(),'Error',401);
        }
    }//end of method

    public function MenuDetails($id)
    {
        try{
            $menu=$this->menu->getMenuById($id);
            return $this->responseSuccess($menu,'All menus fetched',201);
        }catch(\Exception $e){
            return $this->responseError($e->getMessage(),'Error',401);
        }
    }//end of method
    //---------------------api------------------//

    public function All()
    {
        $menus=$this->menu->getAllMenus();
        return view('backend.menu.menu_view',compact('menus'));
    }//end of method

    public function Add()
    {
        $categories=$this->category->getAllCategories();
        return view('backend.menu.menu_add',compact('categories'));
    }//end of method

    public function Store(AddMenuRequest $request)
    {
        //get all input values
        $data=[];
        $data['title']=$request->input('title');
        $data['description']=$request->input('description');
        $data['price']=$request->input('price');
        $data['discount_price']=$request->input('discount_price');
        $data['ingredients']=$request->input('ingredients');
        $data['dietary_info']=$request->input('dietary_info');
        $data['in_stock']=intval($request->input('in_stock'));
        $data['active']=intval($request->input('active'));
        $data['category_id']=$request->input('category_id');

        if($request->file('meal_thumbnail')){
            //get the file
            $image=$request->file('meal_thumbnail');
            //change image name
            $image_name=time().hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            //resize image
            Image::make($image)->resize(500,500)->save('upload/menu/'.$image_name);
            //image url
            $image_url='http://127.0.0.1:8000/upload/menu/'.$image_name;

            $data['meal_thumbnail']=$image_url;
        }
        if($request->file('meal_img1')){
            //get the file
            $image1=$request->file('meal_img1');
            //change image name
            $image1_name=time().hexdec(uniqid()).'.'.$image1->getClientOriginalExtension();
            //resize image
            Image::make($image1)->resize(128,128)->save('upload/menu/'.$image1_name);
            //image url
            $image1_url='http://127.0.0.1:8000/upload/menu/'.$image1_name;

            $data['meal_img1']=$image1_url;
        }
        if($request->file('meal_img2')){
            //get the file
            $image2=$request->file('meal_img2');
            //change image name
            $image2_name=time().hexdec(uniqid()).'.'.$image2->getClientOriginalExtension();
            //resize image
            Image::make($image2)->resize(128,128)->save('upload/menu/'.$image2_name);
            //image url
            $image2_url='http://127.0.0.1:8000/upload/menu/'.$image2_name;

            $data['meal_img2']=$image2_url;
        }
        if($request->file('meal_img3')){
            //get the file
            $image3=$request->file('meal_img3');
            //change image name
            $image3_name=time().hexdec(uniqid()).'.'.$image3->getClientOriginalExtension();
            //resize image
            Image::make($image3)->resize(128,128)->save('upload/menu/'.$image3_name);
            //image url
            $image3_url='http://127.0.0.1:8000/upload/menu/'.$image_name;

            $data['meal_img3']=$image3_url;
        }

        try{
            $this->menu->addMenu($data);
            $notification=array(
                'message'=>'Menu Added Successfully',
                'type'=>'success'
            );
            return redirect()->route('menu.all')->with($notification);
        }catch(\Exception $e){
            $notification=array(
                'message'=>$e->getMessage(),
                'type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
    }//end of method

    public function Edit($id)
    {
        $menu=$this->menu->getMenuById($id);
        $categories=$this->category->getAllCategories();
        return view('backend.menu.menu_edit',compact('menu','categories'));
    }//end of method

    public function Update(UpdateMenuRequest $request,$id)
    {
        $existing_menu=$this->menu->getMenuById($id);
        //get all input values
        $data=[];
        $data['title']=$request->input('title')?$request->input('title'):$existing_menu->title;
        $data['description']=$request->input('description')?$request->input('description'):$existing_menu->description;
        $data['price']=$request->input('price')?$request->input('price'):$existing_menu->price;
        $data['discount_price']=$request->input('discount_price')?$request->input('discount_price'):$existing_menu->discount_price;
        $data['ingredients']=$request->input('ingredients')?$request->input('ingredients'):$existing_menu->ingredients;
        $data['dietary_info']=$request->input('dietary_info')?$request->input('dietary_info'):$existing_menu->dietary_info;
        $data['in_stock']=intval($request->input('in_stock'))?intval($request->input('in_stock')):$existing_menu->in_stock;
        $data['active']=intval($request->input('active'))?intval($request->input('active')):$existing_menu->active;
        $data['category_id']=$request->input('category_id')?$request->input('category_id'):$existing_menu->category_id;

        if($request->file('meal_thumbnail')){
            //get the file
            $image=$request->file('meal_thumbnail');
            //change image name
            $image_name=time().hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            //resize image
            Image::make($image)->resize(500,500)->save('upload/menu/'.$image_name);
            //image url
            $image_url='http://127.0.0.1:8000/upload/menu/'.$image_name;

            $data['meal_thumbnail']=$image_url;
        }
        if($request->file('meal_img1')){
            //get the file
            $image1=$request->file('meal_img1');
            //change image name
            $image1_name=time().hexdec(uniqid()).'.'.$image1->getClientOriginalExtension();
            //resize image
            Image::make($image1)->resize(128,128)->save('upload/menu/'.$image1_name);
            //image url
            $image1_url='http://127.0.0.1:8000/upload/menu/'.$image1_name;

            $data['meal_img1']=$image1_url;
        }
        if($request->file('meal_img2')){
            //get the file
            $image2=$request->file('meal_img2');
            //change image name
            $image2_name=time().hexdec(uniqid()).'.'.$image2->getClientOriginalExtension();
            //resize image
            Image::make($image2)->resize(128,128)->save('upload/menu/'.$image2_name);
            //image url
            $image2_url='http://127.0.0.1:8000/upload/menu/'.$image2_name;

            $data['meal_img2']=$image2_url;
        }
        if($request->file('meal_img3')){
            //get the file
            $image3=$request->file('meal_img3');
            //change image name
            $image3_name=time().hexdec(uniqid()).'.'.$image3->getClientOriginalExtension();
            //resize image
            Image::make($image3)->resize(128,128)->save('upload/menu/'.$image3_name);
            //image url
            $image3_url='http://127.0.0.1:8000/upload/menu/'.$image_name;

            $data['meal_img3']=$image3_url;
        }
        try{
            $this->menu->updateMenu($id,$data);
            $notification=array(
                'message'=>'Menu Update Successfully',
                'type'=>'success'
            );
            return redirect()->route('menu.all')->with($notification);
        }catch(\Exception $e){
            $notification=array(
                'message'=>$e->getMessage(),
                'type'=>'danger'
            );
            return redirect()->back();
        }

    }//end of method

    public function Delete($id)
    {
        try{
            $this->menu->deleteMenu($id);
            $notification=array(
                'message'=>'Menu Deleted Successfully',
                'type'=>'success'
            );
            return redirect()->route('menu.all')->with($notification);
        }catch(\Exception $e){
            $notification=array(
                'message'=>$e->getMessage(),
                'type'=>'error'
            );
            return redirect()->back()->with($notification);
        }

    }//end of method
}
