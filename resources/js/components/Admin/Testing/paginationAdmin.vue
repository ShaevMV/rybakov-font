<template>
    <div>
        <div class="pag_desc">Записей <span>  {{dataForPagination.from}} - {{dataForPagination.to}}</span> из<span> {{dataForPagination.total}}</span></div>

        <ul class="pagination mt5">
            <li class="disabled"><a click="backPage()"><i class="fa fa-angle-left"></i></a></li>
            <li :class="{'uk-active':page.active}"
                v-if="getPagesStartList.length > 0"
                v-for="page in getPagesStartList">
                <a @click="selectPage(page.number)">{{page.number}}</a>
            </li>

            <li class="uk-disabled" v-if="getPagesMiddleList.length > 0">
                <span>...</span>
            </li>

            <li :class="{'uk-active':page.active}"
                v-if="getPagesMiddleList.length > 0"
                v-for="page in getPagesMiddleList">
                <a @click="selectPage(page.number)">{{page.number}}</a>
            </li>

            <li class="uk-disabled" v-if="getPagesEndList.length > 0">
                <span>...</span>
            </li>

            <li :class="{'uk-active':page.active}"
                v-if="getPagesEndList.length > 0"
                v-for="page in getPagesEndList">
                <a @click="selectPage(page.number)">{{page.number}}</a>
            </li>

            <li><a @click="nextPage()"><i class="fa fa-angle-right"></i></a></li>
        </ul>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    export default {
        name: "pagination-admin",
        props:['callback'],
        methods: {
            ...mapActions('appTesting', [
                'nextPage',
                'backPage'
            ]),
            ...mapActions(['changePage']),
           async selectPage(page){
                await this.changePage(page);
                await this.callback();
            }
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