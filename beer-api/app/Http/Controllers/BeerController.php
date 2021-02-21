<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use Illuminate\Http\Request;
use App\Http\Requests\BeerRequest;


class BeerController extends Controller
{

    public function index()
    {   
        return view("beers",["data" => Beer::paginate(3)]);
    }

    public function index_guest()
    {   
        return view("guestbeers",["data" => Beer::paginate(3)]);
    }

    public function getBeer($id)
    {   
        $beers = new Beer;
        return view("getbeer",["data" => $beers->find($id)]);
    }

    public function getBeer_guest($id)
    {   
        $beers = new Beer;
        return view("guestbeerinfo",["data" => $beers->find($id)]);
    }

    public function updateBeerByID(BeerRequest $req,$id)
    {   
        $b = Beer::find($id);
        $b->name = $req->input('name');
        $b->description = $req->input('desc');
        $b->photo = $req->photo->hashName();
        $req->photo->store("public/images");
        $b->save();
        
        return redirect()->route("get-beer-by-id",$id)->with("success","Информация обновлена");
    }

    public function deleteBeerByID(Request $req,$id)
    {   
        $b = Beer::findOrFail($id);
        $b->delete();
        return route("beer-list");
    }

    public function addBeer(BeerRequest $req)
    {
        $b = new Beer();
        $b->name = $req->input('name');
        $b->description = $req->input('desc');
        $b->photo = $req->photo->hashName();
        $req->photo->store("public/images");
        $b->save();
        
        return redirect()->route("beer-list")->with("success","Пиво добавлено.");;
    }
    //
}
