<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Pilgrim;
use App\Http\Requests\StorePilgrimRequest;
use App\Http\Requests\UpdatePilgrimRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PilgrimController extends Controller
{
    public function index()
    {
        $pilgrims = Pilgrim::latest()->paginate(10);
        return view('admin.pilgrims.index', compact('pilgrims'));
    }

    public function create()
    {
        $agents = Agent::select('id', 'name')->orderBy('name')->get();
        return view('admin.pilgrims.create', compact('agents'));
    }

    public function store(StorePilgrimRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $request->file('photo')->store('pilgrims', 'public');
        }

        Pilgrim::create($data);

        return redirect()->route('admin.pilgrims.index')
            ->with('success', 'Data Jamaah berhasil disimpan.');
    }

    public function show(Pilgrim $pilgrim)
    {
        $qrUrl = route('scan.show', $pilgrim->uuid);
        return view('admin.pilgrims.show', compact('pilgrim', 'qrUrl'));
    }

    public function edit(Pilgrim $pilgrim)
    {
        $agents = Agent::select('id', 'name')->orderBy('name')->get();
        return view('admin.pilgrims.edit', compact('pilgrim', 'agents'));
    }

    public function update(UpdatePilgrimRequest $request, Pilgrim $pilgrim)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            if ($pilgrim->photo_path && Storage::disk('public')->exists($pilgrim->photo_path)) {
                Storage::disk('public')->delete($pilgrim->photo_path);
            }

            $data['photo_path'] = $request->file('photo')->store('pilgrims', 'public');
        }

        $pilgrim->update($data);

        return redirect()->route('admin.pilgrims.index')
            ->with('success', 'Data Jamaah berhasil diperbarui.');
    }

    public function destroy(Pilgrim $pilgrim)
    {
        $name = $pilgrim->name;
        if ($pilgrim->photo_path && Storage::disk('public')->exists($pilgrim->photo_path)) {
            Storage::disk('public')->delete($pilgrim->photo_path);
        }

        $pilgrim->delete();

        return redirect()->route('admin.pilgrims.index')
            ->with('success', "Data Jamaah atas nama {$name} berhasil dihapus.");
    }

    public function print(Pilgrim $pilgrim)
    {
        $qrUrl = route('scan.show', $pilgrim->uuid);
        return view('admin.pilgrims.print', compact('pilgrim', 'qrUrl'));
    }

    public function bulkPrint(Request $request)
    {
        $request->validate([
            'selected_pilgrims' => 'required|array',
            'selected_pilgrims.*' => 'exists:pilgrims,id',
        ]);

        $pilgrims = Pilgrim::with(['agent.partner'])
            ->whereIn('id', $request->input('selected_pilgrims'))
            ->get();

        return view('admin.pilgrims.print-bulk', compact('pilgrims'));
    }
}
