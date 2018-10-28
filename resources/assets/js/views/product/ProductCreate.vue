<template>
    <div>
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        <i class="fa fa-plus"></i>
                        <small>Formulario de creación de productos</small>
                    </h2>
                </div>
                <div class="panel-body">
                    <div class="form">
                        <div class="col-xs-12 col-md-6 col-lg-8" >
                            <div class="form-group">
                                <label class="control-label">Nombre</label>
                                <input type="text" v-model="create.name" class="form-control">
                                <p class="text-danger" v-if="errors.name">{{ errors.name[0]}}</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label class="">Marca</label>
                                <v-select label="name" :options="makes" v-model="create.make"></v-select>
                                <p class="text-danger" v-if="errors.make_id">{{ errors.make_id[0]}}</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label class="">Categoria</label>
                                <v-select label="name" :options="categories" v-model="create.category"></v-select>
                                <p class="text-danger" v-if="errors.category_id">{{ errors.category_id[0]}}</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label class="">Grupo</label>
                                <v-select label="name" :options="groups" v-model="create.group"></v-select>
                                <p class="text-danger" v-if="errors.product_group_id">{{ errors.product_group_id[0]}}</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label class="">Serie</label>
                                <v-select label="name" :options="series" v-model="create.serie"></v-select>
                                <p class="text-danger" v-if="errors.product_serie_id">{{ errors.product_serie_id[0]}}</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label class="">Medida</label>
                                <v-select label="name" :options="unit_measures" v-model="create.unit"></v-select>
                                <p class="text-danger" v-if="errors.unit_measure_id">{{ errors.unit_measure_id[0]}}</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label class="">Presentación</label>
                                <v-select label="name" :options="presentations" v-model="create.presentation"></v-select>
                                <p class="text-danger" v-if="errors.product_presentation_id">{{ errors.product_presentation_id[0]}}</p>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label class="">Stock minimo</label>
                                <input type="text" v-model="create.minimum_stock" class="form-control">
                                <p class="text-danger" v-if="errors.minimum_stock">{{ errors.minimum_stock[0]}}</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label class="">Barcode</label>
                                <input type="text" v-model="create.barcode" class="form-control">
                                <p class="text-danger" v-if="errors.barcode">{{ errors.barcode[0]}}</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label class="control-label">Precio venta</label>
                                <input type="text" v-model="create.price" class="form-control">
                                <p class="text-danger" v-if="errors.price">{{ errors.price[0]}}</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label class="control-label">Precio descuento</label>
                                <input type="text" v-model="create.offer_price" class="form-control">
                                <p class="text-danger" v-if="errors.offer_price">{{ errors.offer_price[0]}}</p>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label class="">Descripción</label>
                                <input type="text" v-model="create.description" class="form-control">
                                <p class="text-danger" v-if="errors.description">{{ errors.description[0]}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <label class="switch switch-primary">
                                        <input type="checkbox" v-model="add_colors" class="switch-input">
                                        <span class="switch-label" data-on="Si" data-off="No"></span>
                                        <span class="switch-handle"></span>
                                    </label>
                                    <strong>Agregar colores</strong>
                                </div>
                                <div v-if="add_colors" class="col-xs-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr v-for="(chunk, index) in chunkedColors()" :key="index">
                                                    <td v-for="color in chunk" :key="color.id" :style="'background-color:'+ color.color">
                                                        <div>
                                                            <label class="text-center">
                                                                <input
                                                                    class="color"
                                                                    style="width: 30px; height: 10px; margin: 0;"
                                                                    type="checkbox"
                                                                    v-model="create.colors"
                                                                    :value="color.id"
                                                                    >
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <label class="switch switch-primary">
                                        <input type="checkbox" v-model="create.make_order" class="switch-input">
                                        <span class="switch-label" data-on="Si" data-off="No"></span>
                                        <span class="switch-handle"></span>
                                    </label>
                                    <strong>Crear pedido inicial</strong>
                                </div>
                            </div>
                        </div>
                        <div v-if="create.make_order" class="row">
                            <div class="col-xs-12">
                                <div class="col-xs-12 col-md-6 col-lg-3">
                                    <div class="form-group">
                                        <label class="control-label">Precio compra</label>
                                        <input type="number" v-model="create.purchase_price" class="form-control">
                                        <p class="text-danger" v-if="errors.purchase_price">{{ errors.purchase_price[0]}}</p>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-3">
                                    <div class="form-group">
                                        <label class="control-label">Cantidad</label>
                                        <input type="text" v-model="create.lot" class="form-control">
                                        <p class="text-danger" v-if="errors.lot">{{ errors.lot[0]}}</p>
                                    </div>
                                </div>
                                 <div class="col-xs-12 col-sm-6 col-lg-3">
                                    <div class="form-group">
                                        <label class="">Proveedor</label>
                                        <v-select label="name" :options="people" v-model="create.people"></v-select>
                                        <p class="text-danger" v-if="errors.people_id">{{ errors.people_id[0]}}</p>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-3">
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
                <div class="panel-footer">
                    <button @click="end" type="button" class="btn btn-link"> Salir</button>
                    <button @click="store" type="button" :disabled="storeButton" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                </div>
            </div>
        </div>
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
    import Color from '../../models/Color';
    import People from '../../models/People';
    import vSelect from 'vue-select';

    export default {
        components: { vSelect},
        data(){
            return {
                storeButton:false,
                colors:[],
                add_colors:false,
                create:{make_order:false, colors:[]},
                errors:[],
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
            this.loadData();
        },
        methods:{
            chunkedColors () {
                return _.chunk(_.toArray(this.colors),20)
            },
            end(){
                this.$emit('end', 'Producto creado');
            },
            loadData(){
                Color.get({}, data => { this.colors = data.data});
                People.get({type:'provider'}, data => { this.people = data.data});
                Make.get({}, data => { this.makes = data.data});
                Group.get({}, data => { this.groups = data.data});
                Serie.get({}, data => { this.series = data.data});
                Presentation.get({}, data => { this.presentations = data.data});
                Category.get({}, data => { this.categories = data.data});
                UnitMeasure.get({}, data => { this.unit_measures = data.data});
            },
            store(){
                this.storeButton  = true;
                this.create.make ? (this.create.make_id = this.create.make.id) :'',
                this.create.serie ? (this.create.product_serie_id = this.create.serie.id) :'',
                this.create.category ? (this.create.category_id = this.create.category.id) :'',
                this.create.unit ? (this.create.unit_measure_id = this.create.unit.id) :'',
                this.create.group ? (this.create.product_group_id = this.create.group.id) :'',
                this.create.presentation ? (this.create.product_presentation_id = this.create.presentation.id) :'',
                this.create.people ? (this.create.people_id = this.create.people.id) :'',

                Product.store(this.create, data => {
                    this.errors=[];
                    this.create={make_order:false, colors:[]};
                    this.$toastr.s("Producto Agregado");
                    this.storeButton  = false;
                }, errors => {
                    this.errors = errors;
                    this.storeButton  = false;
                });
            }




        }
    }
</script>
<style>
.form-group{
    height: 65px !important;
}
.v-select{
    height: 34px !important;
}
.v-select .dropdown-toggle {
    padding: 0 0 0px;
    border-radius: 3px;
}

.v-select input[type=search], .v-select input[type=search]:focus {
    margin: 0px 0 0;
    padding: 0 6px;
}

</style>
