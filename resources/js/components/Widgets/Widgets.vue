<template>
    <div>
        <div v-for="item in listWidgets">
            <component v-bind:is="item.template"
                       :params="item.params"
                       :title="item.title"
                       :item="item.items"
            ></component>
        </div>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    import Slider from "./slider";
    import Participation from "./participation";
    import Work from "./work";
    import Tools from "./tools";
    import Sponsor from "./sponsor";
    import Talking from "./talking";
    import YouTube from "./youTube";
    import Experts from "./experts";
    import Reviews from "./reviews";

    export default {
        components: {
            Reviews,
            Experts,
            YouTube,
            Talking,
            Sponsor,
            Tools,
            Work,
            Participation,
            Slider},
        name: "widgets",
        data() {
            return {
                listWidgets: []
            }
        },
        computed: {

        },
        beforeRouteEnter: (to, from, next) => {
            next(vm => {
                store.dispatch('appWidgets/getListWidget').then(response => {
                    vm.listWidgets = response.data
                });
            })
        },
       /* beforeRouteUpdate: (to, from, next) => {
            next(vm => {
                store.dispatch('appWidgets/getListWidget').then(response => {
                    vm.listWidgets = response.data
                });
            })
        }*/
    }
</script>

<style scoped>

</style>