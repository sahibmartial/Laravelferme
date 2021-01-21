<body>
  <div id="content">
    <center> <h2 class="text-center"><b> <span style="color:orange">{{ 'Recap Aachat Poussin:'.ucfirst($campagne) }}</span> </b></h2> </center>
   
    <p class="text-center">
       
 {{--@for($i=0;$i< count($accessoire); $i++)
    {{'Date : '.$accessoire[$i]['date']}}  {{' Quantite: '.$accessoire[$i]['Quantite']}}  {{' PrixUnitaire: '.$accessoire[$i]['PUA']}}  {{'Libelle : '.$accessoire[$i]['libelle']}} {{'Observations : '.$accessoire[$i]['obs']}}<br>
    @endfor--}}
    <table class="table text-center">
  <thead>
    <tr>
      <th scope="row">Date</th>
      <th scope="col">Quantite</th>
      <th scope="col">PrixUnitaire</th>
      <th scope="col">Fournisseur</th>
      <th scope="col">Observations</th>
      <th scope="col">DepensesT</th>
    </tr>
  </thead>
  <tbody>
    @for($i=0;$i< count($poussin['Data']); $i++)
    <tr>
    
      <td>{{$poussin['Data'][0]['date']}}</td>
      <td>{{$poussin['Data'][0]['Quantite']}}</td>
      <td>{{$poussin['Data'][0]['PUA']}}</td>
      <td>{{$poussin['Data'][0]['Fournisseur']}}</td>
      <td>{{$poussin['Data'][0]['obs']}}</td>
      <td>{{$poussin['Data'][0]['T_achat']}}</td>
     
    </tr>
    @endfor
  </tbody>

</table>
    <hr>         
   <b>Detail Perte:</b>

    </p>
  </div>
  <hr>
   <center>
   	{{'© 2017-2020 La Ferme MAYA, savoir-faire et savoir-être à partger'}}<br>
                   {{'La Ferme 100% made in Cote D\'ivoire'}}<br> 
                            {{'Privacy · Terms '}}
   </center>
       	
       
</body>