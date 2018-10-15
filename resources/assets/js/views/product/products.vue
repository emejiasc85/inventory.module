<template>
    <div>
        <product-list  v-if="show_product_list" ></product-list>
        <!-- <cash-register-resumen :cash_register_id="cash_register_id" v-else-if="show_resumen" @showDetails="details"></cash-register-resumen> -->
    </div>
</template>

<script>
    import ProductList from './ProductList';
    export default {
        components: {ProductList},
        props:['product_id'],
        data() {
            return  {
                create_product :false,
                edit_product :false,
                show_product:false,
                show_product_list:true,
            }
        },
        methods: {
            list(){
                this.show_product_list = true;
                this.create_product    = false;
                this.edit_product      = false;
                this.show_product      = false;
            },
            create(){
                this.create_product    = true;
                this.show_product_list = false;
                this.edit_product      = false;
                this.show_product      = false;
            },
            edit(product_id){
                this.edit_product      = true;
                this.create_product    = false;
                this.show_product_list = false;
                this.show_product      = false;
                this.product_id = product_id
            },
            show(product_id){
                this.show_product      = true;
                this.edit_product      = false;
                this.create_product    = false;
                this.show_product_list = false;
                this.product_id = product_id
            }
        }
    }
</script>