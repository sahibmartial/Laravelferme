<body>
  <div id="content">
    <center><h2><b> <span style="color:orange">{{ 'Recap Accessoire:'.ucfirst($campagne) }}</span> </b></h2> 
   </center>
    
    <p>     
 {{--@for($i=0;$i< count($accessoire); $i++)
    {{'Date : '.$accessoire[$i]['date']}}  {{' Quantite: '.$accessoire[$i]['Quantite']}}  {{' PrixUnitaire: '.$accessoire[$i]['PUA']}}  {{'Libelle : '.$accessoire[$i]['libelle']}} {{'Observations : '.$accessoire[$i]['obs']}}<br>
    @endfor--}}
    <table class="table">
  <thead>
    <tr>
      <th scope="row">Date</th>
      <th scope="col">Quantite</th>
      <th scope="col">PrixUnitaire</th>
      <th scope="col">Libelle</th>
      <th scope="col">Observations</th>
      <th scope="col">DepensesT</th>
    </tr>
  </thead>
  <tbody>
    @for($i=0;$i< count($accessoire['Data']); $i++)
    <tr>
      <td>{{$accessoire['Data'][$i]['date']}}</td>
      <td>{{$accessoire['Data'][$i]['Quantite']}}</td>
      <td>{{$accessoire['Data'][$i]['PUA']}}</td>
      <td>{{$accessoire['Data'][$i]['libelle']}}</td>
      <td>{{$accessoire['Data'][$i]['obs']}}</td>
      <td>{{$accessoire['Data'][$i]['T_achat']}}</td>
    </tr>
    @endfor
  </tbody>
  <tr>
    <th colspan="5">Total:</th>
      <td><b>{{$accessoire['Total']}}</b> FCFA</td>
    </tr> 

</table>

   

    </p>
  </div>
  <hr>
   <center>
   	{{'© 2017-2020 La Ferme MAYA, savoir-faire et savoir-être à partger'}}<br>
                   {{'La Ferme 100% made in Cote D\'ivoire'}}<br> 
                            {{'Privacy · Terms '}}
   </center>
       	
       
</body>