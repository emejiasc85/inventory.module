<template>
<div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading text-right">
                    <div class="form-inline">
                        <div class="form-group">
                            <label for="exampleInputName2">Desde</label>
                            <input type="date" class="form-control" v-model="filter.from_date">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail2">Hasta</label>
                            <input type="date" class="form-control"  v-model="filter.to_date">
                        </div>
                        <button @click="index" v-tooltip="'Buscar'" style="margin-bottom: 4px !important" type="button" class="btn btn-info"><span class="fa fa-search"></span></button>
                        <a href="/admin/audits/show" v-tooltip="'Crear Auditoría'" style="margin-bottom: 4px !important" class="btn btn-primary"><span class="fa fa-plus"></span></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-resposive">
                        <table class="table col-sm-12">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th>Fecha</th>
                                    <th>Auditor</th>
                                    <th class="text-center">Productos</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="audit in audits" :key="audit.id">
                                    <td class="text-center">{{ audit.id }}</td>
                                    <td>{{ audit.created_at }}</td>
                                    <td>{{ audit.user.name }}</td>
                                    <td class="text-center">{{ audit.total_details }}</td>
                                    <td><span class="label" :class="{'label-primary': audit.open, 'label-success': audit.close}">{{ audit.status }}</span></td>
                                    <td><a :href="'/admin/audits/show?id='+audit.id" class="btn btn-info btn-sm" v-tooltip="'Detalles'"> <i class="fa fa-eye"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                        <paginator :pagination="pagination" @changePage="index"></paginator>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
    import Audit from '../../../models/admin/Audit';
    import Paginator from '../../../components/Paginator.vue';

    export default {
        components: {Paginator},
        data(){
            return {
                audits:[],
                pagination: {},
                errors:[],
                filter:{}
            }
        },
        created(){
            this.index();
        },
        methods:{
            index(page = 1){
                let params = {
                    from: this.filter.from_date ,
                    to: this.filter.to_date ,
                    page: page,
                 }

                 Audit.get(params, data => {
                     this.audits = data.data;
                     this.pagination = data.meta;
                 });
            },
        },
    }
</script>
