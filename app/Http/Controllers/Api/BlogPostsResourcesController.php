<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\SocialNetwork;
use App\Models\User;
use App\Models\UserList;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BlogPostsResourcesController extends Controller
{
    public function index()
    {
        $lists = UserList::get(['id', 'name']);
        $users = User::whereHas('UserLists')->get(['id', 'name', 'email']);
        $networks = SocialNetwork::get(['id', 'platform']);
        return response()->json(['success' => true, ...compact('lists', 'users', 'networks')]);
    }

    public function posts()
    {
        $posts = Post::when($this->checkRequestField('list_id'), function ($q) {
            return $q->whereHas('User', function ($q) {
                return $q->whereHas('UserLists', function ($q) {
                    return $q->where('id', \request('list_id'));
                });
            })->when($this->checkRequestField('user_id'), function ($q) {
                return $q->whereHas('User', function ($q) {
                    return $q->where('id', \request('user_id'));
                });
            });
        })->when($this->checkRequestField('network_id'), function ($q) {
            return $q->where('social_network_id',\request('network_id'));
        })->when($this->checkRequestField('search_input'),function ($q){
            return $q->where(function ($q){
                $search_input=\request('search_input');
                return $q->where('title','LIKE',"%".$search_input."%")
                    ->orWhere('content','LIKE',"%".$search_input."%");
            });
        })->when($this->checkRequestField('start_date'),function ($q){
            return $q->whereDate('created_at','>=',\request('start_date'));
        })->when($this->checkRequestField('end_date'),function ($q){
            return $q->whereDate('created_at','<=',\request('end_date'));
        })->with('User')->get()->transform(function ($post) {
            $post->published_at = $post->created_at ? Carbon::parse($post->created_at)->format('d/m/Y') : '';
            return $post;
        });
        return response()->json(['success' => true, 'posts' => $posts]);

    }

    public function getUsers(){
        $users=User::when($this->checkRequestField('list_id'),function ($q){
            return $q->whereHas('UserLists', function ($q) {
                return $q->where('id', \request('list_id'));
            });
        })->get(['id','name','email']);
        return response()->json(['success' => true, 'users' => $users]);

    }

    private function checkRequestField(string $field): bool
    {

        return \request()->filled($field) && \request($field) !== 'all';
    }
}
