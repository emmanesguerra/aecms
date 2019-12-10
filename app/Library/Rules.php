<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rules
 *
 * @author AE
 */
namespace App\Library;

class Rules {
    //put your code here
    public static function SliderInsert()
    {
        return [
            'header' => 'nullable|max:50',
            'description' => 'nullable',
            'image' => 'nullable',
            'sequence' => 'nullable|numeric'
        ];
    }
    
    public static function SliderUpdate()
    {        
        return [
            'id' => 'required|exists:sliders,id',
            'header' => 'nullable|max:50',
            'description' => 'nullable',
            'image' => 'nullable',
            'sequence' => 'nullable|numeric'
        ];
    }
    
    public static function ProductCategoryInsert()
    {
        return [
            'name' => 'required|max:50',
            'short_description' => 'required',
            'description' => 'required',
            'image' => 'required|max:80',
            'sequence' => 'nullable|numeric'
        ];
    }
    
    public static function ProductInsert()
    {
        return [
            'category_id' => 'required|exists:product_categories,id',
            'name' => 'required|max:50',
            'description' => 'required',
            'factory_price' => 'required',
            'selling_price' => 'required',
            'stocks' => 'nullable',
            'is_bestseller' => 'boolean',
            'primary_image' => 'required|max:80',
            'alternative_image' => 'required|max:80',
            'sequence' => 'nullable|numeric'
        ];
    }
}
