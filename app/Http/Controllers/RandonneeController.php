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
        $validated['statut']     = 'publie';
        $validated['slug']       = Str::slug($validated['titre']);
        $validated['denivele_m'] = 0;

        $randonnee = Randonnee::create($validated);

        return redirect()
            ->route('randonnees.show', $randonnee)
            ->with('success', 'Randonnée ajoutée avec succès !');
    }
}