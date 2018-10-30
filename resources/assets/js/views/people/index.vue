<template>
    <div>
        <people-list  v-if="show_people_list" @create="create" @edit="edit" @show="show" ></people-list>
        <people-create  v-if="create_people" @end="list" ></people-create>
        <people-edit  v-if="edit_people" :people_id="people_id" @end="list" ></people-edit>
        <people-show  v-if="show_people" :people_id="people_id" @end="list" ></people-show>
    </div>
</template>

<script>
    import PeopleList from './List';
    import PeopleCreate from './Create';
    import PeopleEdit from './Edit';
    import PeopleShow from './Show';
    export default {
        components: {PeopleList,PeopleCreate, PeopleEdit, PeopleShow},
        //props:['people_id'],
        data() {
            return  {
                create_people :false,
                edit_people :false,
                show_people:false,
                show_people_list:true,
                people_id:'',
            }
        },
        created(){
            /* if(this.people_id != ''){
                this.show(this.people_id);
            } */
        },
        methods: {
            list(){
                this.show_people_list = true;
                this.create_people    = false;
                this.edit_people      = false;
                this.show_people      = false;
            },
            create(){
                this.create_people    = true;
                this.show_people_list = false;
                this.edit_people      = false;
                this.show_people      = false;
            },
            edit(people_id){
                this.edit_people      = true;
                this.create_people    = false;
                this.show_people_list = false;
                this.show_people      = false;
                this.people_id = people_id
            },
            show(people_id){
                this.show_people      = true;
                this.edit_people      = false;
                this.create_people    = false;
                this.show_people_list = false;
                this.people_id = people_id
            }
        }
    }
</script>