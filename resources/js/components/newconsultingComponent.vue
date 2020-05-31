<template>
<div>
    <patientprofileComponent :attendance-id="$route.params.id" ></patientprofileComponent>


    <consultingComponent :attendance-id="$route.params.id"></consultingComponent>


</div>


</template>

<script>
    import patientprofileComponent from "./partials/patientprofileComponent";
    import consultingComponent  from "./partials/consultingComponent";
    export default {
        name: "newconsultingComponent",
        components:{
            consultingComponent,
            patientprofileComponent
        }
    }
</script>

<style scoped>

</style>
