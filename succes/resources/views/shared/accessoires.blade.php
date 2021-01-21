 
 <table style="width:100%">
  
  <tr>
    <th>ID</th>
    <th>Date</th>
    <th>Campagne</th>
    <th>Libelle</th>
    <th>Quantite</th>
     <th>PrixUnitaire</th>
    <th>Observations</th>
  </tr>
  <tr>
    <td>{{ $accessoires->campagne_id}}</td>
    <td>{{ $accessoires->date_achat}}</td>
    <td>{{ $accessoires->campagne}}</td>
    <td>{{ $accessoires->libelle}}</td>
    <td>{{ $accessoires->quantite}}</td>
    <td>{{ $accessoires->priceUnitaire}}</td>
     <td>{{ $accessoires->obs}}</td>
  </tr>
</table> 