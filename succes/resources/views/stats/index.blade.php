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
<div class="alert alert-success">
	<p>Mes Statistique pour chaque campagne !!! </p>
 </div> 
 
@stop

@section('bootstrap')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container">
  <div class="row">
  
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

var budget = <?php echo $result['budget']; ?>;

var campagneB = <?php echo  $result['campagne']; ?>

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
var campagne = <?php echo $result['campagne']; ?>;
var ben = <?php echo $result['benefice']; ?>;
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
var campagne = <?php echo $result['campagne']; ?>;
var poussins = <?php echo $result['poussins']; ?>;
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

    var achat = <?php echo $result['achats']; ?>;

    var campagne2 = <?php echo  $result['campagne']; ?>;

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

    var vente = <?php echo $result['ventes']; ?>;

    var campagneV = <?php echo  $result['campagne']; ?>;

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
var campagneP = <?php echo  $result['campagne']; ?>;
var qtePouss = <?php echo  $result['poussins']; ?>;
var qtePerte = <?php echo  $result['pertes']; ?>;
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

<!-- dounghut and pie-->
<script> 

var poussins = <?php echo $result['pertes']; ?>;

var campagneP = <?php echo  $result['campagne']; ?>

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



@stop
