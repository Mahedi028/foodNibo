<?php

namespace App\Http\Controllers\Backend;

use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Interfaces\CategoryInterface;
use Intervention\Image\Facades\Image;
use App\Http\Requests\Backend\AddCategoryRequest;
use App\Http\Requests\Backend\UpdateCategoryRequest;

class CategoryController extends Controller
{
    use ResponseTrait;
    protected $category;
    public function __construct(CategoryInterface $categoryInterface)
    {
        $this->category=$categoryInterface;
    }

    //---------------------------API---------------------//
    public function ShowAllCategories()
    {
        try{
            $categories=$this->category->getAllCategories();
            return $this->responseSuccess($categories,'Category Fetch Successfully',201);
        }catch(\Exception $e){
            return $this->responseError($e->getMessage(),'Error',401);
        }

    }

    public function MenuListByCategory()
    {
        try{
            $data=[];
            $categories=$this->category->getAllCategories();
            foreach($categories as $category){
                foreach($category->menus as $menu){

                }
                array_push($data,$category);
            }
            return $this->responseSuccess($data,'Data fetch success',201);
        }catch(\Exception $e){
            return $this->responseError($e->getMessage(),'Error',401);
        }
    }
    //---------------------------API---------------------//

    //---------------------------WEB----------------------//
    public function All()
    {
        $categories=$this->category->getAllCategories();
        return view('backend.category.category_view',compact('categories'));
    }//end of method

    public function Add()
    {
        return view('backend.category.category_add');
    }//end of method

    public function Store(AddCategoryRequest $request)
    {
        $data=[];
        //get all input values
        $data['name']=$request->input('name');
        $data['description']=$request->input('description');
        $data['active']=$request->input('active');
        $data['featured']=$request->input('featured');

        if($request->file('category_thumbnail')){
            //get the file
            $image=$request->file('category_thumbnail');
            //change image name
            $image_name=time().hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            //resize image
            Image::make($image)->resize(267,268)->save('upload/category/'.$image_name);
            //image url
            $image_url='http://127.0.0.1:8000/upload/category/'.$image_name;

            $data['category_thumbnail']=$image_url;
        }

        try{
            $this->category->createCategory($data);
            $notification=array(
                'message'=>'Category Added Successfully',
                'type'=>'success'
            );
            return redirect()->route('category.all')->with($notification);
        }catch(\Exception $e){
            $notification=array(
                'message'=>$e->getMessage(),
                'type'=>'danger'
            );
            return redirect()->back();
        }
    }//end of method

    public function Edit($id)
    {
        try{
            $category=$this->category->getCategoryById($id);
            return view('backend.category.category_edit',compact('category'));
        }catch(\Exception $e){
            $notification=array(
                'message'=>$e->getMessage(),
                'type'=>'danger'
            );
            return redirect()->back();
        }

    }//end of method

    public function Update(UpdateCategoryRequest $request, $id)
    {
        $data=[];
        //get all input values
        $data['name']=$request->input('name');
        $data['description']=$request->input('description');
        $data['active']=$request->input('active');
        $data['featured']=$request->input('featured');

        try{
            if($request->file('category_thumbnail')){
                $file=$request->file('category_thumbnail');
                $this->category->updateCategoryWithPhoto($id,$file);
            }
            $this->category->updateCategoryWithoutPhoto($id,$data);
            $notification=array(
                'message'=>'Category Update Successfully',
                'type'=>'success'
            );
            return redirect()->route('category.all')->with($notification);

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
            $this->category->deleteCategory($id);
            $notification=array(
                'message'=>'Category Deleted Successfully',
                'type'=>'success'
            );
            return redirect()->route('category.all')->with($notification);
        }catch(\Exception $e){
            $notification=array(
                'message'=>$e->getMessage(),
                'type'=>'success'
            );
            return redirect()->back();
        }
    }//end of method
}
//--------------------------web-----------------------------//

