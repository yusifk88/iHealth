<template>
    <div>
        <label>Prescribe Lab tests</label>
            <vue-editor v-model="tests"></vue-editor>
    </div>

</template>

<script>
    import { VueEditor } from "vue2-editor";

    export default {
        name: "labComponent",
        components:{
            VueEditor
        },
        data(){
            return{
                tests:''
            }
        }
    }
</script>

<style scoped>

</style>
