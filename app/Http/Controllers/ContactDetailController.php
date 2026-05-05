<?php

namespace App\Http\Controllers;

use App\Models\ContactDetail;
use Illuminate\Http\Request;

class ContactDetailController extends Controller
{
    // GET /contact-details
    public function index()
    {
        $contacts = ContactDetail::with('service')->get();
        return response()->json([
            'success' => true,
            'data'    => $contacts,
        ], 200);
    }

    // GET /contact-details/{id}
    public function show($id)
    {
        $contact = ContactDetail::with('service')->find($id);

        if (!$contact) {
            return response()->json([
                'success' => false,
                'message' => 'Contact not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $contact,
        ], 200);
    }

    // POST /contact-details
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'          => 'required|string|max:255',
            'last_name'           => 'required|string|max:255',
            'email'               => 'required|email|unique:contact_details,email',
            'company'             => 'nullable|string|max:255',
            'phone_number'        => 'nullable|string|max:20',
            'service_id'          => 'required|uuid|exists:services,id',
            'budget'              => 'nullable|string|max:255',
            'service_description' => 'required|string',
        ]);

        $contact = ContactDetail::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Contact created successfully',
            'data'    => $contact,
        ], 201);
    }

    // PUT /contact-details/{id}
    public function update(Request $request, $id)
    {
        $contact = ContactDetail::find($id);

        if (!$contact) {
            return response()->json([
                'success' => false,
                'message' => 'Contact not found',
            ], 404);
        }

        $validated = $request->validate([
            'first_name'          => 'sometimes|required|string|max:255',
            'last_name'           => 'sometimes|required|string|max:255',
            'email'               => 'sometimes|required|email|unique:contact_details,email,' . $id,
            'company'             => 'nullable|string|max:255',
            'phone_number'        => 'nullable|string|max:20',
            'service_id'          => 'sometimes|required|uuid|exists:services,id',
            'budget'              => 'nullable|string|max:255',
            'service_description' => 'sometimes|required|string',
        ]);

        $contact->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Contact updated successfully',
            'data'    => $contact,
        ], 200);
    }

    // DELETE /contact-details/{id}
    public function destroy($id)
    {
        $contact = ContactDetail::find($id);

        if (!$contact) {
            return response()->json([
                'success' => false,
                'message' => 'Contact not found',
            ], 404);
        }

        $contact->delete();

        return response()->json([
            'success' => true,
            'message' => 'Contact deleted successfully',
        ], 200);
    }
}