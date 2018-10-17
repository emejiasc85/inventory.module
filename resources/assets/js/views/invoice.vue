<template>
    <div class="row">
        <div class="">
            <div class="col-xs-12 col-sm-7 hidden-print">
                <div class="panel panel-default ">
                    <div class="panel-heading ">
                        <button v-if="show_product_search"   @click="show_product_search = !show_product_search" type="button" class="btn btn-info btn-sm"><span class="fa fa-gift text-red"></span> Tarjeta de regalo</button>
                        <button v-if="!show_product_search" @click="show_product_search = !show_product_search"   type="button" class="btn btn-info btn-sm"><span class="fa fa-cubes text-red"></span> Productos</button>
                    </div>
                    <div class="panel-body clear">
                        <div v-if="!show_product_search">
                            <div  class="form">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-credit-card"></span></span>
                                                <input v-model="gift_card_id" v-on:keyup.enter.prevent="addGiftCard()" type="text"  class="form-control" placeholder="Tarjeta Código">
                                            </div>
                                            <p v-if="errors.gift_card_id" class="text-danger">{{ errors.gift_card_id[0] }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-1">
                                        <button class="btn btn-success" @click="addGiftCard"><i class="fa fa-shopping-cart"></i> Agregar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="show_product_search">
                            <div  class="form">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <input type="text" v-focus="barcode_focus" @focus="barcode_focus = true"  @blur="barcode_focus = false" class="form-control"  v-model="filter.barcode" v-on:keyup.enter.prevent="loadStock()"  placeholder="Cod. Barras">
                                    </div>
                                    <div class="col-xs-2">
                                        <input type="text" class="form-control" v-model="filter.id" v-on:keyup.enter.prevent="loadStock()"  placeholder="ID">
                                    </div>
                                    <div class="col-xs-5">
                                        <input type="text" class="form-control" v-model="filter.name" v-on:keyup.enter.prevent="loadStock()"  placeholder="Nombre">
                                    </div>
                                    <div class="col-xs-1">
                                        <button class="btn btn-primary" @click="loadStock"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Producto</th>
                                        <th>Grupo</th>
                                        <th>Existencia</th>
                                        <th>P/U</th>
                                        <th>P/O</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="product in stock" :key="product.id">
                                        <td>{{ product.id}}</td>
                                        <td>{{ product.full_name }}</td>
                                        <td>{{ product.name }}</td>
                                        <td>{{ product.stock }}</td>
                                        <td>{{ product.price }}</td>
                                        <td>{{ product.offer_price }}</td>
                                        <td>
                                            <a href="#" title="agregar" @click="addDetail(product)"  class="btn btn-default btn btn-sm add-product"> <i class="text-success fa fa-shopping-cart"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-5" :class="{'col-sm-offset-3': invoice.status == 'Finalizado' && invoice.credit == null }">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div v-if="people.max_credit > 0">
                            Credito:
                            <span v-if="people.rest_credit == 0 " class="text-danger">Q. {{ people.rest_credit}}</span>
                            <span v-if="people.rest_credit > 0" class="text-success">Q. {{ people.rest_credit}}</span>
                        </div>
                        <a v-if="invoice.status != 'Ingresado'" @click="show_destroy = true" href="#" title="Cancelar"  class="btn btn-link btn-sm pull-right hidden-print" style="margin-top: 2px"><span class="fa fa-2x fa-trash-o text-danger"></span></a>
                        <a v-if="invoice.status == 'Ingresado'" href="#" title="Revertir" @click="show_revert = true"  class="btn btn-link btn-sm pull-right hidden-print" style="margin-top: 2px"><span class="fa fa-2x fa-undo text-success"></span></a>
                    </div>
                        <div class="panel-body">
                        <address class="text-center">
                            <h2>{{ commerce.name }}</h2>
                            {{ commerce.address }}<br>
                            Nit {{ commerce.nit }}<br>
                            Tel. {{ commerce.phone }}<br>
                            <div v-if="invoice.bill">
                                Res. No. {{ invoice.bill.resolution.resolution }} del {{ invoice.bill.resolution.date }}<br>
                                Factura Serie {{ invoice.bill.resolution.serie }} De {{ invoice.bill.resolution.from }} al {{ invoice.bill.resolution.to }}<br>
                            </div>
                        </address>
                        <hr>
                        <address class="text-center">
                            <div v-if="invoice.bill">
                                Factura <br>
                                Serie <strong> {{ invoice.bill.resolution.serie }}</strong>
                                No. <strong id="bill_number"> {{ invoice.bill.bill }}</strong><br>
                                <strong> {{ invoice.created_at }}</strong>
                            </div>
                            <div v-if="!invoice.bill">
                                Recibo
                                No. <strong id="bill_number"> {{ invoice.id }}</strong><br>
                                <strong> {{ invoice.created_at }}</strong>
                            </div>
                        </address>
                        <address>
                            <strong>Nombre:</strong> {{  people.name }}<br>
                            <strong>Dirección:</strong> {{ people.address }}<br>
                            <strong>Nit:</strong> {{ people.nit }}<br>
                        </address>
                        <table v-if="invoice.details" class="table table-condensed">
                            <tr>
                                <td colspan="2" class="text-left">Descripción</td>
                                <td class="text-right" v-if="payment_method.card > 0">P/U</td>
                                <td class="text-right" v-else>P/O</td>
                                <td class="text-right">Total</td>
                            </tr>
                            <tr v-for="detail in invoice.details" :key="detail.id">
                                <td class="col-xs-2">
                                    <a v-if="invoice.status != 'Ingresado'" href="#" @click="detailDelete(detail)"><i class="text-danger fa fa-minus-circle"></i></a>
                                    {{ detail.lot }}
                                </td>
                                <td>{{ detail.product.name }} ({{ detail.product.make.name }})</td>
                                <td class="text-right" v-if="payment_method.card > 0">{{ detail.sale_price.toFixed(2) }}</td>
                                <td class="text-right" v-else  >{{ detail.offer_price.toFixed(2) }}</td>
                                <td class="text-right" v-if="payment_method.card > 0">{{ detail.total_purchase.toFixed(2) }}</td>
                                <td class="text-right" v-else>{{ detail.total_offer_purchase}}</td>
                            </tr>
                            <tr v-if="invoice.gift_cards" v-for="card in invoice.gift_cards" :key="card.id">
                                <td class="col-xs-2">
                                    <a v-if="invoice.status != 'Ingresado'" href="#" @click="removeGiftCard(card.id)" ><i class="text-danger fa fa-minus-circle"></i></a>
                                    1
                                </td>
                                <td>Tajeta de regalo</td>
                                <td class="text-right">{{ card.value }}</td>
                                <td class="text-right">{{ card.value }}</td>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-right">Total</th>
                                <th class="text-right" v-if="payment_method.card > 0"><strong>{{ parseFloat(invoice.total).toFixed(2) }}</strong></th>
                                <th class="text-right" v-else><strong>{{ parseFloat(invoice.total_offer).toFixed(2) }}</strong></th>
                            </tr>
                        </table>
                        <span v-if="invoice.user"><small>Usuario: {{ invoice.user.name }}</small> </span>
                    </div>
                    <div class="panel-footer" v-if="invoice.details">
                        <a v-if="invoice.status != 'Ingresado' && (invoice.details.length > 0 || invoice.gift_cards.length > 0)" href="#" @click="show_payment = true" id="Bill" class="btn btn-success  btn-block" style="margin-top: 10px">Finalizar Venta</a>
                        <a v-if="invoice.status == 'Ingresado'" href="#" class="btn btn-primary hidden-print  btn-block " title="Imprimir" onclick="window.print()"><span class="fa  fa-print"></span> Imprimir</a>
                    </div>
                </div>
            </div>
        </div>
        <modal v-if="show_form_people"  title="Cliente"  size="modal-md">
            <div class="form" role="form">
                <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" v-focus="nit_focus" @focus="nit_focus = true"  @blur="nit_focus = false" class="form-control" v-model="people.nit" id="multimedia_name" placeholder="nit" v-on:keyup.enter.prevent="searchPeople()">
                            <p v-if="errors.nit" class="text-danger">{{ errors.nit[0] }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" v-model="people.name" id="multimedia_name" placeholder="Nombre">
                            <p v-if="errors.name" class="text-danger">{{ errors.name[0] }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                            <textarea type="text" class="form-control" v-model="people.address" id="multimedia_name" cols="2" placeholder="Dirección"></textarea>
                            <p v-if="errors.address" class="text-danger">{{ errors.address[0] }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                            <input type="email" class="form-control" v-model="people.email" id="multimedia_email" placeholder="Correo">
                            <p v-if="errors.email" class="text-danger">{{ errors.email[0] }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" v-model="people.phone" id="multimedia_phone" placeholder="Teléfono">
                            <p v-if="errors.phone" class="text-danger">{{ errors.phone[0] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <a href="/" slot="btnCancel" type="button" class="btn btn-link">Cancelar</a>
            <button v-if="people.id != null || (people.name != null && people.address != null)" slot="btnSave" type="button" class="btn btn-success" @click="getPeople">Siguiente</button>
        </modal>

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
        <modal v-if="show_delete_detail"  title="Alerta"  size="modal-sm">
            <p>{{ detail.product.name}}</p>
            <p>¿Estas seguro de eliminarlo?</p>
            <button slot="btnCancel" type="button" class="btn btn-link" @click="cancelDeleteDetail">Cancelar</button>
            <button slot="btnSave" type="button" class="btn btn-danger" @click="destroyDetail">Si, eliminar</button>
        </modal>
        <modal v-if="show_form_detail"  title="Agregar Producto"  size="modal-sm">
            <div class="form" role="form">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <p v-if="errors.product_id" class="text-danger">{{ errors.product_id[0] }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label" for="date01">Precio</label>
                            <div class="input-group">
                                <span class="input-group-addon">Q.</span>
                                <input type="text" class="form-control" v-model="product.price" disabled>
                            </div>
                            <p v-if="errors.price" class="text-danger">{{ errors.price[0] }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label" for="date01">Oferta</label>
                            <div class="input-group">
                                <span class="input-group-addon">Q.</span>
                                <input type="text" class="form-control" v-model="product.offer_price" disabled >
                            </div>
                            <p v-if="errors.offer_price" class="text-danger">{{ errors.offer_price[0] }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label" for="date01">Cantidad</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-asterisk"></span></span>
                                <input type="text"  class="form-control" v-model="lot" >
                            </div>
                            <p v-if="errors.lot" class="text-danger">{{ errors.lot[0] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <button  slot="btnCancel" type="button" class="btn btn-default" @click="show_form_detail = !show_form_detail">Cancelar</button>
            <button v-if="showAddDetailButton" slot="btnSave" type="button" class="btn btn-success" @click="storeDetail">Agregar <span class="fa fa-shopping-cart"></span></button>
        </modal>
        <modal v-if="show_payment" title="Finalizar" size="modal-md">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Número de Factura</span>
                    <input type="text"  v-model="bill_number" class="form-control">
                </div>
                <p class="text-danger" v-if="errors.bill_number"> {{ errors.bill_number[0]}}</p>
            </div>
            <table class="table table-striped table-condenced">
                <thead>
                    <tr class="active">
                        <th class="text-right">
                            Método de Pago
                        </th>
                        <th class="text-right" style="width:100px !important">Cantidad</th>
                        <th class="text-right" style="width:150px !important">Documento</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="text-right">Efectivo Q.</th>
                        <td><input type="text" class="form-control input-sm text-right" v-model="payment_method.cash" placeholder="0"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th class="text-right">
                            Tarjeta Q.
                            <p class="text-danger" v-if="errors.card_voucher">{{ errors.card_voucher[0]}}</p>
                        </th>
                        <td><input type="text" class="form-control input-sm text-right" v-model="payment_method.card" placeholder="0"></td>
                        <td><input type="text" class="form-control input-sm" v-model="payment_method.card_voucher" placeholder="0"></td>
                    </tr>
                    <tr>
                        <th class="text-right">
                            Cheque Q.
                            <p class="text-danger" v-if="errors.check_voucher">{{ errors.check_voucher[0]}}</p>
                        </th>
                        <td><input type="text" class="form-control input-sm text-right" v-model="payment_method.check" placeholder="0"></td>
                        <td><input type="text" class="form-control input-sm" v-model="payment_method.check_voucher" placeholder="0"></td>
                    </tr>
                    <tr>
                        <th class="text-right">
                            Credito Q.
                            <p class="text-danger" v-if="errors.credit">{{errors.credit[0]}}</p>
                        </th>
                        <td>
                            <input :readonly="people.rest_credit == 0" type="text" class="form-control input-sm text-right" v-model="payment_method.credit" placeholder="0">
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th class="text-right">
                            Gift Card Q.
                            <p class="text-danger" v-if="errors.gift_card_code">{{errors.gift_card_code[0]}}</p>
                            <p class="text-danger" v-if="errors.gift_card">{{errors.gift_card[0]}}</p>
                        </th>
                        <td><input type="text" class="form-control input-sm text-right" v-model="payment_method.gift_card" placeholder="0"></td>
                        <td><input type="text" class="form-control input-sm" v-model="payment_method.gift_card_code" placeholder="Código"></td>
                    </tr>
                    <tr :class="{ 'success': totalsMatch, 'danger': !totalsMatch,}">
                        <th class="text-right">Total Pagos Q.</th>
                        <th class="text-right">{{payment_method.total_payments.toFixed(2)}}</th>
                        <td></td>
                    </tr>
                    <tr class="success">
                        <th class="text-right">Total Q.</th>
                        <th class="text-right" v-if="payment_method.card > 0">{{ invoice.total }}</th>
                        <th class="text-right" v-else>{{ invoice.total_offer }}</th>
                        <td><p class="text-danger"></p></td>
                    </tr>
                </tbody>
            </table>
            <button @click="show_payment = false" slot="btnCancel" type="button" class="btn btn-link">Cancelar</button>
            <button @click="finalInvoice" slot="btnSave" :disabled="!totalsMatch" type="button" class="btn btn-success"><i class="fa fa-dot-circle-o"></i> Facturar</button>
        </modal>

        <modal v-if="show_revert"  title="¿Estas seguro de revertir esta venta?"  size="modal-sm">
            <button slot="btnCancel" type="button" @click="show_revert = false" class="btn btn-link">Cancelar</button>
            <button  slot="btnSave" type="button" class="btn btn-danger" @click="revert">Si, Revertir</button>
        </modal>
        <modal v-if="show_destroy"  title="¿Estas seguro de Eliminar esta venta?"  size="modal-sm">
            <h4 v-if="errors.on_destroy"  class="text-danger">UPSS!!! Error al intentar Eliminar</h4>
            <ul>
                <li v-if="errors.on_destroy" v-for="(error, index) in errors.on_destroy" :key="index">{{ error }}</li>
            </ul>
            <button slot="btnCancel" type="button" @click="show_destroy = false" class="btn btn-link">Cancelar</button>
            <button  slot="btnSave" type="button" class="btn btn-danger" @click="destroy">Si, Eliminar</button>
        </modal>
    </div>
</template>
<script>

import People from '../models/People';
import Invoice from '../models/Invoice';
import InvoiceDetail from '../models/InvoiceDetail';
import InvoicePayment from '../models/InvoicePayment';
import InvoiceRevert from '../models/InvoiceRevert';
import CashRegister from '../models/CashRegister';
import Commerce from '../models/Commerce';
import Stock from '../models/Stock';
import { focus } from 'vue-focus';
export default {
    directives: { focus: focus },
    props:['invoice_id'],
    data() {
        return{
            show_revert : false,
            show_destroy : false,
            nit_focus: false,
            barcode_focus: false,
            show_payment:false,
            show_product_search: true,
            cash_register:{},
            show_form_people:false,
            show_delete_detail:false,
            show_form_detail:false,
            create_cash_register:false,
            people:{},
            invoice:{},
            errors:{},
            commerce:{},
            filter:{},
            stock:[],
            product:{},
            lot:1,
            showAddDetailButton: true,
            detail:{},
            gift_cards:[],
            gift_card_id:'',
            payment_method:{
                total_payments:0,
                cash:0,
                card:0,
                credit:0,
                gift_card:0,
                check:0
            },
            bill_number:''
        }
    },
    created(){
        this.LoadCommerce();
        if (this.invoice_id == '') {
            this.getCashRegister();
        }else{
            this.loadInvoice();
        }
    },
    computed: {
        nit() {
            return this.people.nit;
        },
        totalsMatch(){
            if (this.payment_method.card > 0) {
                return this.invoice.total == this.payment_method.total_payments;
            }

            return this.invoice.total_offer == this.payment_method.total_payments;
        },
    },
    methods:{
        loadInvoice(){
            Invoice.show(this.invoice_id, {}, data => { this.invoice = data.data});
        },
        revert(){
            let params = {
            };

            InvoiceRevert.update(this.invoice.id, params, data => {
                this.$toastr.w("Venta Revertida");
                this.invoice = data.data;
                this.show_revert = false;
                this.errors = [];
            }, errors => this.errors = errors);
        },
        destroy(){
            Invoice.destroy(this.invoice.id,{}, data => {
                window.location.href = '/';
            }, errors => this.errors = errors);
        },
        finalInvoice(){
            let params = {
                bill_number : this.bill_number ? this.bill_number :'',
                cash: this.payment_method.cash,
                card: this.payment_method.card,
                card_voucher: this.payment_method.card_voucher ? this.payment_method.card_voucher:'',
                check: this.payment_method.check,
                check_voucher: this.payment_method.check_voucher ? this.payment_method.check_voucher:'',
                credit: this.payment_method.credit,
                gift_card: this.payment_method.gift_card,
                gift_card_code: this.payment_method.gift_card_code ? this.payment_method.gift_card_code:'',
            };

            InvoicePayment.update(this.invoice.id, params, data => {
                this.$toastr.s("Venta Finalizada");
                this.invoice = data.data;
                this.show_payment = false;
                this.errors = [];
            }, errors => this.errors = errors);
        },
        addGiftCard(){
            let params = {
                gift_card_id: this.gift_card_id
            };

            Invoice.storeGiftCard(this.invoice.id, params, data => {
                this.$toastr.s("Gift Card agregada.");
                this.invoice = data.data;
                this.errors = {};
            }, errors => this.errors = errors);
        },
        removeGiftCard(card_id){
            let params = {
                gift_card_id: card_id
            };

            Invoice.removeGiftCard(this.invoice.id, params, data => {
                this.$toastr.s("Gift Card retirado.");
                this.invoice = data.data;
                this.errors = {};
            }, errors => this.errors = errors);
        },
        cancelDeleteDetail(){
            this.detail = {};
            this.show_delete_detail = false;
        },
        detailDelete(detail){
            this.detail = detail;
            this.show_delete_detail = true;
        },
        destroyDetail(){
            InvoiceDetail.destroy(this.detail.id, data => {
                this.invoice = data.data;
                this.$toastr.s("Eliminado exitosamente.");
                this.detail = {};
                this.show_delete_detail = false;
            });
        },
        addDetail(product){
            this.show_form_detail = true;
            this.product = product;
        },
        storeDetail(){
            let params = {
                product_id: this.product.id,
                price: this.product.price,
                offer_price: this.product.offer_price,
                lot: this.lot,
                invoice_id : this.invoice.id
            };

            InvoiceDetail.store(params, data => {
                this.$toastr.s("Producto Agregado");
                this.invoice = data.data;
                this.product = {};
                this.errors = {};
                this.lot = 1;
                this.stock = [];
                this.filter = [];
                this.show_form_detail = false;
            }, errors => this.errors = errors);
        },
        loadStock(){
            let params = {
                barcode: this.filter.barcode ? this.filter.barcode:'',
                id: this.filter.id ? this.filter.id:'',
                name: this.filter.name ? this.filter.name:'',
            };
            Stock.get(params, data => { this.stock = data.data});
        },
        LoadCommerce(){
            Commerce.show(1,{}, data => { this.commerce = data.data});
        },
        searchPeople(){
            let params = {
                nit: this.people.nit,
            };
            People.get(params, data => {
                if (data.data.length > 0) {
                    this.people = _.first(data.data);
                    this.errors = [];
                }else{
                    this.people = { nit:params.nit }
                    this.errors = {
                        nit:['Este cliente no existe'],
                        name:['El campo nombre es obligatorio'],
                        address:['El campo dirección es obligatorio'],
                    };
                }
            });
        },
        getPeople(){
                let formData = new FormData();
                formData.append('nit', this.people.nit ? this.people.nit : '');
                formData.append('name', this.people.name ? this.people.name : '');
                formData.append('address', this.people.address ? this.people.address : '');
                formData.append('phone', this.people.phone ? this.people.phone : '');
                formData.append('email', this.people.email ? this.people.email : '');

                People.store(formData, data => {
                    this.people = data.data;
                    this.errors = {};
                    this.createInvoice();
                    this.show_form_people = false;
                    this.nit_focus = true;
                    this.barcode_focus = true;
                }, errors => this.errors = errors);

        },
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
                this.show_form_people = true;
            }, errors => this.errors = errors);
        },
        createInvoice(){
            let params = {
                people_id: this.people.id,
                cash_register_id: this.cash_register.id
            };

            Invoice.store(params, data => {
                this.invoice = data.data;
                this.errors = {};
            }, errors => this.errors = errors);
        },
        paymentTotal(){
            this.payment_method.total_payments = parseFloat(this.payment_method.cash) + parseFloat(this.payment_method.card) + parseFloat(this.payment_method.credit) + parseFloat(this.payment_method.check) + parseFloat(this.payment_method.gift_card);
        }
    },
    watch:{
        nit(){
            if (this.people.nit == '') {
                this.people = {}
            }
        },
        lot(){
            if ( this.lot > this.product.stock) {
                this.errors = { lot:['Cantidad excede el inventario']};
                this.showAddDetailButton = false
            }
            else if ( this.lot < 1) {
                this.errors = { lot:['favor agregue una cantidad']};
                this.showAddDetailButton = false
            }
            else if ( this.lot == '') {
                this.errors = { lot:['favor agregue una cantidad']};
                this.showAddDetailButton = false
            }
            else{
                this.errors= {};
                this.showAddDetailButton = true;
            }
        },
        'invoice.total':function(){
            this.payment_method.cash = this.invoice.total_offer;

            if (this.payment_method.card > 0) {
                this.payment_method.cash = this.invoice.total;
            }
        },
        'payment_method.cash':function(){
            this.paymentTotal();
        },
        'payment_method.card':function(){
            this.paymentTotal();
        },
        'payment_method.credit':function(){
            this.paymentTotal();
        },
        'payment_method.check':function(){
            this.paymentTotal();
        },
        'payment_method.gift_card':function(){
            this.paymentTotal();
        },

    },
}
</script>
<style>
</style>