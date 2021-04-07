
<table style="width:100%">
  
  <tr>
    <th>ID</th>
    <th>Intitule</th>
    <th>Date_Vente</th>
    <th>Quantite</th>
    <th>PrixUNitaire</th>
     <th>Acheteur</th>
     <th>Contact</th>
      <th>Events</th>
    <th>Observations</th>
  </tr>
  <tr>
     <td>{{$ventes->campagne_id}}</td>
    <td>{{ $ventes->campagne}}</td>
    <td>{{$ventes->date}}</td>
    <td>{{$ventes->quantite}}</td>
    <td>{{ $ventes->priceUnitaire}}</td>
    <td>{{ $ventes->acheteur}}</td>
    <td>{{ $ventes->contact}}</td>
    <td>{{ $ventes->events}}</td>
     <td>{{ $ventes->obs}}</td>
  </tr>
</table> 