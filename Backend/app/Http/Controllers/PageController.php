<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        $pages = Page::all();
      
        return view('pages.show', compact('pages'));
    }
    public function show($id){
        $page=Page::findOrFail($id);
       
        return view('pages.show', compact('page'));
    }
}