<?php

namespace App\Http\Controllers;
use App\Notifications\WelcomeNotification;
use App\Mail\News;
use Illuminate\Http\Request;

use App\Models\User;
//use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use Notification;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::first();
//
//        $post = [
//            'title' => 'post title',
//            'slug' => 'post-slug'
//        ];
//
//        Notification::send($users, new WelcomeNotification($post));

//        foreach ($users as $user){
//            dd('test');
            //dd($post);
//            $user->notify(new WelcomeNotification($post));
//            Notification::route('/home', $post)->notify(new WelcomeNotification($post));
//        }

//        dd('ok');

        $details = [
          'title' => 'Mail from test',
          'body' => 'This is a test mail body.'
        ];

        Mail::to($users->mail)->send(new News($details));
        dd('done');
        return view('dashboard');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }
}
