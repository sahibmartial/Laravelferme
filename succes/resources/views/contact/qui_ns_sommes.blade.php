@extends('base')
@section('title')
<title>Qui nous Sommes - Ferme Maya</title>
@stop
@section('content')
<h3 class="mt-4 text-center">Decouvrez nos prestations : </h3>
<hr>
<div class="row">
	<div class="col-md-4 mb-4">
		<div class="card text-center" style="width: 18rem;">
           <img src="{{asset('assets/img/maya2.PNG')}}" class="card-img-top" alt="fermeMaya">
            <div class="card-body">
              <h5 class="card-title">Ferme maya</h5>
               <p class="card-text">La Ferme maya est le fruit d'une collaboration de jeunes entrepreneurs qui veulent investir dans leurs pays d'origines et la Cote d'ivoire a été choisie comme pays hote pour le lancement.<br>
                La ferme maya est un produit du groupe maya, elle se veut de produire  des poulets de qualités et à la portée du public.<br>

               </p>
               <a href="/ferme" class="btn btn-primary">Aller Board</a>
            </div>
       </div>
	</div>
	<div class="col-md-4">
		<div class="card text-center" style="width: 18rem;">
         <img src="...." class="card-img-top" alt="fermeMaya">
         <div class="card-body">
          <h5 class="card-title">Events Maya</h5>
             <p class="card-text">
             Events maya est un produit du groupe maya, elle se veut d'offrir une prestaion de qualités dans l'organisation et les préparatifs de vos evenements t céremonies.<br>
             Un savoir-faire à votre service pour un rendu de qualité
             </p>
             <a href="" class="btn btn-primary">Aller Board</a>
          </div>			
	    </div>
   </div>

	<div class="col-md-4-mb-2">
		<div class="card text-center" style="width: 18rem;">
         <img src="...." class="card-img-top" alt="fermeMaya">
         <div class="card-body">
          <h5 class="card-title">Tourisme Maya</h5>
             <p class="card-text">
              Tourisme maya est un produit du groupe maya, elle se veut de vendre  la culture ivoirienne en mettant en lumierère tous les differents lieux touristiques en CI et la valrisation   de nos coutumes.<br>
              Faire decouvrir aux ivoiriens et aux amoureux du tourisme tous les endroits à visiter en CI.<br> 

             </p>
             <a href="" class="btn btn-primary">Aller Board</a>
          </div>			
	    </div>
		

	</div>

	<div class="col-md-4">
		<div class="card text-center" style="width: 18rem;">
         <img src="...." class="card-img-top" alt="fermeMaya">
         <div class="card-body">
          <h5 class="card-title">Immo Maya</h5>
             <p class="card-text">
              Immo maya est un produit du groupe maya, elle se veut d'offrir une prestaion de qualités danbs l'organisation et les préparatifs(décoration) de vos evenements.<br>
           

             </p>
             <a href="" class="btn btn-primary">Aller Board</a>
          </div>			
	    </div>
		

	</div>

</div>


@stop