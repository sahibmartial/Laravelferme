<!--	
<nav class="text-center">	
	<fieldset>
	


		<input type="button" onclick="window.location.href = '/OutilsCampagne';" target="_blink" value="OutilsCampagnes"/>
		<input type="button" onclick="window.location.href = '/achats';" target="_blink" value="Achats"/>
		
		<input type="button" onclick="window.location.href = '/mean_masse';" target="_blink" value="Masse "/>
		
		<input type="button" onclick="window.location.href = 'bilan';" target="_blink" value="Bilan"/>
		
		<input type="button" onclick="window.location.href = 'stat';" target="_blink" value="Statistique"/>
		<input type="button" onclick="window.location.href = 'Tconstruction';" target="_blink" value="Travaux_Achats_Matériels"/>
		
	</fieldset>
</nav>
-->
<div class="row">
  <div class="col-sm-4 mb-2">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Outils Campagne</h5>
        <p class="card-text">
			Création de la campagne et enregistrements:
			<ul>
		     	<li> Campagne</li>
				 <li> Vaccin</li>
				<li> Ventes</li>
				<li> Pertes</li>
			</ul>
		</p>
        <a href="/OutilsCampagne" class="btn btn-primary">Go campagne</a>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Achats</h5>
        <p class="card-text">
			Enregistrement des achats liés à la campagne en cours.
			<ul>
			    <li>Poussins</li>
				<li>Accessoires</li>
				<li>Aliments</li>
				<li>Transports</li>
			</ul>
		</p>
        <a href="/achats" class="btn btn-primary">Go Achats</a>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Masse</h5>
        <p class="card-text">Listing des masses de chaque campagne.
			<ul>
				<li>Calcule masse moyenne de chaque campagne.</li>
			</ul>
		</p>
        <a href="/mean_masse" class="btn btn-primary">Go Masse</a>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Bilan</h5>
        <p class="card-text">Listing bilan de chaque campagne bilan.
			<ul>
				<li> Dresse un bilan  financier de la campagne et perspectives pour la suite</li>
			</ul>
		</p>
        <a href="bilan" class="btn btn-primary">Go Bilan</a>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Statistique</h5>
        <p class="card-text">Statistique sur les differentes campagnes.
			<ul>
				<li>Ventes campagne en cours  </li>
				<li>Pertes campagne en cours </li>
				<li>Budget par campagne </li>
				<li>Gain par campagne </li>
				<li>Pertes par campagne </li>
				<li>Quatite poussins par campagne </li>
				<li>Quantite poussins par campagne </li>
				<li>Total Achats par campagne </li>
				<li>Total Ventes par campagne </li>
				<li>Pertes par quantite poussins pour chaque campagne </li>
			</ul>
		</p>
        <a href="stat" class="btn btn-primary">Go statistique</a>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Travaux et Divers</h5>
        <p class="card-text">Déclaration achats matériels et travaux à réaliser.
			<ul>
				<li>Achats de materiels</li>
				<li>Constructions de nouveaux sites</li>
			</ul>
		</p>
        <a href="Tconstruction" class="btn btn-primary">Go Travaux </a>
      </div>
    </div>
  </div>
 
</div>


