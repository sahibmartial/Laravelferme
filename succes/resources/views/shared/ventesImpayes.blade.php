<table class="table table-hover mt-2">
  <thead>
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Campagne</th>
      <th scope="col">Quantite</th>
      <th scope="col">Prix Unitaire</th>
      <th scope="col">Client</th>
      <th scope="col">Contact</th>
      <th scope="col">Montant</th>
      <th scope="col">Avance</th>
      <th scope="col">Impayer</th>
      <th scope="col">Regler</th>
      <th scope="col">Observations</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
   @foreach($venteimpayes as $impayes)
    <tr>
      <th scope="row">{{$impayes->date}}</th>
      <td>{{$impayes->campagne}}</td>
      <td>{{$impayes->quantite}}</td>
      <td>{{$impayes->priceUnitaire}}</td>
      <td>{{$impayes->acheteur}}</td>
      <td>{{$impayes->contact}}</td>
      <td  style="background-color: #07B133; color: #ffffff;">{{$impayes->quantite * $impayes->priceUnitaire}}</td>
      <td>{{$impayes->avance}}</td>
      <td>{{$impayes->impaye}}</td>
      <td>{{$impayes->regler}}</td>
      <td>{{$impayes->obs}}</td>
      <td><a href="{{ 
		   route('ventes.show',
           $impayes->id)}}">Update</a> </td>
      <td>
           <form action="{{route('ventes.destroy',$impayes)}}" method="POST"onsubmit="return confirm('Etes vous sure?');">
	            {{csrf_field()}}
	            {{method_field('DELETE')}}
	            <input type="submit" value="supprimer">
	      </form>
       </td>
    </tr>
   @endforeach
  </tbody>
</table>