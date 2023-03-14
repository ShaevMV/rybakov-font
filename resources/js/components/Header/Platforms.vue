<template>
    <div class="container">
        <nav uk-navbar="mode: click" class="uk-navbar">
            <ul class="uk-navbar-nav">
                <li>
                    <a class="top_part__main_link" href="#"
                       @click="getList()"
                       aria-expanded="false">Платформы</a>
                    <div class="uk-navbar-dropdown link_block uk-navbar-dropdown-bottom-left" style="left: 0; top: 42.8px;">
                        <ul class="uk-margin-remove">
                            <li v-for="item in listPlatforms">
                                <a :href="item.link" target="_blank">{{item.title}}</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    export default {
        name: "platforms",
        computed: {
            ...mapGetters('appStatic', [
                'listPlatforms',
            ]),
        },
        methods: {
            ...mapActions('appStatic', [
                'getListPlatform'
            ]),
            getList() {
                if (this.listPlatforms.length === 0){
                    this.getListPlatform()
                }
            }

        },
    }
</script>

<style scoped>

</style>