<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Randonnee;
use App\Models\User;
use App\Models\Avis;
use Illuminate\Http\Request;

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
}
