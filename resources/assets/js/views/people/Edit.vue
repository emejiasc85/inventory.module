<template>
    <div>
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        <i class="fa fa-plus"></i>
                        <small>Formulario de edición de Personas</small>
                    </h2>
                </div>
                <div class="panel-body">
                    <div class="form">
                        <fieldset>
                            <legend>Datos de facturación</legend>
                            <div class="col-xs-12">
                                <div class="form-group">
                                        <label class="radio-inline" for="inline-radio1">
                                            <input type="radio"  v-model="edit.type"  value="customer">Cliente
                                        </label>
                                        <label class="radio-inline" for="inline-radio2">
                                            <input type="radio"  v-model="edit.type" value="provider">Proveedor
                                        </label>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-4" >
                                <div class="form-group">
                                    <label class="control-label">Nit</label>
                                    <input type="text" v-model="edit.nit" class="form-control">
                                    <p class="text-danger" v-if="errors.nit">{{ errors.nit[0]}}</p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-8" >
                                <div class="form-group">
                                    <label class="control-label">Nombre</label>
                                    <input type="text" v-model="edit.name" class="form-control">
                                    <p class="text-danger" v-if="errors.name">{{ errors.name[0]}}</p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-12" >
                                <div class="form-group">
                                    <label class="control-label">Dirección</label>
                                    <textarea class="form-control"  v-model="edit.address" rows="2"></textarea>
                                    <p class="text-danger" v-if="errors.address">{{ errors.address[0]}}</p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-2" >
                                <div class="form-group">
                                    <label class="control-label">Crédito maximo</label>
                                    <input type="text" v-model="edit.max_credit" class="form-control">
                                    <p class="text-danger" v-if="errors.max_credit">{{ errors.max_credit[0]}}</p>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Datos personales</legend>
                            <div class="col-xs-12 col-md-6 col-lg-4" >
                                <div class="form-group">
                                    <label class="control-label">email</label>
                                    <input type="email" v-model="edit.email" class="form-control">
                                    <p class="text-danger" v-if="errors.email">{{ errors.email[0]}}</p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-4" >
                                <div class="form-group">
                                    <label class="control-label">Teléfono</label>
                                    <input type="text" v-model="edit.phone" class="form-control">
                                    <p class="text-danger" v-if="errors.phone">{{ errors.phone[0]}}</p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-4" >
                                <div class="form-group">
                                    <label class="control-label">otro Teléfono</label>
                                    <input type="text" v-model="edit.other_phone" class="form-control">
                                    <p class="text-danger" v-if="errors.other_phone">{{ errors.phone[0]}}</p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-4" >
                                <div class="form-group">
                                    <label class="control-label">Cumpleaños</label>
                                    <input type="date" v-model="edit.birthday" class="form-control">
                                    <p class="text-danger" v-if="errors.birthday">{{ errors.birthday[0]}}</p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-4" >
                                <div class="form-group">
                                        <label class="control-label"></label><br>

			                            <label class="radio-inline" for="inline-radio1">
			                                <input type="radio" v-model="edit.gender"   value="m">Hombre
			                            </label>
			                            <label class="radio-inline" for="inline-radio2">
			                                <input type="radio" v-model="edit.gender"  value="f">Mujer
			                            </label>
			                    </div>
                            </div>

                        </fieldset>
                        <fieldset>
                            <legend>Redes sociales</legend>
                            <div class="col-xs-12 col-md-6 col-lg-4" >
                                <div class="form-group">
                                    <label class="control-label">Facebook </label>
                                    <input type="text" v-model="edit.facebook" class="form-control">
                                    <p class="text-danger" v-if="errors.facebook">{{ errors.facebook[0]}}</p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-4" >
                                <div class="form-group">
                                    <label class="control-label">Instagram </label>
                                    <input type="text" v-model="edit.instagram" class="form-control">
                                    <p class="text-danger" v-if="errors.instagram">{{ errors.instagram[0]}}</p>
                                </div>
                            </div>

                        </fieldset>
                    </div>
                </div>
                <div class="panel-footer">
                    <button @click="end" type="button" class="btn btn-link"> Salir</button>
                    <button @click="update" type="button" :disabled="updateButton" class="btn btn-success"><i class="fa fa-save"></i> Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import People from '../../models/People';
    export default {
        props:['people_id'],
        data(){
            return {
                updateButton:false,
                edit:{},
                errors:[],
            }
        },
        created(){
            this.show();
        },
        methods:{
           show(){
               People.show(this.people_id, data => {
                   this.edit = data.data;
               });
           },
            update(){
                this.updateButton  = true;
                People.update(this.people_id, this.edit, data => {
                    this.errors=[];
                    this.show();
                    this.$toastr.s("Persona editada");
                    this.updateButton  = false;
                }, errors => {
                    this.errors = errors;
                    this.updateButton  = false;
                });
            },
            end(){
                this.$emit('end');
            },

        }
    }
</script>
