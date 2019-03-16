<template>
    <div>
        <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        <i class="fa fa-filter"></i>
                        <small>Filtro</small>
                    </h2>
                    <div class="pull-right">
                        <button v-if="!show_filter" @click="show_filter = true" class="btn btn-info btn-sm" title="generar reporte" >
                            <i class="fa fa-caret-square-o-down" style="color:white !important"></i>
                        </button>

                        <button v-if="show_filter" @click="show_filter = false" class="btn btn-info btn-sm" title="generar reporte" >
                            <i class="fa fa-caret-square-o-up" style="color:white !important"></i>
                        </button>
                    </div>
                </div>
                <div v-if="show_filter" class="panel-body">
                    <div class="form">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 ">
                                <div class="">
                                    <label class="">Id</label>
                                    <input type="text" v-model="filter.id" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-6 ">
                                <div class="">
                                    <label class="">Nombre</label>
                                    <input type="text" v-model="filter.name" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 ">
                                <div class="">
                                    <label class="">Barcode</label>
                                    <input type="text" v-model="filter.barcode" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 ">
                                <div class="">
                                    <label class="">Marca</label>
                                    <v-select class="" label="name" :options="makes" v-model="filter.make"></v-select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 ">
                                <div class="">
                                    <label class="">Grupo</label>
                                    <v-select class="" label="name" :options="groups" v-model="filter.group"></v-select>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 ">
                                <div class="">
                                    <label class="">Serie</label>
                                    <v-select class="" label="name" :options="series" v-model="filter.serie"></v-select>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 ">
                                <div class="">
                                    <label class="">Presentación</label>
                                    <v-select class="" label="name" :options="presentations" v-model="filter.presentation"></v-select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 ">
                                <div class="">
                                    <label class="">Categoria</label>
                                    <v-select class="" label="name" :options="categories" v-model="filter.category"></v-select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 ">
                                <div class="">
                                    <label class="">Medida</label>
                                    <v-select class="" label="name" :options="unit_measures" v-model="filter.unit_measure"></v-select>
                                </div>
                            </div>
                            <div class="col-xs-12 ">
                                <br>
                                <button @click="index" type="buttom" class="btn btn-info btn-sm"><i class="fa fa-filter"></i> Filtrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="panel panel-default">
            <div class="panel-heading hidden-print">
                <h2><i class="fa fa-cubes"></i><span class="break"></span>Reporte de Movimiento de Productos</h2>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Producto</th>
                                <th>Marca</th>
                                <th>Grupo</th>
                                <th>Serie</th>
                                <th class="text-center">Medida</th>
                                <th>Presentación</th>
                                <th>Pedidos</th>
                                <th>Vendidos</th>
                                <th>Existencia</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="product in products" :key="product.id">
                                <td>{{ product.id}}</td>
                                <td>{{ product.name}}</td>
                                <td>{{ product.make? product.make.name:'' }}</td>
                                <td>{{ product.group? product.group.name:'' }}</td>
                                <td>{{ product.serie ? product.serie.name:'' }}</td>
                                <td class="text-center">{{ product.unit ? product.unit.name:'' }}</td>
                                <td>{{ product.presentation ? product.presentation.name:'' }}</td>
                                <td><a href="#"  @click="show(product)" >{{ product.orders}}</a></td>
                                <td><a href="#"  @click="showSaleDetails(product)" >{{ product.sales}}</a></td>
                                <td>{{ product.stocks}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                        <paginator :pagination="pagination" @changePage="index"></paginator>
                </div>
            </div>
        </div>
        <modal v-if="showDetails"  title="Detalles"  size="modal-sm">
            <div style="height:400px !important" class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Orden</th>
                            <th>Fecha</th>
                            <th>Pedidos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="detail in product.order_details" :key="detail.id">
                            <td><a target="_black" :href="'/ordenes/detalle/orden-'+detail.order_id">{{ detail.order_id}}</a></td>
                            <td>{{ detail.created_at}}</td>
                            <td>{{ detail.lot}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button type="button" @click="showDetails = false" slot="btnCancel" class="btn btn-link">Salir</button>
        </modal>
        <modal v-if="showSales"  title="Ventas"  size="modal-sm">
            <div style="height:400px !important" class="table-responsive">
                <table  class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Factura</th>
                            <th>Fecha</th>
                            <th>Pedidos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="detail in product.sale_details" :key="detail.id">
                            <td><a target="_black" :href="'/sales/invoice/?id='+detail.order_id">{{ detail.order_id}}</a></td>
                            <td>{{ detail.created_at}}</td>
                            <td>{{ detail.lot}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button type="button" @click="showSales = false" slot="btnCancel" class="btn btn-link">Salir</button>
        </modal>
    </div>
</template>

<script>
    import ProductReport from '../../../models/ProductReport';
     import Make from '../../../models/Make';
    import Serie from '../../../models/Serie';
    import Group from '../../../models/Group';
    import UnitMeasure from '../../../models/UnitMeasure';
    import Presentation from '../../../models/Presentation';
    import Category from '../../../models/Category';
    import QuickOrder from '../../../models/QuickOrder';
    import Paginator from '../../../components/Paginator.vue';
    import vSelect from 'vue-select';


    export default {
        components:{Paginator, vSelect},
        data(){
            return {
                show_filter:false,
                showDetails:false,
                showSales:false,
                products:[],
                product:{},
                makes:[],
                groups:[],
                series:[],
                presentations:[],
                categories:[],
                unit_measures:[],
                pagination: {},
                filter:{}
            }
        },
        created(){
            this.index();
        },
        methods:{
            show(product){
                this.showDetails = true;
                this.product     = product;
            },
            showSaleDetails(product){
                this.showSales = true;
                this.product   = product;
            },
            index(page = 1 ){
                let params = {
                    page: page,
                    id: this.filter.id ? this.filter.id: null ,
                    name: this.filter.name ? this.filter.name:null,
                    barcode: this.filter.barcode ? this.filter.barcode:null,
                    make_id: this.filter.make ? this.filter.make.id :null,
                    product_serie_id: this.filter.serie? this.filter.serie.id:null,
                    category_id: this.filter.category ? this.filter.category.id:null,
                    unit_measure_id: this.filter.unit_measure ? this.filter.unit_measure.id :null,
                    product_group_id: this.filter.group ? this.filter.group.id:null,
                    product_presentation_id: this.filter.presentation ? this.filter.presentation.id:null,
                };
                ProductReport.get(params, data => {
                    this.products = data.data;
                    this.pagination = data.meta;
                });
            }
        }
    }
</script>
