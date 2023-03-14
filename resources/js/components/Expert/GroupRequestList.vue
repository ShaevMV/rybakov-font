<template>
    <div class="inner_section">
        <div class="container">
            <div class="group_part">
                <div class="top_group uk-flex uk-flex-right"><a href="#">Архив</a></div>
                <div class="sort_group uk-flex uk-flex-between uk-flex-wrap">
                    <div class="left_sort uk-flex"><span class="sort_as sort_margin">   Сортировать по:</span><a class="sort_arrow level_sort sort_margin" href="#"> Уровню</a>
                        <!-- Добавить .lower и .upper для применения сортировки--><a class="sort_arrow data_sort lower sort_margin" href="#">  Дате</a>
                        <!-- Добавить .lower и .upper для применения сортировки-->
                        <nav class="sort_margin uk-navbar" uk-navbar="mode: click">
                            <ul class="uk-navbar-nav">
                                <li><a class="with_drop finish_sort" href="#" aria-expanded="false">Завершенности</a>
                                    <div class="uk-navbar-dropdown link_block">
                                        <ul class="uk-margin-remove">
                                            <li><a href="#">Завершенные</a></li>
                                            <li><a href="#">Неначатые</a></li>
                                            <li><a href="#">В процессе</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                        <nav class="sort_margin uk-navbar" uk-navbar="mode: click">
                            <ul class="uk-navbar-nav">
                                <li><a class="with_drop town_sort" href="#" aria-expanded="false">Городу</a>
                                    <div class="uk-navbar-dropdown link_block">
                                        <ul class="uk-margin-remove">
                                            <li><a href="#">Завершенные</a></li>
                                            <li><a href="#">Неначатые</a></li>
                                            <li><a href="#">В процессе</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </div><a class="kg_pencil" href="#"></a>
                </div>
                <div class="content_group uk-flex uk-flex-wrap">
                    <!-- with_shadow для тени-->
                    <div  v-bind:class="groupClass(item)"
                            class="group_block"
                          @click="openGroup(item.id)"
                         v-for="item in getGroupList">
                        <h2> {{item.name}}. {{item.date_of_meeting}}</h2>
                        <div class="block_line">
                            <div class="block_level">{{item.levels.number}} уровень</div>
                        </div>
                        <p class="group_text uk-margin-remove">{{item.place}} (Количество участников {{item.requests_count}})</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';

    export default {
        name: "group-request-list",
        computed: {
            ...mapGetters('appRequest', [
                'getGroupList',
            ])
        },
        methods:{
            groupClass(group){
                return 'group' + group.levels.number;
            },
            place(group){
                return  group.place.length > 0 ? group.place : 'место встречи ещё не выбрано';
            },
            openGroup(idGroup){
                this.$router.push('/groupRequest/'+idGroup);
            },
            dateOfMeeting(date) {
                return date !== null ? date : 'дата встречи не указана';
            }
        },
        beforeRouteEnter: (to, from, next) => {
            next(vm => {
                store.dispatch('appRequest/loadAllGroupList'); // получить данные о группах заявок
            })
        },
    }
</script>

<style scoped>

</style>