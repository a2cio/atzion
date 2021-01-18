<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::with("user")->paginate(10);
        return view("empresas.index", compact("empresas"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $empresa = new Empresa;
        $title = __("Crear empresa");
        $textButton = __("Crear");
        $route = route("empresas.store");
        return view("empresas.create", compact("title", "textButton", "route", "empresa"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "name" => "required|max:140|unique:empresas",
            "description" => "nullable|string|min:10"
        ]);
        Empresa::create($request->only("name", "description"));
        return redirect(route("empresas.index"))
            ->with("success", __("¡Empresa creada!"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show(Empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Empresa $empresa)
    {
        $update = true;
        $title = __("Editar empresa");
        $textButton = __("Actualizar");
        $route = route("empresas.update", ["empresa" => $empresa]);
        return view("empresas.edit", compact("update", "title", "textButton", "route", "empresa"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, Empresa $empresa)
    {
        $this->validate($request, [
            "name" => "required|unique:empresas,name," . $empresa->id,
            "description" => "nullable|string|min:10"
        ]);
        $empresa->fill($request->only("name", "description"))->save();
        return back()->with("success", __("¡Empresa actualizada!"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {
        $empresa->delete();
        return back()->with("success", __("¡Empresa eliminada!"));
    }
}
