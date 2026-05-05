<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // GET /services
    public function index()
    {
        $services = Service::all();
        return response()->json([
            'success' => true,
            'data'    => $services,
        ], 200);
    }

    // GET /services/{id}
    public function show($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Service not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $service,
        ], 200);
    }

    // POST /services
    public function store(StoreServiceRequest $request)
    {        $validated = $request->validated();
        $service = Service::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Service created successfully',
            'data'    => $service,
        ], 201);
    }

    // PUT /services/{id}
    public function update(UpdateServiceRequest $request, $id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Service not found',
            ], 404);
        }


        $service->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Service updated successfully',
            'data'    => $service,
        ], 200);
    }

    // DELETE /services/{id}
    public function destroy($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Service not found',
            ], 404);
        }

        $service->delete();

        return response()->json([
            'success' => true,
            'message' => 'Service deleted successfully',
        ], 200);
    }
}