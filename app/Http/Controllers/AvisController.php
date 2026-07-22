<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Signalement;
use Illuminate\Http\Request;

class AvisController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'randonnee_id' => 'required|exists:randonnees,id',
            'note'         => 'required|integer|min:1|max:5',
            'commentaire'  => 'required|string|max:1000',
        ]);

        // Empêche un utilisateur de laisser plusieurs avis sur la même randonnée
        $dejaDonne = Avis::where('user_id', auth()->id())
            ->where('randonnee_id', $request->randonnee_id)
            ->exists();

        if ($dejaDonne) {
            return back()->with('error', 'Vous avez déjà laissé un avis pour cette randonnée.');
        }

        Avis::create([
            'user_id'      => auth()->id(),
            'randonnee_id' => $request->randonnee_id,
            'note'         => $request->note,
            'commentaire'  => $request->commentaire,
        ]);

        return back()->with('success', 'Votre avis a été publié !');
    }

    public function destroy(Avis $avis)
    {
        // Seul l'auteur peut supprimer son avis
        if ($avis->user_id !== auth()->id()) {
            return back()->with('error', 'Action non autorisée.');
        }

        $avis->delete();

        return back()->with('success', 'Avis supprimé.');
    }

    public function signaler(Request $request, Avis $avis)
    {
        $request->validate([
            'motif' => 'required|string|max:1000',
        ]);

        // Empêche de signaler son propre avis
        if ($avis->user_id === auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas signaler votre propre avis.');
        }

        // Empêche un signalement en double (la contrainte unique en base protège aussi ce cas)
        $dejaSignale = Signalement::where('user_id', auth()->id())
            ->where('signalable_type', Avis::class)
            ->where('signalable_id', $avis->id)
            ->exists();

        if ($dejaSignale) {
            return back()->with('error', 'Vous avez déjà signalé cet avis.');
        }

        Signalement::create([
            'user_id'         => auth()->id(),
            'signalable_type' => Avis::class,
            'signalable_id'   => $avis->id,
            'motif'           => $request->motif,
            'statut'          => 'en_attente',
        ]);

        $avis->update(['signale' => true]);

        return back()->with('success', 'Merci, cet avis a été signalé aux administrateurs.');
    }
}