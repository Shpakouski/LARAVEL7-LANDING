<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if(view()->exists('admin.pages')){
            $pages = Page::all();
            $data = [
                'title' => 'Страницы',
                'pages' => $pages
            ];
            return view('admin.pages',$data);
        }
        abort(404);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //
        if(view()->exists('admin.pages_add')){
            $data = [
                'title' => 'Новая страница',
            ];
            return view('admin.pages_add',$data);
        }
        abort(404);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $input = $request->except('_token');
        $messages = [
            'required' => 'Поле :attribute обязательно к заполнению',
            'unique' => 'Такое имя :attribute уже занято',
            'max' => 'Поле :attribute должно быть не более :max символов',
        ];
        $validator = Validator::make($input,[
            'name' => 'required|max:255',
            'alias' => 'required|unique:pages|max:255',
            'text' => 'required'
        ],$messages);
        if($validator->fails()){
            return redirect()->route('admin.pages.create')->withErrors($validator)->withInput();
        }
        if($request->hasFile('images')){
            $file=$request->file('images');
            $input['images'] = $file->getClientOriginalName();
            $file->move(public_path()."/assets/img",$input['images']);
        }
        if(Page::create($input)){
            return redirect('admin')->with('status', 'Страница добавлена');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Page $page)
    {

        $old = $page->toArray();
        if(view()->exists('admin.pages_edit')){
            $data = [
                'title' => 'Редактирование страницы - '.$old['name'],
                'data' => $old
            ];
            return view('admin.pages_edit',$data);
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request,Page $page)
    {
        $input = $request->except(['_token','_method']);
        $messages = [
            'required' => 'Поле :attribute обязательно к заполнению',
            'unique' => 'Такое имя :attribute уже занято',
            'max' => 'Поле :attribute должно быть не более :max символов',
        ];
        $validator = Validator::make($input,[
            'name' => 'required|max:255',
            'alias' => 'required|unique:pages,alias,'.$input['id'].'|max:255',
            'text' => 'required'
        ],$messages);
        if($validator->fails()){
            return redirect()->route('admin.pages.edit',['page' => $input['id']])->withErrors($validator)->withInput();
        }
        if($request->hasFile('images')){
            $file=$request->file('images');
            $input['images'] = $file->getClientOriginalName();
            $file->move(public_path()."/assets/img",$input['images']);
        }else{
            $input['images'] = $input['old_images'];
        }
        unset($input['old_images']);

        $page->fill($input);
        if($page->update()){
            return redirect('admin')->with('status', 'Страница обновлена');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
