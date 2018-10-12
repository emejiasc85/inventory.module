<template>
<div class="col-xs-12">
    <div class="row">
        <div class="invoice">
            <div class="row header visible-print-block">
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <img :src="commerce.logo" alt="" class="img-rounded pull-right" width="75">
                            <p><strong>{{ commerce.name}}</strong></p>
                            <p>{{ commerce.patent_name}}</p>
                            <p>{{ commerce.address}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row header">
                <div class="col-xs-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            ID <strong>#{{cash_register.id}}</strong>
                        </div>
                    </div>
                </div>
                 <div class="col-xs-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Usuario: <strong>{{cash_register.user_id ? cash_register.user_id.name :''}}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Apertura: <strong>{{cash_register.created_at}}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <p v-if="cash_register.status" >
                                Cierre: <strong>{{cash_register.closing_date}}</strong>
                            </p>
                            <a v-else  @click="show_close_cash_register = !show_close_cash_register">
                                <i class="fa fa-ban primary"></i>
                                <span class="value text-primary"><strong>Cerrar Caja</strong></span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Movimiento</th>
                                <th class="right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="center">1</td>
                                <td class="left">Pagos en Efectivo</td>
                                <td class="right">Q.{{ cash_register.cash_payments}}</td>
                            </tr>
                            <tr>
                                <td class="center">2</td>
                                <td class="left">Pagos con tarjeta</td>
                                <td class="right">Q.{{ cash_register.card_payments }}</td>
                            </tr>
                            <tr>
                                <td class="center">3</td>
                                <td class="left">Pagos con cheques</td>
                                <td class="right">Q.{{ cash_register.check_payments }}</td>
                            </tr>
                            <tr>
                                <td class="center">4</td>
                                <td class="left">Creditos</td>
                                <td class="right">Q.{{ cash_register.credit_payments }}</td>
                            </tr>
                            <tr>
                                <td class="center">4</td>
                                <td class="left">GiftCard</td>
                                <td class="right">Q.{{ cash_register.gift_card_payments }}</td>
                            </tr>
                            <tr>
                                <td class="center">5</td>
                                <td class="left">Abonos a creditos</td>
                                <td class="right">Q.{{ cash_register.credit_abones }}</td>
                            </tr>
                            <tr>
                                <td class="center">6</td>
                                <td class="left">Depositos</td>
                                <td class="right">Q.{{ cash_register.deposits }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="row">

                        <div class="col-lg-4 col-sm-5 notice">
                            <!-- <div class="well">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                            </div> -->
                        </div>

                        <div class="col-lg-3 col-lg-offset-5 col-sm-5 col-sm-offset-2 recap">
                            <table class="table table-clear">
                                <tbody>
                                    <tr>
                                        <td class="left"><strong>Subtotal</strong></td>
                                        <td class="right">Q. {{ cash_register.sub_total }}</td>
                                    </tr>
                                    <tr>
                                        <td class="left"><strong>Saldo Inicial</strong></td>
                                        <td class="right">Q.{{ cash_register.initial_cash }}</td>
                                    </tr>
                                    <tr>
                                        <td class="left"><strong>Total</strong></td>
                                        <td class="right"><strong>Q.{{ cash_register.total}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="left"><strong>Total Efectivo</strong></td>
                                        <td class="right"><strong>Q.{{ cash_register.cash_payments }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="#" class="hidden-print btn btn-info" onclick="javascript:window.print();"><i class="  fa fa-print"></i> Imprimir</a>
                            <button type="button" @click="showDetails" class="hidden-print btn btn-default"> Salir</button>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <modal v-if="show_close_cash_register"  title="Alerta!!!"  size="modal-sm">
        <h2>¿Estas seguro de cerrar esta caja?</h2>
        <button @click="show_close_cash_register = !show_close_cash_register" slot="btnCancel" type="button" class="btn btn-link">Cancelar</button>
        <button slot="btnSave" type="button" class="btn btn-danger" @click="closeCashRegister">Si, Cerrar Caja</button>
    </modal>
</div>
</template>
<script>
    import Commerce from '../models/Commerce';
    import CashRegister from '../models/CashRegister';
    export default {
        props:['cash_register_id'],
        data(){
            return {
                show_close_cash_register:false,
                cash_register:{},
                commerce:{},

            }
        },
        created(){
            this.LoadCommerce();
            this.loadCashRegister();
        },
        computed: {

        },
        methods:{

            loadCashRegister(){
                CashRegister.show(this.cash_register_id, data => {
                    this.cash_register = data.data
                });
            },
            showDetails(){
                this.$emit('showDetails', this.cash_register.id)
            },
            closeCashRegister(){
                let params = {
                    cash_register_id: this.cash_register_id,
                    status :1
                };

                CashRegister.update(this.cash_register_id, params, data => {
                    this.show_close_cash_register = false;
                    this.loadCashRegister();
                    this.errors = {};
                    this.$toastr.s("Caja cerrada");
                }, errors => this.errors = errors);
            },
            LoadCommerce(){
                Commerce.show(1,{}, data => { this.commerce = data.data});
            },
        }
    }
</script>
