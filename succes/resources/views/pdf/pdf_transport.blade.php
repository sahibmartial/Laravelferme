<body>
  <div id="content">
    <center> <h2 class="text-center"><b> <span style="color:orange">{{ 'Recap Frais Transport:'.ucfirst($campagne) }}</span> </b></h2> </center>
   
    <p class="text-center">
       
 {{--@for($i=0;$i< count($accessoire); $i++)
    {{'Date : '.$accessoire[$i]['date']}}  {{' Quantite: '.$accessoire[$i]['Quantite']}}  {{' PrixUnitaire: '.$accessoire[$i]['PUA']}}  {{'Libelle : '.$accessoire[$i]['libelle']}} {{'Observations : '.$accessoire[$i]['obs']}}<br>
    @endfor--}}
    <table class="table text-center">
  <thead>
    <tr>
      <th scope="row">Date</th>
      <th scope="col">Montant</th>
      
      <th scope="col">Observations</th>
     
    </tr>
  </thead>
  <tbody>
    
    @for($i=0;$i< count($transport['Data']); $i++)
    @if(count($transport['Data']) === 1)
    <tr>
      <td>{{$transport['Data'][0]['date']}}</td>
      <td>{{$transport['Data'][0]['montant']}}</td>  
      <td>{{$transport['Data'][0]['obs']}}</td>         
    </tr>
    @else
    <tr>
      <td>{{$transport['Data'][$i]['date']}}</td>
      <td>{{$transport['Data'][$i]['montant']}}</td>  
      <td>{{$transport['Data'][$i]['obs']}}</td>         
    </tr>
    @endif
    @endfor
  </tbody>

</table>
    <hr>         
   <b>Total Frais Transport: </b>{{$transport['Total']}}

    </p>
  </div>
  <hr>
   <center>
   	{{'© 2017-2020 La Ferme MAYA, savoir-faire et savoir-être à partger'}}<br>
                   {{'La Ferme 100% made in Cote D\'ivoire'}}<br> 
                            {{'Privacy · Terms '}}
   </center>
       	
       
</body>