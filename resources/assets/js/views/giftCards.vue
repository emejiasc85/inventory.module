<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading hidden-print">
                <h2><i class="fa fa-gift"></i><span class="break"></span>Gift Cards</h2>
                <div class="pull-right">
                    <a class="btn btn-xs btn-link" v-show="!showList" @click="showList = true"><i class="fa fa-list"></i></a>
                    <a class="btn btn-xs btn-link" v-show="showList" @click="showList = false"><i class="fa fa-th"></i></a>
                    <a class="btn btn-xs btn-link text-primary" @click="showAdd = true" v-tooltip="'Agregar gift cards'"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <div v-if="!showList" class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Valor</th>
                                <th>Valor Actual</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="card in cards" :key="'card_table'+card.id">
                                <td>{{ card.id}}</td>
                                <td>{{ card.value}}</td>
                                <td>{{ card.current_value}}</td>
                                <td>{{ card.created_at}}</td>
                                <td>
                                    <span v-if="card.status == 1" class="label label-success">Activa</span>
                                    <span v-else class="label label-default">Inactiva</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div  v-if="showList">
                    <table class="table table-bordered text-center">
                        <tbody>
                            <tr v-for="(chunk, index) in chunk_cards " :key="'chunk_'+index">
                                <td v-for="card in chunk" :key="'card_'+card.id">
                                    <div class="card">
                                        <div class="col-xs-6 gift">
                                            <div class="round" style="padding-top:1.8em">

                                                <img class="bg-g" src="/img/open_gift2.png" alt="" >
                                                <img :src="commerce.logo" alt="" width="100">
                                                <!-- <h1 style="font-family: 'Anton', sans-serif; font-size:2em; padding-top:10px">Q. {{ card.value }}</h1> -->
                                                <h3>Cod. {{ card.id}}</h3>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 commerce">
                                            <h2 style="font-family: 'Anton', sans-serif; font-size:1em;">TARJETA DE REGALO</h2>
                                           <!--  <hr> -->
                                            <h1>{{commerce.name}}</h1>
                                            <!-- <hr> -->
                                            <!-- <h3>{{ commerce.name}}</h3> -->
                                            <p><span class="fa fa-phone"></span> {{ commerce.phone}}</p>
                                            <p><span class="fa fa-map-marker"></span> {{ commerce.address}}</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <paginator :pagination="pagination" @changePage="index"></paginator>
            </div>


        </div>
        <modal v-if="showAdd"  title="Agregar Tarjetas de regalos"  size="modal-md">
            <form class="form" role="form">
                <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" v-model="create.number" id="multimedia_name" placeholder="Cantidad de tarjetas">
                            <p v-if="errors.number" class="text-danger">{{ errors.number[0] }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                            <input type="text"  class="form-control" v-model="create.value" id="multimedia_name" placeholder="Valor">
                            <p v-if="errors.value" class="text-danger">{{ errors.value[0] }}</p>
                        </div>
                    </div>
                </div>
            </form>
            <button slot="btnCancel" type="button" @click="showAdd = false " class="btn btn-link">Cancelar</button>
            <button  slot="btnSave" type="button" @click="store" class="btn btn-primary" >Agregar</button>
        </modal>
    </div>
</template>
<script>

import Commerce from '../models/Commerce';
import GiftCard from '../models/GiftCard';
import Paginator from '../components/Paginator.vue';

export default {
    components: {Paginator},
    data(){
        return {
            commerce:{},
            showAdd: false,
            showList: false,
            create:{},
            cards:[],
            chunk_cards:[],
            error:[],
            filter:{},
            pagination: {},
            errors:[],
        }
    },
    created(){
        this.index();
        this.getCommerce();
    },
    methods:{
        getCommerce(){
            Commerce.get([], data => {
                this.commerce = _.first(data.data);
            });
        },
        index(page = 1) {
            let params = {
                page: page,
                id: this.filter.id,
            };

            GiftCard.get(params, data => {
                this.cards = data.data;
                this.chunk_cards = _.chunk(data.data, 2);
                this.pagination = data.meta;
            });
        },
        store(){
                let params = {
                    number : this.create.number ? this.create.number : '',
                    value : this.create.value ? this.create.value : '',
                };

                GiftCard.store(params, data => {
                    this.errors={};
                    this.create= {};
                    this.showAdd = false;
                    this.index();
                }, errors => this.errors = errors);
            },
    }
}
</script>

<style>
.card{
    color:#535c68 !important;
    /* background-color: #b8e994 !important; */
    display: flex;
    /* border: 1px solid gray; */
    -webkit-print-color-adjust: exact;
    position: relative;
    background-image: url("/img/14763.jpg");
    background-repeat: round;

}
.card .bg{

    position: absolute;
    width: 41em;
    height: 10.5em;
}

.card .commerce{
    border-left: 2px solid rgba(197, 196, 196, 0.5);;
    color:#535c68 !important;
    -webkit-print-color-adjust: exact;
    text-align: center;
}
.card .gift{
    /* background-image: url(/img/open_gift2.png); */
    /* background-repeat: no-repeat;
    background-position: center; */
    height: 10em !important;
    position: relative;
}
.card .gift .bg-g{
    position: absolute;
    top: 0;
    left: 0;
    /* background-image: url(/img/open_gift2.png); */
    /* background-repeat: no-repeat;
    background-position: center; */
}
.card .gift h3{
    position: absolute;
    bottom: 0;
    left: 0;
    font-weight: 900;
}
.card .gift img{
    position: absolute;
    top: 80px;
    left: 93px;
}
.card .commerce h1{
   font-family: 'Lobster', cursive;
   font-weight: bold;
   font-size: 1em !important;
}
.card .commerce p{
   font-size: 12px !important;
}


@media print {
    .card{
        color:#535c68 !important;
        -webkit-print-color-adjust: exact;
        display: list-item;
        list-style-image: url("/img/14763.jpg");
        list-style-position: inside;
    }
}





</style>