
<table style="width:100%">
  <caption>Detail Achat poussins</caption>
  <tr>
    <th>ID</th>
    <th>Campagne</th>
    <th>quantite</th>
     <th>PrixUnitaire</th>
     <th>Fournisseur</th>
    <th>Observations</th>
  </tr>
  <tr>
    <td>{{ $lists->campagne_id}}</td>
    <td>{{ $lists->campagne}}</td>
    <td>{{ $lists->quantite}}</td>
    <td>{{$lists->priceUnitaire}}</td>
    <td>{{ $lists->fournisseur}}</td>
     <td>{{ $lists->obs}}</td>
  </tr>
</table> 
