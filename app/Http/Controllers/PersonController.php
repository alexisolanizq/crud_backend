<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonRequest;
use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/people",
     *     summary="Listar todos los registros",
     *     description="Obtiene todos las personas registradas de forma paginada.",
     *     tags={"Catálogo de Personas"},
     *     @OA\Response(
     *         response=200,
     *         description="Mostrar todos los personas registradas."
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Ha ocurrido un error."
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Error en el servidor"
     *     )
     * )
     */
    public function index()
    {
        return Person::orderByDesc('id')->paginate(4);
    }

    /**
     * @OA\Post(
     *     path="/api/people",
     *     summary="Crear un nuevo registro",
     *     description="Crea un nuevo registro en el catálogo de personas",
     *     tags={"Catálogo de Personas"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="full_name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="birthdate",
     *                     type="date"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="phone",
     *                     type="number"
     *                 ),
     *                 @OA\Property(
     *                     property="job_title",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="address",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="country",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="age",
     *                     type="number"
     *                 ),
     *                 @OA\Property(
     *                     property="company",
     *                     type="string"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Registro exitoso en la base de datos"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="No se ha podido procesar el registro"
     *     ),
     * )
     */
    public function store(PersonRequest $request)
    {
        return Person::create($request->validated());
    }

    /**
     * @OA\Get(
     *     path="/api/people/{person}",
     *     tags={"Catálogo de Personas"},
     *     summary="Mostrar información de un registro",
     *     @OA\Parameter(
     *         description="Parámetro necesario para consultar los datos de una persona",
     *         in="path",
     *         name="person",
     *         required=true,
     *         @OA\Schema(type="number"),
     *         @OA\Examples(example="int", value="1", summary="Introduce un ID de un usuario.")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Muestra la información del usuario."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No se ha encontró el usuario."
     *     ),
     * )
     */
    public function show(Person $person)
    {
        return $person;
    }

    /**
     * @OA\Patch(
     *     path="api/people/{person}",
     *     tags={"Catálogo de Personas"},
     *     summary="Actualizar un registro",
     *     @OA\Parameter(
     *         description="Parámetro necesario para actualizar los datos de un persona",
     *         in="path",
     *         name="person",
     *         required=true,
     *         @OA\Schema(type="number"),
     *         @OA\Examples(example="int", value=1, summary="Introduce un ID de usuario.")
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="full_name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="birthdate",
     *                     type="date"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="phone",
     *                     type="number"
     *                 ),
     *                 @OA\Property(
     *                     property="job_title",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="address",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="country",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="age",
     *                     type="number"
     *                 ),
     *                 @OA\Property(
     *                     property="company",
     *                     type="string"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="El usuario se actualizo correctamente"
     *     )
     * )
     */
    public function update(PersonRequest $request, Person $person)
    {
        return $person->update($request->validated());
    }

    /**
     * @OA\Delete(
     *     path="/api/people/{person}",
     *     tags={"Catálogo de Personas"},
     *     summary="Eliminar un registro",
     *     @OA\Parameter(
     *         description="Parámetro necesario para actualizar los datos de un persona",
     *         in="path",
     *         name="person",
     *         required=true,
     *         @OA\Schema(type="number"),
     *         @OA\Examples(example="int", value=1, summary="Introduce un ID de usuario.")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="El usuario se elimino correctamente"
     *     )
     * )
     */
    public function destroy(Person $person)
    {
        $person->delete();
        return response()->noContent();
    }
}
