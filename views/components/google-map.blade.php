@php
    $apiKey = \App\Support\Env::get('GOOGLE_MAPS_API_KEY');
    $lat = $lat ?? -16.8315;
    $lng = $lng ?? -49.5317;
    $zoom = $zoom ?? 16;
    $mapId = $mapId ?? 'ibnp-map-' . substr(md5((string) microtime()), 0, 6);
    $heightClass = $heightClass ?? 'h-72 sm:h-96';
    $title = $title ?? 'Igreja Batista Nacional da Paz de Guapó';
@endphp

<div 
    id="{{ $mapId }}-container" 
    class="relative w-full {{ $heightClass }} bg-surface-cream-light rounded-2xl overflow-hidden border border-outline-variant/30"
    role="region" 
    aria-label="Mapa de localização da Igreja Batista Nacional da Paz de Guapó">
    
    <div id="{{ $mapId }}" class="w-full h-full ibnp-map-instance">
        @if(empty($apiKey))
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3820.5!2d-49.5317!3d-16.8315!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTbCsDQ5JzUzLjQiUyA0OcKwMzEnNTQuMSJX!5e0!3m2!1spt-BR!2sbr!4v1700000000000" 
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade"
                title="Mapa da Sede da IBN da Paz de Guapó"
                class="w-full h-full">
            </iframe>
        @endif
    </div>

    <noscript>
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3820.5!2d-49.5317!3d-16.8315!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTbCsDQ5JzUzLjQiUyA0OcKwMzEnNTQuMSJX!5e0!3m2!1spt-BR!2sbr!4v1700000000000" 
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade"
            title="Mapa da Sede da IBN da Paz de Guapó"
            class="w-full h-full">
        </iframe>
    </noscript>
</div>

@if(!empty($apiKey))
    <script>
    (function() {
        if (!window.googleMapsScriptLoading) {
            window.googleMapsScriptLoading = true;
            window.ibnpMapsInitQueue = window.ibnpMapsInitQueue || [];
            window.initIbnpGoogleMaps = function() {
                window.ibnpMapsLoaded = true;
                if (window.ibnpMapsInitQueue) {
                    window.ibnpMapsInitQueue.forEach(function(fn) {
                        try { fn(); } catch(e) { console.error('Erro ao montar mapa:', e); }
                    });
                    window.ibnpMapsInitQueue = [];
                }
            };

            var script = document.createElement('script');
            script.src = 'https://maps.googleapis.com/maps/api/js?key={{ $apiKey }}&callback=initIbnpGoogleMaps';
            script.async = true;
            script.defer = true;
            script.onerror = function() {
                console.warn('Falha ao carregar Google Maps API. Ativando fallback.');
                var instances = document.querySelectorAll('.ibnp-map-instance');
                instances.forEach(function(el) {
                    el.innerHTML = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3820.5!2d-49.5317!3d-16.8315!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTbCsDQ5JzUzLjQiUyA0OcKwMzEnNTQuMSJX!5e0!3m2!1spt-BR!2sbr!4v1700000000000" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Mapa da Sede da IBN da Paz de Guapó" class="w-full h-full"></iframe>';
                });
            };
            document.head.appendChild(script);
        }

        function mountMap() {
            var el = document.getElementById('{{ $mapId }}');
            if (!el || !window.google || !window.google.maps) return;

            var churchPos = { lat: {{ $lat }}, lng: {{ $lng }} };

            var mapStyles = [
                { "featureType": "administrative", "elementType": "labels.text.fill", "stylers": [{ "color": "#5D4037" }] },
                { "featureType": "landscape", "elementType": "all", "stylers": [{ "color": "#FBF8F3" }] },
                { "featureType": "poi", "elementType": "all", "stylers": [{ "visibility": "simplified" }] },
                { "featureType": "poi.business", "elementType": "all", "stylers": [{ "visibility": "off" }] },
                { "featureType": "road", "elementType": "geometry", "stylers": [{ "color": "#F2E8DC" }] },
                { "featureType": "road.arterial", "elementType": "geometry", "stylers": [{ "color": "#EADBC8" }] },
                { "featureType": "road.highway", "elementType": "geometry", "stylers": [{ "color": "#DFB88B" }] },
                { "featureType": "water", "elementType": "all", "stylers": [{ "color": "#D5E3E8" }] }
            ];

            var map = new google.maps.Map(el, {
                center: churchPos,
                zoom: {{ $zoom }},
                gestureHandling: 'cooperative',
                styles: mapStyles,
                mapTypeControl: false,
                streetViewControl: true,
                fullscreenControl: true,
                zoomControl: true
            });

            var marker = new google.maps.Marker({
                position: churchPos,
                map: map,
                title: "{{ $title }}",
                animation: google.maps.Animation.DROP
            });

            var infoContent = '<div style="max-width:280px; font-family:sans-serif; padding:6px 4px; color:#2A2521;">' +
                '<h4 style="margin:0 0 6px 0; font-size:14px; font-weight:800; color:#8C3D15;">IBN da Paz de Guapó</h4>' +
                '<p style="margin:0 0 8px 0; font-size:12px; line-height:1.4; color:#5D4037;">Rua Pres. Kennedy, Qd. 21, Lt. 13, Centro, Guapó - GO</p>' +
                '<div style="background:#FFF9F2; border:1px solid #EADBC8; border-radius:8px; padding:6px 8px; margin-bottom:10px; font-size:11px;">' +
                '<strong style="display:block; color:#8C3D15; margin-bottom:2px;">Encontros Semanais:</strong>' +
                'Quartas e Domingos às 19:30' +
                '</div>' +
                '<a href="https://maps.google.com/?q=Igreja+Batista+Nacional+da+Paz+Guapo+GO" target="_blank" rel="noopener noreferrer" style="display:inline-flex; align-items:center; justify-content:center; gap:4px; width:100%; background:#8C3D15; color:#ffffff; padding:8px 12px; border-radius:6px; font-size:11px; font-weight:bold; text-decoration:none; box-sizing:border-box;">' +
                'Traçar Rota no Google Maps' +
                '</a>' +
                '</div>';

            var infoWindow = new google.maps.InfoWindow({
                content: infoContent
            });

            marker.addListener('click', function() {
                infoWindow.open(map, marker);
            });

            infoWindow.open(map, marker);
        }

        if (window.ibnpMapsLoaded) {
            mountMap();
        } else {
            window.ibnpMapsInitQueue = window.ibnpMapsInitQueue || [];
            window.ibnpMapsInitQueue.push(mountMap);
        }
    })();
    </script>
@endif
