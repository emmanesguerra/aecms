<?php

namespace Core\Controller\Page;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Core\Resources\Page as PageResource;
use Core\Model\Page;
use Core\Model\Panel;
use Core\Model\PagePanel;
use Core\Library\Rules;
use Core\Library\HierarchicalDB;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::select('id', 'name', 'url', 'title', 'description',
                            'template', 'type', 'created_at', 'updated_at', 
                            'lft', 'rgt', 'lvl')->orderBy('lft', 'asc')->orderBy('id', 'asc')->get();
        $files = Storage::disk('templates')->allFiles();
        $javascripts = Storage::disk('javascripts')->allFiles();
        $styles = Storage::disk('css')->allFiles();
        $main = Panel::main()->get(['id', 'name']);
        $regular = Panel::regular()->get(['id', 'name']);
        
        $data = [
            'pages' => $pages,
            'templates' => [],
            'javascripts' => [],
            'styles' => [],
            'mainpanels' => $main->push(['id' => 'NEW', 'name' => 'Create New'])->toArray(),
            'regularpanels' => $regular->push(['id' => 'NEW', 'name' => 'Create New'])->toArray(),
        ];
        
        foreach($files as $file) {
            $data['templates'][] = $file;
        }
        
        foreach($javascripts as $javascript) {
            $data['javascripts'][] = $javascript;
        }
        
        foreach($styles as $style) {
            $data['styles'][] = $style;
        }
        
        return view('admin.mod.page.list')->with(compact('data'));
    }
    
    public function data()
    {        
        return PageResource::collection(Page::orderBy('id', 'desc')->get());
    }
    
    public function template(Request $request)
    {
        $file = Storage::disk('templates')->get($request->template);
        
        $pattern = '/\{!!(.*?)\!!}/';
        preg_match_all ($pattern, $file, $matches);
        
        $resp = collect($matches[1])->map(function($panels) {
             return [
                     'panel' => trim(str_replace('$', '', $panels)),
                     'name' => null,
                     'html_template' => null,
                     'isnew' => false,
                     'selected' => null
             ];
        });
        
        return response(['data'=> $resp], 200);
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
        $haserror = $this->validateRequest($request, 'insert', $merror, $perror);
        
        if($haserror) {
            return response([
                'merrors'=>$merror,
                'perrors'=>$perror,
                'icon'=> 'icon glyphicon glyphicon-remove-sign',
                'title'=> 'Action Terminated',
                'message' => 'Please double check the submitted data <br />',  
                'type' => 'danger'], 400);
        }
        
        $data = $request->except('model.id');
        $page = Page::create($data['model']);
        
        collect($request->panels)->map(function($panel, $key) use ($page) {
            return $this->savePanels($panel, $key, $page);
        });
        
        return response([
            'id'=>$page->id, 
            'icon'=> 'icon glyphicon glyphicon-ok-sign',
            'title'=> 'Action Completed',
            'message' => 'A new page has been created <br />', 
            'type' => 'success'], 201);
    }
    
    private function savePanels($panel, $key, $pdata)
    {
        if($panel['isnew']) {
            $data = Panel::create(collect($panel)->put('type', ($panel['panel'] == 'Main') ? 'M': 'P')->toArray());
        } else {
            $data = Panel::find($panel['name']);
        }
        
        PagePanel::updateOrCreate(['page_id' => $pdata->id, 'tags' => $panel['panel']], ['panel_id' => $data->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Page::find($id); 
        
        $panels = $page->panels->map(function ($panel) {
            return [
                     'panel' => $panel->pivot->tags,
                     'name' => $panel->pivot->panel_id,
                     'html_template' => $panel->html_template,
                     'isnew' => false,
                     'selected' => $panel->pivot->panel_id
             ];
        });
        
        return response([
            'model' => $page, 
            'panels'=> $panels], 200);
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
    public function update(Request $request)
    {
        $haserror = $this->validateRequest($request, 'update', $merror, $perror);
        
        if($haserror) {
            return response([
                'merrors'=>$merror,
                'perrors'=>$perror,
                'icon'=> 'icon glyphicon glyphicon-remove-sign',
                'title'=> 'Action Terminated',
                'message' => 'Please double check the submitted data <br />',  
                'type' => 'danger'], 400);
        }
        
        $page = Page::find($request->model['id']);
        $data = collect($request->model)->except('model.id')->toArray();
        $page->update($data);
        
        collect($request->panels)->map(function($panel, $key) use ($page) {
            return $this->savePanels($panel, $key, $page);
        });
        
        return response([
            'id'=>$page->id, 
            'icon'=> 'icon glyphicon glyphicon-ok-sign',
            'title'=> 'Action Completed',
            'message' => 'Page id# '.$page->id.' has been updated <br />', 
            'type' => 'success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Page::destroy($id);
        
        return response([],204);
    }
    
    private function validateRequest($request, $action, &$merror, &$perror)
    {
        if($action == 'insert') {
            $validations[] = Validator::make($request->model, Rules::PageInsert());
        } else {
            $validations[] = Validator::make($request->model, Rules::PageUpdate());
        }
        
        $validations[] = Validator::make($request->panels, Rules::PanelsInsert());
        $merror = [];
        $perror = null;
        $haserror = false;
        foreach($validations as $key => $validation) 
        {
            if ($validation->fails())
            {
                if($key) {
                    $perror = $validation->errors();
                } else {
                    $merror = $validation->errors();
                }
                $haserror = true;
            }
        }
        
        return $haserror;
    }
}
