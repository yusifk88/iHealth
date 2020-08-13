<template>

<div>
    <v-card>
        <v-card-text>

            <h2>Out Patient Attendance</h2>
            <v-text-field
                v-model="search"
                outlined
                label="Search"
                placeholder="Search..."
                type="search"
            ></v-text-field>
        </v-card-text>

        <v-data-table
            :items="opd"
            :headers="headers"
            :search="search"
            :loading="progress"

        >


            <template v-slot:item.patient.surname="{item}">
                {{item.patient.surname}}
                {{item.patient.other_name}}

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
                            :to="'/opd/'+item.id"

                        >
                            <v-list-item-title>View Attendance</v-list-item-title>
                        </v-list-item>

                        <v-list-item
                            @click="edit(item)"
                            :to="'/vitals/'+item.id"

                        >
                            <v-list-item-title>Vitals</v-list-item-title>
                        </v-list-item>

                        <v-list-item
                            :to="'/consulting/'+item.id"

                        >
                            <v-list-item-title>Consulting</v-list-item-title>
                        </v-list-item>


                        <v-list-item
                            :to="'/lab/'+item.id"

                        >
                            <v-list-item-title>Laboratory</v-list-item-title>
                        </v-list-item>

                        <v-list-item
                            :to="'/dispensary/'+item.id"
                            v-if="item.consulting_status"
                        >
                            <v-list-item-title>Dispensary</v-list-item-title>
                        </v-list-item>


                    </v-list>
                </v-menu>


            </template>

        </v-data-table>

    </v-card>


</div>


</template>

<script>
    export default {
        name: "opdviewComponent",
        data(){

            return{
                search:'',
            opd:[],
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
                    value:'consulting_status',
                    text:'Consulting Status',
                        align:'center'
                } ,

                {
                    value:'lab_status',
                    text:'Lab. Status',
                    align:'center'

                } ,


                 {
                    value:'dispensary_status',
                    text:'Dispensary Status',
                     align:'center'

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
                progress:false,
            }

        },
        methods:{

            get_opd(){
                this.progress=true;
                axios.get('/api/attendance')
                    .then(res=>{
                        this.opd = res.data;
                        this.progress=false;
                    })
            }
        },
        mounted() {
            this.get_opd();


        }

    }
</script>

<style scoped>

</style>
