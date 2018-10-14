<template>
<div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">
                <i class="fa fa-filter"></i>
                <small>Filtro</small>
            </h2>
        </div>
        <div class="panel-body">
            <div class="form">
                <div class="row">
                    <div class="form-group col-sm-2">
                        <div class="input-group">
                            <span class="input-group-addon">Caja Id</span>
                            <input type="text" v-model="filter.cash_register_id" class="form-control input-sm">
                        </div>
                    </div>
                    <div class="form-group col-sm-3">
                        <div class="input-group">
                            <span class="input-group-addon">Desde</span>
                            <input type="date" v-model="filter.from_date" class="form-control input-sm">
                        </div>
                    </div>
                    <div class="form-group col-sm-3">
                        <div class="input-group">
                            <span class="input-group-addon">Hasta</span>
                            <input type="date" v-model="filter.to_date" class="form-control input-sm">
                        </div>
                    </div>
                    <div class="form-group col-sm-4 ">
                        <button @click="index" type="buttom" class="btn btn-primary btn-sm"><i class="fa fa-filter"></i> Filtrar</button>
                        <a :href="excel" class="btn btn-success btn-sm"  >
                            <i class="fa fa-download" ></i> Descargar
                        </a>
                        <button class="btn btn-primary btn-sm " title="generar reporte" >
                            <i class="fa fa-file "></i> Reporte
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">
                <i class="fa fa-file-text-o"></i>
                <small>Resumen</small>
            </h2>
        </div>

        <div class="panel-body">

        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">
                <i class="fa fa-list"></i>

                <small>Listado</small>
            </h2>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha apertura</th>
                            <th>Fecha cierra</th>
                            <th class="text-right">Ventas</th>
                            <th class="text-right">Creditos</th>
                            <th class="text-right">Pagos</th>
                            <th class="text-right">Depositos de caja</th>
                            <th>usuario</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="register in cash_registers" :key="register.id">
                            <td>{{ register.id}}</td>
                            <td>{{ register.created_at}}</td>
                            <td>{{ register.closing_date}}</td>
                            <td class="text-right">{{ register.sub_total}}</td>
                            <td class="text-right">{{ register.total_credits}}</td>
                            <td class="text-right">{{ register.credit_payments}}</td>
                            <td class="text-right">{{ register.deposits}}</td>
                            <td>{{ register.user_id.name}}</td>
                            <td>
                                <span v-if="register.status == 0" class="label label-success"> Activa</span>
                                <span v-else class="label label-info"> Cerrada</span>
                            </td>
                            <td><a :href="'/sales/cash-register/?id='+register.id" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a></td>
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
</template>

<script>

    import CashRegister from '../models/CashRegister';
    import Paginator from '../components/Paginator.vue';

    export default {
        components: {Paginator},
        data(){
            return {
                cash_registers:[],
                filter:{},
                pagination: {},
                errors:[],
                export_link: '/export/cash_registers/resumen/exports',
            }
        },
        created(){
            this.index();
        },
        computed:{
            excel() {
                let link = this.export_link;
                let id   = this.filter.cash_register_id ? this.filter.cash_register_id:'';
                let from = this.filter.from_date ? this.filter.from_date:'';
                let to   = this.filter.to_date ? this.filter.to_date:'';
                return link + '?id=' + id + '&from=' + from+ '&to=' + to;
            }
        },
        methods:{
            index(page = 1){
                let params = {
                    page:  page,
                    id : this.filter.cash_register_id,
                    from: this.filter.from_date ,
                    to: this.filter.to_date ,
                };
                CashRegister.get(params, data => {
                    this.cash_registers = data.data;
                });
            }
        }
    }
</script>
