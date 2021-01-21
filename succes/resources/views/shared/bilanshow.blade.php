<h2 class="text-center mt-4 mb-2">Recapitulatif {{$bilans->campagne}}</h2>
<table class="table mt-4">
  <thead>
    <tr>
      <th scope="col">Campagne</th>
      <th scope="col">T_Achat</th>
      <th scope="col">T_Vente</th>
      <th scope="col">Qte_Achetes</th>
      <th scope="col">Qte_perdus</th>
      <th scope="col">Benefice</th>
      <th scope="col">Reserve</th>
      <th scope="col">Partenaire</th>
      <th scope="col">Employer</th>
      <th scope="col">year</th>
      <th scope="col">Obs</th>
    </tr>
  </thead>
  <tbody>
    
    <tr>
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
   
    
  </tbody>
</table>





