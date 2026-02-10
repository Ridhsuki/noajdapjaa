<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Partner;
use App\Http\Requests\StoreAgentRequest;
use App\Http\Requests\UpdateAgentRequest;
use Illuminate\Support\Facades\Storage;

class AgentController extends Controller
{
    public function index()
    {
        $agents = Agent::latest()->paginate(10);
        return view('admin.agents.index', compact('agents'));
    }

    public function create()
    {
        $partners = Partner::select('id', 'name')->orderBy('name')->get();
        return view('admin.agents.create', compact('partners'));
    }

    public function store(StoreAgentRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('agents', 'public');
        }

        Agent::create($data);

        return redirect()->route('admin.agents.index')->with('success', 'Agent berhasil ditambahkan.');
    }

    public function edit(Agent $agent)
    {
        $partners = Partner::select('id', 'name')->orderBy('name')->get();
        return view('admin.agents.edit', compact('agent', 'partners'));
    }

    public function update(UpdateAgentRequest $request, Agent $agent)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            if ($agent->logo && Storage::disk('public')->exists($agent->logo)) {
                Storage::disk('public')->delete($agent->logo);
            }
            $data['logo'] = $request->file('logo')->store('agents', 'public');
        }

        $agent->update($data);

        return redirect()->route('admin.agents.index')->with('success', 'Agent berhasil diperbarui.');
    }

    public function destroy(Agent $agent)
    {
        if ($agent->logo && Storage::disk('public')->exists($agent->logo)) {
            Storage::disk('public')->delete($agent->logo);
        }

        $agent->delete();
        return redirect()->route('admin.agents.index')->with('success', 'Agent berhasil dihapus.');
    }
}
