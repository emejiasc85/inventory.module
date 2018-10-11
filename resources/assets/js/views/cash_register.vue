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
</div>
</template>
<script>
    export default{
        data(){
            return {
                cash_register:{}
            }
        },
        created(){

        },
        methods:{

        }
    }
</script>
