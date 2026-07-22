<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AvisAvertissementMail;
use App\Mail\RandonneeRefuseeMail;
use App\Mail\RandonneeValideeMail;
use App\Models\Avis;
use App\Models\Randonnee;
use App\Models\Signalement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'randonnees'   => Randonnee::count(),
            'utilisateurs' => User::count(),
            'avis'         => Avis::count(),
        ];

        return view('admin.index', compact('stats'));
    }

    public function randonnees()
    {
        $randonnees = Randonnee::with('user')->latest()->paginate(20);
        return view('admin.randonnees', compact('randonnees'));
    }

    public function deleteRandonnee(Randonnee $randonnee)
    {
        $randonnee->delete();
        return back()->with('success', 'Randonnée supprimée.');
    }

    public function randonneesEnAttente()
    {
        $randonnees = Randonnee::with('user')
            ->where('statut', 'en_attente')
            ->latest()
            ->paginate(20);

        return view('admin.randonnees-en-attente', compact('randonnees'));
    }

    public function valider(Randonnee $randonnee)
    {
        $randonnee->update([
            'statut'      => 'publie',
            'motif_refus' => null,
        ]);

        Mail::to($randonnee->user->email)->send(new RandonneeValideeMail($randonnee));

        return back()->with('success', 'Randonnée validée et publiée.');
    }

    public function refuser(Request $request, Randonnee $randonnee)
    {
        $validated = $request->validate([
            'motif' => 'required|string|max:1000',
        ]);

        $randonnee->update([
            'statut'      => 'refuse',
            'motif_refus' => $validated['motif'],
        ]);

        Mail::to($randonnee->user->email)->send(new RandonneeRefuseeMail($randonnee));

        return back()->with('success', 'Randonnée refusée.');
    }

    public function corbeille()
    {
        $randonnees = Randonnee::onlyTrashed()->with('user')->latest()->paginate(20);
        return view('admin.corbeille', compact('randonnees'));
    }

    public function restaurer($id)
    {
        $randonnee = Randonnee::onlyTrashed()->findOrFail($id);
        $randonnee->restore();

        return back()->with('success', 'Randonnée restaurée.');
    }

    public function utilisateurs()
    {
        $utilisateurs = User::latest()->paginate(20);
        return view('admin.utilisateurs', compact('utilisateurs'));
    }

    public function deleteUtilisateur(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->delete();
        return back()->with('success', 'Utilisateur supprimé.');
    }

    public function avis()
    {
        $avis = Avis::with('user', 'randonnee')->latest()->paginate(20);
        return view('admin.avis', compact('avis'));
    }

    public function deleteAvis(Avis $avis)
    {
        $avis->delete();
        return back()->with('success', 'Avis supprimé.');
    }

    public function avisSignales()
    {
        $avis = Avis::with(['user', 'randonnee', 'signalements' => function ($query) {
                $query->where('statut', 'en_attente')->with('user');
            }])
            ->whereHas('signalements', function ($query) {
                $query->where('statut', 'en_attente');
            })
            ->latest()
            ->paginate(20);

        return view('admin.avis-signales', compact('avis'));
    }

    public function supprimerAvisSignale(Avis $avis)
    {
        $avis->signalements()->where('statut', 'en_attente')->update(['statut' => 'traite']);
        $avis->delete();

        return back()->with('success', 'Avis supprimé.');
    }

    public function ignorerSignalement(Signalement $signalement)
    {
        $signalement->update(['statut' => 'ignore']);

        $avis = $signalement->signalable;

        // Ne repasse "signale" à false que s'il ne reste plus aucun signalement en attente
        if ($avis && ! $avis->signalements()->where('statut', 'en_attente')->exists()) {
            $avis->update(['signale' => false]);
        }

        return back()->with('success', 'Signalement ignoré.');
    }

    public function avertirAuteur(Avis $avis)
    {
        Mail::to($avis->user->email)->send(new AvisAvertissementMail($avis));

        return back()->with('success', 'Avertissement envoyé à l\'auteur.');
    }
}