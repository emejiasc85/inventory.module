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
                    <table class="table">
                        <tbody>
                            <tr v-for="(chunk, index) in chunk_cards " :key="'chunk_'+index">
                                <td v-for="card in chunk" :key="'card_'+card.id">
                                    <div class="card">
                                        <img :src="commerce.gift_card" alt="" width="400">
                                        <h4>Cod. {{ card.id}} </h4>
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
    position: relative;
}
 .card h4{
    position: absolute;
    z-index: 10000;
    bottom: 0px;
    color: white;
    font-weight: 700;
    left: 5px;
}


@media print {
    .card h4 {
        color:white !important;
        -webkit-print-color-adjust: exact;
    }
}





</style>