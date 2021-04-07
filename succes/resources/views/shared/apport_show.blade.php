<table style="width:100%">
  
  <tr>
    <th>ID</th>
    <th>Intitule</th>
    <th>Apport</th>
    <th>Created</th>
    <th>Observations</th>
  </tr>
  <tr>
     <td>{{$apports->id}}</td>
    <td>{{ $apports->campagne}}</td>
   
    <td>{{ $apports->apport}} FCFA </td>
    <td>{{$apports->created_at}}</td>
    
     <td>{{ $apports->obs}}</td>
  </tr>
</table> 