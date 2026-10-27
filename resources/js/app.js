import './bootstrap';
import Alpine from 'alpinejs';
import './map.js';

// Enregistrement de composants Alpine globaux pour l'administration
document.addEventListener('alpine:init', () => {
    Alpine.data('refuseForm', () => ({
        submitRefuse(e) {
            const motif = prompt('Veuillez indiquer le motif du refus :');
            if (!motif) {
                e.preventDefault();
                return;
            }
            this.$refs.motifInput.value = motif;
        }
    }));

    Alpine.data('deleteForm', () => ({
        submitDelete(e) {
            if (!confirm('Supprimer cette randonnée ?')) {
                e.preventDefault();
            }
        }
    }));
});

window.Alpine = Alpine;
Alpine.start();
