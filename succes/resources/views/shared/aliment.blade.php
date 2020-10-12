<table style="width:100%">
  <caption>Detail Achat Aliment</caption>
  <tr>
    <th>Campagne</th>
    <th>Libelle</th>
    <th>Quantite</th>
     <th>PrixUnitaire</th>
      <th>Fournisseur</th>
    <th>Observations</th>
  </tr>
  <tr>
    <td>{{ $aliments->campagne}}</td>
    <td>{{ $aliments->libelle}}</td>
    <td>{{ $aliments->quantite}}</td>
    <td>{{ $aliments->priceUnitaire}}</td>
    <td>{{ $aliments->fournisseur}}</td>
     <td>{{ $aliments->obs}}</td>
  </tr>
</table> 