@extends('layouts.materialize4')

@section('head')
    Gestión
@endsection

@section('titulo')
    Estadísticas del periodo {{$periodo}}
@endsection


@section('bienvenida')

    <header>
        <section class="cabecera">
            @if (date('H')< 12)
                <b><span style="font-size:xx-large; background:white" class="titulo">¡Hola, buenos días {{Auth::user()->name.' '.Auth::user()->last_name}}!</span></b>    

            @elseif (date('H') >= 12 && date('H') <= 18)
                <b><span style="font-size:xx-large; background:white" class="titulo">¡Hola, buenas tardes {{Auth::user()->name.' '.Auth::user()->last_name}}!</span></b>    
            

            @elseif (date('H')>= 18 && date('H')<= 24)
                <b><span style="font-size:xx-large; background:white" class="titulo">¡Hola, buenas noches {{Auth::user()->name.' '.Auth::user()->last_name}}!</span></b>    
            @endif
        </section>
    </header>
    
@endsection

@section('contenido')


    <div class="card white">
        <canvas  id="sexo" ></canvas>
        <br></br>
    </div>

    
    <div class="card white" >
        <canvas  id="taller" ></canvas>
        <br></br>
    </div>
    
    <div class="card white" >
        <canvas  id="cultur-etnia" ></canvas>
        <br></br>
    </div>
     
    <div class="card white" >
        <canvas  id="discapacidad" ></canvas>
        <br></br>
    </div>

@endsection


@section('graficas')
    <!-- Grafica de sexo -->
    <script>

        const talleres = {{Js::from($data)}};
        const mujeres = {{Js::from($m)}};
        const hombres = {{Js::from($h)}};
        new Chart(document.getElementById("sexo"), {
            type: 'bar',
            data: {
            labels: talleres,
            datasets: [
                {
                    label: "Mujeres",
                    backgroundColor: "#FFB6C1",
                    data: mujeres
                    
                }, 

                
                
                {
                label: "Hombres",
                backgroundColor: "#00aae4",
                data: hombres
                }

            ]
            },

            options: {

                plugins: {
                    title: {
                        display: true,
                        text: 'Mujeres y hombres',
                    },             
                },

                
                indexAxis: 'y',    
                

                scales: {
                    x: {
                        title: {
                            color: 'black',
                            display: true,
                            text: 'Talleres',
                            
                        }
                    },
                    y: {
                        title: {
                            color: 'black',
                            display: true,
                            text: 'Alumnos'
                        }
                    }
                },

            }
        });
    </script>


    <!-- Grafica de taller -->
    <script>
        const taller = {{Js::from($c)}};
        new Chart(document.getElementById("taller"), {
            type: 'bar',
            data: {
            labels: talleres,
            datasets: [
                {
                    label: "Alumnos",
                    backgroundColor: "#B8860B",
                    data: taller
                }, 


            ]
            },

            options: {

                plugins: {
                    title: {
                        display: true,
                        text: 'Número de alumnos en cada taller',
                    },             
                },

                scales: {
                    x: {
                        title: {
                            color: 'black',
                            display: true,
                            text: 'Talleres',
                            
                        }
                    },
                    y: {
                        title: {
                            color: 'black',
                            display: true,
                            text: 'Alumnos'
                        }
                    }
                },

            }
        });
    </script>



    <!-- Grafica de cultura etnia  -->
    <script>
        const cultura = {{Js::from($data2)}};
        new Chart(document.getElementById("cultur-etnia"), {
            type: 'bar',
            data: {
            labels: talleres,
            datasets: [
                {
                    label: "Cultura etnia",
                    backgroundColor: "#008F39",
                    data: cultura
                }, 

                
                /*sirve para poder meter 2 barras en una misma tabla
                {
                label: "Mujeres",
                backgroundColor: "#8e5ea2",
                data: [5, 7, 10, 12, 9, 6, 2, 0, 8, 10, 24, 2, 1, 2, 6]
                }*/

            ]
            },

            options: {

                plugins: {
                    title: {
                        display: true,
                        text: 'Alumnos de cultura etnia',
                    },             
                },

                scales: {
                    x: {
                        title: {
                            color: 'black',
                            display: true,
                            text: 'Talleres',
                            
                        }
                    },
                    y: {
                        title: {
                            color: 'black',
                            display: true,
                            text: 'Alumnos'
                        }
                    }
                },

            }
        });
    </script>


    <!-- Grafica de discapacidad  -->
    <script>
        const discapacidad = {{Js::from($data3)}};
        new Chart(document.getElementById("discapacidad"), {
            type: 'bar',
            data: {
            labels: talleres,
            datasets: [
                {
                    label: "Discapacidad",
                    backgroundColor: "#008F39",
                    data: discapacidad
                }, 

                
                /*sirve para poder meter 2 barras en una misma tabla
                {
                label: "Mujeres",
                backgroundColor: "#8e5ea2",
                data: [5, 7, 10, 12, 9, 6, 2, 0, 8, 10, 24, 2, 1, 2, 6]
                }*/

            ]
            },

            options: {

                plugins: {
                    title: {
                        display: true,
                        text: 'Alumnos con discapacidad',
                    },             
                },

                scales: {
                    x: {
                        title: {
                            color: 'black',
                            display: true,
                            text: 'Talleres',
                            
                        }
                    },
                    y: {
                        title: {
                            color: 'black',
                            display: true,
                            text: 'Alumnos'
                        }
                    }
                },

            }
        });
    </script>


@endsection