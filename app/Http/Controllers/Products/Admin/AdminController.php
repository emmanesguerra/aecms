<?php

namespace App\Http\Controllers\Products\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Resources\Product as ProductResource;
use App\Model\Product;
use App\Library\Rules;
use App\Library\Common;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.admin.list');
    }
    
    public function data()
    {        
        return ProductResource::collection(Product::with('category')->orderBy('id', 'desc')->get());
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
        $validation = Validator::make($request->all(), Rules::ProductInsert());

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
        
            $product = Product::create($request->only('category_id', 'name', 'description', 'factory_price', 
                    'selling_price', 'stocks', 'is_bestseller', 'primary_image', 'alternative_image', 'sequence'));

            if($product->id) {
                if(!empty($product->primary_image)) {
                    Common::MoveFiles('products', $product->primary_image, $product->id);
                }
                if(!empty($product->alternative_image)) {
                    Common::MoveFiles('products', $product->alternative_image, $product->id);
                }
            }
            
            DB::commit();

            return response([
                'id'=>$product->id, 
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
        return Product::find($id);
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
        $product = Product::find($id);
        
        if($product) {
            if(Storage::disk('products')->exists($product->id .'/'.$product->primary_image)) {
                Storage::disk('products')->delete($product->id .'/'.$product->primary_image);
            }
            if(Storage::disk('products')->exists($product->id .'/'.$product->alternative_image)) {
                Storage::disk('products')->delete($product->id .'/'.$product->alternative_image);
            }
            Product::destroy($id);
        }
        
        return response([],204);
    }
    
    public function getProductOptions()
    {
        return ProductResource::collection(Product::select(['id', 'name'])->orderBy('id', 'desc')->get());
    }
}
