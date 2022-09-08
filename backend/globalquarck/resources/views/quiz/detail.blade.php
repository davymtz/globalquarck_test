<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Detalle encuesta</title>
</head>
<body>
<div class="container">
        <div class="row">
            <div class="card mx-auto" style="width:50rem;">
                <div class="card-header">
                    <span class="align-text-top">Encuesta: <b>{{$quiz_detail->name}}</b></span>
                    <a href="/quiz"><button class="btn btn-warning float-right">Regresar</button></a>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($quiz_detail->questions as $k => $question)
                        <li class="list-group-item flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{($k+1)}} .- {{$question->name}}</h5>
                            </div>
                            @foreach($question->options as $o => $option)
                            <p class="mb-1">{{($o+1)}}) {{$option->name}}</p>
                            @endforeach
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>