<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'randonnee_id' => 'required|exists:randonnees,id',
            'photo'        => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'alt'          => 'nullable|string|max:255',
        ]);

        $path = $request->file('photo')->store('photos', 'public');

        Photo::create([
            'randonnee_id' => $request->randonnee_id,
            'user_id'      => auth()->id(),
            'filename'     => $path,
            'alt'          => $request->alt ?? '',
        ]);

        return back()->with('success', 'Photo ajoutée avec succès !');
    }

    public function destroy(Photo $photo)
    {
        if ($photo->user_id !== auth()->id()) {
            return back()->with('error', 'Action non autorisée.');
        }

        \Storage::disk('public')->delete($photo->filename);
        $photo->delete();

        return back()->with('success', 'Photo supprimée.');
    }
}