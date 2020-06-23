<template>
    <div>
        <v-card>
            <v-card-title>
                Temperature records <v-spacer></v-spacer>
                <v-btn @click="get_temp(); get_graph();" class="m-3"   color="blue" outlined ><v-icon>mdi-reload</v-icon> Reload</v-btn>
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
            <v-card-text style="height:200px">
                <line-chart style="height:200px" :data="graph"></line-chart>
            </v-card-text>
            <center>
                <v-progress-circular size="100" color="blue" indeterminate v-if="progress"></v-progress-circular>
            </center>
            <v-card-text v-if="!progress">
                <v-simple-table>
                    <thead>
                        <tr>
                            <th>Value</th>
                            <th>Time</th>
                            <th>Date</th>
                            <th>Remark</th>
                            <th>Nurse</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="tem in temp_list">
                            <td>{{tem.temperature}} <v-icon small>mdi-temperature-celsius</v-icon></td>
                            <td>{{tem.time}}</td>
                            <td>{{tem.created_at}}</td>
                            <td>{{tem.remark}}</td>
                            <td>{{tem.nurse.name}}</td>
                            <td>
                                <v-btn
                                    @click="delete_temp(tem)"
                                    x-small color="red"
                                    text
                                    :disabled="$store.state.user.id != tem.staff_id"

                                >Delete</v-btn>
                            </td>

                        </tr>

                    </tbody>
                </v-simple-table>


            </v-card-text>


        </v-card>

        <v-dialog v-model="add_dialog" width="600" persistent>
            <v-card>
                <v-card-title>Add new temperature record</v-card-title>
                <v-card-text>
                    <v-form ref="add_form">
                        <v-row>
                        <v-col cols="12" sm="6">

                            <v-text-field
                                v-model="temperature"
                                type="number"
                                label="Temperatuer"
                                :rules="[rules.required]"
                                outlined
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6">
                            <v-dialog
                                ref="dialog"
                                v-model="modal2"
                                :return-value.sync="time"
                                persistent
                                width="290px"
                            >
                                <template v-slot:activator="{ on, attrs }">
                                    <v-text-field
                                        v-model="time"
                                        label="Entry Time"
                                        prepend-icon="mdi-access_time"
                                        readonly
                                        v-bind="attrs"
                                        :rules="[rules.required]"
                                        outlined

                                        v-on="on"
                                    ></v-text-field>
                                </template>
                                <v-time-picker
                                    v-if="modal2"
                                    v-model="time"
                                    full-width
                                >
                                    <v-spacer></v-spacer>
                                    <v-btn text color="primary" @click="modal2 = false">Cancel</v-btn>
                                    <v-btn text color="primary" @click="$refs.dialog.save(time)">OK</v-btn>
                                </v-time-picker>
                            </v-dialog>

                        </v-col>
                            <v-col cols="12" sm="12">
                                <v-textarea
                                label="Remark"
                                v-model="remark"
                                outlined
                                >

                                </v-textarea>

                            </v-col>

                        </v-row>
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <v-btn :loading="progress" @click="save_temp()" text color="blue">Save</v-btn>
                    <v-btn text @click="add_dialog=false; progress=false" >Cancel</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>


        <v-dialog width="400" v-model="delete_dialog">
            <v-card>
                <v-card-text>
                    <h4>Do you want to delete this temperature record?</h4>
                </v-card-text>
                <v-card-actions>
                    <v-btn :loading="saving_progress" text color="red" @click="remove_temp()">Delete</v-btn>
                    <v-btn text @click="delete_dialog=false">Cancel</v-btn>
                </v-card-actions>

            </v-card>

        </v-dialog>
    </div>
</template>

<script>
    export default {
        name: "tempsheetsComponent",
        data(){
            return{
                graph_data:null,
                graph:null,
                delete_dialog:false,
                modal2:false,
                time:'',
                error_msg:'',
                error_message:false,
                success_msg:'',
                success_message:false,
                temp_list:[],
                temperature:0,
                add_dialog:false,
                progress:false,
                saving_progress:false,
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
            prep_graph(){

                let graph = [

                ];

                this.graph_data.forEach(tem=>{
                    let d = graph.push([tem.created_at,tem.temprature]);


                });
                this.graph = graph;



            },

            get_graph(){

                axios.get('/api/temperaturegraph/'+this.$route.params.id)
                        .then(res=>{
                            this.graph_data = res.data;
                            this.prep_graph();
                        })
                        .catch(error=>{

                        });

            },
            remove_temp(){

                this.saving_progress = true;
                    axios.delete('/api/temperature/'+this.id)
                        .then(res=>{
                            this.get_temp();
                            this.saving_progress=false;
                            this.delete_dialog =false;

                        })
                    .catch(error=>{

                    });
            },


            delete_temp(temp){
                this.id = temp.id;
                this.delete_dialog=true;


            },
            get_temp(){
              axios.get('/api/temperature/'+this.$route.params.id)
                    .then(res=>{
                        this.temp_list = res.data;

                    })
            },
            save_temp(){
                if (this.$refs.add_form.validate()){
                    this.progress=true;
                let formdata = new FormData();
                formdata.append('temperatiure',this.temperature);
                formdata.append('time',this.time);
                formdata.append('remark',this.remark);
                formdata.append('attendance_id',this.$route.params.id);
                axios.post('/api/temperature',formdata)
                        .then(res=>{
                            this.temperature=0;
                            this.remark="";
                            this.time="";
                            this.add_dialog=false;
                            this.progress=false;
                            this.success_msg="Temperature added successfully";
                            this.success_message=true;
                            this.get_temp();
                            this.get_graph();

                        })
                    .catch(error=>{
                        this.progress=false;
                        this.error_msg="Something went wrong, please check your connection";
                        this.error_message=true;

                    });
                }

            }
        },
        mounted() {
            this.get_temp();
            this.get_graph();
        }
    }
</script>

<style scoped>

</style>
