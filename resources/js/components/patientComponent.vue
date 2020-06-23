<template>
    <div>



        <v-card>
            <v-card-title>
                <v-text-field
                placeholder="Search.."
                v-model="search"
                outlined

                >

                </v-text-field>

            </v-card-title>

            <v-data-table
            :items="patients"
            :loading="progress"
            :items-per-page=50
            :headers="headers"
            :search="search"
            >
                <template v-slot:item.insured="{item}">
                    <v-chip small dark v-if="item.insured==1" color="green">Insured</v-chip>
                    <v-chip small dark v-else color="red">Not Insured</v-chip>
                </template>

                <template v-slot:item.age="{item}">

                    {{item.age}}Years

                </template>

                <template v-slot:item.surname="{item}">

                    <v-btn :to="'/patient/'+item.id" text color="blue" small>{{item.surname+" "+item.other_name}}</v-btn>

                </template>

                <template v-slot:item.id="{item}">
                    <v-menu
                        bottom
                        origin="center center"
                        transition="scale-transition"
                        :disabled="$store.state.user.type !='records'"
                    >
                        <template v-slot:activator="{ on }">
                            <v-btn
                                color="primary"
                                v-on="on"
                                icon
                            >
                                <v-icon>mdi-dots-horizontal</v-icon>
                            </v-btn>
                        </template>

                        <v-list>
                            <v-list-item
                                :to="'/patienr/'+item.id"

                            >
                                <v-list-item-title>View Patient</v-list-item-title>
                            </v-list-item>

                            <v-list-item
                                @click="edit(item)"

                            >
                                <v-list-item-title>Edit</v-list-item-title>
                            </v-list-item>



                            <v-list-item

                                :to="'/admit/'+item.id"
                            >
                                <v-list-item-title>New Admission</v-list-item-title>
                            </v-list-item>


                            <v-list-item
                                @click="delete_patient(item)"
                                class="text-danger"

                            >
                                <v-list-item-title class="text-danger">Delete</v-list-item-title>
                            </v-list-item>

                        </v-list>
                    </v-menu>


                </template>




            </v-data-table>
        </v-card>

        <v-dialog scrollable fullscreen v-model="add_dialog" hide-overlay transition="dialog-bottom-transition">
                <v-card tile>
                    <v-toolbar flat>
                        <v-btn icon @click="add_dialog = false">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                        <v-toolbar-title>{{editing ? 'Edit':'Create New'}} Patient</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-toolbar-items>
                            <v-btn color="blue" text @click="save_patient">Save {{editing ? 'Changes':''}}</v-btn>
                        </v-toolbar-items>
                    </v-toolbar>
                    <v-card-text>

                        <v-col cols="12" sm="8" class="mx-auto">
                            <v-subheader>Personal Information</v-subheader>
                            <v-form v-model="formvalid" ref="patient_form" @keyup.native.enter="save_patient">
                                <v-row>
                                    <v-col cols="12" sm="6">
                                      <v-chip color="success">OPD#: {{opd_number}}</v-chip>
                                    </v-col>
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
                                                    v-model="date"
                                                    label="Attendance Date"
                                                    outlined
                                                    v-on="on"

                                                ></v-text-field>
                                            </template>
                                            <v-date-picker v-model="date" no-title @input="date_menu = false"></v-date-picker>
                                        </v-menu>

                                    </v-col>
                                </v-row>
                            <v-row>


                                <v-col cols="12" sm="6">
                                    <v-text-field
                                        label="Surname"
                                        v-model="surname"
                                        type="text"
                                        outlined
                                        :rules="[rules.required]"
                                        hint="Strictly Required"
                                        persistent-hint
                                    ></v-text-field>
                                </v-col>

                                <v-col cols="12" sm="6">
                                    <v-text-field
                                        label="other Names"
                                        v-model="other_name"
                                        outlined
                                        type="text"
                                        :rules="[rules.required]"
                                        hint="Strictly Required"
                                        persistent-hint

                                    ></v-text-field>
                                </v-col>

                                <v-col>

                                    <v-menu
                                        ref="menu1"
                                        v-model="dob_menu"
                                        :close-on-content-click="false"
                                        transition="scale-transition"
                                        offset-y
                                        max-width="290px"
                                        min-width="290px"
                                    >
                                        <template v-slot:activator="{ on }">
                                            <v-text-field
                                                v-model="dob"
                                                label="Date of Birth"
                                                outlined
                                                v-on="on"
                                                :rules="[rules.required]"
                                                hint="Strictly Required"
                                                persistent-hint
                                            ></v-text-field>
                                        </template>
                                        <v-date-picker @change="calc_age" v-model="dob" no-title @input="dob_menu = false"></v-date-picker>
                                    </v-menu>

                                </v-col>

                                <v-col>
                                    <v-text-field
                                        label="Age"
                                        v-model="age"
                                        outlined
                                        type="number"
                                    ></v-text-field>

                                </v-col>

                                <v-col>
                                    <v-select
                                        label="Sex"
                                        v-model="sex"
                                        outlined
                                     :items="sex_items"
                                    ></v-select>

                                </v-col>

                                <v-col>
                                    <v-select
                                        label="Marital Status"
                                        v-model="marital_status"
                                        outlined
                                        :items="marital_status_items"
                                    ></v-select>

                                </v-col>


                            </v-row>

                                <v-row>
                                    <v-col cols="12" sm="4">

                                        <v-select
                                            label="Religion"
                                            v-model="religion"
                                            :items="religion_items"
                                            outlined
                                        ></v-select>


                                    </v-col>

                                    <v-col cols="12" sm="8">

                                      <v-text-field
                                      label="Occupation"
                                      v-model="occupation"
                                      outlined
                                      ></v-text-field>

                                    </v-col>

                                </v-row>
                                <v-subheader>Contact Information</v-subheader>


                                <v-row>
                                    <v-col cols="12" sm="6">
                                        <v-textarea
                                        label="Postal Address"
                                        v-model="postal_address"
                                        outlined
                                        >

                                        </v-textarea>

                                    </v-col>

                                    <v-col cols="12" sm="6">
                                        <v-textarea
                                        label="Home Address"
                                        v-model="home_address"
                                        outlined
                                        :rules="[rules.required]"
                                        hint="Strictly Required"
                                        persistent-hint
                                        >

                                        </v-textarea>

                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col cols="12" sm="4">
                                        <v-text-field
                                            label="E-Mail Address"
                                            v-model="email"
                                            outlined
                                            type="email"
                                        ></v-text-field>
                                    </v-col>

                                    <v-col cols="12" sm="4">
                                        <v-text-field
                                            label="Phone Number"
                                            v-model="phone_number"
                                            outlined
                                            type="tel"
                                        ></v-text-field>
                                    </v-col>


                                    <v-col cols="12" sm="4">
                                        <v-text-field
                                            label="Nearest Relative Name"
                                            v-model="relative"
                                            outlined
                                        ></v-text-field>
                                    </v-col>



                                    <v-col cols="12" sm="6">
                                        <v-textarea
                                            label="Nearest Relative Address"
                                            v-model="relative_address"
                                            outlined
                                            hint="Contact address of nearest relative"
                                            persistent-hint
                                        ></v-textarea>
                                    </v-col>

                                    <v-col cols="12" sm="6">
                                        <v-autocomplete
                                            label="Nationality"
                                            v-model="nationality_id"
                                            :items="nationalities"
                                            item-value="id"
                                            item-text="title"
                                            outlined
                                        ></v-autocomplete>
                                    </v-col>

                                    <v-col cols="12" sm="6">
                                        <v-text-field
                                            label="District"
                                            v-model="district"
                                            outlined
                                        ></v-text-field>
                                    </v-col>

                                    <v-col cols="12" sm="6">
                                        <v-text-field
                                            label="Location"
                                            v-model="location"
                                            outlined
                                        ></v-text-field>
                                    </v-col>

                                </v-row>


                                <v-subheader>Insurance Information</v-subheader>
                                <v-row>

                                    <v-col cols="12" sm="4">
                                        <v-switch
                                        v-model="insured"
                                        label="Insured"
                                        ></v-switch>
                                    </v-col>
                                </v-row>


                                <v-row>

                                    <v-col cols="12" sm="4">
                                        <v-text-field
                                        v-model="health_insurance"
                                        label="Name of health insurance"
                                        outlined
                                        :disabled="!insured"
                                        ></v-text-field>
                                    </v-col>


                                    <v-col cols="12" sm="4">
                                        <v-text-field
                                        v-model="insurance_number"
                                        label="Health Insurance Number"
                                        outlined
                                        :disabled="!insured"

                                        ></v-text-field>
                                    </v-col>


                                    <v-col cols="12" sm="4">
                                        <v-text-field
                                        v-model="insurance_id"
                                        label="Health Insurance Scheme ID"
                                        outlined
                                        :disabled="!insured"

                                        ></v-text-field>
                                    </v-col>
                                </v-row>

                            </v-form>

                        </v-col>



                    </v-card-text>


                    <v-bottom-navigation
                        absolute
                        horizontal
                    >
                        <v-btn :loading="progress" text color="blue accent-4" @click="save_patient">
                            <span>Save {{editing ? 'Changes':''}}</span>
                            <v-icon>mdi-content-save-all-outline</v-icon>
                        </v-btn>

                        <v-btn v-if="!editing" :loading="progress" text color="blue accent-4" @click="clear=true; save_patient();">
                            <span>Save & Add Another</span>
                            <v-icon>mdi-content-save-all-outline</v-icon>
                        </v-btn>

                        <v-btn text color="red accent-4" @click="add_dialog=false">
                            <span>Close</span>
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </v-bottom-navigation>


                </v-card>

        </v-dialog>

<v-snackbar
    color="error"
    dark
    v-model="error_message"

>{{error_msg}}</v-snackbar>


        <v-snackbar
    dark
    v-model="success_message"

>{{success_msg}}</v-snackbar>


        <v-btn
            color="blue"
            dark
            bottom
            right
            rounded
            absolute
            fixed
            @click="add_dialog = !add_dialog; editing = false; clear_fields();"
            v-if="$store.state.user.type =='records'"
            style="z-index:9999"

        >
            New <v-icon>mdi-plus</v-icon>

        </v-btn>

        <v-dialog v-model="delete_dialog" width="500">
            <v-card>
                <v-card-title>Confirm Delete</v-card-title>
                <v-card-text>Are you sure you want to delete this patient?</v-card-text>
                <v-card-actions>
                    <v-btn :loading="progress" color="red" text @click="remove_patient">Delete</v-btn>
                    <v-btn text @click="delete_dialog = false">Cancel</v-btn>
                </v-card-actions>
            </v-card>

        </v-dialog>


    </div>




</template>

<script>
    import moment from 'moment';
    export default {
        name: "patientComponent",
        data(){
            return{
                editing:false,
                search:'',
                success_msg:'',
                success_message:false,
                clear:false,
                opd_number:'',
                error_msg:'',
                error_message:false,
                date:'',
                date_menu:false,
                phone_number:'',
                patients:[],
                id:null,

                progress:false,
                formvalid:false,
                nationality_id:64,
                health_insurance:'',
                insurance_number:'',
                insurance_id:'',
                insured:true,
                relative:'',
                relative_address:'',
                district:'',
                location:'',
                postal_address:'',
                home_address:'',
                occupation:'',
                dob_menu:false,
                add_dialog:false,
                dob:'',
                surname:'',
                other_name:'',
                sex:'M',
                marital_status:'Single',
                sex_items:[
                    {
                        value:'M',
                        text:'Male'
                    },
                    {
                        value:'F',
                        text:'Female'
                    },


                ],
                marital_status_items:[
                    {
                        value:'Single',
                        text:'Single'
                    },
                    {
                        value:'Married',
                        text:'Married'
                    },
                    {

                        value:'Divorced',
                        text:'Divorced'
                    },
                    {

                        value:'Widowed',
                        text:'Widowed'
                    },
                    {

                        value:'Other',
                        text:'Other'
                    },

                ],

                religion_items:[
                    {
                        value:'Christianity',
                        text:'Christianity'
                    },
                    {
                        value:'Islam',
                        text:'Islam'
                    },
                    {

                        value:'Tradition',
                        text:'Tradition'
                    },
                    {

                        value:'Other',
                        text:'Other'
                    },

                ],
                age:0,
                religion:'Islam',
                nationalities:[],
                email:'',
                rules: {
                    required: value => !!value || 'Required.',
                    counter: value => value.length <= 20 || 'Max 20 characters',
                    email: value => {
                        const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                        return pattern.test(value) || 'Invalid e-mail.'
                    }
                },
                headers:[
                    {
                        value:'surname',
                        text:'Name'
                    },
                    {
                        value:'opd_number',
                        text:'OPD#'
                    } ,

                    {
                        value:'dob',
                        text:'Date Of Birth'
                    },

                    {
                        value:'age',
                        text:'Age'
                    } ,
                    {
                        value:'sex',
                        text:'Sex'
                    } ,
                    {
                        value:'phone_number',
                        text:'Phone Number'
                    },

                    {
                        value:'attendance_date',
                        text:'Attendance Date'
                    },
                    {
                        value:'insured',
                        text:'Insurance Status',
                        align:'center'
                    },

                    {
                        value:'id',
                        text:'Action',
                        align:'center'
                    }
                ],
                delete_dialog:false,

            }
        },
        methods:{
            calc_age(){
              this.age = moment().diff(this.dob,'years');
            },
            remove_patient(){
                this.progress = true;

                axios.delete('/api/patients/'+this.id)
                    .then(res=>{
                        this.progress = true;

                        this.delete_dialog = false;
                        this.get_patients();

                    })
                .catch(error=>{

                });

            },
            delete_patient(patient){
              this.id= patient.id;
              this.delete_dialog = true;
            },
            edit(patient){
              this.surname = patient.surname;
              this.other_name = patient.other_name;
              this.phone_number = patient.phone_number;
              this.opd_number = patient.opd_number;
              this.insurance_number = patient.insurance_number;
              this.health_insurance = patient.health_insurance;
              this.sex = patient.sex;
              this.marital_status= patient.marital_status;
              this.relative= patient.relative;
              this.relative_address= patient.relative_address;
              this.dob= patient.dob;
              this.age= patient.age;
              this.date= patient.attendance_date;
              this.occupation= patient.occupation;
              this.district= patient.district;
              this.nationality_id= patient.nationality_id;
              this.health_insurance = patient.insurance_scheme;
              this.religion= patient.religion;
              this.home_address= patient.home_address;
              this.postal_address= patient.postal_address;
              this.occupation= patient.occupation;
              this.location= patient.location;
              this.district= patient.district;
              this.email= patient.email;
              this.postal_address= patient.postal_address;
              this.insured = patient.insured;
              this.editing=true;
              this.id = patient.id;

              this.add_dialog = true;



            },
            clear_fields(){
                this.surname ="";
                this.other_name ="";
                this.dob ="";
                this.sex ="";
                this.age ="";
                this.postal_address ="";
                this.home_address ="";
                this.email ="";
                this.relative ="";
                this.relative_address ="";
                this.district ="";
                this.location ="";
                this.phone_number ="";
                this.health_insurance ="";
                this.insurance_number ="";
                this.insurance_id ="";
                this.nationality_id =64;
            },
            save_patient(){

                if(this.$refs.patient_form.validate()){

                    if(this.insured){

                        if(!this.insurance_number){
                            this.error_msg="Insured patients must have an insurance number";
                            this.error_message = true;
                            return false;

                        }
                        if(!this.health_insurance){
                            this.error_msg="Insured patients must have a health insurance scheme";
                            this.error_message = true;
                            return false;

                        }

                    }



                    this.progress = true;


                    const formdata = new FormData();


                    formdata.append('surname',this.surname);
                    formdata.append('other_name',this.other_name);
                    formdata.append('dob',this.dob);
                    formdata.append('sex',this.sex);
                    formdata.append('age',this.age);
                    formdata.append('marital_status',this.marital_status);
                    formdata.append('occupation',this.occupation);
                    formdata.append('religion',this.religion);
                    formdata.append('postal_address',this.postal_address);
                    formdata.append('home_address',this.home_address);
                    formdata.append('email',this.email);
                    formdata.append('relative_name',this.relative);
                    formdata.append('relative_address',this.relative_address);
                    formdata.append('district',this.district);
                    formdata.append('location',this.location);
                    formdata.append('phone_number',this.phone_number);
                    formdata.append('insurance_scheme',this.health_insurance);
                    formdata.append('insurance_number',this.insurance_number);
                    formdata.append('insurance_id',this.insurance_id);
                    formdata.append('attendance_date',this.date);
                    formdata.append('insured',this.insured ? 1 : 0);
                    formdata.append('nationality_id',this.nationality_id);
                    formdata.append('opd_number',this.opd_number);


                    if(this.editing){

                        axios.post('/api/patients/'+this.id,formdata)
                            .then(res=>{
                                this.progress = false;
                                this.get_patients();
                                this.$router.push({path:'/patient/'+this.id});
                                this.get_opd();

                            })
                        .catch(error=>{


                        });

                    }else{


                    axios.post('/api/patient',formdata)
                        .then(res=>{
                            this.progress =false;
                            if(this.clear){

                                this.clear_fields();

                            }else{
                                this.clear_fields();

                                this.add_dialog = false;

                            }
                            this.get_opd();
                            this.get_patients();
                            this.success_msg="Patient created successfully";
                            this.success_message = true;

                        })
                    .catch(error=>{


                    });
                    }


                }

            },

            get_nationalities(){
                axios.get('/api/nationalities')
                    .then(res=>{
                        this.nationalities = res.data;

                    })
                .catch(error=>{

                });
            },
            get_opd(){

                axios.get('/api/opd')
                    .then(res=>{
                        this.opd_number=res.data

                    })
                .catch(error=>{

                })
            },
            get_patients(){
                this.progress= true;

                axios.get('/api/patients')
                    .then(res=>{
                        this.progress = false;
                        this.patients = res.data;

                    })
                .catch(error=>{

                });

            }
        },
        mounted() {
            this.get_patients();
            this.get_nationalities();
            this.get_opd();
            this.date = moment().format('YYYY-MM-DD');
        }
    }
</script>

<style scoped>

</style>
