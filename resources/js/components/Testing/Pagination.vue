<template>
    <div class="pagination">
        <div class="pag_desc">Записей <span>  {{dataForPagination.from}} - {{dataForPagination.to}}</span> из<span> {{dataForPagination.total}}</span></div>
        <ul class="uk-pagination pag_overlay">
            <li>
                <a @click="backPage()">
                    <span class="grey_pag uk-icon" uk-icon="icon: chevron-double-left">
                        <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="chevron-double-left">
                            <polyline fill="none" stroke="#000" stroke-width="1.03" points="10 14 6 10 10 6"></polyline>
                            <polyline fill="none" stroke="#000" stroke-width="1.03" points="14 14 10 10 14 6"></polyline>
                        </svg>
                    </span>
                </a>
            </li>

            <li :class="{'uk-active':page.active}"
                v-if="getPagesStartList.length > 0"
                v-for="page in getPagesStartList">
                <a @click="changePage(page.number)">{{page.number}}</a>
            </li>

            <li class="uk-disabled" v-if="getPagesMiddleList.length > 0">
                <span>...</span>
            </li>

            <li :class="{'uk-active':page.active}"
                v-if="getPagesMiddleList.length > 0"
                v-for="page in getPagesMiddleList">
                <a @click="changePage(page.number)">{{page.number}}</a>
            </li>

            <li class="uk-disabled" v-if="getPagesEndList.length > 0">
                <span>...</span>
            </li>

            <li :class="{'uk-active':page.active}"
                v-if="getPagesEndList.length > 0"
                v-for="page in getPagesEndList">
                <a @click="changePage(page.number)">{{page.number}}</a>
            </li>

            <li>
                <a @click="nextPage()">
                    <span class="grey_pag uk-icon" uk-icon="icon: chevron-double-right">
                        <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="chevron-double-right">
                            <polyline fill="none" stroke="#000" stroke-width="1.03" points="10 6 14 10 10 14"></polyline>
                            <polyline fill="none" stroke="#000" stroke-width="1.03" points="6 6 10 10 6 14"></polyline>
                        </svg>
                    </span>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';

    export default {
        name: "pagination",
        methods: {
            ...mapActions('appTesting', [
                'changePage',
                'nextPage',
                'backPage'
            ]),
        },
        computed: {
            ...mapGetters('appTesting', [
                'getPagesStartList',
                'getPagesMiddleList',
                'getPagesEndList',
                'dataForPagination'
            ]),
        },

    }
</script>

<style scoped>

</style>