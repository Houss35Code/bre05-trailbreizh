<?php

namespace App\Http\Controllers;

use App\Models\Randonnee;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RandonneeController extends Controller
{
    public function index(Request $request)
    {
        $query = Randonnee::where('statut', 'publie');

        if ($request->filled('departement')) {
            $query->where('departement', $request->departement);
        }

        if ($request->filled('difficulte')) {
            $query->where('difficulte', $request->difficulte);
        }

        if ($request->filled('type_terrain')) {
            $query->where('type_terrain', $request->type_terrain);
        }

        if ($request->filled('search')) {
            $query->where('titre', 'like', '%' . $request->search . '%');
        }

        $randonnees = $query->orderBy('created_at', 'desc')->paginate(9);

        return view('randonnees.index', compact('randonnees'));
    }

    public function show(Randonnee $randonnee)
    {
        return view('randonnees.show', compact('randonnee'));
    }

    public function create()
    {
        return view('randonnees.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre'       => 'required|string|max:255',
            'description' => 'required|string',
            'difficulte'  => 'required|in:facile,moyen,difficile,expert',
            'distance_km' => 'required|numeric|min:0',
            'duree_min'   => 'required|integer|min:0',
            'departement' => 'required|string|max:100',
            'gpx'         => 'nullable|file|mimes:gpx,xml|max:5120',
        ]);

        if ($request->hasFile('gpx')) {
            $path = $request->file('gpx')->store('gpx', 'public');
            $validated['gpx_file'] = $path;
        }

        $validated['user_id']    = auth()->id();
        $validated['statut']     = 'en_attente';
        $validated['slug']       = Str::slug($validated['titre']);
        $validated['denivele_m'] = 0;

        $randonnee = Randonnee::create($validated);

        return redirect()
            ->route('randonnees.show', $randonnee)
            ->with('success', 'Randonnée soumise avec succès ! Elle sera visible après validation par un administrateur.');
    }

    public function edit(Randonnee $randonnee)
    {
        if ($randonnee->user_id !== auth()->id()) {
            abort(403, 'Vous ne pouvez modifier que vos propres randonnées.');
        }

        return view('randonnees.edit', compact('randonnee'));
    }

    public function update(Request $request, Randonnee $randonnee)
    {
        if ($randonnee->user_id !== auth()->id()) {
            abort(403, 'Vous ne pouvez modifier que vos propres randonnées.');
        }

        $validated = $request->validate([
            'titre'        => 'required|string|max:255',
            'description'  => 'required|string',
            'difficulte'   => 'required|in:facile,moyen,difficile,expert',
            'distance_km'  => 'required|numeric|min:0',
            'denivele_m'   => 'nullable|integer|min:0',
            'duree_min'    => 'required|integer|min:0',
            'departement'  => 'required|string|max:100',
            'type_terrain' => 'nullable|string|max:100',
            'gpx'          => 'nullable|file|mimes:gpx,xml|max:5120',
        ]);

        if ($request->hasFile('gpx')) {
            $path = $request->file('gpx')->store('gpx', 'public');
            $validated['gpx_file'] = $path;
        }

        $validated['slug']   = Str::slug($validated['titre']);
        $validated['statut'] = 'en_attente';

        $randonnee->update($validated);

        return redirect()
            ->route('randonnees.show', $randonnee)
            ->with('success', 'Randonnée mise à jour. Elle repasse en attente de validation.');
    }

    public function destroy(Randonnee $randonnee)
    {
        if ($randonnee->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403, 'Action non autorisée.');
        }

        $randonnee->delete();

        return redirect()
            ->route('randonnees.index')
            ->with('success', 'Randonnée supprimée.');
    }
}