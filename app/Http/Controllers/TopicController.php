<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Reponse;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::with('user', 'reponses')->latest()->paginate(15);
        return view('forum.index', compact('topics'));
    }

    public function create()
    {
        return view('forum.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre'     => 'required|string|max:255',
            'contenu'   => 'required|string',
            'categorie' => 'required|in:general,conseils,materiel,parcours',
        ]);

        $topic = Topic::create([
            'user_id'   => auth()->id(),
            'titre'     => $request->titre,
            'contenu'   => $request->contenu,
            'categorie' => $request->categorie,
        ]);

        return redirect()->route('forum.show', $topic)->with('success', 'Sujet créé avec succès !');
    }

    public function show(Topic $topic)
    {
        $topic->load('user', 'reponses.user');
        return view('forum.show', compact('topic'));
    }

    public function storeReponse(Request $request, Topic $topic)
    {
        $request->validate([
            'contenu' => 'required|string|max:2000',
        ]);

        Reponse::create([
            'user_id'  => auth()->id(),
            'topic_id' => $topic->id,
            'contenu'  => $request->contenu,
        ]);

        return redirect()->route('forum.show', $topic)->with('success', 'Réponse publiée !');
    }

    public function destroyReponse(Reponse $reponse)
    {
        if ($reponse->user_id !== auth()->id()) {
            return back()->with('error', 'Action non autorisée.');
        }

        $reponse->delete();

        return back()->with('success', 'Réponse supprimée.');
    }
}
