<template>
    <div>
        <patientprofileComponent :attendance-id="$route.params.id" ></patientprofileComponent>
    </div>

</template>

<script>
    import OPDComponent from "./partials/OPDComponent";
    import patientprofileComponent from "./partials/patientprofileComponent";
    export default {
        name: "vitalsComponent",
        components:{
            OPDComponent,
            patientprofileComponent

        },
        data(){
            return{
                progress:false,

            }
        }
    }
</script>

<style scoped>

</style>
