<template>
    <div>
        <div class="col-xs-12 col-md-6 col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        <i class="fa fa-bookmark-o"></i>
                        <small>Detalles de producto</small>
                    </h2>
                    <div class="pull-right">
                        <button @click="end" type="button" class="btn btn-link btn-sm"> Salir</button>
                    </div>
                </div>
                <div class="panel-body">

                    <p>{{product.description}}</p>
                    <ul class="list-unstyled" >
                        <li>
                            <p>
                                <span class="icon-grid"></span>
                                <strong>Grupo:</strong> {{ product.group ? product.group.name:'' }}
                            </p>
                        </li>
                        <li>
                            <p>
                                <span class="fa fa-bookmark-o"></span>
                                <strong>Serie:</strong> {{ product.serie ? product.serie.name:'' }}
                            </p>
                        </li>
                        <li>
                            <p>
                                <span class="icon-grid"></span>
                                <strong>Categoria:</strong> {{ product.category ? product.category.name:'' }}
                            </p>
                        </li>
                        <li>
                            <p>
                                <span class="icon-badge"></span>
                                <strong>Marca:</strong> {{ product.make ? product.make.name:'' }}
                            </p>
                        </li>
                        <li>
                            <p>
                                <span class="icon-tag"></span>
                                <strong>Presentación:</strong> {{ product.presentation ? product.presentation.name:'' }}
                            </p>
                        </li>
                        <li>
                            <p>
                                <span class="fa fa-arrows-v"></span>
                                <strong>Medida:</strong> {{ product.unit ? product.unit.name:'' }}
                            </p>
                        </li>
                        <li>
                            <p>
                                <span class="fa fa-money"></span>
                                <strong>Precio Venta:</strong> Q. {{ product.price }}
                            </p>
                        </li>
                        <li>
                            <p>
                                <span class="fa fa-certificate"></span>
                                <strong>Precio Oferta:</strong> Q. {{ product.offer_price }}
                            </p>
                        </li>
                        <li>

                            <p>
                                <strong>Colores:</strong>
                                <br>
                                <span v-for="color in product.colors" :key="color.id"  class="fa fa-square" :style="'color:'+ findColor(color)+'; font-size: 2em'"></span>
                            </p>
                        </li>
                        <li>
                            <p>
                                <span class="fa fa-barcode"></span>
                                <strong>barcode:</strong> {{ product.barcode }}
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="panel-footer">
                    <a target="_blank"  :href="'/barcode/productos/'+product.id" class="btn btn-primary btn-block"><i class="fa fa-print"></i> Imprimir Codigo de barras</a>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-8">
            <div class="panel panel-default " style="border-top: 2px solid rgb(32, 168, 216);">
                <div class="panel-heading"><i class="fa fa-image"></i> <strong>Imagenes</strong> </div>
                <div class="panel-body"></div>
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
    import VueBarcode from '@xkeshi/vue-barcode';

    export default {
        components: { vSelect, VueBarcode},
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
                options:{
                    //lineColor: '#ff7069',
                    fontSize: 12,
                    font: 'Courier',
                    width: 1,
                    height: 60,
                    //marginBottom: 60,
                    format: 'CODE39',
                    //background: '#ccffff'
                }
            }
        },
        created(){
            this.loadData();
            this.index();
        },
        methods:{
            end(){
                this.$emit('end');
            },
            index(){
                Product.show(this.product_id, data => {
                    this.product = data.data;
                });
            },
            loadData(){
                Color.get({}, data => { this.colors = data.data});
            },
            findColor(color_id){
                let find = _.find(this.colors, function(o) { return o.id == color_id; });
                return find ? find.color:'';
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
