<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Import the Hash facade
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Import the AuthorizesRequests trait


class QuestionController extends Controller
{
    use AuthorizesRequests; // Use the AuthorizesRequests trait

    /**
     * Mostra una llista de recursos.
     */
    // public function __construct()
    // {
    //     $this->authorizeResource(Question::class, 'question');
    // }

    public function index()
    {
        //

        // $password = '1234';
        // $user = User::findOrFail(1);
        // $user->fill(['password' => Hash::make($password)])->save();

        if (auth()->user()->id == 1) {
            // Si l'usuari és administrador, mostra totes les preguntes
            $questions = Question::all();
        } else {
            // Si l'usuari no és administrador, mostra només les seves preguntes
            $questions = auth()->user()->questions()->get();
        }
        //$questions = Question::all();
        //$questions = auth()->user()->questions()->get();
        //
        return view('list', ['questions' => $questions]);
    }

    /**
     * Mostra el formulari per crear un nou recurs.
     */
    public function create()
    {
        //
        return view('create');
    }

    /**
     * Desa un recurs nou a l'emmagatzematge.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'url' => 'required|string',
        ]);

        //$user = User::all()->first();
        // $question = $user->questions()->create([
        //     'question' => $request->input('question'),
        //     'answer' => $request->input('answer'),
        // ]);
        $user = auth()->user()->questions()->create([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
            'url' => $request->input('url'),
            'image' => $request->input('image'),
        ]);


        // Redirigeix a l'índex de preguntes amb un missatge d'èxit
        return redirect()->route('questions.index')->with('success', 'Pregunta creada correctament.');
    }

    /**
     * Mostra el recurs especificat.
     */
    public function show(Question $question)
    {
        //
        // Mostra els detalls de la pregunta especificada
        return view('show', compact('question'));
    }

    /**
     * Mostra el formulari per editar el recurs especificat.
     */
    public function edit(Question $question)
    {

        return view('edit', compact('question'));
    }

    /**
     * Actualitza el recurs especificat a l'emmagatzematge.
     */
    public function update(Request $request, Question $question)
    {
        //
        //$this->authorize('uptade', $question);


        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'url' =>'required|string',

        ]);

        // Actualitza la pregunta especificada
        $question->update([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
            'url' => $request->input('url'),
            'image' => $request->input('image'),

        ]);

        // Redirigeix a l'índex de preguntes amb un missatge d'èxit
        return redirect()->route('questions.index')->with('success', 'Pregunta actualitzada correctament.');
    }

    /**
     * Elimina el recurs especificat de l'emmagatzematge.
     */
    public function destroy(Question $question)
    {
        $this->authorize('delete', $question);

        //
        // Elimina la pregunta especificada
        $question->delete();

        // Redirigeix a l'índex de preguntes amb un missatge d'èxit
        return redirect()->route('questions.index')->with('success', 'Pregunta eliminada correctament.');
    }

    public function test(Request $request, String $val){
setlocale(LC_CTYPE, 'ca_ES');
        $val="   LALóOÓ   ";
        $plain=  trim(iconv('UTF-8', 'ASCII//IGNORE', mb_strtolower($val, 'UTF-8')));
echo $plain;
$plain = remove_accents("Làönârdó Dà Vïncì");
echo $plain;

       // $plain=  trim(iconv('UTF-8', 'ASCII//TRANSLIT', mb_strtolower($val, 'UTF-8')));
        $answerplain=  trim(iconv('UTF-8', 'ASCII//TRANSLIT', mb_strtolower( "Làönârdó Dà Vïncì", 'UTF-8')));

        dd([$plain,$answerplain]);
    }

}

