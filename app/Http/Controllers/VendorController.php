<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\AlternateContact;
use App\Models\Godown;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // You can list all vendors here
        $vendors = Vendor::all();
        $vendors = Vendor::with(['alternateContacts', 'godowns'])->get();
        return view('admin.pages.vendors.vendors', compact('vendors'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.vendors.add_vendor');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'gst_no' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'contact_no' => 'required|string|max:20',
            'alternate_name.*' => 'required|string|max:255',
            'alternate_no.*' => 'required|string|max:20',
            'godown_address.*' => 'required|string|max:255',
            'pincode.*' => 'required|string|max:10',
            'contact_name.*' => 'required|string|max:255',
            'godown_mobile_no.*' => 'required|string|max:20',
        ]);

        DB::transaction(function () use ($request) {
            // Generate vendor_code like V001, V002 ...
            $lastVendor = Vendor::orderBy('id', 'desc')->first();
            $newNumber = $lastVendor ? ((int) str_replace('V', '', $lastVendor->vendor_code)) + 1 : 1;
            $vendorCode = 'V' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

            $vendor = Vendor::create([
                'vendor_code' => $vendorCode,
                'company_name' => $request->company_name,
                'gst_no' => $request->gst_no,
                'owner_name' => $request->owner_name,
                'contact_no' => $request->contact_no,
            ]);

            // Save alternate contacts
            foreach ($request->alternate_name as $key => $name) {
                AlternateContact::create([
                    'vendor_id' => $vendor->id,
                    'alternate_name' => $name,
                    'alternate_no' => $request->alternate_no[$key],
                ]);
            }

            // Save godowns
            foreach ($request->godown_address as $key => $address) {
                Godown::create([
                    'vendor_id' => $vendor->id,
                    'godown_address' => $address,
                    'pincode' => $request->pincode[$key],
                    'contact_name' => $request->contact_name[$key],
                    'godown_mobile_no' => $request->godown_mobile_no[$key],
                ]);
            }
        });

        return redirect()->back()->with('success', 'Vendor registered successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vendor = Vendor::with(['alternateContacts', 'godowns'])->findOrFail($id);
        return response()->json($vendor);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vendor = Vendor::with(['alternateContacts', 'godowns'])->findOrFail($id);
        return view('vendor.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vendor = Vendor::findOrFail($id);

        $request->validate([
            'company_name' => 'required|string|max:255',
            'gst_no' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'contact_no' => 'required|string|max:20',
            'alternate_name.*' => 'required|string|max:255',
            'alternate_no.*' => 'required|string|max:20',
            'godown_address.*' => 'required|string|max:255',
            'pincode.*' => 'required|string|max:10',
            'contact_name.*' => 'required|string|max:255',
            'godown_mobile_no.*' => 'required|string|max:20',
        ]);

        DB::transaction(function () use ($request, $vendor) {
            $vendor->update([
                'company_name' => $request->company_name,
                'gst_no' => $request->gst_no,
                'owner_name' => $request->owner_name,
                'contact_no' => $request->contact_no,
            ]);

            // Delete old alternate contacts & godowns
            $vendor->alternateContacts()->delete();
            $vendor->godowns()->delete();

            // Save new alternate contacts
            foreach ($request->alternate_name as $key => $name) {
                AlternateContact::create([
                    'vendor_id' => $vendor->id,
                    'alternate_name' => $name,
                    'alternate_no' => $request->alternate_no[$key],
                ]);
            }

            // Save new godowns
            foreach ($request->godown_address as $key => $address) {
                Godown::create([
                    'vendor_id' => $vendor->id,
                    'godown_address' => $address,
                    'pincode' => $request->pincode[$key],
                    'contact_name' => $request->contact_name[$key],
                    'godown_mobile_no' => $request->godown_mobile_no[$key],
                ]);
            }
        });

        return redirect()->back()->with('success', 'Vendor updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vendor = Vendor::findOrFail($id);

        DB::transaction(function () use ($vendor) {
            $vendor->alternateContacts()->delete();
            $vendor->godowns()->delete();
            $vendor->delete();
        });

        return redirect()->back()->with('success', 'Vendor deleted successfully!');
    }
    public function getGodowns($vendor_id)
    {
        $godowns = Godown::where('vendor_id', $vendor_id)->get();
        $count = $godowns->count();

        return response()->json([
            'godowns' => $godowns,
            'count' => $count
        ]);
    }
}
