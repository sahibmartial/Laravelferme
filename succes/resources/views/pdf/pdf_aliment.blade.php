<body>
  <div id="content">
    <center>
      <h2><b> <span style="color:orange">{{ 'Recap Aliment :'.ucfirst($campagne) }}</span> </b></h2> 
    </center>
    
    <p>
      {{--@for($i=0;$i< count($aliment); $i++)
    {{'Date : '.$aliment[$i]['date']}}  {{' Quantite: '.$aliment[$i]['Quantite']}}  {{' PrixUnitaire: '.$aliment[$i]['PUA']}}  {{'Libelle : '.$aliment[$i]['libelle']}} {{'Observations : '.$aliment[$i]['obs']}}<br>
    @endfor--}}

   
<table class="table">
  <thead>
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Quantite:</th>
      <th scope="col">PrixUnitaire</th>
      <th scope="col">Libelle</th>
      <th scope="col">Observations</th>
      <th scope="col">DepensesT</th>
    </tr>
  </thead>
  <tbody>
    @for($i=0;$i< count($aliment['Data']); $i++)
    <tr>
      <td>{{$aliment['Data'][$i]['date']}}</td>
      <td>{{$aliment['Data'][$i]['Quantite']}}</td>
      <td>{{$aliment['Data'][$i]['PUA']}}</td> 
      <td>{{$aliment['Data'][$i]['libelle']}}</td>
      <td>{{$aliment['Data'][$i]['obs']}}</td>
      <td>{{$aliment['Data'][$i]['T_achat']}}</td>
    </tr>
    @endfor
  </tbody>

  <tr>
    <th colspan="5">Total:</th>
      <td><b>{{$aliment['Total']}}</b> FCFA</td>
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