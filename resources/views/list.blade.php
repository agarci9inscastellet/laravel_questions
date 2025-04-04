@extends('base')

@section('content')

<div class="row">
    <div class="col-12">
        <div>
            <h2 class=" fw-bold text-center display-4">Les teves preguntes</h2>
        </div>
        <div>
            <a href="{{ route('questions.create') }}" class="btn btn-primary">Nova pregunta</a>
        </div>
    </div>

    <!-- Missatge de sessió -->
    @if (session('success'))
        <div class="col-12 mt-4">
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        </div>
    @elseif (session('error'))
        <div class="col-12 mt-4">
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        </div>
    @endif


    <div class="col-12 mt-4">
        <table class="table table-bordered" style="border-color: #000000; color: #212529;">
            <thead class="bg-light ">
                <tr>
                    <th style="border-color: #000000;">ID</th>
                    <th style="border-color: #000000;">Usuari</th>
                    <th style="border-color: #000000;">Pregunta</th>
                    <th style="border-color: #000000;">Resposta</th>
                    <th style="border-color: #000000;">Url</th>
                    <th style="border-color: #000000;">Image</th>
                    <th style="border-color: #000000;">Accions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($questions as $question )
                <tr style="background-color: #f8f9fa; color: #212529;">
                    <td class="fw-bold" style="border-color: #000000;"><a href="{{ route('questions.edit',  $question->id) }}" method="POST" class="btn btn-warning">{{$question->id}}</a></td>
                    <td class="fw-bold" style="border-color: #000000;">{{$question->user->name}}</td>
                    <td style="border-color: #000000;">{{ \Illuminate\Support\Str::limit($question->question, 100, $end='...') }}</td>
                    <td style="border-color: #000000;">{{$question->answer}}</td>
                    <td style="border-color: #000000;">{{$question->url}}</td>
                    <td style="border-color: #000000;">{{\Illuminate\Support\Str::limit($question->image, 100, $end='...')}}</td>
                    <td style="border-color: #000000;"><a href="{{ route('questions.edit',  $question->id) }}" method="POST" class="btn btn-warning">
                        Editar</a>

                        <form action="{{ route('questions.destroy',  $question->id) }}" method="post" class="d-inline" onclick="return confirm('Estàs segur que vols eliminar la pregunta?')">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection