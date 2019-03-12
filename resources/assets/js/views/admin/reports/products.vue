<template>
    <div class="panel panel-default">
        <div class="panel-heading hidden-print">
            <h2><i class="fa fa-cubes"></i><span class="break"></span>Reporte de Movimiento de Productos</h2>
            <!-- <div class="pull-right">
                <button @click="show_add = true" class="btn btn-success btn-sm" v-tooltip="'Agregar bodega'" >
                    <i class="fa fa-plus" style="color:white !important"></i>
                </button>
            </div> -->
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
                            <td>{{ product.orders}}</td>
                            <td>{{ product.sales}}</td>
                            <td>{{ product.stocks}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import ProductReport from '../../../models/ProductReport';
    export default {
        data(){
            return {
                products:[]
            }
        },
        created(){
            this.index();
        },
        methods:{
            index(){
                ProductReport.get({}, data => {
                    this.products = data.data;
                });
            }
        }
    }
</script>
