<table style="width:100%">
  
  <tr>
    <th>ID</th>
    <th>Campagne</th>
    <th>Masse</th>
    {{--<th>Quantite</th>
     <th>PrixUnitaire</th>--}}
      <th>Year</th>
    <th>Observations</th>
  </tr>
  <tr>
     <td>{{ $masses->campagne_id}}</td>
    <td>{{ $masses->campagne}}</td>
    <td>{{ $masses->mean_masse}}</td>
    <td>{{ $masses->annee}}</td>
     <td>{{ $masses->obs}}</td>
  </tr>
</table> 