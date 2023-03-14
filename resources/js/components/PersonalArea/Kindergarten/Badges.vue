<template>
    <div class="acc_badges">
        <div class="kg_acc_header_block">
            <h2 class="uk-text-left uk-text-uppercase font-26 uk-margin-remove uk-text-left"> Значки</h2>
        </div>
        <div class="badge_block uk-flex">
            <div class="badge badge1 active"></div>
            <!--добавить active для отображения получения значка-->
            <div class="badge badge2" v-bind:class="{active:isBadge2}"></div>
            <div class="badge badge3" v-bind:class="{active:isBadge3}"></div>
            <div class="badge badge4" v-bind:class="{active:isBadge4}"></div>
        </div>
        <!--active для показа второго сообщения-->
        <div class="switch_desc">
            <p class="text_badges"> Для того, чтобы получить следующий значек, Вам необходимо пройти тест внутренней оценки НОКДО или ECERS.</p>
            <p class="text_badges"> Поздравляем! Вы собрали все ступени знака качества!</p>
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';

    export default {
        name: "badges",
        computed:{
            ...mapGetters('appTraining',[
                'getListLevelsType',
                'isListLevels'
            ]),
            ...mapGetters('appRequest',[
                'getRequestList'
            ]),
            isBadge2(){
                return this.isListLevels('NOKDO') || this.isListLevels('ECERS');
            },
            isBadge3(){
                return this.getRequestList.length > 0;
            },
            isBadge4(){
                return this.getRequestList.length > 0 && _.filter(this.getRequestList,function (item) {
                    return item.check
                }).length>0;
            }
        },
    }
</script>

<style scoped>

</style>