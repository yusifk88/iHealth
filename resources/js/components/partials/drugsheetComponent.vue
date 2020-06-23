<template>
    <div>
        <v-card>
            <v-card-title>
                Temperature records <v-spacer></v-spacer>
                <v-btn @click="get_drugsheet();" class="m-3"   color="blue" outlined ><v-icon>mdi-reload</v-icon> Reload</v-btn>
                <v-btn v-if="$store.state.user.type=='nurse'" @click="add_dialog=true" class="m-3"   color="blue" dark ><v-icon>mdi-plus</v-icon>new</v-btn>
            </v-card-title>

            <v-card-text>
                <v-alert type="warning">
                    <ul>
                        <li>Only users assigned the role of a nurse are allowed to record temperatures</li>
                        <li>You are only allowed to delete records that you entered</li>
                    </ul>

                </v-alert>
            </v-card-text>

            <v-card-text>
                <v-simple-table>
                    <thead>
                        <tr>
                            <th>Drug</th>
                            <th>Remarks</th>
                            <th>Date/time</th>
                            <th>Nurse</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="drug in drugs">
                            <td>{{drug.drug_name}}</td>
                            <td>{{drug.remark}}</td>
                            <td>{{drug.created_at}}</td>
                            <td>{{drug.nurse.name}}</td>

                            <td>
                                <v-btn
                                    @click="delete_drug(drug)"
                                    x-small color="red"
                                    text
                                    :disabled="$store.state.user.id != drug.staff_id"

                                >Delete</v-btn>
                            </td>

                        </tr>
                    </tbody>
                </v-simple-table>
            </v-card-text>
        </v-card>

        <v-dialog width="500" v-model="add_dialog">
            <v-card>
                <v-card-title>
                    Record drug administered
                </v-card-title>
                <v-card-text>
                    <v-form ref="drug_form">
                    <v-text-field
                        label="Drug Name"
                        outlined
                        v-model="drug_name"
                        :rules="[rules.required]"
                    ></v-text-field>
                    <v-text-field
                        outlined
                        label="Remark"
                        v-model="remark"
                    ></v-text-field>

                    </v-form>

                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer> <v-btn @click="save_drug" :loading="progress" text color="blue">Save</v-btn> <v-btn text @click="add_dialog=false">Cancel</v-btn>
                </v-card-actions>
            </v-card>

        </v-dialog>

        <v-dialog width="400" v-model="delete_dialog">
            <v-card>
                <v-card-text>
                    <h4>Do you want to delete this note record?</h4>
                </v-card-text>
                <v-card-actions>
                    <v-btn :loading="progress" text color="red" @click="remove_drug()">Delete</v-btn>
                    <v-btn text @click="delete_dialog=false">Cancel</v-btn>
                </v-card-actions>

            </v-card>

        </v-dialog>
    </div>
</template>

<script>
    export default {
        name: "drugsheetComponent",
        data(){
            return{
                add_dialog:false,
                drugs:[],
                progress:false,
                drug_name:'',
                delete_dialog:false,
                id:null,

                remark:'',
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
            remove_drug(){
                this.progress=true;

                axios.delete('/api/drugsheet/'+this.id)
                    .then(res=>{
                        this.progress=false;
                        this.get_drugsheet();
                        this.delete_dialog=false;

                    })
                .catch(error=>{


                });

            },
            delete_drug(drug){
                this.id = drug.id;
                this.delete_dialog=true;

            },

            get_drugsheet(){
                this.progress=true;
                axios.get('/api/drugsheet/'+this.$route.params.id)
                        .then(res=>{
                            this.drugs = res.data;
                            this.progress =false;


                        })
                        .catch(error=>{


                        })

            },

            save_drug(){
                this.progress=true;
            let formdata = new FormData();
                formdata.append('drug_name',this.drug_name);
                formdata.append('remark',this.remark);
                formdata.append('attendance_id',this.$route.params.id);

            axios.post('/api/drugsheet',formdata)
                .then(res=>{
                    this.progress=false;
                    this.get_drugsheet();
                    this.drug_name="";
                    this.remark='';
                    this.add_dialog=false;

                })
                .catch(error=>{

                });

            }

        },
        mounted() {
            this.get_drugsheet();


        }
    }
</script>

<style scoped>

</style>
