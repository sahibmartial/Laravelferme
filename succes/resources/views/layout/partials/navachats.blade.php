
<div class="card text-center">
  <div class="card-header">
  Ma Campagne en cours
  </div>
  <div class="card-body">
    <h5 class="card-title"> Menu Achats</h5>
    <p class="card-text">
	<nav>	
	<fieldset>
		
		<input type="button" class="btn btn-primary" onclick="window.location.href = '{{route("poussins.index")}}';" target="_blink" value="Poussins"/>
		<input type="button" class="btn btn-primary" onclick="window.location.href = '/accessoires';" target="_blink" value="ACCESSOIRES"/>
		<input type="button" class="btn btn-primary" onclick="window.location.href = '/aliments';" target="_blink" value="ALIMENTS"/>
		<input type="button" class="btn btn-primary" onclick="window.location.href = '/transport';" target="_blink" value="TRANSPORTS"/>
		<input type="button" class="btn btn-primary" onclick="window.location.href = '{{route("bilan_achats")}}';" target="_blink" value="Bilan_Achats"/>
		
	</fieldset>
</nav>

	</p>
    <a href="#" class="btn btn-primary">Go Achats</a>
  </div>
  <div class="card-footer text-muted">
  Team-MAYA, une team à votre disposition pour vous aider à digitaliser votre secteur d'activité.
  </div>
</div>