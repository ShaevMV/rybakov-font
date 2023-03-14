<template>
    <div class="right_edu" v-if="getNameSelectLesson !== undefined">
            <span class="mob_menu" id="ham_button">
                <svg class="svg-inline--fa fa-bars fa-w-14" aria-hidden="true" data-prefix="fas" data-icon="bars" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                    <path fill="currentColor" d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"></path>
                </svg><!-- <i class="fas fa-bars"></i> -->
            </span>
        <div class="right_content">
            <h1> {{getNameSelectTask}}.</h1>
            <span class="desc"> {{getDescriptionInSelectTask}} </span>
            <div class="edu_width">
                <iframe v-if="getTypeInSelectTask === 'video'" width="100%" height="410" :src="'https://www.youtube.com/embed/'+getContentInSelectTask"
                        frameborder="0"
                        allow="accelerometer; encrypted-media; gyroscope; picture-in-picture"
                        allowfulslscreen=""></iframe>
                <div v-else-if="getTypeInSelectTask === 'text'" v-html="getContentInSelectTask"></div>
                <task-questions v-else></task-questions>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    import TaskQuestions from "./taskQuestions";
    export default {
        components: {TaskQuestions},
        name: "content-lesson",
        computed: {
            ...mapGetters('appLesson',[
                'getContentInSelectTask',
                'getTypeInSelectTask',
                'getNameSelectLesson',
                'getNameSelectTask',
                'getTypeSelectTask',
                'getDescriptionInSelectTask'
            ])
        },
    }
</script>

<style scoped>

</style>