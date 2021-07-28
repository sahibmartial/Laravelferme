<table style="width:100%">
  
  <tr>
    <th>Date</th>
    <th>Campagne</th>
    <th>Aliment utilisé</th>
    <th>Nbre de Sacs utilisés</th>
    <th>Masse</th>
    <th>Year</th>
    <th>Observations</th>
  </tr>
  <tr>
   
     <td>{{ $masses->date}}</td>
    <td>{{ $masses->campagne}}</td>
    <td>{{ $masses->aliment}}</td>
    <td>{{ $masses->quantite}}</td>
    <td>{{ $masses->mean_masse}}</td>
    <td>{{ $masses->annee}}</td>
     <td>{{ $masses->obs}}</td>
  </tr>
</table> 