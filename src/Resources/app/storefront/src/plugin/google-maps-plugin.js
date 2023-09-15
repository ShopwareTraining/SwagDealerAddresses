import Plugin from 'src/plugin-system/plugin.class';
import DomAccess from 'src/helper/dom-access.helper';

class GoogleMaps extends Plugin {
    static options = {
        key: 'YOUR_API_KEY',
        dealers: []
    }

    map = null

    init() {
        this.initMaps();
        this.initJumpToMarker();
    }

    async initMaps() {
        const defaultDealer = this.options.dealers[0];

        const {Map} = await google.maps.importLibrary("maps");
        const {AdvancedMarkerElement} = await google.maps.importLibrary("marker");

        this.map = new Map(document.getElementById("map"), {
            zoom: 4,
            mapId: "DEALER_ADDRESS_MAP",
        });

        this.options.dealers.forEach((dealer) => {
            const marker = new AdvancedMarkerElement({
                map: this.map,
                position: this.getLatLngFromDealer(dealer),
                title: dealer.name + ': ' + dealer.description
            });
        })

        this.map.setCenter(this.getLatLngFromDealer(defaultDealer));

    }

    initJumpToMarker() {
        const parentNode = document.querySelector("body")
        const buttons = DomAccess.querySelectorAll(parentNode, '[data-dealer-id]');
        buttons.forEach(button => {
            button.addEventListener('click', (event) => {
                const dealerId = event.target.getAttribute('data-dealer-id');
                this.options.dealers.forEach(dealer => {
                    if (dealer.id !== dealerId) {
                        return;
                    }

                    this.map.setZoom(4);
                    this.map.setCenter(this.getLatLngFromDealer(dealer));
                    this.animatedZoom(this.map, 12, this.map.getZoom());

                })
            });
        })
    }

    animatedZoom(map, max, cnt) {
        if (cnt >= max) {
            return;
        }

        const zoom = google.maps.event.addListener(map, 'zoom_changed', (event) => {
            google.maps.event.removeListener(zoom);
            this.animatedZoom(map, max, cnt + 1);
        });
        setTimeout(function () {
            map.setZoom(cnt)
        }, 80);
    }

    getLatLngFromDealer(dealer) {
        return new google.maps.LatLng(dealer.latitude, dealer.longitude)
    }
}

PluginManager.register('GoogleMaps', GoogleMaps, '[data-google-maps]', {});
