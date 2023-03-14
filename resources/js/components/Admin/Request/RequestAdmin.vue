<template>
    <div class="col-md-12">
        <h5 class="lg-title mb5">Список заявок</h5>
        <ul class="nav nav-tabs nav-justified">
            <li v-bind:class="{ active: isActive('new')}">
                <a @click="openTab('new')"
                   data-toggle="tab">
                    <strong>Новые заявки</strong>
                </a>
            </li>
            <li v-if="$route.params.type !== 'kindergarten'"
                    v-bind:class="{ active: isActive('group')}">
                <a @click="openTab('group')"
                   data-toggle="tab">
                    <strong>Группы заявок</strong>
                </a>
            </li>
        </ul>

        <div class="tab-content mb30">
            <div v-bind:class="{ active: isActive('new')}"
                 class="tab-pane">
                <request-list></request-list>
            </div>

            <div v-if="$route.params.type !== 'kindergarten'"
                    v-bind:class="{ active: isActive('group')}"
                 class="tab-pane">
                <request-group></request-group>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    import _ from 'lodash';
    import RequestFilter from "./RequestFilter";
    import RequestList from "./RequestList";
    import RequestGroup from "./RequestGroup";


    export default {
        components: {
            RequestGroup,
            RequestList,
            RequestFilter},
        name: "request-admin",

        data() {
            return {
                activeTab: 'new',
            }
        },
        beforeRouteEnter: (to, from, next) => {
            next(vm => {
                store.dispatch('appExpert/loadExpertsList');

                if (to.params.type !== 'kindergarten') {
                    store.dispatch('appRequest/loadGroupList', {
                        type: to.params.type,
                        level: to.params.level
                    });
                }

                store.dispatch('appRequest/loadRequestList', {
                    type: to.params.type,
                    level: to.params.level
                });
            });

        },
        computed: {
            ...mapGetters('appRequest',[
                'getRequestList'
            ])
        },
        methods:{
            ...mapActions('appRequest',[
                'saveRequest',
                'loadRequestList',
                'loadGroupList'
            ]),
            openTab(tab){
                switch (tab){
                    case 'new':
                        this.activeTab = 'new';
                        this.loadRequestList({
                            type: this.$route.params.type,
                            level: this.$route.params.level
                        });
                        break;
                    case 'group':
                        this.activeTab = 'group';
                        this.loadGroupList({
                            type: this.$route.params.type,
                            level: this.$route.params.level
                        });
                        break;
                }
            },
            isActive(tab){
                return this.activeTab === tab;
            },
        },

        beforeRouteUpdate (to, from, next) {
            this.loadGroupList({
                type: to.params.type,
                level: to.params.level,
            });
            this.loadRequestList({
                type: to.params.type,
                level: to.params.level,
                next: next
            });

        },

    }
</script>

<style scoped>

</style>