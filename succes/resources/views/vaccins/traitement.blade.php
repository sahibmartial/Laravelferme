<body>
  <div class="container">
   <center><h2><b> <span style="color:green">{{ 'Production :'.ucfirst('Démarrage vente') }} : {{$data['production']['Campagne']}}</span> </b></h2> 
   </center> 
    <div class="text-center"> 
       <table class="table">
            <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Campagne</th>
              <th scope="col">Date</th>
              <th scope="col">Production</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>{{$data['production']['Campagne']}}</td>
              <td>{{$data['production']['Date']}}</td>
              <td>{{$data['production']['Actions']}}</td>
            </tr>
            
            
          </tbody>
        </table>
    </div>
         

    <center><h2><b> <span style="color:orange">{{ 'Récapitulatif '.ucfirst('Suivi Traitement') }} {{$data['production']['Campagne']}}</span> </b></h2> 
   </center> 
  
    <div class="text-center">   
        <table class="table">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Jour</th>
              <th scope="col">Date</th>
              <th scope="col">Traitement</th>
               <th scope="col">Préventions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ( $data['traitement'] as $key =>  $traitement)
                <tr>
                  <th scope="row">{{$key+1}}</th>
                  <td>{{$traitement['jour']}}</td>
                  <td>{{$traitement['Date']}}</td>
                  <td>{{$traitement['Actions']}}</td>
                  <td> Préventions sanitaires | Vigilance redoublée </td>
                  
                </tr>
              @endforeach 
          </tbody>
          
        </table>
    </div>
 </div>
  
  <hr>
  <center>
   	{{'© 2017-2021 La Ferme MAYA, savoir-faire et savoir-être à partger'}}<br>
                   {{'La Ferme 100% made in Cote D\'ivoire'}}<br> 
                            {{'Privacy · Terms '}}
  </center>
       	
</body>

 