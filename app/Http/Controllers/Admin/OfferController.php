<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        try {
            $offers =  Offer::get();
            return view('admin.offer.index' , compact('offers'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        return view('admin.offer.create');
    }

    public function store(Request $request)
    {
        try {
            Offer::create($request->all());
            return redirect()->route('admin.offer.index')->with('success', 'تم حفظ بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $offer = Offer::find($id);
        return view('admin.offer.update' , compact('offer'));
    }

    public function update(Request $request, $id)
    {
        try {
            $offer = Offer::find($id);
            $offer->update($request->all());
            return redirect()->route('admin.offer.index')->with('success', 'تم تعديل بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $offer = Offer::find($id);
            $offer->delete();
            return redirect()->route('admin.offer.index')->with('success', 'تم حذف');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
