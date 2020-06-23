<template>
    <v-card flat>
        <v-card-title>
            <h2>Detention list</h2>

        </v-card-title>

        <v-card-text>
            <v-text-field
                outlined
                placeholder="Search..."
                prepend-inner-icon="mdi-search"
                type="search"
                v-model="search"
                class="m-4"
            ></v-text-field>
            <v-data-table
                :items="detention_list"
                :headers="headers"
                :search="search"
                :loading="progress"

            >


                <template v-slot:item.patient.surname="{item}">

                    <v-btn color="blue" text small
                           :to="'/detention/'+item.id"
                    >
                        {{item.patient.surname}}
                        {{item.patient.other_name}}
                    </v-btn>


                </template>
                <template v-slot:item.patient.opd_number="{item}">
                    <v-btn :to="'/opd/'+item.id" text small color="blue">{{item.patient.opd_number}}</v-btn>

                </template>



                <template v-slot:item.consulting_status="{item}">
                    <span v-if="item.consulting_status">
                        <v-chip outlined dark small color="green">Processed <v-icon>mdi-check-circle</v-icon></v-chip> <br>
                    </span>

                    <span v-else>
                        <v-chip outlined dark small color="red">Not Processed <v-icon>mdi-close</v-icon></v-chip><br>
                </span>

                </template>



                <template v-slot:item.lab_status="{item}">
                    <span v-if="item.lab_status">
                        <v-chip outlined dark small color="green">Processed <v-icon>mdi-check-circle</v-icon></v-chip> <br>
                    </span>

                    <span v-else>
                        <v-chip outlined dark small color="red">Not Processed <v-icon>mdi-close</v-icon></v-chip><br>
                </span>

                </template>


                <template v-slot:item.dispensary_status="{item}">
                    <span v-if="item.dispensary_status">
                        <v-chip outlined dark small color="green">Processed <v-icon>mdi-check-circle</v-icon></v-chip> <br>
                    </span>

                    <span v-else>
                        <v-chip outlined dark small color="red">Not Processed <v-icon>mdi-close</v-icon></v-chip><br>
                </span>

                </template>

                <template v-slot:item.id="{item}">

                    <v-menu
                        bottom
                        origin="center center"
                        transition="scale-transition"
                    >
                        <template v-slot:activator="{ on }">
                            <v-btn
                                color="primary"
                                v-on="on"
                                icon
                            >
                                <v-icon>mdi-dots-horizontal</v-icon>
                            </v-btn>
                        </template>

                        <v-list>

                            <v-list-item
                                :to="'/detention/'+item.id"

                            >
                                <v-list-item-title>View Details</v-list-item-title>
                            </v-list-item>


                        </v-list>
                    </v-menu>


                </template>

            </v-data-table>

        </v-card-text>


    </v-card>
</template>

<script>
    export default {
        name: "detentionComponent",
        data(){
            return{
                detention_list:[],
                progress:false,
                search:'',
                headers:[
                    {
                        value:'patient.opd_number',
                        text:'OPD#'
                    },
                    {
                        value:'patient.surname',
                        text:'Patient Name',
                    } ,

                    {
                        value:'consulting.ward.name',
                        text:'Ward',

                    } ,



                    {
                        value:'entry_date',
                        text:'Attendance Date',

                    },



                    {
                        value:'id',
                        text:'Action',
                        align:'center'

                    },

                ],


            }
        },
        methods:{
            get_detention(){
        axios.get('/api/detention')
                .then(res=>{
                    this.detention_list=res.data;

                })
                .catch(error=>{

                })
            }

        },
        mounted() {
            this.get_detention();

        }
    }
</script>

<style scoped>

</style>
