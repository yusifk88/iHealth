<template>

<div>
    <v-overlay v-if="progress">
        <v-progress-circular color="yellow" size="45" indeterminate ></v-progress-circular>
    </v-overlay>

    <div v-else>
    <v-alert v-if="edditing" type="warning"><h4>Your are in editing mode, this record already exist</h4></v-alert>
    <v-alert type="warning" v-show="!auth">
        Your user role is not allowed to edit this record. You are in viewing mode
    </v-alert>
    <v-stepper v-model="e1" flat>
        <v-stepper-header>
            <v-stepper-step v-if="auth" editable :complete="e1 > 1" step="1">Patient Complain</v-stepper-step>

            <v-divider></v-divider>

            <v-stepper-step v-if="auth" editable :complete="e1 > 2" step="2">History of Complain</v-stepper-step>

            <v-divider></v-divider>

            <v-stepper-step v-if="auth" editable :complete="e1 > 3" step="3">On Direct Questions</v-stepper-step>

            <v-divider></v-divider>

            <v-stepper-step v-if="auth" editable :complete="e1 > 4" step="4">Post Medical History</v-stepper-step>


            <v-divider></v-divider>

            <v-stepper-step v-if="auth" editable :complete="e1 > 5" step="5">Drug History</v-stepper-step>


            <v-divider></v-divider>

            <v-stepper-step v-if="auth" editable :complete="e1 > 6" step="6">Psychological History</v-stepper-step>

            <v-divider></v-divider>

            <v-stepper-step v-if="auth"  editable :complete="e1 > 7" step="7">Family History</v-stepper-step>



            <v-divider></v-divider>

            <v-stepper-step v-if="auth" editable :complete="e1 > 8" step="8">OBS/Gynecological History</v-stepper-step>


            <v-divider></v-divider>

            <v-stepper-step v-if="auth" editable :complete="e1 > 9" step="9">Review of Systems</v-stepper-step>


            <v-divider></v-divider>
            <v-stepper-step v-if="auth" editable :complete="e1 > 10" step=10>Diagnosis</v-stepper-step>
             <v-divider></v-divider>
            <v-stepper-step v-if="auth" :complete="e1 > 11" step="11">Prescription Plan</v-stepper-step>

            <v-divider></v-divider>
            <v-stepper-step v-if="auth" editable :complete="e1 > 12" step="12">Preview & Submit</v-stepper-step>


        </v-stepper-header>


        <v-stepper-items>
            <v-stepper-content step="1">
                <v-card
                    flat

                >
                    <v-card-text>

                        <h3>Patient Complain</h3>
                    <vue-editor v-model="complain"></vue-editor>

                    </v-card-text>

                    <v-card-actions>

                        <v-spacer></v-spacer>

                        <v-btn
                            color="primary"
                            @click="e1 = 2"
                            text
                        >
                            Next <v-icon>mdi-arrow-right</v-icon>
                        </v-btn>
                    </v-card-actions>



                </v-card>
            </v-stepper-content>

            <v-stepper-content step="2">

                <v-card
                    flat

                >
                    <v-card-text>

                        <h3>Complain History</h3>
                        <vue-editor v-model="complain_history"></vue-editor>

                    </v-card-text>

                    <v-card-actions>

                        <v-spacer></v-spacer>

                        <v-btn
                            color="primary"
                            @click="e1 = e1-1"
                            text
                        >
                            <v-icon>mdi-arrow-left</v-icon> Back
                        </v-btn>

                        <v-btn
                            color="primary"
                            @click="e1 = 3"
                            text
                        >
                            Next <v-icon>mdi-arrow-right</v-icon>
                        </v-btn>
                    </v-card-actions>



                </v-card>

            </v-stepper-content>

            <v-stepper-content step="3">
                <v-card
                    flat

                >
                    <v-card-text>

                        <h3>On-Direct Questions</h3>
                        <vue-editor v-model="questions"></vue-editor>

                    </v-card-text>

                    <v-card-actions>

                        <v-spacer></v-spacer>

                        <v-btn
                            color="primary"
                            @click="e1 = e1-1"
                            text
                        >
                            <v-icon>mdi-arrow-left</v-icon> Back
                        </v-btn>

                        <v-btn
                            color="primary"
                            @click="e1 =4"
                            text
                        >
                            Next <v-icon>mdi-arrow-right</v-icon>
                        </v-btn>
                    </v-card-actions>



                </v-card>

            </v-stepper-content>
            <v-stepper-content step="4">
                <v-card
                    flat

                >
                    <v-card-text>

                        <h3>Post Medical History</h3>
                        <vue-editor v-model="medical_history"></vue-editor>

                    </v-card-text>

                    <v-card-actions>

                        <v-spacer></v-spacer>

                        <v-btn
                            color="primary"
                            @click="e1 = e1-1"
                            text
                        >
                            <v-icon>mdi-arrow-left</v-icon> Back
                        </v-btn>

                        <v-btn
                            color="primary"
                            @click="e1 = 5"
                            text
                        >
                            Next <v-icon>mdi-arrow-right</v-icon>
                        </v-btn>
                    </v-card-actions>

                </v-card>
            </v-stepper-content>
            <v-stepper-content step="5">
                <v-card
                    flat

                >
                    <v-card-text>

                        <h3>Drug History</h3>
                        <vue-editor v-model="drug_history"></vue-editor>

                    </v-card-text>

                    <v-card-actions>

                        <v-spacer></v-spacer>

                        <v-btn
                            color="primary"
                            @click="e1 = e1-1"
                            text
                        >
                            <v-icon>mdi-arrow-left</v-icon> Back
                        </v-btn>

                        <v-btn
                            color="primary"
                            @click="e1 = 6"
                            text
                        >
                            Next <v-icon>mdi-arrow-right</v-icon>
                        </v-btn>
                    </v-card-actions>

                </v-card>
            </v-stepper-content>
            <v-stepper-content step="6">
                <v-card
                    flat

                >
                    <v-card-text>

                        <h3>Psychological History</h3>
                        <vue-editor v-model="psycological_history"></vue-editor>

                    </v-card-text>

                    <v-card-actions>

                        <v-spacer></v-spacer>

                        <v-btn
                            color="primary"
                            @click="e1 = e1-1"
                            text
                        >
                            <v-icon>mdi-arrow-left</v-icon> Back
                        </v-btn>

                        <v-btn
                            color="primary"
                            @click="e1 = 7"
                            text
                        >
                            Next <v-icon>mdi-arrow-right</v-icon>
                        </v-btn>
                    </v-card-actions>

                </v-card>
            </v-stepper-content>
            <v-stepper-content step="7">
                <v-card
                    flat

                >
                    <v-card-text>

                        <h3>Family History</h3>
                        <vue-editor v-model="family_history"></vue-editor>

                    </v-card-text>

                    <v-card-actions>

                        <v-spacer></v-spacer>

                        <v-btn
                            color="primary"
                            @click="e1 = e1-1"
                            text
                        >
                            <v-icon>mdi-arrow-left</v-icon> Back
                        </v-btn>

                        <v-btn
                            color="primary"
                            @click="e1 = 8"
                            text
                        >
                            Next <v-icon>mdi-arrow-right</v-icon>
                        </v-btn>
                    </v-card-actions>

                </v-card>
            </v-stepper-content>
            <v-stepper-content step="8">
                <v-card
                    flat
                >
                    <v-card-text>

                        <h3>OBS/Gynaecological History</h3>
                        <vue-editor v-model="gynacological_history"></vue-editor>

                    </v-card-text>

                    <v-card-actions>

                        <v-spacer></v-spacer>

                        <v-btn
                            color="primary"
                            @click="e1 = e1-1"
                            text
                        >
                            <v-icon>mdi-arrow-left</v-icon> Back
                        </v-btn>

                        <v-btn
                            color="primary"
                            @click="e1 = 9"
                            text
                        >
                            Next <v-icon>mdi-arrow-right</v-icon>
                        </v-btn>
                    </v-card-actions>

                </v-card>
            </v-stepper-content>
            <v-stepper-content step="9">
                <v-card
                    flat
                >
                    <v-card-text>

                        <h3>Review Of Systems</h3>
                        <vue-editor v-model="system_review"></vue-editor>

                    </v-card-text>

                    <v-card-actions>

                        <v-spacer></v-spacer>

                        <v-btn
                            color="primary"
                            @click="e1 = e1-1"
                            text
                        >
                            <v-icon>mdi-arrow-left</v-icon> Back
                        </v-btn>

                        <v-btn
                            color="primary"
                            @click="e1 = 10"
                            text
                        >
                            Next <v-icon>mdi-arrow-right</v-icon>
                        </v-btn>
                    </v-card-actions>

                </v-card>
            </v-stepper-content>
            <v-stepper-content step="10">
                <v-card
                    flat
                >
                    <v-card-text>

                        <h3>Diagnosis</h3>
                        <vue-editor v-model="diagnosis"></vue-editor>

                    </v-card-text>

                    <v-card-actions>

                        <v-spacer></v-spacer>

                        <v-btn
                            color="primary"
                            @click="e1 = e1-1"
                            text
                        >
                            <v-icon>mdi-arrow-left</v-icon> Back
                        </v-btn>

                        <v-btn
                            color="primary"
                            @click="e1 = 11"
                            text
                        >
                            Next <v-icon>mdi-arrow-right</v-icon>
                        </v-btn>
                    </v-card-actions>

                </v-card>
            </v-stepper-content>




            <v-stepper-content step="11">



                <v-card
                    flat
                >
                    <v-card-text>

                        <h3>Prescription Plan</h3>


                        <v-toolbar class="p-4 m-3">

                            <v-col cols="12" sm='6'>
                                <v-switch v-model="detained" color="blue" label="Detain"></v-switch>

                            </v-col>

                             <v-col cols="12" sm='6'>
                                    <v-select :disabled="!detained" v-model="ward_id" :items="wards" item-text="name" item-value="id" outlined label='Ward'></v-select>
                            </v-col>
                        </v-toolbar>

                        <v-simple-table v-if="selected_drugs.length>0">
                            <tr class="text-center">
                                <th colspan="3"><strong>Drugs in Facility</strong></th>
                            </tr>
                            <tr>
                                <td>Drug Name</td>
                                <td>Quantity</td>
                                <td>Dosage</td>
                                <td></td>
                            </tr>
                            <tr v-for="(drug,i) in selected_drugs" :key="i">
                                <td>
                                    <v-autocomplete label="Drug" item-value="id" item-text="description" :items="drugs" v-model="drug.drug_id"></v-autocomplete>
                                </td>

                                <td>
                                    <v-text-field label="Quantity" v-model="drug.quantity" type="number"></v-text-field>
                                </td>

                                 <td>
                                    <v-text-field label="Dosage" v-model="drug.dosage"></v-text-field>
                                </td>
                                <td>
                                    <v-btn @click="remove_drug(i)" icon color="red"><v-icon>mdi-close</v-icon></v-btn>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3">
                                </td>
                            </tr>
                        </v-simple-table>


                       <p> <v-btn class="m-4" @click="add_drug()" block text color="blue">Add Drug <v-icon>mdi-plus</v-icon></v-btn></p>


                        <v-alert type="info">
                            <h3>Other Drugs</h3>
                            please list drugs that cannot be found in your facility here

                        </v-alert>

                        <vue-editor v-model="prescription"></vue-editor>

                    </v-card-text>

                    <v-card-actions>

                        <v-spacer></v-spacer>

                        <v-btn
                            color="primary"
                            @click="e1 = e1-1"
                            text
                        >
                            <v-icon>mdi-arrow-left</v-icon> Back
                        </v-btn>

                        <v-btn
                            color="primary"
                            @click="e1 = 12"
                            text
                        >
                            Preview & Submit <v-icon>mdi-check-circle</v-icon>
                        </v-btn>
                    </v-card-actions>

                </v-card>


            </v-stepper-content>

              <v-stepper-content step="12">

                        <v-card scrollable>

                            <v-card-title class="text-center">
                                <h2>Preview & Submit</h2>

                            </v-card-title>

                            <v-card-text>
                                    <v-alert outlined border="left" type="info">
                                        <h3>Patient Complain</h3>
                                            <v-card-text class="text-dark" v-html="complain"></v-card-text>

                                            <v-btn text @click="e1=1" color="blue">edit</v-btn>

                                    </v-alert>



                                    <v-alert outlined border="left" type="info">
                                        <h3>Complain HIstory</h3>


                                        <v-card-text class="text-dark" v-html="complain_history"></v-card-text>

                                            <v-btn text @click="e1=2" color="blue">edit</v-btn>


                                    </v-alert>




                                     <v-alert outlined border="left" type="info">
                                        <h3>On-Direct Questions</h3>
                                        <v-card-text class="text-dark" v-html="questions"></v-card-text>

                                            <v-btn text @click="e1=3" color="blue">edit</v-btn>

                                    </v-alert>



                                      <v-alert outlined border="left" type="info">
                                        <h3>Post Medical history</h3>
                                        <v-card-text class="text-dark" v-html="medical_history"></v-card-text>

                                            <v-btn text @click="e1=4" color="blue">edit</v-btn>

                                    </v-alert>


                                    <v-alert outlined border="left" type="info">
                                        <h3>Drug history</h3>
                                        <v-card-text class="text-dark" v-html="drug_history"></v-card-text>

                                            <v-btn text @click="e1=5" color="blue">edit</v-btn>

                                    </v-alert>



                                     <v-alert outlined border="left" type="info">
                                        <h3>Psychological history</h3>
                                        <v-card-text class="text-dark" v-html="psycological_history"></v-card-text>

                                            <v-btn text @click="e1=6" color="blue">edit</v-btn>

                                    </v-alert>


                                    <v-alert outlined border="left" type="info">
                                        <h3>Family history</h3>
                                        <v-card-text class="text-dark" v-html="family_history"></v-card-text>

                                            <v-btn text @click="e1=7" color="blue">edit</v-btn>

                                    </v-alert>


                                     <v-alert outlined border="left" type="info">
                                        <h3>Gynaecological history</h3>
                                        <v-card-text class="text-dark" v-html="gynacological_history"></v-card-text>

                                            <v-btn text @click="e1=8" color="blue">edit</v-btn>

                                    </v-alert>

                                     <v-alert outlined border="left" type="info">
                                        <h3>Review Of Systems</h3>
                                        <v-card-text class="text-dark" v-html="system_review"></v-card-text>

                                            <v-btn text @click="e1=9" color="blue">edit</v-btn>

                                    </v-alert>


                                     <v-alert outlined border="left" type="info">
                                        <h3>Diagnosis</h3>
                                        <v-card-text class="text-dark" v-html="diagnosis"></v-card-text>

                                            <v-btn text @click="e1=10" color="blue">edit</v-btn>

                                    </v-alert>

                                      <v-alert outlined border="left" type="info">
                                        <h3>Prescription Plan</h3>
                                        <v-card-text class="text-dark">


                                              <v-simple-table>
                                                  <tr>
                                                      <td>

                                                          {{detained ? 'Deatained' :'Not Deatined'}}
                                                          <br><small class="text-muted">Detention Status</small>
                                                      </td>

                                                       <td>
                                                           {{get_wardname(ward_id)}}
                                                         <br><small class="text-muted">Ward</small>

                                                      </td>
                                                  </tr>


                                                    <tr><th colspan="3">Prescribed Drugs in facility</th></tr>
                                                    <tr>
                                                        <th>Description</th>
                                                        <th>Quantity</th>
                                                        <th>Dosage</th>
                                                    </tr>
                                                  <tr v-for="(drug,i) in selected_drugs" :key="i">
                                                        <td>{{get_drugname(drug.drug_id)}}</td>
                                                        <td>{{drug.quantity}}</td>
                                                        <td>{{drug.dosage}}</td>

                                                  </tr>
                                              </v-simple-table>

                                              <h2>Drugs Outside Facility</h2>
                                              <div v-html="prescription"></div>



                                        </v-card-text>

                                            <v-btn text @click="e1=11" color="blue">edit</v-btn>

                                    </v-alert>

                                    <v-btn v-if="auth" dark color="green" block :loading="progress" @click="save_consulting">Save {{edditing ? 'Changes':''}}</v-btn>


                            </v-card-text>

                        </v-card>

                </v-stepper-content>
                <v-btn @click="e1=12" text color="blue">Skip to Review & Submit</v-btn>

        </v-stepper-items>
    </v-stepper>
</div>

</div>
</template>

<script>
    import { VueEditor } from "vue2-editor";
    export default {
        name: "consultingComponent",
        props:['attendanceId'],
        components:{
            VueEditor
        },
        data(){
            return{
                wards:[],
                e1:1,
                complain:'',
                complain_history:'',
                questions:'',
                medical_history:'',
                drug_history:'',
                psycological_history:'',
                family_history:'',
                gynacological_history:'',
                system_review:'',
                diagnosis:'',
                prescription:'',
                detained:false,
                ward_id:null,
                drugs:[],
                selected_drugs:[],
                progress:false,
                other_drugs:'',
                id:null,
                edditing:false,
                auth:false,

            }
        },
        methods:{

            get_opd(){
                axios.get('/api/opd/'+this.$route.params.id)
                    .then(res=>{
                        this.progress=false;
                        if(res.data){
                            this.edditing=res.data.consulting_status;
                            this.complain=res.data.consulting.complain;
                            this.complain_history = res.data.consulting.complain_history;
                            this.questions = res.data.consulting.questions;
                            this.medical_history=res.data.consulting.medical_history;
                            this.drug_history=res.data.consulting.drug_history;
                            this.psycological_history = res.data.consulting.psychological_history;
                            this.system_review=res.data.consulting.system_review;
                            this.diagnosis = res.data.consulting.diagnosis;
                            this.prescription = res.data.consulting.other_drugs;
                            this.detained = res.data.consulting.detained == 1 ? true:false;
                            this.ward_id = res.data.consulting.ward_id;
                            this.selected_drugs = res.data.consulting.prescription;
                            this.gynacological_history = res.data.consulting.gynecological_history;
                            this.id = res.data.consulting.id;
                        }

                    })

            },
            save_consulting(){

                this.progress=true;
                const formData = new FormData();
                    formData.append('opd_id',this.$route.params.id);
                    formData.append('complain',this.complain);
                    formData.append('complain_history',this.complain_history);
                    formData.append('questions',this.questions);
                    formData.append('medical_history',this.medical_history);
                    formData.append('drug_history',this.drug_history);
                    formData.append('psychological_history',this.psycological_history);
                    formData.append('family_history',this.family_history);
                    formData.append('gynecological_history',this.gynacological_history);
                    formData.append('system_review',this.system_review);
                    formData.append('diagnosis',this.diagnosis);
                    formData.append('other_drugs',this.prescription);
                    formData.append('detained',this.detained ? 1 : 0);
                    formData.append('ward_id',this.ward_id ? this.ward_id : 0);
                    formData.append('selected_drugs',JSON.stringify(this.selected_drugs));

                    if(!this.edditing) {

                        axios.post('/api/consultance', formData)
                            .then(res => {
                                this.$router.back();

                            })
                            .catch(error => {
                                this.progress = false;

                            });
                    }else{


                        axios.post('/api/consultance/'+this.id,formData)
                            .then(res=>{
                                this.$router.back();
                            })

                    }


            },

            get_wardname(id){
                if(id){

               let w= this.wards.filter(ward=>{

                   return ward.id = id;
                });
                return w[0].name;
                }

            },

            get_drugname(id){

                if(id){

               let d= this.drugs.filter(drug=>{

                   return drug.id==id;


                });
                return d[0].description;

                }

            },

            remove_drug(i){


                    this.selected_drugs.splice(i,1);

            },

            add_drug(){

                let drug={
                    drug_id:null,
                    quantity:1,
                    dosage:''
                };
                this.selected_drugs.push(drug);

            },

            get_drugs(){
                this.progress=true;

                axios.get('/api/drug')
                    .then(res=>{
                        this.drugs=res.data;
                        this.progress=false;

                    })
                    .catch(error=>{

                    });
            },
            get_wards(){
                this.progress=true;

                    axios.get('/api/wards')
                        .then(res=>{
                            this.wards = res.data;
                            this.progress=false;

                        })
                        .catch(error=>{

                        });

            }

        },
        mounted(){
            if(this.$store.state.user.type == 'consulting'){
                this.auth = true;

            }else {
                this.e1=12;

            }

            this.get_wards();
            this.get_drugs();
            this.get_opd();


        }
    }
</script>

<style scoped>

</style>
