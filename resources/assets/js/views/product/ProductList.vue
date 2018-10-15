<template>
    <div>
        <div class="col-xs-12">
            <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">
                <i class="fa fa-filter"></i>
                <small>Filtro</small>
            </h2>
            <div class="pull-right">
                <button class="btn btn-success btn-sm" title="generar reporte" >
                    <i class="fa fa-plus" style="color:white !important"></i> Agregar Producto
                </button>
            </div>
        </div>
        <div class="panel-body">
            <div class="form">
                <div class="row">
                    <div class="form-group col-sm-1">
                        <div class="input-group">
                            <span class="input-group-addon">Id</span>
                            <input type="text" v-model="filter.id" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-sm-3">
                        <div class="input-group">
                            <span class="input-group-addon">Nombre</span>
                            <input type="text" v-model="filter.name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="input-group">
                            <span class="input-group-addon">Barcode</span>
                            <input type="text" v-model="filter.barcode" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="input-group">
                            <span class="input-group-addon">Marca</span>
                            <v-select class="" label="name" :options="makes" v-model="filter.make"></v-select>
                        </div>
                    </div>
                    <div class="form-group col-sm-4 ">
                        <button @click="index" type="buttom" class="btn btn-info btn-sm"><i class="fa fa-filter"></i> Filtrar</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
            <div class="panel panel-default">
                <div class="panel-heading">

                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Grupo</th>
                                    <th>Serie</th>
                                    <th>Categoria</th>
                                    <th>Marca</th>
                                    <th>Presentación</th>
                                    <th>Medida</th>
                                    <th>Minimo</th>
                                    <th>P/U</th>
                                    <th>P/O</th>
                                    <th colspan="2"></th>
                                </tr>

                                </thead>
                                <tbody>
                                    <tr v-for="product in products" :key="product.id">
                                        <td>{{ product.id}}</td>
                                        <td>{{ product.name}}</td>
                                        <td>{{ product.group.name}}</td>
                                        <td>{{ product.serie.name}}</td>
                                        <td>{{ product.category.name}}</td>
                                        <td>{{ product.make.name}}</td>
                                        <td>{{ product.presentation.name}}</td>
                                        <td>{{ product.unit.name}}</td>
                                        <td>{{ product.minimum_stock}}</td>
                                        <td>{{ product.price}}</td>
                                        <td>{{ product.offer_price}}</td>
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
    import Product from '../../models/Product';
    import Make from '../../models/Make';
    import Paginator from '../../components/Paginator.vue';
    import vSelect from 'vue-select';


    export default {
        components: {Paginator, vSelect},
        data(){
            return {
                products:[],
                product:{},
                errors:[],
                filter:{},
                pagination: {},
                makes:[],
            }
        },
        created(){
            this.index();
            this.loadData();
        },
        methods:{
            loadData(){
                Make.get({}, data => { this.makes = data.data});
            },
            index(page = 1){
                let params = {
                    page: page,
                    id: this.filter.id,
                    name: this.filter.name,
                    barcode: this.filter.barcode,
                    make_id: this.filter.make_id,
                    product_serie_id: this.filter.product_serie_id,
                    category_id: this.filter.category_id,
                    unit_measure_id: this.filter.unit_measure_id,
                    product_group_id: this.filter.product_group_id,
                };
                Product.get(params, data => {
                    this.products = data.data;
                });
            }
        }
    }
</script>
