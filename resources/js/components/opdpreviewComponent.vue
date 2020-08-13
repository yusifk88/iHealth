<template>
    <div>

            <v-progress-circular size="120" indeterminate v-if="progress" color="blue"></v-progress-circular>

        <v-row v-else>
            <v-col cols="12" sm="12">

                <v-btn color="blue" text @click="$router.back()"><v-icon>mdi-arrow-left</v-icon>Back</v-btn>

                <v-card flat >

                    <v-card-text>
                        <h3 class="font-wieght-light">Patient Info.</h3>

                    </v-card-text>
                    <v-card-text class="border border-1" style="border:1px solid #000">


                        <v-chip dark v-if="patient.insured == 1" color="success">Insured</v-chip>
                    <v-chip dark v-else color="red">Not Insured</v-chip>

                    <v-chip>OPD#{{patient.opd_number}}</v-chip>
                    <div>

                        <v-row>
                            <v-col cols="12" sm="3">

                                <v-list >

                                    <v-list-item
                                        two-line
                                    >
                                        <v-list-item-content>
                                            <v-list-item-title>{{patient.surname}} {{patient.other_name}}</v-list-item-title>
                                            <v-list-item-subtitle>Name</v-list-item-subtitle>
                                        </v-list-item-content>

                                    </v-list-item>


                                    <v-list-item
                                        two-line
                                    >
                                        <v-list-item-content>
                                            <v-list-item-title>{{patient.home_address}}</v-list-item-title>
                                            <v-list-item-subtitle>Home Address</v-list-item-subtitle>
                                        </v-list-item-content>

                                    </v-list-item>
                                </v-list>


                            </v-col>
                            <v-col cols="12" sm="3">

                                <v-list >

                                    <v-list-item
                                        two-line
                                    >
                                        <v-list-item-content>
                                            <v-list-item-title>{{patient.phone_number}}</v-list-item-title>
                                            <v-list-item-subtitle>Phone Number</v-list-item-subtitle>
                                        </v-list-item-content>

                                    </v-list-item>


                                    <v-list-item
                                        two-line
                                    >
                                        <v-list-item-content>
                                            <v-list-item-title>{{patient.relative_name}}</v-list-item-title>
                                            <v-list-item-subtitle>Name Of relative</v-list-item-subtitle>
                                        </v-list-item-content>

                                    </v-list-item>
                                </v-list>


                            </v-col>
                            <v-col cols="12" sm="3">

                                <v-list >

                                    <v-list-item
                                        two-line
                                    >
                                        <v-list-item-content>
                                            <v-list-item-title>{{patient.relative_address}}</v-list-item-title>
                                            <v-list-item-subtitle>Address of Relative</v-list-item-subtitle>
                                        </v-list-item-content>

                                    </v-list-item>


                                    <v-list-item
                                        two-line
                                    >
                                        <v-list-item-content>
                                            <v-list-item-title>{{patient.location}}</v-list-item-title>
                                            <v-list-item-subtitle>Location/sub-district</v-list-item-subtitle>
                                        </v-list-item-content>

                                    </v-list-item>
                                </v-list>


                            </v-col>


                            <v-col cols="12" sm="3">
                                <v-list >

                                    <v-list-item
                                        two-line
                                    >
                                        <v-list-item-content>
                                            <v-list-item-title>{{patient.dob}}</v-list-item-title>
                                            <v-list-item-subtitle>Date of Birth</v-list-item-subtitle>
                                        </v-list-item-content>

                                    </v-list-item>


                                    <v-list-item
                                        two-line
                                    >
                                        <v-list-item-content>
                                            <v-list-item-title>{{patient.age}} Years</v-list-item-title>
                                            <v-list-item-subtitle>Age</v-list-item-subtitle>
                                        </v-list-item-content>

                                    </v-list-item>
                                </v-list>


                            </v-col>

                        </v-row>

                    </div>

                    </v-card-text>
                </v-card>

            </v-col>


            <v-col cols="12" sm="12">

                <v-card flat >
                    <v-card-text>
                        <h3>OPD Info.</h3>
                    </v-card-text>
                    <v-card-text style="border:1px solid #000">

                        <v-chip>Date: {{opd.entry_date}}</v-chip>
                        <v-chip color="warning">CC Code: {{opd.cc_code}}</v-chip>
                        <v-simple-table>

                            <thead>
                            <tr>
                                <th>Vital</th>
                                <th>Value</th>
                                <th>Remarks</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td>Temperature</td>

                                <td>
                                    {{opd.temperature}}<v-icon small>mdi-temperature-celsius</v-icon>

                                </td>


                                <td>{{opd.temperature_remarks}}</td>

                            </tr>

                            <tr>
                                <td>Weight</td>

                                <td>{{opd.weight}}kg</td>

                                <td>{{opd.weight_remarks}}</td>

                            </tr>

                            <tr>
                                <td>Blood Pressure</td>

                                <td >{{opd.bp}}mmhg</td>


                                <td >{{opd.bp_remarks}}</td>

                            </tr>

                            <tr>
                                <td>Height</td>

                                <td>{{opd.height}}m</td>


                                <td>{{opd.height_remarks}}</td>

                            </tr>


                            <tr>
                                <td>Pulse</td>

                                <td>{{opd.pulse}}bpm</td>

                                <td>{{opd.pulse_remarks}}</td>

                            </tr>

                            <tr>
                                <td>Respiration</td>

                                <td>{{opd.respiration}}bpm</td>

                                <td>{{opd.respiration_remarks}}</td>

                            </tr>
                            </tbody>
                        </v-simple-table>

                    </v-card-text>

                </v-card>

            </v-col>

            <v-col cols="12" sm="12" v-if="opd.consulting_status">

                <v-card flat>
                    <v-card-text>
                        <h3>Consulting Info.</h3>
                    </v-card-text>
                    <v-card-text style="border:1px solid #000">
                        <h4>Detention Status</h4>
                        <strong>Status: {{consulting.detained==1 ? 'Detained' : 'Not Detained' }}</strong> <br/>
                        <strong v-if="consulting.detained ==1">Ward: {{consulting.ward ? consulting.ward.name : 'No Ward Selected'}}</strong>

                    </v-card-text>
                    <v-card-text style="border:1px solid #000">
                        <h3>Patient Complain</h3>
                        <v-card-text class="text-dark" v-html="consulting.complain"></v-card-text>

                        <h3>Complain HIstory</h3>
                        <v-card-text class="text-dark" v-html="consulting.complain_history"></v-card-text>
                        <h3>On-Direct Questions</h3>
                        <v-card-text class="text-dark" v-html="consulting.questions"></v-card-text>
                        <h3>Post Medical history</h3>
                        <v-card-text class="text-dark" v-html="consulting.medical_history"></v-card-text>
                        <h3>Drug history</h3>
                        <v-card-text class="text-dark" v-html="consulting.drug_history"></v-card-text>
                        <h3>Psychological history</h3>
                        <v-card-text class="text-dark" v-html="consulting.psycological_history"></v-card-text>
                        <h3>Family history</h3>
                        <v-card-text class="text-dark" v-html="consulting.family_history"></v-card-text>
                        <h3>Gynaecological history</h3>
                        <v-card-text class="text-dark" v-html="consulting.gynacological_history"></v-card-text>
                        <h3>Review Of Systems</h3>
                        <v-card-text class="text-dark" v-html="consulting.system_review"></v-card-text>
                        <h3>Diagnosis</h3>
                        <v-card-text class="text-dark" v-html="consulting.diagnosis"></v-card-text>

                        <v-simple-table>
                            <tbody>
                            <tr><th colspan="3">Prescribed Drugs in facility</th></tr>
                            <tr>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Dosage</th>
                            </tr>
                            <tr v-for="(drug,i) in consulting.prescription" :key="i">
                                <td>{{drug.drug.description}}</td>
                                <td>{{drug.quantity}}</td>
                                <td>{{drug.dosage}}</td>
                            </tr>
                            </tbody>
                        </v-simple-table>





                    </v-card-text>
                </v-card>
            </v-col>

            <v-col cols="12" sm="12" v-if="opd.lab_status">
                <v-card flat>
                    <v-card-text>
                        <h3>Lab Tests</h3>
                    </v-card-text>
                    <v-card-text style="border:1px solid #000">
                        <h4>Prescribed test</h4>
                        <div v-html="lab.tests"></div>

                        <h4>Test Results</h4>
                        <div v-html="lab.results"></div>

                    </v-card-text>

                </v-card>
            </v-col>




            <v-col cols="12" sm="12"  v-if="notes.length>0">
                <v-card flat >
                    <v-card-text>
                        <h3>Nurses Notes</h3>
                    </v-card-text>
                    <v-card-text style="border:1px solid #000">

                        <v-simple-table >
                            <thead>
                            <tr>
                                <th>DateTime</th>
                                <th>Note</th>
                                <th>Nurse</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="note in notes">
                                <td>
                                    {{note.created_at}}
                                </td>
                                <td v-html="note.note">

                                </td>
                                <td>{{note.nurse.name}}</td>


                            </tr>

                            </tbody>
                        </v-simple-table>

                    </v-card-text>

                </v-card>
            </v-col>


            <v-col cols="12" sm="12"  v-if="temp_list.length>0">
                <v-card flat >
                    <v-card-text>
                        <h3>Temperature Records</h3>
                    </v-card-text>
                    <v-card-text style="border:1px solid #000">

                        <v-simple-table>
                            <thead>
                            <tr>
                                <th>Value</th>
                                <th>Date/Time</th>
                                <th>Remark</th>
                                <th>Nurse</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="tem in temp_list">
                                <td>{{tem.temperature}} <v-icon small>mdi-temperature-celsius</v-icon></td>
                                <td>{{tem.created_at}}</td>
                                <td>{{tem.remark}}</td>
                                <td>{{tem.nurse.name}}</td>

                            </tr>

                            </tbody>
                        </v-simple-table>

                    </v-card-text>

                </v-card>
            </v-col>


        </v-row>
    </div>
</template>

<script>
    export default {
        name: "opdpreviewComponent",
        data(){
            return{
                opd:{},
                patient:{},
                consulting:{},
                lab:{},
                progress:false,
                notes:[],
                temp_list:[]

            }
        },
        methods:{
            get_attendance() {
                this.progress=true;
                axios.get('/api/opd/'+this.$route.params.id)
                    .then(res=>{
                        this.opd = res.data;
                        this.notes = res.data.nursesnotes;
                        this.temp_list = res.data.temperatuersheets;

                        if(res.data.dispensary_status){
                            this.editing = true;
                            this.patient = res.data.patient;
                            this.consulting = res.data.consulting;
                            this.lab = res.data.lab;

                        }

                        this.progress = false;
                    });

            },

        },
        mounted(){
            this.get_attendance();

        }
    }
</script>

<style scoped>

</style>
