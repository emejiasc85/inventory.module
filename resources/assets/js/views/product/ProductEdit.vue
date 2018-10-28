<template>
    <div>
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        <i class="fa fa-plus"></i>
                        <small>Formulario de edición de productos</small>
                    </h2>
                </div>
                <div class="panel-body">
                    <div class="form">
                        <div class="col-xs-12 col-md-6 col-lg-8" >
                            <div class="form-group">
                                <label class="control-label">Nombre</label>
                                <input type="text" v-model="product.name" class="form-control">
                                <p class="text-danger" v-if="errors.name">{{ errors.name[0]}}</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label class="">Marca</label>
                                <v-select label="name" :options="makes" v-model="product.make"></v-select>
                                <p class="text-danger" v-if="errors.make_id">{{ errors.make_id[0]}}</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label class="">Categoria</label>
                                <v-select label="name" :options="categories" v-model="product.category"></v-select>
                                <p class="text-danger" v-if="errors.category_id">{{ errors.category_id[0]}}</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label class="">Grupo</label>
                                <v-select label="name" :options="groups" v-model="product.group"></v-select>
                                <p class="text-danger" v-if="errors.product_group_id">{{ errors.product_group_id[0]}}</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label class="">Serie</label>
                                <v-select label="name" :options="series" v-model="product.serie"></v-select>
                                <p class="text-danger" v-if="errors.product_serie_id">{{ errors.product_serie_id[0]}}</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label class="">Medida</label>
                                <v-select label="name" :options="unit_measures" v-model="product.unit"></v-select>
                                <p class="text-danger" v-if="errors.unit_measure_id">{{ errors.unit_measure_id[0]}}</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label class="">Presentación</label>
                                <v-select label="name" :options="presentations" v-model="product.presentation"></v-select>
                                <p class="text-danger" v-if="errors.product_presentation_id">{{ errors.product_presentation_id[0]}}</p>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label class="">Stock minimo</label>
                                <input type="text" v-model="product.minimum_stock" class="form-control">
                                <p class="text-danger" v-if="errors.minimum_stock">{{ errors.minimum_stock[0]}}</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label class="">Barcode</label>
                                <input type="text" v-model="product.barcode" class="form-control">
                                <p class="text-danger" v-if="errors.barcode">{{ errors.barcode[0]}}</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label class="control-label">Precio venta</label>
                                <input type="text" v-model="product.price" class="form-control">
                                <p class="text-danger" v-if="errors.price">{{ errors.price[0]}}</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label class="control-label">Precio descuento</label>
                                <input type="text" v-model="product.offer_price" class="form-control">
                                <p class="text-danger" v-if="errors.offer_price">{{ errors.offer_price[0]}}</p>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label class="">Descripción</label>
                                <input type="text" v-model="product.description" class="form-control">
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
                                                                    v-model="product.colors"
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
                    </div>
                </div>
                <div class="panel-footer">
                    <button @click="end" type="button" class="btn btn-link"> Salir</button>
                    <button @click="update" type="button" class="btn btn-success"><i class="fa fa-save"></i> Guardar Cambios</button>
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
    import vSelect from 'vue-select';

    export default {
        components: {vSelect},
        props:['product_id'],
        data(){
            return {
                colors:[],
                add_colors:false,
                product:{},
                errors:[],
                makes:[],
                groups:[],
                series:[],
                presentations:[],
                categories:[],
                unit_measures:[],
            }
        },
        created(){
            this.loadData();
            this.index();
        },
        methods:{
            chunkedColors () {
                return _.chunk(_.toArray(this.colors),20)
            },
            end(){
                this.$emit('end');
            },
            index(){
                Product.show(this.product_id, data => {
                    this.product = data.data;
                    this.add_colors = this.product.colors.length > 0 ? true:false;
                });
            },
            loadData(){
                Color.get({}, data => { this.colors = data.data});
                Make.get({}, data => { this.makes = data.data});
                Group.get({}, data => { this.groups = data.data});
                Serie.get({}, data => { this.series = data.data});
                Presentation.get({}, data => { this.presentations = data.data});
                Category.get({}, data => { this.categories = data.data});
                UnitMeasure.get({}, data => { this.unit_measures = data.data});
            },
            update(){
                this.product.make ? (this.product.make_id = this.product.make.id) :'',
                this.product.serie ? (this.product.product_serie_id = this.product.serie.id) :'',
                this.product.category ? (this.product.category_id = this.product.category.id) :'',
                this.product.unit ? (this.product.unit_measure_id = this.product.unit.id) :'',
                this.product.group ? (this.product.product_group_id = this.product.group.id) :'',
                this.product.presentation ? (this.product.product_presentation_id = this.product.presentation.id) :'',

                Product.update(this.product_id,this.product, data => {
                    this.$toastr.s("Producto Editado");
                    this.errors=[];
                    this.product= data.data;
                }, errors => this.errors = errors);
            },
            findColor(color_id){

                let find = _.find(this.product.colors, function(o) { return o.id == color_id; });
                return find ? true:false;

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
