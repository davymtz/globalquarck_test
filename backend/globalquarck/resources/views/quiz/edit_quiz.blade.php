<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar encuesta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    @livewireStyles
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="card mx-auto" style="width:50rem;">
                <div class="card-header">
                    <span class="align-text-top">Editar encuesta</span>
                    <a href="/quiz"><button class="btn btn-warning float-right">Regresar</button></a>
                </div>
                <div class="card-body">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
</body>
</html>