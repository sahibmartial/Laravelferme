<table style="width:100%">
  <caption>Detail Employer</caption>
  <tr>
    <th>ID</th>
    <th>NOM</th>
    <th>Email</th>
    {{--<th>End</th>
     <th>Statut</th>
    <th>Observations</th>--}}
  </tr>
  <tr>
     <td>{{$employes->id}}</td>
    <td>{{ $employes->name}}</td>
    <td>{{$employes->email}}</td>
    {{--<td>{{ $campagnes->end}}</td>
    <td>{{ $campagnes->status}}</td>--}}
    {{--<td>{{ $campagnes->fournisseur}}</td>
     <td>{{ $campagnes->obs}}</td>--}}
  </tr>
</table> 