<?php

namespace App\Http\Controllers;
use App\Model\Employe;
use Illuminate\Http\Request;

class EmployeController extends Controller
{


    public function index(){
    //  dd('here');
      //return view('employes.index');
        $employes=Employe::all();

        return view('employes.index',compact('employes'));
   }

   /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("employes.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    $rules=[
         'name'=>'bail|required',   
         'email'=>'bail|required|email',
         'contact'=>'bail|required',
         'genre'=>'bail|required'
         //'fournisseur'=>'required|min:4',
        // 'obs'=>'required|min:3'
     ];
        $this->validate($request,$rules);


        Employe::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'contact'=>$request->contact,
            'genre'=>$request->genre
            //'fournisseur'=>$request->fournisseur,
            //'obs'=>$request->obs
        ]);

        return redirect()->route('employes.index'); 

    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employes=Employe::findOrFail($id);
        return view('employes.show',compact('employes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employes=Employe::findOrFail($id);
        return view('employes.edit',compact('employes'));
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
       $employes=Employe::findOrFail($id);
         $rules=[
         'name'=>'bail|required',  
         'email'=>'bail|required|email',
         'contact'=>'bail|required',
         'genre'=>'bail|required'
         //'acheteur'=>'required|min:4',
         //'events'=>'required|min:4',
         //'obs'=>'required|min:3'
     ];
        $this->validate($request,$rules);

        
       $employes->update([

            'name'=>$request->name,
            'email'=>$request->email,
            'contact'=>$request->contact,
            'genre'=>$request->genre
          //  'acheteur'=>$request->acheteur,
          //  'contact'=>$request->contact,
         //   'events'=>$request->events,
          //  'obs'=>$request->obs
    ]);

      
        return redirect()->route('employes.show',$id); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employe::destroy($id);
        return redirect()->route('employes');
    }

   /*
   AJAX request
   */
   public function getEmployes(Request $request){

      $search = $request->name;
      dd($search);

      if($search == ''){
         $employees = Employe::orderby('name','asc')->select('id','name')->limit(5)->get();
         //dd($employees);
      }else{
         $employees = Employe::orderby('name','asc')->select('id','name')->where('name', 'like', '%' .$search . '%')->limit(5)->get();
        // dd($employees);
      }
  
      $response = array();
      foreach($employees as $employee){
         $response[] = array("value"=>$employee->id,"label"=>$employee->name);
      }

      //dd($response);

      return response()->json($response);
   }

  public function createposts()
{
  return View::make('employes.createposts');
}

}
