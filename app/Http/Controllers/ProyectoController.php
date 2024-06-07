<?php

namespace App\Http\Controllers;

use App\Models\Conductor;
use App\Models\Proyecto;
use App\Models\Encargado;
use App\Models\Estado;
use App\Models\Herramientas;
use App\Models\Maquinaria;
use App\Models\ProyectosMateriales;
use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\ProyectosConductores;
use App\Models\ProyectosHerramientas;
use App\Models\ProyectosMaquinarias;
use Barryvdh\DomPDF\Facade\Pdf;

class ProyectoController extends Controller
{
    public function index()
    {
        $proyectos = Proyecto::orderBy('id', 'desc')->paginate(10);

        return view('proyecto.proyectos', compact('proyectos'));
    }

    public function create()
    {
        $encargados = Encargado::where('estado_id', '=', 1)
            ->get();
        $estado = Estado::where('nombre', '=', 'activo')
            ->orwhere('nombre', '=', 'inactivo')
            ->orwhere('nombre', '=', 'completado')
            ->orwhere('nombre', '=', 'cancelado')
            ->get();

        return view('proyecto.create', compact('encargados', 'estado'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'min:2'],
            'ubicacion' => ['required', 'string', 'min:2'],
            'fecha_de_inicio' => ['required', 'date'],
            'fecha_de_finalizacion' => ['nullable']
        ]);

        $proyecto = new Proyecto();
        $proyecto->nombre = $request->nombre;
        $proyecto->ubicacion = $request->ubicacion;
        $proyecto->fecha_de_incio = $request->fecha_de_inicio;
        $proyecto->fecha_de_finalizacion = $request->fecha_de_finalizacion;
        $proyecto->encargado_id = $request->encargado;
        $proyecto->estado_id = $request->estado;
        $proyecto->usuario_id = auth()->user()->id;
        $proyecto->save();
        //notify()->success('Registro creado correctamente', 'Informacion');

        return redirect()->route('proyectos');
    }

    public function edit($id)
    {
        $encargados = Encargado::all();
        $estado = Estado::where('nombre', '=', 'activo')
            ->orwhere('nombre', '=', 'inactivo')
            ->orwhere('nombre', '=', 'completado')
            ->orwhere('nombre', '=', 'cancelado')
            ->get();
        $proyecto = Proyecto::find($id);

        return view('proyecto.edit', compact('encargados', 'estado', 'proyecto'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'min:2'],
            'ubicacion' => ['required', 'string', 'min:2'],
            'fecha_de_inicio' => ['required', 'date'],
            'fecha_de_finalizacion' => ['nullable']
        ]);

        $proyecto = Proyecto::find($id);
        $proyecto->nombre = $request->nombre;
        $proyecto->ubicacion = $request->ubicacion;
        $proyecto->fecha_de_incio = $request->fecha_de_inicio;
        $proyecto->fecha_de_finalizacion = $request->fecha_de_finalizacion;
        $proyecto->encargado_id = $request->encargado;
        $proyecto->estado_id = $request->estado;
        $proyecto->usuario_id = auth()->user()->id;
        $proyecto->update();
        //notify()->success('Registro actualizado correctamente', 'Informacion');

        return redirect()->route('proyectos');
    }

    //Pagina de detalle  por proyecto
    public function detail($id)
    {
        //Seccion de materiales
        $proyecto = Proyecto::find($id);

        $maquinarias = Maquinaria::where('disponible', 1)->get();
        $conductoresSelect = Conductor::all();

        $proyecto_material = ProyectosMateriales::where('proyecto_id', '=', $id)->get();

        //Actualizar precios de los materiales
        foreach ($proyecto_material as $ItemPrecioMaterial) {
            $ItemPrecioMaterial->valor_total = $ItemPrecioMaterial->cantidad * $ItemPrecioMaterial->materiales->precio_por_unidad;
            $ItemPrecioMaterial->update();
        }

        $precio_total_materiales = ProyectosMateriales::where('proyecto_id', '=', $id)->sum('valor_total');

        //Seccion de maquinarias
        $proyecto_maquinaria = ProyectosMaquinarias::where('proyecto_id', '=', $id)->get();

        //Seccion de herramientas
        $proyecto_herramientas = ProyectosHerramientas::where('proyecto_id', '=', $id)->get();

        //Seccion de conductores
        $conductores = ProyectosConductores::where('proyecto_id', '=', $id)->get();

        return view('proyecto.detail', compact('proyecto', 'maquinarias', 'proyecto_material', 'precio_total_materiales', 'proyecto_maquinaria', 'proyecto_herramientas', 'conductores', 'conductoresSelect'));
    }

    //Seleccionar material y validar cantidad
    public function create_material_detail($proyectoId)
    {
        $proyecto = Proyecto::find($proyectoId);
        $materiales_distintos = ProyectosMateriales::where('proyecto_id', '=', $proyectoId);
        $materiales = Material::all();

        return view('proyecto.addDetailMaterial', compact('proyecto', 'materiales'));
    }

    //Validar cantidad disponible de materiales
    public function validar_cantidad_material(Request $request, $proyectoId)
    {
        $proyecto = Proyecto::find($proyectoId);
        $material = Material::find($request->material);

        return view('proyecto.addDetailMaterialCantidad', compact('proyecto', 'material'));
    }

    //Guardar detalle de material
    public function store_material_detail(Request $request, $proyectoId, $materialId)
    {
        $proyecto = Proyecto::find($proyectoId);
        $material = Material::find($materialId);

        //Crea el registro de proyecto materiales
        $proyecto_material = new ProyectosMateriales();
        $proyecto_material->proyecto_id = $proyecto->id;
        $proyecto_material->cantidad = $request->cantidad;
        $proyecto_material->valor_total = $material->precio_por_unidad * $request->cantidad;
        $proyecto_material->material_id = $material->id;
        $proyecto_material->usuario_id = auth()->user()->id;
        $proyecto_material->save();


        //Actualizar el registro material->cantidad
        $material->cantidad -= $request->cantidad;
        $material->valor_total -= $proyecto_material->valor_total;
        $material->update();

        return redirect()->route('detalle_proyecto', ['id' => $proyecto->id]);
    }

    //Agregar unidades de material
    //$materialId->hace referencia al id del registro de detalle de material proyecto
    public function store_material_by_proyect(Request $request, $proyectoId, $materialId)
    {
        $proyecto_material = ProyectosMateriales::find($materialId);
        $proyecto_material->cantidad += $request->cantidad;
        $proyecto_material->update();

        $material = Material::find($request->materialDetalleId);
        $material->cantidad -= $request->cantidad;
        $material->valor_total -= ($request->cantidad * $material->precio_por_unidad);
        $material->update();

        return redirect()->route('detalle_proyecto', ['id' => $proyectoId]);
    }

    //Quitar unidades de material
    //$materialId->hace referencia al id del registro de detalle de material proyecto
    public function subtract_material_by_project(Request $request, $proyectoId, $materialId)
    {
        $request->validate([
            'cantidad' => ['required', 'min:0']
        ]);

        $proyecto_material = ProyectosMateriales::find($materialId);
        $proyecto_material->cantidad -= $request->cantidad;
        $proyecto_material->update();

        $proyecto = Proyecto::find($proyectoId);

        $material = Material::find($request->materialDetalleId);
        $material->cantidad += $request->cantidad;
        $material->valor_total += ($request->cantidad * $material->precio_por_unidad);
        $material->update();

        return redirect()->route('detalle_proyecto', ['id' => $proyecto->id]);
    }

    //Eliminar el registro de material y regresar en su totalidad la cantidad de materiales a la tabla principal
    public function delete_material_by_project(Request $request, $proyectoId, $materialId)
    {
        $proyecto = Proyecto::find($proyectoId);
        $proyecto_material = ProyectosMateriales::find($materialId);

        $material = Material::find($request->materialDetalleId);
        $material->cantidad += $proyecto_material->cantidad;
        $material->valor_total += ($proyecto_material->cantidad * $material->precio_por_unidad);
        $material->update();

        $proyecto_material->delete();

        return redirect()->route('detalle_proyecto', ['id' => $proyecto->id]);
    }

    //Agregar maquinaria al proyecto
    public function store_maquinaria_by_proyect(Request $request, $proyectoId)
    {
        $proyecto_maquinaria = new ProyectosMaquinarias();
        $proyecto_maquinaria->proyecto_id = $proyectoId;
        $proyecto_maquinaria->maquinaria_id = $request->maquinaria;
        $proyecto_maquinaria->usuario_id = auth()->user()->id;
        $proyecto_maquinaria->save();

        $maquinaria = Maquinaria::find($request->maquinaria);
        $maquinaria->disponible = false;
        $maquinaria->update();

        return redirect()->route('detalle_proyecto', ['id' => $proyectoId]);
    }

    //Eliminar registro de maquinaria del detalle del proyecto
    public function delete_maquinaria_by_proyect(Request $request, $proyectoId, $proyectomaquinariaId)
    {
        $proyecto_maquinaria = ProyectosMaquinarias::find($proyectomaquinariaId);

        $maquinaria = Maquinaria::find($proyecto_maquinaria->maquinaria_id);
        $maquinaria->disponible = true;
        $maquinaria->update();

        $proyecto_maquinaria->delete();

        return redirect()->route('detalle_proyecto', ['id' => $proyectoId]);
    }

    //Retornar maquinaria a la tabla principal
    public function retornar_maquinaria_por_proyecto($proyectoId, $maquinaria_id)
    {
        $maquinaria = Maquinaria::find($maquinaria_id);
        $maquinaria->disponible = true;
        $maquinaria->update();

        return redirect()->route('detalle_proyecto', ['id' => $proyectoId]);
    }

    //Seleccionar herramientas y validar cantidad
    public function create_herramientas_detail($proyectoId)
    {
        $proyecto = Proyecto::find($proyectoId);
        $herramientas = Herramientas::all();

        return view('proyecto.addDetailHerramienta', compact('proyecto', 'herramientas'));
    }

    //Validar cantidad de herramientas disponibles
    public function validar_cantidad_herramienta(Request $request, $proyectoId)
    {
        $proyecto = Proyecto::find($proyectoId);
        $herramienta = Herramientas::find($request->herramienta);

        return view('proyecto.addDetailHerramientaCantidad', compact('proyecto', 'herramienta'));
    }

    //Guardar detalle de herramientas
    public function store_herramienta_detail(Request $request, $proyectoId, $herramientaId)
    {
        $herramienta = Herramientas::find($herramientaId);

        //Crea el registro de detalle de herramientas
        $proyecto_herramienta = new ProyectosHerramientas();
        $proyecto_herramienta->proyecto_id = $proyectoId;
        $proyecto_herramienta->cantidad = $request->cantidad;
        $proyecto_herramienta->herramienta_id = $herramientaId;
        $proyecto_herramienta->usuario_id = auth()->user()->id;
        $proyecto_herramienta->save();

        //Actualiza el registro de herramientas
        $herramienta->cantidad -= $request->cantidad;
        $herramienta->update();

        return redirect()->route('detalle_proyecto', ['id' => $proyectoId]);
    }

    //Agregar unidades de herramientas
    //herramientaId hace referencia al id de la tabal "proyectos_herramientas"
    public function store_herramienta_by_proyect(Request $request, $proyectoId, $herramientaId)
    {
        $proyecto_herramienta = ProyectosHerramientas::find($herramientaId);
        $proyecto_herramienta->cantidad += $request->cantidad;
        $proyecto_herramienta->update();

        $herramienta = Herramientas::find($proyecto_herramienta->herramienta_id);
        $herramienta->cantidad -= $request->cantidad;
        $herramienta->update();

        return redirect()->route('detalle_proyecto', ['id' => $proyectoId]);
    }

    //Quitar unidades de herramientas
    public function subtract_herramienta_by_project(Request $request, $proyectoId, $herramientaId)
    {
        $proyecto_herramienta = ProyectosHerramientas::find($herramientaId);
        $proyecto_herramienta->cantidad -= $request->cantidad;
        $proyecto_herramienta->update();

        $herramienta = Herramientas::find($proyecto_herramienta->herramienta_id);
        $herramienta->cantidad += $request->cantidad;
        $herramienta->update();

        return redirect()->route('detalle_proyecto', ['id' => $proyectoId]);
    }

    //Eliminar el registro de herramientas del proyecto
    public function delete_herramienta_by_project(Request $request, $proyectoId, $herramientaId)
    {
        $proyecto_herramienta = ProyectosHerramientas::find($herramientaId);
        $herramienta = Herramientas::find($proyecto_herramienta->herramienta_id);
        $herramienta->cantidad += $proyecto_herramienta->cantidad;

        $herramienta->update();
        $proyecto_herramienta->delete();

        return redirect()->route('detalle_proyecto', ['id' => $proyectoId]);
    }

    //Retonar herramientas a la tabla principal
    public function retornar_herramienta_by_project(Request $request, $proyectoId, $herramientaId)
    {
        $proyecto_herramienta = ProyectosHerramientas::find($herramientaId);
        $herramienta = Herramientas::find($proyecto_herramienta->herramienta_id);
        $herramienta->cantidad += $request->cantidad;
        $herramienta->update();

        $proyecto_herramienta->cantidad_devuelta = $request->cantidad;
        $proyecto_herramienta->update();

        return redirect()->route('detalle_proyecto', ['id' => $proyectoId]);
    }

    //Agregar conductor al proyecto
    public function store_conductor_by_proyect(Request $request, $proyectoId)
    {
        $proyecto_conductor = new ProyectosConductores();
        $proyecto_conductor->proyecto_id = $proyectoId;
        $proyecto_conductor->conductor_id = $request->conductor;
        $proyecto_conductor->usuario_id = auth()->user()->id;
        $proyecto_conductor->save();

        return redirect()->route('detalle_proyecto', ['id' => $proyectoId]);
    }

    //Eliminar registro del conductor de la tabla de detalle
    public function delete_conductor_by_proyect($proyectoId, $proyectoconductorId)
    {
        $proyecto_conductor = ProyectosConductores::find($proyectoconductorId);
        $proyecto_conductor->delete();

        return redirect()->route('detalle_proyecto', ['id' => $proyectoId]);
    }

    //Crear pdf
    public function create_pdf($proyectoId)
    {

        $proyecto_material = ProyectosMateriales::where('proyecto_id', '=', $proyectoId)->get();
        $proyecto = Proyecto::find($proyectoId);
        $precio_total_materiales = ProyectosMateriales::where('proyecto_id', '=', $proyectoId)->sum('valor_total');

        date_default_timezone_set("America/El_Salvador");
        $fecha = date("Y-m-d H:m:s");

        $pdf = Pdf::loadView('proyecto.reporteMateriales', compact('proyecto_material', 'fecha', 'precio_total_materiales', 'proyecto'));

        return $pdf->stream();
    }
}
