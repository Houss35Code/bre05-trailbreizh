<?php

namespace Tests\Feature;

use App\Models\Randonnee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RandonneeAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Crée une randonnée avec tous les champs obligatoires,
     * sans passer par une factory (aucune RandonneeFactory en place).
     */
    private function creerRandonnee(int $userId, string $statut = 'en_attente'): Randonnee
    {
        return Randonnee::create([
            'user_id'      => $userId,
            'titre'        => 'Tour du Cap Sizun',
            'slug'         => 'tour-du-cap-sizun-' . uniqid(),
            'description'  => 'Une belle randonnée côtière dans le Finistère.',
            'difficulte'   => 'moyen',
            'distance_km'  => 12.5,
            'denivele_m'   => 320,
            'duree_min'    => 240,
            'departement'  => 'finistere',
            'type_terrain' => 'cote',
            'statut'       => $statut,
        ]);
    }

    public function test_un_utilisateur_ne_peut_pas_acceder_au_formulaire_dedition_dune_autre_randonnee(): void
    {
        $auteur = User::factory()->create();
        $autre  = User::factory()->create();
        $randonnee = $this->creerRandonnee($auteur->id);

        $this->actingAs($autre)
            ->get(route('randonnees.edit', $randonnee))
            ->assertForbidden(); // 403
    }

    public function test_un_utilisateur_ne_peut_pas_supprimer_la_randonnee_dun_autre(): void
    {
        $auteur = User::factory()->create();
        $autre  = User::factory()->create();
        $randonnee = $this->creerRandonnee($auteur->id);

        $this->actingAs($autre)
            ->delete(route('randonnees.destroy', $randonnee))
            ->assertForbidden(); // 403

        $this->assertNotSoftDeleted('randonnees', ['id' => $randonnee->id]);
    }

    public function test_lauteur_peut_bien_supprimer_sa_propre_randonnee(): void
    {
        $auteur = User::factory()->create();
        $randonnee = $this->creerRandonnee($auteur->id);

        $this->actingAs($auteur)
            ->delete(route('randonnees.destroy', $randonnee))
            ->assertRedirect(route('randonnees.index'));

        $this->assertSoftDeleted('randonnees', ['id' => $randonnee->id]);
    }

    public function test_ladmin_peut_valider_une_randonnee_en_attente(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $auteur = User::factory()->create();
        $randonnee = $this->creerRandonnee($auteur->id, 'en_attente');

        $this->actingAs($admin)
            ->patch(route('admin.randonnees.valider', $randonnee))
            ->assertRedirect();

        $this->assertSame('publie', $randonnee->fresh()->statut);
    }

    public function test_ladmin_peut_refuser_une_randonnee_avec_motif(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $auteur = User::factory()->create();
        $randonnee = $this->creerRandonnee($auteur->id, 'en_attente');

        $this->actingAs($admin)
            ->patch(route('admin.randonnees.refuser', $randonnee), [
                'motif' => 'Tracé GPX incomplet, merci de le refaire.',
            ])
            ->assertRedirect();

        $randonnee->refresh();
        $this->assertSame('refuse', $randonnee->statut);
        $this->assertSame('Tracé GPX incomplet, merci de le refaire.', $randonnee->motif_refus);
    }

    public function test_refuser_sans_motif_est_bloque(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $auteur = User::factory()->create();
        $randonnee = $this->creerRandonnee($auteur->id, 'en_attente');

        $this->actingAs($admin)
            ->patch(route('admin.randonnees.refuser', $randonnee), [
                'motif' => '',
            ])
            ->assertSessionHasErrors('motif');

        $this->assertSame('en_attente', $randonnee->fresh()->statut);
    }

    public function test_ladmin_peut_restaurer_une_randonnee_supprimee(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $auteur = User::factory()->create();
        $randonnee = $this->creerRandonnee($auteur->id);
        $randonnee->delete(); // soft delete

        $this->actingAs($admin)
            ->patch(route('admin.randonnees.restaurer', $randonnee->id))
            ->assertRedirect();

        $this->assertNull($randonnee->fresh()->deleted_at);
    }

    public function test_un_visiteur_non_connecte_ne_peut_pas_acceder_aux_routes_admin(): void
    {
        $auteur = User::factory()->create();
        $randonnee = $this->creerRandonnee($auteur->id);

        $this->patch(route('admin.randonnees.valider', $randonnee))
            ->assertRedirect(route('login')); // middleware auth redirige

        $utilisateurNonAdmin = User::factory()->create(); // role 'user' par défaut
        $this->actingAs($utilisateurNonAdmin)
            ->patch(route('admin.randonnees.valider', $randonnee))
            ->assertForbidden(); // middleware admin bloque
    }
}