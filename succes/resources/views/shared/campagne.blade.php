<table style="width:100%">
  
  <tr>
    <th>ID</th>
    <th>Intitule</th>
    <th>Budget-Initial</th>
    <th>Apport-Supplementaire</th>
    <th>Start</th>
    <th>End</th>
     <th>Statut</th>
    <th>Observations</th>
  </tr>
  <tr>
     <td>{{$campagnes->id}}</td>
    <td>{{ $campagnes->intitule}}</td>
    <td>{{ $campagnes->budget}} FCFA</td>
    <td><a href="{{route('apports.index')}}">{{ $som}} FCFA </a></td>
    <td>{{$campagnes->start}}</td>
    <td>{{ $campagnes->end}}</td>
    <td>{{ $campagnes->status}}</td>
    {{--<td>{{ $campagnes->fournisseur}}</td>--}}
     <td>{{ $campagnes->obs}}</td>
  </tr>
</table> 