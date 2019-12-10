<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Core\Library;

/**
 * Description of HierarchicalDB
 *
 * @author ai
 */
use Illuminate\Support\Facades\DB;

class HierarchicalDB {

    //put your code here
    protected $table;
    
    public function __construct($table) {
        $this->table = $table;
    }

    public static function rebuild_tree($parent_id, $left) {
        // the right value of this node is the left value + 1   
        $right = $left + 1;

        // get all children of this node   
        $result = DB::table($this->table)
                        ->select('id')
                        ->where('parent_id', $parent_id)
                        ->get();
        
        foreach ($result as $res => $data) {
            // recursive execution of this function for each   
            // child of this node   
            // $right is the current right value, which is   
            // incremented by the rebuild_tree function  
            $right = rebuild_tree($data->id, $right);
        }

        
        // we've got the left value, and now that we've processed   
        // the children of this node we also know the right value  
        DB::table($this->table)
                ->update(['lft' => $left, 'rgt' => $right])
                ->where('parent_id', $parent_id);
            
        // return the right value of this node + 1 
        return $right + 1;
    }
    
    public static function update_left_rigth($parent_id)
    {
        DB::table($this->table)
                ->update('rgt', DB::raw('rgt+2'))
                ->where('rgt', '>', $parent_id);
        
        DB::table($this->table)
                ->update('lft', DB::raw('lft+2'))
                ->where('lft', '>', $parent_id);
    }
    
    public static function insert_to_tree($id, $left)
    {
        $right = $left + 1;
        DB::table($this->table)
                ->update(['lft' => $left, 'rgt' => $right])
                ->where('id', $id);
    }
}
