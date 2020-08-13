<template>
    <div>
        <v-progress-linear indeterminate color="blue" v-if="progress"></v-progress-linear>

        <v-row v-else>
            <v-col cols="12" sm="12">
                <v-banner class="text-center bg-primary-gradient text-light">
                    <span style="color:#fff;">Your current role/office: <strong>{{$store.state.user.type}}</strong></span>
                </v-banner>
            </v-col>


            <v-col cols="12" sm="8">
                <v-row>

                    <v-col cols="12" sm="4">
                        <v-alert
                            border="left"
                            colored-border
                            color="blue accent-4"
                            elevation="2"
                            icon="mdi-account-group"
                            class="text-primary text-center"

                            prominent
                        >
                            <h2 class=" blue--text font-weight-bold">{{patients}}</h2>

                            <strong class="blue--text">Registered Patients</strong><br/>
                            <v-btn to="/patients" color="blue" small text>View All</v-btn>

                        </v-alert>
                    </v-col>


                    <v-col cols="12" sm="4">
                        <v-alert
                            border="left"
                            colored-border
                            color="success accent-4"
                            elevation="2"
                            icon="mdi-badge-account-horizontal"
                            class="text-success text-center"

                            prominent
                        >
                            <h2 class="green--text font-weight-bold">{{attendance}}</h2>

                            <strong class="green--text">Total Attendance</strong><br/>
                            <v-btn to="/opd" color="green" small text>View All</v-btn>

                        </v-alert>
                    </v-col>

                    <v-col cols="12" sm="4">
                        <v-alert
                            border="left"
                            colored-border
                            color="warning accent-4"
                            elevation="2"
                            icon="mdi-bed"
                            class="text-success text-center"

                            prominent
                        >
                            <h2 class="orange--text font-weight-bold">{{detaines}}</h2>

                            <strong class="orange--text">Total Detained</strong><br/>
                            <v-btn to="/detention" color="warning" small text>View All</v-btn>

                        </v-alert>
                    </v-col>
                </v-row>

                <v-row>
                    <v-col cols="12" sm="12">
                        <column-chart :data="all_chart" />

                    </v-col>
                </v-row>



                <v-row>
                    <v-col cols="12" sm="12">
                        <h3>Most Recent Attendance</h3>

                        <v-simple-table>
                            <thead>
                            <tr>
                                <th>OPD#</th>
                                <th>Patient Name</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="attendance in recent_attendance">
                                    <td>
                                        <v-btn text color="blue" :to="'/opd/'+attendance.id">{{attendance.patient.opd_number}}</v-btn>
                                    </td>
                                    <td>{{attendance.patient.surname}}</td>
                                    <td>{{attendance.entry_date}}</td>

                                </tr>

                            </tbody>

                        </v-simple-table>

                    </v-col>
                </v-row>

            </v-col>
            <v-col cols="12" sm="4">

                <v-card>
                    <v-card-text class="text-center">
                        <h3>ATTENDANCE SUMMARY</h3>
                    </v-card-text>

                <v-card-text class="bg-primary-gradient text-center white--text" rounded>
                    <h1 class="font-weight-bold">{{patients_last30}}</h1>
                    <small>Total registered in the last 30 days</small>
                </v-card-text>


                <v-card-text class="bg-success-gradient text-center white--text" rounded>
                    <h1 class="font-weight-bold">{{opd_last30}}</h1>
                    <small>Total attendance in the last 30 days</small>
                </v-card-text>

                    <v-card-text class="bg-warning-gradient text-center white--text" rounded>
                    <h1 class="font-weight-bold">{{detained_last30}}</h1>
                    <small>Total detained in the last 30 days</small>
                </v-card-text>

                    <v-card-text class="text-center">
                        <h3>DISPENSARY SUMMARY</h3>
                    </v-card-text>

                    <v-card-text class="border-bottom border-2 border-primary text-center blue--text" rounded>
                        <h1 class="font-weight-bold">{{drugs}}</h1>
                        <small>Drugs in stock</small><br>
                        <v-btn text color="blue" to="/dispensary" small>View All</v-btn>
                    </v-card-text>

                    <v-card-text class="border-bottom border-2 border-primary text-center green--text" rounded>
                        <h1 class="font-weight-bold">{{sales}}</h1>
                        <small>Total Sales</small><br>
                        <v-btn text color="green" to="/dispensary" small>View All</v-btn>

                    </v-card-text>

                </v-card>
            </v-col>
        </v-row>

    </div>
</template>

<script>
    export default {
        name: "dashboardComponent",
        data(){
            return{
                progress:false,
                patients:0,
                attendance:0,
                detaines:0,
                opd_last30:0,
                patients_last30:0,
                detained_last30:0,
                drugs:0,
                sales:0,
                recent_attendance:[],
                all_chart:[

                ]
            }
        },
        methods:{
            prep_graph1(graph){
                let data = {
                    name:'Registered Patients',
                    color:'blue',
                    data:{
                        'Jan' : graph[0],
                        'Feb' : graph[1],
                        'Mar' : graph[2],
                        'Apr' : graph[3],
                        'May' : graph[4],
                        'Jun' : graph[5],
                        'Jul' : graph[6],
                        'Aug' : graph[7],
                        'Sep' : graph[8],
                        'Oct' : graph[9],
                        'Nov' : graph[10],
                        'Dec' : graph[11],
                    }
                };
                this.all_chart.push(data);
            },

            prep_graph2(graph){
                let data = {
                    name:'Attendance',
                    color:'green',
                    data:{
                        'Jan' : graph[0],
                        'Feb' : graph[1],
                        'Mar' : graph[2],
                        'Apr' : graph[3],
                        'May' : graph[4],
                        'Jun' : graph[5],
                        'Jul' : graph[6],
                        'Aug' : graph[7],
                        'Sep' : graph[8],
                        'Oct' : graph[9],
                        'Nov' : graph[10],
                        'Dec' : graph[11],
                    }
                };
                this.all_chart.push(data);
            },
            get_dashboard(){
                this.progress=true;
                axios.get('/api/dashboard')
                    .then(res=>{
                        this.progress=false;
                        this.attendance = res.data.opds;
                        this.patients = res.data.patients;
                        this.detaines = res.data.detaines;
                        this.opd_last30 = res.data.opd_last30;
                        this.patients_last30 = res.data.patients_last30;
                        this.detained_last30 = res.data.detained_last30;
                        this.drugs = res.data.total_drugs;
                        this.sales = res.data.total_sales;
                        this.recent_attendance = res.data.recent_attendance;
                        this.prep_graph1(res.data.chart.patients);
                        this.prep_graph2(res.data.chart.attendance);


                    })
                .catch(error=>{

                })

            }

        },
        mounted() {
            this.get_dashboard();

        }
    }
</script>

<style scoped>
    .super-rounded{
        border-radius:5%;
    }

</style>
