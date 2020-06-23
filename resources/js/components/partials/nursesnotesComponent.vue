<template>
    <div>
        <v-card>
            <v-card-title>
                Nurses Notes <v-spacer></v-spacer>
                <v-btn @click="get_notes;" class="m-3"   color="blue" outlined ><v-icon>mdi-reload</v-icon> Reload</v-btn>
                <v-btn v-if="$store.state.user.type=='nurse'" @click="add_dialog=true" class="m-3"   color="blue" dark ><v-icon>mdi-plus</v-icon>new</v-btn>
            </v-card-title>

            <v-card-text>
                <v-alert type="warning">
                    <ul>
                        <li>Only users assigned the role of a nurse are allowed append notes to patients</li>
                        <li>You are only allowed to delete records that you entered</li>
                    </ul>

                </v-alert>
            </v-card-text>

            <v-card-text>
                <v-simple-table>
                    <thead>
                        <tr>
                            <th>DateTime</th>
                            <th>Note</th>
                            <th>Nurse</th>
                            <th>action</th>
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
                        <td>
                            <v-btn
                                @click="delete_note(note)"
                                x-small color="red"
                                text
                                :disabled="$store.state.user.id != note.staff_id"

                            >Delete</v-btn>
                        </td>

                    </tr>

                    </tbody>
                </v-simple-table>
            </v-card-text>
        </v-card>
        <v-dialog width="400" v-model="delete_dialog">
            <v-card>
                <v-card-text>
                    <h4>Do you want to delete this note record?</h4>
                </v-card-text>
                <v-card-actions>
                    <v-btn :loading="progress" text color="red" @click="remove_note()">Delete</v-btn>
                    <v-btn text @click="delete_dialog=false">Cancel</v-btn>
                </v-card-actions>

            </v-card>

        </v-dialog>


        <v-dialog width="80%" v-model="add_dialog" persistent>
            <v-card>
                <v-card-title>Record a note</v-card-title>
                <v-card-text>
                    <v-form>
                    <vue-editor
                        outlined
                        v-model="note"
                        label="Record your note"
                    >
                    </vue-editor>
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn text color="blue" @click="savenote()" :loading="progress">Save</v-btn>
                    <v-btn text @click="add_dialog=false">Cancel</v-btn>
                </v-card-actions>
            </v-card>


        </v-dialog>
    </div>
</template>

<script>
    import { VueEditor } from "vue2-editor";

    export default {
        name: "nursesnotesComponent",
        components:{
            VueEditor
        },
        data(){
            return{
                add_dialog:false,
                note:'',
                progress:false,
                notes:[],
                delete_dialog:false,
                id:null,


            }
        },
        methods:{

            get_notes(){

                axios.get('/api/nursesnote/'+this.$route.params.id)
                    .then(res=>{

                        this.notes = res.data;
                    })
                .catch(error=>{

                });
            },

            savenote(){

                if (this.note){
                    this.progress=true;
                    let formdata = new FormData();
                        formdata.append('attendance_id',this.$route.params.id);
                        formdata.append('note',this.note);


                    axios.post('/api/nursesnote',formdata)
                        .then(res=>{
                            this.progress=false;
                            this.get_notes();
                            this.add_dialog= false;
                            this.note="";


                        })
                        .catch(error=>{

                        });

                }

            },
            remove_note(){

                axios.delete('/api/nursesnote/'+this.id)
                        .then(res=>{
                            this.progress=false;
                            this.delete_dialog=false;
                            this.get_notes();

                        })
                        .catch(error=>{

                        });

            },

            delete_note(note){
                this.id  = note.id;
                this.delete_dialog=true;


            }
        },
        mounted() {

            this.get_notes();

        }
    }
</script>

<style scoped>

</style>
