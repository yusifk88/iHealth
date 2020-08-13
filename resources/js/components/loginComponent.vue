<template>

    <div>

        <v-row>
            <v-col cols="12" sm="4" class="mx-auto">

                <v-alert
                    icon="mdi-shield-lock-outline"
                    prominent
                    text
                    type="info"
                    class="text-center"
                >
                    <h2>WELCOME BACK</h2>
                    Please login to continue
                </v-alert>


                <v-card>
                    <v-card-text>

                        <v-text-field
                        outlined
                        label="E-Maill"
                        type="email"
                        clearable
                        v-model="email"

                        >

                        </v-text-field>

                        <v-text-field
                        outlined
                        label="Password"
                        type="password"
                        clearable
                        v-model="password"

                        >

                        </v-text-field>

                        <v-btn @click="login" :loading="progress" color="blue" block dark>Login</v-btn>

                        <v-alert type="error" v-if="error">
                            {{error_message}}

                        </v-alert>

                    </v-card-text>

                </v-card>

            </v-col>
        </v-row>

    </div>

</template>

<script>
    export default {
        name: "loginComponent",
        data(){
            return{
                progress:false,
                email:'',
                password:'',
                error:false,
                error_message:'',

            }
        },
        created() {
          if (this.$store.state.loged_in){
              this.$router.back();
          }

        },
        methods:{
            logout(){
                axios.post('/Authlogout')
                .then(res=>{

                });



            },

            login(){
                this.progress=true;
                axios.get('/sanctum/csrf-cookie').then(response => {

                    axios.post('/Authlogin',{
                        email:this.email,
                        password:this.password
                    })
                    .then(res=>{
                        this.progress=false;
                        axios.get('/api/user')
                        .then(res=>{

                            this.$store.state.user = res.data;
                            this.$store.state.loged_in = true;
                            this.$router.push({path:'/'});

                        });
                    })
                    .catch(error=>{
                        this.progress =false;
                        console.log(error);
                    })

                });


            }
        }
    }
</script>

<style scoped>

</style>
