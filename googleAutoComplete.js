function initialize()
{
    var input = document.getElementById('locatie');
    var autocomplete = new google.maps.places.Autocomplete(/** @type {HTMLInputElement} */(input),{});
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            return;
        }
        //document.getElementById('fLat').value = place.geometry.location.lat();
        //document.getElementById('fLong').value = place.geometry.location.lng();

        var address = '';
        if (place.address_components)
        {
            address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }
        LoadEventCategory();
        LoadYelpData();
    });
}

google.maps.event.addDomListener(window, 'load', initialize);

