<template>


    <v-row>
        <v-col cols="12" sm="12" v-if="$store.state.user.type == 'opd'">

    <v-timeline clipped dense>


        <v-timeline-item
            large
            right
            icon="mdi-pencil"
            color="amber"
        >
            <template v-slot:opposite>
        <span
            O.P.D

        ></span>
            </template>
            <v-card color="amber" dark>
                <v-card-text>

                    <h1>New Attendance</h1>
                </v-card-text>
            </v-card>
        </v-timeline-item>


        <v-timeline-item
            large
            right
            icon="mdi-account"
        >
            <template v-slot:opposite>
        <span
            O.P.D

        ></span>
            </template>
            <v-card>
                <v-card-text>
                <h2 :class="`headline font-weight-light mb-4 blue--text`">Patient Information</h2>
                    <v-chip dark v-if="patient.insured == 1" color="success">Insured</v-chip>
                    <v-chip dark v-else color="red">Not Insured</v-chip>
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
        </v-timeline-item>


        <v-timeline-item
            large
            right
            icon="mdi-thermometer"
            color="cyan"
        >
            <template v-slot:opposite>
        <span
            O.P.D

        ></span>
            </template>
            <v-card>
                <v-card-text>
                <h2 :class="`headline font-weight-light mb-4 cyan--text`">OPD</h2>

                <div>

                  <OPDComponent></OPDComponent>

                </div>
                </v-card-text>
            </v-card>
        </v-timeline-item>

    </v-timeline>
    </v-col>


        <v-col cols="12" sm="12" v-else>
            <v-alert type="error">
                <h4>Your user role is not allowed to manage OPD</h4>
            </v-alert>

    </v-col>


    </v-row>

</template>

<script>
    import OPDComponent from "./partials/OPDComponent";
    import ConsultingComponent from "./partials/consultingComponent";
    export default {
        name: "admissionComponent",
        components: {ConsultingComponent, OPDComponent},
        data(){
            return{
                patient:{}
            }
        },
        methods:{
            get_patient(){
                axios.get('/api/patients/'+this.$route.params.id)
                    .then(res=>{
                        this.patient = res.data;
                        this.$store.state.patient = res.data;
                    })
                .catch(error=>{


                });
            }

        },
        mounted(){
            this.get_patient();

        }
    }
</script>

<style scoped>

</style>
