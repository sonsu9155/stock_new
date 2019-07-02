<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StockType;
use Alert;

class StockTypeController extends Controller
{
    //
    public function index() {
        $stockTypes = StockType::get();
        return view('bsb.stocktype.index')->with(compact('stockTypes'));   
    }

    public function create() {
        return view('bsb.stocktype.create');   
    }

    public function postCreate() {
        $code   = $_POST['code'];
        $option = $_POST['option'];
        $cnName = $_POST['cnName'];

        $newStockType = new StockType();
        $newStockType->code     = $code;
        $newStockType->option   = $option;
        $newStockType->cn_name   = $cnName;
        $newStockType->save();

        Alert::success('Success create Stock Type');
        return redirect('stocktype');
    }
    public function edit($id) {
        $stocktype = StockType::find($id);
        return view('bsb.stocktype.edit')->with(compact('stocktype'));   
    }
    public function update($id, Request $request) {
        $input = $request->all();
        $stocktype = StockType::findorfail($id);
        $updateNow = $stocktype->update($input);
        return redirect('/stocktype');

    }
    public function delete($id){      
        $stocktype = StockType::findorfail($id);
        $stocktype->delete($id);
        return redirect('/stocktype');
    }
}
