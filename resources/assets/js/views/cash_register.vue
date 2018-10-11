<template>
<div>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-xxs-12">
            <a  href="/sales/invoice">
                <div class="smallstat">
                    <i class="fa fa-shopping-cart primary"></i>
                    <span class="value text-primary">Facturar</span>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
            <div class="smallstat">
                <span class="value text-muted">Q. </span>
                <span class="title">Ventas</span>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
            <div class="smallstat">
                <span class="value text-muted">Q. </span>
                <span class="title">Abono a credito</span>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
            <div class="smallstat">
                <span class="value text-muted">Q. </span>
                <span class="title">Creditos</span>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
            <div class="smallstat">
                <i class="fa fa-inbox info text-muted hidden-xs"></i>
                <span class="value text-success">Q. </span>
                <a href="" class="title">Caja</a>
            </div>
        </div>

    </div>
    <modal v-if="create_cash_register"  title="Es necesario aperturar caja"  size="modal-sm">
            <div class="form" role="form">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="input-group">
                                <span class="input-group-addon">Q.</span>
                                <input type="text"  class="form-control" v-model="cash_register.initial_cash"  placeholder="Saldo Inicial" v-on:keyup.enter.prevent="storeCashRegister()">
                            </div>
                            <p v-if="errors.initial_cash" class="text-danger">{{ errors.initial_cash[0] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <a href="/" slot="btnCancel" type="button" class="btn btn-link">Salir</a>
            <button slot="btnSave" type="button" class="btn btn-primary" @click="storeCashRegister">Aperturar Caja</button>
        </modal>
</div>
</template>
<script>
    import CashRegister from '../models/CashRegister';
    export default {
        data(){
            return {
                create_cash_register :false,
                cash_register:{}
            }
        },
        created(){
            this.getCashRegister();

        },
        methods:{
            getCashRegister(){
                CashRegister.get({latest:1}, data => {

                    if (data.data.length  == 0) {
                        this.$toastr.w("Por Favor Apertura Caja.");
                        this.create_cash_register = true;
                    }
                    if (data.data.length  == 1) {
                        this.cash_register = _.head(data.data);
                        this.show_form_people = true;
                        this.nit_focus = true;
                    }
                    this.errors = {};
                }, errors => this.errors = errors);
            },
            storeCashRegister(){
                let params = {
                    initial_cash: this.cash_register.initial_cash
                };
                CashRegister.store(params, data => {
                    this.$toastr.s("Caja Aperturada.");
                    this.cash_register = data.data;
                    this.errors = {};
                    this.create_cash_register = false;
                }, errors => this.errors = errors);
            },
        },
    }
</script>
