<template>
    <div>

        <patientprofileComponent :attendance-id="$route.params.id" ></patientprofileComponent>

        <v-card v-if="!progress">
            <v-card-title>Prescriptions</v-card-title>
            <v-alert type="info">
                Remove drugs with quantity in stock less than prescribed quantity or
                adjust the prescribed quantity to fit the quantity in stock.
                <br>
            </v-alert>
            <v-alert type="warning" v-if="!auth">
                Your user role is not allowed to edit this record, you are in viewing mode
            </v-alert>

            <v-alert type="warning" v-if="!editing">
                This record already exist, your are in viewing mode
            </v-alert>
            <v-form ref="drug_form">

            <v-simple-table>
                <tbody>
                <tr><th colspan="3">Prescribed Drugs in facility</th></tr>
                <tr>
                    <th>Description</th>
                    <th>Quantity in Stock</th>
                    <th>Price</th>
                    <th>Amount</th>
                    <th>prescribed Quantity</th>
                    <th>Dosage</th>
                    <th>Remark</th>
                    <th>Action</th>
                </tr>
                <tr v-for="(drug,i) in prescriptions" :key="i">
                    <td>

                        {{drug.drug ? drug.drug.description : "Name not found"}}</td>
                    <td>{{drug.drug ? drug.drug.quantity : "Not Found"}}</td>
                    <td>{{drug.drug ? drug.drug.price : 0 | toMoney | currency_symbol}}</td>
                    <td>{{Number(drug.drug ? drug.drug.price : 0)*Number(drug.quantity) | toMoney | currency_symbol}}</td>
                    <td>
                        <v-text-field
                            type="number"
                            v-model="drug.quantity"
                            :rules="[rules.required]"
                            v-if="auth"
                        ></v-text-field>
                        <span v-if="!auth">{{drug.quantity}}</span>
                    </td>
                    <td>{{drug.dosage}}</td>
                    <td><v-text-field
                        v-model="drug.remark"
                        v-if="auth"
                    >
                        <span v-if="!auth">{{drug.remark}}</span>

                    </v-text-field>
                    </td>
                    <td>
                        <v-btn :disabled="!auth" icon color="red" @click="remove_drug(i)"><v-icon>mdi-close</v-icon></v-btn>
                    </td>

                </tr>

                <tr v-for="(drug,i) in selected_drugs" :key="i">
                    <td>
                        <v-autocomplete :rules="[rules.required]" label="Drug" item-value="id" item-text="description" :items="drugs" v-model="drug.drug_id"></v-autocomplete>
                    </td>

                    <td>
                        <v-text-field label="Quantity" v-model="drug.quantity" type="number"></v-text-field>
                    </td>

                    <td>
                        <v-text-field label="Dosage" v-model="drug.dosage"></v-text-field>
                    </td>
                    <td>
                        <v-btn @click="remove_drug2(i)" icon color="red"><v-icon>mdi-close</v-icon></v-btn>
                    </td>
                </tr>

                </tbody>
            </v-simple-table>
            </v-form>

            <v-card-text>

                <v-btn v-show="auth" v-if="editing" color="blue" dark @click="add_drug">Add Drug <v-icon>mdi-plus</v-icon></v-btn>
                <v-btn v-show="auth" :loading="progress" @click="dispense_drugs()" v-if="editing" color="success" dark>Dispense Drugs</v-btn>
                <p v-if="opd.consulting.other_drugs">
                <h4>Other Drugs Outside facility</h4>
                <span v-html="opd.consulting.other_drugs"></span>
                </p>
            </v-card-text>



        </v-card>


        <v-progress-circular indeterminate size="60" color="amber" v-if="progress"></v-progress-circular>
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
    import patientprofileComponent from "./patientprofileComponent";
    export default {
        name: "newdispensaryComponent",
        components:{
          patientprofileComponent
        },
        data(){
            return{

                error_message:false,
                error_msg:'',
                success_msg:'',
                success_message:false,
                results:'',
                id:null,
                progress:true,
                editing:false,
                auth:false,
                prescriptions:[],
                other_drugs:'',
                drugs:[],
                selected_drugs:[],
                opd:{},

                rules: {
                    required: value => !!value || 'Required.',
                    counter: value => value.length <= 20 || 'Max 20 characters',
                    email: value => {
                        const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                        return pattern.test(value) || 'Invalid e-mail.'
                    }
                },
            }
        },
        methods:{
            check_quantities(){
                let res;

            for(let drug of this.prescriptions){

                 if(Number(drug.quantity) > Number(drug.drug.quantity)){

                     this.error_msg="Error: there's a drug in the list with prescribed quantity greater than the quantity in stock";
                     this.error_message =true;
                     res= false;
                     break;

                 }else{
                     res= true;
                 }

              }

            return res;

            },

            get_drugname(id){

                if(id){

                    let d= this.drugs.filter(drug=>{

                        return drug.id==id;


                    });
                    return d[0].description;

                }

            },
            add_drug(){

                let drug={
                    drug_id:null,
                    quantity:1,
                    dosage:''
                };
                this.selected_drugs.push(drug);


            },
            remove_drug(i){


                this.prescriptions.splice(i,1);

            },
            remove_drug2(i){


                this.selected_drugs.splice(i,1);

            },
            get_attendance() {
                this.progress=true;
                axios.get('/api/opd/'+this.$route.params.id)
                    .then(res=>{
                        if(res.data.dispensary_status){
                            this.editing = true;
                            this.opd = res.data;

                            this.prescriptions = res.data.consulting.prescription;
                            this.editing = !this.opd.sale_status;

                        }

                        this.progress = false;
                    });

            },


            get_drugs(){
                axios.get('/api/drug')
                    .then(res=>{
                        this.drugs=res.data;
                    })
                    .catch(error=>{

                    });
            },

            dispense_drugs(){
                if (this.$refs.drug_form.validate()){
                    if(this.check_quantities()){
                        this.progress =true;
                        let drugs = this.prescriptions;
                        let added_drugs = this.selected_drugs;
                        const formdata = new FormData();
                        formdata.append('prescriptions',JSON.stringify(drugs));
                        formdata.append('added_drugs',JSON.stringify(drugs));
                        formdata.append('opd_id',this.$route.params.id);
                        axios.post('/api/dispensedrugs',formdata)
                            .then(res=>{
                                this.progress=false;
                                this.$router.back();
                            })
                        .catch(error=>{
                            this.progress = false;
                            this.error_msg="Something went wrong, could not dispense drugs";
                            this.error_message =true;


                        });


                    }

                }
            }

        },
        mounted() {
            if(this.$store.state.user.type == 'dispensing'){
                this.auth = true;

            }


            this.get_attendance();
            this.get_drugs();

        }
    }
</script>

<style scoped>

</style>
