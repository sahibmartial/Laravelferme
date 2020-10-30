<table style="width:100%">
  <caption>Detail Achat Aliments</caption>
  <tr>
    <th>ID</th>
    <th>Campagne</th>
    <th>Libelle</th>
    <th>Quantite</th>
     <th>PrixUnitaire</th>
      <th>Fournisseur</th>
    <th>Observations</th>
  </tr>
  <?php
  for ($i=0; $i <count($results) ; $i++) { 
  ?>
  <tr>
     <td>{{ $results[$i]->campagne_id}}</td>
    <td>{{ $results[$i]->campagne}}</td>
    <td>{{ $results[$i]->libelle}}</td>
    <td>{{ $results[$i]->quantite}}</td>
    <td>{{ $results[$i]->priceUnitaire}}</td>
    <td>{{ $results[$i]->fournisseur}}</td>
     <td>{{ $results[$i]->obs}}</td>
     <?php
      }
     ?>
  </tr>
</table> 