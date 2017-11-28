<?php

namespace App\Http\Controllers;

use App\Models\VilniusList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class UploadController extends Controller
{

    public function importExport()
    {
        return view('importExport');
    }
    public function downloadExcel($type)
    {
        $data = VilniusList::get()->toArray();
        return Excel::create('laravelcode', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
    public function importExcel(Request $request)
    {
        if($request->hasFile('import_file')){
            Excel::load($request->file('import_file')->getRealPath(), function ($reader) {
                foreach ($reader->toArray() as $key => $row) {
                    $data['gimimo_metai'] = $row['gimimo_metai'];
                    $data['gimimo_valstybe'] = $row['gimimo_valstybe'];
                    $data['lytis'] = $row['lytis'];
                    $data['seimos_padetis'] = $row['seimos_padetis'];
                    $data['kiek_turi_vaiku'] = $row['kiek_turi_vaiku'];
                    $data['seniunija'] = $row['seniunija'];
                    $data['gatve'] = $row['gatve'];
                    $data['seniunnr'] = $row['seniunnr'];
                    $data['ter_rej_kodas'] = $row['ter_rej_kodas'];
                    $data['gatv_k'] = $row['gatv_k'];
                    $data['gat_id'] = $row['gat_id'];

                    if(!empty($data)) {
                        DB::table('vilnius_lists')->insert($data);
                    }
                }
            });
        }

        Session::put('success', 'Jūsų filas sėkmingai įkeltas į duombazę!!!');

        return back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        return view('list.upload');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
