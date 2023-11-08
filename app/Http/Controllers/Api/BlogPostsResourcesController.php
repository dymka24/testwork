<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SocialNetwork;
use App\Models\User;
use App\Models\UserList;
use Illuminate\Http\Request;

class BlogPostsResourcesController extends Controller
{
    public function index(){
        $lists=UserList::get(['id','name']);
        $users=User::whereHas('UserLists')->get(['id','name']);
        $networks=SocialNetwork::get(['id','name']);
        return response()->json(['success'=>true,...compact('lists','users','networks')]);
    }
}
