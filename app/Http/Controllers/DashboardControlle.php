<?php

namespace App\Http\Controllers;
use Auth;

use Illuminate\Http\Request;

class DashboardControlle extends Controller
{
   /* public function __construct()
    {
        //$this->middleware(["auth"])->only("index"); //sauf la fonction inde
        //$this->middleware(["auth"])->except("index"); //all  sauf la fonction index
        $this->middleware(["auth"]); //all 
   }
   */
    public function index()
    {
        return view("dashboard.index");
    }
}
