<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Marketer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MarketerController extends Controller
{
    public function index()
    {
        try {
            $marketers = Marketer::get();
            return view('admin.marketer.index', compact('marketers'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        return view('admin.marketer.create');
    }

    public function store(Request $request)
    {
        try {
            $marketer = new Marketer();
            $marketer->name = $request->name;
            $marketer->email = $request->email;
            $marketer->unique_link = Str::random(10); // Generate a random 10-character string
            $marketer->save();

            return redirect()->route('admin.marketers.index')->with('success', 'Marketer created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $marketer = Marketer::find($id);
        return view('admin.marketer.edit', compact('marketer'));
    }

    public function show($id)
    {
        $marketer = Marketer::with('orders.customer')->findOrFail($id);

        // Calculate total commission
        $totalCommission = $marketer->orders->sum(function ($order) {
            return $order->marketer ? $order->total * 0.1 : 0; // Assuming 10% commission rate
        });

        $marketer->total_commission = $totalCommission;


        return view('admin.marketer.show', compact('marketer'));
    }

    public function update(Request $request, $id)
    {
        try {
            $marketer = Marketer::find($id);
            $marketer->update($request->all());

            return redirect()->route('admin.marketers.index')->with('success', 'Marketer updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $marketer = Marketer::find($id);
            $marketer->delete();

            return redirect()->route('admin.marketers.index')->with('success', 'Marketer deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
