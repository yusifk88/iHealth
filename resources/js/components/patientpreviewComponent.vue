<template>
    <div>
        <v-card class="text-center">
            <v-progress-circular color="blue" indeterminate v-if="progress"></v-progress-circular>
            <v-card-text class="text-left" v-else>
                <v-btn @click="$router.back()" color="blue" text><v-icon>mdi-arrow-left</v-icon>Back</v-btn>
                <h2 :class="`headline font-weight-light mb-4 blue--text`">Patient Information</h2>
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


                        <v-col cols="12" sm="3">
                            <v-list >

                                <v-list-item
                                    two-line
                                >
                                    <v-list-item-content>
                                        <v-list-item-title>{{patient.district}}</v-list-item-title>
                                        <v-list-item-subtitle>District</v-list-item-subtitle>
                                    </v-list-item-content>

                                </v-list-item>


                                <v-list-item
                                    two-line
                                >
                                    <v-list-item-content>
                                        <v-list-item-title>{{patient.occupation}}</v-list-item-title>
                                        <v-list-item-subtitle>Occupation</v-list-item-subtitle>
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
                                        <v-list-item-title>{{patient.religion}}</v-list-item-title>
                                        <v-list-item-subtitle>Religion</v-list-item-subtitle>
                                    </v-list-item-content>

                                </v-list-item>

                                <v-list-item
                                    two-line
                                >
                                    <v-list-item-content>
                                        <v-list-item-title>{{patient.marital_status}}</v-list-item-title>
                                        <v-list-item-subtitle>Marital Status</v-list-item-subtitle>
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
                                        <v-list-item-title>{{patient.insurance_scheme}}</v-list-item-title>
                                        <v-list-item-subtitle>Insurance Scheme</v-list-item-subtitle>
                                    </v-list-item-content>

                                </v-list-item>


                                <v-list-item
                                    two-line
                                >
                                    <v-list-item-content>
                                        <v-list-item-title>{{patient.relative_address}}</v-list-item-title>
                                        <v-list-item-subtitle>Relative Home Address</v-list-item-subtitle>
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
                                        <v-list-item-title>{{patient.insurance_number}}</v-list-item-title>
                                        <v-list-item-subtitle>Insurance Number</v-list-item-subtitle>
                                    </v-list-item-content>

                                </v-list-item>
                            </v-list>
                        </v-col>

                    </v-row>

                </div>
            </v-card-text>
        </v-card>

        <v-card>
            <v-card-title>
                Attendance history
            </v-card-title>

            <v-card-text>
                <v-simple-table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>OPD Number</th>
                        </tr>
                    </thead>

                    <tbody>
                    <tr v-for="attend in attendance">
                        <td>
                            <v-btn text color="blue" :to="'/opd/'+attend.id">{{attend.entry_date}}</v-btn>
                        </td>
                        <td>{{patient.opd_number}}</td>

                    </tr>

                    </tbody>
                </v-simple-table>
            </v-card-text>
        </v-card>

    </div>
</template>

<script>
    export default {
        name: "patientpreviewComponent",
        data(){
            return{
                progress:false,
                patient:null,
                attendance:[]

            }
        },
        methods:{
            get_patient(){
                this.progress=true;
                    axios.get('/api/patients/'+this.$route.params.id)
                        .then(res=>{
                            this.patient = res.data;
                            this.progress = false;
                        })
            },

            get_attendance(){
                this.progress =true;
                axios.get('/api/patientattendance/'+this.$route.params.id)
                        .then(res=>{
                            this.attendance = res.data;
                            this.progress=false;

                        })
                        .catch(error=>{

                        })

            }

        },
        mounted() {
            this.get_patient();
            this.get_attendance();

        }


    }
</script>

<style scoped>

</style>
