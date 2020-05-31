<template>

    <div>


        <v-card class="text-center">
            <v-progress-circular color="blue" indeterminate v-if="progress"></v-progress-circular>
            <v-card-text class="text-left" v-else>
                <h2 :class="`headline font-weight-light mb-4 blue--text`">Patient Information</h2>
                <v-chip dark v-if="patient.insured == 1" color="success">Insured</v-chip>
                <v-chip dark v-else color="red">Not Insured</v-chip>

                <v-chip>OPD#{{patient.opd_number}}</v-chip> <v-chip color="amber">CC Code: {{vitals.cc_code}}</v-chip>
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
        <v-alert type="warning" v-show="editing">
            You are in editing mode, this record already exist
        </v-alert>

        <v-alert type="warning" v-show="!editing">
            Your user role is not allowed to edit this record. You are in viewing mode
        </v-alert>

        <v-expansion-panels :value=0 >
            <v-expansion-panel


            >
                <v-expansion-panel-header class="text-primary">View Vitals</v-expansion-panel-header>
                <v-expansion-panel-content>

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
                            <td v-if="editing">
                                <v-text-field  v-model="vitals.temperature" label="Temperature" prepend-inner-icon="mdi-temperature-celsius"></v-text-field>
                            </td>
                            <td v-else>
                                {{vitals.temperature}}<v-icon>mdi-temperature-celsius</v-icon>

                            </td>
                            <td v-if="editing">
                                <v-text-field  v-model="vitals.temperature_remarks" label="Temperature Remarks"></v-text-field>
                            </td>

                            <td v-else>{{vitals.temperature_remarks}}</td>

                        </tr>

                        <tr>
                            <td>Weight</td>
                            <td v-if="editing">
                                <v-text-field  v-model="vitals.weight" label="Weight" prefix="kg"></v-text-field>
                            </td>
                            <td v-else>{{vitals.weight}}kg</td>
                            <td v-if="editing">
                                <v-text-field  v-model="vitals.weight_remarks" label="Weight Remarks" ></v-text-field>
                            </td>
                            <td v-else>{{vitals.weight_remarks}}</td>

                        </tr>

                        <tr>
                            <td>Blood Pressure</td>
                            <td v-if="editing">
                                <v-text-field  v-model="vitals.bp" label="Blood Pressure" prefix="mmhg"></v-text-field>
                            </td>
                            <td v-else>{{vitals.bp}}mmhg</td>
                            <td v-if="editing">
                                <v-text-field  v-model="vitals.bp_remarks" label="Blood Pressure Remarks"></v-text-field>
                            </td>

                            <td v-else>{{vitals.bp_remarks}}</td>

                        </tr>

                        <tr>
                            <td>Height</td>
                            <td v-if="editing">
                                <v-text-field  v-model="vitals.height" label="Height" prefix="m"></v-text-field>
                            </td>
                            <td v-else>{{vitals.height}}m</td>

                            <td v-if="editing">
                                <v-text-field  v-model="vitals.height_remarks" label="Height Remarks" ></v-text-field>
                            </td>
                            <td v-else>{{vitals.height_remarks}}</td>

                        </tr>


                        <tr>
                            <td>Pulse</td>
                            <td v-if="editing">
                                <v-text-field  v-model="vitals.pulse" label="Pulse" prefix="bpm"></v-text-field>
                            </td>
                            <td v-else>{{vitals.pulse}}bpm</td>
                            <td v-if="editing">
                                <v-text-field  v-model="vitals.pulse_remarks" label="Pulse Remarks"></v-text-field>
                            </td>
                            <td v-else>{{vitals.pulse_remarks}}</td>

                        </tr>

                        <tr>
                            <td>Respiration</td>
                            <td v-if="editing">
                                <v-text-field  v-model="vitals.respiration" label="Respiration" prefix="bpm"></v-text-field>
                            </td>
                            <td v-else>{{vitals.respiration}}bpm</td>
                            <td v-if="editing">
                                <v-text-field  v-model="vitals.respiration_remarks" label="Respiration Remarks"></v-text-field>
                            </td>
                            <td v-else>{{vitals.respiration_remarks}}</td>

                        </tr>
                       </tbody>
                    </v-simple-table>

                    <v-btn @click="save_changes()" :loading="progress" color="blue" block dark>Save Changes</v-btn>

                </v-expansion-panel-content>
            </v-expansion-panel>
        </v-expansion-panels>

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
    export default {
        name: "patientprofileComponent",
        props:['patientId','attendanceId'],
        data(){
          return{
              patient:{},
              progress:false,
              vitals:{},
              editing:false,
              error_message:false,
              error_msg:'',
              success_message:false,
              success_msg:'',

          }
        },
        methods:{
            save_changes(){
                this.progress = true;

                const formData = new FormData();

                formData.append('temperature',this.vitals.temperature);
                formData.append('temperature_remarks',this.vitals.temperature_remarks ? this.vitals.temperature_remarks : '' );
                formData.append('weight_remarks',this.vitals.weight_remarks ? this.vitals.weight_remarks : '' );
                formData.append('weight',this.vitals.weight);
                formData.append('pulse',this.vitals.pulse);
                formData.append('pulse_remarks',this.vitals.pulse_remarks ? this.vitals.pulse_remarks : '' );
                formData.append('height',this.vitals.height);
                formData.append('height_remarks',this.vitals.height_remarks ? this.vitals.height_remarks : '');
                formData.append('respiration',this.vitals.respiration);
                formData.append('respiration_remarks',this.vitals.respiration_remarks ? this.vitals.respiration_remarks : '');
                formData.append('bp',this.vitals.bp);
                formData.append('bp_remarks',this.vitals.bp_remarks ? this.vitals.bp_remarks : '' );

                axios.post('/api/vitals/'+this.vitals.id,formData)
                        .then(res=>{
                            this.progress=false;
                            this.$router.back();

                        })
                .catch(error=>{

                    this.progress=false;
                    this.error_msg="Something went wrong, could not save changes. please check you connection";
                    this.error_message=true;


                });


            },
            get_opd() {
                axios.get('/api/opd/' + this.attendanceId)
                    .then(res => {

                        this.vitals = JSON.parse(JSON.stringify(res.data));

                    })
            },

            get_patient(){
                this.progress=true;


                if(this.patienId){
                    axios.get('/api/patient/'+this.patientId)
                        .then(res=>{
                            this.patient = res.data;
                            this.progress = false;
                        })

                }else{
                    axios.get('/api/patientbyopd/'+this.attendanceId)
                        .then(res=>{
                            this.patient = res.data;
                            this.progress = false;
                        })

                }

            }

        },
        mounted() {


            if(this.$store.state.user.type == 'opd'){
                this.editing = true;

            }

            this.get_patient();
            this.get_opd();

        }
    }
</script>

<style scoped>

</style>
