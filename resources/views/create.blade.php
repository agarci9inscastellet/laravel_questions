@extends('base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2 class=" fw-bold text-center display-4">  Crea una pregunta</h2>
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

            <select id="dropdown" onchange="showInfo()">  
                <option value="question" checked>Question</option>  
                <option value="info">Object Info</option>  
            </select>   

            <div class="col-xs-12 col-sm-12 col-md-6 mt-2" id="answer">
                <div class="form-group">
                    <strong>Resposta:</strong>
                    <input type="text" name="answer" class="form-control" id="answer_input" placeholder="Escriu la resposta...">
                </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-6 mt-2" id="url">
                <div class="form-group">
                    <strong>Url:</strong>
                    <input type="text" name="url" class="form-control" id="url_input"   placeholder="Escriu la ruta de la url de destí de la porta">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                <div class="form-group">
                    <strong>Image:</strong>
                    <input type="text" name="image" class="form-control" id=""  placeholder="Escriu la ruta de la imatge...">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                <button type="submit" class="btn btn-primary">Crear</button>
            </div>
        </div>
    </form>
</div>
<script>
    function showInfo() {
        var urlDiv = document.getElementById("url"); // Get the info div
        var answerDiv = document.getElementById("answer"); // Get the info div
        var url_input = document.getElementById("url_input"); // Get the info div
        var answer_input = document.getElementById("answer_input"); // Get the info div
        var selectedValue = dropdown.options[dropdown.selectedIndex].value;
        if (selectedValue === "info") {  
                // Show info when the info option is selected  
                urlDiv.style.display = "none"; // Show the info div  
                answerDiv.style.display = "none"; // Show the info div  
                answer_input.value = "info"; // Show the info div
                url_input.value = "info"; // Show the info div
        }else {  
            // Show info when the info option is selected  
            urlDiv.style.display = ""; // Show the info div  
            answerDiv.style.display = ""; // Show the info div  
            answer_input.value = ""; // Show the info div
            url_input.value = ""; // Show the info div
            } 
         
    }
</script>
@endsection