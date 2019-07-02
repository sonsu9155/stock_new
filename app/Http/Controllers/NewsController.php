<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
class NewsController extends Controller
{
    //
    public function index(){
        $news = News::get();
        return view('bsb.news.index')->with(compact('news'));
    }
    public function create(){
       
        return view('bsb.news.create');
    }
    public function postCreate(Request $data){
        News::create([
            'type' => $data['type'],
            'subject' => $data['subject'],
            'contents' => $data['contents']
        ]);
        return redirect('/news');
    }

    public function edit($id){
        $news = News::find($id);
        return view('bsb.news.edit')->with(compact('news'));
    }

    public function update($id, Request $data){
        $input = $data->all();
        $news =News::findorfail($id);
        $update = $news->update($input);

        return redirect('/news');
    }

    public function delete($id){
        $news = News::findorfail($id);
        $news->delete($id);

        return redirect('/news');
    }
}
