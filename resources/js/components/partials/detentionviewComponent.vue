<template>

    <div>

        <v-card>
            <v-tabs
                v-model="tab"
                centered


            >
                <v-tabs-slider></v-tabs-slider>



                <v-tab href="#info">

                    Patient Info.

                </v-tab>
                <v-tab href="#drug_sheets">
                    Drug Sheets
                </v-tab>

                <v-tab href="#temp_sheets">
                    Temperature Sheets
                </v-tab>

                <v-tab href="#notes">
                    Nurses Notes
                </v-tab>
            </v-tabs>

            <v-tabs-items v-model="tab">
                <v-tab-item

                    value="info"
                >

                    <patientprofileComponent :attendance-id="$route.params.id"></patientprofileComponent>

                </v-tab-item>


                <v-tab-item

                    value="temp_sheets"
                >
                    <tempsheetsComponent></tempsheetsComponent>

                </v-tab-item>

                <v-tab-item

                    value="drug_sheets"
                >
                    <drugsheetComponent></drugsheetComponent>

                </v-tab-item>

                <v-tab-item

                    value="notes"
                >

                    <nursesnotesComponent></nursesnotesComponent>

                </v-tab-item>
            </v-tabs-items>
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
    import tempsheetsComponent from "./tempsheetsComponent";
    import patientprofileComponent from "./patientprofileComponent";
    import nursesnotesComponent from "./nursesnotesComponent";
    import drugsheetComponent from "./drugsheetComponent";
    export default {
        name: "detentionviewComponent",
        components:{
          patientprofileComponent, tempsheetsComponent, nursesnotesComponent, drugsheetComponent
        },
        data(){
            return{
                tab:'info',
                search:'',
                error_message:false,
                error_msg:'',
                success_message:false,
                success_msg:'',


            }
        }
    }
</script>

<style scoped>

</style>
