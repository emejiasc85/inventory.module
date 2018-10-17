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
                <div class="panel-heading">
                    <h2 class="panel-title">
                        <i class="fa fa-list"></i>
                    </h2>
                    <div class="pull-right">
                        <button @click="create" class="btn btn-success btn-sm" title="generar reporte" >
                            <i class="fa fa-plus" style="color:white !important"></i> Agregar Producto
                        </button>
                    </div>
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
                                        <td style="width:100px !important">
                                            <button @click="show(product.id)" v-tooltip="'Detalles'" type="button" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></button>
                                            <button @click="edit(product.id)" v-tooltip="'Editar'" type="button" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></button>
                                            <button @click="quickOrder(product)" v-tooltip="'Crear pedido'" type="button" class="btn btn-default btn-xs"><i class="fa fa-truck"></i></button>
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
        <modal v-if="show_quick_order"  title="Crear Pedido Directo"  size="modal-md">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
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
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ product.id}}</td>
                            <td>{{ product.name}}</td>
                            <td>{{ product.group.name}}</td>
                            <td>{{ product.serie.name}}</td>
                            <td>{{ product.category.name}}</td>
                            <td>{{ product.make.name}}</td>
                            <td>{{ product.presentation.name}}</td>
                            <td class="text-center">{{ product.unit.name}}</td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="form" role="form">
                <div class="row">
                    <div class="form-group">
                        <div  class="row">
                            <div class="col-xs-12">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Precio venta</label>
                                        <input type="text" v-model="product.price" class="form-control">
                                        <p class="text-danger" v-if="errors.price">{{ errors.price[0]}}</p>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Precio descuento</label>
                                        <input type="text" v-model="product.offer_price" class="form-control">
                                        <p class="text-danger" v-if="errors.offer_price">{{ errors.offer_price[0]}}</p>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Precio compra</label>
                                        <input type="number" v-model="product.purchase_price" class="form-control">
                                        <p class="text-danger" v-if="errors.purchase_price">{{ errors.purchase_price[0]}}</p>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Cantidad</label>
                                        <input type="text" v-model="product.lot" class="form-control">
                                        <p class="text-danger" v-if="errors.lot">{{ errors.lot[0]}}</p>
                                    </div>
                                </div>
                                 <div class="col-xs-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="">Proveedor</label>
                                        <v-select label="name" :options="people" v-model="product.people"></v-select>
                                        <p class="text-danger" v-if="errors.people_id">{{ errors.people_id[0]}}</p>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Fecha de vencimiento</label>
                                        <input type="date" v-model="create.due_date" class="form-control">
                                        <p class="text-danger" v-if="errors.due_date">{{ errors.due_date[0]}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button @click="show_quick_order = false" type="button"  slot="btnCancel"  class="btn btn-link">Salir</button>
            <button @click="storeQuickOrder" slot="btnSave" type="button" class="btn btn-primary" ><i class="fa fa-truck"></i> Crear Pedido</button>
        </modal>
    </div>
</template>
<script>
    import Product from '../../models/Product';
    import Make from '../../models/Make';
    import Serie from '../../models/Serie';
    import Group from '../../models/Group';
    import UnitMeasure from '../../models/UnitMeasure';
    import Presentation from '../../models/Presentation';
    import Category from '../../models/Category';
    import People from '../../models/People';
    import QuickOrder from '../../models/QuickOrder';
    import Paginator from '../../components/Paginator.vue';
    import vSelect from 'vue-select';


    export default {
        components: {Paginator, vSelect},
        data(){
            return {
                show_quick_order: false,
                show_filter:false,
                products:[],
                product:{},
                errors:[],
                filter:{},
                pagination: {},
                makes:[],
                groups:[],
                series:[],
                presentations:[],
                categories:[],
                unit_measures:[],
                people:[],
            }
        },
        created(){
            this.index();
            this.loadData();
        },
        methods:{
            loadData(){
                People.get({type:'provider'}, data => { this.people = data.data});
                Make.get({}, data => { this.makes = data.data});
                Group.get({}, data => { this.groups = data.data});
                Serie.get({}, data => { this.series = data.data});
                Presentation.get({}, data => { this.presentations = data.data});
                Category.get({}, data => { this.categories = data.data});
                UnitMeasure.get({}, data => { this.unit_measures = data.data});
            },
            index(page = 1){
                let params = {
                    page: page,
                    id: this.filter.id,
                    name: this.filter.name,
                    barcode: this.filter.barcode,
                    make_id: this.filter.make ? this.filter.make.id :null,
                    product_serie_id: this.filter.serie? this.filter.serie.id:null,
                    category_id: this.filter.category ? this.filter.category.id:null,
                    unit_measure_id: this.filter.unit_measure ? this.filter.unit_measure.id :null,
                    product_group_id: this.filter.group ? this.filter.group.id:null,
                    product_presentation_id: this.filter.presentation ? this.filter.presentation.id:null,
                };
                Product.get(params, data => {
                    this.products = data.data;
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
            quickOrder(product){
                this.show_quick_order = true;
                this.product = product;
            },
            storeQuickOrder(){
                this.product.make_order = true;
                this.product.people ? (this.product.people_id = this.product.people.id) :'',

                QuickOrder.store(this.product.id, this.product, data => {
                    this.$toastr.s("Pedido creado");
                    this.$toastr.s("Se agrego pedido a inventario");
                    this.errors={};
                    this.index();
                    this.show_quick_order = false;
                }, errors => this.errors = errors);
            }
        }
    }
</script>
<style>
.v-select .dropdown-toggle {
    padding: 0 0 0px;
    border-radius: 3px;
}

.v-select input[type=search], .v-select input[type=search]:focus {
    margin: 0px 0 0;
    padding: 0 7px;
}

</style>
