<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Patrimoine;
use Illuminate\Support\Facades\Storage;
// use Intervention\Image\Facades\Image;
use Image;

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

        // $patrimoine->titre = $data['nompat'];
        // $patrimoine->description = $data['descpat'];
        // $patrimoine->typepat = $data['typepat'];
        // $patrimoine->entreprise = $data['entpat'];
        // $patrimoine->chefEquipe = $data['chfequippat'];
        // $patrimoine->pays = $data['payspat'];
        // $patrimoine->ville = $data['villepat'];
        // $patrimoine->latitude = $data['lat'];
        // $patrimoine->longitude = $data['lng'];
        // $patrimoine->echeance = $data['echeancepat'];
        // $patrimoine->idUser = $data['idUser'];

        $imagename = $req->file('imgpat');
        $input['imagename'] = time().'.'.$imagename->extension();
        $destinationPath = public_path().'/assets/img/PatImage' ;
        $img = Image::make($imagename->path());
        $img->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);

        // $imagename= $req->file('imgpat')->hashname();
        // Storage::disk('local')->put($imagename,file_get_contents($req->file('imgpat')));

        // $planname= $req->file('planfilepat')->hashname();
        // Storage::disk('local')->put($planname,file_get_contents($req->file('planfilepat')));

        $patrimoine->image=$imagename;
        // $patrimoine->plan=$planname;

        $patrimoine->save();
        return response()->json($patrimoine, 200 );
    }

    public function getpatrimoines(){

        $data=Patrimoine::all();
        return response()->json($data, 200 );
    }

    public function getOnepatrimoine($id){
        $patrimoine = DB::table('patrimoines')->where('id',$id)->get();
        return response()->json($patrimoine);
    }

    public function showcomment(Request $request, $slug)
    {
        $user = $request->user();
        return view('front.post', array_merge($this->postRepository->getPostBySlug($slug), compact('user')));
    }

    public function getPostBySlug($slug)
    {
        // Post for slug with user, tags and categories
        $patrimoine = $this->model
        ->with([
            'user' => function ($q) {
                $q->select('id', 'name', 'email');
            },
            'tags' => function ($q) {
                $q->select('tags.id', 'tag');
            },
            'categories' => function ($q) {
                $q->select('title', 'slug');
            }
        ])
        ->with(['parentComments' => function ($q) {
            $q->with('user')
                ->latest()
                ->take(config('app.numberParentComments'));
        }])
        ->withCount('validComments')
        ->withCount('parentComments')
        ->whereSlug($slug)
        ->firstOrFail();
        // Previous patrimoine
        $patrimoine->previous = $this->getPreviousPost($patrimoine->id);
        // Next patrimoine
        $patrimoine->next = $this->getNextPost($patrimoine->id);
        return compact('patrimoine');
    }

    public function commentsList(Patrimoine $patrimoine, $page)
    {
        $comments = $this->commentRepository->getNextComments($patrimoine, $page);
        $count = $patrimoine->parentComments()->count();
        $level = 0;
        // return [
        //     'html' => view('front/comments/comments', compact('post', 'comments', 'level'))->render(),
        //     'href' => $count <= config('app.numberParentComments') * ++$page ?
        //         'none'
        //         : route('posts.comments', [$patrimoine->id, $page]),
        // ];
        return response()->json($comments, 200 );
    }

    public function getNextComments(Patrimoine $patrimoine, $page)
    {
        return $patrimoine->parentComments()
            ->with('user')
            ->latest()
            ->skip($page * config('app.numberParentComments'))
            ->take(config('app.numberParentComments'))
            ->get();
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
