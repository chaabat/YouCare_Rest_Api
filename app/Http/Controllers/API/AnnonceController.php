<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Annonce;
use Illuminate\Http\Request;

class AnnonceController extends Controller
{
    public function index()
    {
        $annonce = Annonce::all();
        if ($annonce) {
            return response()->json(['message' => $annonce]);
        }
        return response()->json(['message' => 'no annonce to show']);
    }

    public function show($id)
    {

        $annonce = Annonce::findOrFail($id);
        if ($annonce) {
            return response()->json(['message' => $annonce]);
        }
        return response()->json(['message' => 'Annonce not found']);
    }


    public function create(Request $request)
    {
        $annonce = Annonce::create([
            'titre' => $request->titre,
            'date' => $request->date,
            'description' => $request->description,
            'localisation' => $request->localisation,
            'competence' => $request->competence,
            'user_id' => $request->user_id,
            'type_id' => $request->type_id,
        ]);

        if (!$annonce) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'added successfully']);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'titre' => 'required',
            'date' => 'required',
            'description' => 'required',
            'localisation' => 'required',
            'competence' => 'required',
            'user_id' => 'required',
            'type_id' => 'required',
        ]);

        $annonce = Annonce::where("id", $request->id)->update($data);
        if ($annonce) {
            return response()->json(['message' => 'Annonce updated successfully']);
        }
        return response()->json(['message' => 'Annonce not found'], 404);
    }

    public function delete(Request $request)
    {
        $annonce = Annonce::find($request->id);
        if ($annonce) {
            $annonce->delete();
            return response()->json(['message' => 'Annonce delete successfully']);
        }
        return response()->json(['message' => 'Annonce not deleted'], 404);
    }

  public function filter(Request $request)
{
    $request->validate([
        'type_id' => 'integer|nullable',
        'localisation' => 'string|nullable',
    ]);

    $query = Annonce::query();

    $query->where(function ($query) use ($request) {
        if ($request->has('type_id')) {
            $query->where('type_id', $request->type_id);
        }

        if ($request->has('localisation')) {
            $query->where('localisation', $request->localisation);
        }
    });

    $annonces = $query->get();

    return response()->json(['data' => $annonces]);
}

}
