<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;

class ApplicationController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/mes-application",
     *      summary="Get applications submitted by the authenticated user",
     *      tags={"Applications"},
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(response=200, description="Successful operation"),
     *      @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function userApplications()
    {
        $userApplications = Application::where('user_id', auth()->id())->get();

        return response()->json(['data' => $userApplications]);
    }

    /**
     * @OA\Post(
     *      path="/api/application",
     *      summary="Submit a new application",
     *      tags={"Applications"},
     *      security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"annonce_id"},
     *              @OA\Property(property="annonce_id", type="integer", example="1")
     *          )
     *      ),
     *      @OA\Response(response=201, description="Application submitted successfully"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function apply(Request $request)
    {
        $request->validate([
            'annonce_id' => 'required|exists:annonces,id',
        ]);

        $existingApplication = Application::where('user_id', auth()->id())
            ->where('annonce_id', $request->annonce_id)
            ->first();

        if ($existingApplication) {
            return response()->json(['message' => 'You have already applied to this announcement.'], 400);
        }

        $application = new Application();
        $application->user_id = auth()->id();
        $application->annonce_id = $request->annonce_id;
        $application->save();

        return response()->json(['message' => 'Application submitted successfully', 'data' => $application], 201);
    }

    /**
     * @OA\Get(
     *      path="/api/applications",
     *      summary="Get applications associated with announcements of the authenticated user",
     *      tags={"Applications"},
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(response=200, description="Successful operation"),
     *      @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function index()
    {
        $applications = Application::whereHas('annonce', function ($query) {
            $query->where('user_id', auth()->id());
        })->get();

        return response()->json(['data' => $applications]);
    }

    /**
     * @OA\Patch(
     *      path="/api/statut/{id}",
     *      summary="Update status of a specific application",
     *      tags={"Applications"},
     *      security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"status"},
     *              @OA\Property(property="status", type="string", enum={"accepted", "rejected"}, example="accepted")
     *          )
     *      ),
     *      @OA\Response(response=200, description="Application status updated successfully"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=401, description="Unauthenticated"),
     *      @OA\Response(response=404, description="Application not found")
     * )
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        $application = Application::findOrFail($id);
        $application->status = $request->status;
        $application->save();

        return response()->json(['message' => 'Application status updated successfully', 'data' => $application]);
    }
}
