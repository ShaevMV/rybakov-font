<template>
    <div class="inner_section">
        <div class="container">
            <div class="expert_rating_block">
                <h1 class="uk-text-centerpm install vue-yandex-maps --save">Сады-участники</h1>

                <yandex-map
                        :coords="map.coords"
                        :zoom="map.zoom"
                        style="width: 100%; height: 600px;"
                        :options="{ minZoom: 3, maxZoom: 17}"
                        :map-type="map.type">
                    <ymap-marker v-for="(marker, index) in getMarkers"
                                 :key="index"
                                 style="width: 200px; height: 200px;"
                                 markerId="1"
                                 marker-type="placemark"
                                 :coords="marker.coords"
                                 :balloon="marker.balloon"
                                 :icon="markerIcon"
                                 cluster-name="1"></ymap-marker>
                </yandex-map>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';

    import {yandexMap, ymapMarker} from 'vue-yandex-maps';

    export default {
        name: "Map",
        components: {
            yandexMap,
            ymapMarker
        },
        data: () => ({

            //Основные настройки карты
            map: {
                coords: [55.7539303, 37.620795], //Это центр карты
                zoom: 10, //Это насколько увеличивать
                type: 'map' // тип карты! Доступны: map(та что стоит сейчас), HYBRID и SATELLITE (спутник)
            },

            //Настройка маркера карты (типа картинка маркера и позиционирование и размеры)
            markerIcon: {
                layout: 'default#imageWithContent',
                imageHref: '/images/fourth_level.png',
                imageSize: [56, 56],
                imageOffset: [-38, -38]
            },
        }),
        beforeRouteEnter: (to, from, next) => {
            store.dispatch('appKindergarten/loadKindergartenList', {
                next: next
            });
        },
        computed: {
            ...mapGetters('appKindergarten', [
                'getKindergartenList'
            ]),
            getMarkers() {
                let result = [];
                this.getKindergartenList.forEach(function (item) {
                    if(item.width && item.long){
                        result.push({
                            coords: [
                                item.long,
                                item.width
                            ],
                            balloon: {
                                body: item.name_organization
                            }
                        });
                    }
                });
                return result;
            }
        },

    }
</script>