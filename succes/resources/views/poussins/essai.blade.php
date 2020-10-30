<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<script type="text/javascript">
		
 var base= ['log', 'login', 'logon', 'logout', 'logoff', 'logged'];
 var base2= ['campagne1', 'champagne', 'champignon', 'cchampionat', 'champion'];

function check(field) {
  var name = field.value;
  var l = name.length;
  var idx = base2.indexOf(name);
  if(idx == -1) {
    var tempo = base2.filter(function(x) {
      return x.substr(0, l) == name;
    });
    if(tempo.length != 1) return;
    name = tempo[0];  
    field.value = name;
  }
  var content = name + " trouvé.";
  document.getElementById("storage").innerHTML=content;
}

function test(){
  var base= ['log', 'login', 'logon', 'logout', 'logoff', 'logged'];
  alert(base);
}
//test();

	</script>
	 <input type="text" value="Tapez un mot..." onKeyUp="check(this)" onChange="check(this)">
    <br>

</body>
</html>
