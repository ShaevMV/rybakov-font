<template>
    <div>
        <div class="row">
            <div class="col-md-9">
                <h3>Платформы</h3>
            </div>

        </div>
        <hr>
        <table class="table table">
            <thead>
            <tr>
                <th style="width: 50px">#</th>
                <th>Название</th>
                <th>Ссылка</th>
                <th>Активен</th>
                <th style="width: 100px"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(platform, idx) in listPlatformsAll" :key="idx">
                <td>{{platform.id}}</td>
                <td>{{platform.title}}</td>
                <td>{{platform.link}}</td>
                <td>{{platform.active ? 'да': 'нет'}}</td>
                <td>
                    <span class="glyphicon glyphicon-pencil" @click="selectPlatforms(platform)"></span>
                    <button type="button" class="btn btn-danger" @click="del(platform.id)">
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
        <new-platforms
                :item="itemPlatforms"
        ></new-platforms>
    </div>
</template>

<script>
    import NewPlatforms from "./NewPlatforms";
    import {mapState, mapGetters, mapActions} from 'vuex';

    export default {
        components: {NewPlatforms},
        name: "list-platforms",
        data() {
            return {
                itemPlatforms: {
                    id: null,
                    title: '',
                    link: '',
                    active: 0,
                }
            }
        },
        methods: {
            ...mapActions('appStatic', [
                'deletePlatforms'
            ]),
            selectPlatforms(item) {
                this.itemPlatforms = item
            },
            del(id){
                if (confirm('Удалить платформу?')) {
                    this.deletePlatforms({
                        id: id
                    })
                }
            }

        },
        beforeRouteEnter: (to, from, next) => {
            store.dispatch('appStatic/getListPlatform');
            next();

        },
        computed: {
            ...mapGetters('appStatic', [
                'listPlatformsAll',
            ]),
        },
    }
</script>

<style scoped>

</style>