@extends('layouts.materialize4')

@section('head')
    Gestión
@endsection

@section('titulo')
    Estadísticas
@endsection

@section('contenido')


    <div class="row">
        
        @foreach($tallers as $taller)
            <div class="col s12 m4">

                <b><p class="white-text">Número de hombres y mujeres inscritos en el taller de {{$taller->taller}}</p></b>

                <div class="collection">
                    
                   <div class="row">

                        <div class="col s12 blue">
                            @php
                                for($i = 0; $i < count($data); $i++){
                                    if($data[$i] == $taller->taller){
                                        echo "<i class='small left fa-solid fa-person'></i><p> Hombres: <b>$h[$i]</b></p>";
                                    }
                                }
                            @endphp
                        </div>

                        <div class="col s12 m">
                            @php
                                for($i = 0; $i < count($data); $i++){
                                    if($data[$i] == $taller->taller){
                                        echo "<i class='small left fa-solid fa-person-dress'></i><p>Mujeres: <b>$m[$i]</b></p>";
                                    }
                                }
                            @endphp
                        </div>

                        <div class="center white-text"><p>Total de alumnos: <b>{{$taller->alumnos->count()}}</b></p></div>

                    </div>
                    

                   

                </div>
                               
               
            </div>
        @endforeach
        
    </div>

  
    <div class="card white" >
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

    <div class="card white" >
        <canvas  id="creditos" ></canvas>
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
                backgroundColor: "#1BE92E",
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
                backgroundColor: "#1BE92E",
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


<!-- Grafica de acreditación  -->
<script>
    //const discapacidad1 = {{Js::from($data3)}};
    new Chart(document.getElementById("creditos"), {
        type: 'bar',
        data: {
        labels: talleres,
        datasets: [
            {
                label: "Acreditado",
                backgroundColor: "#1BE92E",
                data: [5, 5, 5, 3, 7, 6, 5, 3, 4, 2, 4, 8, 3, 4, 4, 6]
                 
            }, 

            
            
            {
            label: "No acreditados",
            backgroundColor: "#E91B1B",
            data: [3, 0, 1, 4, 2, 0, 2, 1, 3, 4, 1, 1, 1, 3, 0, 1]
            }

        ]
        },

        options: {

            plugins: {
                title: {
                    display: true,
                    text: 'Alumnos acreditados y no acreditados',
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