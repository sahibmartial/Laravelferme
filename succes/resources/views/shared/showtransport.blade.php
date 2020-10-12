<table style="width:100%">
  <caption>Detail Frais Transport</caption>
  <tr>
    <th>IdCampagne</th>
    <th>Intitule</th>
   {{-- <th>Libelle</th>--}}
    <th>Montant</th>
    {{-- <th>PrixUnitaire</th>--}}
    {{--  <th>Fournisseur</th>--}}
    <th>Observations</th>
  </tr>
  <tr>
    <td>{{ $transports->campagne_id}}</td>
    <td>{{ $transports->campagne}}</td>
  {{--  <td>{{ $transports->libelle}}</td>--}}
    <td>{{$transports->montant}}</td>
  {{--  <td>{{ $transports->priceUnitaire}}</td>--}}
  {{--  <td>{{ $transports->fournisseur}}</td>--}}
     <td>{{ $transports->obs}}</td>
  </tr>
</table> 