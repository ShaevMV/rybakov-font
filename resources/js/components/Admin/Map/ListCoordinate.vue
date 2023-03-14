<template>
    <div>
        <div class="row">
            <div class="col-md-9">
                <h3>Список детских садов</h3>
            </div>

        </div>
        <hr>
        <table class="table table">
            <thead>
            <tr>
                <th style="width: 50px">#</th>
                <th>Название</th>
                <th>Координаты</th>
                <th style="width: 100px"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(item, idx) in getKindergartenList" :key="idx">
                <td>{{item.id}}</td>
                <td>{{item.name_organization}}  ({{item.address}})</td>
                <td>{{getCoordinates(item)}}</td>
                <td>
                    <span class="glyphicon glyphicon-pencil" @click="setSelectKindergarten(item)"></span>
                </td>
            </tr>
            </tbody>
        </table>
        <edit-coordinate
                @save="save"
                v-if="isSelectKindergarten"
                :item = selectKindergarten></edit-coordinate>
    </div>
</template>

<script>
    import {mapGetters, mapActions, mapState} from 'vuex';
    import EditCoordinate from "./EditCoordinate";

    export default {
        components: {EditCoordinate},
        name: "list-coordinate",
        data(){
            return {
                //page:1,
                selectKindergarten:{},
            }
        },
        computed: {
            ...mapGetters('appKindergarten', [
                'getKindergartenList'
            ]),
            isSelectKindergarten(){
                return typeof this.selectKindergarten.id !== 'undefined'
            }
        },
        methods:{
            ...mapActions('appKindergarten',[
                'saveKindergarten',
                'loadKindergartenList'
            ]),
            getCoordinates(item){
                let result = 'Координаты не заданы';
                if(item.long || item.width){
                    result = 'Координаты заданы';
                }
                return result;
            },
            setSelectKindergarten(item){
                this.selectKindergarten = _.cloneDeep(item);
            },
            save(){
                let app = this;
                console.log(parseFloat(this.selectKindergarten['long'].toString().replace(/_/g,0)));
                console.log(parseFloat(this.selectKindergarten['width'].toString().replace(/_/g,0)));
                this.saveKindergarten({
                    id: this.selectKindergarten.id,
                    long: parseFloat(this.selectKindergarten['long'].toString().replace(/_/g,0)),
                    width: parseFloat(this.selectKindergarten['width'].toString().replace(/_/g,0)),
                    callback: function () {
                        app.loadKindergartenList();
                        app.selectKindergarten = {};
                    }
                })
            }
        },
        beforeRouteEnter: (to, from, next) => {
            store.dispatch('appKindergarten/loadKindergartenList');
            next();

        },
    }
</script>

<style scoped>

</style>