<?php


namespace App\Controllers;


use App\Core\DataBase;
use App\Core\Page;

class AdminControllers
{
    public function index()
    {
        $data['data'] = DataBase::getAll("SELECT email, COUNT(tasks.user_id) 
                                                AS count FROM users 
                                                JOIN tasks 
                                                ON users.id = tasks.user_id 
                                                GROUP BY email;");
        $data['user'] = DataBase::getRow("SELECT * FROM `users` WHERE `id`='".$_SESSION['id']."'");
        Page::view('admin', 'home', $data);
        die();
    }

    public function showAllUsersAndTasksCount()
    {

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
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function show(Companies $companies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function edit(Companies $companies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Companies $companies)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Companies $companies)
    {
        //
    }
}