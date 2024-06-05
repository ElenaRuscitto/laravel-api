<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function index() {

    $count_project = Project::count();
    $last_project = Project::orderBy('id', 'desc')->first();
    return view('admin.home', compact('count_project', 'last_project'));
   }
}
