let map;

function initMap() {
    map = new google.maps.Map(document.getElementById('map-container'), {
        center: { lat: 0, lng: 0 },
        zoom: 2
    });

    map.addListener('click', function (event) {
        const latLng = event.latLng;


        const geocoder = new google.maps.Geocoder();
        geocoder.geocode({ location: latLng }, function (results, status) {
            if (status === 'OK') {
                if (results[0]) {

                    const country = results[0].address_components.find(component => component.types.includes('country'));
                    const city = results[0].address_components.find(component => component.types.includes('locality'));


                    document.getElementById('pais').value = country ? country.long_name : '';
                    document.getElementById('ciudad').value = city ? city.long_name : '';
                } else {
                    window.alert('No se encontraron resultados.');
                }
            } else {
                window.alert('La geocodificación inversa falló debido a: ' + status);
            }
        });
    });
}