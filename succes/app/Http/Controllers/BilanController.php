<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Bilan;

class BilanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bilans=Bilan::all();

        return view('bilans.index',compact('bilans'));
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bilans=Bilan::findOrFail($id);
         return view('bilans.show', compact('bilans'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bilans=Bilan::findOrFail($id);
        return view('bilans.edit',compact('bilans'));
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
         $bilans=Bilan::findOrFail($id);
        $rules=[
            'obs'=>'required|min:3'
           // 'start'=>'bail|required',
           // 'status'=>'required|min:7'
        ];
        $this->validate($request,$rules);
      //  dd('store');
        $bilans->update([
           // 'title'=>$request->intitule,
           // 'start'=>$tarted,
          //  'status'=>$request->status,
            'obs'=>$request->obs
        ]);

       return redirect()->route('bilans.show',$id);

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
