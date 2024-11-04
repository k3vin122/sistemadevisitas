<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>registrovisita</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

    <!-- Icons -->
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">


    <!-- cdn iconos awesome -->
    <link rel="stylesheet" href="/plugins/font-awesome/css/all.min.css">
    <!-- cdn iconos awesome -->


    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.css">


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <!-- para usar botones en datatables JS -->


    @livewireStyles
</head>




@section('content')
@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif

<!-- Contenido de la vista -->
@endsection

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts

    @stack('scripts')



    <!-- CDN DE DATATABLE-->

    <!-- CSS de DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <!-- CSS de Buttons -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- JS de DataTables -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <!-- JS de Buttons -->
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <!-- JS de JSZip (necesario para exportar a Excel) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <!-- JS de pdfmake (necesario para exportar a PDF) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <!-- JS de Buttons para Excel y PDF -->
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>


    <!-- Estilos bootstrap  -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <!--  Fin Estilos bootstrap  -->


    <!-- Estilos tablas  -->

    <style>
    /* Estilo para los encabezados */
    th {
        background-color: #f2f2f2;
        /* Color de fondo de encabezados */
        font-weight: bold;
        /* Negrita para encabezados */
    }

    body {
        margin: 0;
        font-family: Arial, sans-serif;
    }

    .container {
        display: flex;
        flex-wrap: wrap;
        /* Permite que los elementos se envuelvan */
        justify-content: space-around;
        /* Espaciado entre elementos */
        padding: 20px;
        /* Espaciado interno */
    }

    .box {
        background-color: #4CAF50;
        /* Color de fondo */
        color: white;
        /* Color del texto */
        padding: 20px;
        /* Espaciado interno */
        margin: 10px;
        /* Espaciado externo */
        border-radius: 5px;
        /* Bordes redondeados */
        flex: 1 1 200px;
        /* Crece y se encoge, con un ancho base de 200px */
        text-align: center;
        /* Centra el texto */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        /* Sombra para un efecto de profundidad */
    }

    @media (max-width: 600px) {
        .box {
            flex: 1 1 100%;
            /* En pantallas pequeñas, cada caja ocupará el 100% del ancho */
        }
    }
    </style>

    <!-- fin Estilos tablas  -->







    <!-- CDN DE MENSAJES ALERTAS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CDN DE MENSAJES ALERTAS -->






    <!-- MENSAJE DONDE SE VALIDA SI EXITE UNA VARIABLE EN EL CONTROLADOR CON EL NOMBRE var_mensaje y muestra una alerta -->
    @if($messages = Session::get('var_mensaje'))

    <script>
    Swal.fire({
        title: "{{$messages}}",
        showClass: {
            popup: `
      animate__animated
      animate__fadeInUp
      animate__faster`
        },
        hideClass: {
            popup: `
      animate__animated
      animate__fadeOutDown
      animate__faster`
        }
    });
    </script>
    @endif


    @if($messages = Session::get('var_salida'))

    <script>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "{{$messages}}",
        showConfirmButton: false,
        timer: 1500
    });
    </script>
    @endif




    @if($messages = Session::get('var_registrado'))

    <script>
    Swal.fire({
        title: "{{$messages}}",
        icon: "success"
    });
    </script>
    @endif



    <!-- JQUERY DE  DATATABLE QUE MUESTRA BOTONES Y PAGINADOR -->

    <script>
    $(document).ready(function() {
        $('#miTabla').DataTable({

            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },

            "paging": true, // Habilitar paginación
            "pageLength": 5,


            dom: 'Bfrtip', // Esto añade los botones encima de la tabla
            buttons: [{
                    extend: 'excelHtml5',
                    text: 'Exportar a Excel',
                    title: 'Datos de la Tabla' // Título del archivo Excel
                },
                {
                    extend: 'pdfHtml5',
                    text: 'Exportar a PDF',
                    title: 'Datos de la Tabla' // Título del archivo PDF
                },
                {
                    extend: 'print',
                    text: 'Imprimir',
                    title: 'Datos de la Tabla' // Título de la impresión
                }
            ]


        });


    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>


    @if (session()->has('success'))
    <script>
    var notyf = new Notyf({
        dismissible: true
    })
    notyf.success('{{ session('
        success ') }}')
    </script>
    @endif

    <script>
    /* Simple Alpine Image Viewer */
    document.addEventListener('alpine:init', () => {
        Alpine.data('imageViewer', (src = '') => {
            return {
                imageUrl: src,

                refreshUrl() {
                    this.imageUrl = this.$el.getAttribute("image-url")
                },

                fileChosen(event) {
                    this.fileToDataUrl(event, src => this.imageUrl = src)
                },

                fileToDataUrl(event, callback) {
                    if (!event.target.files.length) return

                    let file = event.target.files[0],
                        reader = new FileReader()

                    reader.readAsDataURL(file)
                    reader.onload = e => callback(e.target.result)
                },
            }
        })
    })
    </script>



</body>

</html>