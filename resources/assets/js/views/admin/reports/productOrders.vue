<template>
    <div>
        <div class="panel panel-default">
                <div  class="panel-body">
                    <div class="form-inline">
                        <div class="row">
                            <div class="col-xs-12 col-md-6 col-lg-3 ">
                                <label>Desde</label>
                                <input type="date" v-model="filter.from" class="form-control">
                            </div>
                            <div class="col-xs-12  col-md-6 col-lg-3 ">
                                <label>Hasta</label>
                                <input type="date" v-model="filter.to" class="form-control">
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-3">
                                <label>Id</label>
                                <input type="text" v-model="filter.id" class="form-control">
                            </div>
                            <div class="col-xs-12  col-md-6 col-lg-2 ">
                                <button @click="index" type="buttom" class="btn btn-info btn-sm hidden-print"><i class="fa fa-filter"></i> Filtrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="panel panel-default">
            <div class="panel-heading hidden-print">
                <h2><i class="fa fa-cubes"></i><span class="break"></span>Reporte de Ingresos de productos</h2>
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
                                <th>Ingresaron</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="detail in details" :key="detail.id">
                                <td>{{ detail.product.id}}</td>
                                <td>{{ detail.product.name}}</td>
                                <td>{{ detail.product.make? detail.product.make.name:'' }}</td>
                                <td>{{ detail.product.group? detail.product.group.name:'' }}</td>
                                <td>{{ detail.product.serie ? detail.product.serie.name:'' }}</td>
                                <td class="text-center">{{ detail.product.unit ? detail.product.unit.name:'' }}</td>
                                <td>{{ detail.product.presentation ? detail.product.presentation.name:'' }}</td>
                                <td class="hidden-print"><a target="_black" :href="'/ordenes/detalle/orden-'+detail.order_id">{{ detail.lot}}</a></td>
                                <td class="visible-print-block text-center">{{ detail.lot}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <paginator :pagination="pagination" @changePage="index"></paginator>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import ProductOrderReport from '../../../models/ProductOrderReport';
    import Paginator from '../../../components/Paginator.vue';
    import vSelect from 'vue-select';

    export default {
        components:{Paginator, vSelect},
        data(){
            return {
                details:[],
                pagination: {},
                filter:{}
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
                    from: this.filter.from ? this.filter.from:null,
                    to: this.filter.to ? this.filter.to:null,
                };
                ProductOrderReport.get(params, data => {
                    this.details = data.data;
                    this.pagination = data.meta;
                });
            }
        }
    }
</script>
