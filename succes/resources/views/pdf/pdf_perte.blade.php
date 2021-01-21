<body>
  <div id="content">
    <center> <h2 class="text-center"><b> <span style="color:orange">{{ 'Recap Perte Poussins:'.ucfirst($campagne) }}</span> </b></h2> </center>
   
    <p class="text-center">
       
 {{--@for($i=0;$i< count($accessoire); $i++)
    {{'Date : '.$accessoire[$i]['date']}}  {{' Quantite: '.$accessoire[$i]['Quantite']}}  {{' PrixUnitaire: '.$accessoire[$i]['PUA']}}  {{'Libelle : '.$accessoire[$i]['libelle']}} {{'Observations : '.$accessoire[$i]['obs']}}<br>
    @endfor--}}
    <table class="table text-center">
  <thead>
    <tr>
      <th scope="row">Date</th>
      <th scope="col">Quantite</th>
      <th scope="col">Cause</th>
      <th scope="col">DureedeVie</th>
      <th scope="col">Observations</th>
     
    </tr>
  </thead>
  <tbody>
    @for($i=0;$i< count($perte['Data']); $i++)
    <tr>
    
      <td>{{$perte['Data'][$i]['date']}}</td>
      <td>{{$perte['Data'][$i]['quantite']}}</td>
      <td>{{$perte['Data'][$i]['cause']}}</td>
      <td>{{$perte['Data'][$i]['living']}}</td>
      <td>{{$perte['Data'][$i]['obs']}}</td>         
    </tr>
    @endfor
  </tbody>

</table>
    <hr>         
   <b>Total Perte: </b>{{$perte['Total']}}

    </p>
  </div>
  <hr>
   <center>
   	{{'© 2017-2020 La Ferme MAYA, savoir-faire et savoir-être à partger'}}<br>
                   {{'La Ferme 100% made in Cote D\'ivoire'}}<br> 
                            {{'Privacy · Terms '}}
   </center>
       	
       
</body>