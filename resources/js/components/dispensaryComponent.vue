<template>

<div>

<v-card>
    <v-tabs
      v-model="tab"
      centered


    >
      <v-tabs-slider></v-tabs-slider>

      <v-tab href="#drugs">
        Drugs
      </v-tab>

      <v-tab href="#sales">

        Sales

      </v-tab>

    </v-tabs>

    <v-tabs-items v-model="tab">
      <v-tab-item

        value="drugs"
      >
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
          <v-card-text>
              <v-data-table
                :search="search"
                :items="drugs"
                :loading="progress"
                :headers="headers"
                loading-text="Getting drug list please wait.."
                :items-per-page=50
              >


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



             </v-card-text>
        </v-card>


         <v-btn
            color="blue"
            dark
            bottom
            right
            rounded
            style="z-index:9999"
            fixed
            @click="add_dialog = !add_dialog;"
        >
           New Drug <v-icon>mdi-plus</v-icon>
        </v-btn>


      </v-tab-item>


        <v-tab-item

        value="sales"
      >
        <v-card flat>
          <v-card-text>
              <salesComponent></salesComponent>
          </v-card-text>
        </v-card>
      </v-tab-item>
    </v-tabs-items>
  </v-card>


  <v-dialog v-model="add_dialog" width="750">
      <v-card>
          <v-card-title>{{editting ? 'Update Drug' :'Create New Drug'}}</v-card-title>
          <v-card-text>

                <v-form ref='drug_form' v-model="form_valid" @keyup.native.enter="save_drug()">


                        <v-col cols="12" sm="12">
                            <v-text-field
                            v-model="description"
                            label="Description"
                            outlined=""
                            :rules="[rules.required]"

                            ></v-text-field>

                        </v-col>

                        <v-row>

                         <v-col cols="12" sm="6">
                            <v-text-field
                            v-model="price"
                            label="Price"
                            prefix="GHs"
                            type="number"
                            outlined=""
                            :rules="[rules.required]"

                            ></v-text-field>

                        </v-col>
                          <v-col cols="12" sm="6">
                            <v-text-field
                            v-model="quantity"
                            label="Quantity"
                            type="number"
                            outlined=""
                            :rules="[rules.required]"


                            ></v-text-field>

                        </v-col>

                          <v-col cols="12" sm="6">
                            <v-text-field
                            v-model="code"
                            label="Drug Code"
                            outlined=""
                            :rules="[rules.required]"


                            ></v-text-field>

                        </v-col>
                          <v-col cols="12" sm="6">
                            <v-autocomplete
                            v-model="type"
                            label="Drug Type"
                            outlined=""
                            :items="types"
                            :rules="[rules.required]"



                            ></v-autocomplete>

                        </v-col>
                        </v-row>
                </v-form>

          </v-card-text>
          <v-card-actions>

              <v-spacer></v-spacer>
              <v-btn @click="save_drug()" :loading="progress" color="blue" text>Save {{editting ? 'Changes':''}}</v-btn>
              <v-btn text @click="add_dialog=false">cancel</v-btn>
          </v-card-actions>

      </v-card>


  </v-dialog>


  <v-snackbar
    color="error"
    dark
    v-model="error_message"

>{{error_msg}}</v-snackbar>


        <v-snackbar
    dark
    v-model="success_message"

>{{success_msg}}</v-snackbar>

</div>

</template>

<script>
import salesComponent from "./partials/salesComponent";
export default {
    name:'dispensaryComponent',
    components: {salesComponent},
    data(){
        return{
            search:'',
            form_valid:false,
              headers:[
                    {
                        value:'description',
                        text:'Description'
                    },
                    {
                        value:'quantity',
                        text:'Quantity',
                        align:'center'
                    } ,

                    {
                        value:'type',
                        text:'Type',

                    },

                    {
                        value:'price',
                        text:'Price',
                        align:'right'

                    } ,
                    {
                        value:'code',
                        text:'Code'
                    } ,

                    {
                    value:'id',
                    text:'Action',
                    align:'center'

                  },

                ],
            error_message:false,
            error_msg:'',
            success_message:false,
            success_msg:'',
            drugs:[],

            tab:'drugs',
            add_dialog:false,
            progress:false,
            description:'',
            price:0,
            quantity:0,
            code:'',
            id:null,
            type:'',
             rules: {
                    required: value => !!value || 'Required.',
                    counter: value => value.length <= 20 || 'Max 20 characters',
                    email: value => {
                        const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                        return pattern.test(value) || 'Invalid e-mail.'
                    }
                },
            types:[
                {
                    value:'Tabs',
                    text:'Tabs'
                },
                {
                    value:'Capsules',
                    text:'Capsules'
                },
                {
                    value:'Syrup',
                    text:'Syrup'
                },
                {
                    value:'Suspension',
                    text:'Suspension'
                },
                {
                    value:'Other',
                    text:'Other'
                },

            ],
            editting:false,
        }
    },
    methods:{
        edit(drug){
            this.description = drug.description;
            this.quantity = drug.quantity;
            this.code = drug.code;
            this.price = drug.price;
            this.type = drug.type;
            this.id = drug.id;
            this.add_dialog = true;
            this.editting = true;

        },
        delete_drug(drug){


        },

        get_drugs(){

                this.progress =true;
                axios.get('/api/drug')
                    .then(res=>{

                        this.drugs = res.data;
                        this.progress =false;

                    })

                    .catch(error=>{

                    });

        },


        save_drug(){

            if(this.$refs.drug_form.validate()){

                    this.progress =true;
                    const formdata = new FormData();

                        formdata.append('description',this.description);
                        formdata.append('quantity',this.quantity);
                        formdata.append('price',this.price);
                        formdata.append('code',this.code);
                        formdata.append('type',this.type);
                        if(this.editting){
                            axios.post('/api/drug/'+this.id,formdata)
                                .then(res=>{
                                    this.progress =false;
                                    this.get_drugs();


                                    this.add_dialog=false;
                                })
                                .catch(error=>{

                                this.progress =false;
                                if(error.response.status==302){
                                    this.error_msg = error.response.data
                                }else{
                                    this.error_msg="Something went wrong please check your connection and try again";
                                }
                                this.error_message =true;


                                });


                                return false;
                        }
                        axios.post('/api/drug',formdata)
                            .then(res=>{

                            this.progress =false;

                            this.success_msg = "Drug Added Successfully";
                            this.success_message =true;
                            this.description ='';
                            this.code='';
                            this.price=0;
                            this.quantity=0;
                            this.get_drugs();



                })
                            .catch(error=>{
                                this.progress =false;
                                if(error.response.status==302){
                                    this.error_msg = error.response.data
                                }else{
                                    this.error_msg="Something went wrong please check your connection and try again";
                                }
                                this.error_message =true;

                            });

            }
        }

    },
    mounted(){

this.get_drugs();


    }

}
</script>
