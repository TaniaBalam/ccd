<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

        <title>@yield('title')</title>

        <style>
     
            .fondo{
                background:#17202A;
            }

            .margen{
                margin-top: 80px;
                margin-bottom: 80px;
            }

            .tam{
                font-size:x-large;
            }

            .fon{
                background: url("https://media.istockphoto.com/vectors/vector-sport-pattern-sport-seamless-background-vector-id943759054?k=20&m=943759054&s=170667a&w=0&h=La7PyxRnjsB7OTbOXb6QyNglE5bDODQkaAq1bcqlscE=")
            }
           

        </style>

        
    </head>

    <body class="fon">
        <div class="margen container black-text">

            <div class="card">
                <div class="center">
                   <b><h2> @yield('code') </h2></b>
                </div>

                <div class="center">
                    <b><p> @yield('message')</p></b>
                    
                </div>
                <br>
            </div>

            <div class="center">

                @yield('image')
                
            </div>

        </div>
    </body>
</html>