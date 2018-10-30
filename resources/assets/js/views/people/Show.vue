<template>
    <div>
        <div class="row profile">

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <!-- <a href="" class="btn btn-link pull-right"><span class="fa fa-pencil text-success"></span></a> -->
                        <h2 class="text-center"><strong>{{ people.name }}</strong></h2>
                        <h4 class="text-center"><small><i class="fa fa-map-marker"></i> {{ people.address }}</small></h4>
                        <h4 class="text-center"><small><i class="fa fa-phone"></i> {{ people.phone }}</small></h4>
                        <hr>
                        <div class="row">
                            <div v-if="people.facebook != null" class="col-xs-6">
                                <a :href="'https://web.facebook.com/'+people.facebook" target="_black" style="margin-bottom: 4px" class="btn btn-sm btn-facebook btn-block" ><span>Facebook</span></a>
                            </div>
                            <div v-if="people.instagram != null" class="col-xs-6">
                                <a :href="'https://www.instagram.com/'+people.instagram" target="_black" style="margin-bottom: 4px" class="btn btn-sm btn-instagram btn-block"><span>Instagram</span></a>
                            </div>
                        </div>
                        <hr>


                    <!--   <div class="row text-center">
                            <div class="col-xs-4">
                                <div><strong>{{ people.bill.lenght }}</strong></div>
                                <div><small>Compras</small></div>
                            </div>
                            <div class="col-xs-4">

                                <div><strong>{{ people.lot }}</strong></div>
                                <div><small>Productos</small></div>
                            </div>
                            <div class="col-xs-4">
                                <div><strong>Q. {{ people.bills.total }}</strong></div>
                                <div><small>Total</small></div>
                            </div>
                        </div>
                        <hr>
                        -->
                        <!--
                        <h4><strong>About Karen Boyle</strong></h4>

                        <p>
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
                        </p>

                        <hr>

                        -->

                        <h4><strong>Información General</strong></h4>

                        <ul class="profile-details">
                            <li>
                                <div><i class="fa fa-briefcase"></i> Sexo</div>
                                {{ people.gender == 'm' ? 'Hombre':'Mujer'}}
                            </li>
                            <li>
                                <div><i class="fa fa-building-o"></i> Cumpleaños</div>
                                {{ people.birthday }}
                            </li>
                        </ul>
                        <hr>
                        <h4><strong>Información de Contacto</strong></h4>

                        <ul class="profile-details">
                            <li>
                                <div><i class="fa fa-tablet"></i> Celular</div>
                                {{ people.phone }}
                            </li>
                            <li>
                                <div><i class="fa fa-phone"></i> Teléfono</div>
                                {{ people.other_phone }}
                            </li>
                            <li>
                                <div><i class="fa fa-envelope"></i> Email</div>
                                {{ people.email }}
                            </li>
                            <li>
                                <div><i class="fa fa-map-marker"></i> Dirección</div>
                                {{ people.address }}
                            </li>
                            <li>
                                <div><i class="fa fa-globe"></i> Website</div>
                                {{ people.website }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="pull-right"><a :href="'/sales/invoice/?people_id='+people.id" class="btn btn-success"><span class="fa fa-shopping-cart"></span> Facturar</a></div>
                        <ul class="nav nav-tabs pull-left" id="tabs">
                            <!-- <li><a href="#activity">Intereses</a></li> -->
                            <li :class="{ 'active': show_sales}"><a @click="showSales" href="#">Compras</a></li>
                            <li :class="{ 'active': show_credits}"><a @click="showCredits" href="#">Creditos</a></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            <!--
                            <div class="tab-pane" id="activity">
                                <div class="row " >
                                    <div class="col-md-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" data-original-title="">
                                                <h2><span style="font-size: 1.5em" class="fa fa-gift text-success"></span><span class="break"></span> Intereses Según compras</h2>
                                            </div>
                                            <div class="panel-body">
                                                <ul>
                                                    <li>{{ group.name }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" data-original-title="">
                                                <h2><span style="font-size: 1.5em" class="fa fa-sun-o text-warning"></span><span class="break"></span> Colores Preferidos</h2>
                                            </div>
                                            <div class="panel-footer">
                                                <span class="fa fa-square" style="color: {{ color.color }}; font-size: 2em"></span>
                                                <a href="" class="btn btn-link"><span class="fa fa-pencil text-success"></span></a>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading"><span style="font-size: 1.5em" class="fa fa-question"></span> Otros</div>
                                            <div class="panel-body">
                                                <span style="font-size: 1em" class="label label-default">{{ tag.name }}</span>
                                                <a href="" class="btn btn-link"><span class="fa fa-pencil text-success"></span></a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            -->
                            <div v-if="show_sales" class="">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th class="text-center">Productos</th>
                                            <th class="text-right">Total</th>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="sale in sales" :key="sale.id">
                                            <td>{{ sale.created_at }}</td>
                                            <td class="text-center">{{ sale.lot }}</td>
                                            <td class="text-right">{{ sale.total }}</td>
                                            <td class="text-right"><a v-tooltip="'ver detalles'" :href="'/sales/invoice/?id='+sale.id" class="btn btn-info btn-xs "> <i class="fa fa-eye"></i></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <paginator :pagination="pagination" @changePage="fetchSales"></paginator>
                            </div>
                            <div v-if="show_credits">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th class="text-center">Productos</th>
                                            <th class="text-right">Abonos</th>
                                            <th class="text-right">Resta</th>
                                            <th class="text-right">Total</th>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="credit in credits" :key="credit.id">
                                            <td>{{ credit.created_at }}</td>
                                            <td class="text-center">{{ credit.lot }}</td>
                                            <td class="text-right">{{ credit.payments }}</td>
                                            <td class="text-right">{{ parseFloat(credit.credit_payment) - parseFloat(credit.payments)}}</td>
                                            <td class="text-right">{{ credit.credit_payment }}</td>
                                            <td class="text-right"><a v-tooltip="'Ver detalles'" :href="'/sales/invoice/?id='+credit.id" class="btn btn-info btn-xs "> <i class="fa fa-eye"></i></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <paginator :pagination="pagination" @changePage="fetchCredits"></paginator>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
    import People from '../../models/People';
    import Invoice from '../../models/Invoice';
    import Paginator from '../../components/Paginator.vue';


    export default {
        components: {Paginator},
        props:['people_id'],
        data(){
            return {
                show_sales:true,
                show_credits:false,
                people:{},
                errors:[],
                sales:[],
                credits:[],
                pagination:[],
            }
        },
        created(){
            this.show();
        },
        methods:{
            end(){
                this.$emit('end');
            },
            show(){
                People.show(this.people_id, data => {
                    this.people = data.data;
                    this.fetchSales();
                });


            },
            fetchSales(page = 1){
                let params = {
                    people_id: this.people_id,
                    page: page,
                 }

                 Invoice.get(params, data => {
                     this.sales = data.data;
                     this.pagination = data.meta;
                 });
            },
            fetchCredits(page = 1){
                let params = {
                    people_id: this.people_id,
                    credit: true,
                    page: page,
                 }

                 Invoice.get(params, data => {
                     this.credits = data.data;
                     this.pagination = data.meta;
                 });
            },
            showSales(){
                this.fetchSales();
                this.show_credits = false;
                this.show_sales = true;
            },
            showCredits(){
                this.fetchCredits();
                this.show_credits = true;
                this.show_sales = false;
            }
        }
    }
</script>
