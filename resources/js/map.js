import L from 'leaflet';
import 'leaflet/dist/leaflet.css';
import 'leaflet-gpx';

// Fix icônes Leaflet avec Vite
import markerIcon from 'leaflet/dist/images/marker-icon.png';
import markerIcon2x from 'leaflet/dist/images/marker-icon-2x.png';
import markerShadow from 'leaflet/dist/images/marker-shadow.png';

delete L.Icon.Default.prototype._getIconUrl;
L.Icon.Default.mergeOptions({
    iconUrl: markerIcon,
    iconRetinaUrl: markerIcon2x,
    shadowUrl: markerShadow,
});

// Initialise la carte seulement si l'élément existe
const mapElement = document.getElementById('map');

if (mapElement) {
    const gpxUrl = mapElement.dataset.gpx;

    const map = L.map('map').setView([48.2020, -2.9326], 9);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    if (gpxUrl) {
        new L.GPX(gpxUrl, {
            async: true,
            marker_options: {
                startIconUrl: null,
                endIconUrl: null,
                shadowUrl: null,
            }
        }).on('loaded', function(e) {
            map.fitBounds(e.target.getBounds());
        }).addTo(map);
    }
}