<body>
  <div id="content">
    <h2><b> <span style="color:orange">{{ 'Bilan partiel :'.ucfirst($campagne) }}</span> </b></h2> 
    <p>
        <b>{{'Infos Campagne:'}}</b><br>
    	{{'Date start :'.$date}} / {{'Libelle campagne: '.$campagne}} / {{ 'Budget:'.$Budget}} FCFA / {{'Statut: '.$status}}<br>
      <b>{{'Apports:'}}</b><br>
      {{'Total Apport issu des ventes:'.$ApportVente}} FCFA<br>
      {{'Total Apport Personnel:'.$ApportPersonnel}} FCFA <br>
       <b>{{'Achats/Depenses:'}}</b><br>
       {{'Qte: '.$QuantitePoussins}} / {{'PrixU_Achats: '.$PUAchatPoussins}}  FCFA<br>
       {{'Depenses_Achat_Poussins :'.$T_achatsPoussins}}  FCFA<br>
       {{'Depenses_Accesoires :'.$T_Accessoires}}  FCFA<br>
       {{'Depenses_Aliments :'.$T_Aliments}}  FCFA<br>
       {{'Depenses_Transports :'.$T_Transport}}  FCFA<br>
       {{'Total Achats: '.$T_DepnsesAchats}} FCFA<br>
       <b>{{'Pertes:'}}</b><br>
       {{'Qte_Perdus :'.$QteLoss}}<br>

        <b>{{'Ventes:'}}</b><br>
        {{'QteVendu:'.$QteVendu}} / {{'MoyenPU_Vente:'.$MoyenPU_vente}} FCFA<br>
        {{'Recette:'.$T_vente}} FCFA<br>
        {{'Solde:'.$Solde}} FCFA<br>

        @if($Qte_Restante==0)
          <b>{{'Statut : Campage terminée'}}</b><br>
        @else
         <b>{{'Nombre de tetes restantes:'}}</b><br>
         {{'Qte Restante:'.$Qte_Restante}} 
        @endif
      

    </p>
  </div>
  <hr>
   <center>
   	{{'© 2017-2020 La Ferme MAYA, savoir-faire et savoir-être à partger'}}<br>
                   {{'La Ferme 100% made in Cote D\'ivoire'}}<br> 
                            {{'Privacy · Terms '}}
   </center>
       	
       
</body>