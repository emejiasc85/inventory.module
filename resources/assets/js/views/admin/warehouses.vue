<template>
<div>
        <div class="panel panel-default">
            <div class="panel-heading hidden-print">
                <h2><i class="fa fa-database"></i><span class="break"></span>Bodegas</h2>
                <div class="pull-right">
                    <button @click="show_add = true" class="btn btn-success btn-sm" v-tooltip="'Agregar bodega'" >
                        <i class="fa fa-plus" style="color:white !important"></i>
                    </button>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Bodega</th>
                                <th>Descripción</th>
                                <th>Comercio</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="warehouse in warehouses" :key="warehouse.id">
                                <td>{{ warehouse.id}}</td>
                                <td>{{ warehouse.name}}</td>
                                <td>{{ warehouse.description}}</td>
                                <td>{{ warehouse.commerce.name}}</td>
                                <td>
                                    <span v-if="warehouse.status == 1" class="label label-success">Activa</span>
                                    <span v-else class="label label-default">Inactiva</span>
                                </td>
                                <td>
                                    <button @click="edit(warehouse)" v-tooltip="'Editar'" type="button" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <modal v-if="show_add"  title="Agregar Bodega"  size="modal-md">
            <form class="form" role="form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Nombre</label>
                            <input type="text" class="form-control" v-model="create.name">
                            <p v-if="errors.name" class="text-danger">{{ errors.name[0] }}</p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Descripción</label>
                            <input type="text" class="form-control" v-model="create.description">
                            <p v-if="errors.description" class="text-danger">{{ errors.description[0] }}</p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Comercio</label>
                            <v-select label="name" :options="commerces" v-model="create.commerce"></v-select>
                            <p v-if="errors.commerce_id" class="text-danger">{{ errors.commerce_id[0] }}</p>
                        </div>
                    </div>
                </div>
            </form>
            <button slot="btnCancel" type="button" @click="show_add = false " class="btn btn-link">Cancelar</button>
            <button  slot="btnSave" type="button" @click="store" class="btn btn-primary" >Agregar</button>
        </modal>
        <modal v-if="show_edit"  title="Editar Bodega"  size="modal-md">
            <form class="form" role="form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Nombre</label>
                            <input type="text" class="form-control" v-model="warehouse.name">
                            <p v-if="errors.name" class="text-danger">{{ errors.name[0] }}</p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Descripción</label>
                            <input type="text" class="form-control" v-model="warehouse.description">
                            <p v-if="errors.description" class="text-danger">{{ errors.description[0] }}</p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Comercio</label>
                            <v-select label="name" :options="commerces" v-model="warehouse.commerce"></v-select>
                            <p v-if="errors.commerce_id" class="text-danger">{{ errors.commerce_id[0] }}</p>
                        </div>
                    </div>
                </div>
            </form>
            <button slot="btnCancel" type="button" @click="show_edit = false " class="btn btn-link">Cancelar</button>
            <button  slot="btnSave" type="button" @click="update" class="btn btn-primary" >Guardar cambios</button>
        </modal>
    </div>
</template>

<script>
import Warehouse from '../../models/admin/Warehouse';
import Commerce from '../../models/Commerce';
import vSelect from 'vue-select';
export default {
    components: { vSelect},
    data(){
        return {
            show_add:false,
            show_edit:false,
            warehouses:[],
            warehouse:[],
            commerces:[],
            create:{},
            errors:[]
        }
    },
    created(){
        this.index();
        this.loadData();
    },
    methods:{
        loadData(){
            Commerce.get({}, data => {
                this.commerces = data.data;
            });
        },
        index(){
            Warehouse.get({}, data => {
                this.warehouses = data.data;
            });
        },

        store(){
            this.create.commerce ? (this.create.commerce_id = this.create.commerce.id) :'';

            Warehouse.store(this.create, data => {
                this.errors=[];
                this.index();
                this.$toastr.s("Bodega Agregada");
                this.show_add = false;
            }, errors => this.errors = errors);
        },
        edit(warehouse){
            this.warehouse = warehouse;
            this.show_edit = true;
        },
        update(){
            this.warehouse.commerce ? (this.warehouse.commerce_id = this.warehouse.commerce.id) :'';

            Warehouse.update(this.warehouse.id, this.warehouse, data => {
                this.errors=[];
                this.index();
                this.$toastr.s("Bodega Editada");
                this.show_edit = false;
            }, errors => this.errors = errors);
        },
    }
}
</script>
