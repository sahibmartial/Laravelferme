<table class="table table-bordered">
  <tr>
    <th>ID</th>
    <th>Date</th>
    <th>Campagne</th>
   {{--<th>Libelle</th>
    <th>Quantite</th>
     <th>PrixUnitaire</th>--}}
      <th>Montant</th>
    <th>Observations</th>
  </tr>
  <?php
  for ($i=0; $i <count($results) ; $i++) { 
  ?>
  <tr>
     <td>{{$i}} {{--$results[$i]->campagne_id--}}</td>
     <td>{{ $results[$i]->date_achat}}</td>
    <td>{{ $results[$i]->campagne}}</td>
    {{--<td>{{ $results[$i]->libelle}}</td>
    <td>{{ $results[$i]->quantite}}</td>
    <td>{{ $results[$i]->priceUnitaire}}</td>--}}
    <td>{{ $results[$i]->montant}}</td>
     <td>{{ $results[$i]->obs}}</td>
     <?php
      }
     ?>
  </tr>
</table> 