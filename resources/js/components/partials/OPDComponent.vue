<template>

    <div>
        <v-card flat>
            <v-form ref="patient_form" v-model="form_valid" @keyup.native.enter="save_opd">
                <v-row>

                    <v-col cols="12" sm="4">
                        <v-menu
                            ref="menu1"
                            v-model="date_menu"
                            :close-on-content-click="false"
                            transition="scale-transition"
                            offset-y
                            max-width="290px"
                            min-width="290px"
                        >
                            <template v-slot:activator="{ on }">
                                <v-text-field
                                    v-model="entry_date"
                                    label="Date of Admission"
                                    outlined
                                    v-on="on"
                                    :rules="[rules.required]"
                                    hint="Strictly Required"
                                    persistent-hint
                                ></v-text-field>
                            </template>
                            <v-date-picker  v-model="entry_date" no-title @input="date_menu = false"></v-date-picker>
                        </v-menu>


                    </v-col>

                    <v-col cols="12" sm='4'>
                        <v-text-field
                        type="text"
                        label="CC Code"
                        v-model="cc_code"
                        outlined
                        ></v-text-field>
                    </v-col>


                    <v-col cols="4" class="text-center" v-if="$store.state.patient">
                        <v-avatar>
                            <v-img src="/img/photo.png"></v-img>
                        </v-avatar> <br>
                        OPD#: {{$store.state.patient.opd_number}}

                    </v-col>
                </v-row>

                <v-row>
                    <v-col cols="12" sm="2">
                        <v-text-field
                            type="number"
                            label="Temperature"
                            v-model="temperature"
                            prepend-inner-icon="mdi-temperature-celsius"
                            :rules="[rules.required]"
                            hint="Strictly Required"
                            persistent-hint
                            outlined
                        >

                        </v-text-field>
                    </v-col>


                    <v-col cols="12" sm="10">
                        <v-text-field
                            type="text"
                            label="Remarks"
                            v-model="temperature_remarks"
                            outlined
                        >

                        </v-text-field>
                    </v-col>
                </v-row>



                <v-row>
                    <v-col cols="12" sm="2">
                        <v-text-field
                            type="number"
                            label="Weight"
                            v-model="weight"
                            outlined
                            prefix="kg"
                            :rules="[rules.required]"
                            hint="Strictly Required"
                            persistent-hint
                        >

                        </v-text-field>
                    </v-col>


                    <v-col cols="12" sm="10">
                        <v-text-field
                            type="text"
                            label="Remarks"
                            v-model="weight_remarks"
                            outlined
                        >

                        </v-text-field>
                    </v-col>
                </v-row>

                <v-row>
                    <v-col cols="12" sm="2">
                        <v-text-field
                            type="text"
                            label="Blood Pressure"
                            v-model="bp"
                            outlined
                            prefix="mmhg"
                            :rules="[rules.required]"
                            hint="Strictly Required"
                            persistent-hint
                        >

                        </v-text-field>
                    </v-col>


                    <v-col cols="12" sm="10">
                        <v-text-field
                            type="text"
                            label="Remarks"
                            v-model="bp_remarks"
                            outlined
                        >

                        </v-text-field>
                    </v-col>
                </v-row>

                <v-row>
                    <v-col cols="12" sm="2">
                        <v-text-field
                            type="number"
                            label="Height"
                            v-model="height"
                            outlined
                            prefix="m"
                        >

                        </v-text-field>
                    </v-col>


                    <v-col cols="12" sm="10">
                        <v-text-field
                            type="text"
                            label="Remarks"
                            v-model="height_remarks"
                            outlined
                        >

                        </v-text-field>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" sm="2">
                        <v-text-field
                            type="number"
                            label="Pulse"
                            v-model="pulse"
                            outlined
                            prefix="bpm"
                            :rules="[rules.required]"
                            hint="Strictly Required"
                            persistent-hint
                        >

                        </v-text-field>
                    </v-col>


                    <v-col cols="12" sm="10">
                        <v-text-field
                            type="text"
                            label="Remarks"
                            v-model="pulse_remarks"
                            outlined
                        >

                        </v-text-field>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" sm="2">
                        <v-text-field
                            type="number"
                            label="Respiration"
                            v-model="respiration"
                            outlined
                            prefix="cpm"
                        >

                        </v-text-field>
                    </v-col>


                    <v-col cols="12" sm="10">
                        <v-text-field
                            type="text"
                            label="Remarks"
                            v-model="respiration_remarks"
                            outlined
                        >

                        </v-text-field>
                    </v-col>
                </v-row>
            </v-form>
            <v-btn :loading="progress" color="cyan" block dark @click="save_opd">Save</v-btn>

        </v-card>

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
    import moment from 'moment';
    export default {
        name: "OPDComponent",
        props:['attendanceId'],
        data(){
            return{
                error_message:false,
                error_msg:'',
                success_msg:'',
                success_message:false,

                progress:false,
                form_valid:false,
                cc_code:'',

                temperature:0,
                temperature_remarks:'',
                height:0,
                height_remarks:'',
                bp:0,
                bp_remarks:'',
                weight:0,
                weight_remarks:'',
                pulse:0,
                pulse_remarks:'',
                respiration:0,
                respiration_remarks:'',
                date_menu:false,
                entry_date:'',
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

            save_opd(){
                if(this.$refs.patient_form.validate())
                {
                    this.progress = true;

                    const formdata = new FormData();
                    formdata.append('patient_id',this.$route.params.id);
                    formdata.append('entry_date',this.entry_date);
                    formdata.append('temperature',this.temperature);
                    formdata.append('bp',this.bp);
                    formdata.append('cc_code',this.cc_code);
                    formdata.append('weight',this.weight);
                    formdata.append('height',this.height);
                    formdata.append('pulse',this.pulse);
                    formdata.append('respiration',this.respiration);
                    formdata.append('temperature_remarks',this.temperature_remarks);
                    formdata.append('bp_remarks',this.bp_remarks);
                    formdata.append('height_remarks',this.height_remarks);
                    formdata.append('pulse_remarks',this.pulse_remarks);
                    formdata.append('respiration_remarks',this.respiration_remarks);

                    axios.post('/api/opd',formdata)
                        .then(res=>{

                            this.progress = false;
                            this.$router.push({
                                path:'/vitals/'+res.data.id
                            })

                        })
                    .catch(error=>{
                        this.progress =false;
                        if(error.response.status ==302){
                            this.error_msg = error.response.data;
                        }else{
                            this.error_msg = "ERROR: Something went wrong, please check your connection and try again";

                        }
                        this.error_message = true;


                    });


                }

            }
        },
        mounted() {
            this.entry_date = moment().format('YYYY-MM-DD');

        }
    }
</script>

<style scoped>

</style>
