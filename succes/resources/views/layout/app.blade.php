<!DOCTYPE html>
<html>
<head>
  @yield('title')
	<link rel="stylesheet" type="text/css" href="/css/app.css">
</head>
<body>
  <nav>
           <div class="topnav">
              <a class="active" href="#home">Home</a>
              <a href="#news">News</a>
              <a href="#contact">Contact</a>
              <a href="#about">About</a>
          </div> 
        </nav>
         <div class="flex-center position-ref full-height">
        <div class="content">
          <div class="title m-b-md">
            FERME_MAYA
          </div>

          <div class="links">
            @yield('contenu')
         </div>

       </div>
        </div>
        <div>
          @yield('retour')
        </div>
       
	
</body>
</html>
