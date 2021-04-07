<body>
  <div id="content">

    <center><h2><b> <span style="color:orange">{{ 'Récapitulatif '.ucfirst($campagne) }}</span> </b></h2> 
   </center> 
    <p>     
     @foreach($results as $key => $result)

     @if( $key=='Poussin' && empty($result['Data']))
     <center>
     <span style="color:red"> {{'Impossible de generer pdf Campagne cloturée ou  non encore demarrée'}}  </span> 
     </center>  
     @else
         @if($key=='Campagne')
         <small>Budget: </small><b>{{$results['Campagne']['Budget']}}</b> FCFA<br>
         <small>Observation: </small><b>{{$results['Campagne']['Obs']}}</b><br>
         <hr>
         @endif
          @if($key=='Apports')
         <b>{{'Detail Apports: '}}</b><br>
         <small>Apport issu des Ventes: </small><b>{{$results['Apports']['AppVente']}}</b> FCFA<br>
         <small>Apport Personnel: </small><b>{{$results['Apports']['AppPerso']}}</b> FCFA<br>
         <hr>
         @endif
        @if($key=='Poussin')
        <b>{{'Detail Achat Poussins:'}}</b><br>

         {{'Date: '.$result['Data'][0]['date']}} {{'Quantite: '.$result['Data'][0]['Quantite']}} {{'PrixU: '.$result['Data'][0]['PUA']}} {{'Fournisseur: '.$result['Data'][0]['Fournisseur']}} {{'Total: '.$result['Data'][0]['T_achat']}} {{'Obs:'.$result['Data'][0]['obs']}}
         <br>
         <small>Qte Total Poussins achetés: </small> <b>{{$result['Data'][0]['Quantite']}}</b><br>

          <small>Total achat Poussins: </small> <b>{{$result['Data'][0]['T_achat']}} </b> FCFA
         <hr>
        @endif
        
        @if($key=='Perte')
        
        <b>{{'Detail Pertes Poussins:'}}</b><br>
        @php
        if(empty($result['Data'])){
        @endphp
          <b><span style="color:green">{{'Aucune pertes pour cette campagne'}}</span></b> 
          
        @php
           }else{
           for($i=0; $i < count($result['Data']); $i++){
             if(count($result['Data'])==1){
             @endphp
              {{'Date: '.$result['Data'][0]['date']}} {{'Quantite: '.$result['Data'][0]['quantite']}} {{'Cause: '.$result['Data'][0]['cause']}} {{'DuréeDeVie: '.$result['Data'][0]['living']}} {{'Obs: '.$result['Data'][0]['obs']}}
             @php
                }else{
                @endphp
                 {{'Date: '.$result['Data'][$i]['date']}} {{'Quantite: '.$result['Data'][$i]['quantite']}} {{'Cause: '.$result['Data'][$i]['cause']}} {{'DuréeDeVie: '.$result['Data'][$i]['living']}} {{'Obs: '.$result['Data'][$i]['obs']}}<br>
                @php
                }

            }

           }
        @endphp              
          <br>
           <small>Total qte poussins Perdus: </small> {{$result['Total']}}<b></b> 
        <hr>
        @endif
        
        @if($key=='Frais')  
        <b>{{'Detail Frais de Transport :'}}</b><br>
        @php
        if(empty($result['Data'])){
        @endphp
          <b><span style="color:green">{{'Aucun Frais de transports '}}</span></b> 
           
        @php
           }else{
           for($i=0; $i < count($result['Data']); $i++){
             if(count($result['Data'])==1){
             @endphp
              {{'Date: '.$result['Data'][0]['date']}} {{'Montant: '.$result['Data'][0]['montant']}} {{'Obs: '.$result['Data'][0]['obs']}}
             @php
                }else{
                @endphp
                 {{'Date: '.$result['Data'][$i]['date']}} {{'Montant: '.$result['Data'][$i]['montant']}}   {{'Obs: '.$result['Data'][$i]['obs']}}<br>
                @php
                }

            }

           }
        @endphp  

        <br>
           <small>Total Frais de transports: </small> <b>{{$result['Total']}}</b> FCFA
        <hr>
        @endif
    
        @if($key=='Aliment')
        <b>{{'Detail Aliments:'}}</b><br>
        @php
        if(empty($result['Data'])){
        @endphp
          <b><span style="color:green">{{'Aucun Aliment acheté '}}</span></b> 
           
        @php
           }else{
           for($i=0; $i < count($result['Data']); $i++){
             if(count($result['Data'])==1){
             @endphp
              {{'Date: '.$result['Data'][0]['date']}} {{'Quantite: '.$result['Data'][0]['Quantite']}} {{'PU: '.$result['Data'][0]['PUA']}} {{'Libelle: '.$result['Data'][0]['libelle']}} {{'T_achat: '.$result['Data'][0]['T_achat']}} {{'Obs: '.$result['Data'][0]['obs']}}
             @php
                }else{
                @endphp
                  {{'Date: '.$result['Data'][$i]['date']}} {{'Quantite: '.$result['Data'][$i]['Quantite']}} {{'PU: '.$result['Data'][$i]['PUA']}} {{'Libelle: '.$result['Data'][$i]['libelle']}} {{'T_achat: '.$result['Data'][$i]['T_achat']}} {{'Obs: '.$result['Data'][$i]['obs']}}<br>
                @php
                }

            }

           }
        @endphp  


        <br>

           <small>Total Achat Aliment: </small><b>{{$result['Total']}}</b> 
        <hr>
        @endif
         
        @if($key=='Accessoire')        
        <b>{{'Detail Accessoires:'}}</b><br>

        @php
        if(empty($result['Data'])){
        @endphp
          <b><span style="color:green">{{'Aucun Accessoire acheté '}}</span></b> 
           
        @php
           }else{
           for($i=0; $i < count($result['Data']); $i++){
             if(count($result['Data'])==1){
             @endphp
              {{'Date: '.$result['Data'][0]['date']}} {{'Quantite: '.$result['Data'][0]['Quantite']}} {{'PU: '.$result['Data'][0]['PUA']}} {{'Libelle: '.$result['Data'][0]['libelle']}} {{'T_achat: '.$result['Data'][0]['T_achat']}} {{'Obs: '.$result['Data'][0]['obs']}}
             @php
                }else{
                @endphp
                  {{'Date: '.$result['Data'][$i]['date']}} {{'Quantite: '.$result['Data'][$i]['Quantite']}} {{'PU: '.$result['Data'][$i]['PUA']}} {{'Libelle: '.$result['Data'][$i]['libelle']}} {{'T_achat: '.$result['Data'][$i]['T_achat']}} {{'Obs: '.$result['Data'][$i]['obs']}}<br>
                @php
                }

            }

           }
        @endphp  


        <br>

           <small>Total Achat Accessoire: </small><b>{{$result['Total']}}</b> FCFA
        <hr>
        @endif
         
        @if($key=='Vente')
        <b>{{'Detail Vente:'}}</b><br>

         @php
        if(empty($result['Data'])){
        @endphp
          <b><span style="color:green">{{'Aucune vente declarée '}}</span></b> 
           
        @php
           }else{
           for($i=0; $i < count($result['Data']); $i++){
             if(count($result['Data'])==1){
             @endphp
              {{'Date: '.$result['Data'][0]['date']}} {{'Quantite: '.$result['Data'][0]['Quantite']}} {{'PU: '.$result['Data'][0]['PUA']}} {{'Libelle: '.$result['Data'][0]['libelle']}} {{'T_achat: '.$result['Data'][0]['T_achat']}} {{'Obs: '.$result['Data'][0]['obs']}}
             @php
                }else{
                @endphp
                  {{'Date: '.$result['Data'][$i]['date']}} {{'Quantite: '.$result['Data'][$i]['Quantite']}} {{'PU: '.$result['Data'][$i]['PUA']}} {{'T_vente: '.$result['Data'][$i]['T_vente']}} <br>
                @php
                }

            }

           }
        @endphp  


        <br>

           <small>Total qte poussins vendus: </small> <b>{{$result['qteT']}}</b><br>
           <small>Total vente: </small> <b>{{$result['Total']}}</b> FCFA <br>
           <small>Solde: </small> <b>{{($result['Total'] - $results['Apports']['AppVente']) }}</b> FCFA
        @endif




     @endif

    
     
    @endforeach
    </p>
 </div>
  <hr>
  <center>
   	{{'© 2017-2020 La Ferme MAYA, savoir-faire et savoir-être à partger'}}<br>
                   {{'La Ferme 100% made in Cote D\'ivoire'}}<br> 
                            {{'Privacy · Terms '}}
  </center>
       	
</body>

 