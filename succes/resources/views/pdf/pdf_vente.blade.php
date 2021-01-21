<body>
  <div id="content">
    <center>
       <h2 ><b> <span style="color:orange">{{ 'Recap Vente:'.ucfirst($campagne) }}</span> </b></h2> 
   
   </center>
    <p>
     {{--@for($i=0;$i< count($vente); $i++)
    {{'Date : '.$vente[$i]['date']}}  {{' Quantite: '.$vente[$i]['Quantite']}}  {{' PrixUnitaire: '.$vente[$i]['PUA']}}<br>
    @endfor--}}
    <center>
     <table class="table">
  <thead>
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Quantite</th>
      <th scope="col">PrixUnitaire</th>
      <th scope="col">Total</th>
    </tr>
  </thead>
  <tbody>
    @for($i=0;$i< count($vente['Data']); $i++)
    <tr>
      <td>{{$vente['Data'][$i]['date']}}</td>
      <td>{{$vente['Data'][$i]['Quantite']}}</td>
      <td>{{$vente['Data'][$i]['PUA']}}</td>
     
     
      <td>{{$vente['Data'][$i]['T_vente']}}</td>
    </tr>
    @endfor
  </tbody>

</table>
</center>

    <hr>
    
          {{'Total qte vendu : '.$vente['qteT']}}<br>
      
         {{'Total des ventes : '.$vente['Total']}}


    </p>
  </div>

  <hr>
   <center>
   	{{'© 2017-2021 La Ferme MAYA, savoir-faire et savoir-être à partger'}}<br>
                   {{'La Ferme 100% made in Cote D\'ivoire'}}<br> 
                            {{'Privacy · Terms '}}
   </center>
       	
       
</body>