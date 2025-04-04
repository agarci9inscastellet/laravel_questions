@extends('base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2>Crea una pregunta</h2>
        </div>
        <div>
            <a href="{{route('questions.index')}}" class="btn btn-primary">Tornar</a>
        </div>
    </div>

    <form action="{{route('questions.store')}}" method="POST">
        @csrf

        <div class="row">
     
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Pregunta:</strong>
                    <textarea class="form-control" style="height:150px" name="question" placeholder="Escriu la pregunta..."></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                <div class="form-group">
                    <strong>Resposta:</strong>
                    <input type="text" name="answer" class="form-control" id="" placeholder="Escriu la resposta...">
                </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                <div class="form-group">
                    <strong>Url:</strong>
                    <input type="text" name="url" class="form-control" id="" placeholder="Escriu la resposta...">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                <button type="submit" class="btn btn-primary">Crear</button>
            </div>
        </div>
    </form>
</div>
@endsection