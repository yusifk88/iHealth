<template>


    <v-row>
        <v-col cols="12" sm="12">


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

                    <h1>New Admission</h1>
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


        <v-timeline-item
            large
            right
            icon="mdi-doctor"
            color="red"
        >
            <template v-slot:opposite>
        <span
            O.P.D

        ></span>
            </template>
            <v-card>
                <v-card-text>
                <h2 :class="`headline font-weight-light mb-4 red--text`">Consulting</h2>

                <div>

                    <h1>consulting form goes here</h1>

                </div>
                </v-card-text>
            </v-card>
        </v-timeline-item>

        <v-timeline-item
            large
            right
            icon="mdi-test-tube"
            color="success"
        >
            <template v-slot:opposite>
        <span


        >
            O.P.D
        </span>
            </template>
            <v-card>
                <v-card-text>
                <h2 :class="`headline font-weight-light mb-4 green--text`">Laboratory</h2>

                <div>

                    <h1>Laboratory form goes here</h1>

                </div>
                </v-card-text>
            </v-card>
        </v-timeline-item>


        <v-timeline-item
            large
            right
            icon="mdi-pill"
            color="purple"
        >
            <template v-slot:opposite>
        <span
            v-text="'OPD'"

        >
        </span>
            </template>
            <v-card>
                <v-card-text>
                <h2 :class="`headline font-weight-light mb-4 purple--text`">Dispensing</h2>

                <div>

                    <h1>dispensing form goes here</h1>

                </div>
                </v-card-text>
            </v-card>
        </v-timeline-item>

    </v-timeline>
    </v-col>
    </v-row>

</template>

<script>
    import OPDComponent from "./partials/OPDComponent";
    export default {
        name: "admissionComponent",
        components: {OPDComponent},
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
