<template>
    <div class="buttons_block uk-flex uk-flex-center uk-flex-middle">
        <a class="button_cancel button_medium" :disabled="selectTask === null" @click="backTask()">Назад</a>
        <a class="button_continue button_medium" v-if="selectTask === null" @click="nextTask()">Начать</a>
        <a class="button_continue button_medium" v-else @click="nextTask()">Продолжить</a>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';

    export default {
        name: "navigator",
        computed: {
            ...mapState('appLesson',[
                'selectTask'
            ]),
            ...mapGetters('appLesson',[
                'isEndLesson'
            ])
        },
        methods:{
            ...mapActions('appLesson',[
                'nextTask',
                'endLesson',
                'backTask',
            ])
        }
    }
</script>

<style scoped>

</style>