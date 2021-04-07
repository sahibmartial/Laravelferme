<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Campagne;
use DB;
use App\Model\Apport;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CampagneController;
use Illuminate\Support\Str;
class ApportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $cam  = new CampagneController();
      //  dd($cam->apports());
       // $query = DB::table('apports')->orderBy('id');
      // $campagnes= Apport::all()->sortByDesc('id');
      $apports= Apport::select()
      ->orderByDesc('id')
       ->simplePaginate(10);
        //dd($campagnes);
        //->simplePaginate(2);
        return view('campagnes.index_apport',compact('apports'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('campagnes.comptable');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->obs);
        //get id de campagne

        if (Auth::check()) {
        $cam  = new CampagneController();
        $campagne_id = $cam->getIntituleCampagneenCours(Str::lower($request->campagne));
       // dump($request->campagne);

        //dd($request,' here Apport ADD',$campagne_id);
        $tarted=date("Y-m-d ");

        $rules=[
          'campagne'=>'bail|required',
          'apport'=>'bail|required',
          'obs'=>'bail|required'
        ];
        
       $this->validate($request,$rules);
      // dd('store');
       Apport::create([
           'campagne_id'=>$campagne_id,
           'campagne'=>Str::lower($request->campagne),
           'apport'=>$request->apport,
           'obs'=>$request->obs
       ]);

        //notification email get current user
        
        $to_name= auth()->user()['name'];
        $to_email=auth()->user()['email'];
        $mail= new MailController;
        $subject="Apport de ".$request->apport." F CFA, à la campagne ".$request->campagne ;
        $content="Votre apport a été crée avec succes";
       $mail->send($to_email,$to_name,$subject,$content);
       return redirect()->route('apports.index')->with('success', 'Apport ajouté avec sucess');     
    }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //dd($id,'here');

        $apports=Apport::findOrFail($id);
        //dd($apport);
       // $som=$cam->sumApportsOfcampagne($id);
         return view('campagnes.show_apport', compact(['apports']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $apports=Apport::findOrFail($id);
        return view('campagnes.edit_apport',compact('apports'));
        
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
        //dd($request);
        //dd($request['budget'],$id);
        $apports=Apport::findOrFail($id);
        $rules=[
            'campagne'=>'required|min:9',
            'budget'=>'bail|required',
            'obs'=>'bail|required'
        ];
        $this->validate($request,$rules);
      //  dd('store');
        $apports->update([
            'campagne'=>Str::lower($request->campagne),
            'budget'=>$request->budget,
            'obs'=>$request->obs
        ]);

        return redirect()->route('apports.show',$id)->with('success', 'Apport modifiée avec succes.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         
        Apport::destroy($id);

        return back()->with('success', 'Apport a bien été supprimée.');
    }



}
