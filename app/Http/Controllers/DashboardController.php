<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    /* Single Action Controllers
    If a controller action is particularly complex, 
    you might find it convenient to dedicate an entire controller class to that single action. To accomplish this, 
    you may define a single __invoke method within the controller: */
    public function __invoke()
    {
        return view('dashboard');
    }
}
