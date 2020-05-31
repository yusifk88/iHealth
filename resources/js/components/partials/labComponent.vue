<template>
    <div>

        <patientprofileComponent :attendance-id="$route.params.id" ></patientprofileComponent>


        <v-alert
        type="info"
        >
            If this is your first entry under laboratory data for this patient please prescribe the lab. test and
            capture the results later or capture both at the same time

        </v-alert>
        <v-alert type="warning" v-show="editing" v-if="auth">
            You are in editing mode, this record already exist
        </v-alert>

        <v-alert type="warning" v-show="!auth">
            Your user role is not allowed to edit this record. You are in viewing mode
        </v-alert>


        <v-progress-circular color="blue" size="120" indeterminate v-if="progress"></v-progress-circular>

      <div v-else>
        <label>Prescribe Lab tests</label>
            <vue-editor v-if="auth" v-model="tests"></vue-editor>
          <div class="border" v-if="!auth" v-html="tests">
          </div>
        <p></p>


        <label>Tests Results</label>
        <vue-editor v-if="auth" v-model="results"></vue-editor>
          <div class="border" v-if="!auth" v-html="results">
          </div>

      </div>

        <v-btn v-if="auth" :loading="progress" @click="save_lab()" dark class="m-2" color="blue">Save {{editing ? 'Changes' :''}}</v-btn>

    </div>

</template>

<script>
    import { VueEditor } from "vue2-editor";
    import patientprofileComponent from "./patientprofileComponent";

    export default {
        name: "labComponent",
        components:{
            VueEditor,
            patientprofileComponent
        },
        data(){
            return{
                tests:'',
                results:'',
                id:null,
                progress:false,
                editing:false,
                lab:null,
                auth:false,
            }
        },
        methods: {

            save_lab() {


                this.progress = true;

                let formData = new FormData();
                formData.append('tests', this.tests);
                formData.append('results', this.results);
                formData.append('opd_id', this.$route.params.id);

                if (!this.editing) {

                    axios.post('/api/lab', formData)
                        .then(res => {
                            this.$router.back();
                            this.progress = false;


                        })
                    .catch(error => {
                        this.progress = false;
                })

                } else {


                    axios.post('/api/lab/' + this.id, formData)
                        .then(res => {
                            this.$router.back();
                            this.progress = false;

                        })
                }
            },


            get_attendance() {
                this.progress=true;
                axios.get('/api/opd/'+this.$route.params.id)
                    .then(res=>{
                        this.lab = res.data.lab;
                        if(res.data.lab_status){
                            this.editing = true;
                            this.id = res.data.lab.id;
                            this.tests = res.data.lab.tests;
                            this.results = res.data.lab.results;
                        }

                        this.progress = false;
                    });

            }



        },


        mounted() {

            if(this.$store.state.user.type == 'lab'){
                this.auth = true;

            }


            this.get_attendance();
        }
    }
</script>

<style scoped>

</style>
