<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Patrimoine;

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
    public function save(Request $request)
    {
        $validatedData = $request->validate([

            'nompat' => 'required',
            'descpat' => 'required|max:500',
            'typepat' => 'required',
            'entpat' => 'required',
            'chfequippat' => 'required',
            'imgpat' => 'required',
            'planfilepat' => 'required',
            'payspat' => 'required',
            'villepat' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'echeancepat' => 'required',
        ]);

        $data = $request->input();
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
        $patrimoine->dateDebut = $data['echeancepat'];


        // Handle Image file Upload
        $file = $request->file('imgpat') ;
        $fileName = $file->getClientOriginalName() ;
        $destinationPath = public_path().'/assets/img/PatImage' ;
        $file->move($destinationPath,$fileName);
        $patrimoine->image = $fileName;

        // Handle Image file Upload
        $file1 = $request->file('planfilepat') ;
        $fileName1 = $file1->getClientOriginalName() ;
        $destinationPath1 = public_path().'/assets/img/PlanFile' ;
        $file1->move($destinationPath1,$fileName1);
        $patrimoine->plan = $fileName1;
        

        $patrimoine->save();
        $request->session()->flash('success','Patrrimoine is successfully saved');
        return redirect('/add-patrimoine');
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
