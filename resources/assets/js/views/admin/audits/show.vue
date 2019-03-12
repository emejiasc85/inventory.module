<template>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default " style="border-top: 2px solid #20a8d8">
                <div class="panel-heading text-right">
                    Ocultar Validados
                    <label class="switch switch-primary">
                        <input type="checkbox" class="switch-input" v-model="hidden_trues">
                        <span class="switch-label" data-on="si" data-off="no"></span>
                        <span class="switch-handle"></span>
                    </label>
                </div>
                <div class="panel-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center"><span class="fa fa-check-square-o"></span> Auditoría</th>
                                <th><span class="fa fa-calendar"></span> Fecha</th>
                                <th><span class="fa fa-user"></span> Auditor</th>
                                <th class="text-center"><span class="fa fa-cubes"></span> Productos</th>
                                <th class="text-center"><span class="fa fa-circle"></span> Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">{{ audit.id}}</td>
                                <td>{{ audit.created_at }}</td>
                                <td>{{ audit.user ? audit.user.name :'' }}</td>
                                <td class="text-center">{{ audit.total_details }}</td>
                                <td class="text-center">{{ audit.status }}</td>
                                <td class="text-right">
                                    <button @click="show_close = true" type="button" v-if="audit.open" class="btn  btn-primary"><span class="fa fa-check"></span> Finalizar</button>
                                    <button @click="show_undo = true" type="button" v-if="audit.close" class="btn  btn-success"><span class="fa fa-undo"></span> Revertir</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="panel panel-default" style="border-top: 2px solid #20a8d8">
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th v-if="audit.open"></th>
                                <th class="text-center">Estado</th>
                                <th>ID</th>
                                <th>Producto</th>
                                <th>Marca</th>
                                <th>Grupo</th>
                                <th>Serie</th>
                                <th class="text-center">Medida</th>
                                <th>Presentación</th>
                                <th class="text-center">Existencia</th>
                                <th class="text-center">Auditoria</th>
                                <th class="text-right"></th>
                            </tr>
                        </thead>
                        <tbody v-if="audit.has_details">
                            <template  v-for="detail in audit.details">
                                <tr   v-if="!detail.status || !hidden_trues" :key="detail.id" >
                                    <td v-tooltip="'Eliminar'" v-if="audit.open">
                                        <button @click="deleteDetail(detail)" type="button" class="btn btn-danger btn-xs"><i class="fa fa-minus-circle"></i></button>
                                    </td>
                                    <td class="text-center">
                                        <i v-if="detail.status" class="text-success fa fa-check-circle fa-2x" aria-hidden="true"></i>
                                        <i v-else class="text-danger fa fa-times-circle fa-2x" aria-hidden="true"></i>
                                    </td>
                                    <td>{{ detail.product.id }}</td>
                                    <td>{{ detail.product.name }}</td>
                                    <td>{{ detail.product.make? detail.product.make.name:'' }}</td>
                                    <td>{{ detail.product.group? detail.product.group.name:'' }}</td>
                                    <td>{{ detail.product.serie ? detail.product.serie.name:'' }}</td>
                                    <td class="text-center">{{ detail.product.unit ? detail.product.unit.name:'' }}</td>
                                    <td>{{ detail.product.presentation ? detail.product.presentation.name:'' }}</td>
                                    <td class="text-center">{{ detail.current_stock }}</td>
                                    <td class="text-center">{{ detail.audited_stock }}</td>
                                    <td class="text-right ">
                                        <button v-if="audit.open" v-tooltip="'Validar'" @click="passAudit(detail)" type="button" class="btn btn-primary btn-sm"><i class="fa fa-check-square-o"></i></button>
                                        <button v-if="audit.open" v-tooltip="'Rechazar'" @click="editDetail(detail)" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-lg-4 col-lg-offset-8 col-sm-5 col-sm-offset-4 recap">
                            <!-- <table class="table table-clear">
                                <tbody>
                                    <tr>
                                        <td class="left"><strong>Costo Total</strong></td>
                                        <td class="right"><strong>Q. {{ audit.total }}</strong></td>
                                    </tr>
                                </tbody>
                            </table> -->

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <modal v-if="show_delete_detail"  title="Alerta"  size="modal-sm">
            <p>¿Estas seguro de eliminarlo?</p>
            <button slot="btnCancel" type="button" class="btn btn-link" @click="show_delete_detail = false">Cancelar</button>
            <button slot="btnSave"  type="button" class="btn btn-danger" @click="destroyDetail">Si, Eliminar</button>
        </modal>

        <modal v-if="show_reject_detail"  title="¿Cantidad Encontrada?"  size="modal-sm">
            <div class="form-group">
                <input type="number" class="form-control" v-model="detail.audited_stock">
            </div>

            <button slot="btnCancel" type="button" class="btn btn-link" @click="show_reject_detail = false">Cancelar</button>
            <button slot="btnSave" type="button" class="btn btn-primary" @click="rejectAudit">Registrar</button>
        </modal>

        <modal v-if="show_close"  title="¿Estas Seguro?"  size="modal-sm">
            <button slot="btnCancel" type="button" @click="show_close = false" class="btn btn-link">Cancelar</button>
            <button slot="btnSave" type="button" class="btn btn-primary" @click="close">Si, Finalizar</button>
        </modal>

        <modal v-if="show_undo"  title="¿Estas Seguro?"  size="modal-sm">
            <button slot="btnCancel" type="button" @click="show_undo = false" class="btn btn-link">Cancelar</button>
            <button slot="btnSave" type="button" class="btn btn-success" @click="undo">Si, Revertir</button>
        </modal>

    </div>
</template>
<script>

import Commerce from '../../../models/Commerce';
import User from '../../../models/admin/User';
import Audit from '../../../models/admin/Audit';
import AuditDetail from '../../../models/admin/AuditDetail';
import Stock from '../../../models/Stock';

export default {
    props:['audit_id'],

    data() {
        return{
            show_close:false,
            show_undo:false,
            loading : false,
            show_user_form:false,
            show_destroy : false,
            show_delete_detail:false,
            hidden_trues: true,
            show_reject_detail: false,

            detail:{},
            commerce:{},
            audit:{},
            errors:{},
        }
    },
    created(){
        this.LoadCommerce();
        this.storeAudit();
    },
    methods:{
        LoadCommerce(){
            Commerce.show(1, {}, data => { this.commerce = data.data});
        },
        loadAudit(){
            Audit.show(this.audit_id, data => {
                this.audit = data.data;
                this.$toastr.removeByType("info");
            });
        },
        index(){
            let id = this.audit ? this.audit.id : this.audit_id;
            Audit.show(id, data => {
                this.audit = data.data;
            });
        },

        storeAudit(){
            this.$toastr.i("Cargando Auditoría...");
            if (!this.audit_id) {

                Audit.store({}, data => {
                    this.audit = data.data;
                    this.errors = {};
                    this.$toastr.removeByType("info");
                    this.$toastr.s("Auditoría Creada con exito");
                }, errors => this.errors = errors);

            }else{
                this.loadAudit();
            }
        },
        passAudit(detail){
            this.$toastr.i("Validando...");
            let params = {
                status: 'ok',
                audited_stock : detail.current_stock
            };

            AuditDetail.update(detail.id, params, data => {
                this.index();
                this.$toastr.removeByType("info");
                this.$toastr.s("Producto "+detail.product.id+" Validado");

            }, errors => this.errors = errors);

        },
        editDetail(detail){
            this.show_reject_detail = true;
            this.detail = _.cloneDeep(detail);
        },
        deleteDetail(detail){
            this.show_delete_detail = true;
            this.detail = _.cloneDeep(detail);
        },
        rejectAudit(){
            this.$toastr.i("Validando");
            let params = {
                status: 'bad',
                audited_stock : this.detail.audited_stock
            };

            AuditDetail.update(this.detail.id, params, data => {
                this.show_reject_detail = false;
                this.index();
                this.$toastr.removeByType("info");
                this.$toastr.s("Producto "+this.detail.product.id+" Rechazado");
            }, errors => this.errors = errors);

        },
        destroyDetail(){
            AuditDetail.destroy(this.detail.id, data => {
                this.show_delete_detail = false;
                this.index();
                this.$toastr.s("Producto "+this.detail.product.id+" Eliminado");
            }, errors => this.errors = errors);
        },
        close(){
            this.$toastr.i("Finalizando.");

            Audit.update(this.audit.id, {status:'Finalizado'}, data => {
                this.audit = data.data;
                this.errors = {};
                this.show_close = false;
                this.$toastr.removeByType("info");
                this.$toastr.s("Finalizado.");

            }, errors => this.errors = errors);
        },
        undo(){
            this.$toastr.i("Enviando petición.");

             Audit.update(this.audit.id, {status:'Creado'}, data => {
                this.audit = data.data;
                this.errors = {};
                this.show_undo = false;
                this.$toastr.removeByType("info");
                this.$toastr.s("Auditoría revertida.");
            }, errors => this.errors = errors);
        },
    },
}
</script>
<style>
</style>