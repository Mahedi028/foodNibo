<?php

namespace App\Repositories;

use App\Models\Category;
use App\Interfaces\CategoryInterface;
use Intervention\Image\Facades\Image;

class CategoryRepository implements CategoryInterface
{
    public function getAllCategories()
    {
        return Category::all();
    }//end of method
    public function createCategory(array $data)
    {
        return Category::create($data);
    }//end of method

    public function categoryRelatedMenus($categoryName)
    {

    }//end of method

    public function getCategoryById($id)
    {
        return Category::findOrFail($id);
    }//end of method

    public function getCategoryByOrder()
    {

    }//end of method

    public function updateCategoryWithoutPhoto($id,array $data)
    {
        $category=Category::findOrFail($id);
        return $category->update([
            'name'=>$data['name'],
            'description'=>$data['description'],
            'active'=>$data['active'],
            'featured'=>$data['featured']
        ]);

    }//end of method

    public function updateCategoryWithPhoto($id,$data)
    {
        //find update category
        $category=Category::findOrFail($id);

        if(file_exists($category->category_thumbnail)){
            //if any photo exits in database
            unlink($category->category_thumbnail);
        }

        //get the file
        $image=$data;
        //change image name
        $image_name=time().hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        //resize image
        Image::make($image)->resize(128,128)->save('upload/category/'.$image_name);
        //image url
        $image_url='http://127.0.0.1:8000/upload/category/'.$image_name;

        return $category->update([
            'category_thumbnail'=>$image_url
        ]);

    }//end of method

    public function deleteCategory($id)
    {
        $category=Category::findOrFail($id);
        return $category->delete();
    }//end of method












}
?>
