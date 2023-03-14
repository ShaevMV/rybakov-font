<template>
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Дата заявки</label>
            <div class="form-group">
                <div class="col-sm-6">
                    <input type="date" class="form-control" v-model="filter.created_at[0]" title="Дата заявки от">
                </div>
                <div class="col-sm-6">
                    <input type="date" class="form-control" v-model="filter.created_at[1]" title="Дата заявки до">
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group">
                <label class="control-label">Город</label>
                <select id="inp_town" v-model="filter.city" class="form-control" title="Город">
                    <option value=""></option>
                    <option value="Москва">г. Москва</option>
                    <option value="Казань">г. Казань</option>
                    <option value="Санкт-Петербург">г. Санкт-Петербург</option>
                    <option value="Сочи">г. Сочи</option>
                    <option value="Краснодар">г. Краснодар</option>
                    <option value="Киев">г. Киев</option>
                    <option value="Челябинск">г. Челябинск</option>
                </select>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label class="control-label">Эксперт</label>
                <select v-model="filter.expert_id" class="form-control" title="Эксперт">
                    <option value=""></option>
                    <option v-for="expert in getExpertList" :value="expert.id">{{expert.name}}</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <button class="btn btn-primary mr5" @click="submit()">Применить</button>
                <button type="reset" class="btn btn-dark" @click="reset()">Сбросить</button>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';

    export default {
        name: "request-filter",
        props:['role_id'],
        data() {
            return {
                filter: {
                    created_at: {
                        0: '',
                        1: '',
                    },
                    city: '',
                    expert_id: '',
                }
            }
        },
        methods: {
            ...mapActions('appRequest', [
                'filterRequest'
            ]),
            submit() {
                this.filterRequest({
                    level: this.$route.params.level,
                    type: this.$route.params.type,
                    filter: this.filter,
                    role_id: this.role_id
                });
            },
            reset() {
                this.filter = {
                    created_at: {
                        0: '',
                        1: '',
                    },
                    city: '',
                    expert_id: '',
                };
                this.submit();
            }
        },
        computed: {
            ...mapGetters('appExpert', [
                'getExpertList',
            ]),
        },
    }
</script>

<style scoped>

</style>