<table style="width:100%">
  
  <tr>
    <th>ID</th>
    <th>Date</th>
    <th>Campagne</th>
    <th>Libelle</th>
    <th>Quantite</th>
     <th>PrixUnitaire</th>
      <th>Fournisseur</th>
    <th>Observations</th>
  </tr>
  <tr>
     <td>{{ $aliments->campagne_id}}</td>
      <td>{{ $aliments->date_achat}}</td>
    <td>{{ $aliments->campagne}}</td>
    <td>{{ $aliments->libelle}}</td>
    <td>{{ $aliments->quantite}}</td>
    <td>{{ $aliments->priceUnitaire}}</td>
    <td>{{ $aliments->fournisseur}}</td>
     <td>{{ $aliments->obs}}</td>
  </tr>
</table> 