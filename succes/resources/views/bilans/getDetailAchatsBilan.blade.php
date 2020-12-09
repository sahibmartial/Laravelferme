<?php 
use App\Campagne;
use App\Http\Controllers\CampagneController;
use App\Http\Controllers\AccessoireController;
use App\Http\Controllers\AlimentController;
use App\Http\Controllers\PoussinController;
use App\Http\Controllers\TransportController;

$campagne =$_POST['campagne'];

  //$resultcampagne = array('id'=>'','intitule'=>'','status'=>'','date-creation'=>'');
//echo "string";
$cam= new CampagneController();
$acess= new AccessoireController();
$food= new AlimentController();
$head= new PoussinController();
$transport= new TransportController();
 $campagne_id=0;

 $id=$cam->getCampagneenCours();//retourne ttes  les campagnes en cours

 for ($i=0; $i <$id->count(); $i++) { 
  //dump($id[$i]->id);
   $result[]=$id[$i]->intitule;
 }
 //$var= $id->toJson();
 


 $resultcampagne=$cam->getInfosOneCampagneEnCours($campagne);//retoutrne infos de la campgne en question

  
  // dd($resultcampagne);


       $campagne_id=$cam->getIntituleCampagneenCours(Str::lower($campagne));

       $resultsacces=$acess->selectAllAccessoireforthisCampagne($campagne_id);

       $totalacces=$acess->calculateDepenseAccessoireofthiscampagne($campagne_id);

       
       $resultsaliment=$food->selectAllAlimentforthisCampagne($campagne_id);

       $totalfood=$food->calculateDepenseAlimentofthiscampagne($campagne_id);


       $qtyhead=$head->selectheadForOneCampagne($campagne_id);

       $totalfrais=$transport->calculateFraisTotalOfCampagne($campagne_id);
      //dd($totalfrais);
      // $totalfood=$food->calculateDepenseAlimentofthiscampagne($campagne_id);

      // dump($results);
    //   dd($total);

  ?>

{{--dump($totalacces)--}}
{{--dump($qtyhead)--}}
{{--dump($totalfrais)--}}
{{--dump($totalfood)--}}
@extends('layout.partials.template_bilanencours')
@section('content')

   <div class="row">
        <div class="col-lg-11">
                <h2 class = "text-center">Detail Campagne</h2>
        </div>
        <hr>
        <div class="col-lg-1">
            <a class="btn btn-success" href="{{route('bilan_achats')}}">Show</a>
            <hr>
            <a class="btn btn-success" href="/achats">retour Achats</a>
        </div>
    </div>
 
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
 
    <table class="table table-bordered">
        <tr>
            <th>Date-Creation</th> 
            <th>Nom</th>
            <th>Satus</th>
             <th>Quantite-Poussins</th>
            <th>T_accessoires</th>
            <th>T_Aliments</th>
            <th>T_tranport</th>
            <th>T_Achats</th>
            <!--<th width="280px">Action</th>-->
        </tr>
            <tr>
                <td>{{ $resultcampagne['start']}}</td>
                <td>{{ $resultcampagne['intitule']}}</td>
                <td>{{ $resultcampagne['status'] }}</td>
                <td>{{ $qtyhead }}</td>
                <td>{{ $totalacces }}</td>
                <td>{{ $totalfood }}</td>
                <td>{{ $totalfrais }}</td>
                 <td>{{ $totalacces+ $totalfood+$totalfrais}}</td>
               {{-- <td>
                    <form action="{{ route('entretien.destroy',$interview['_id']) }}" method="POST" onsubmit="return confirm('Etes vous sure?');">
                        <a class="btn btn-info" href="{{ route('entretien.show',$interview['_id']) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('entretien.edit',$interview['_id']) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>--}}
            </tr>
    </table>
@endsection
