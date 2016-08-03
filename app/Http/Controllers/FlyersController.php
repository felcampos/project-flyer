<?php

namespace App\Http\Controllers;

use App\Flyer;
use App\Http\Requests\AddPhotoRequest;
use App\Http\Requests\FlyerRequest;
use App\Photo;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FlyersController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Coloca autenticação em tudo, menos no methodo show
        $this->middleware('auth', ['except' => ['show']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //flash()->overlay('Welcome abord', 'Thank you for signing up');
        //$countries = Country::all();
        return view('flyers.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FlyerRequest $request)
    {
        // colocar num request proprio ja garante que aqui dentro so execute apos a autorização e validação dos campos

        // persistir os dados
        $flyer = new Flyer($request->all());
        \Auth::user()->publish($flyer);

        //flash messaging
        flash()->success('Success', 'Your flyer has been created');

        // redirecionar para a pagina utilizando uma função helper
        return redirect(flyer_path($flyer));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($zip, $street)
    {
        $flyer = Flyer::locatedAt($zip, $street);

        return view('flyers.show', compact('flyer'));
    }

    public function addPhoto($zip, $street, AddPhotoRequest $request)
    {
        // colocar num request proprio ja garante que aqui dentro so execute apos a autorização e validação dos campos

        // Cria uma novo Objeto Photo
        $photo = $this->makePhoto($request->file('photo'));

        //Addiciona a photo no BD.
        Flyer::locatedAt($zip, $street)->addPhoto($photo);

        return 'Done';

    }

    protected function makePhoto(UploadedFile $file)
    {
        return Photo::named($file->getClientOriginalName())->move($file);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
