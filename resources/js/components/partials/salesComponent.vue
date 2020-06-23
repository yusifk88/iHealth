<template>
    <v-card flat>
        <v-card-title>
            <v-text-field
                outlined
                placeholder="Search..."
                prepend-inner-icon="mdi-search"
                type="search"
                v-model="search"
            ></v-text-field>
        </v-card-title>

    <v-data-table
        :search="search"
        :items="sales"
        :loading="progress"
        :headers="headers"
        loading-text="Getting sale list please wait.."
        :items-per-page=100
    >


        <template v-slot:item.unit_price="{item}">

            {{item.unit_price | toMoney | currency_symbol}}

        </template> 
        <template v-slot:item.amount="{item}">

            {{item.amount | toMoney | currency_symbol}}

        </template>

        <template v-slot:item.patient.surname="{item}">

            {{item.patient.surname}} {{item.patient.other_name}}

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
                        @click="edit(item)"

                    >
                        <v-list-item-title>Edit</v-list-item-title>
                    </v-list-item>




                </v-list>
            </v-menu>


        </template>
    </v-data-table>
    </v-card>

</template>

<script>
    export default {
        name: "salesComponent",
        data(){
            return{
                sales:[],
                progress:false,
                search:'',
                headers:[
                    {
                        value:'drug.description',
                        text:'Description'
                    },
                    {
                        value:'drug.code',
                        text:'Code'
                    },
                    {
                        value:'quantity',
                        text:'Quantity',
                        align:'center'
                    } ,
                    {
                        value:'unit_price',
                        text:'Unit Price',
                        align:'right'
                    } ,

                    {
                        value:'amount',
                        text:'Amount',

                    },

                    {
                        value:'patient.surname',
                        text:'Patient',

                    } ,


                ],

            }
        },
        methods:{

            get_sales(){
                this.progress=true;
                axios.get('/api/sales')
                    .then(res=>{
                        this.sales=res.data;
                        this.progress=false;

                    })
                .catch(error=>{

                })
            }
        },
        mounted() {
            this.get_sales();

        }
    }
</script>

<style scoped>

</style>
