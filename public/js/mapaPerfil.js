let map;
let geocoder;

function initMap() {
    map = new google.maps.Map(document.getElementById('map-container'), {
        center: { lat: 0, lng: 0 },
        zoom: 2
    });

    geocoder = new google.maps.Geocoder();

    // Obtener valores de ciudad y país del HTML
    const city = document.getElementById('ciudad').value;
    const country = document.getElementById('pais').value;

    if (city && country) {
        geocodeAddress(city, country);
    }

    map.addListener('click', function (event) {
        const latLng = event.latLng;

        geocoder.geocode({ location: latLng }, function (results, status) {
            if (status === 'OK') {
                if (results[0]) {
                    const countryComponent = results[0].address_components.find(component => component.types.includes('country'));
                    const cityComponent = results[0].address_components.find(component => component.types.includes('locality'));

                    document.getElementById('pais').value = countryComponent ? countryComponent.long_name : '';
                    document.getElementById('ciudad').value = cityComponent ? cityComponent.long_name : '';
                } else {
                    window.alert('No se encontraron resultados.');
                }
            } else {
                window.alert('La geocodificación inversa falló debido a: ' + status);
            }
        });
    });
}

function geocodeAddress(city, country) {
    const address = `${city}, ${country}`;
    geocoder.geocode({ address: address }, function (results, status) {
        if (status === 'OK') {
            map.setCenter(results[0].geometry.location);
            map.setZoom(10); // Ajusta el nivel de zoom según tus necesidades

            new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });
        } else {
            console.error('La geocodificación falló debido a: ' + status);
        }
    });
}