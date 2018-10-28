<template>
<div>
    <div class="row">
        <div v-if="cash_register.status != 1" class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-xxs-12">
            <a  href="/sales/invoice">
                <div class="smallstat">
                    <i class="fa fa-shopping-cart primary"></i>
                    <span class="value text-primary">Facturar</span>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
            <div class="smallstat">
                <span class="value text-muted">Q. {{ cash_register.sales}} </span>
                <span class="title">Ventas</span>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
            <div class="smallstat">
                <span class="value text-muted">Q. {{ cash_register.credit_payments}} </span>
                <span class="title">Abono a credito</span>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
            <div class="smallstat">
                <span class="value text-muted">Q. {{cash_register.total_credits}} </span>
                <span class="title">Creditos</span>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
            <a href="#" @click="showResumen">
                <div class="smallstat">
                    <i class="fa fa-inbox info text-muted hidden-xs"></i>
                    <span class="value text-success">Q. {{ cash_register.total }} </span>
                    <strong>Resumen</strong>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="form">
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label>Cliente</label>
                                <input type="text" v-model="filter.people_name" class="form-control input-sm">
                            </div>
                            <div class="form-group col-sm-1">
                                <label>ID</label>
                                <input type="text" v-model="filter.id" class="form-control input-sm">
                            </div>
                            <div class="form-group col-sm-2">
                                <label>Desde</label>
                                <input type="date" v-model="filter.from_date" class="form-control input-sm">
                            </div>
                            <div class="form-group col-sm-2">
                                <label>Hasta</label>
                                <input type="date" v-model="filter.to_date" class="form-control input-sm">
                            </div>
                            <div class="form-group col-sm-1 text-center ">
                                <label>Credito</label>
                                <checkbox type="checkbox" v-model="filter.credit" value="1"></checkbox>
                            </div>
                            <div class="form-group col-sm-2 ">
                                <br>
                                <button @click="index" type="buttom" class="btn btn-primary"><i class="fa fa-filter"></i> Filtrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">

                    <div class="table-resposive">
                        <table class="table col-sm-12">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th>Fecha</th>
                                    <th>Cliente</th>
                                    <th class="text-center">Productos</th>
                                    <th>Total</th>
                                    <th>Vendedor</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="invoice in invoices" :key="invoice.id">
                                    <td class="text-center">{{ invoice.id }}</td>
                                    <td>{{ invoice.created_at }}</td>
                                    <td>{{ invoice.people.name }}</td>
                                    <td class="text-center">{{ invoice.lot }}</td>
                                    <td>{{ invoice.final_total }}</td>
                                    <td>{{ invoice.user.name}}</td>
                                    <td>
                                        <span v-if="invoice.status == 'Ingresado'" class="label label-success">Facturado</span>
                                        <span v-else class="label label-default">No Facturado</span>
                                    </td>
                                    <td><a :href="'/sales/invoice/?id='+invoice.id" class="btn btn-info btn-sm" v-tooltip="'Detalles'"> <i class="fa fa-eye"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                        <paginator :pagination="pagination" @changePage="index"></paginator>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
    import CashRegister from '../models/CashRegister';
    import Invoice from '../models/Invoice';
    import Paginator from '../components/Paginator.vue';

    export default {
        components: {Paginator},
        props:['cash_register_id'],
        data(){
            return {
                cash_register:{},
                invoices:[],
                pagination: {},
                errors:[],
                filter:{}
            }
        },
        created(){
            this.loadCashRegister();
        },
        methods:{
            loadCashRegister(){
                CashRegister.show(this.cash_register_id, data=> {
                    this.cash_register = data.data;
                    this.index();
                });
            },
            showResumen(){
                this.$emit('showResumen', this.cash_register.id)
            },
            index(page = 1){
                let params = {
                    cash_register_id : this.cash_register_id,
                    people_name: this.filter.people_name,
                    id: this.filter.id ,
                    from: this.filter.from ,
                    to: this.filter.to ,
                    credit: this.filter.credit,
                    page: page,
                 }

                 Invoice.get(params, data => {
                     this.invoices = data.data;
                     this.pagination = data.meta;
                 });
            },
        },
    }
</script>
