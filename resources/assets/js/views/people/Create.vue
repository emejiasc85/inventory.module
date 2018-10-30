<template>
    <div>
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        <i class="fa fa-plus"></i>
                        <small>Formulario de creación de Personas</small>
                    </h2>
                </div>
                <div class="panel-body">
                    <div class="form">
                        <fieldset>
                            <legend>Datos de facturación</legend>
                            <div class="col-xs-12">
                                <div class="form-group">
                                        <label class="radio-inline" for="inline-radio1">
                                            <input type="radio"  v-model="create.type"  value="customer">Cliente
                                        </label>
                                        <label class="radio-inline" for="inline-radio2">
                                            <input type="radio"  v-model="create.type" value="provider">Proveedor
                                        </label>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-4" >
                                <div class="form-group">
                                    <label class="control-label">Nit</label>
                                    <input type="text" v-model="create.nit" class="form-control">
                                    <p class="text-danger" v-if="errors.nit">{{ errors.nit[0]}}</p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-8" >
                                <div class="form-group">
                                    <label class="control-label">Nombre</label>
                                    <input type="text" v-model="create.name" class="form-control">
                                    <p class="text-danger" v-if="errors.name">{{ errors.name[0]}}</p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-12" >
                                <div class="form-group">
                                    <label class="control-label">Dirección</label>
                                    <textarea class="form-control"  v-model="create.address" rows="2"></textarea>
                                    <p class="text-danger" v-if="errors.address">{{ errors.address[0]}}</p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-2" >
                                <div class="form-group">
                                    <label class="control-label">Crédito maximo</label>
                                    <input type="text" v-model="create.max_credit" class="form-control">
                                    <p class="text-danger" v-if="errors.max_credit">{{ errors.max_credit[0]}}</p>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Datos personales</legend>
                            <div class="col-xs-12 col-md-6 col-lg-4" >
                                <div class="form-group">
                                    <label class="control-label">email</label>
                                    <input type="email" v-model="create.email" class="form-control">
                                    <p class="text-danger" v-if="errors.email">{{ errors.email[0]}}</p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-4" >
                                <div class="form-group">
                                    <label class="control-label">Teléfono</label>
                                    <input type="text" v-model="create.phone" class="form-control">
                                    <p class="text-danger" v-if="errors.phone">{{ errors.phone[0]}}</p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-4" >
                                <div class="form-group">
                                    <label class="control-label">otro Teléfono</label>
                                    <input type="text" v-model="create.other_phone" class="form-control">
                                    <p class="text-danger" v-if="errors.other_phone">{{ errors.phone[0]}}</p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-4" >
                                <div class="form-group">
                                    <label class="control-label">Cumpleaños</label>
                                    <input type="date" v-model="create.birthday" class="form-control">
                                    <p class="text-danger" v-if="errors.birthday">{{ errors.birthday[0]}}</p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-4" >
                                <div class="form-group">
                                        <label class="control-label"></label><br>

			                            <label class="radio-inline" for="inline-radio1">
			                                <input type="radio" v-model="create.gender"   value="m">Hombre
			                            </label>
			                            <label class="radio-inline" for="inline-radio2">
			                                <input type="radio" v-model="create.gender"  value="f">Mujer
			                            </label>
			                    </div>
                            </div>

                        </fieldset>
                        <fieldset>
                            <legend>Redes sociales</legend>
                            <div class="col-xs-12 col-md-6 col-lg-4" >
                                <div class="form-group">
                                    <label class="control-label">Facebook </label>
                                    <input type="text" v-model="create.facebook" class="form-control">
                                    <p class="text-danger" v-if="errors.facebook">{{ errors.facebook[0]}}</p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-4" >
                                <div class="form-group">
                                    <label class="control-label">Instagram </label>
                                    <input type="text" v-model="create.instagram" class="form-control">
                                    <p class="text-danger" v-if="errors.instagram">{{ errors.instagram[0]}}</p>
                                </div>
                            </div>

                        </fieldset>
                    </div>
                </div>
                <div class="panel-footer">
                    <button @click="end" type="button" class="btn btn-link"> Salir</button>
                    <button @click="store" type="button" :disabled="storeButton" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import People from '../../models/People';
    export default {
        data(){
            return {
                storeButton:false,
                create:{type:'customer', gender:'m'},
                errors:[],
            }
        },

        methods:{

            end(){
                this.$emit('end');
            },
            store(){
                this.storeButton  = true;
                People.store(this.create, data => {
                    this.errors=[];
                    this.create={type:'customer', gender:'m'};
                    this.$toastr.s("Persona Agregada");
                    this.storeButton  = false;
                }, errors => {
                    this.errors = errors;
                    this.storeButton  = false;
                });
            }
        }
    }
</script>
