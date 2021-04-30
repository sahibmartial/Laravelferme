<!DOCTYPE html>
<html>
  <head>
    <title>My first Chartist Tests</title>
    <link rel="stylesheet"
          href="bower_components/chartist/dist/chartist.min.css">
  </head>
  <body>
  <h2>hello Bientot dispoible</h2>
    <!-- Site content goes here !-->
    <div class="ct-chart ct-perfect-fourth"></div>

    <script src="bower_components/chartist/dist/chartist.min.js">
    var data = {
  // A labels array that can contain any sort of values
  labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
  // Our series array that contains series objects or in this case series data arrays
  series: [
    [5, 2, 4, 2, 0]
  ]
};

// Create a new line chart object where as first parameter we pass in a selector
// that is resolving to our chart container element. The Second parameter
// is the actual data object.
new Chartist.Line('.ct-chart', data);
    
    </script>
  </body>
</html>


