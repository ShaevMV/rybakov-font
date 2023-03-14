<template>
    <div class="pageheader" v-if="!this.$route.meta.hide">
        <div class="media">
            <div class="pageicon pull-left">
                <i v-bind:class="this.$route.meta.icon"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>{{this.$route.meta.title}}</li>
                </ul>
                <h4>{{this.$route.meta.title}}</h4>
            </div>
        </div><!-- media -->
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    export default {
        name: "page-header",
        data() {
            return {
                title: '',
                icon: '',
            }
        },
        computed: {

            getRouter(){
                console.log(this.$route)
            }
        },



    }
</script>

<style scoped>

</style>
