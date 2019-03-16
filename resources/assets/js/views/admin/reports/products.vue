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
                            <td><a href="#"  @click="show(product)" >{{ product.orders}}</a></td>
                            <td><a href="#"  @click="showSaleDetails(product)" >{{ product.sales}}</a></td>
                            <td>{{ product.stocks}}</td>
                        </tr>
                    </tbody>
                </table>
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
            <button type="button" @click="showDetails = false" slot="btnCancel" class="btn btn-link">Salir</button>
        </modal>
    </div>
</template>

<script>
    import ProductReport from '../../../models/ProductReport';
    export default {
        data(){
            return {
                showDetails:false,
                showSales:false,
                products:[],
                product:{},
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
            index(){
                ProductReport.get({}, data => {
                    this.products = data.data;
                });
            }
        }
    }
</script>
