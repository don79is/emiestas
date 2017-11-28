<?php

namespace App\Http\Controllers;

use App\Models\VilniusList;
use Illuminate\Http\Request;

class VilniusListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

//        $query = $request->get('s');
//        if ($query){
//            $peoples = $query ? VilniusList::search($query)->paginate(10):VilniusList::all();
//
//            return view('list.index', compact('peoples'));
//        }
        $s = $request->input('s');
        $peoples = VilniusList::search($s)->paginate(10);

        return view('list.index', compact('peoples', 's'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        VilniusList::create($request->all());
        return redirect()->route('list.index')->with(['message' => 'Sąrašas pridėtas']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $peoples = VilniusList::findOrFail($id);
        return view('list.edit', compact('peoples'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $peoples = VilniusList::findOrFail($id);
        $peoples->update($request->all());
        return redirect()->route('list.index')->with(['message' => 'Įrašas pakeistas sėkmingai']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $peoples = VilniusList::findOrFail($id);
        $peoples->delete();
        return redirect()->route('list.index')->with(['message-delete' => 'Įrašas ištrintas']);
    }

    public function massDestroy(Request $request)
    {
        $peoples = explode(',', $request->input('ids'));
        foreach ($peoples as $people_id) {
            $people = VilniusList::findOrFail($people_id);
            $people->delete();
        }
        return redirect()->route('list.index');
    }
}
