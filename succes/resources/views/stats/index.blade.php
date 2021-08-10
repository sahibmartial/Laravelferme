@extends('base')
@section('title')
<title>Statistique de la Campagne</title>
@stop

@section('stylesheet')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.0/Chart.min.css" 
    integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w=="
     crossorigin="anonymous">
@stop

@section('content')

@stop

@section('bootstrap')
@if(count($result)>0)
<div class="alert alert-success">
	<p class="text-center">Mes Statistiques en temps réel !!! </p>
 </div> 
 
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container">
  <div class="row">
  

    <div class="col-md-4 mb-2">
        <div class="card">
        <small>Vente En cours</small>
         <div><canvas id="myvente"></canvas></div>
        </div>
    </div>

    <div class="col-md-4 mb-2">
        <div class="card">
        <small>Pertes En cours</small>
         <div><canvas id="myperte"></canvas></div>
        </div>
    </div>

    <hr>
    <div class="col-md-4 mb-2">
        <div class="card">
        <small> Budget par campagne</small>
         <div><canvas id="mycampagne"></canvas></div>
        </div>
    </div>
    
    <div class="col-md-4 mb-2">
      <div class="card">
        <div><canvas id="benefice"></canvas></div>
      </div>
    </div>
    <div class="col-md-4 mb-2">
      <div class="card">
        <div><canvas id="myPoussins"></canvas></div>
      </div>
    </div>

    <div class="col-md-4 mb-2">
      <div class="card">
        <div><canvas id="myAchat"></canvas></div>
      </div>
    </div>

    <div class="col-md-4 mb-2">
      <div class="card">
        <div><canvas id="myVente"></canvas></div>
      </div>
    </div>
  
   
    <div class="col-md-4 mb-2">
      <div class="card">
        <small> Pertes par campagne</small>
        <div><canvas id="myPerte"></canvas></div>
      </div>
    </div>

    <div class="col-md-4 mb-2">
      <div class="card">
        <small> Perte par quantité </small>
        <div><canvas id="mymix"></canvas></div>
      </div>
    </div>


  </div>
</div>

<script> 

var budget = <?php 
if (isset($result['budget'])) {
  echo $result['budget']; 
}
?>;

var campagneB = <?php
if (isset($result['campagne'])) {
  echo  $result['campagne']; 
}
 ?>

const datab = {
  labels:campagneB,
  datasets: [{
    label: 'Budget par campagne',
    data: budget,
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)'
    ],
    hoverOffset: 4
  }],
  
};
const configb = {
  type: 'doughnut',
  data: datab,
};

var myChartb = new Chart(
    document.getElementById('mycampagne'),
    configb
  );
</script>


<script>
var campagne = <?php
if (isset( $result['campagne'])) {
  echo $result['campagne']; 
}
?>;
var ben = <?php
if (isset($result['benefice'])) {
  echo $result['benefice'];
}
  ?>;
const config2 = {
  type: 'line',
  data: {
      labels:  campagne,
     datasets: [{
         label: 'Benefice par campagne',
         data:  ben,
         backgroundColor: 'rgb(255, 99, 132)',
         borderColor: 'rgb(255, 99, 132)',
    
        }]       

  },
  options: {}
};
var myChart2 = new Chart(
    document.getElementById('benefice'),
    config2
  );
 // console.log(ben,campagne);
</script>

<script>
var campagne = <?php
if (isset($result['campagne'])) {
  echo $result['campagne'];
}
  ?>;
var poussins = <?php 
if (isset($result['poussins'])) {
  echo $result['poussins'];
}
 ?>;
const config3 = {
  type: 'line',
  data: {
      labels:  campagne,
     datasets: [{
         label: 'Quantité Poussins par campagne',
         data:  poussins,
         backgroundColor: 'rgb(255, 99, 132)',
         borderColor: 'rgb(255, 99, 132)',
    
        }]       

  },
  options: {}
};
var myChart3 = new Chart(
    document.getElementById('myPoussins'),
    config3
  );
 // console.log(ben,campagne);
</script>


<!-- graphe en bar-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

<script>

    var achat = <?php 
    if (isset($result['achats'])) {
      echo $result['achats']; 
    }
   ?>;

    var campagne2 = <?php 
    if (isset($result['campagne'])) {
      echo  $result['campagne']; 
    }
    ?>;

    var barChartData = {

        labels: campagne2,

        datasets: [{

            label: 'Campagne',

            backgroundColor: "pink",

            data:  achat 

        }]

    };
   var ctx = document.getElementById("myAchat").getContext("2d");

   window.myBar = new Chart(ctx, {

    type: 'bar',

    data: barChartData,

    options: {

        elements: {

            rectangle: {

                borderWidth: 2,

                borderColor: '#c1c1c1',

                borderSkipped: 'bottom'

            }

        },

        responsive: true,

        title: {

            display: true,

            text: 'Achat pour chaque campagne'

        }

    }

});
</script>


<script>

    var vente = <?php
    if (isset($result['ventes'])) {
      echo $result['ventes'];
    }
     ?>;

    var campagneV = <?php 
    if (isset($result['campagne'])) {
      echo  $result['campagne']; 
    }
   ?>;

    var barChartData = {

        labels: campagneV,

        datasets: [{

            label: 'Campagne',

            backgroundColor: "pink",

            data:  vente 

        }]

    };
   var ctx = document.getElementById("myVente").getContext("2d");

   window.myBar = new Chart(ctx, {

    type: 'bar',

    data: barChartData,

    options: {

        elements: {

            rectangle: {

                borderWidth: 2,

                borderColor: '#c1c1c1',

                borderSkipped: 'bottom'

            }

        },

        responsive: true,

        title: {

            display: true,

            text: 'Vente pour chaque campagne'

        }

    }

});
</script>

<!-- mix line and bar -->
 <script>
var campagneP = <?php 
if (isset( $result['campagne'])) {
  echo  $result['campagne'];
}
 ?>;
var qtePouss = <?php 
if (isset( $result['poussins'])) {
  echo  $result['poussins'];
}

 ?>;
var qtePerte = <?php 
if (isset($result['pertes'])) {
  echo  $result['pertes'];
}
?>;
var ctx = document.getElementById("mymix").getContext("2d");
var myMix= new Chart(ctx,{
  type: 'bar',
  data: {
    datasets: [{
      label: 'Poussins',
      data: qtePouss,
      backgroundColor: 'pink'
    }, {
      label: 'Pertes',
      data: qtePerte,
      type: 'line',
      borderColor: 'blue'

    }],
    labels: campagneP
  },
  
});


 </script>
<!--Line  Pertes -->
<script>
var campagne = <?php 
if ( isset($result['campagne_enCours'])) {
  echo $result['campagne_enCours'];
}
?>;
var qteLoss = <?php
if (isset($result['pertes_encours'])) {
  echo  $result['pertes_encours'];
}
?>;
var Datedie = <?php 
if (isset($result['DateDie_enCours'])) {
  echo  $result['DateDie_enCours']; 
}
?>;
//console.log(qteLoss);
//console.log(Datedie );
if (qteLoss.length > 0) {
  var ctx = document.getElementById("myperte").getContext("2d");
var myMix= new Chart(ctx,{
  type: 'bar',
  data: {
    datasets: [{
      label: 'Poussins',
      data: qteLoss,
      backgroundColor: 'pink'
    }, {
      label: 'Pertes',
      data: qteLoss,
      type: 'line',
      borderColor: 'blue'

    }],
    labels: Datedie
  },
  options: {
    title: {

      display: true,
      text: campagne

    }
  }
});
  
} else {
  
}

</script>

<!--Line BAR Vente -->
<script>

var campagne = <?php 
if (isset($result['campagne_enCours'])) {
  echo  $result['campagne_enCours']; 
}
?>;
var qteVendu = <?php 
if (isset($result['Vente_enCoursQte'])) {
  echo  $result['Vente_enCoursQte'];
}
 ?>;
var dateVendu = <?php
if (isset($result['Vente_enCoursDate'])) {
  echo  $result['Vente_enCoursDate'];
}
?>;
if ( qteVendu.length >0) {
  var ctx = document.getElementById("myvente").getContext("2d");
var myMix= new Chart(ctx,{
  type: 'bar',
  data: {
    datasets: [{
      label: 'Poussins',
      data: qteVendu,
      backgroundColor: 'pink'
    }, {
      label: 'Ventes',
      data:qteVendu,
      type: 'line',
      borderColor: 'blue'

    }],
    labels: dateVendu
  },
  options: {
    title: {

      display: true,
      text: campagne

    }
  }
});
 
} else {
  
}
</script>

<!-- dounghut and pie-->
<script> 

var poussins = <?php 
if (isset($result['pertes'])) {
  echo $result['pertes'];
}
 ?>;

var campagneP = <?php 
if (isset( $result['campagne'])) {
  echo  $result['campagne'];
}
 ?>

const data = {
  labels:campagneP,
  datasets: [{
    label: 'Pertes par campagne',
    data: poussins,
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)'
    ],
    hoverOffset: 4
  }],
  
};
const config4 = {
  type: 'doughnut',
  data: data,
};

var myChart4 = new Chart(
    document.getElementById('myPerte'),
    config4
  );
</script>
@else
<div class="alert alert-success">
	<p class="text-center"> Aucune Campagne disponible, merci </p>
 </div> 
@endif

@stop
