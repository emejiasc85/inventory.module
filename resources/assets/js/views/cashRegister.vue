<template>
    <div>
        <cash-register-details :cash_register_id="other_cash_register_id" v-if="show_details" @showResumen="resumen"></cash-register-details>
        <cash-register-resumen :cash_register_id="other_cash_register_id" v-else-if="show_resumen" @showDetails="details"></cash-register-resumen>
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
            <button slot="btnSave" type="button" :disabled="storeCashRegisterButton" class="btn btn-primary" @click="storeCashRegister">Aperturar Caja</button>
        </modal>
    </div>
</template>

<script>
    import CashRegisterDetails from './cashRegisterDetails';
    import CashRegisterResumen from './cashRegisterResumen';
    import CashRegister from '../models/CashRegister';


    export default {
        components: {CashRegisterDetails, CashRegisterResumen},
        props:['cash_register_id'],
        data() {
            return  {
                storeCashRegisterButton:true,
                create_cash_register :false,
                show_details:false,
                show_resumen: false,
                cash_register: {},
                errors:[],
                other_cash_register_id:null
            }
        },
        created(){
            if (this.cash_register_id != '' ) {
                this.details(this.cash_register_id);
            }else{
                this.loadCashRegisters();
            }
        },

        methods: {
            loadCashRegisters(){
                CashRegister.get({latest:1}, data => {

                    if (data.data.length  == 0) {
                        this.$toastr.w("Por Favor Apertura Caja.");
                        this.create_cash_register = true;
                    }
                    if (data.data.length  == 1) {
                        this.cash_register = _.head(data.data);
                        this.details(this.cash_register.id);
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
                    this.details(this.cash_register.id);
                    this.errors = {};
                    this.create_cash_register = false;
                }, errors => this.errors = errors);
            },
            resumen(cash_register_id){
                this.show_details = false;
                this.show_resumen = true;
                this.other_cash_register_id = cash_register_id;
            },
            details(cash_register_id){
                this.show_details = true;
                this.show_resumen = false;
                this.other_cash_register_id = cash_register_id;
            }
        }
    }
</script>