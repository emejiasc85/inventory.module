<template>
    <div>
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        <i class="fa fa-filter"></i>
                        <small>Filtros</small>
                    </h2>
                </div>
                <div class="panel-body">
                    <div class="form">
                        <div class="row">
                            <div class="col-xs-12 col-sm-3 col-md-2 col-lg-1 ">
                                <div class="">
                                    <input type="text" v-model="filter.id" placeholder="ID" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-6 ">
                                <div class="">
                                    <input type="text" placeholder="Nombre" v-model="filter.name" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 ">
                                <div class="">
                                    <input type="text" placeholder="NIT" v-model="filter.nit" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2 ">
                                 <div class="">
                                    <button @click="index" type="buttom" class="btn btn-info btn-sm"><i class="fa fa-filter"></i> Filtrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        <i class="fa fa-list"></i>
                    </h2>
                    <div class="pull-right">
                        <button @click="create" class="btn btn-success btn-sm" title="generar reporte" >
                            <i class="fa fa-plus" style="color:white !important"></i> Agregar Persona
                        </button>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nit</th>
                                    <th>Nombre</th>
                                    <th>Dirección</th>
                                    <th>Correo</th>
                                    <th>Teléfono</th>
                                    <th>Tipo</th>
                                    <th class="text-right">Consumo</th>
                                    <th class="text-right">Crédito</th>
                                    <th class="text-right">Crédito maximo</th>
                                    <th colspan="2"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="person in people" :key="person.id">
                                        <td>{{ person.id}}</td>
                                        <td>{{ person.nit}}</td>
                                        <td>{{ person.name}}</td>
                                        <td>{{ person.address}}</td>
                                        <td>{{ person.email}}</td>
                                        <td>{{ person.phone}}</td>
                                        <td>
                                            <span v-if="person.type == 'customer'" class="label label-success">cliente</span>
                                            <span v-else class="label label-info">proveedor</span>
                                        </td>
                                        <td class="text-right">{{ person.total_purchases}}</td>
                                        <td class="text-right">{{ person.current_credit }}</td>
                                        <td class="text-right">{{ person.max_credit}}</td>
                                        <td class="text-right" style="width:100px !important">
                                            <button @click="show(person.id)" v-tooltip="'Detalles'" type="button" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></button>
                                            <button @click="edit(person.id)" v-tooltip="'Editar'" type="button" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></button>
                                            <a v-tooltip="'Crear venta'" :href="'/sales/invoice/?people_id='+person.id" type="button" class="btn btn-default btn-xs"><i class="fa fa-shopping-cart text-success"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel-footer">
                        <paginator :pagination="pagination" @changePage="index"></paginator>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import People from '../../models/People';
    import Paginator from '../../components/Paginator.vue';

    export default {
        components: {Paginator},
        data(){
            return {
                show_filter:false,
                people:[],
                person:{},
                errors:[],
                filter:{},
                pagination: {},
            }
        },
        created(){
            this.index();
        },
        methods:{
            index(page = 1){
                let params = {
                    page: page,
                    id: this.filter.id ? this.filter.id: null ,
                    nit: this.filter.nit ? this.filter.nit: null ,
                    name: this.filter.name ? this.filter.name:null,
                };
                People.get(params, data => {
                    this.people = data.data;
                    this.pagination = data.meta;
                });
            },
            create(){
                this.$emit('create');
            },
            edit(product_id){
                this.$emit('edit', product_id);
            },
            show(product_id){
                this.$emit('show', product_id);
            },
        }
    }
</script>