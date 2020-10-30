
<table style="width:100%">
  <caption>Detail Bilan</caption>
  <tr>
    <th>ID</th>
    <th>Campagne</th>
    <th>T_Achat</th>
    <th>T_Vente</th>
     <th>Qte_Achetes</th>
     <th>Qte_perdus</th>
     <th>Benefice</th>
     <th>Reserve</th>
     <th>Partenaire</th>
     <th>Employer</th>
     <th>year</th>
    <th>Obs</th>
  </tr>
  <tr>
     <td>{{$bilans->id}}</td>
    <td>{{ $bilans->campagne}}</td>
    <td>{{$bilans->totalAchats}}</td>
    <td>{{ $bilans->totalVentes}}</td>
    <td>{{ $bilans->quantite_achetes}}</td>
    <td>{{ $bilans->quantite_perdus}}</td>
    <td>{{ $bilans->benefice}}</td>
    <td>{{ $bilans->reserve}}</td>
    <td>{{ $bilans->partenaire}}</td>
    <td>{{ $bilans->charges_salariale}}</td>
    <td>{{ $bilans->annee}}</td>
     <td>{{ $bilans->obs}}</td>
  </tr>
</table> 