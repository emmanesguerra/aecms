<?php

namespace App\Http\Controllers\Products\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCategory as ProductCategoryResource;
use App\Model\ProductCategory;
use App\Library\Rules;
use App\Library\Common;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    
    public function data()
    {        
        return ProductCategoryResource::collection(ProductCategory::orderBy('id', 'desc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), Rules::ProductCategoryInsert());

        if ($validation->fails())
        {
            return response([
                'errors'=>$validation->errors(),
                'icon'=> 'icon glyphicon glyphicon-remove-sign',
                'title'=> 'Action Terminated',
                'message' => 'Please double check the submitted data <br />',  
                'type' => 'danger'], 400);
        }
        
        try {
            DB::beginTransaction();
        
            $category = ProductCategory::create($request->only('name', 'short_description','description', 'image', 'sequence'));

            if($category->id) {
                if(!empty($category->image)) {
                    Common::MoveFiles('product_category', $category->image, $category->id);
                }
            }
            
            DB::commit();
            
            return response([
                'id'=>$category->id, 
                'icon'=> 'icon glyphicon glyphicon-ok-sign',
                'title'=> 'Action Completed',
                'message' => 'A new category record has been created <br />', 
                'type' => 'success'], 201);
            
        } catch (Exception $ex) {
            DB::rollback();
            return response([
                'icon'=> '<i class="material-icons" style="float: left; font-size: 3.5rem; margin: 15px 10px 15px 0;">error</i>',
                'title'=> 'Action Terminated',
                'message' => $ex->getMessage(),  
                'type' => 'danger'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ProductCategory::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = ProductCategory::find($id);
        
        if($category) {
            if(Storage::disk('product_category')->exists($category->id .'/'.$category->image)) {
                Storage::disk('product_category')->delete($category->id .'/'.$category->image);
            }
            ProductCategory::destroy($id);
        }
        
        return response([],204);
    }
    
    public function getCategoryOptions()
    {
        return ProductCategoryResource::collection(ProductCategory::select(['id', 'name'])->orderBy('id', 'desc')->get());
    }
}
