<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Patrimoine;
use Illuminate\Support\Facades\Storage;

class ControllerPatrimoine extends Controller
{
    //  /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function liste()
    // {
    //     $games = Patrimoine::all();

    //     return view('liste-patrimoine',compact('patrimoine'));
    // }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('add-patrimoine');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $req)
    {
        $data = $req->input();
        $patrimoine = new Patrimoine;

        $patrimoine->titre = $data['nompat'];
        $patrimoine->description = $data['descpat'];
        $patrimoine->typepat = $data['typepat'];
        $patrimoine->entreprise = $data['entpat'];
        $patrimoine->chefEquipe = $data['chfequippat'];
        $patrimoine->pays = $data['payspat'];
        $patrimoine->ville = $data['villepat'];
        $patrimoine->latitude = $data['lat'];
        $patrimoine->longitude = $data['lng'];
        $patrimoine->echeance = $data['echeancepat'];
        $patrimoine->idUser = $data['idUser'];

        $imagename= $req->file('imgpat')->hashname();
        Storage::disk('local')->put($imagename,file_get_contents($req->file('imgpat')));

        $planname= $req->file('planfilepat')->hashname();
        Storage::disk('local')->put($imagename,file_get_contents($req->file('planfilepat')));

        $patrimoine->image=$imagename;
        $patrimoine->plan=$planname;

        $patrimoine->save();
        return response()->json($patrimoine, 200 );
    }

    public function getpatrimoines(){

        $data=Patrimoine::all();
        return response()->json($data, 200 );
    }



    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     $game = Patrimoine::findOrFail($id);

    //     return view('edit-patrimoine', compact('patrimoine'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     $validatedData = $request->validate([
    //         'name' => 'required|max:255',
    //         'price' => 'required'
    //     ]);
    //     Patrimoine::whereId($id)->update($validatedData);

    //     return redirect('/liste-patrimoine')->with('success', 'Patrimoine Data is successfully updated');
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     $game = Patrimoine::findOrFail($id);
    //     $game->delete();

    //     return redirect('/liste-patrimoine')->with('success', 'Patrimoine Data is successfully deleted');
    // }
}
