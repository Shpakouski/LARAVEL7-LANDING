<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => "Поле :attribute обязательно к заполнению",
            'email' => "Поле :attribute должно соответствовать email адресу"
        ];
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'text' => 'required'
        ], $messages);
        $data = $request->all();
        Mail::send('emails.email', ['data' => $data],
            function ($message) use ($data) {
                $mailAdmin = env('MAIL_ADMIN');
                $message
                    ->from($data['email'], $data['name'])
                    ->to($mailAdmin,'Vasya')->subject('Feedback');
            });
        if (!Mail::failures()) {
            return redirect()->route('index')->with('status', 'Email is send');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        if(!$id){
            abort(404);
        }
        if(view()->exists('page')){
            $page=Page::where('alias',strip_tags($id))->first();
            $data = [
                'title' => $page->name,
                'page' => $page,
            ];
            return view('page',$data);
        } else{
            abort(404);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
