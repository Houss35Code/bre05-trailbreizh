<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class GuideController extends Controller
{
    /**
     * Liste des guides statiques disponibles.
     */
    private function getGuides(): array
    {
        return [
            [
                'slug'        => 'chaussures',
                'titre'       => 'Bien choisir ses chaussures de randonnée',
                'description' => 'Confort, maintien, semelles : tout ce qu\'il faut savoir avant d\'investir dans une paire de chaussures adaptée aux sentiers bretons.',
                'icone'       => '👟',
                'temps_lecture' => '5 min',
                'categorie'   => 'Équipement',
            ],
            [
                'slug'        => 'sentiers-gr',
                'titre'       => 'Les sentiers GR en Bretagne',
                'description' => 'GR 34, GR 380, GR 37… Découvrez les grandes traversées balisées qui sillonnent la Bretagne, du littoral aux monts d\'Arrée.',
                'icone'       => '🗺️',
                'temps_lecture' => '7 min',
                'categorie'   => 'Itinéraires',
            ],
            [
                'slug'        => 'preparation',
                'titre'       => 'Préparer sa randonnée en Bretagne',
                'description' => 'Météo capricieuse, marées, chemins côtiers : les conseils essentiels pour partir serein sur les sentiers bretons.',
                'icone'       => '🎒',
                'temps_lecture' => '6 min',
                'categorie'   => 'Conseils',
            ],
        ];
    }

    /**
     * Contenu détaillé de chaque guide.
     */
    private function getContenu(string $slug): array
    {
        $contenu = [

            // ----------------------------------------------------------------
            'chaussures' => [
                'intro' => 'Le choix des chaussures est probablement la décision la plus importante avant de partir en randonnée. En Bretagne, les terrains sont variés : sentiers côtiers rocheux, chemins forestiers boueux, landes tourbeuses. Une chaussure inadaptée peut transformer une belle balade en calvaire.',

                'sections' => [
                    [
                        'titre' => 'Les trois grandes catégories',
                        'contenu' => "<strong>Chaussures basses (trail)</strong> - Légères et souples, idéales pour les sentiers bien tracés et les randonnées d'une journée sans dénivelé important. Elles conviennent bien aux chemins côtiers du GR 34 par beau temps.\n\n<strong>Chaussures mid (tige montante)</strong> - Le meilleur compromis pour la Bretagne. Elles offrent un bon maintien de la cheville sur terrain irrégulier tout en restant respirantes. Recommandées pour la majorité des randonnées bretonnes.\n\n<strong>Chaussures hautes (trekking)</strong> - Pour les sorties de plusieurs jours avec un sac lourd, ou les terrains très techniques comme les crêtes des monts d'Arrée.",
                    ],
                    [
                        'titre' => 'Membrane imperméable : indispensable en Bretagne',
                        'contenu' => "La Bretagne est l'une des régions les plus arrosées de France. Une membrane imperméable de type Gore-Tex ou équivalent est fortement recommandée, même en été.\n\nAttention toutefois : l'imperméabilité réduit la respirabilité. Privilégiez des modèles avec membrane respirante pour éviter les pieds en nage lors des longues montées.",
                    ],
                    [
                        'titre' => 'Semelle Vibram : adhérence sur les rochers mouillés',
                        'contenu' => "Les rochers du littoral breton sont souvent couverts d'algues ou simplement humides. Une semelle Vibram avec des crampons bien dessinés fait toute la différence pour éviter les glissades.\n\nVérifiez aussi la rigidité de la semelle intercalaire : trop souple sur terrain rocheux, le pied fatigue ; trop rigide sur chemin de terre, le confort s'en ressent.",
                    ],
                    [
                        'titre' => 'Comment essayer et choisir',
                        'contenu' => "- Essayez toujours les chaussures en fin de journée, quand le pied est légèrement gonflé.\n- Portez vos chaussettes de randonnée habituelles lors de l'essayage.\n- Vérifiez que les orteils ne touchent pas le bout en descente (test du pouce).\n- Faites quelques pas sur un plan incliné si le magasin en dispose.\n- Prévoyez un budget entre 80 € et 200 € pour une paire de qualité.",
                    ],
                    [
                        'titre' => 'Entretien et durée de vie',
                        'contenu' => "Rincez vos chaussures à l'eau claire après chaque sortie en bord de mer (le sel attaque le cuir et les coutures). Laissez-les sécher à l'air libre, jamais près d'une source de chaleur directe.\n\nRenouveler le traitement hydrofuge tous les 3 à 6 mois selon l'utilisation. Une bonne paire correctement entretenue dure entre 500 et 800 km.",
                    ],
                ],

                'conseil_expert' => "En Bretagne, misez sur une chaussure mi-haute imperméable avec semelle Vibram. C'est le trio gagnant pour 90 % des randonnées de la région, quelle que soit la saison.",
            ],

            // ----------------------------------------------------------------
            'sentiers-gr' => [
                'intro' => 'La Bretagne est traversée par un réseau dense de sentiers de Grande Randonnée (GR), balisés en rouge et blanc par la Fédération Française de Randonnée Pédestre (FFRandonnée). Du Tour du Finistère aux chemins des douaniers, chaque GR raconte une histoire différente de la région.',

                'sections' => [
                    [
                        'titre' => 'GR 34 - Le sentier des douaniers',
                        'contenu' => "<strong>1 800 km · Côte complète · Difficulté : facile à moyenne</strong>\n\nC'est sans doute le sentier le plus emblématique de Bretagne. Il longe l'intégralité du littoral breton, des Abers du Finistère nord jusqu'au Mont-Saint-Michel. À l'origine chemin de surveillance des douaniers, il offre des panoramas constants sur la mer.\n\nPoints forts : la Côte de Granit Rose, les falaises du Cap Sizun, la presqu'île de Crozon, la Côte Sauvage du Quiberon.\n\nDurée pour l'intégralité : 45 à 55 jours.",
                    ],
                    [
                        'titre' => 'GR 37 - De Vitré aux monts d\'Arrée',
                        'contenu' => "<strong>290 km · Traversée intérieure · Difficulté : modérée</strong>\n\nCe sentier relie Vitré, en Ille-et-Vilaine, aux monts d'Arrée en passant par la forêt de Paimpont (Brocéliande). Il plonge dans la Bretagne intérieure, loin des côtes, pour découvrir bocages, landes et vallées encaissées.\n\nPoints forts : la forêt de Paimpont et ses légendes arthuriennes, les chaos granitiques des monts d'Arrée, les villages de caractère du Pays Glazik.",
                    ],
                    [
                        'titre' => 'GR 380 - Tour de Bretagne',
                        'contenu' => "<strong>1 400 km · Tour complet · Difficulté : modérée à soutenue</strong>\n\nLe GR 380 fait le tour complet de la Bretagne en restant plus à l'intérieur des terres que le GR 34. Il traverse les quatre départements et offre une vision globale de la diversité paysagère bretonne.\n\nDurée pour l'intégralité : 40 à 50 jours.",
                    ],
                    [
                        'titre' => 'GR 341 - Tour des monts d\'Arrée',
                        'contenu' => "<strong>130 km · Boucle · Difficulté : modérée</strong>\n\nUn tour parfait pour un séjour d'une semaine dans le Parc Naturel Régional d'Armorique. Les monts d'Arrée, bien que modestes en altitude (maximum 385 m au Roc'h Ruz), offrent des paysages de bout du monde, entre landes tourbeuses, tourbières et panoramas infinis.",
                    ],
                    [
                        'titre' => 'Le balisage GR : comment le lire',
                        'contenu' => "<strong>Bonne direction</strong> : deux traits horizontaux, blanc au-dessus, rouge en dessous.\n\n<strong>Mauvaise direction</strong> : croix formée par les deux traits.\n\n<strong>Changement de direction</strong> : angle orienté vers le bon chemin.\n\nLe balisage est apposé sur les arbres, les rochers, les murets et parfois les poteaux. En Bretagne, la végétation dense peut parfois masquer les marques - restez attentif et munissez-vous d'une carte IGN ou d'une application de navigation.",
                    ],
                ],

                'conseil_expert' => "Pour une première grande randonnée bretonne, commencez par un tronçon du GR 34 entre Perros-Guirec et Trébeurden : 3 jours de marche avec des paysages exceptionnels, une logistique simple et un dénivelé raisonnable.",
            ],

            // ----------------------------------------------------------------
            'preparation' => [
                'intro' => 'Partir randonner en Bretagne, c\'est accepter l\'imprévisible météo de la péninsule armoricaine. Mais avec une bonne préparation, cette incertitude devient une aventure plutôt qu\'un problème. Voici les fondamentaux pour partir serein.',

                'sections' => [
                    [
                        'titre' => 'La météo bretonne : s\'y préparer vraiment',
                        'contenu' => "La Bretagne peut connaître quatre saisons en une seule journée. Même en juillet, une veste imperméable est indispensable.\n\n<strong>Ressources fiables :</strong>\n- Météo France (météo-france.fr) : bulletins côtiers et de montagne pour les monts d'Arrée.\n- Windguru pour les journées venteuses sur le littoral.\n- La règle d'or : consultez la météo la veille et le matin même du départ.\n\n<strong>Les saisons :</strong> Le printemps (avril-mai) et l'automne (septembre-octobre) sont souvent les meilleures périodes : moins de monde, végétation magnifique, températures douces.",
                    ],
                    [
                        'titre' => 'Les marées : un facteur essentiel sur le littoral',
                        'contenu' => "Certains passages côtiers du GR 34 sont coupés à marée haute. C'est le cas notamment de certaines plages de la presqu'île de Crozon ou de passages en baie de Mont-Saint-Michel.\n\n<strong>Avant toute randonnée côtière :</strong>\n- Consultez les horaires de marée (service-public.fr ou l'application Marees).\n- Planifiez votre passage dans les zones sensibles avec 2 à 3 heures de marge avant et après la basse mer.\n- Ne jamais s'aventurer sur un estran sans avoir vérifié les horaires.",
                    ],
                    [
                        'titre' => 'Le sac à dos : contenu essentiel',
                        'contenu' => "<strong>Pour une journée (sac de 20-25 L) :</strong>\n- Eau : minimum 1,5 L (2 L par temps chaud)\n- Alimentation : sandwich, fruits secs, barres énergétiques\n- Imperméable et coupe-vent\n- Carte IGN ou téléphone avec appli offline (IGNrando, Komoot)\n- Trousse de premiers secours légère\n- Téléphone chargé et batterie externe\n- En bord de mer : crème solaire même par ciel voilé\n\n<strong>Pour un séjour de plusieurs jours (sac de 40-55 L) :</strong>\nAjoutez : vêtements de rechange, sac de couchage si bivouac, réchaud léger, lampe frontale.",
                    ],
                    [
                        'titre' => 'Sécurité et numéros utiles',
                        'contenu' => "- <strong>SAMU : 15</strong> - Urgences médicales\n- <strong>Pompiers : 18</strong>\n- <strong>CROSS (secours en mer) : 196</strong> - Indispensable à connaître sur le littoral\n- <strong>Numéro d'urgence européen : 112</strong>\n\nPrévenez toujours quelqu'un de votre itinéraire et de votre heure de retour prévue avant de partir sur un sentier isolé.",
                    ],
                    [
                        'titre' => 'Règles de bonne conduite sur les sentiers',
                        'contenu' => "- Ne cueillez pas les plantes protégées (ajoncs, bruyères, orchidées sauvages).\n- Refermez les barrières des pâturages après votre passage.\n- Emportez vos déchets, y compris les peaux de fruits.\n- Gardez les chiens en laisse, en particulier lors de la période de nidification (mars à juillet).\n- Ne faites pas de feu en dehors des zones prévues à cet effet.",
                    ],
                ],

                'conseil_expert' => "En Bretagne, la règle numéro un est simple : jamais sans imperméable. Le second conseil : téléchargez vos cartes en mode hors-ligne avant de partir - le réseau mobile est inexistant sur de nombreux tronçons.",
            ],
        ];

        return $contenu[$slug] ?? [];
    }

    /**
     * Affiche la liste des guides.
     */
    public function index(): View
    {
        $guides = $this->getGuides();

        return view('guides.index', compact('guides'));
    }

    /**
     * Affiche un guide par son slug.
     */
    public function show(string $slug): View|RedirectResponse
    {
        $guides  = $this->getGuides();
        $contenu = $this->getContenu($slug);

        // Trouver le guide correspondant au slug
        $guide = collect($guides)->firstWhere('slug', $slug);

        if (! $guide || empty($contenu)) {
            return redirect()
                ->route('guides.index')
                ->with('error', 'Ce guide n\'existe pas.');
        }

        // Guides suggérés (les autres, hors guide courant)
        $guidesSuggeres = collect($guides)->where('slug', '!=', $slug)->values()->all();

        return view('guides.show', compact('guide', 'contenu', 'guidesSuggeres'));
    }
}