<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ArticleController extends Controller
{

    public function welcome() {
    	return response()->json(["messages"=> "Helo Article"]);
    }
}
