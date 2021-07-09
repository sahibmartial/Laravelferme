<body>
  <div id="content">

    <center><h2><b> <span style="color:orange">{{ 'Récapitulatif '.ucfirst('Suivi Traitement') }}</span> </b></h2> 
   </center> 
    <p class="text-center">   
    <table class="table ">
  <thead>
    <tr>    
      <th scope="col">Jour</th>
      <th scope="col">Traitement</th>
      <th scope="col">Observations</th>
    </tr>
  </thead>
  <tbody>
  @foreach($data as $key => $trait)
    <tr>
     <td>{{$trait['jour']}}</td>
     
      <td> {{$trait['Actions']}} </td>
      <td> Préventions sanitaires | Vigilance redoublée </td>
    </tr>   
    @endforeach
  </tbody>
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

 