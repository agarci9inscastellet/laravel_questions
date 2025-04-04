@extends('base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2>Edita la pregunta</h2>
        </div>
        <div>
            <a href="{{route('questions.index')}}" class="btn btn-primary">Tornar</a>
        </div>
    </div>

    <form action="{{ route('questions.update', $question->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{$question->id}}">   

        <div class="row">
     
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>ID:</strong>
                    <input type="text" name="answer" class="form-control" id="" disables readonly value="{{$question->id}}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Pregunta:</strong>
                    <textarea class="form-control" style="height:150px" name="question" placeholder="Pregunta...">{{$question->question}}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                <div class="form-group">
                    <strong>Resposta:</strong>
                    <input type="text" name="answer" class="form-control" value="{{$question->answer}}" id="" placeholder="Resposta...">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                <div class="form-group">
                    <strong>Url:</strong>
                    <input type="text" name="url" class="form-control" id="" value="{{$question->url}}" placeholder="Escriu la url...">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                <button type="submit" class="btn btn-primary">Actualitzar</button>
            </div>
        </div>
    </form>
</div>
@endsection