<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vote;

class VoteController extends Controller
{
    public function showAll(){
        return view('index', ['votes' => Vote::paginate(5)]);
    }
    public function create(Request $req){
        $vote = new Vote;
        $vote->title = $req->title;
        $vote->text = $req->text;
        if (isset($req->url)){
            $vote->url = $req->url;
        }
        $vote->views = 0;
        $vote->positive = 0;
        $vote->negative = 0;
        $vote->save();

        return redirect('/');
    }
    public function showID($id){
        $vote = Vote::find($id);
        return view('show_vote', ['vote' => $vote]);
    }
    public function increasePositive($id){
        $vote = new Vote;
        $vote = Vote::find($id);
        $vote->positive++;
        $vote->save();
        return back();            
    }
    public function increaseNegative($id){
        $vote = new Vote;
        $vote = Vote::find($id);
        $vote->negative++;
        $vote->save();
        return back();            
    }
    public function delete($id){
        $vote=Vote::destroy($id);
        return back();            
    }
}
