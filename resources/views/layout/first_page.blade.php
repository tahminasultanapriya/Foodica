<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <title>Foodica</title>

    </head>
    <body>
    <div class="jumbotron text-center">
    <h1>Foodica</h1>
    <p>Eat Fit Healhy Wealthy</p> 
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="">Home <span class="sr-only">(current)</span></a>
    
        </li>

        <li class="nav-item active">
            
            <a class="nav-link" href="" class="nav-link">Category</a>
        </li>

        </ul>
    </div>
    </nav>
    <div class="container">
    @yield('content')
    </div>
  

    </body>
</html>
