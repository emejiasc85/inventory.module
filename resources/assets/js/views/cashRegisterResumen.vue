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
                                <td class="left">Pagos con Tarjetas de regalo</td>
                                <td class="right">Q. {{ cash_register.gift_card_payments }}</td>
                            </tr>
                            <tr>
                                <td class="center">6</td>
                                <td class="left">Abonos a créditos en Efectivo</td>
                                <td class="right">Q. {{ cash_register.credit_abones }}</td>
                            </tr>
                            <tr>
                                <td class="center">7</td>
                                <td class="left">Abonos a créditos por depositos</td>
                                <td class="right">Q. {{ cash_register.deposits }}</td>
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
    <div class="row page">
        <div class="panel panel-default">
            <div class="panel-heading">
                <ul class="nav nav-tabs pull-left" id="tabs">
                    <li :class="{ 'active': show_deposits}"><a @click="showDeposits" href="#deposits">Depositos de caja</a></li>
                    <li :class="{ 'active': show_payments}"><a @click="showPayments" href="#payments">Gastos de caja</a></li>
                </ul>
            </div>
            <div class="panel-body">
                <div v-if="show_deposits">
                    <table id="deposits"  class="table table-striped table-condensed table-responsive">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Fecha</th>
                                <th>Banco</th>
                                <th>Cuenta</th>
                                <th>No. Documento</th>
                                <th>Monto</th>
                                <th class="text-center">
                                    <button v-tooltip="'Agregar Deposito'" @click="showCreateDeposit" type="button" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i></button>
                                </th>
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
                                <td class="text-center"><button v-tooltip="'Eliminar'" type="button" @click="deleteDeposit(deposit)" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div v-if="show_payments">
                    <table id="payments"  class="table table-striped table-responsive table-condensed">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Fecha</th>
                                <th>Descripción</th>
                                <th>Monto</th>
                                <th class="text-center">
                                    <button v-tooltip="'Agregar Gasto'" @click="showCreateExpense" type="button" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i></button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="expense in cash_register.cr_expenses" :key="expense.id">
                                <td class="center">#</td>
                                <td>{{ expense.created_at }}</td>
                                <td>{{ expense.description}}</td>
                                <td>{{expense.amount}}</td>
                                <td class="text-center"><button type="button" @click="deleteExpense(expense)" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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
        <button :disabled="createDepositButton" slot="btnSave" type="button" class="btn btn-primary" @click="storeDeposit"><i class="fa fa-save"></i> Guardar</button>
    </modal>
    <modal v-if="show_create_expense"  title="Formulario de creación de gasto"  size="modal-md">
        <div class="form">

            <div class="form-group">
                <label for="company">Descripción</label>
                <textarea class="form-control" v-model="expense.description" rows="2"></textarea>
                <p v-if="errors.description" class="text-danger">{{errors.description[0]}}</p>
            </div>
            <div class="form-group">
                <label for="company">Monto</label>
                <input type="text" class="form-control" v-model="expense.amount">
                <p v-if="errors.amount" class="text-danger">{{errors.amount[0]}}</p>
            </div>
        </div>
        <button @click="show_create_expense = false" slot="btnCancel" type="button" class="btn btn-link">Cancelar</button>
        <button slot="btnSave" type="button" class="btn btn-primary" @click="storeExpense"><i class="fa fa-save"></i> Guardar</button>
    </modal>
    <modal v-if="show_destroy_expense"  title="Alerta!!!"  size="modal-sm">
        <h2>¿Estas seguro de eliminar este gasto?</h2>
        <button @click="show_destroy_expense = false" slot="btnCancel" type="button" class="btn btn-link">Cancelar</button>
        <button :disabled="destroyExpenseButton" slot="btnSave" type="button" class="btn btn-danger" @click="destroyExpense">Si, Eliminar</button>
    </modal>
</div>
</template>
<script>
    import Commerce from '../models/Commerce';
    import CashRegister from '../models/CashRegister';
    import CashRegisterDeposit from '../models/CashRegisterDeposit';
    import CashRegisterExpense from '../models/CashRegisterExpense';
    export default {
        props:['cash_register_id'],
        data(){
            return {
                destroyExpenseButton:true,
                destroyDepositButton:true,
                createExpenseButton:true,
                createDepositButton:true,
                show_create_expense:false,
                show_destroy_expense:false,
                show_deposits:true,
                show_payments:false,
                show_destroy_deposit:false,
                show_create_deposit:false,
                show_close_cash_register:false,
                cash_register:{},
                commerce:{},
                deposit:{},
                expense:{},
                errors:[]
            }
        },
        created(){
            this.LoadCommerce();
            this.loadCashRegister();
        },
        methods:{
            showDeposits(){
                this.show_payments = false;
                this.show_deposits = true;
            },
            showPayments(){
                this.show_payments = true;
                this.show_deposits = false;
            },
            showCreateDeposit(){
                this.show_create_deposit = true;
                this.createDepositButton = false;

            },
            showCreateExpense(){
                this.show_create_expense = true;
                this.createExpenseButton = false;
            },
            storeDeposit(){
                this.createDepositButton = true;
                this.deposit.cash_register_id = this.cash_register_id;
                CashRegisterDeposit.store(this.deposit, data => {
                    this.$toastr.s("Deposito agregado.");
                    this.deposit = {};
                    this.loadCashRegister();
                    this.errors = {};
                    this.show_create_deposit = false;
                }, errors => {
                    this.errors = errors;
                    this.createDepositButton = false;
                });
            },
            storeExpense(){
                this.createExpenseButton = true;
                this.expense.cash_register_id = this.cash_register_id;
                CashRegisterExpense.store(this.expense, data => {
                    this.$toastr.s("Gasto agregado.");
                    this.expense = {};
                    this.loadCashRegister();
                    this.errors = {};
                    this.show_create_expense = false;
                }, errors => {
                    this.errors = errors;
                    this.createDepositButton = false;
                });
            },
            deleteDeposit(deposit){
                this.destroyDepositButton = false;
                this.show_destroy_deposit = true;
                this.deposit = deposit;
            },
            deleteExpense(expense){
                this.destroyExpenseButton = false;
                this.show_destroy_expense = true;
                this.expense = expense;
            },
            destroyDeposit(){
                this.destroyDepositButton = true;
                CashRegisterDeposit.destroy(this.deposit.id, data => {
                    this.show_destroy_deposit = false;
                    this.deposit = {};
                    this.$toastr.s("Deposito eliminado");
                    this.loadCashRegister();
                });
            },
            destroyExpense(){
                this.destroyExpenseButton = true;
                CashRegisterExpense.destroy(this.expense.id, data => {
                    this.show_destroy_expense = false;
                    this.expense = {};
                    this.$toastr.s("gasto eliminado");
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
<style>
    div.page{
        page-break-after: always;
        page-break-inside: avoid;
    }
</style>
