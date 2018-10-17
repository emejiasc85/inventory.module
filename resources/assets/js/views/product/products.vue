<template>
    <div>
        <product-list  v-if="show_product_list" @create="create" @edit="edit" @show="show" ></product-list>
        <product-create  v-if="create_product" @end="list" ></product-create>
        <product-edit  v-if="edit_product" :product_id="product_id" @end="list" ></product-edit>
        <product-show  v-if="show_product" :product_id="product_id" @end="list" ></product-show>
    </div>
</template>

<script>
    import ProductList from './ProductList';
    import ProductCreate from './ProductCreate';
    import ProductEdit from './ProductEdit';
    import ProductShow from './ProductShow';
    export default {
        components: {ProductList, ProductCreate, ProductEdit, ProductShow},
        props:['product_id'],
        data() {
            return  {
                create_product :false,
                edit_product :false,
                show_product:false,
                show_product_list:true,
            }
        },
        created(){
            if(this.product_id != ''){
                this.show(this.product_id);
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