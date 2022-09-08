<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">  
    <title>Encuestas</title>
</head>
<body>
    <div class="container">
        @if(session()->has('success'))
        <div class="alert alert-success mt-4 mb-4">
            <p>{{session('success')}}</p>
        </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card mx-auto">
                    <div class="card-header">
                        <span class="align-text-top">Encuestas</span>
                        <a href="{{ route('quiz.create'); }}"><button class="btn btn-success float-right">&plus;</button></a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($quizzes) > 0)
                                @foreach($quizzes as $q => $quiz)
                                <tr>
                                    <td>{{$quiz->id}}</td>
                                    <td>{{$quiz->name}}</td>
                                    <td width="150">
                                        <div class="d-flex">
                                            <a class="btn btn-primary mr-4" href="{{ route('quiz.show',$quiz->id) }}">Detalle</a>
                                            <a class="btn btn-primary mr-4" href="{{ route('quiz.edit',$quiz->id) }}">Editar</a>
                                            <form action="{{ route('quiz.destroy',$quiz->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="confirm('¿Estás seguro de guardar los datos?') || event.preventDefault()" class="btn btn-danger">Eliminar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="3">No es encontró ninguna encuesta</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>