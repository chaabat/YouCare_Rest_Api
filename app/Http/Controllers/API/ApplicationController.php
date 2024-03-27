<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;

class ApplicationController extends Controller
{
    public function userApplications()
    {
        $userApplications = Application::where('user_id', auth()->id())->get();

        return response()->json(['data' => $userApplications]);
    }


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

    public function index()
    {
        $applications = Application::whereHas('annonce', function ($query) {
            $query->where('user_id', auth()->id());
        })->get();

        return response()->json(['data' => $applications]);
    }


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
