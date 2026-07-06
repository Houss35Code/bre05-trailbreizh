<?php

namespace App\Http\Controllers;

use App\Models\Favori;
use Illuminate\Http\Request;

class FavoriController extends Controller
{
    public function store(Request $request)
    {
        Favori::firstOrCreate([
            'user_id'      => auth()->id(),
            'randonnee_id' => $request->randonnee_id,
        ]);

        return back()->with('success', 'Randonnée ajoutée aux favoris !');
    }

    public function destroy(Request $request)
    {
        Favori::where('user_id', auth()->id())
            ->where('randonnee_id', $request->randonnee_id)
            ->delete();

        return back()->with('success', 'Randonnée retirée des favoris.');
    }
}