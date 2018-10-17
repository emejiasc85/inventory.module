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
                            <a class="hidden-print" v-else  @click="show_close_cash_register = !show_close_cash_register">
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
                                <td class="right">Q. {{ cash_register.cash_payments}}</td>
                            </tr>
                            <tr>
                                <td class="center">2</td>
                                <td class="left">Pagos con tarjeta</td>
                                <td class="right">Q. {{ cash_register.card_payments }}</td>
                            </tr>
                            <tr>
                                <td class="center">3</td>
                                <td class="left">Pagos con cheques</td>
                                <td class="right">Q. {{ cash_register.check_payments }}</td>
                            </tr>
                            <tr>
                                <td class="center">4</td>
                                <td class="left">Creditos</td>
                                <td class="right">Q. {{ cash_register.total_credits }}</td>
                            </tr>
                            <tr>
                                <td class="center">5</td>
                                <td class="left">Pagos con gift card</td>
                                <td class="right">Q. {{ cash_register.gift_card_payments }}</td>
                            </tr>
                            <tr>
                                <td class="center">6</td>
                                <td class="left">Abonos a creditos</td>
                                <td class="right">Q. {{ cash_register.credit_abones }}</td>
                            </tr>
                            <!-- <tr>
                                <td class="center">6</td>
                                <td class="left">Depositos</td>
                                <td class="right">Q. {{ cash_register.deposits }}</td>
                            </tr> -->
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
                                        <td class="right">Q. {{ cash_register.initial_cash }}</td>
                                    </tr>
                                    <tr>
                                        <td class="left"><strong>Total</strong></td>
                                        <td class="right"><strong>Q. {{ cash_register.total}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="left"><strong>Total Efectivo</strong></td>
                                        <td class="right"><strong>Q. {{ cash_register.cash_payments }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="#" class="hidden-print btn btn-info" onclick="javascript:window.print();"><i class="  fa fa-print"></i> Imprimir</a>
                            <button type="button" @click="showDetails" class="hidden-print btn btn-success"> Salir</button>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Depositos de caja</h4>
                <div class="pull-right hidden-print">
                    <button @click="show_create_deposit = true" type="buttin" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-responsive">
                    <thead>
                        <tr>
                            <th class="center">#</th>
                            <th>Fecha</th>
                            <th>Banco</th>
                            <th>Cuenta</th>
                            <th>No. Documento</th>
                            <th>Monto</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="deposit in cash_register.cr_deposits" :key="deposit.id">
                            <td class="center">#</td>
                            <td>{{ deposit.date }}</td>
                            <td>{{ deposit.bank}}</td>
                            <td>{{deposit.account}}</td>
                            <td>{{ deposit.baucher}}</td>
                            <td>{{deposit.amount}}</td>
                            <td><button type="button" @click="deleteDeposit(deposit)" class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

    </div>
    <modal v-if="show_close_cash_register"  title="Alerta!!!"  size="modal-sm">
        <h2 v-if="!errors.status">¿Estas seguro de cerrar esta caja?</h2>
        <h2 v-if="errors.status">No se pudo cerrar</h2>
        <p v-if="errors.status" class="text-danger">{{ errors.status[0]}}</p>
        <button @click="show_close_cash_register = !show_close_cash_register" slot="btnCancel" type="button" class="btn btn-link">Cancelar</button>
        <button v-if="!errors.status" slot="btnSave" type="button" class="btn btn-danger" @click="closeCashRegister">Si, Cerrar Caja</button>
    </modal>
    <modal v-if="show_destroy_deposit"  title="Alerta!!!"  size="modal-sm">
        <h2>¿Estas seguro de eliminar este deposito?</h2>
        <button @click="show_destroy_deposit = false" slot="btnCancel" type="button" class="btn btn-link">Cancelar</button>
        <button slot="btnSave" type="button" class="btn btn-danger" @click="destroyDeposit">Si, Eliminar</button>
    </modal>

    <modal v-if="show_create_deposit"  title="Formulario de creación de deposito"  size="modal-sm">
        <div class="form">
            <div class="form-group">
                <label for="company">Fecha</label>
                <input type="date" class="form-control" v-model="deposit.date">
                <p v-if="errors.date" class="text-danger">{{errors.date[0]}}</p>
            </div>
            <div class="form-group">
                <label for="company">Banco</label>
                <input type="text" class="form-control" v-model="deposit.bank">
                <p v-if="errors.bank" class="text-danger">{{errors.bank[0]}}</p>
            </div>
            <div class="form-group">
                <label for="company">Cuenta</label>
                <input type="text" class="form-control" v-model="deposit.account">
                <p v-if="errors.account" class="text-danger">{{errors.account[0]}}</p>

            </div>
            <div class="form-group">
                <label for="company">No. Documento</label>
                <input type="text" class="form-control" v-model="deposit.baucher">
                <p v-if="errors.baucher" class="text-danger">{{errors.baucher[0]}}</p>

            </div>
            <div class="form-group">
                <label for="company">Monto</label>
                <input type="text" class="form-control" v-model="deposit.amount">
                <p v-if="errors.amount" class="text-danger">{{errors.amount[0]}}</p>
            </div>
        </div>
        <button @click="show_create_deposit = false" slot="btnCancel" type="button" class="btn btn-link">Cancelar</button>
        <button slot="btnSave" type="button" class="btn btn-primary" @click="storeDeposit"><i class="fa fa-save"></i> Guardar</button>
    </modal>
</div>
</template>
<script>
    import Commerce from '../models/Commerce';
    import CashRegister from '../models/CashRegister';
    import CashRegisterDeposit from '../models/CashRegisterDeposit';
    export default {
        props:['cash_register_id'],
        data(){
            return {
                show_destroy_deposit:false,
                show_create_deposit:false,
                show_close_cash_register:false,
                cash_register:{},
                commerce:{},
                deposit:{},
                errors:[]
            }
        },
        created(){
            this.LoadCommerce();
            this.loadCashRegister();
        },
        computed: {

        },
        methods:{
            storeDeposit(){
                this.deposit.cash_register_id = this.cash_register_id;
                CashRegisterDeposit.store(this.deposit, data => {
                    this.$toastr.s("Deposito agregado.");
                    this.deposit = {};
                    this.loadCashRegister();
                    this.errors = {};
                    this.show_create_deposit = false;
                }, errors => this.errors = errors);
            },
            deleteDeposit(deposit){
                this.show_destroy_deposit = true;
                this.deposit = deposit;
            },
            destroyDeposit(){

                CashRegisterDeposit.destroy(this.deposit.id, data => {
                    this.show_destroy_deposit = false;
                    this.deposit = {};
                    this.$toastr.s("Deposito eliminado");
                    this.loadCashRegister();
                });
            },
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
