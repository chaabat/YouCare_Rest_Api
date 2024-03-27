<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Annonce;
use Illuminate\Http\Request;

class AnnonceController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/index",
     *      summary="Get a list of annonces",
     *      tags={"Annonces"},
     *      @OA\Response(response=200, description="Successful operation"),
     *      @OA\Response(response=400, description="Invalid request")
     * )
     */
    public function index()
    {
        $annonce = Annonce::all();
        if ($annonce->isEmpty()) {
            return response()->json(['message' => 'No annonce to show'], 404);
        }
        return response()->json(['message' => $annonce]);
    }

    /**
     * @OA\Get(
     *      path="/api/annonce/{id}",
     *      summary="Get a specific annonce",
     *      tags={"Annonces"},
     *      @OA\Response(response=200, description="Successful operation"),
     *      @OA\Response(response=404, description="Annonce not found")
     * )
     */
    public function show($id)
    {
        $annonce = Annonce::find($id);
        if (!$annonce) {
            return response()->json(['message' => 'Annonce not found'], 404);
        }
        return response()->json(['message' => $annonce]);
    }

    /**
     * @OA\Post(
     *      path="/api/create",
     *      summary="Create a new annonce",
     *      tags={"Annonces"},
     *      @OA\Response(response=200, description="Annonce added successfully"),
     *      @OA\Response(response=400, description="Error occurred")
     * )
     */
    public function create(Request $request)
    {
        $annonce = Annonce::create($request->all());
        if (!$annonce) {
            return response()->json(['message' => 'Error occurred'], 400);
        }
        return response()->json(['message' => 'Annonce added successfully']);
    }

    /**
     * @OA\Put(
     *      path="/api/update/{id}",
     *      summary="Update an existing annonce",
     *      tags={"Annonces"},
     *      @OA\Response(response=200, description="Annonce updated successfully"),
     *      @OA\Response(response=404, description="Annonce not found")
     * )
     */
    public function update(Request $request, $id)
    {
        $annonce = Annonce::find($id);
        if (!$annonce) {
            return response()->json(['message' => 'Annonce not found'], 404);
        }
        $annonce->update($request->all());
        return response()->json(['message' => 'Annonce updated successfully']);
    }

    /**
     * @OA\Delete(
     *      path="/api/delete/{id}",
     *      summary="Delete an existing annonce",
     *      tags={"Annonces"},
     *      @OA\Response(response=200, description="Annonce deleted successfully"),
     *      @OA\Response(response=404, description="Annonce not found")
     * )
     */
    public function delete($id)
    {
        $annonce = Annonce::find($id);
        if (!$annonce) {
            return response()->json(['message' => 'Annonce not found'], 404);
        }
        $annonce->delete();
        return response()->json(['message' => 'Annonce deleted successfully']);
    }

    /**
     * @OA\Post(
     *      path="/api/filter",
     *      summary="Filter annonces based on criteria",
     *      tags={"Annonces"},
     *      @OA\Response(response=200, description="Successful operation"),
     *      @OA\Response(response=422, description="Invalid data provided")
     * )
     */
    public function filter(Request $request)
    {
        $request->validate([
            'type_id' => 'integer|nullable',
            'localisation' => 'string|nullable',
        ]);

        $query = Annonce::query();

        if ($request->has('type_id')) {
            $query->where('type_id', $request->type_id);
        }

        if ($request->has('localisation')) {
            $query->where('localisation', $request->localisation);
        }

        $annonces = $query->get();

        return response()->json(['data' => $annonces]);
    }
}
